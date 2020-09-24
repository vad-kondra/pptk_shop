<?php


namespace app\modules\admin\controllers;


use app\models\news\News;
use app\models\NewsForm;
use app\models\PhotoForm;
use app\models\tech\Tech;
use app\models\TechForm;
use app\services\NewsManageService;
use app\services\TechManageService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * @property TechManageService $service
 */
class TechController extends Controller
{
    public $service;

    /**
     * @return array
     */
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
     * TechController constructor.
     * @param $id
     * @param $module
     * @param TechManageService $service
     * @param array $config
     */
    public function __construct($id, $module,TechManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => Tech::find(),
            'pagination' => [
                'pageSize' => 22
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $techArticles = $this->findModel($id);

        $photoForm = new PhotoForm();
        if ($photoForm->load(Yii::$app->request->post()) && $photoForm->validate()) {
            try {
                $this->service->addPhoto($techArticles->id, $photoForm);
                return $this->redirect(['view', 'id' => $techArticles->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('view', [
            'model' => $techArticles,
            'photoForm' => $photoForm,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {

        $form = new TechForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate() )
        {

            $techArticles = $this->service->create($form);
            addAlert('success', 'Статья добавлена');
            return $this->redirect(['view', 'id' => $techArticles->id]);
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $techArticles = $this->findModel($id);
        $form = new TechForm($techArticles);

        if ($form->load(Yii::$app->request->post()) && $form->validate() )
        {
            $techArticles = $this->service->edit($techArticles->id, $form);
            addAlert('success', 'Статья отредактирована');
            return $this->redirect(['view', 'id' => $techArticles->id]);
        } else
            {
                return $this->render('update', [
                    'model' => $form,
                    'techArticles' => $techArticles
                ]);
            }


    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
            addAlert('success', 'Статья удалена');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Tech
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Tech
    {
        if (($model = Tech::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}