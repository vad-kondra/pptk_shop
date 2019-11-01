<?php

use app\models\BuyersGroup;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BuyersGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы покупателей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-index">

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'value' => function (BuyersGroup $model) {
                        return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                },
                'format' => 'raw',
            ],
            'discount:percent',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
