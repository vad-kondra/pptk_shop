<?php


namespace app\modules\admin\controllers;


use app\models\CallBack;
use app\models\news\News;
use app\modules\admin\models\search\CategorySearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class CallbackController extends Controller
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => CallBack::find(),
            'pagination' => [
                'pageSize' => 15
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}