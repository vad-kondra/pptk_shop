<?php

/* @var $this yii\web\View */
/* @var $model CharacteristicForm */

$this->title = 'Добавление характеристики';
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use app\models\CharacteristicForm; ?>
<div class="characteristic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
