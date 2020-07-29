<?php

use app\models\Product;

/* @var $products Product[] */
/* @var $header string */

?>

<div class="col-xl-3 col-lg-4 order-2">
    <div class="side-product-list">
        <div class="group-title">
            <h2><?=$header?></h2>
        </div>
        <div class="slider-right-content side-product-list-active owl-carousel">
            <div class="double-pro">
                <?php foreach ($products as $product) : ?>
                    <?= $this->render('_product', [
                        'product' => $product
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
