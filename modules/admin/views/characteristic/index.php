<?php

use app\helpers\CharacteristicHelper;
use app\models\Characteristic;
use app\modules\admin\models\search\CharacteristicSearch;

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel  CharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Характеристики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="box">
        <div class="box-body">
            <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'value' => function (Characteristic $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'type',
                        'filter' => $searchModel->typesList(),
                        'value' => function (Characteristic $model) {
                            return CharacteristicHelper::typeName($model->type);
                        },
                    ],
                    [
                        'attribute' => 'required',
                        'filter' => $searchModel->requiredList(),
                        'format' => 'boolean',
                    ],
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
