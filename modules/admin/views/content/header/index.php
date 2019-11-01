
<?php
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

$form = \yii\bootstrap\ActiveForm::begin() ?>

<div class="row">
    <div class="col-md-8">
        <p>Header <?=t_app('лого')?></p>
        <?=$form->field($model, 'img_h')->fileInput(['multiple' => false])->label(false)?>
    </div>
    <div class="col-md-4">
        <img style="max-width: 100%;" src="/<?= \app\models\Config::getValue(\app\models\Config::HEADER_LOGO_IMG) ?>" alt="">
    </div>
</div>
<div class="mb-4 pb-4">
    <?=$form->field($model, 'href_h')->textInput(['value'=> \app\models\Config::getValue(\app\models\Config::HEADER_LOGO_HREF)])->label(t_app('Ссылка'))?>
</div>

<div class="row mt-4 pb-4">
    <div class="col-md-12 text-center">
        <img src="/<?=\app\models\Config::getValue(\app\models\Config::BANNER_BODY_IMG)?>" alt="banner image" style="max-width: 100%;">
    </div>
    <div class="col-md-12">
        <p><?=t_app('Изображение баннера')?></p>
        <?=$form->field($model, 'banner_body_img')->fileInput(['multiple'=>false])->label(false)?>
    </div>
</div>

<?=$form->field($model, 'f_phone')->textInput()?>
<?=$form->field($model, 'f_email')->textInput()?>

<?=\yii\helpers\Html::submitButton(t_app('Сохранить'), ['class' => 'btn btn-success'])?>
<?php $form = \yii\bootstrap\ActiveForm::end() ?>