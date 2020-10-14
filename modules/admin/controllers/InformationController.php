<?php


namespace app\modules\admin\controllers;


use app\models\information\Information;
use app\models\InformationEditForm;
use app\models\PhotoForm;
use app\models\InformationForm;
use app\services\InformationManageService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * @property InformationManageService $service
 */
class InformationController extends Controller
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
     * @param InformationManageService $service
     * @param array $config
     */
    public function __construct($id, $module, InformationManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => Information::find(),
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

        $form = new InformationForm();
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
        $form = new InformationEditForm($techArticles);

        if ($form->load(Yii::$app->request->post()) && $form->validate() )
        {
            $form->slug = $form->slug ?: Inflector::slug($form->title);
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
     * @return Information
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Information
    {
        if (($model = Information::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}