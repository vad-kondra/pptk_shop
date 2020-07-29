<?php

namespace app\controllers;

use app\services\NewsManageService;

class NewsController extends AppController
{
    private $newsService;

    public function __construct($id, $module, NewsManageService $newsService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->newsService = $newsService;
    }

    public function actionIndex() {
        $news = $this->newsService->getAllNews();

        if (!empty($news)) {
           return $this->render('news', [
                'news' => $news,
            ]);
        } else {
            return $this->render('no-news');
        }
    }

    public function actionView($id) {
        $news = $this->newsService->getById($id);

        return $this->render('detail', [
            'news' => $news,
        ]);

    }
}