<?php

use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="alert alert-warning alert-dismissible fade show" role="alert" style="font-size: 12px;">
    <b>Примечание</b>: при добавлении слов вручную слова должны быть идентичными исходным словам. Важен каждый символ, пробел или регистр буквы.
</div>-->
<div class="translation-index">


    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title ) ?><sup> <span class="badge badge-info"> <?=getDataProviderCountItemHint($dataProvider) ?></span></sup></h1>

        <div class="form-group d-inline">
                <button class="btn btn-primary ml-auto add mr-5 mb-1"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline"> <?=t_app('Добавить')?></span></button>
            <div class="form-group d-inline-block">
                <form name='add' method="post" action="<?=\yii\helpers\Url::to('/admin/translation/add-by-type')?>" class="d-inline-block">
                    <label for="type_select"><?=t_app('Сгенерировать/обновить слова')?></label>
                    <select name='type' id="type_select" class="form-control">
                        <option value='-1'><?=t_app('Выбрать')?></option>
                        <option value='1'><?=t_app('Категории')?></option>
                        <option value='2'><?=t_app('Роли')?></option>
                        <option value='3'>Incoterms</option>
                        <option value='4'><?=t_app('Ссылки')?></option>
                        <option value='5'><?=t_app('Группы товаров')?></option>
                        <option value='6'><?=t_app('Предоставляемые товары')?></option>
                        <option value='7'><?=t_app('Упаковки')?></option>
                    </select>
                    <input type="hidden" class="_csrf" name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" />
                    <button type="submit" id="submit_btn" class=" float-right btn btn-primary mt-2"> <i class="fa fa-check"></i> <?=t_app('Применить')?></button>
                </form>
            </div>

        </div>

    </div>
    <div id="addDlg" title="Добавить" style="display: none;">
        <form id='addForm' action="<?=\yii\helpers\Url::to('/admin/translation/add-word')?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="add_title">Слово</label>
                <input type="text" name="word" class="form-control" id="add_word" aria-describedby="emailHelp">
            </div>

            <input type="hidden" class="_csrf" name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" />
            <button type="submit" class="mt-2 btnYes ui-button ui-widget ui-corner-all">Добавить</button>
            <button  type="button" class="mt-2 btnNo ui-button ui-widget ui-corner-all">Отмена</button>
        </form>
    </div>



    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center'
        ],
        'columns' => [
            'message',
           [
                'attribute'=>'msgEn',
                'format'=>'raw',
                'label'=> t_app('Английский'),
                'value'=>function($model){
                $id = $model->id;
                return  Editable::widget([
                        'formOptions' => ['action' => ['translation/set-en']],
                        'name'=>'msg',
                        'beforeInput' =>function() use ($id){
                                echo Html::input("hidden","id",$id);
                        },
                        'asPopover' => true,
                        'value' => Html::encode($model->messageEn),
                        'size'=>'md',
                        'options' => ['class'=>'form-control', 'placeholder'=>t_app('перевод') ." ".$model->message.'...'],
                    ]);
                }
            ],
            [
                'attribute'=>'msgUk',
                'format'=>'raw',
                'label'=> t_app('Украинский'),
                'value'=>function($model){
                    $id = $model->id;
                    return  Editable::widget([
                        'formOptions' => ['action' => ['translation/set-uk']],
                        'name'=>'msg',
                        'beforeInput' =>function() use ($id){
                            echo Html::input("hidden","id",$id);
                        },
                        'asPopover' => true,
                        'value' => Html::encode($model->messageUk),
                        'size'=>'md',
                        'options' => ['class'=>'form-control', 'placeholder'=>t_app('перевод') ." ".$model->message.'...'],
                    ]);
                }
            ],
            [
                'attribute'=>'msgTr',
                'format'=>'raw',
                'label'=> t_app('Турецкий'),
                'value'=>function($model){
                    $id = $model->id;
                    return  Editable::widget([
                        'formOptions' => ['action' => ['translation/set-tr']],
                        'name'=>'msg',
                        'beforeInput' =>function() use ($id){
                            echo Html::input("hidden","id",$id);
                        },
                        'asPopover' => true,
                        'value' => Html::encode($model->messageTr),
                        'size'=>'md',
                        'options' => ['class'=>'form-control', 'placeholder'=>t_app('перевод')." ".$model->message.'...'],
                    ]);
                }
            ],
            [
                'header' => t_app('Действие'),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons'=>[
                    'delete' => function ($url, $model) {
                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>',$url ,
                            ['data-confirm'=>t_app("Вы уверены что хотите удалить этот элемент?"),]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>

<style>
    .kv-editable-popover{left:50% !important;}
    .kv-editable-popover .arrow{display: none;}
    .kv-editable-parent input{font-size: 1.6rem !important;}
</style>
<script>
<?php
//получить все необходимые слова
$arr = \app\modules\admin\controllers\TranslationController::getAllWordsAsArray();
//получить уже записанные слова
$msgs = ArrayHelper::getColumn(\app\modules\admin\models\translation\SourceMessage::find()->select("message")->distinct(true)->all(),"message");
//фильтрация по незаписанным как ключ перевода
$arr = array_diff(array_unique($arr), $msgs);
$jsStrArr = '';
if(sizeof($arr) > 0) {
    foreach ($arr as $val)
        $jsStrArr .= '"' . $val . '",';
}
$this->registerJs(<<<JS

        $('#submit_btn').click(function (e) {
            var val = $('#type_select option:selected').val();
            if(val == (-1)){
                e.preventDefault();
            }
        });

        $("#editDlg,#addDlg").dialog({
            autoOpen:false,
            width: $("body").width() > 500?500:"100%"
        });


        $("#addDlg .btnNo").unbind("click").on("click",function () {
            $("#addDlg").dialog("close");
        });
        $("#editDlg .btnNo").unbind("click").on("click",function () {
            $("#editDlg").dialog("close");
        });
        $(".add").on("click",function () {
            $("#addDlg").dialog("open");
            var availableWords = [
                $jsStrArr
            ];
            $( "#add_word" ).autocomplete({
                source: availableWords,
                select:function (e,ui) {
                    $("#add_word").val(ui.item.value);
                }
            });
        });
JS
, \yii\web\View::POS_LOAD);
        ?>

</script>