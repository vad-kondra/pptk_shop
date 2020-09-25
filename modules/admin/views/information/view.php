<?php

use app\models\PhotoForm;
use app\models\tech\Information;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Information */
/* @var $photoForm PhotoForm */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Техническая информация', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];

?>
<div class="news-view">
    <div class="row">
        <div class="col-md-6">
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Подтвердите действие', 'method' => 'post',]]) ?>
            <?= Html::a('На сайте', Url::to(['/news', 'id'=>$model->id]), ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Общие</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title',
                            'created_at:datetime',
                            'author.username',
                            [
                                'attribute' => 'is_public',
                                'value' => function($data) {return $data->is_public ? 'Да':'Нет';} ,
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Изображение</div>
                <div class="box-body">
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype'=>'multipart/form-data'],
                    ]); ?>

                    <?php if(empty($model->photo)){ ?>
                        <?=$form->field($photoForm, 'image')->fileInput(['multiple' => false])->label(false)?>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-md-8">
                                <?=$form->field($photoForm, 'image')->fileInput(['multiple' => false])->label(false)?>
                            </div>
                            <div class="col-md-4">
                                <div class="float-right">
                                    <a href="/<?=$model->photo->img_src ?>" target="_blank">
                                        <?=Html::img('/'.$model->photo->img_src, ['width' => '150', 'height' => '100', 'class' => 'image-mini'])?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div><div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">Краткое описание</div>
                <div class="box-body">
                    <?= $model->short_desc ?>
                </div>
            </div>
        </div>
    </div></div><div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">Детальное описание</div>
            <div class="box-body">
                <?= $model->body ?>
            </div>
        </div>
    </div>
</div>
</div>
