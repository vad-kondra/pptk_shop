<?PHP echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc><?= \yii\helpers\Url::to(["/sitemap/devices"],true) ?></loc>
    </sitemap>
    <sitemap>
        <loc><?= \yii\helpers\Url::to(["/sitemap/printers"],true) ?></loc>
    </sitemap>
    <?php
    $limit = \app\controllers\SitemapController::LIMIT;
    $count_products = \app\models\product\Product::find()->count();
    $ceil = ceil($count_products/$limit);
    for($i=0; $i<$ceil; $i++){?>
        <sitemap>
            <loc><?= \yii\helpers\Url::to(["/sitemap/products", 'offset'=>$i],true) ?></loc>
        </sitemap>
    <?php } ?>
    <sitemap>
        <loc><?= \yii\helpers\Url::to(["/sitemap/static-pages"],true) ?></loc>
    </sitemap>
</sitemapindex>
