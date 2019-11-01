<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Изменить группу для: '.$user->username;
$this->params['breadcrumbs'][] = ['label' => 'Группы покупателей', 'url' => ['/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id]];
$this->params['breadcrumbs'][] =  [
	'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
	'label' => $this->title
];

?>

<div class=>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($user, 'group')->dropDownList($user->buyerGroupsList()) ?>

                    <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


