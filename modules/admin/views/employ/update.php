<?php

use app\models\employ\Employ;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Employ */

$this->title = 'Редактировать информацию сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employ-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
