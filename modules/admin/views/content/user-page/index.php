<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\UserpageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-page-index">

    <h1><?= Html::encode($this->title ) ?><sup> <span class="badge badge-info"> <?=getDataProviderCountItemHint($dataProvider) ?></span></sup></h1>

    <p>
        <?= Html::a(t_app('Создать'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center'
        ],
        'columns' => [
            'name',
            [
                'attribute' => 'href',
                'format' => 'raw',
                'value' => function($model){
                    $url = \yii\helpers\Url::to([\app\models\page\UserPage::HREF_PREFIX.$model->href],true);
                    return \yii\helpers\Html::a($url ,$url ,["target"=>"_blank"]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => t_app('Действие'),
                'template' => '{update-content}{update}{delete}',
                'buttons' => [
                    'update-content' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['/admin/content/page/user-page','page'=>$model->href], ['target'=>'_blank', 'title' => t_app('Редактировать содержание')]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
