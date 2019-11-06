<?php


use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $category Category */

?>


<li><a href="<?=Url::to('/catalog')?>">Каталог товаров<i class="fa fa-angle-down"></i></a>
    <!-- Home Version Dropdown Start -->
    <ul class="ht-dropdown dropdown-style-two">
    <?php foreach ($category->children as $child): ?>
        <li>
            <?=Html::a(Html::encode($child->name), ['/catalog/category', 'id' => $child->id],
                ['class' => 'col-aside-production btn-submenu']) ?>
            <?php if(count($child->children) > 0): ?>
                <ul class="ht-dropdown dropdown-style-two sub-menu">
                    <?php foreach ($child->children as $item): ?>
                        <li>
                            <?=Html::a(Html::encode($item->name), ['/catalog/category', 'id' => $item->id],
                                ['class' => 'col-aside-production btn-submenu']) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <!-- Home Version Dropdown End -->
</li>

