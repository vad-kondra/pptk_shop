<?php

use app\models\Value;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $newValue Value */
/* @var $product \app\models\Product */


$this->title = 'Добавление характеристики к товару';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Характеристики';
?>
<div class="product-addChar">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <?php $form = ActiveForm::begin()?>

                    <?= $form->field($newValue, 'characteristic_id')->widget(Select2::class,[
                        'data' =>$newValue->charList()  ,
                        'size' => Select2::MEDIUM,
                        'options' => ['placeholder' => 'Выберите характеристику', 'multiple' => false],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]])
                        ->label('Название характеристики');
                    ?>
                    <?=$form->field($newValue, 'value')->textInput(); ?>

                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Добавить новую хар-ку', ['/admin/characteristic/create'], ['class' => 'btn btn-primary']) ?>

                    <?php $form = ActiveForm::end()?>



                </div>
            </div>
        </div>
    </div>
</div>
