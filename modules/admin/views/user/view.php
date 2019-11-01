<?php

use app\models\user\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model User */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];
//$canDelete = \mdm\admin\components\Helper::checkRoute('/admin/user/delete');
//$canUpdate = \mdm\admin\components\Helper::checkRoute('/admin/user/update');
?>
<div class="user-view">

    <div class="btn-group">

      <!--  <?php
/*        $roles = ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($model->id),"name");
        if(in_array("admin",$roles) ||  in_array("designer",$roles))
            echo  Html::a(t_app('Просмотр продаж'), ['/admin/designer/sale', 'id' => $model->id], ['class' => 'btn btn-info','target'=>"_blank"]);
        */?>
        <?php /*if( $canUpdate ){*/?>
            <?/*= Html::a(t_app('Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        --><?php /*} */?>

       <!-- --><?php /*if( $canDelete ){*/?>

        <?php /*} */?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">Общая информация</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'username',
                            'email:email',
                            [
                                'attribute' => 'group',
                                'value' => function($data){return $data->group->name;}
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => function($data){return getModelDate($data->created_at);}
                            ],
                            'phone',
                            [
                                'attribute' => 'is_confirmed',
                                'value' => function ($data) {return $data->is_confirmed ? 'Да' : 'Нет';},
                            ],
                            [
                                'attribute' => 'role',
                                'value' => function ($data) {return $data->getRoleDesc();},
                            ],
                        ],
                    ]) ?>
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => 'Подтвердите действие','method' => 'post',],]) ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">Дополнительная информация</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'l_name',
                            'f_name',
                            'p_name',
                            'company',
                            'city',
                            'address',
                            'post_index',
                        ],
                    ]) ?>
                    <?= Html::a('Редактировать', \yii\helpers\Url::to(['personal', 'id' => $model->id]), ['class' => 'btn btn-primary']) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

</div>
