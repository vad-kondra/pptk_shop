<?php

use app\helpers\PriceHelper;
use app\models\Product;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $products Product[] */
/* @var $category integer */
/* @var $text string */

?>

<?php if (count($products) > 0): ?>
    <table class='price-list'>
        <thead><tr><td>Название</td><td>Артикул</td><td>Производитель</td><td>Цена</td></tr></thead>

        <?php foreach ($products as $product): ?>
            <tr>
                <td><a href="<?=Url::to(['product', 'id' =>$product->id])?>"><?=$product->name?></a></td>
                <td><?=$product->art?></td>
                <td><?=$product->brand->name?></td>
                <td><?= PriceHelper::format($product->price_new) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <table class='price-list'>
        <tbody>
            <tr>
                <td><p>Результатов не найдено</p></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<a href="<?=Url::to(['/catalog/search', 'category' => $category, 'text' => $text])?>" class="btn btn-custom">Показать все результаты</a>
