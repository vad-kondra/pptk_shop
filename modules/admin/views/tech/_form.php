<?php

use app\models\tech\Tech;
use app\models\TechForm;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model TechForm */
/* @var $techArticles Tech */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="box box-default">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'short_desc')->textarea(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'body')->widget(CKEditor::class) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">Изображение</div>
        <div class="box-body">
            <?php if(empty($techArticles->photo)){ ?>
                <?=$form->field($model->photo, 'image')->fileInput(['multiple' => false])->label(false)?>
            <?php }else{ ?>
                <div class="row">
                    <div class="col-md-8">
                        <?=$form->field($model->photo, 'image')->fileInput(['multiple' => false])->label(false)?>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right">
                            <a href="/<?=$techArticles->photo->img_src ?>" target="_blank">
                                <?=Html::img('/'.$techArticles->photo->img_src, ['width' => '150', 'height' => '100', 'class' => 'image-mini'])?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'is_public')->checkbox() ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput() ?>
            <?= $form->field($model->meta, 'description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
