<?php
$this->title = $title;

use app\widgets\BestProductWidget;
use app\widgets\NewsWidget;
use app\widgets\LatestProductWidget;
use app\widgets\SaleProductWidget;

?>

<div class="new-products pb-60 pt-60">
    <div class="container">
        <div class="row">
            <?=BestProductWidget::widget()?>
            <div class="col-xl-9 col-lg-8 order-lg-2">
                <?=LatestProductWidget::widget()?>
                <?=SaleProductWidget::widget()?>
                <?=NewsWidget::widget() ?>
            </div>
        </div>
    </div>
</div>


