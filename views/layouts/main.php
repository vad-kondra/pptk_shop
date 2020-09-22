<?php

use app\assets\AppAsset;
use app\models\CallBack;
use kartik\growl\Growl;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);

$currentUser = null;
$canAdminMain = false;
$hasRequestPermission = false;
$isGuest = Yii::$app->user->isGuest;
if(!$isGuest){
    $currentUser = Yii::$app->user->identity;

    $userUsername = $currentUser->f_name;

    $canAdminMain = \mdm\admin\components\Helper::checkRoute('/admin/default/index');
    if(strlen($userUsername) > 8) {
        $profilePlaceHolder = mb_substr($userUsername, 0, 8) . "..";
    }else{
        $profilePlaceHolder = $userUsername;
    }
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= Html::encode($this->title) ?></title>

    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?=$this->registerLinkTag([
            'rel' => 'icon',
            'type' => 'image/png',
            'href' => '/images/logo_icon_001.png']);
    ?>

    <!— Yandex.Metrika counter —>
	<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(66351613, "init", {
	clickmap:true,
	trackLinks:true,
	accurateTrackBounce:true,
	webvisor:true
	});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/66351613" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!— /Yandex.Metrika counter —>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render('header.php') ?>
        <div class="container">
            <?php if(Yii::$app->controller->action->id != 'main' && Yii::$app->controller->action->id != 'error'){?>

                <!-- Breadcrumb Start -->
                <div class="breadcrumb-area pt-60 pb-55 pt-sm-30 pb-sm-20">
                    <div class="breadcrumb">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => ''],
                        ]) ?>
                    </div>
                    <!-- Container End -->
                </div>
                <!-- Breadcrumb End -->

            <?php } ?>
        </div>

        <?=$content?>

        <?= $this->render('footer.php') ?>
    </div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
