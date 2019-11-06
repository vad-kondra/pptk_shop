<?php

use app\models\search\SearchForm;

$this->title = $title;
$searchForm = new SearchForm();
?>


<!-- Error 404 Area Start -->
<div class="error404-area pb-60 pt-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-wrapper text-center">
                    <div class="error-text">
                        <h1>404</h1>
                        <h2>Ой! СТРАНИЦА НЕ НАЙДЕНА</h2>
                        <p>Извините, но страницы которую вы ищите не существует. Возможно она была удалена, переименнована или временно не доступна.</p>
                    </div>


                    <div class="search-error">
                        <?= \yii\helpers\Html::beginForm(['/catalog/search'], 'get', ['id' => 'search-form']) ?>

                            <?=\yii\helpers\Html::input('text', 'text', $searchForm->text, ['class' => 'input-text', 'placeholder' => 'Поиск'])?>
                            <button><i class="fa fa-search"></i></button>

                        <?= \yii\helpers\Html::endForm() ?>
                    </div>

                    <div class="error-button">
                        <a href="<?=Yii::$app->homeUrl?>">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error 404 Area End -->