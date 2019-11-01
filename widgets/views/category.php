<?php


use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $category Category */

?>

<div class="col-lg-2 col-md-3 col-lgmd-20per position-initial">
    <div class="sidebar-menu-dropdown home">
        <a class="btn-sidebar-menu-dropdown"><span></span> Категории</a>
        <div id="cat" class="cat-dropdown">
            <div class="sidebar-contant">
                <div id="menu" class="navbar-collapse collapse" >
                    <?php foreach ($category->children as $child): ?>
                       <div>
                           <?=Html::a(Html::encode($child->name), ['/catalog/category', 'id' => $child->id],
                             ['class' => 'col-aside-production btn-submenu']) ?>
                           <!--                         <i class="fa fa-angle-right"></i>-->
                           <ul class="sub-catalog subcat-dropdown">
                                <?php foreach ($child->children as $item): ?>
                                   <li>
                                       <a class="sub-cat-a" href="<?= Html::encode(Url::to(['/catalog/category', 'id' => $item->id])) ?>"><?= Html::encode($item->name) ?></a>
                                   </li>
                                <?php endforeach; ?>
                           </ul>
                       </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
