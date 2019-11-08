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


<!-- Shop Page Start -->
<div class="main-shop-page pb-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
            <!-- Sidebar Shopping Option Start -->
            <div class="col-lg-3  order-2">
                <div class="sidebar white-bg">
                    <div class="single-sidebar">
                        <?= $this->render('_subcategories', [
                            'category' => $category
                        ]) ?>
                    </div>
                </div>
            </div>
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-lg-2">
                <div class="sidebar white-bg">
                    <div class="single-sidebar">
                        <div class="group-title">
                            <h2>Поиск</h2>
                        </div>
                        <div>
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

                            <div class="row">
                                <div class="col-md-6">
                                    <?= Html::submitButton('Найти', ['class' => 'return-customer-btn']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= Html::a('Очистить', [''], ['class' => 'return-customer-btn']) ?>
                                </div>
                            </div>

                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
                <?php if ($dataProvider->count == 0 ):?>
                    <?php if ($searchForm->text != '' ):?>
                        <h3>По вашему запросу '<?=Html::encode($searchForm->text)?>' ничего не найдено.</h3>
                    <?php endif;?>
                <?php else: ?>
                    <?= $this->render('_list', [
                        'dataProvider' => $dataProvider
                    ]) ?>

                <?php endif;?>
            </div>
            <!-- product Categorie List End -->
            <!-- Sidebar Shopping Option End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->


