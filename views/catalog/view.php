<?PHP

$this->title = $model->name;
$this->params['breadcrumbs'][] =  [
    'template' => "<li>/ <span>{link}</span></li>",
    'label' => $this->title,
];
/* @var $this yii\web\View */
/* @var $product Product */



$urlProductPage = \yii\helpers\Url::to('/product');//catalog/view

use app\models\Product;
use yii\helpers\Html;
use yii\web\View; ?>
<!-- CONTAIN START -->
<section class="pt-70">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-5 col-sm-5 mb-xs-30">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="native">

<!--                            --><?php //foreach ($product->photos as $i => $photo): ?>
<!--                            <a href="#">-->
<!--                                --><?//= $photo->getThumbFileUrl('file', 'catalog_product_main') ?><!--" alt="--><?//= Html::encode($product->name) ?><!--" />-->
<!--                            </a>-->
<!--                            --><?php //endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="product-detail-main">
                                    <div class="product-item-details">
                                        <h1 class="product-item-name"><?= Html::encode($model->name) ?></h1>
                                        <div class="price-box">



                                            <span class="price">Цена: <?= Html::encode($model->getPriceWithDiscount()) ?> Р.</span>Цена без скидки: <del class="price old-price"><?= Html::encode($model->price) ?> Р.</del> </div>
                                        <div class="product-info-stock-sku">
                                            <div>
                                                <label>Производитель: </label>
                                                <span class="info-deta"><?= Html::encode($model->producer) ?></span> </div>
                                        </div>
                                        <div class="product-size select-arrow mb-20 mt-30">
                                            <label>Размер: </label>
                                            <span class="info-deta">S</span>
                                           <!-- <select class="selectpicker form-control" id="select-by-size">
                                                <option selected="selected" value="#">S</option>
                                                <option value="#">M</option>
                                                <option value="#">L</option>
                                            </select>-->
                                        </div>
                                        <div class="product-color select-arrow mb-20">
                                            <label>Цвет:</label>
                                            <span class="info-deta">White</span>
                                            <!--<select class="selectpicker form-control" id="select-by-color">
                                                <option selected="selected" value="#">Blue</option>
                                                <option value="#">Green</option>
                                                <option value="#">Orange</option>
                                                <option value="#">White</option>
                                            </select>-->
                                        </div>
                                        <div class="product-color select-arrow mb-20">
                                            <label>Производитель:</label>
                                            <span class="info-deta">lahasa</span>
                                        <!--<select class="selectpicker form-control" id="select-by-color">
                                            <option selected="selected" value="#">Blue</option>
                                            <option value="#">Green</option>
                                            <option value="#">Orange</option>
                                            <option value="#">White</option>
                                        </select>-->
                                        </div>
                                        <div class="mb-20">
<!--                                            <div class="product-qty">-->
<!--                                                <label for="qty">шт.:</label>-->
<!--                                                <div class="custom-qty">-->
<!--                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;return false;" class="reduced items" type="button"> <i class="fa fa-minus"></i> </button>-->
<!--                                                    <input type="text" class="input-text qty" title="Qty" value="1" maxlength="8" id="qty" name="qty">-->
<!--                                                    <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items" type="button"> <i class="fa fa-plus"></i> </button>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                            <div class="bottom-detail cart-button">
                                                <ul>
                                                    <li class="pro-cart-icon">
                                                        <form>
                                                            <button title="В корзину" class="btn-color"><span></span>В корзину</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="bottom-detail">
                                            <ul>
                                                <li class="pro-wishlist-icon"><a href="#"><span></span>В избранное</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
<!--                <div class="brand-logo-pro align-center mb-30">-->
<!--                    <img src="images/brand5.png" alt="Electrro">-->
<!--                </div>-->
<!--                <div class="sub-banner-block align-center">-->
<!--                    <img src="images/pro-banner.jpg" alt="Electrro">-->
<!--                </div>-->
            </div>
        </div>
    </div>
</section>

<section class="ptb-70">
    <div class="container">
        <div class="product-detail-tab">
            <div class="row">
                <div class="col-xs-12">
                    <div class="heading-part">
                        <h2 class="fz-20 mb-0">Описание</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="items">
                        <div class="tab_content">
                            <ul>
                                <li>
                                    <div class="Description"><?= Html::encode($model->descript) ?></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-70">
    <div class="container">
        <div class="product-listing">
            <div class="row">
                <div class="col-xs-12">
                    <div class="heading-part mb-30">
                        <h2 class="main_title heading"><span>Похожие продукты</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pro_cat">
                    <div class="owl-carousel pro-cat-slider">
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label new-label"><span>New</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/1.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon active"><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label sale-label"><span>Sale</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/3.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon "><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label new-label"><span>New</span></div>
                                <div class="main-label sale-label"><span>Sale</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/4.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon"><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/5.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon "><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label sale-label"><span>Sale</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/6.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon "><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/7.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon"><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>

                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label new-label"><span>New</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/1.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon"><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label sale-label"><span>Sale</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/3.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon"><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="main-label new-label"><span>New</span></div>
                                <div class="main-label sale-label"><span>Sale</span></div>
                                <div class="product-image"> <a href="<?=$urlProductPage?>"> <img src="images/4.jpg" alt="Electrro"> </a>
                                    <div class="product-detail-inner">
                                        <div class="detail-inner-left left-side">
                                            <ul>
                                                <li class="pro-cart-icon">
                                                    <form>
                                                        <button title="В корзину"><span></span>В корзину</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="detail-inner-left right-side">
                                            <ul>
                                                <li class="pro-wishlist-icon active"><a href="#" title="В избранное"></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item-details">
                                    <div class="product-item-name"> <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a> </div>
                                    <div class="price-box"> <span class="price">$80.00</span> <del class="price old-price">$100.00</del> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTAINER END -->


