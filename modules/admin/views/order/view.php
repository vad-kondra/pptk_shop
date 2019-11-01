<?php

use app\helpers\OrderHelper;
use app\helpers\PriceHelper;
use app\models\order\Order;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order Order */

$this->title = 'Заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <div class="btn-group" role="group" >
        <?= Html::a('Редактировать', ['update', 'id' => $order->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $order->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данный заказ?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Экспорт в Excel', ['export-excel-order', 'id' => $order->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
    </div>
    <div class="box">
        <div class="box-header">Общие</div>
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $order,
                'attributes' => [
                    'id',
                    'created_at:datetime',
                    [
                        'attribute' => 'current_status',
                        'value' => OrderHelper::statusLabel($order->current_status),
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'user',
                        'value' => function(Order $order) {
                            return !$order->user ? 'Гость' :$order->user->getFullName();
                        }
                    ],
                    'phone',
                    'email',
                    [
                        'attribute' => 'cost',
                        'format' => 'raw',
                        'value' => function(Order $order) {
                            return PriceHelper::format($order->cost);
                        }
                    ],
                    'comment:ntext',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header">Состав заказа</div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0">
                    <thead>
                    <tr>
                        <th class="text-left">Название товара</th>
                        <th class="text-left">Количество в заказе</th>
                        <th class="text-right">Цена за 1 ед.</th>
                        <th class="text-right">Всего</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order->items as $item): ?>
                        <tr>
                            <td class="text-left">
                                <?= Html::encode($item->product->code) ?><br />
                                <?= Html::a(Html::encode($item->product->name), ['product/view', 'id' => $item->product->id], ['target' => '_blank']); ?>
                            </td>
                            <td class="text-left">
                                <?= $item->quantity ?>
                            </td>
                            <td class="text-right"><?= PriceHelper::format($item->price) ?></td>
                            <td class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header">Список статусов заказа</div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0">
                    <thead>
                    <tr>
                        <th class="text-left">Дата</th>
                        <th class="text-left">Кто изменил статус</th>
                        <th class="text-left">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order->statuses as $status): ?>
                        <tr>
                            <td class="text-left">
                                <?= Yii::$app->formatter->asDatetime($status->created_at) ?>
                            </td>
                            <td class="text-left">
                                <?= OrderHelper::userName($status->user_id) ?>
                            </td>
                            <td class="text-left">
                                <?= OrderHelper::statusLabel($status->value) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="btn-group" role="group" >
                <?= Html::a('Оформить', ['processing', 'id' => $order->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Оформить данный заказ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Отменить', ['cancel', 'id' => $order->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите отменить данный заказ?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Завершить', ['complete', 'id' => $order->id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Вы действительно хотите завершить данный заказ?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>


