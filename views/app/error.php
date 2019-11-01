<?php
    $this->title = $title;
?>
    <!--================================
            START 404 AREA
    =================================-->
<?php
switch ($code){
    case 404:?>
        <!-- CONTAIN START ptb-70-->
        <section class="ptb-70 gray-bg error-block-main">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="error-block-detail error-block-bg">
                            <div class="row">
                                <div class="col-lg-5 col-md-6"></div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="main-error-text">404</div>
                                    <div class="error-slogan">Страница которую Вы ищете не существует</div>
                                    <div class="mt-40"> <a href="<?=Yii::$app->homeUrl?>" class="btn btn-color">На Главную</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CONTAINER END -->
        <?PHP
        break;
    default:?>
        <div class="not_found">
            <h3 class="mb-0"><?='Ошибка '.' #'.$code?></h3>
            <h4 class="mb-2"><?=$msg?></h4>
            <a href="<?=Yii::$app->homeUrl?>" class="btn btn-primary">На Главную</a>
        </div>

    <?PHP
}
?>
    <!--================================
            END 404 AREA
    =================================-->
