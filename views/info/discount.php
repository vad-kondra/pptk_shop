<?php

use app\widgets\CLinkPager;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];
?>

<div id="discount" class="content">
    <div class="container">
        <h1 class="title"><?=$title?></h1>
        <form action="" method="get" id="filterProductForm">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 comp">
                    <div class="filter collapse <?=sizeof($_GET)>=1?"show":''?>" id="productFilters">
                        <!--<input type="hidden" name="category" value="<?/*=Yii::$app->request->get("category")*/?>">-->
                        <ul>
                            <li>
                                <a href="#collapse0" role="button" class="d-block filter-link " data-toggle="collapse" aria-expanded="true" aria-controls="collapse0">
                                    <strong><?=t_app('Цена')?></strong>
                                    <i class="fas fa-chevron-down float-right"></i>
                                </a>
                                <div id="collapse0" class="filter_block collapse show">
                                    <div class="filter_number">
                                        <div class="number" data-min="0" data-max="<?=$maxPriceSlider?>">
                                            <input type="text" name="price_min" class="lower ui-border block-1" value="<?=$minPrice ?>">
                                            <span class="dash">-</span>
                                            <input type="text" name="price_max" class="upper ui-border block-1" value="<?= $maxPrice ?>">
                                            <span class="pl-10">грн.</span>
                                        </div>
                                        <div class="slider-range" id="filter_range_price1"></div>
                                    </div>
                                </div>
                            </li>
                            <?php if( !empty($producers) ){?>
                                <li>
                                    <?PHP
                                    $param = Yii::$app->request->get("p",[]);
                                    $isProducerCollapsed = $param ? '':'collapsed';
                                    $isProducerShow = $param?'show':'';
                                    ?>
                                    <a href="#collapseP" role="button" class="d-block filter-link <?=$isProducerCollapsed?>" data-toggle="collapse" aria-expanded="true" aria-controls="collapseP">
                                        <strong><?=t_app('Производитель')?></strong>
                                        <i class="fas fa-chevron-down float-right"></i>
                                    </a>
                                    <div id="collapseP" class="filter_block collapse <?=$isProducerShow?>">
                                        <div class="filter_dot">
                                            <?php foreach ($producers as $val){?>
                                                <input type="checkbox" name="p[]" id="val_<?=$val?>" class="checkbox" <?=in_array($val,$param)?"checked":""?>
                                                       value="<?=$val?>">
                                                <label for="val_<?=$val?>"><?=$val?></label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <li>
                                <?PHP
                                $param = Yii::$app->request->get("country");
                                $isCountryCollapsed = $param ? '':'collapsed';
                                $isCountryShow = $param?'show':'';
                                ?>
                                <a href="#collapseCountry" role="button" class="d-block filter-link <?=$isCountryCollapsed?>" data-toggle="collapse" aria-expanded="true" aria-controls="collapseCountry">
                                    <strong><?=t_app('Страна производства')?></strong>
                                    <i class="fas fa-chevron-down float-right"></i>
                                </a>
                                <div id="collapseCountry" class="filter_block collapse <?=$isCountryShow?>">
                                    <div class="sort_down">
                                        <div class="select-wrap">
                                            <select name="country" class="filter-products-select">
                                                <?php
                                                $country = isset($_GET['country']) ? $_GET['country']:'';?>
                                                    <option <?=empty($country)?'selected':''?> value='0'></option>
                                                    <?php
                                                    foreach ($countryList as $countryEl) { ?>
                                                        <option <?= $country == $countryEl ? 'selected' : '' ?>
                                                                value="<?= $countryEl ?>"><?= $countryEl ?></option>
                                                    <?php
                                                    }?>
                                            </select>
                                            <span class="fas fa-chevron-down"></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <?PHP
                                $param  = Yii::$app->request->get("status",[]);
                                $isStatCollapsed = $param? '':'collapsed';
                                $isStatShow = $param?'show':'';
                                ?>
                                <a href="#collapse1" role="button" class="d-block filter-link <?=$isStatCollapsed?>" data-toggle="collapse" aria-expanded="true" aria-controls="collapse1">
                                    <strong><?=t_app('Наличие')?></strong>
                                    <i class="fas fa-chevron-down float-right"></i>
                                </a>
                                <div id="collapse1" class="filter_block collapse <?=$isStatShow?>">
                                    <div class="filter_dot">
                                        <input type="checkbox" name="status[]" id="val_1" class="checkbox" <?=in_array(\app\models\product\Status::STATUS_PRODUCT_IN_STOCK,$param )?"checked":""?>
                                               value="<?= \app\models\product\Status::STATUS_PRODUCT_IN_STOCK?>">
                                        <label for="val_1"><?=\app\models\product\Status::getStatusAsArray()[\app\models\product\Status::STATUS_PRODUCT_IN_STOCK]?></label>

                                        <input type="checkbox" name="status[]" id="val_2" class="checkbox" <?=in_array(\app\models\product\Status::STATUS_PRODUCT_EXPECTED,$param )?"checked":""?>
                                               value="<?= \app\models\product\Status::STATUS_PRODUCT_EXPECTED?>">
                                        <label for="val_2"><?=\app\models\product\Status::getStatusAsArray()[\app\models\product\Status::STATUS_PRODUCT_EXPECTED]?></label>

                                        <input type="checkbox" name="status[]" id="val_3" class="checkbox" <?=in_array(\app\models\product\Status::STATUS_PRODUCT_ABSENT,$param )?"checked":""?>
                                               value="<?= \app\models\product\Status::STATUS_PRODUCT_ABSENT?>">
                                        <label for="val_3"><?=\app\models\product\Status::getStatusAsArray()[\app\models\product\Status::STATUS_PRODUCT_ABSENT]?></label>

                                    </div>
                                </div>
                            </li>

                            <?PHP
                            if(!is_null($categoryModel))
                            {
                                $f = \Yii::$app->request->get("Feature");
                                foreach ($categoryModel->filterFeatures as $i => $feature):
                                    $isSetF = isset($f[$feature->id]);
                                    $collapseId = "collapse" . $feature->id;
                                    $isCollapsedClass = $isSetF ? "" : "collapsed";
                                    $isShowClass = $isSetF ? "show" : "";
                                    switch ($feature->type_value) {
                                        case \app\models\product\Feature::TYPE_VALUE_NUMBER:
                                            $min = (new \yii\db\Query())
                                                ->select("MIN(name)")
                                                ->from("feature_value as fv")
                                                //->cache(3600) крайне рекомендую потом кешировать
                                                ->where(["fv.feature_id" => $feature->id])->scalar();
                                            $max = (new \yii\db\Query())
                                                ->select("MAX(name)")
                                                //->cache(3600) крайне рекомендую потом кешировать
                                                ->from("feature_value as fv")
                                                ->where(["fv.feature_id" => $feature->id])->scalar();

                                            $vmin = $min;
                                            $vmax = $max;
                                            if ($f != null) {
                                                if (isset($f[$feature->id]) && isset($f[$feature->id]["min"]))
                                                    $vmin = $f[$feature->id]["min"];
                                                if (isset($f[$feature->id]) && isset($f[$feature->id]["max"]))
                                                    $vmax = $f[$feature->id]["max"];
                                            }
                                            ?>
                                            <li>
                                                <a href="#<?= $collapseId ?>" role="button"
                                                   class="d-block filter-link <?= $isCollapsedClass ?>"
                                                   data-toggle="collapse" aria-expanded="true"
                                                   aria-controls="<?= $collapseId ?>">
                                                    <strong><?= $feature->name ?></strong>
                                                    <i class="fas fa-chevron-down float-right"></i>
                                                </a>
                                                <div id="<?= $collapseId ?>"
                                                     class="filter_block collapse <?= $isShowClass ?>">
                                                    <div class="filter_number">
                                                        <div class="number" data-min="<?= $min ?>"
                                                             data-max="<?= $max ?>">
                                                            <input type="text" name="Feature[<?= $feature->id ?>][min]"
                                                                   class="lower ui-border block-1" value="<?= $vmin ?>">
                                                            <span class="dash">-</span>
                                                            <input type="text" name="Feature[<?= $feature->id ?>][max]"
                                                                   class="upper ui-border block-1" value="<?= $vmax ?>">
                                                        </div>
                                                        <div class="slider-range"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?PHP
                                            break;
                                        case \app\models\product\Feature::TYPE_VALUE_SELECT:
                                            $isCollapsedFeature = 'collapsed';
                                            $isFeatureShow = '';
                                            $checkArr = [];
                                            foreach ($feature->values as $value) {
                                                if (isset($_GET['Feature'][$feature->id])) {
                                                    $fvs = $_GET['Feature'][$feature->id];

                                                    if ((is_string($fvs) && $fvs == $value->id) || (is_array($fvs) && in_array($value->id, $fvs))) {
                                                        $isCollapsedFeature = '';
                                                        $checkArr[$value->id] = 'checked';
                                                        $isFeatureShow = 'show';
                                                    } else {
                                                        $checkArr[$value->id] = '';
                                                    }
                                                } else {
                                                    $checkArr[$value->id] = '';
                                                }
                                            }
                                            ?>

                                            <li>
                                                <a href="#<?= $collapseId ?>" role="button"
                                                   class="d-block filter-link <?= $isCollapsedFeature ?>"
                                                   data-toggle="collapse" aria-expanded="true"
                                                   aria-controls="<?= $collapseId ?>">
                                                    <strong><?= $feature->name ?></strong>
                                                    <i class="fas fa-chevron-down float-right"></i>
                                                </a>
                                                <div id="<?= $collapseId ?>"
                                                     class="filter_block collapse <?= $isFeatureShow ?>">
                                                    <div class="filter_dot">
                                                        <?PHP
                                                        foreach ($feature->values as $value) {
                                                            ?>

                                                            <input type="checkbox" name="Feature[<?= $feature->id ?>][]"
                                                                   class="checkbox"
                                                                   id="checkbox-f-<?= $value->id ?>" <?= $checkArr[$value->id] ?>
                                                                   value="<?= $value->id ?>">
                                                            <label for="checkbox-f-<?= $value->id ?>"><?= $value->name ?></label>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                            </li>
                                            <?PHP
                                            break;
                                    }
                                endforeach;
                            }
                            ?>

                            <?PHP
                            if(sizeof($categories) > 0)
                            {
                                $c = Yii::$app->request->get("category");
                                $isCatCollapsed = $c? '':'collapsed';
                                $isCatShow = $c?'show':'';   ?>
                                <li>
                                    <a href="#collapseCatD" role="button" class="d-block filter-link pb-2 <?=$isCatCollapsed?>" data-toggle="collapse" aria-expanded="true" aria-controls="collapseCatD">
                                        <strong><?=t_app('Категории')?></strong>
                                        <i class="fas fa-chevron-down float-right"></i>
                                    </a>
                                    <div id="collapseCatD" class="filter_block collapse <?=$isCatShow?>">
                                        <div class="filter_radio">
                                            <input type="radio" name="category" id="catD0" <?=empty($isCatCollapsed)?'':'checked'?> class="input_radio" value="0">
                                            <label for="catD0"><?=t_app('Все')?></label>
                                            <?php foreach ($categories as $category){?>
                                                    <input type="radio" name="category" id="catD<?=$category->id?>" class="input_radio" <?=$category->id==$c?"checked":""?> value="<?=$category->id?>">
                                                    <label for="catD<?=$category->id?>"><?=t_admin($category->name)?></label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>


                            <li class="text-center">
                                <button type="submit" class="btn btn-success filter-apply"><i class="fa fa-filter"></i> <?=t_app('Фильтровать')?></button>
                                <a title="<?=t_app('Очистить фильтр')?>" href="<?=Url::to(['/product/product'])?>" class="btn btn-info filter_clear"><i class="fa fa-brush"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 no-padding">

                    <?php if(sizeof($sales) > 0){?>
                        <?php if(isset($_GET['uname'])){ ?>
                            <input type="hidden" name="d" value="<?=$_GET['uname']?>">
                        <?php } ?>
                        <div class="with-slick gallary_discount gallary">
                            <?php foreach ($sales as $sale){ ?>
                                <div class="gallary_item">
                                    <!--<div class="gallary_item" style="background-image: url(/images/main/gallery.jpg)">-->
                                    <div class="gallery_item_wrap">
                                        <?php if( !empty($sale->img) ){?>
                                            <div class="float-right sale_image">
                                                <?= Html::img('/'.$sale->img); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="gallary_text">
                                            <h1><?= t_admin($sale->title) ?></h1>
                                            <p><?= t_admin($sale->description) ?></p>
                                            <div class="gallery_link">
                                                <a href="<?= Url::to(['/info/discount','uname'=>$sale->uname]) ?>"><?=t_app('Подробнее')?> <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="sort">
                        <div class="sort_down">
                            <label class="mr-2">Сортировка:</label>
                            <?php $sort = isset($_GET['o']) ? $_GET['o'] : 1?>
                            <div class="select-wrap" id="selectSortFilter">
                                <select name="o" class="filter-products-select">
                                    <option <?=$sort==1?'selected':''?> value="1"><?=t_app('по порядку')?></option>
                                    <option <?=$sort==2?'selected':''?> value="2"><?=t_app('по возрастанию цены')?></option>
                                    <option <?=$sort==3?'selected':''?> value="3"><?=t_app('по убыванию цены')?></option>
                                    <option <?=$sort==4?'selected':''?> value="4"><?=t_app('по новизне')?></option>
                                </select>
                                <span class="fas fa-chevron-down"></span>
                            </div>
                        </div>
                        <div class="sort_page line">
                            <div class="item_sort">
                                <span class="black"><?=t_app('Показывать по')?>:</span>
                                <div class="num_sort_page">
                                    <input type="hidden" name="per-page" value="<?=$page?>">
                                    <input type="radio" id="check-24" class="per-page-prod-radio check-24 check" name="per-page" value="24" <?= $page == 24 ? 'checked' : ''; ?>>
                                    <label for="check-24">24</label>

                                    <input type="radio" id="check-32" class="per-page-prod-radio check-32 check" name="per-page" value="32" <?= $page == 32 ? 'checked' : ''; ?>>
                                    <label for="check-32">32</label>

                                    <input type="radio" id="check-48" class="per-page-prod-radio check-48 check" name="per-page" value="48" <?= $page == 48 ? 'checked' : ''; ?>>
                                    <label for="check-48">48</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary filter-apply-sm" data-toggle="collapse" data-target="#productFilters" aria-expanded="false" aria-controls="productFilters"><?=t_app('Фильтры')?></button>
                    </div>
                    <div class="row">
                        <?php
                        $cartSession = new \app\components\CartSession();
                        if($dpProducts->getTotalCount() > 0){
                            foreach ( $dpProducts->getModels() as $products ){ $hasDiscount=$products->hasDiscount();?>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                    <div class="poruct_block has_discount">
                                        <a href="<?= Url::to(['/product/view', 'uname' => $products->uname]); ?>">
                                            <div class="img_gallary">
                                                <?php if($products->hasDiscount()){ ?>
                                                    <div class="discount_l">-<?=$products->discount->percentAsLabel?></div>
                                                <?php } ?>
                                                <?= Html::img('/'.$products->getImageSrc()); ?>
                                            </div>
                                            <div class="info_gallary">
                                                <span><?=$products->getAttributeLabel('art')?>: <?= $products->art ?></span>
                                                <p><?= strlen($products->name) > 100 ? mb_substr($products->getNameTranslated(),0,100):$products->getNameTranslated()?> <?=$products->getStatusIcon(true, "ml-2")?></p>
                                            </div>
                                        </a>
                                        <div class="button_broduct">
                                            <?php if(!empty($products->price)){ ?>
                                                <?php if( $hasDiscount ){?>
                                                    <h1><?= $products->priceWithDiscount?> грн.</h1>
                                                <?php }else{ ?>
                                                    <h1><?= $products->price ?> грн.</h1>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <h6><?=t_app('Цену уточняйте')?></h6>
                                            <?php } ?>
                                            <?php
                                            if($isGuest) {
                                                if($cartSession->isHasSuchProduct($products->id)){
                                                    echo '<input type="button" value="В корзине"  class="active">';
                                                }else{
                                                    echo '<input type="button" value="Купить" class="bt_bay" id="'.$products->id.'">';
                                                    ?>
                                                    <button type="button" class="call_me_product" data-toggle="modal" data-target="#callMeProductModal">
                                                        <?=t_app('Перезвоните мне')?>
                                                    </button>
                                                    <?php
                                                }
                                            }else{?>
                                                <?php if ($products->inCart){ ?>
                                                    <input type="button" value="<?=t_app('В корзине')?>"  class="active">
                                                <?php } else { ?>
                                                    <input type="button" value="<?=t_app('Купить')?>" class="bt_bay" id="<?= $products->id ?>">
                                                    <button type="button" class="call_me_product" data-toggle="modal" data-target="#callMeProductModal">
                                                        <?=t_app('Перезвоните мне')?>
                                                    </button>
                                                <?php } ?>
                                            <?php } ?>
                                            <span class="hidden"><?= $products->id ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="col-md-12">
                                <h5 class="mt-5 mb-5 text-center grey"><?=t_app('Ничего не найдено')?></h5>
                            </div>
                        <?php }?>
                    </div>
                    <section>
                        <?=
                        CLinkPager::widget([
                            'pagination' => $dpProducts->getPagination(),

                            'activePageCssClass' => 'page_activ',
                            'pagination' =>$dpProducts->getPagination(),
                            'prevPageCssClass'=>'first',
                            'prevPageLabel'=>'<span class="inactive_page"></span>',

                            'nextPageCssClass'=>'last',
                            'nextPageLabel'=>'<span class="lnr lnr-arrow-right"></span>',
                            'prevPageLabel' => '
                                    <div class="back">
                                        <input class="inactive_page" type="button" value="Назад">
                                    </div>',
                            'nextPageLabel' => '
                                    <div class="next">
                                        <input class="inactive_page" type="button" value="Вперёд">
                                    </div>',
                            'maxButtonCount'=>3,
                            'options' => ['class' => 'page_white' , 'id' => 'pagination'],
                            'activePageAsLink' => false,
                            'maxButtonCount' => 5,

                        ]);
                        ?>

                    </section>
                </div>
            </div>
        </form>
    </div>

</div>
