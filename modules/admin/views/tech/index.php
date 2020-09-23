<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Техническая информация';
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];
?>
<div class="news-index">
    <div class="box">
        <div class="box-body">
            <?= Html::a( 'Добавить', ['create'], ['class' => 'btn btn-success']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    [
                        'attribute' => 'created_at',
                        'value' => function($model){
                            return getModelDate($model->created_at);
                        }
                    ],
                    [
                        'attribute' => 'is_public',
                        'value' => function ($data) { // $data represents user object
                            return $data->is_public ? 'Да': 'Нет';
                        },
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Действие',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

