<?php


use app\models\service\CategoryService;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;


$this->title = $title;


$cur = $model->category->uname;

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
    $cur = $parent?$parent->uname:null;
}

$bread = array_reverse($bread);
$this->params['breadcrumbs'] = $bread;



$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\" >{link}</li>",
    'label' => $this->title,
];

Yii::$app->params["og_image"] = \yii\helpers\Url::to([$model->getImageSrc()],true);
Yii::$app->params["og_description"] = mb_substr($model->description,0,5);

?>
<div class="modal fade" id="service_write" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=t_app('Нет нужной модели?')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $form1 = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['info/write-service']), 'method' => 'POST', 'id' => 'form_service1']); ?>
            <div class="modal-body">
                <div class="modal_input">
                    <?php
                        $modelWrite1 = new \app\models\Writing();
                        echo $form1->field($modelWrite1, 'email')->textInput(['placeholder'=>$modelWrite1->getAttributeLabel('email')])->label(false);
                        echo $form1->field($modelWrite1, 'text')->textarea(['rows'=>3, 'placeholder'=>$modelWrite1->getAttributeLabel('text')])->label(false);
                        echo $form1->field($modelWrite1, 'title')
                            ->hiddenInput(['value'=>"Нет нужной модели в $model->name"])->label(false);
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Отправить',['class' => 'modal_send']) ?>
            </div>
            <?php $form1 = \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
</div>
    <div id="cart-service" class="content">

        <div class="container">
            <div class="commet_coll">
                <h1><?=t_app('Заправка катриджей')?> <?= $title ?> <p class="service_number"><?= $dataProvider->getTotalCount()?></p></h1>

            </div>
            <div class="row top_service">
                <div class="col-md-8">
                    <div class="top_text">
                        <?= $model->getDescriptionTranslated()?>
                    </div>
                </div>
                    <div class="col-md-4">
                    <div class="help_service">
                        <h5><?=t_app('Нет нужной модели?')?></h5>
                        <p><?=t_app('Оставьте нам заявку и мы свяжемся с вами в ближайшее время для обсуждения вашего заказа')?></p>
                        <div class="service_button">
                            <input type="button" data-toggle="modal" data-target="#service_write" class="b_white" value="<?=t_app('Написать нам')?>">
                            <input type="button" data-toggle="modal" data-target="#call_back" class="b_transparent" value="<?=t_app('Перезвоните мне')?>">
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <?php Pjax::begin(); ?>

                    <?php  \yii\bootstrap\ActiveForm::begin(['method'=> 'post', 'options'=>['data-pjax' => '0'], 'id' => 'form-model', 'action' => Url::to(['service/printer','uname'=>$uname,'language'=>''])]); ?>

                    <div class="serch_service">

                        <?= Html::input('text', 'string', Yii::$app->request->post('string'), ['id' =>'serch_s',
                            'placeholder'=>$strPlaceholder, 'autocomplete'=>'off']); ?>
                        <label for="serch_s" style="cursor: pointer;" id="submit-form-search"></label>
                    </div>
                    <div class="list-service ms-device">
                        <ul>
                            <?php foreach( $dataProvider->getModels() as $model ){?>
                            <li>
                                <div class="title_item">
                                    <p><?= $model->model ?></p> <span><strong><?= $model->color ?></strong></span><i class="fas fa-circle dot_blue fa-xs"></i>
                                    <i class="fas fa-chevron-down show"></i>
                                </div>
                                <div class="body-item">
                                    <div class="price">
                                        <?= $model->price ?> грн.
                                    </div>
                                    <div class="art">
                                        <?=t_app('Артикул')?>:  <?= $model->clef ?>
                                    </div>
                                </div>
                                <div class="footer-service">
                                    <input type="button" class="blue-button write_printer" data-toggle="modal" data-target="#writePrinterModal"="<?= $model->id ?>" value="<?=$writeLabel?>">
                                    <input type="button" class="trans call_printer" data-toggle="modal" data-target="#callMePrinterModal"  id="<?= $model->id ?>" value="<?=$callLabel?>">
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="list_service version-lg middel_comp">
                        <ul class="list_item">
                            <li class="top-service">
                                <div class="name-printer sort_down">
                                    <p><?=t_app('Модель картриджа')?> <i class="fas <?=!is_null($sort) && $sort == SORT_ASC? 'fa-arrow-up':'fa-arrow-down'?> text-primary" ></i></p>
                                </div>
                                <div class="color-service">
                                    <p><?=t_app('Цвет')?></p>
                                </div>
                                <div class="art">
                                    <p><?=t_app('Артикул')?></p>
                                </div>
                                <div class="price">
                                    <p><?=t_app('Стоимость')?></p>
                                </div>

                            </li>
                            <?php foreach ($dataProvider->getModels() as $model){ ?>
                                <li class="item-service">
                                    <div class="name-printer">
                                        <p><?= $model->model ?></p>
                                    </div>
                                    <div class="color-service">
                                        <p><i class="fas fa-circle dot_blue fa-xs"></i><?= $model->color ?></p>
                                    </div>
                                    <div class="art">
                                        <p><?= $model->clef ?></p>
                                    </div>
                                    <div class="price">
                                        <p><?= $model->price ?> грн.</p>
                                    </div>
                                    <div class="chevrone">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </li>
                                <div class="footer-service">
                                    <input type="button" class="blue-button write_printer" data-toggle="modal" data-target="#writePrinterModal"="<?= $model->id ?>" value="<?=$writeLabel?>">
                                    <input type="button" class="trans call_printer" data-toggle="modal" data-target="#callMePrinterModal"  id="<?= $model->id ?>" value="<?=$callLabel?>">
                                </div>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="list_service comp">
                        <input type='hidden' name='uname' value='<?=$uname ?>'>
                        <input type="hidden" name="sort" value="<?=$sort?>">
                        <table>
                            <tr class="title_history_bay">
                                <th class="pl-15 sort_down">
                                    <?=t_app('Модель картриджа')?>
                                    <i class="fas <?=!is_null($sort) && $sort == SORT_ASC? 'fa-arrow-up':'fa-arrow-down'?>"></i>
                                </th>
                                <th><?=t_app('Цвет')?></th>
                                <th><?=t_app('Артикул')?></th>
                                <th><?=t_app('Стоимость работы')?></th>
                            </tr>
                            <?php foreach ($dataProvider->getModels() as $model){ ?>
                            <tr class="model_printer">
                                <td class="pl-15"><?= $model->model ?><td>
                                    <div class="color_printer">
                                        <i class="fas fa-circle dot_blue fa-xs"></i><?= $model->color ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="articul">
                                        <?= $model->clef ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="price_printer">
                                        <div class="price_number">
                                            <?= $model->price ?> грн.
                                        </div>
                                        <div class="printer_write">
                                            <input type="button" class="write_button write_printer" data-toggle="modal" data-target="#writePrinterModal"="<?= $model->id ?>" value="<?=$writeLabel?>">
                                            <input type="button" class="call_me call_printer" data-toggle="modal" data-target="#callMePrinterModal"  id="<?= $model->id ?>" value="<?=$callLabel?>">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>

                    </div>
                    <?php  \yii\bootstrap\ActiveForm::end() ?>
                    <?php Pjax::end(); ?>

                    <div class="text_bottom">
                        <p><?=Yii::t('app','Все картриджи надо время от времени заправлять, но не стоит делать этого в домашних условиях. Нами предлагается квалифицированная заправка картриджей {title}. Перед заправкой картриджи {title} будут тщательно осмотрены, почищены, избавлены от статического электричества.',['title'=>$title])?></p>
                        <p><?=Yii::t('app','На нашей страничке можно увидеть, что заправка картриджей {title} различных моделей обойдется в различные суммы. Мы принимаем на обслуживание лазерные картридж {title} практически всех существующих моделей. Предлагаем совместимые картриджи {title}.',['title'=>$title])?></p>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="callMePrinterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal_сall" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=t_app('Заказать звонок')?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                        $formCall1 = \yii\bootstrap\ActiveForm::begin(['action'=>['/info/call-me']]);
                        $modelCall1 = new \app\models\CallMe();
                        if(!Yii::$app->user->isGuest){
                            $currentUser = Yii::$app->user->identity;
                            $modelCall1->name = $currentUser->username;
                            $modelCall1->phone = $currentUser->phone;
                        }
                        ?>
                        <div class="modal-body">
                            <p><?=t_app('Оставьте свой номер телефона и представитель компании с Вами свяжется.')?></p>
                            <div class="modal_input">
                                <?=$formCall1->field($modelCall1, 'name')->textInput()?>
                                <?=$formCall1->field($modelCall1, "phone")->widget(\yii\widgets\MaskedInput::className(), [
                                    'mask' => '+99 (999) 999-9999',
                                    'options' => [
                                        'id' => 'callme-phone-printer',
                                    ],
                                    'clientOptions' => [
                                        'clearIncomplete'=>true
                                    ]
                                ])?>
                                <?=$formCall1->field($modelCall1, 'descript')->hiddenInput(['class'=>'call_me_printer_desc'])->label(false)?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?=Html::submitButton(t_app('Отправить'), ['class'=>'modal_send'])?>
                        </div>
                        <?php $formCall1 = \yii\bootstrap\ActiveForm::end()?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="writePrinterModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=t_app('Оставить заявку на сервисное обслуживание')?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php $formWrite1Printer = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['info/write-service']), 'method' => 'POST', 'id' => 'form_service2']); ?>
                        <?php
                        $modelWrite2 = new \app\models\Writing();
                        ?>
                        <div class="modal-body">
                            <div class="modal_input">
                                <?=$formWrite1Printer->field($modelWrite2, 'title')->hiddenInput(['class'=>'write_printer_title'])->label(false)?>
                                <?=$formWrite1Printer->field($modelWrite2, 'name')->textInput(['placeholder'=>$modelWrite2->getAttributeLabel('name')])->label(false)?>
                                <?=$formWrite1Printer->field($modelWrite2, 'email')->textInput(['placeholder'=>$modelWrite2->getAttributeLabel('email')])->label(false)?>
                                <?=$formWrite1Printer->field($modelWrite2, 'text')->textarea(['rows'=>3,'placeholder'=>$modelWrite2->getAttributeLabel('text')])->label(false)?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?= \yii\helpers\Html::submitButton(t_app('Отправить'),['class' => 'modal_send']) ?>
                        </div>
                        <?php $formWrite1Printer = \yii\bootstrap\ActiveForm::end() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
    $(".model_printer").hover(function(){
        $(this).find('.printer_write input').show();
    });

    $(".model_printer").mouseleave(function(){
        $(this).find('.printer_write input').hide();
    });

    $('#cart-service .top_service').on("click",".title_history_bay th.sort_down",function () {
        var sort_input = $("input[name=sort]");
        if($(sort_input).val() === '4'){
            $(sort_input).val('3');
        }else{
            $(sort_input).val('4');
        }
        $('#form-model').submit();
    });
    var modalCallMePrinter = $("#callMePrinterModal");
    $('.comp .call_printer').on('click',function () {
        var name = $(this).closest("tr.model_printer").find("td").first().text();
        $(modalCallMePrinter).find("input.call_me_printer_desc").val(name);
    }); $('.version-lg .call_printer').on('click',function () {
        var name = $(this).parent().prev("li").find(".name-printer p").text();
        $(modalCallMePrinter).find("input.call_me_printer_desc").val(name);
    }); $('.ms-device .call_printer').on('click',function () {
        var name = $(this).parent().parent().find(".title_item p").text();
        $(modalCallMePrinter).find("input.call_me_printer_desc").val(name);
    });
    var modalWritePrinter = $("#writePrinterModal");
    $('.comp .write_printer').on('click',function () {
        var name = $(this).closest("tr.model_printer").find("td").first().text();
        $(modalWritePrinter).find("input.write_printer_title").val(name);
    }); $('.version-lg .write_printer').on('click',function () {
        var name = $(this).parent().prev("li").find(".name-printer p").text();
        $(modalWritePrinter).find("input.write_printer_title").val(name);
    }); $('.ms-device .write_printer').on('click',function () {
        var name = $(this).parent().parent().find(".title_item p").text();
        $(modalWritePrinter).find("input.write_printer_title").val(name);
    });
</script>