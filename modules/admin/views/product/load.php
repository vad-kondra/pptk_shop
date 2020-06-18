<?php

use app\modules\admin\models\ProductLoadForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\web\View;

/* @var $this View */
/* @var $model ProductLoadForm */

$this->title = 'Добавление товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<tr class="product-create">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="box box-default">
    <div class="box-header with-border">Загрузить товары с файла</div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

