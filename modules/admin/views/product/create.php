<?php

use app\models\ParseForm;
use app\models\ProductCreateForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ProductCreateForm */
/* @var $parseForm ParseForm */

$this->title = 'Добавление товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-default">
        <div class="box-header with-border">Загрузить товар с ETM</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($parseForm, 'code')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>


    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'art')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'brandId')->widget(Select2::class,[
                        'data' =>$model->brandsList()  ,
                        'size' => Select2::MEDIUM,
                        'options' => ['placeholder' => 'Выберите производителя', 'multiple' => false,'class'=>''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?=$form->field($model, 'is_new')->checkbox() ?>
                    <?=$form->field($model, 'is_sale')->checkbox() ?>
                </div>
            </div>
            <?= $form->field($model, 'description')->widget(CKEditor::class) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Категория</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main')->widget(Select2::class,[
                        'data' =>$model->categories->categoriesList()  ,
                        'size' => Select2::MEDIUM,
                        'options' => ['placeholder' => 'Выберите категорию', 'multiple' => false,'class'=>''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                    <?php if ($form->errorSummary($model->categories)) :?>
                        <p>
                            <?= Html::a('Добавить категорию', ['/admin/category/create'], ['class' => 'btn btn-success', 'target' => '_blank']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Изображение</div>
                <div class="box-body">
                    <?= $form->field($model->photo, 'image')->fileInput(['multiple' => false])->label(false) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Цена</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model->price, 'new')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model->price, 'old')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">SEO</div>
                <div class="box-body">
                    <?= $form->field($model->meta, 'title')->textInput() ?>
                    <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
                    <?= $form->field($model->meta, 'keywords')->textInput() ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Теги</div>
                <div class="box-body">
                    <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                    <?= $form->field($model->tags, 'textNew')->textInput() ?>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
