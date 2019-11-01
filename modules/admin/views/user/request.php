<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\userSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>",
    'label' => $this->title
];

?>
<div class="user-index">

    <h1><?= Html::encode($this->title ) ?><sup> <span class="badge badge-info"> <?=getDataProviderCountItemHint($dataProvider) ?></span></sup></h1>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center'
        ],

        'columns' => [
            'company_name',
            'username',
            'email',
            'phone',
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return getModelDate($model->created_at);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => t_app('Действие'),
                'contentOptions' => ['width' => '200px'],
                //'template' => \mdm\admin\components\Helper::filterActionColumn('{view}{update}{delete}{pricegroup}'),
                'template' => '{message}{accept}{decline}',
                'buttons' => [
                    'message' => function($url, $model){
                        return \yii\helpers\Html::tag("span", "",
                            [ 'title' => t_app('просмотр сообщения'), 'data-message'=>$model->message, 'class'=> 'show-message glyphicon glyphicon-envelope', 'style'=>['cursor'=>'pointer','color'=>'#428bca']]
                        );
                    },
                    'accept' => function($url, $model){
                        return \yii\helpers\Html::a("<span class='glyphicon glyphicon-ok'></span>",
                            $url,
                            [ 'title' => t_app('принять')]
                        );
                    },
                    'decline' => function($url, $model){
                        return \yii\helpers\Html::a("<span class='glyphicon glyphicon-remove'></span>",
                            $url,
                            [ 'title' => t_app('отклонить') ."(".t_app('удалить').")"]
                        );
                    }
                ]
            ],
        ],
    ]);


    ?>
</div>

    <div id="messageDlg" title="<?=t_app('Сообщение')?>" style="display: none;">
        <div class="label-message text-justify"></div>
        <div class="text-center mt-3">
            <button  type="button" class="mt-2 btnHide ui-button ui-widget ui-corner-all"><?=t_app('Закрыть')?></button>
        </div>
    </div>

<?php
    $this->registerJs(<<<JS
        $("#messageDlg").dialog({
            autoOpen:false,
            width: $("body").width() > 500?500:"100%"
        });

        $(".show-message").on("click", function () {
            $("#messageDlg").dialog("open");
            var message = $(this).data('message');
            $("#messageDlg .label-message").text(message);
        });

        $(".btnHide").on("click", function () {
            $("#messageDlg").dialog("close");
        });
JS
,\yii\web\View::POS_END);
?>