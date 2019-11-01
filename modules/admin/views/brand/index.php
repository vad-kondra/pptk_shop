<?php



/* @var $this yii\web\View */
/* @var $searchModel BrandSearch */
/* @var $dataProvider ActiveDataProvider */
$this->title = 'Производители';
$this->params['breadcrumbs'][] = $this->title;

use app\models\Brand;
use app\modules\admin\models\search\BrandSearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html; ?>
<div class="user-index">

    <p>
        <?= Html::a('Добавить производителя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'value' => function (Brand $model) {
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    'slug',
                    ['class' => ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>