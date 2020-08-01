<?php

/* @var $this yii\web\View */
/* @var $model NewsForm */
/* @var $news News */
/* @var $form yii\widgets\ActiveForm */
/* @var $photoForm PhotoForm */

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'class' => "admin-bread"
];
$this->title = 'Добавление новости';

use app\models\news\News;
use app\models\NewsForm;
use app\models\PhotoForm;
use kartik\datetime\DateTimePicker;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

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
                    <div class="radio-btn-publish-wrapper">
                        <label for="rcpl">
                            <input type="radio" id="rcpl" name="radioCheckPublish" value="1"> Опубликовать сейчас
                        </label>
                        <label for="rcpr">
                            <input type="radio" id="rcpr" name="radioCheckPublish" value="2"> Выбрать дату публикации
                        </label>
                    </div>
                    <div class="sub-check-block" id="block-1">
                        <?= $form->field($model, 'is_public')->checkbox() ?>
                    </div>
                    <div class="sub-check-block" id="block-2" style="display: none;">
                        <div class="date-picker-wrapper">
                            <?= $form->field($model, 'publish_at')->widget(DateTimePicker::class, [
                                'options' => [
                                    'placeholder' => 'Выберите дату',
                                    'autocomplete' => 'off'],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-default">
            <div class="box-body">
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
