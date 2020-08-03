<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employ-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
