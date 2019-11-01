<?php


use app\models\Config;
use app\models\service\CategoryService;
use app\models\service\Service;
use app\widgets\CLinkPager;
use kartik\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Json;
use yii\helpers\Url;


$this->title = $title;


$cur = $services->category->uname;
$bread = [];
while($cur != null) {
    $parent = CategoryService::findOne(["uname"=>$cur])->parent;

    if($cur == Yii::$app->request->get("uname"))
        $bread[] =  [
            'template' => "<li aria-current=\"page\">{link}</li>",
            'label' => CategoryService::findOne(["uname"=>$cur])->name,
        ];
    else
        $bread[] = [
            'label' => CategoryService::findOne(["uname"=>$cur])->name,
            'url' => Url::to(['/service/category',"uname"=>$cur ]),
        ];
    $cur = $parent ? $parent->uname:null;
}
$bread = array_reverse($bread);
$this->params['breadcrumbs'] = $bread;

$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\" >{link}</li>",
    'label' => $this->title,
];

Yii::$app->params["og_image"] = \yii\helpers\Url::to([$services->getImageSrc()],true);
Yii::$app->params["og_description"] = mb_substr($services->description,0,5);

$pageName = 'delivery';
$language = Yii::$app->language;
$isGuest = Yii::$app->user->isGuest;
?>

    <!--TIME WORK-->
    <div class="modal fade" id="time_work" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><?=t_app('График работы')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="all_time">
                        <?php $time = Json::decode(Config::getValue(Config::TIME_WORK));  ?>
                        <li>
                            <span><?=t_app('Понедельник')?></span>
                            <strong><?= $time[0] ?></strong>
                        </li>
                        <li>
                            <span><?=t_app('Вторник')?></span>
                            <strong><?= $time[1] ?></strong>
                        </li>
                        <li>
                            <span><?=t_app('Среда')?></span>
                            <strong><?= $time[2] ?></strong>
                        </li>
                        <li>
                            <span><?=t_app('Четверг')?></span>
                            <strong><?= $time[3] ?></strong>
                        </li>
                        <li>
                            <span><?=t_app('Пятница')?></span>
                            <strong><?= $time[4] ?></strong>
                        </li>
                        </br>
                        <li>
                            <span><?=t_app('Суббота')?></span>
                            <strong><?= $time[5] ?></strong>
                        </li>
                        <li>
                            <span><?=t_app('Воскресенье')?></span>
                            <strong><?= $time[6] ?></strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--END TIME WORK-->

    <!--DELIVERY-->
    <div class="modal fade delivery" id="delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?=t_app('Условие оплаты')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="blue_block"><?=t_app('Оказание услуги только по предоплате.')?></div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-xl-6 col-hd-12">
                            <div class="item_delivery">

                                <div id="services" class="delivery_de">
                                    <h6><?=t_app('Способы доставки')?></h6>
                                    <div class="row align-items-center">

                                        <div class="col-12 col-xl-12 col-hd-4">
                                            <div class="block_services align-items-center">
                                                <div class="img_srvice">
                                                    <img src="/images/delivery/location(7).svg" alt="">
                                                </div>
                                                <div class="link_services"><?=t_app('Самовывоз')?></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-12 col-hd-4">
                                            <div class="block_services align-items-center">
                                                <div class="img_srvice">
                                                    <img src="/images/delivery/courier.svg" alt="">
                                                </div>
                                                <div class="link_services"><?=t_app('Доставка курьером')?>
                                                        <span><?=t_app('Бесплатно при стоимости заказа от 2000 грн.')?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-12 col-hd-4">
                                            <div class="block_services align-items-center">
                                                <div class="img_srvice">
                                                    <img src="/images/logo_brend/pochta.png" alt="">
                                                </div>
                                                <div class="link_services">"<?=t_app('Нова пошта')?>"
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6 col-hd-12">
                            <div class="item_delivery">
                                <h6><?=t_app('Способы оплаты')?></h6>
                                <div id="services">
                                    <div class="row">
                                        <div class="col-12 col-xl-12 col-hd-4">
                                            <div class="block_services align-items-center">
                                                <div class="img_srvice">
                                                    <img src="/images/delivery/credit-card.svg" alt="">
                                                </div>
                                                <div class="link_services"><?=t_app('Безналичный рассчет')?></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-12 col-hd-4">
                                            <div class="block_services align-items-center">
                                                <div class="img_srvice">
                                                    <img src="/images/delivery/wallet.svg" alt="">
                                                </div>
                                                <div class="link_services"><?=t_app('Наличными')?></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-12 col-hd-4">
                                            <div class="block_services align-items-center">
                                                <div class="img_srvice">
                                                    <img src="/images/delivery/newsletter.svg" alt="">
                                                </div>
                                                <div class="link_services"><?=t_app('Наложенный платеж')?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6><?=t_app('Гарантия')?></h6>
                    <?=\app\models\page\PageContent::getValue($pageName, 'header-top',['lang'=>$language])?>
                    <div class="warranty">
                        <h6><?=t_app('В каких случаях гарантия не предоставляется?')?></h6>
                        <?=\app\models\page\PageContent::getValue($pageName, 'warranty',['lang'=>$language])?>
                    </div>
                    <h6><?=t_app('Регион доставки')?></h6>
                    <?=\app\models\page\PageContent::getValue($pageName, 'delivery',['lang'=>$language])?>
                </div>
            </div>
        </div>
    </div>
    <!-- END DELIVERY-->

    <!--LOCATION-->
    <div class="modal fade" id="location" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><?=t_app('Адрес и контакты')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="title">
                                    <?=t_app('АДРЕС')?>
                                </div>
                                <strong><?= Config::getValue(Config::ADDRESS) ?></strong>
                                <div class="title">
                                    EMAIL
                                </div>
                                <span><?= Config::getValue(Config::EMAIL) ?></span>

                                <div class="dual">
                                    <ul class="title">
                                        <li>
                                            ICQ
                                        </li>
                                        <li>
                                            <strong><?= Config::getValue(Config::ICQ) ?></strong>
                                        </li>
                                    </ul>
                                    <ul class="title">
                                        <li>
                                            SKYPE
                                        </li>
                                        <li>
                                            <strong><?= Config::getValue(Config::SKYPE) ?></strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="title">
                                    <?=t_app('ТЕЛЕФОНЫ')?>
                                </div>
                                <strong>
                                    <ul style="list-style: none;padding-left: 0;">
                                        <?php
                                        $phone_1 = Config::getValue(Config::PHONE_VOD_1);
                                        $phone_2 = Config::getValue(Config::PHONE_VOD_2);
                                        $phone_3 = Config::getValue(Config::PHONE_VOD_3);
                                        $phone_o = Config::getValue(Config::PHONE_OTHER);
                                        ?>
                                        <?php if(!empty($phone_1)){?>
                                            <li class="fa-phone-vodofon"><?=$phone_1?></li>
                                        <?php } ?>
                                        <?php if(!empty($phone_2)){?>
                                            <li class="fa-phone-vodofon"><?=$phone_2?></li>
                                        <?php } ?>
                                        <?php if(!empty($phone_3)){?>
                                            <li class="fa-phone-vodofon"><?=$phone_3?></li>
                                        <?php } ?>
                                        <?php if(!empty($phone_o)){?>
                                            <li class="fa-phone-tel"><?=$phone_o?></li>
                                        <?php } ?>
                                    </ul>
                                </strong>
                                <a href="" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#call_back"><?=t_app('Заказать обратный звонок')?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END LOCATION-->

    <!--COMMENT-->
<div class="modal fade delivery" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?=t_app('Оставть отзыв о компании')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $formComment = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['/service/comment-add']), 'method' => 'POST', 'id' => 'form_write']) ?>
            <div class="modal-body">
                <p><?=t_app('Все отзывы проходят предварительную модерацию, поэтому ваш отзыв будет опубликован спустя некоторые время.')?></p>
                <div class="container">
                    <div class="row comment_form">
                        <div class="col-md-6">
                            <h4><?=t_app('Общая оценка')?></h4>
                            <?=$formComment->field($modelComment, 'stars')->widget(\kartik\rating\StarRating::classname(), [
                                'pluginOptions' => [
                                    'min'=>0,
                                    'max'=>5,
                                    'step'=>1.0,
                                    'value' => 5,
                                    'language' => Yii::$app->language,
                                    'showClear' => false,
                                    'showCaption' => false,
                                    'theme' => 'krajee-svg',
                                    'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                    'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                    'size' => 'xs',
                                ],
                            ])->label(false);?>
                            <?php
                            ?>
                        </div>

                        <div class="col-12 ">
                            <h4><?=$modelComment->getAttributeLabel('text')?></h4>
                            <?= $formComment->field($modelComment, 'text')->textarea(['style'=>'width: 100%; height:96px;','maxlength' => true, 'placeholder' => t_app('Ваши впечатления о работе компании')])->label(false) ?>
                        </div>
                        <div class="col-md-6 ">
                            <h4><?=$modelComment->getAttributeLabel('virtues')?></h4>
                            <?= $formComment->field($modelComment, 'virtues')->textarea(['style'=>'width: 100%; height:96px;','maxlength' => true, 'placeholder' => t_app('Что вам понравилось?')])->label(false) ?>
                        </div>
                        <div class="col-md-6">
                            <h4><?=$modelComment->getAttributeLabel('disadvantages')?></h4>
                            <?= $formComment->field($modelComment, 'disadvantages')->textarea(['style'=>'width: 100%; height:96px;','maxlength' => true, 'placeholder' => t_app('Что вам не понравилось?')])->label(false) ?>
                            <?=$formComment->field($modelComment, 'item_id')->hiddenInput(['value'=>$services->id])->label(false);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(t_app('Опубликовать отзыв'), ['class' => 'modal_send']) ?>
            </div>
            <?php $formComment = \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
</div>
<!--END COMMENT-->

<div class="modal fade" id="service_write" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=t_app('Написать нам')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $formWrite1 = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['info/write-service']), 'method' => 'POST', 'id' => 'form_service1']); ?>
            <?php
            $modelWrite2 = new \app\models\Writing();
            ?>
            <div class="modal-body">
                <div class="modal_input">
                    <?=$formWrite1->field($modelWrite2, 'title')->hiddenInput(['value'=>$services->name])->label(false)?>
                    <?=$formWrite1->field($modelWrite2, 'name')->textInput(['placeholder'=>$modelWrite2->getAttributeLabel('name')])->label(false)?>
                    <?=$formWrite1->field($modelWrite2, 'email')->textInput(['placeholder'=>$modelWrite2->getAttributeLabel('email')])->label(false)?>
                    <?=$formWrite1->field($modelWrite2, 'text')->textarea(['placeholder'=>$modelWrite2->getAttributeLabel('text'), 'rows'=>3])->label(false)?>
                </div>
            </div>
            <div class="modal-footer">
                <?= \yii\bootstrap4\Html::submitButton(t_app('Отправить'),['class' => 'modal_send']) ?>
            </div>
            <?php $formWrite1 = \yii\bootstrap\ActiveForm::end();?>
        </div>
    </div>
</div>


    <div id="cart-service" class="content">
        <div class="container">

            <h1 class="title"><?= $title ?></h1>

            <div class="row">
                <div class="col-12 col-xl-9">
                    <div class="service_product md-device row no-padding">
                        <div class="col-lg-7 col-md-12 col-sm-12 no-padding">
                            <div class="service_left mt-3">
                                <?php if(!empty($services->url)){?>
                                    <div class="repairs_img d_inline">
                                        <?= Html::img('/'.$services->url); ?>
                                    </div>
                                <?php } ?>
                                <p class="d_inline fz-hd-26"><?= $services->price ?> грн.</p>
                                <div class="repairs_write d_inline">
                                    <input type="button" value="<?=t_app('Написать')?>" data-toggle="modal" data-target="#service_write" class="blue-button">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 no-padding text-center">
                                <?php $formCall = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['info/call-me']),'id' => 'form_call_device']);
                                $modelCall = new \app\models\CallMe()?>
                                <div class="phone_product mt-4 ml-3">
                                    <?=$formCall->field($modelCall, "phone",['template'=>'{label}{input}'])->widget(\yii\widgets\MaskedInput::className(), [
                                        'mask' => '+38 (999) 999-9999',
                                        'options' => [
                                            'id' => 'phone',
                                        ],
                                        'clientOptions' => [
                                            'clearIncomplete'=>true
                                        ]
                                    ])->label(t_app('Перезвоните мне'))?>
                                    <?=$formCall->field($modelCall, 'descript')->hiddenInput(['value'=>$services->name])->label(false)?>
                                </div>
                                <?php \yii\bootstrap\ActiveForm::end() ?>
                        </div>
                    </div>
                    <?php
                        $serviceApps = $services->apps;
                        if(sizeof($serviceApps) > 0){
                    ?>
                            <div class="col-12 product_device">
                                <div class="whith_product">
                                    <h6><?=t_app('С этим товаром покупают')?></h6>
                                    <div class="row">
                                        <?php foreach ($serviceApps as $model){ ?>
                                        <div class="col-12 col-md-4 p-0">
                                            <div class="whith_product_block">
                                                <a href="<?= Url::to(['/product/view', 'uname' => $model->uname]); ?>">
                                                    <div class="whith_img">
                                                        <img src="/<?= $model->img ?>" alt="">
                                                    </div>
                                                    <div class="whith_text">
                                                        <p><?= $model->name?></p>
                                                        <span><?= $model->price?> грн.</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                    <div class="repairs_text">
                        <?= $services->getDescriptionTranslated()?>
                    </div>
                    <div class="diagnostics">
                        <p class="bold"><?=t_app('Диагностика БЕСПЛАТНО')?>*</p>
                        <p>* <?=t_app('Диагностика бесплатна в случае проведения дальнейшего ремонта. В случае отказа – 80 грн.')?></p>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3 comp">
                    <aside class="product_manu">
                        <ul>
                            <li><a href="" data-toggle="modal" data-target="#delivery">
                                    <div class="img_menu"><i class="fas fa-wallet"></i></div>
                                    <p><?=t_app('Условие оплаты')?></p>
                                </a></li>
                            <li><a href="" data-toggle="modal" data-target="#time_work">
                                    <div class="img_menu"><i class="far fa-clock"></i></div>
                                    <p><?=t_app('График работы')?></p>
                                </a></li>
                            <li><a href="" data-toggle="modal" data-target="#location">
                                    <div class="img_menu"><i class="fas fa-map-marker-alt"></i></div>
                                    <p><?=t_app('Адрес и контакты')?></p>
                                </a></li>
                        </ul>
<!--                        <div class="terms_return">-->
<!--                            <strong>Условия возврата</strong>-->
<!--                            <p>Возврат товара в течение 14 дней по договоренности</p>-->
<!--                            <a href="">Подробности</a>-->
<!--                        </div>-->
                    </aside>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="description">
                        <ul class="nav nav-tabs munu_history">
                            <li><a data-toggle="tab" href="#menu1" class="active"><?=t_app('Информация для заказа')?></a></li>
                            <li>
                                <a data-toggle="tab" href="#menu2"><?=t_app('Отзывы')?></a>
                                <span><?= count($dpComment->getModels()) ?></span>
                            </li>
                        </ul>

                        <div class="tab-content service_view_tabs">

                            <div id="menu1" class="tab-pane fade in active show">
                                <?= $services->getInfoTranslated() ?>
                            </div>

                            <div id="menu2" class="tab-pane fade">
                                <div class="comment_sort mb-5">
                                    <?php if(!$isGuest){?>
                                        <input type="button" data-toggle="modal" data-target="#comment" value="<?=t_app('Оставить отзыв')?>" class="btn_blue">
                                    <?php } ?>
                                    <div class="item_select float-right">
                                        <div class="select">
                                            <ul>
                                                <li>
                                                    <label class="label_select pr-2"><?=t_app('Сортировка')?>:</label>
                                                    <label class="check_select"><?=t_app('сначала новые')?><i class="fas fa-chevron-down"></i></label>
                                                </li>
                                                <?php \yii\bootstrap4\ActiveForm::begin(['method' => 'POST', 'id' => 'form-comment']) ?>
                                                <li class="down_select">
                                                    <ul>
                                                        <li>
                                                            <input <?= (isset($_POST['sort']) && $_POST['sort'] == 1) ? 'checked': (!isset($_POST['sort']))? 'checked' : ''?> type="radio"  name="sort" id="sort-1" value="1">
                                                            <label for="sort-1" class="fz-hd-18"><?=t_app('сначала новые')?></label>
                                                        </li>
                                                        <li>
                                                            <input <?= (isset($_POST['sort']) && $_POST['sort'] == 2) ? 'checked': '' ?> type="radio" name="sort" id="sort-2" value="2">
                                                            <label for="sort-2" class="fz-hd-18"><?=t_app('сначала старые')?></label>
                                                        </li>
                                                        <li>
                                                            <input <?= (isset($_POST['sort']) && $_POST['sort'] == 3) ? 'checked': '' ?> type="radio" name="sort" id="sort-3" value="3">
                                                            <label for="sort-3" class="fz-hd-18"><?=t_app('по увеличению рейтинга')?></label>
                                                        </li>
                                                        <li>
                                                            <input <?= (isset($_POST['sort']) && $_POST['sort'] == 4) ? 'checked': '' ?> type="radio" name="sort" id="sort-4" value="4">
                                                            <label for="sort-4" class="fz-hd-18"><?=t_app('по уменьшению рейтинга')?></label>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <?php ActiveForm::end() ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <section>
                                    <div id="comment">
                                        <?php
                                        if($dpComment->getTotalCount() > 0){
                                            foreach ($dpComment->getModels() as $comment){ ?>
                                                <div class="comment_client">
                                                    <div class="top_comment">
                                                        <div class="client_info">
                                                            <div class="client_name">
                                                                <?=$comment->getUserUsername()?>
                                                            </div>
                                                            <div class="hidden id_comment"><?= $comment->id ?></div>
                                                            <div class="star_rating" style="padding-top: 2px;">
                                                                <?= \kartik\rating\StarRating::widget([
                                                                    'name' => 'stars',
                                                                    'value' => $comment->stars,
                                                                    'pluginOptions' => [
                                                                        'showClear' => false,
                                                                        'showCaption' => false,
                                                                        'displayOnly' => true,
                                                                        'theme' => 'krajee-svg',
                                                                        'filledStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                                                        'emptyStar' => '<span class="krajee-icon krajee-icon-star"></span>',
                                                                        'size' => 'xs',
                                                                    ],
                                                                ]);?>
                                                            </div>

                                                        </div>
                                                        <div class="name_service">
                                                            <div class="comment_date"><span><span><?= getModelDate($comment->date)?></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="comment_content">
                                                        <p><?= $comment->text ?></p>
                                                        <p><strong><?=t_app('Достоинства')?>:</strong><?= $comment->virtues ?></p>
                                                        <p><strong><?=t_app('Недостатки')?>:</strong><?= $comment->disadvantages ?></p>
                                                    </div>
                                                    <?php if(!$isGuest){?>
                                                        <div class="answer_comment">
                                                            <?=t_app('Ответить')?>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <?php
                                                if(sizeof($comment->comments) > 0){
                                                    foreach ($comment->comments as $subComment){
                                                        if($subComment->isPublic()){?>
                                                            <div class="ml-4 comment_client first_comment">
                                                                <div class="top_comment">
                                                                    <div class="float-right comment_date">
                                                                        <span><?= getModelDate($subComment->date)?></span>
                                                                    </div>
                                                                    <div class="client_name">
                                                                        <?=$comment->getUserUsername()?>
                                                                    </div>
                                                                    <div class="hidden id_comment"><?= $subComment->id ?></div>
                                                                </div>
                                                                <div class="comment_content">
                                                                    <p><?= $subComment->text ?></p>
                                                                </div>
                                                                <?php if(!$isGuest){?>
                                                                    <div class="answer_comment">
                                                                        <?=t_app('Ответить')?>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                            <?php
                                                            if(sizeof($subComment->comments) > 0) {
                                                                foreach ($subComment->comments as $c) { ?>
                                                                    <div class="ml-5 comment_client first_comment">
                                                                        <div class="float-right comment_date"><span><?= getModelDate($c->date)?></span></div>
                                                                        <div class="top_comment">
                                                                            <div class="client_info">
                                                                                <div class="client_name">
                                                                                    <?=$comment->getUserUsername()?>
                                                                                </div>
                                                                                <div class="hidden id_comment"><?= $c->id ?></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="comment_content">
                                                                            <p><?= $c->text ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <h6 class="grey text-center"><?=t_app('Нет отзывов')?></h6>
                                        <?php } ?>
                                    </div>
                                </section>

                                <section>
                                    <?=
                                    CLinkPager::widget([
                                        'pagination' => $dpComment ->getPagination(),

                                        'activePageCssClass' => 'page_activ',
                                        'pagination' =>$dpComment ->getPagination(),
                                        'prevPageCssClass'=>'first',
                                        'prevPageLabel'=>'<span class="inactive_page"></span>',

                                        'nextPageCssClass'=>'last',
                                        'nextPageLabel'=>'<span class="lnr lnr-arrow-right"></span>',
                                        'prevPageLabel' => '
                                <div class="back">
                                    <input class="inactive_page" type="button" value="Назад">
                                </div>',
                                        'nextPageLabel' => '
                                <div class="next">
                                    <input class="inactive_page" type="button" value="Вперёд">
                                </div>',
                                        'maxButtonCount'=>3,
                                        'options' => ['class' => 'page_white' , 'id' => 'pagination'],
                                        'activePageAsLink' => false,
                                        'maxButtonCount' => 5,

                                    ]);
                                    ?>
                                </section>
                            </div>
                        </div>

                        </div>


                </div>
                <?php $services = Service::findOne($services->id);
                if (count($services->apps) != 0){
                ?>
                <div class="col-md-3 md-device">
                    <div class="whith_product">
                        <h6><?=t_app('С этим товаром покупают')?></h6>
                        <ul>
                            <?php foreach ($services->apps as $model){ ?>
                            <li class="whith_product_block">
                                <a href="<?= Url::to(['/product/view', 'uname' => $model->uname]); ?>">
                                    <div class="whith_img">
                                        <?= Html::img('/'.$model->img); ?>
                                    </div>
                                    <div class="whith_text">
                                        <p><?= $model->name ?></p>
                                        <span><?= $model->price ?> грн.</span>
                                    </div>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
<div class="answer_comment_form">
    <?php ActiveForm::begin(['action' => Url::to(['/service/answer']), 'method' => 'POST', 'id' => 'answer_comment']); ?>
    <textarea name="answer_comment" id="answer_comment_form" placeholder="Ваш коментарий"></textarea>
    <div class="button_answer">
        <?= \yii\bootstrap4\Html::submitButton('Ответить',['class' => 'b_answer blue-button']) ?>
        <input type="button" class="b_cancel" value="Отмена">
        <input type="hidden" name="id_comment" class="id_comment">
        <input type="hidden" name="id_service" class="id_service" value="<?=$services->id?>">
    </div>
    <?php  ActiveForm::end() ?>
</div>

<script>
    var answer = $('.answer_comment_form').clone();
    $('.answer_comment_form').remove();

    $('.comment_client .answer_comment').click(function (){
        $('.answer_comment_form').prev('.comment_client').find('.answer_comment').show();
        $('.answer_comment_form').remove();
        $(this).hide();
        var obj = $(answer).clone();
        $(obj).find('.id_comment').val($(this).parent().find('.id_comment').text());
        $(this).parent().after(obj);
        $(obj).find(".b_cancel").on("click",function (){
            $(this).parent().parent().parent().prev('.comment_client').find('.answer_comment').show();
            $(this).parent().parent().remove();
        })
    });

    $('.down_select label').click(function (){
        $('#form-comment').submit();
    });

    $('.phone_product label').click(function() {
        $('#form_call_device').submit();
    });
</script>

