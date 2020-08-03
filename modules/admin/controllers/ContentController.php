<?php


namespace app\modules\admin\controllers;


use app\models\employ\Employ;
use app\models\Photo;
use app\services\ContentManageService;
use DomainException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ContentController extends Controller
{
    private $contentManageService;

    public function __construct($id, $module, ContentManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->contentManageService = $service;
    }

    public function actionIndex()
    {
        $main = $this->contentManageService->getMain();
        $header = $this->contentManageService->getHeader();
        $footer = $this->contentManageService->getFooter();
        $about = $this->contentManageService->getAbout();
        $contacts = $this->contentManageService->getContacts();
        $terms = $this->contentManageService->getTerms();

        if ($main->load(Yii::$app->request->post()) && $main->validate()) {
            try {
                $this->contentManageService->updateMain($main);
                addAlert('success', 'Основная информация сохранена!');
                return $this->redirect('index');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        if ($header->load(Yii::$app->request->post()) && $header->validate()) {
            try {
                $this->contentManageService->updateHeader($header);
                addAlert('success', 'Информация хедера сохранена!');
                return $this->redirect('index');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        if ($footer->load(Yii::$app->request->post()) && $footer->validate()) {
            try {
                $this->contentManageService->updateFooter($footer);
                addAlert('success', 'Информация футера сохранена!');
                return $this->redirect('index');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        if ($about->load(Yii::$app->request->post()) && $about->validate()) {
            try {

                $this->contentManageService->updateAbout($about);
                addAlert('success', 'Информация секции "О нас" сохранена!');
                return $this->redirect('index');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        if ($contacts->load(Yii::$app->request->post()) && $contacts->validate()) {
            try {

                $this->contentManageService->updateContacts($contacts);
                addAlert('success', 'Информация секции "Контакты" сохранена!');
                return $this->redirect('index');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }


        if ($terms->load(Yii::$app->request->post()) && $terms->validate()) {
            try {

                $this->contentManageService->updateTerms($terms);
                addAlert('success', 'Информация секции "Пользовательское соглашение" сохранена!');
                return $this->redirect('index');
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Employ::find(),
        ]);

        return $this->render('index', [
            'main' => $main,
            'header' => $header,
            'footer' => $footer,
            'about' => $about,
            'contacts' => $contacts,
            'dataProvider' => $dataProvider,
            'terms' => $terms
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
}