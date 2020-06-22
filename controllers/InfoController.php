<?php

namespace app\controllers;

use app\models\Config;
use app\models\news\News;
use Yii;
use yii\filters\VerbFilter;


class InfoController extends AppController
{

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'call-back' => ['POST'],
                ],
            ],
        ];
    }

    public function actionMain(){
        return $this->render('main', [
            'title' => Config::getValue(Config::MAIN_TITLE)
        ]);
    }

    public function actionIhbbkb(){
        $this->layout = null;
        Yii::$app->cache->flush();
        return $this->goHome();
    }

    public function actionNews($id){
        $newsItem = News::findOne($id);
        if ($newsItem) {
            return $this->render('news', [
                'news' => $newsItem
            ]);
        }
    }

    public function actionAbout(){
        return $this->render('about', [
            'title' => 'О нас',
            'permission' => '']);
    }

    public function actionContact(){
        $title = 'Контакты';

        $main_title = Config::getValue(Config::MAIN_TITLE);
        $contacts_text = Config::getValue(Config::CONTACTS_TEXT);

        return $this->render('contact', [
            'title' => $title,
            'main_title' => $main_title,
            'contacts_text' => $contacts_text
        ]);
    }

    public function actionTerms(){
        $title = 'Пользовательское соглашение';
        return $this->render('privacy-policy', [
            'title' => $title,
            'permission' => '',
        ]);
    }
    public function actionProducers(){
        $title = 'Производители';
        return $this->render('producers', [
            'title' => $title,
            'permission' => '',
        ]);
    }


    public function actionDelivery(){
        $title = 'Условие доставки';
        return $this->render('delivery',[
            'title' => $title,
            'permission' => '',
        ]);
    }

    public function actionWishList(){
        return $this->render('wish-list',['title'=>'Избранное',]);
    }

}