<?php


namespace app\repositories;


use app\models\Brand;
use app\models\Category;
use app\models\Product;
use app\models\search\SearchForm;
use app\models\search\ValueForm;
use app\models\Tag;
use app\models\Value;
use Elasticsearch\Client;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ProductReadRepository extends BaseObject
{
    private $client;

    public function __construct(Client $client, $config = [])
    {
        $this->client = $client;
        parent::__construct($config);
    }

    public function count(): int
    {
        return Product::find()->active()->count();
    }

    public function getAllByRange(int $offset, int $limit): array
    {
        return Product::find()->alias('p')->active('p')->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    public function getAllNewForCarusel(): ActiveQuery
    {
        return Product::find()->active()->new()->with('photo')->limit(8)->orderBy('id');
    }

    public function getAllSaleForCarusel(): ActiveQuery
    {
        return Product::find()->active()->sale()->with('photo')->limit(8)->orderBy('id');
    }


    /**
     * @return iterable|Product[]
     */
    public function getAllIterator(): iterable
    {
        return Product::find()->alias('p')->active('p')->with('photo', 'brand')->each();
    }

    /**
     * @return DataProviderInterface
     */
    public function getAll(): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->with('photo');

        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->with('photo', 'category');
        $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
        $query->andWhere(['or', ['p.category_id' => $ids]]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getAllByBrand(Brand $brand): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->with('photo');
        $query->andWhere(['p.brand_id' => $brand->id]);
        return $this->getProvider($query);
    }

    public function getAllByTag(Tag $tag): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->with('photo');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getFeatured($limit): array
    {
        return Product::find()->active()->with('photo')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function find($id)
    {
        return Product::find()->active()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 15,
                'pageSizeLimit' => [15, 100],
            ]
        ]);
    }

    public function search(SearchForm $form): DataProviderInterface
    {
//        $pagination = new Pagination([
//            'pageSizeLimit' => [15, 100],
//            'validatePage' => false,
//        ]);
//
//        $sort = new Sort([
//            'defaultOrder' => ['id' => SORT_DESC],
//            'attributes' => [
//                'id',
//                'name',
//                'price',
//            ],
//        ]);
//        $params = [
//            'index' => 'shop',
//            'type' => 'products',
//            'body' => [
//                '_source' => ['id'],
//                'from' => $pagination->getOffset(),
//                'size' => $pagination->getLimit(),
////                'sort' => array_map(function ($attribute, $direction) {
////                    return [$attribute => ['order' => $direction === SORT_ASC ? 'asc' : 'desc']];
////                }, array_keys($sort->getOrders()), $sort->getOrders()),
//                'query' => [
//                    'bool' => [
//                        'must' => array_merge(
//                            array_filter([
//                                !empty($form->category) ? ['term' => ['categories' => $form->category]] : false,
//                                !empty($form->brand) ? ['term' => ['brand' => $form->brand]] : false,
//                                !empty($form->text) ? ['multi_match' => [
//                                    'query' => $form->text,
//                                    'fields' => [ 'name^3', 'description' ]
//                                ]] : false,
//                            ]),
//
//                            array_map(function (ValueForm $value) {
//
//                                return ['nested' => [
//                                    'path' => 'values',
//                                    'query' => [
//                                        'bool' => [
//                                            'must' => array_filter([
//                                                ['match' => ['values.characteristic' => $value->getId()]],
//                                                !empty($value->equal) ? ['match' => ['values.value_string' => $value->equal]] : false,
//                                                !empty($value->from) ? ['range' => ['values.value_int' => ['gte' => $value->from]]] : false,
//                                                !empty($value->to) ? ['range' => ['values.value_int' => ['lte' => $value->to]]] : false,
//                                            ]),
//                                        ],
//                                    ],
//                                ]];
//                            }, array_filter($form->values, function (ValueForm $value) { return $value->isFilled(); }))
//                        )
//                    ],
//                ],
//            ],
//        ];
//
//        //debug($params);
//        $response = $this->client->search($params);
//
//
//
//
//        $ids = ArrayHelper::getColumn($response['hits']['hits'], '_source.id');
//
//        if ($ids) {
//            $query = Product::find()
//                ->active()
//                ->with('photo')
//                ->andWhere(['id' => $ids])
//                ->orderBy(new Expression('FIELD(id,' . implode(',', $ids) . ')'));
//        } else {
//            $query = Product::find()->andWhere(['id' => 0]);
//        }
//
//        return new SimpleActiveDateProvider([
//            'query' => $query,
//            'totalCount' => $response['hits']['total'],
//            'pagination' => $pagination,
//            'sort' => $sort,
//        ]);



        $query = Product::find()->alias('p')->active('p')->with('photo', 'category');

        if ($form->category) {
            if ($category = Category::findOne($form->category)) {

                $query = Product::find()->alias('p')->active('p')->with('photo', 'category');
                $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
                $query->andWhere(['or', ['p.category_id' => $ids]]);
                $query->groupBy('p.id');

            } else {
                $query->andWhere(['p.id' => 0]);
            }
        }

        if ($form->brand) {
            $query->andWhere(['p.brand_id' => $form->brand]);
        }





//        if ($form->values) {
//            $productIds = null;
//            foreach ($form->values as $value) {
//                if ($value->isFilled()) {
//                    $q = Value::find()->andWhere(['characteristic_id' => $value->getId()]);
//
//                    $q->andFilterWhere(['>=', 'CAST(value AS SIGNED)', $value->from]);
//                    $q->andFilterWhere(['<=', 'CAST(value AS SIGNED)', $value->to]);
//                    $q->andFilterWhere(['value' => $value->equal]);
//
//                    $foundIds = $q->select('product_id')->column();
//                    $productIds = $productIds === null ? $foundIds : array_intersect($productIds, $foundIds);
//                }
//            }
//            if ($productIds !== null) {
//                $query->andWhere(['p.id' => $productIds]);
//            }
//        }

        if (!empty($form->text)) {
            $query->andWhere(['or', ['like', 'code', $form->text], ['like', 'name', $form->text]]);
        }

        $query->groupBy('p.id');


        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSizeLimit' => [15, 100],
            ]
        ]);
    }

    public function fastSearch(SearchForm $form): DataProviderInterface
    {

        $query = Product::find()->alias('p')->active('p')->with('photo', 'category');


        if ($form->brand) {
            $query->andWhere(['p.brand_id' => $form->brand]);
        }

        if ($form->category) {
            if ($category = Category::findOne($form->category)) {

                $query = Product::find()->alias('p')->active('p');
                $ids = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
                $query->andWhere(['or', ['p.category_id' => $ids]]);
                $query->groupBy('p.id');

            } else {
                $query->andWhere(['p.id' => 0]);
            }
        }

        if (!empty($form->text)) {
            $query->andWhere(['or',
                ['like', 'code', $form->text],
                ['like', 'name', $form->text],
                ['like', 'art', $form->text]
            ]);
        }

        $query->groupBy('p.id')
        ->limit(10);


        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
    }


    public function getWishList($userId): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Product::find()
                ->alias('p')->active('p')
                ->joinWith('wishlistItems w', false, 'INNER JOIN')
                ->andWhere(['w.user_id' => $userId]),
            'sort' => false,
        ]);
    }

    public function getAllBestForCarusel()
    {
        return Product::find()->active()->top()->with('photo')->limit(15)->orderBy('name');
    }
}