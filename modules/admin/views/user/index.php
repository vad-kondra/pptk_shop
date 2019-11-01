<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\userSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];

?>
<div class="user-index">
    <p>
        <?= Html::a( 'Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box">
        <div class="box-body">
            <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered '
                ],

                'columns' => [
                    ['attribute'=>'id',
                        'options'=>['width'=>'100px']
                    ],
                    'username',
                    'email:email',

                    [
                        'attribute' => 'is_confirmed',
                        'filter'=>[false=>"нет",true=>"да"],
                        'value' => function ($model) {
                            return $model->is_confirmed == false ? 'нет' : 'да';
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($model){
                            return getModelDate($model->created_at);
                        }
                    ],
                    [
                        'attribute' => 'role',
                        'options'=>['width'=>'180px'],
                        'filter' => getRolesAsAssoc(),
                        'value' => function($model){
                            return $model->getRoleDesc();
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Действие',
                        'contentOptions' => ['width' => '200px'],
                        //'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{update}{delete}{pricegroup}'),
                        'template' => '{view}{update}{delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>