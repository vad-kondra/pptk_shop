<?php

use app\models\user\User;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\order\Order */

$this->title = 'Создание заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="order-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col col-md-6">
                <?= $form->field($model, 'user_id')->widget(Select2::className(),[
                    'data' =>ArrayHelper::map(User::find()->orderBy(['username'=>SORT_ASC])->all(),"id","username")  ,
                    //'size' => Select2::LARGE,
                    'options' => ['placeholder' => 'Выберите пользователя', 'multiple' => false,'class'=>''],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])?>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-6">
                <?= $form->field($model, 'f_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col col-md-6">
                <?= $form->field($model, 'l_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>


        <div class="row">
            <div class="col col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col col-md-6">
                <?= $form->field($model, "phone")->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '+38 (099) 999-9999',
                    'clientOptions' => [
                        'clearIncomplete'=>true
                    ],

                ])?>
            </div>
        </div>

        <div class="row">
            <div class="col ">
                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col ">
                <?= $form->field($model, 'post_index')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>


