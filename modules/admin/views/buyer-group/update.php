<?php

use app\modules\admin\models\BuyerGroupForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model BuyerGroupForm */
/* @var $group app\models\BuyersGroup */

$this->title = 'Редактирование группы: ' . $group->name;
$this->params['breadcrumbs'][] = ['label' => 'Группа покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $group->name, 'url' => ['view', 'id' => $group->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="user-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
