<?php


/* @var $this yii\web\View */
/* @var $brand Brand */
$this->title = 'Производитель: '.$brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use app\models\Brand;
use yii\helpers\Html;
use yii\widgets\DetailView; ?>
<div class="user-view">

    <h2><?= Html::encode($this->title ) ?></h2>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $brand->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $brand->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Подтвердите действие',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Общие</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $brand,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $brand,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>
</div>