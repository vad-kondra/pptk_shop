<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li>/ <span>{link}</span></li>",
    'label' => $this->title,
];
$urlProductPage = \yii\helpers\Url::to('/product');//catalog/view TODO
?>

<!-- CONTAIN START -->
<section class="ptb-70">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 mb-xs-30">
                <div class="cart-item-table commun-table">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Продукт</th>
                                <th>Описание</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="<?=$urlProductPage?>">
                                        <div class="product-image"><img src="images/1.jpg"></div>
                                    </a>
                                </td>
                                <td>
                                    <div class="product-title">
                                        <a href="<?=$urlProductPage?>">Cross Colours Camo Print Tank half mengo</a>
                                        <div class="size-text">SIZE:large  <br> <span>PRODUCT ID:0088746</span></div>
                                    </div>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <div class="base-price price-box"> <span class="price">$80.00</span> </div>
                                        </li>
                                    </ul>
                                </td>

                                <td><div class="total-price price-box"> <span class="price">В наличии</span> </div></td>
                                <td><i title="Remove Item From Cart" data-id="100" class="fa fa-trash cart-remove-item"></i></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="<?=$urlProductPage?>">
                                        <div class="product-image"><img alt="Electrro" src="images/2.jpg"></div>
                                    </a>
                                </td>
                                <td>
                                    <div class="product-title">
                                        <a href="<?=$urlProductPage?>">Defyant Reversible Dot Shorts</a>
                                        <div class="size-text">SIZE:large  <br> <span>PRODUCT ID:0088746</span></div>
                                    </div>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <div class="base-price price-box"> <span class="price">$80.00</span> </div>
                                        </li>
                                    </ul>
                                </td>

                                <td><div class="total-price price-box"> <span class="price">В наличии</span> </div></td>
                                <td><i title="Remove Item From Cart" data-id="100" class="fa fa-trash cart-remove-item"></i></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTAINER END -->
