<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $searchForm SearchForm */
/* @var $category app\models\Category */

use app\models\search\SearchForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Поиск';

$this->params['breadcrumbs'][] = $this->title;
?>

<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 mb-sm-30 col-lgmd-20per">
                <div class="sidebar-block">
                    <?= $this->render('_subcategories', [
                        'category' => $category
                    ]) ?>
                </div>
            </div>

            <div class="col-lg-10 col-md-9 col-lgmd-80per">

                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                            <div class="panel-body">
                                <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get']) ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?= $form->field($searchForm, 'text')->textInput() ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($searchForm, 'category')->dropDownList($searchForm->categoriesList(), ['prompt' => '']) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($searchForm, 'brand')->dropDownList($searchForm->brandsList(), ['prompt' => '']) ?>
                                    </div>
                                </div>
                                <!---->
                                <!--                        --><?php //if (count($searchForm->values) > 0): ?>
                                <!--                            <h4>Атрибуты</h4>-->
                                <!--                            --><?php //foreach ($searchForm->values as $i => $value): ?>
                                <!--                                <div class="row">-->
                                <!--                                    <div class="col-md-2">-->
                                <!--                                        --><?//= Html::encode($value->getCharacteristicName()) ?>
                                <!--                                    </div>-->
                                <!--                                    --><?php //if (($variants = $value->variantsList()) && $value->isString()): ?>
                                <!--                                        <div class="col-md-6">-->
                                <!--                                            --><?//= $form->field($value, '[' . $i . ']equal')->dropDownList($variants, ['prompt' => 'Выберите значение'])->label(false) ?>
                                <!--                                        </div>-->
                                <!--                                    --><?php //elseif ($value->isAttributeSafe('from') && $value->isAttributeSafe('to')): ?>
                                <!--                                        <div class="col-md-3">-->
                                <!--                                            --><?//= $form->field($value, '[' . $i . ']from', ['inputOptions' => [
                                //                                                'placeholder' => 'от',
                                //                                            ],])->textInput()->label(false) ?>
                                <!--                                        </div>-->
                                <!--                                        <div class="col-md-3">-->
                                <!--                                            --><?//= $form->field($value, '[' . $i . ']to', ['inputOptions' => [
                                //                                                'placeholder' => 'до',
                                //                                            ],])->textInput()->label(false) ?>
                                <!--                                        </div>-->
                                <!--                                    --><?php //endif ?>
                                <!--                                </div>-->
                                <!--                            --><?php //endforeach; ?>
                                <!--                        --><?php //endif;?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?= Html::submitButton('Найти', ['class' => 'btn btn-color btn-lg btn-block']) ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= Html::a('Очистить', [''], ['class' => 'btn btn-default btn-lg btn-block']) ?>
                                    </div>
                                </div>

                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($dataProvider->count == 0 ):?>
                    <?php if ($searchForm->text != '' ):?>
                        <h3 align="center">По вашему запросу '<?=Html::encode($searchForm->text)?>' ничего не найдено.</h3>
                    <?php endif;?>
                <?php else: ?>
                    <?= $this->render('_list', [
                        'dataProvider' => $dataProvider
                    ]) ?>

                <?php endif;?>
            </div>
        </div>
    </div>
</section>