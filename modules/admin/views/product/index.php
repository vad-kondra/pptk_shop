<?php

use app\helpers\PriceHelper;
use app\helpers\ProductHelper;
use app\models\Product;
use app\modules\admin\models\search\ProductSearch;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
//                'rowOptions' => function (Product $model) {
//                    return $model->quantity <= 0 ? ['style' => 'background: #fdc'] : [];
//                },
                'columns' => [
                    [
                        'label' => 'Изображение',
                        'value' => function (Product $model) {
                            return $model->photo ?
                                Html::img("/".$model->photo->img_src, ['width' => '70', 'height' => '70']) :
                                Html::img('/images/empty-img.png', [
                                        'width' => '70',
                                        'height' => '70'
                                ]) ;
                        },
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'width: 100px'],
                    ],
                    'code',
                    'art',
                    [
                        'attribute' => 'name',
                        'value' => function (Product $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'filter' => $searchModel->categoriesList(),
                        'value' => 'category.name',
                    ],
                    [
                        'attribute' => 'price_new',
                        'format' => 'raw',
                        'value' => function (Product $model) {
                            return PriceHelper::format($model->price_new);
                        },
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-right', 'width' => 150]
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => $searchModel->statusList(),
                        'value' => function (Product $model) {
                            return ProductHelper::statusLabel($model->status);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
