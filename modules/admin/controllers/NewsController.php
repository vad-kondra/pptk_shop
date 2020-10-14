<?php


namespace app\modules\admin\controllers;


use app\models\news\News;
use app\models\NewsEditForm;
use app\models\NewsForm;
use app\models\PhotoForm;
use app\services\NewsManageService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * @property NewsManageService $service
 */
class NewsController extends Controller
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
     * NewsController constructor.
     * @param $id
     * @param $module
     * @param NewsManageService $service
     * @param array $config
     */
    public function __construct($id, $module,NewsManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
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
        $news = $this->findModel($id);

        $photoForm = new PhotoForm();
        if ($photoForm->load(Yii::$app->request->post()) && $photoForm->validate()) {
            try {
                $this->service->addPhoto($news->id, $photoForm);
                return $this->redirect(['view', 'id' => $news->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('view', [
            'model' => $news,
            'photoForm' => $photoForm,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {

        $form = new NewsForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate() )
        {

            $news = $this->service->create($form);
            addAlert('success', 'Новость добавлена');
            return $this->redirect(['view', 'id' => $news->id]);
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
        $news = $this->findModel($id);
        $form = new NewsEditForm($news);

        if ($form->load(Yii::$app->request->post()) && $form->validate() )
        {
            $news = $this->service->edit($news->id, $form);
            addAlert('success', 'Новость отредактирована');
            return $this->redirect(['view', 'id' => $news->id]);
        }

        return $this->render('update', [
            'model' => $form,
            'news' => $news
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
            addAlert('success', 'Новость удалена');
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return News
     * @throws NotFoundHttpException
     */
    protected function findModel($id): News
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}