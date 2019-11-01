<?php


use yii\bootstrap\Alert;
use yii\bootstrap\Html;
use yii\widgets\Breadcrumbs;

?>

<div class="content-wrapper">
    <?php
    $msgs = [];
    if(Yii::$app->session->hasFlash("alert")){
        if(is_array(Yii::$app->session->getFlash("alert")))
            $msgs = Yii::$app->session->getFlash("alert");
        else
            array_push($msgs,["message"=>Yii::$app->session->getFlash("alert"),"type"=>"info"]);
    }
    foreach ($msgs as $msg) {
        Alert::begin([
            'options' => [
                'class' => 'alert-'.(isset($msg['type'])?trim($msg['type']):'info') . ' show',
            ]]);
        if(isset($msg["message"]))
            echo $msg['message'];
        else
            echo $msg;
        Alert::end();
    }
    ?>
    <section class="content-header">
        <h1><?=Html::encode($this->title) ?></h1>
        <?= Breadcrumbs::widget([
                'class'     => 'breadcrumb',
                'homeLink'  =>  [
                    'template'  =>  '<li class="breadcrumb-item">{link}</li>',
                    'url'       => '/admin',
                    'class'     =>  'breadcrumb-item',
                    'label'     =>  'Главная',
                ],
                'activeItemTemplate'=>'<li class="active breadcrumb-item">{link}</li>',
                'itemTemplate'  =>  '<li class="breadcrumb-item">{link}</li>',
                'tag'           =>  'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
        ?>
    </section>

    <section class="content" style="padding-bottom: 56px;">
        <?= $content ?>
    </section>
</div>

<!--<footer class="main-footer">
</footer>-->
<div class='control-sidebar-bg'></div>