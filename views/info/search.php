<?php
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];
?>

<style>
    .s_a{
        display: block;
        margin: 10px 0 10px 20px;
        align-content: center;
    }
    .s_a:hover{
        color:#0056b3;
        text-decoration: none;
    }
    .s_a img{
        width: 50px;
    }
</style>
<div class="content">

    <div class="container">
        <h1><?=$title2?></h1>
        <div class="search_results">
            <?php
            $ss = sizeof($services);
            $sp = sizeof($products);
            if($ss > 0 || $sp > 0)
            {
                if($ss > 0){?>
                    <h6><?=t_app('Услуги')?></h6>
                    <?php foreach ($services as $service)
                    {?>
                        <div>
                            <a class="s_a" href="<?=\yii\helpers\Url::to(['/service/category','uname'=>$service->uname])?>">
                                <img src="/<?=$service->getImageSrc()?>" alt="">
                                <?=$service->name?>
                            </a>
                        </div>
                        <?php
                    }
                }
            ?>
            <?php
                if(sizeof($sp > 0)){?>
                    <h6><?=t_app('Продукты')?></h6>
                    <?php foreach ($products as $product)
                    {?>
                        <a class="s_a" href="<?=\yii\helpers\Url::to(['/product/view','uname'=>$product->uname])?>">
                            <img src="/<?=$product->getImageSrc()?>" alt="">
                            <?=$product->name?></a>
                        <?php
                    }
                }
            }else{
                ?>
                <h5 class="text-center mt-5 mb-5"><?=$title3?></h5>
            <?php } ?>
        </div>
    </div>
</div>
