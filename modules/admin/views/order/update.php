<?php


use app\models\order\Order;
use app\models\OrderEditForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $order Order */
/* @var $model OrderEditForm */


$this->title = 'Редактирование заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-update">


    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Информация о заказчике</div>
                <div class="box-body">

                    <?= $form->field($model->customer, 'f_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model->customer, 'l_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model->customer, "phone")->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+38 (099) 999-9999',
                        'clientOptions' => [
                            'clearIncomplete'=>true
                        ]
                    ])?>

                    <?= $form->field($model->customer, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model->customer, 'city')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model->customer, 'post_index')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model->customer, 'address')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Комментарии</div>
                <div class="box-body">
                    <?= $form->field($model, 'comment')->textarea(['rows' => 3])->label(false) ?>
                </div>
            </div>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

		<?php ActiveForm::end(); ?>

</div>
