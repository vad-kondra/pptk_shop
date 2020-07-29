<?php

use app\models\Product;

/* @var $products Product[] */
/* @var $header string */

?>

<div class="new-pro-content">
    <div class="pro-tab-title border-line">
        <ul class="nav product-list product-tab-list">
            <li><a class="active" data-toggle="tab" href="#new-arrival"><?=$header?></a></li>
        </ul>
    </div>
    <div class="tab-content product-tab-content jump">
        <div id="new-arrival" class="tab-pane active">
            <div class="new-pro-active owl-carousel">
                <?php foreach ($products as $product) : ?>
                    <?= $this->render('_product', [
                        'product' => $product
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
