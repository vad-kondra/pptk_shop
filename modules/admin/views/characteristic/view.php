<?php

use app\helpers\CharacteristicHelper;
use app\models\Characteristic;

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $characteristic Characteristic */

$this->title = $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $characteristic->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $characteristic->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данную характеристику?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $characteristic,
                'attributes' => [
                    'id',
                    'name',
                    [
                        'attribute' => 'type',
                        'value' => CharacteristicHelper::typeName($characteristic->type),
                    ],
                    'sort',
                    'required:boolean',
                    'default',
                    [
                        'attribute' => 'variants',
                        'value' => implode(PHP_EOL, $characteristic->variants),
                        'format' => 'ntext',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
