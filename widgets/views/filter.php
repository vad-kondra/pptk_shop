<?php

/* @var $this yii\web\View */
/* @var $filters array */


?>



<div class="sidebar-box mb-40"> <span class="opener plus"></span>
    <div class="sidebar-title">
        <h3>Фильтры</h3> <span></span>
    </div>
    <div class="sidebar-contant">
        <div class="price-range mb-30">
            <div class="price-range mb-30">
                <div class="inner-title">Цена</div>
                <input class="price-txt" type="text" id="amount">
                <div id="slider-range"></div>
            </div>
        </div>
    </div>
    <?php foreach ($filters as $char): ?>
        <div class="mb-20">
            <div class="inner-title"><?=$char['name']?></div>
            <ul >
                <?php foreach ($char['values'] as $val): ?>

                    <li><a href="#"><?=$val?></a></li>

                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>


</div>
