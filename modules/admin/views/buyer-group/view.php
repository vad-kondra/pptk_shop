<?php

use app\modules\admin\models\search\UserSearch;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BuyersGroup */
/* @var $searchModel UserSearch */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-group-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данную группу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">Общие</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            'discount:percent',
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">Пользователи группы</div>
                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'layout' => '{items}{pager}',
                        'tableOptions' => [
                            'class' => 'table table-striped table-bordered text-center'
                        ],

                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'f_name',
                            'l_name',
                            'email:email',
                            'phone',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{changeGroup}',
                                'buttons' => [
                                    'changeGroup' => function ($url, $model) {
                                        return Html::a('Изменить группу <span class="glyphicon glyphicon-cog"></span>',
                                            ['/admin/buyer-group/change-group/', 'id' => $model->id], ['class' => 'btn btn-primary']
                                        );
                                    },
                                ],
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>
