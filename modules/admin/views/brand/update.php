<?php


/* @var $this yii\web\View */
/* @var $brand Brand */
/* @var $model BrandForm */
$this->title = 'Редактирование производителя: ' . $brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

use app\models\Brand;
use app\models\BrandForm; ?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>