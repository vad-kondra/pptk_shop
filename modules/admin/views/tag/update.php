<?php

/* @var $this yii\web\View */
/* @var $tag Tag */
/* @var $model TagForm */

$this->title = 'Редактирование тега: ' . $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tag->name, 'url' => ['view', 'id' => $tag->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

use app\models\Tag;
use app\models\TagForm; ?>
<div class="tag-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
