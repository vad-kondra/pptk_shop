<?php

namespace app\controllers;

use app\models\information\Information;
use app\services\InformationManageService;
use yii\web\NotFoundHttpException;

class InformationController extends AppController
{
    private $informationService;

    public function __construct($id, $module, InformationManageService $informationService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->informationService = $informationService;
    }

    public function actionIndex() {
        $informationArticles = $this->informationService->getAllTech();

        if (!empty($informationArticles)) {
            return $this->render('index', [
                'informationArticles' => $informationArticles,
            ]);
        } else {
            return $this->render('no-tech-articles');
        }
    }

    public function actionView($slug) {
        if (!$post = Information::find()->where(['slug' => $slug])->one()) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        return $this->render('detail', [
            'informationArticles' => $post,
        ]);

    }
}