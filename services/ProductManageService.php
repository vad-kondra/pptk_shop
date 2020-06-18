<?php

namespace app\services;

use app\models\Category;
use app\models\CharacteristicsForm;
use app\models\Meta;
use app\models\Photo;
use app\models\PhotoForm;
use app\models\PriceForm;
use app\models\Product;
use app\models\ProductCreateForm;
use app\models\ProductEditForm;
use app\models\Tag;
use app\repositories\BrandRepository;
use app\repositories\CategoryRepository;
use app\repositories\ProductRepository;
use app\repositories\TagRepository;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Yii;
use yii\helpers\ArrayHelper;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;
    private $tags;

    public function __construct(ProductRepository $products, BrandRepository $brands, CategoryRepository $categories, TagRepository $tags)
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);
        $product = Product::create(
            $brand->id,
            $category->id,
            $form->art,
            $form->code,
            $form->name,
            $form->description,
            $form->is_new,
            $form->is_sale,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $product->setPrice($form->price->new, $form->price->old);
        $image = $form->photo->image;
        if ($image){
            $photo = Photo::create($image, $form->code);
            $photo->save();
            $product->setPhoto($photo->id);
        }
        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }

        foreach ($form->tags->newNames as $tagName) {
            if (!$tag = $this->tags->findByName($tagName)) {
                $tag = Tag::create($tagName, $tagName);
                $this->tags->save($tag);
            }
            $product->assignTag($tag->id);
        }
        $this->products->save($product);

        return $product;
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product->edit(
            $brand->id,
            $form->code,
            $form->name,
            $form->description,
            $form->is_new,
            $form->is_sale,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $product->changeCategory($category->id);

        $product->revokeTags();
        $this->products->save($product);


        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }
        foreach ($form->tags->newNames as $tagName) {
            if (!$tag = $this->tags->findByName($tagName)) {
                $tag = Tag::create($tagName, $tagName);
                $this->tags->save($tag);
            }
            $product->assignTag($tag->id);
        }

        $this->products->save($product);
    }

    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->products->get($id);
        $product->setPrice($form->new, $form->old);
        $this->products->save($product);
    }

    public function activate($id): void
    {
        $product = $this->products->get($id);
        $product->activate();
        $this->products->save($product);
    }

    public function draft($id): void
    {
        $product = $this->products->get($id);
        $product->draft();
        $this->products->save($product);
    }

    public function addPhoto($id, PhotoForm $form): void
    {
        $product = $this->products->get($id);
        $photo = Photo::create($form->image, $product->code);
        $photo->save();
        $product->setPhoto($photo->id);
        $this->products->save($product);
    }

    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }

    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }

    public function changeValues(int $id, CharacteristicsForm $form)
    {
        $product = $this->products->get($id);
        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }
    }

    public function makeSale($id)
    {
        $product = $this->products->get($id);
        $product->makeSale();
        $this->products->save($product);
    }

    public function makeNew($id)
    {
        $product = $this->products->get($id);
        $product->makeNew();
        $this->products->save($product);
    }

    private function getClient(): Client
    {
        return Yii::$container->get(Client::class);
    }

    private function indexProduct(Product $product)
    {
        $this->getClient()->index([
            'index' => 'shop',
            'type' => 'products',
            'id' => $product->id,
            'body' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => strip_tags($product->description),
                'price' => $product->price_new,
                'brand' => $product->brand_id,
                'categories' => ArrayHelper::merge(
                    [$product->category->id],
                    ArrayHelper::getColumn($product->category->parents, 'id'),
                    [],
                    array_reduce(array_map(function (Category $category) {
                        return ArrayHelper::getColumn($category->parents, 'id');
                    }, $product->categories), 'array_merge', [])
                ),
                'tags' => ArrayHelper::getColumn($product->tagAssignments, 'tag_id'),
//								'values' => [
//										'type' => 'nested',
//										'properties' => array_map(function (Value $value) {
//												return [
//													'characteristic' => $value->characteristic_id,
//													'value_string' => (string)$value->value,
//													'value_int' => (int)$value->value,
//												];
//										}, $product->values)
//								],
            ]
        ]);
    }

    private function deleteIndexProduct(Product $product)
    {
        $this->getClient()->delete([
            'index' => 'shop',
            'type' => 'products',
            'id' => $product->id,
        ]);
    }

    public function reindexAllProducts()
    {
        $client = $this->getClient();
        try {
            $client->indices()->delete([
                'index' => 'shop'
            ]);
        } catch (Missing404Exception $e) {}


        $params = [
            'index' => 'shop',

            'body' => [

                'mappings' => [
                    '_source' => [
                        'enabled' => true,
                    ],
                    'properties' => [
                        'id' => [
                            'type' => 'integer',
                        ],
                        'name' => [
                            'type' => 'text',
                        ],
                        'description' => [
                            'type' => 'text',
                        ],
                        'price' => [
                            'type' => 'integer',
                        ],
                        'brand' => [
                            'type' => 'integer',
                        ],
                        'categories' => [
                            'type' => 'integer',
                        ],
                        'tags' => [
                            'type' => 'integer',
                        ],
                        'values' => [
                            'type' => 'nested',
                            'properties' => [
                                'characteristic' => [
                                    'type' => 'integer'
                                ],
                                'value_string' => [
                                    'type' => 'keyword',
                                ],
                                'value_int' => [
                                    'type' => 'integer',
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];


        $params = [
            'index' => 'shop'
        ];
        $client->indices()->create($params);

        $query = Product::find()
            ->active()
            ->with(['category', 'tagAssignments', 'values'])
            ->orderBy('id');

        foreach ($query->each() as $product) {
            /** @var Product $product */

            $params = [
                'index' => 'shop',
                'type' => 'products',
                'id' => $product->id,
                'body' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => strip_tags($product->description),
                    'price' => $product->price_new,
                    'brand' => $product->brand_id,
                    'categories' => ArrayHelper::merge(
                        [$product->category->id],
                        ArrayHelper::getColumn($product->category->parents, 'id'),
                        ArrayHelper::getColumn($product->categories, 'id'),
                        array_reduce(array_map(function (Category $category) {
                            return ArrayHelper::getColumn($category->parents, 'id');
                        }, $product->categories), 'array_merge', [])
                    ),
                    'tags' => ArrayHelper::getColumn($product->tagAssignments, 'tag_id'),
//								'values' => [
//										'type' => 'nested',
//										'properties' => array_map(function (Value $value) {
//												return [
//													'characteristic' => $value->characteristic_id,
//													'value_string' => (string)$value->value,
//													'value_int' => (int)$value->value,
//												];
//										}, $product->values)
//								],
                ]
            ];

            $client->index($params);
        }

    }

}