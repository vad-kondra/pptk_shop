<?PHP echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= \yii\helpers\Url::to(["/service/category"],true)?></loc>
        <changefreq>daily</changefreq>
        <priority>0.7</priority>
    </url>
    <?php
    $formatter = Yii::$app->formatter;
    $printers = \app\models\service\Service::find()->where(['type'=>\app\models\service\Service::TYPE_PRINTER])->orderBy(["id"=>SORT_DESC])->all();
    foreach ($printers as $printer){
        $url = \yii\helpers\Url::to(["/service/printer","uname"=>$printer->uname],true);
        $lastmod = $formatter->asDate($printer->created_at,"yyyy-MM-dd");
        echo <<<EOT
<url>
    <loc>$url</loc>
    <lastmod>$lastmod</lastmod>
    <priority>0.7</priority>
</url>
EOT;
    }
    ?>
</urlset>