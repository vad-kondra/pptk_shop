<?php

/* @var $this yii\web\View */
/* @var $characteristic  Characteristic */
/* @var $model CharacteristicForm */

$this->title = 'Изменить характеристику: ' . $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $characteristic->name, 'url' => ['view', 'id' => $characteristic->id]];
$this->params['breadcrumbs'][] = 'Update';

use app\models\Characteristic;
use app\models\CharacteristicForm; ?>
<div class="characteristic-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
