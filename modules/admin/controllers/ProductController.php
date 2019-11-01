<?php

namespace app\modules\admin\controllers;

use app\models\Brand;
use app\models\Category;
use app\models\CharacteristicsForm;
use app\models\Meta;
use app\models\ParseForm;
use app\models\PhotoForm;
use app\models\PriceForm;
use app\models\Product;
use app\models\ProductCreateForm;
use app\models\ProductEditForm;
use app\models\QuantityForm;
use app\models\Value;
use app\modules\admin\models\search\ProductSearch;
use app\services\ProductManageService;
use DomainException;
use Yii;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    private $productService;

    public function __construct($id, $module, ProductManageService $productManageService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->productService = $productManageService;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'activate' => ['POST'],
                    'draft' => ['POST'],
                    'delete-photo' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $product = $this->findModel($id);

        $photoForm = new PhotoForm();
        if ($photoForm->load(Yii::$app->request->post()) && $photoForm->validate()) {
            if ($photoForm->image) {
                try {
                    $this->productService->addPhoto($product->id, $photoForm);
                    addAlert('success', "Изображение добавлено");
                    return $this->redirect(['view', 'id' => $product->id]);
                } catch (\DomainException $e) {
                    Yii::$app->errorHandler->logException($e);
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
        }



        return $this->render('view', [
            'product' => $product,
            'photoForm' => $photoForm,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();
        $parseForm = new ParseForm();
        if ($parseForm->load(Yii::$app->request->post()) && $parseForm->validate()) {
            $form = $this->getForm($parseForm);
        }
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $product = $this->productService->create($form);
                addAlert('success', "Товар добавлен");
                return $this->redirect(['update', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
            'parseForm' => $parseForm
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $form = new ProductEditForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->productService->edit($product->id, $form);
                addAlert('success', "Информация о товаре изменена ");
                return $this->redirect(['update', 'id' => $product->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionPrice($id)
    {
        $product = $this->findModel($id);

        $form = new PriceForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->productService->changePrice($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('price', [
            'model' => $form,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionQuantity($id)
    {
        $product = $this->findModel($id);
        $form = new QuantityForm($product);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->productService->changeQuantity($product->id, $form);
                return $this->redirect(['view', 'id' => $product->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('quantity', [
            'model' => $form,
            'product' => $product,
        ]);
    }


    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionChars($id)
    {
        $product = $this->findModel($id);

        $charForm = new CharacteristicsForm($product);


        if (Yii::$app->request->isPost ) {
            if (isset($_POST['ValueForm'])) {
                for ($i=0; $i<count($charForm->values); $i++) {
                    $charForm->values[$i]->value = $_POST['ValueForm'][$i]['value'];
                }
                foreach ($charForm->values as $value) {
                    $product->setValue($value->id, $value->value);
                }
                return $this->redirect(['view', 'id' => $product->id]);
            }
        }

        return $this->render('chars', [
            'charForm' => $charForm,
            'product' => $product,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAddChar($id) {
        $product = $this->findModel($id);
        $newValue = new Value();

        if (Yii::$app->request->isPost) {

            if (isset($_POST['Value']) && $_POST['Value']['characteristic_id'] != null) {
                $newValue = $_POST['Value'];

                $product->setValue($newValue['characteristic_id'], $newValue['value']);
                return $this->redirect(['view', 'id' => $product->id]);
            }
        }
        return $this->render('addChar', [
            'product' => $product,
            'newValue' => $newValue
        ]);
    }

    public function actionRemoveChar($id) {
        $val = Value::findOne($id);

        if ($val) {
            $product = $this->findModel($val->product_id);
            $val->delete();
            return $this->redirect(['view', 'id' => $product->id]);
        }
        return $this->goHome();
    }



    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->productService->remove($id);
            addAlert('success', 'Товар удален');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionActivate($id)
    {
        try {
            $this->productService->activate($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * действие перевода товара в шаблоны
     * @param integer $id
     * @return mixed
     */
    public function actionDraft($id)
    {
        try {
            $this->productService->draft($id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }



    /**
     * @param integer $id
     * @param $photo_id
     * @return mixed
     */
    public function actionDeletePhoto($id, $photo_id)
    {
        try {
            $this->productService->removePhoto($id, $photo_id);
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }


    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function getForm(ParseForm $parseForm): ProductCreateForm
    {
        $code = $parseForm->code;
        $form = new ProductCreateForm();

        $urlEtm = 'https://www.etm.ru/cat/nn/';
        $url = $urlEtm.$code;

        $client = new Client();
        $request = $client->get($url);
        $response = $request->send();

        $document = \phpQuery::newDocumentHTML($response->getContent());

        $title = $document->find('h1')->text();
        if ($title == '') {
            $parseForm->addError('code', 'Товара с данным кодом не найдено');
            return $form;
        }

        $form->name = trim($title);
        $form->code = trim($code);

        $form->description = $form->description = $document->find('div.card-description > p')->text();


        $document->find('div.card-offer > div > span.price')->children('span')->remove();
        $form->price->new = trim($document->find('div.card-offer > div > span.price')->text());

        $form->art = trim($document->find('div.line-info')->children()->get(3)->textContent);

        $brandName = trim($document->find('div.line-info')->children()->get(5)->textContent);
        $brand = Brand::find()->where(['name' => $brandName])->one();

        if (!$brand) {
            $brand = Brand::create(
                $brandName,
                transliterate($brandName),
                new Meta(
                    $brandName,
                    '',
                    ''
                )
            );
            $brand->save();
        }

        $form->brandId = $brand->id;
        $form->meta->title = $form->name;


        $categoryName = trim($document->find('div.breadcrumbs > a.bold')->text());
        $category = Category::find()->where(['name' => $categoryName])->one();
        if (!$category) {
            $form->categories->addError('main', 'Категория данного товара с названием "'.$categoryName.'" не найдено. Добавьте её и попробуйте еще раз');
            return $form;
        }
        $form->categories->main = $category;

        return $form;
    }

}