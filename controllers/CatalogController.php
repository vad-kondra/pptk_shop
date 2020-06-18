<?php

namespace app\controllers;

use app\models\search\SearchForm;
use app\repositories\BrandReadRepository;
use app\repositories\CategoryReadRepository;
use app\repositories\ProductReadRepository;
use app\repositories\TagReadRepository;
use Yii;
use yii\web\NotFoundHttpException;


class CatalogController extends AppController
{
    public $layout = 'catalog';

    private $products;
    private $categories;
    private $brands;
    private $tags;

    public function __construct($id, $module,
        ProductReadRepository $products,
        CategoryReadRepository $categories,
        BrandReadRepository $brands,
        TagReadRepository $tags,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function actionIndex(): string
    {
        $dataProvider = $this->products->getAll();
        $category = $this->categories->getRoot();

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        if (!$category = $this->categories->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByCategory($category);

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionBrand($id)
    {
        if (!$brand = $this->brands->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $this->products->getAllByBrand($brand);

        return $this->render('brand', [
            'brand' => $brand,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionTag($id)
    {
        if (!$tag = $this->tags->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByTag($tag);

        return $this->render('tag', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionSearch()
    {
        $form = new SearchForm();
        $form->load(\Yii::$app->request->queryParams);
        $form->validate();

        $dataProvider = $this->products->search($form);

        $category = $this->categories->getRoot();
        return $this->render('search', [
            'category' => $category,
            'dataProvider' => $dataProvider,
            'searchForm' => $form,
        ]);
    }

    public function actionSearchFast()
    {
        $this->layout = false;

        $form = new SearchForm();
        $form->load(Yii::$app->request->queryParams);

        $dataProvider = $this->products->fastSearch($form);

        return $this->render('fast_search_response', [
            'products' => $dataProvider->getModels(),
            'text' => $form->text,
            'category' => $form->category
        ]);
    }


    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionProduct($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $this->layout = 'blank';

        return $this->render('product', [
            'product' => $product,
        ]);
    }
}