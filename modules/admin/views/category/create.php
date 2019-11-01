<?php

/* @var $this yii\web\View */
/* @var $model CategoryForm */

$this->title = 'Добавление категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use app\models\CategoryForm; ?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
