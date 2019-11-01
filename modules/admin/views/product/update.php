<?php

use app\models\Product;
use app\models\ProductEditForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $product Product */
/* @var $model ProductEditForm */

$this->title = 'Редактирование товара #ID' . $product->id;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="product-update">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-md-12">
                       <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4">
                       <?= $form->field($model, 'brandId')->dropDownList($model->brandsList()) ?>
                   </div>
                   <div class="col-md-2">
                       <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-md-2">
                       <?= $form->field($model, 'art')->textInput(['maxlength' => true]) ?>
                   </div>
                   <div class="col-md-4">
                       <?=$form->field($model, 'is_new')->checkbox() ?>
                       <?=$form->field($model, 'is_sale')->checkbox() ?>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <?= $form->field($model->categories, 'main')->dropDownList($model->categories->categoriesList(), ['prompt' => '']) ?>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <?= $form->field($model, 'description')->widget(CKEditor::className()) ?>
                   </div>
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
