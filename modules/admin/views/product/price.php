<?php

use app\models\PriceForm;
use app\models\Product;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $product Product */
/* @var $model PriceForm */

$this->title = 'Цена товара #ID'.$product->id;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Цена';
?>
<div class="product-price">



    <div class="row">
        <div class="col-md-5">
            <div class="box box-default">
                <div class="box-header with-border"><?=$this->title?></div>
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-6">

                            <?= $form->field($model, 'new')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'old')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>


<!--                    --><?php //Modal::begin([
//                        'header' => '<h2>Текущая цена на сайте ETM</h2>',
//                        'toggleButton' => ['label' => 'Посмотреть цену с ETM'],
//                        'size' => 'modal-lg'
//                    ]); ?>
<!---->
<!---->
<!---->
<!--                    --><?php //Modal::end() ?>
                </div>
            </div>
        </div>
    </div>



</div>
