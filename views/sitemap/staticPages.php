<?PHP echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= \yii\helpers\Url::to(["/info/contact"],true)?></loc>
        <priority>1</priority>
    </url>
    <url>
        <loc><?= \yii\helpers\Url::to(["/info/about"],true)?></loc>
        <priority>1</priority>
    </url>
    <url>
        <loc><?= \yii\helpers\Url::to(["/info/main"],true)?></loc>
        <priority>1</priority>
    </url>
    <url>
        <loc><?= \yii\helpers\Url::to(["/service/category"],true)?></loc>
        <priority>8</priority>
    </url>
    <url>
        <loc><?= \yii\helpers\Url::to(["/product/category"],true)?></loc>
        <priority>9</priority>
    </url>
    <url>
        <loc><?= \yii\helpers\Url::to(["/info/delivery"],true)?></loc>
        <priority>1</priority>
    </url>
    <url>
        <loc><?= \yii\helpers\Url::to(["/info/comment"],true)?></loc>
        <priority>1</priority>
    </url>
</urlset>