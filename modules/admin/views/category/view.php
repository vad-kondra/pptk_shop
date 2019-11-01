<?php

use app\models\Category;
use app\models\Characteristic;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $category  Category */

$this->title = $category->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="btn-group" role="group" >
        <?= Html::a('Редактировать', ['update', 'id' => $category->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $category->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Подтвердите действие', 'method' => 'post',]]) ?>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">Общие</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $category,
                        'attributes' => [
                            'id',
                            'name',
                            'slug',
                            'title',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">SEO</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $category,
                        'attributes' => [
                            'meta.title',
                            'meta.description',
                            'meta.keywords',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="box">
        <div class="box-header with-border">Описание</div>
        <div class="box-body">
            <?= Yii::$app->formatter->asHtml($category->description, [
                'Attr.AllowedRel' => array('nofollow'),
                'HTML.SafeObject' => true,
                'Output.FlashCompat' => true,
                'HTML.SafeIframe' => true,
                'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
            ]) ?>
        </div>
    </div>


</div>
