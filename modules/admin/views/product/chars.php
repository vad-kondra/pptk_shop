<?php

use app\models\Characteristic;
use app\models\CharacteristicsForm;
use app\models\Product;
use app\models\Value;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $product Product */
/* @var $charForm CharacteristicsForm */
/* @var $newValue Value */


$this->title = 'Характеристики товара: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Характеристики';
?>
<div class="product-price">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
            <div class="box-body">
                <?php $form = ActiveForm::begin()?>
                <?php foreach ($charForm->values as $i => $value): ?>
                    <?php if ($variants = $value->variantsList()): ?>
                        <?= $form->field($value, '[' . $i . ']value')->dropDownList($variants, ['prompt' => '']) ?>
                    <?php else: ?>
                        <?= $form->field($value, '[' . $i . ']value')->textInput() ?>
                    <?php endif ?>
                <?php endforeach; ?>

                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

                <?php $form = ActiveForm::end()?>

            </div>
        </div>
        </div>
    </div>
</div>
