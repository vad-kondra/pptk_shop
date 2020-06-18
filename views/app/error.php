<?php

use app\models\search\SearchForm;
use yii\helpers\Html;

$this->title = $title;
$searchForm = new SearchForm();
?>
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
                        <?= Html::beginForm(['/catalog/search'], 'get', ['id' => 'search-form']) ?>

                            <?= Html::input('text', 'text', $searchForm->text, ['class' => 'input-text', 'placeholder' => 'Поиск'])?>
                            <button><i class="fa fa-search"></i></button>

                        <?= Html::endForm() ?>
                    </div>

                    <div class="error-button">
                        <a href="<?=Yii::$app->homeUrl?>">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
