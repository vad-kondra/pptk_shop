<?php

/* @var $category Category */

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<?php if ($category->children): ?>
    <div class="group-title">
        <h2>Категории</h2>
    </div>
    <ul>
        <?php foreach ($category->children as $child): ?>
            <li><a href="<?= Html::encode(Url::to(['/catalog/category', 'id' => $child->id])) ?>"><?= Html::encode($child->name) ?> <span></span></a></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>



