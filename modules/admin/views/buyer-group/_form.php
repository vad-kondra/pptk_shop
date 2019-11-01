<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BuyersGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-group-form">
   <div class="row">
       <div class="col-md-6">
           <div class="box box-primary">
               <div class="box-header with-border">Общие</div>
               <div class="box-body">
                   <?php $form = ActiveForm::begin(); ?>
                   <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                   <?= $form->field($model, 'discount')->textInput() ?>
                   <div class="form-group">
                       <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                   </div>
                   <?php ActiveForm::end(); ?>
               </div>
           </div>
       </div>
   </div>
</div>

