<?php

use app\models\employ\Employ;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Employ */

$this->title = 'Create Employ';
$this->params['breadcrumbs'][] = ['label' => 'Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employ-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
