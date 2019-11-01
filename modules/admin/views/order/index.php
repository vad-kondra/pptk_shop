<?php

use app\helpers\OrderHelper;
use app\models\order\Order;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label'=> $this->title
] ;
?>
<div class="order-index">
    <div class="box">
        <div class="box-body">

            <?php
            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn',
                    'options' => ['width' => '30']],
                [
                    'attribute' => 'id',
                    'options' => ['width' => '100']
                ],
                [
                    'attribute' => 'qty',
                    'label' => 'Кол-во',
                    'format' => 'raw',
                    'contentOptions' => [ 'width' => 100],
                    'value' => function($model) {
                        return count($model->items);
                    }
                ],
                [
                    'attribute' => 'cost',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-right', 'width' => 100]
                ],
                [
                    'attribute' => 'created_at',
                    'value' => function($model){
                        return getModelDate($model->created_at);
                    },
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function(Order $model) {
                        return !$model->user ? 'Гость' : $model->user->username;
                    },
                ],
                [
                    'attribute' => 'current_status',
                    'filter' => $searchModel->statusList(),
                    'value' => function (Order $model) {
                        return OrderHelper::statusLabel($model->current_status);
                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center']
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ];
            ?>

            <?=ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns
            ]); ?>


            <?=\kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns
            ]); ?>


        </div>
    </div>

</div>
