<?php

use app\models\category\CategoryProduct;
use app\models\order\Order;
use app\models\OrderEditForm;
use app\models\user\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $order Order */
/* @var $model OrderEditForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model->customer, 'f_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->customer, 'l_name')->textInput(['maxlength' => true]) ?>


    <div class="col-3 pl-0">
            <?= $form->field($model->customer, "phone")->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+38 (099) 999-9999',
                'clientOptions' => [
                    'clearIncomplete'=>true
                ]
            ])?>
    </div>

    <?= $form->field($model->customer, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->customer, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->customer, 'post_index')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->customer, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
