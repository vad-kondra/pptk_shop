<?php

namespace app\modules\admin\controllers;


use app\models\Category;
use app\models\CategoryForm;
use app\models\CharToCatForm;
use app\models\temp\CategoryTemp;
use app\modules\admin\models\search\CategorySearch;
use app\services\CategoryManageService;
use app\services\CharacteristicManageService;
use Yii;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class CategoryController extends Controller
{
    private $service;

    public function __construct($id, $module, CategoryManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
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
        return $this->render('view', ['category' => $this->findModel($id),]);
    }


    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new CategoryForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $category = $this->service->create($form);
                return $this->redirect(['update', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }


    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $category = $this->findModel($id);

        $form = new CategoryForm($category);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($category->id, $form);
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'category' => $category,
        ]);
    }


    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionMoveUp($id)
    {
        $this->service->moveUp($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionMoveDown($id)
    {
        $this->service->moveDown($id);
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Category
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }


//TODO     temp DELETE THIS
//    public function actionAddTemp() {
//
//        $cats = CategoryTemp::find()->all();
//        foreach ($cats as $cat) {
//            $this->service->createFromTemp($cat);
//        }
//
//    }
//TODO     temp DELETE THIS
}
