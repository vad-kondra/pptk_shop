<?php

use app\models\PhotoForm;
use app\models\tech\Tech;
use app\models\TechForm;
use kartik\datetime\DateTimePicker;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model TechForm */
/* @var $techArticles Tech */
/* @var $form yii\widgets\ActiveForm */
/* @var $photoForm PhotoForm */

$this->params['breadcrumbs'][] = ['label' => 'Техническая информация', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'class' => "admin-bread"
];
$this->title = 'Добавление статьи';
?>

<div class="news-create">

    <div class="news-form">
        <?php $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data']
        ]); ?>
        <div class="box box-default">
            <div class="box-header with-border">Общие</div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'short_desc')->textarea(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'body')->widget(CKEditor::class) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-default">
            <div class="box-body">
                <div class="publish-wrapp">
                    <div class="sub-check-block" id="block-1">
                        <?= $form->field($model, 'is_public')->checkbox() ?>
                    </div>
            </div>
        </div>
        </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default">
                            <div class="box-header with-border">Изображение</div>
                            <div class="box-body">
                                <?= $form->field($model->photo, 'image')->fileInput(['multiple' => false])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="box box-default">
            <div class="box-header with-border">SEO</div>
            <div class="box-body">
                <?= $form->field($model->meta, 'title')->textInput() ?>
                <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
                <?= $form->field($model->meta, 'keywords')->textInput() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
