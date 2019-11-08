<?php


use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $category Category */

?>
<li><a href="<?=Url::to('/catalog')?>">Каталог товаров</a>
    <!-- Mobile Menu Dropdown Start -->
    <ul>
        <?php foreach ($category->children as $child): ?>
            <li>
                <?=Html::a(Html::encode($child->name), ['/catalog/category', 'id' => $child->id]) ?>
                <?php if(count($child->children) > 0): ?>
                    <ul>
                        <?php foreach ($child->children as $item): ?>
                            <li>
                                <?=Html::a(Html::encode($item->name), ['/catalog/category', 'id' => $item->id]) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- Mobile Menu Dropdown End -->
</li>

