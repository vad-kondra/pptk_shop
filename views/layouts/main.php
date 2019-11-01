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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109718537-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-109718537-1');
    </script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?=$this->registerLinkTag([
            'rel' => 'icon',
            'type' => 'image/png',
            'href' => '/images/logo_icon_001.png']);
    ?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="main">
        <?= $this->render('header.php') ?>

        <div class="container">
            <?php if(Yii::$app->controller->action->id != 'main' && Yii::$app->controller->action->id != 'error'){?>
                <!-- Bread Crumb STRAT -->
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <!-- Bread Crumb END -->
            <?php } ?>
        </div>

        <?=$content?>

        <?= $this->render('footer.php') ?>

        <?php Modal::begin([
            'header' => '<h2>Обратный звонок</h2>',
            'id' => 'call_back',
            'size' => 'modal-lg'
        ]); ?>
            <?php
            $formCallMe = ActiveForm::begin(['action' => Url::to(['info/call-back']), 'method' => 'POST', 'id' => 'form_call_me']);
            $modelCallMe = new CallBack();
            $name = '';
            $phone = '';
            if(!$isGuest){
                $modelCallMe->name = $currentUser->fullName;
                $modelCallMe->email = $currentUser->email;
                $modelCallMe->phone = $currentUser->phone;
            }
            ?>

            <?=$formCallMe->field($modelCallMe, 'name')->textInput(['class'=>'fz-22 form-control']);?>
            <?=$formCallMe->field($modelCallMe, 'email')->textInput(['class'=>'fz-22 form-control']);?>
            <?=$formCallMe->field($modelCallMe, "phone")->widget(MaskedInput::class, [
                'mask' => '+39 (999) 999-9999',
                'clientOptions' => [
                    'clearIncomplete'=>true,
                ],
                'options'=>['class'=>'fz-22 form-control']
            ]);?>

            <?= Html::submitButton('Заказать',['class' => 'btn btn-color']) ?>

            <?php ActiveForm::end() ?>


        <?php Modal::end() ?>


        <?php
        $msgs = [];
        if(Yii::$app->session->hasFlash("growl")){
            if(is_array(Yii::$app->session->getFlash("growl")))
                $msgs = Yii::$app->session->getFlash("growl");
            else
                array_push($msgs,["message"=>Yii::$app->session->getFlash("growl")]);

        }
        foreach ($msgs as $msg) {
            Growl::widget([
                'type' => $msg['type'],
                'title' => $msg['title'],
                'icon' => $msg['icon'],
                'body' => $msg['body'],
                'showSeparator' => $msg['showSeparator'],
                'delay'=>$msg['delayShow'],
                'pluginOptions' => [
                    'showProgressbar' => $msg['showProgressbar'],
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ],
                    'closeButton'=>$msg['closeButton'],
                    'delay'=>$msg['delayFade']
                ],
                'options'=>[
                    'style'=>['font-size'=>'16px'],
                ]
            ]);
        } ?>
    </div>

    <?php Modal::begin([
        'header' => '<h2>Корзина</h2>',
        'id' => 'cart-modal',
        'size' => 'modal-lg'
    ]); ?>
    <?php Modal::end() ?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
