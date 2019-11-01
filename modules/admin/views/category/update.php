<?php

/* @var $this yii\web\View */
/* @var $category Category */
/* @var $model CategoryForm */

$this->title = 'Редактирование категории: ' . $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

use app\models\Category;
use app\models\CategoryForm; ?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
