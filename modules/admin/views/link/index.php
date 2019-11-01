<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\LinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title ) ?><sup> <span class="badge badge-info"> <?=getDataProviderCountItemHint($dataProvider) ?></span></sup></h1>

    <?=Html::a(t_app('Обновить'), \yii\helpers\Url::to('refresh'), ['class'=>'btn btn-default'])?>
    <div class="float-right">
        <?= Html::button("<span class='glyphicon glyphicon-plus' style='font-size: 1em;'></span>".t_app('Создать'), ['class' => 'btn btn-success add']) ?>
    </div>


    <div id="addDlg" title="<?=t_app('Добавить')?>" style="display: none;">
        <form id='addForm' action="<?=\yii\helpers\Url::to('/admin/link/create')?>" method="post" >
            <div class="form-group">
                <label for="add_title"><?=t_app('Название ссылки')?></label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">

                <label for="add_title"><?=t_app('Ссылка')?></label>
                <input type="text" name="href" class="form-control" id="href" aria-describedby="emailHelp">

                <label for="type" class="mt-3"><?=t_app('Расположение')?>:</label>
                <select name="type" class="form-control">
                    <option value="1">header</option>
                    <option value="2">footer</option>
                    <option value="3">header & footer</option>
                    <option value="4"><?=t_app('спрятана')?></option>
                </select>
            </div>

            <input type="hidden" class="_csrf" name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" />
            <button type="submit" class="mt-2 btnYes ui-button ui-widget ui-corner-all"><?=t_app('Добавить')?></button>
            <button  type="button" class="mt-2 btnNo ui-button ui-widget ui-corner-all"><?=t_app('Отмена')?></button>
        </form>
    </div>
    <div id="editDlg" title="<?=t_app('Редактировать')?>" style="display: none;">
        <form id='editForm' action="<?=\yii\helpers\Url::to('/admin/link/update')?>" method="post" enctype="multipart/form-data">
            <input type="text" hidden name="edit_id" class="form-control" id="editid" >
            <div class="form-group">
                <label for="add_title"><?=t_app('Название ссылки')?></label>
                <input type="text" name="edit_name" class="form-control" id="edit_name" aria-describedby="emailHelp">

                <label for="add_title"><?=t_app('Ссылка')?></label>
                <input type="text" name="edit_href" class="form-control" id="href" aria-describedby="emailHelp">

                <label for="type" class="mt-3"><?=t_app('Расположение')?>:</label>
                <select name="edit_type" id="linkType" class="form-control">
                    <option value="1">header</option>
                    <option value="2">footer</option>
                    <option value="3">header & footer</option>
                    <option value="4"><?=t_app('спрятана')?></option>
                </select>
                <label for="type" class="mt-3"><?=t_app('Порядок')?>:</label>
                <select name="pos" id="linkPos" class="form-control">
                    <?php
                    for($i=1; $i<= $dataProvider->getTotalCount(); $i++){
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" id="itemId" name="item_id" value="" />
            <input type="hidden" class="_csrf" name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" />
            <button type="submit" class="mt-2 btnYes ui-button ui-widget ui-corner-all"><?=t_app('Изменить')?></button>
            <button  type="button" class="mt-2 btnNo ui-button ui-widget ui-corner-all"><?=t_app('Отмена')?></button>
        </form>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{items}{pager}',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center'
        ],
        'columns' => [
            [
                'attribute' => 'name',
                'format'=>'raw',
                'value' => function($model) {
                    return "<span class='linkName'>".$model->name."</span>";
                },
            ],
            [
                'attribute' => 'href',
                'format'=>'raw',
                'value' => function($model) {
                    if($model->item_id == 0){
                        return "<span class='linkHref'>".$model->href."</span>";
                    }else{
                        return "<span class='linkHref'>".$model->href."</span>";
                    }
                },
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'filter' => [\app\models\Link::TYPE_HEADER => 'header', \app\models\Link::TYPE_FOOTER=>'footer', \app\models\Link::TYPE_HEADER_FOOTER=> 'header & footer', \app\models\Link::TYPE_HIDDEN => t_app('спрятана')],
                'value' => function($model){
                    return $model->getTypeAsString();
                }
            ],
            [
                'attribute' => 'pos',
                'format' => 'raw',
                'value' => function($model){
                    return "<span class='linkPos'>".$model->pos."</span>";
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => t_app('Действие'),
                //'template' => Helper::filterActionColumn('{update}{delete}'),
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return \yii\helpers\Html::tag('span', '', [ "class"=>"editBtn glyphicon glyphicon-pencil", 'title' => t_app('Редактировать'), 'style' => 'color: #428bca; cursor:pointer']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
<?php
    $this->registerJs(<<<JS
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
        });
        $(".editBtn").on("click",function () {
            var id = $(this).parent().parent().data("key");
            $("#editDlg #editid").val(id);
            $("#editDlg #edit_name").val($(this).parent().parent().find(".linkName").text());
            $("#editDlg #href").val($(this).parent().parent().find(".linkHref").text());
            $("#editDlg #linkType").val($(this).parent().parent().find(".linkType").data("type-val"));
            $("#editDlg #linkPos").val($(this).parent().parent().find(".linkPos").text());
            $("#editDlg").dialog("open");
        });
JS
,\yii\web\View::POS_LOAD);
?>