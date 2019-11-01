<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 23.06.2018
 * Time: 17:40
 */

namespace app\controllers;


use yii\web\Controller;

class AppController extends Controller
{
    public $notifyAccess = false;
    public function init()
    {
        parent::init();
        /*if(Yii::$app->user->isGuest){
            Config::setUpFbConfig();
        }*/
       //Yii::$app->language = Yii::$app->request->cookies->getValue('_language', 'ru');
    }

    public function actionError(){
        $exception = \Yii::$app->errorHandler->exception;
        $msg =  "";
        $code =  "";

        if ($exception !== null) {
            $code = $exception->statusCode;
            switch ($exception->statusCode){
                case 404:
                    $msg = "Страница не найдена!";
                    break;
                default:$msg = $exception->getMessage();
            }
        }
        return $this->render('error', [
            'title' => 'Ошибка',
            'exception' => $exception,
            'msg'=>$msg,
            'code'=>$code
        ]);
    }
}