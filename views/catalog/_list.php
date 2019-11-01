<?php

/* @var $this yii\web\View */
/* @var $dataProvider DataProviderInterface */

use yii\data\DataProviderInterface;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="container-fluid">
    <?php if ($dataProvider->count > 0): ?>
        <div class="row catalog-filter">
            <div class="col-md-6 col-sm-6 hidden-xs">
                <div class="btn-group btn-group-sm">
                    <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Плитка"><i class="fa fa-th"></i></button>
                    <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="Список"><i class="fa fa-th-list"></i></button>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="form-group input-group ">
                    <label class="input-group-addon" for="input-sort">Cортировка:</label>
                    <select id="input-sort" onchange="location = this.value;">
                        <?php
                        $values = [
                            '' => 'По умолчанию',
                            'name' => 'По названию (А - Я)',
                            '-name' => 'По названию (Я - А)',
                            'price' => 'По возрастанию цены',
                            '-price' => 'По убыванию цены',
                        ];
                        $current = Yii::$app->request->get('sort');
                        ?>
                        <?php foreach ($values as $value => $label): ?>
                            <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-xs-6">
                <div class="form-group input-group ">
                    <label class="input-group-addon" for="input-limit">Вывести по:</label>
                    <select id="input-limit" onchange="location = this.value;">
                        <?php
                        $values = [15, 18, 25, 50, 75, 100];
                        $current = $dataProvider->getPagination()->getPageSize(); ?>
                        <?php foreach ($values as $value): ?>
                            <option value="<?= Html::encode(Url::current(['per-page' => $value])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="product-listing">
            <div class="inner-listing">
                <div class="row">
                    <ul>
                        <?php foreach ($dataProvider->getModels() as $product): ?>
                            <?= $this->render('_product', [
                                'product' => $product
                            ]) ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <?= LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                        ]) ?>
                    </div>
                    <div class="col-sm-6 text-right">Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row product-listing-empty">
            <div class="inner-listing">
                <div class="row">
                    <p align="center">Результатов не найдено.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

