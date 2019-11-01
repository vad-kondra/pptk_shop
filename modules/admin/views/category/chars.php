<?php


use app\models\CharToCatForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model CharToCatForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Характеристики';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="char-to-category-form">

    <div class="row">
        <div class="col-md-8">
            <div class="box box-default">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'characteristics')->checkboxList($model->characteristicsList()) ?>
                        <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
