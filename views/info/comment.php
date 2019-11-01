<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];

use app\models\Comment;
use app\models\service\CategoryService;
use app\widgets\CLinkPager;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


$isGuest = Yii::$app->user->isGuest;

 if (count($dpComments->getModels()) != 0){
            $query=  Comment::find()->where(['status' => 1, 'id_comment' => NULL, 'type' => Comment::TYPE_COMMENT]);
            $count = $query->count();
            $totalStarsCount = $query->sum('stars');
            $starsValue = round(($totalStarsCount)/$count, 1);
} ?>
<!--NEW COMMENT-->
<style>
    .form-control.is-valid,.form-control.is-invalid {
        border-color: #28a745;
        padding-right: 2.25rem;
        background-image: none;
    }
</style>
<div class="modal fade delivery" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?=t_app('Оставть отзыв о компании')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php $formComment = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['/info/comment-add']), 'method' => 'POST', 'id' => 'form_write']) ?>
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

                        <div class="col-md-6">
                            <h4><?=t_app('Какими услугами вы воспользовались?')?></h4>
                            <?= $formComment->field($modelComment, 'category', ['template'=>'{input}'])->textInput(['maxlength' => true, 'placeholder' => t_app('Один или несколько пунктов'), 'id' => 'type_service', 'class'=>'form-control'])->label(false) ?>
                            <label for="type_service" class="type_service_down"><i class="fas fa-chevron-down"></i></label>
                            <div class="category_block">
                                <div class="block_down">
                                    <ul>
                                        <li>
                                            <input type="checkbox" class="category" name="category-tovar" id="category-tovar" value="0">
                                            <label for="category-tovar"><?=t_app('Приобретение товаров')?></label>
                                        </li>
                                        <?php foreach (CategoryService::find()->where(['service_category_id' => NULL])->all() as $category){ ?>
                                            <li><input type="checkbox" name="category-<?= $category->id ?>" class="category" id="<?= $category->id ?>" value="<?= $category->id ?>">
                                                <label for="<?= $category->id ?>"><?= t_admin($category->name) ?></label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
<!--                <button type="button" class="modal_send" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#recovery-3">Опубликовать отзыв</button>-->
                <?= Html::submitButton(t_app('Опубликовать отзыв'), ['class' => 'modal_send']) ?>
            </div>
            <?php $formComment = \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
</div>
<!--NEW COMMENT-->
        <div id="contact" class="content comment_page">
            <div class="container">
                <div class="commet_coll">
                    <div class="commet_number mb-2 mt-2">
                        <?php if (count($dpComments->getModels()) != 0){ ?>
                            <h5><?=$starsValue?> <?=t_app('из')?> 5</h5>
                        <?php } ?>
                        <h1><?=$this->title?></h1>
                        <p class="service_number"><?=$totalCommentsCount ?></p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 col-xl-9">
                        <div class="comment_sort">
                            <div class="item_select">
                                <?php if(!$isGuest){ ?>
                                    <input type="button" data-toggle="modal" data-target="#comment" value="<?=t_app('Оставить отзыв')?>" class="blue-button mb-24 float-right w-auto">
                                <?php } ?>
                                <div class="select">
                                    <ul >
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
                                if($dpComments->getTotalCount() > 0){
                                    foreach ($dpComments->getModels() as $comment){ ?>
                                        <div class="comment_client">
                                            <div class="top_comment">
                                                <div class="client_info">
                                                    <div class="client_name">
                                                        <strong><?= $comment->getUserUsername()?></strong>
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
                                                    <div class="comment_date"><span><?= getModelDate($comment->date,true)?></span></div>
                                                </div>
                                            </div>
                                            <div class="comment_content">
                                                <p><?= $comment->text ?></p>
                                                <p><strong><?=$comment->getAttributeLabel('virtues')?>:</strong><?= $comment->virtues ?></p>
                                                <p><strong><?=$comment->getAttributeLabel('disadvantages')?>:</strong><?= $comment->disadvantages ?></p>
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
                                                                    <span><?= getModelDate($subComment->date,true)?></span>
                                                                </div>
                                                                <div class="client_name">
                                                                    <strong><?= $subComment->getUserUsername()?></strong>
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
                                                                    <div class="float-right comment_date"><span><?= getModelDate($c->date,true)?></span></div>
                                                                    <div class="top_comment">
                                                                        <div class="client_info">
                                                                            <div class="client_name">
                                                                                <strong><?= $c->getUserUsername()?></strong>
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
                                'pagination' => $dpComments->getPagination(),

                                'activePageCssClass' => 'page_activ',
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
                    <div class="col-lg-3 lg-device">
                        <aside class="asaid_menu ">
                            <?php if(!$isGuest){ ?>
                                <input type="button" data-toggle="modal" data-target="#comment" value="<?=t_app('Оставить отзыв')?>" class="blue-button mb-24 fz-hd-20">
                            <?php } ?>
                            <?=getAsaidMenuAsLayout('comment')?>
                            <div id="rating">
                                <?php if (count($dpComments->getModels()) != 0){ ?>
                                    <h5><?=$starsValue?> <?=t_app('из')?> 5</h5>
                                <?php } ?>
                                <div class="result_stars">
                                    <div class="result_item">
                                        <div class="star">
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                        </div>
                                        <div class="text_star">
                                            <p><a href="<?= Url::to(['/info/comment','stars' => 5]) ?>" class="fz-hd-18">
                                                    <?php
                                                    $count = count(Comment::findAll(['stars' => 5, 'status' => 1, 'type' => Comment::TYPE_COMMENT]));
                                                    if($count == 1 ){
                                                        echo $count.' отзыв';
                                                    } else {
                                                        echo $count.' отзыва';
                                                    }
                                                    ?>
                                                </a></p>
                                        </div>
                                    </div>
                                    <div class="result_item">
                                        <div class="star">
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                        </div>
                                        <div class="text_star">
                                            <p><a href="<?= Url::to(['/info/comment','stars' => 4]) ?>" class="fz-hd-18">
                                                    <?php
                                                    $count = count(Comment::findAll(['stars' => 4, 'status' => 1, 'type' => Comment::TYPE_COMMENT]));
                                                    if($count == 1 ){
                                                        echo $count.' отзыв';
                                                    } else {
                                                        echo $count.' отзыва';
                                                    }
                                                    ?>
                                                </a></p>
                                        </div>
                                    </div>
                                    <div class="result_item">
                                        <div class="star">
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                        </div>
                                        <div class="text_star">
                                            <p><a href="<?= Url::to(['/info/comment','stars' => 3]) ?>" class="fz-hd-18">
                                                    <?php
                                                    $count = count(Comment::findAll(['stars' => 3, 'status' => 1, 'type' => Comment::TYPE_COMMENT]));
                                                    if($count == 1 ){
                                                        echo $count.' отзыв';
                                                    } else {
                                                        echo $count.' отзыва';
                                                    }
                                                    ?>
                                                </a></p>
                                        </div>
                                    </div>
                                    <div class="result_item">
                                        <div class="star">
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                        </div>
                                        <div class="text_star">
                                            <p><a href="<?= Url::to(['/info/comment','stars' => 2]) ?>" class="fz-hd-18">
                                                    <?php
                                                    $count = count(Comment::findAll(['stars' => 2, 'status' => 1, 'type' => Comment::TYPE_COMMENT]));
                                                    if($count == 1 ){
                                                        echo $count.' отзыв';
                                                    } else {
                                                        echo $count.' отзыва';
                                                    }
                                                    ?>
                                                </a></p>
                                        </div>
                                    </div>
                                    <div class="result_item">
                                        <div class="star">
                                            <i class="fas fa-star bg_yello"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                            <i class="fas fa-star bg_gray"></i>
                                        </div>
                                        <div class="text_star">
                                            <p><a href="<?= Url::to(['/info/comment','stars' => 1]) ?>" class="fz-hd-18">
                                                    <?php
                                                    $count = count(Comment::findAll(['stars' => 1, 'status' => 1, 'type' => Comment::TYPE_COMMENT]));
                                                    if($count == 1 ){
                                                        echo $count.' отзыв';
                                                    } else {
                                                        echo $count.' отзыва';
                                                    }
                                                    ?>
                                                </a></p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
<div class="answer_comment_form">
    <?php ActiveForm::begin(['action' => Url::to(['/info/answer']), 'method' => 'POST', 'id' => 'answer_comment']); ?>
    <textarea name="answer_comment" id="answer_comment_form" placeholder="Ваш коментарий"></textarea>
    <div class="button_answer">
        <?= \yii\bootstrap4\Html::submitButton('Ответить',['class' => 'b_answer blue-button']) ?>
        <input type="button" class="b_cancel" value="Отмена">
        <input type="hidden" name="id_comment" class="id_comment">
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
</script>