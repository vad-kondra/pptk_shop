<?php

use app\helpers\PriceHelper;
use app\helpers\ProductHelper;
use app\models\Characteristic;
use app\models\CharacteristicsForm;
use app\models\PhotoForm;
use app\models\Product;
use app\models\Value;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $product Product */
/* @var $photoForm PhotoForm */
/* @var $charForm CharacteristicsForm */
/* @var $newValue \app\models\ValueForm */
/* @var $modificationsProvider yii\data\ActiveDataProvider */

$this->title = 'Товар #ID'.$product->id;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="btn-group" role="group" >
        <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данный товар?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($product->isActive()): ?>
            <?= Html::a('В черновики', ['draft', 'id' => $product->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Активировать', ['activate', 'id' => $product->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Общие</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            'name',
                            [
                                'attribute' => 'status',
                                'value' => ProductHelper::statusLabel($product->status),
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'brand_id',
                                'value' => ArrayHelper::getValue($product, 'brand.name'),
                            ],
                            'code',
                            'art',
                            [
                                'attribute' => 'category_id',
                                'value' => ArrayHelper::getValue($product, 'category.name'),
                            ],
                            [
                                'label' => 'Теги',
                                'value' => implode(', ', ArrayHelper::getColumn($product->tags, 'name')),
                            ],
                            [
                                'attribute' => 'price_new',
                                'format' => 'raw',
                                'value' => PriceHelper::format($product->price_new),
                            ],
                            [
                                'attribute' => 'price_old',
                                'format' => 'raw',
                                'value' => PriceHelper::format($product->price_old),
                            ],
                            [
                                'attribute' => 'is_new',
                                'format' => 'raw',
                                'value' => function(Product $product) {
                                    return $product->is_new ? 'Да' : 'Нет';
                                }
                            ],
                            [
                                'attribute' => 'is_sale',
                                'format' => 'raw',
                                'value' => function(Product $product) {
                                    return $product->is_sale ? 'Да' : 'Нет';
                                }
                            ],


                        ],
                    ]) ?>
                    <br />
                    <p>
                        <?= Html::a('Изменить цену', ['price', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">Изображениe</div>
                <div class="box-body">

                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype'=>'multipart/form-data'],
                    ]); ?>

                    <?php if(empty($product->photo)){ ?>
                        <?=$form->field($photoForm, 'image')->fileInput(['multiple' => false])->label(false)?>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="col-md-8">
                                <?=$form->field($photoForm, 'image')->fileInput(['multiple' => false])->label(false)?>
                            </div>
                            <div class="col-md-4">
                                <div class="float-right">
                                    <?= Yii::$app->thumbnail->img($product->photo->img_src, [
                                        'thumbnail' => [
                                            'width' => 150,
                                            'height' => 150,
                                        ],
                                        'placeholder' => [
                                            'width' => 100,
                                            'height' => 100
                                        ]
                                    ]); ?>

                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">SEO</div>
                <div class="box-body">
                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            [
                                'attribute' => 'meta.title',
                                'value' => $product->meta->title,
                            ],
                            [
                                'attribute' => 'meta.description',
                                'value' => $product->meta->description,
                            ],
                            [
                                'attribute' => 'meta.keywords',
                                'value' => $product->meta->keywords,
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Характеристики</div>
                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => new \yii\data\ActiveDataProvider([
                            'query' => $product->getValues(),
                        ]),
                        'columns' => [
                            'characteristic.name',
                            'value',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{remove}',
                                'buttons' => [
                                        'remove' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                                ['remove-char', 'id' => $model->id]);
                                        },
                                ]
                            ]
                        ],
                    ]) ?>
                    <p>
                        <?php if (count($product->getValues()->all()) > 0): ?>
                            <?= Html::a('Изменить х-ки', ['chars', 'id' => $product->id], ['class' => 'btn btn-success']) ?>
                        <?php endif; ?>
                        <?= Html::a('Добавить', ['add-char', 'id' => $product->id], ['class' => 'btn btn-success']) ?>

                    </p>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Описание</div>
                <div class="box-body">
                <?= Yii::$app->formatter->asHtml($product->description, [
                    'Attr.AllowedRel' => array('nofollow'),
                    'HTML.SafeObject' => true,
                    'Output.FlashCompat' => true,
                    'HTML.SafeIframe' => true,
                    'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


