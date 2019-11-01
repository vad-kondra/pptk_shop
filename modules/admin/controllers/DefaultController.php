<?php

namespace app\modules\admin\controllers;

use app\helpers\OrderHelper;
use app\models\order\Order;
use app\models\order\Status;
use app\services\OrderService;
use dmstr\widgets\Alert;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $newOrderCount = Order::find()->where(['current_status' => Status::NEW])->count();
        return $this->render('index', [
            'newOrderCount' => $newOrderCount
        ]);
    }

    public function actionLogout()
    {
        if(!Yii::$app->session->isActive) return $this->goHome();

        Yii::$app->user->logout(true);
        return $this->redirect('/sign-in');
    }

    /**
     * Очистка кеша
     * @return \yii\web\Response
     */
    public function actionClearCache() {
        \Yii::$app->cache->flush();
        addAlert(ALERT_TYPE_SUCCESS, 'Кеш очищен!');
        return $this->redirect('/admin/default/index');
    }

    public function actionError()
    {
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
