<?php

use app\models\Category;
use app\modules\admin\models\search\CategorySearch;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обратный звонок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box">
        <div class="box-body">
           <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'name',
                    'email',
                    'phone',
                    'created_at:datetime',
                    [
                        'attribute' => 'status',
                        'value' => function (\app\models\CallBack $model) {
                            return $model->getStatusAsLabel();
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
