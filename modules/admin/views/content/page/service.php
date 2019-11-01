<?php

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-area-admin">
    <h3><?=t_app('Количество товаров')?></h3>
    <?php $form = \yii\bootstrap\ActiveForm::begin() ?>
    <div class="row mb-5">
        <div class="col-md-3">
            <p class="text-center"><?=t_app('Бесплатный')?></p>
            <?=$form->field($model, 'prod_free')->label(false)?>
        </div>
        <div class="col-md-3">
            <p class="text-center"><?=t_app('Стандартный')?></p>
            <?=$form->field($model, 'prod_standard')->label(false)?>
        </div>
        <div class="col-md-3">
            <p class="text-center"><?=t_app('Премиум')?></p>
            <?=$form->field($model, 'prod_premium')->label(false)?>
        </div>
    </div>

    <h3><?=t_app('Стоимость')?></h3>
    <div class="row">
        <div class="col-md-3">
            <p class="text-center"><?=t_app('Бесплатный')?></p>
            <?=$form->field($model, 'price_free')->label(false)?>
        </div>
        <div class="col-md-3">
            <p class="text-center"><?=t_app('Стандартный')?></p>
            <?=$form->field($model, 'price_standard')->label(false)?>
        </div>
        <div class="col-md-3">
            <p class="text-center"><?=t_app('Премиум')?></p>
            <?=$form->field($model, 'price_premium')->label(false)?>
        </div>
    </div>
    <?=\yii\helpers\Html::submitButton(t_app('Сохранить'), ['class'=>'btn btn-success'])?>
    <?php $form = \yii\bootstrap\ActiveForm::end() ?>
</div>
