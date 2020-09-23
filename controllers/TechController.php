<?php

namespace app\controllers;

use app\services\TechManageService;

class TechController extends AppController
{
    private $techService;

    public function __construct($id, $module, TechManageService $techService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->techService = $techService;
    }

    public function actionIndex() {
        $techArticles = $this->techService->getAllTech();

        if (!empty($techArticles)) {
            return $this->render('index', [
                'techArticles' => $techArticles,
            ]);
        } else {
            return $this->render('no-tech-articles');
        }
    }

    public function actionView($id) {
        $techArticles = $this->techService->getById($id);

        return $this->render('detail', [
            'techArticles' => $techArticles,
        ]);

    }
}