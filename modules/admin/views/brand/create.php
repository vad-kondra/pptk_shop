
<?php
/* @var $this yii\web\View */
/* @var $searchModel BrandSearch */
$this->title = 'Добавление производителя';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use app\modules\admin\models\search\BrandSearch;
?>

<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>