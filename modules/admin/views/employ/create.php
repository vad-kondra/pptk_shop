<?php

use app\models\employ\Employ;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Employ */

$this->title = 'Добавить сотрудника';
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="employ-wrap" style="max-width: 600px; margin-left: 15px; margin-right: 15px">
        <div class="employ-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
</div>

