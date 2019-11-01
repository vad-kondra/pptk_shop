<?PHP echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
    <loc><?= \yii\helpers\Url::to(["/service/category"],true)?></loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>
    <?php
        $formatter = Yii::$app->formatter;
        $devices = \app\models\service\Service::find()->where(['type'=>\app\models\service\Service::TYPE_COMMON])->orderBy(["id"=>SORT_DESC])->all();
        foreach ($devices as $device){
            $url = \yii\helpers\Url::to(["/service/device","uname"=>$device->uname],true);
            $lastmod = $formatter->asDate($device->created_at,"yyyy-MM-dd");
            echo <<<EOT
<url>
    <loc>$url</loc>
    <lastmod>$lastmod</lastmod>
    <priority>0.8</priority>
</url>
EOT;
        }
    ?>
</urlset>