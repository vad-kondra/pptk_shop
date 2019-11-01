<?php

/* @var $category Category */

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<?php if ($category->children): ?>
    <div class="sidebar-box listing-box mb-40"> <span class="opener plus"></span>
        <div class="sidebar-title">
            <h3>Категории</h3> <span></span>
        </div>
        <div class="sidebar-contant">
            <ul>
                <?php foreach ($category->children as $child): ?>
                    <li><a href="<?= Html::encode(Url::to(['/catalog/category', 'id' => $child->id])) ?>"><?= Html::encode($child->name) ?> <span></span></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
<?php endif;?>



