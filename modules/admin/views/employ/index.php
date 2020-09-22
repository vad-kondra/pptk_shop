<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employ-index">

    <p>
        <?= Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'department.title',
            'surname',
            'name',
            'first_name',
            'position',
            'tel_1',
            'tel_2',
            'email:email',
            'skype',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
