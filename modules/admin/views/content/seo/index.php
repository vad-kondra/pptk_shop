<?php
$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerJs(<<<JS
function changeCategory() {
        var category_id = $('#category-sel').val();
        $.ajax({
            url: "/admin/content/seo/change-category",
            type: "post",
            data: {
                id: category_id,
            },
            error: function () {
                alert("Произошла ошибка!");
            }
        }).done(function (data) {
            var d =JSON.parse(data);
             
            $("#categoryIndTitle").val(d.title);
            $("#categoryIndDesc").val(d.desc);
        });
    }
    $(function () { changeCategory(); });
JS
, \yii\web\View::POS_END);?>


<?php $form = \yii\bootstrap\ActiveForm::begin(['action' => 'save-common']);?>

<h3><?=t_app('Общие шаблоны title, description')?></h3>
<div class="row">
    <div class="col-md-12">
        <h4 class="mt-3"><?=t_app('Общий шаблон для категорий') ." ( " . t_app('доступные заполнители') . ": {name} - ".t_app('название категории')." )"?></h4>
    </div>
    <div class="col-md-12">
        <p><?=t_app('по умолчанию: ') . \app\models\seo\SeoInfo::getDefaultValues()[\app\models\seo\SeoInfo::KEY_CATEGORY_COMMON_TITLE]?></p>
        <?=$form->field($model, 'category_common_title')->textInput()?>
        <p><?=t_app('по умолчанию: ') . \app\models\seo\SeoInfo::getDefaultValues()[\app\models\seo\SeoInfo::KEY_CATEGORY_COMMON_DESC]?></p>
        <?=$form->field($model, 'category_common_desc')->textInput()?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="mt-3"><?=t_app('Общий шаблон для продуктов') ." ( " . t_app('доступные заполнители') . ": {name} - ".t_app('название продукта').", {desc} - ".t_app('описание продукта').", {price} - ".t_app('цена')." )"?></h4>
    </div>
    <div class="col-md-12">
        <p><?=t_app('по умолчанию: ') . \app\models\seo\SeoInfo::getDefaultValues()[\app\models\seo\SeoInfo::KEY_PRODUCT_COMMON_TITLE]?></p>
        <?=$form->field($model, 'product_common_title')->textInput()?>
        <p><?=t_app('по умолчанию: ') . \app\models\seo\SeoInfo::getDefaultValues()[\app\models\seo\SeoInfo::KEY_PRODUCT_COMMON_DESC]?></p>
        <?=$form->field($model, 'product_common_desc')->textInput()?>
    </div>
</div>

<div class="text-center">
    <?=\yii\helpers\Html::submitButton(t_app('Сохранить'), ['class'=>'btn btn-success mt-3'])?>
</div>

<?php $form = \yii\bootstrap\ActiveForm::end();?>


<?php $form2 = \yii\bootstrap\ActiveForm::begin(['action' => 'save-category-seo']);?>
<h3 class="mt-3"><?=t_app('SEO текст для категорий')?></h3>
<div class="row">
    <div class="col-md-12">
        <?=$form2->field($model, 'category_seo_text')->textarea()->label(false)?>
    </div>
</div>
<div class="text-center">
    <?=\yii\helpers\Html::submitButton(t_app('Сохранить'), ['class'=>'btn btn-success mt-3'])?>
</div>
<?php $form2 = \yii\bootstrap\ActiveForm::end();?>


<?php $form3 = \yii\bootstrap\ActiveForm::begin(['action'=>'save-ind-template']);?>
    <h3 class="mt-5"><?=t_app('Индивидуальные шаблоны title, description для категорий')?></h3>
    <p><?="( " . t_app('доступные заполнители') . ": {name} - ".t_app('название категории')." )"?></p>
    <div class="row mt-5">
        <div class="col-md-1">
            <?=t_app('Категория')?>
        </div>
        <div class="col-md-4">
            <?=\yii\helpers\Html::dropDownList('category', [], \app\models\category\CategoryProduct::getCategoriesAsList2(),['class'=>'form-control', 'id'=>'category-sel', 'onchange' => 'changeCategory()'])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <p><?=$model->getAttributeLabel('product_common_title')?></p>
            <input type="text" name="category_ind_title" id="categoryIndTitle" class="form-control" value="">
        </div>
        <div class="col-md-12 mt-3">
            <p><?=$model->getAttributeLabel('product_common_desc')?></p>
            <input type="text" name="category_ind_desc" id="categoryIndDesc" class="form-control" value="">
        </div>
    </div>
    <div class="text-center">
        <?=\yii\helpers\Html::submitButton(t_app('Сохранить'), ['class'=>'btn btn-success mt-3'])?>
    </div>
<?php $form3 = \yii\bootstrap\ActiveForm::end();?>

<?php $form4 = \yii\bootstrap\ActiveForm::begin(['action'=>'save-common-seo']);?>
    <h3 class="mt-5"><?=$model->getAttributeLabel('site_common_seo')?></h3>
    <?=$form4->field($model, 'site_common_seo')->textarea(['rows'=>4])?>
    <div class="text-center">
        <?=\yii\helpers\Html::submitButton(t_app('Сохранить'), ['class'=>'btn btn-success mt-3'])?>
    </div>
<?php $form3 = \yii\bootstrap\ActiveForm::end();?>


