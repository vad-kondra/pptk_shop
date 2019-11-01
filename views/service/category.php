<?php


use app\models\service\CategoryService;
use kartik\helpers\Html;
use yii\helpers\Url;


$this->title = $title;

$this->params['breadcrumbs'][] =  [
    'template' => "<li aria-current=\"page\">{link}</li>",
    'label' => $this->title,
    'url' => ['/'.Yii::$app->controller->id . '/' . Yii::$app->controller->action->id],
];

$cur = Yii::$app->request->get("uname");
$bread = [];
while($cur != null) {
    $parent = CategoryService::findOne(["uname"=>$cur])->parent;
    if($cur == Yii::$app->request->get("uname")){
        $title = t_admin(CategoryService::findOne(["uname"=>$cur])->name);
        $this->title = $title;
        $bread[] =  [
            'template' => "<li aria-current=\"page\">{link}</li>",
            'label' => $title,
        ];
    }else{
        $bread[] = [
            'label' => t_admin(CategoryService::findOne(["uname"=>$cur])->name),
            'url' => Url::to(['/service/category',"uname"=>$cur ]),
        ];
    }

    $cur = $parent?$parent->uname:null;
}
$bread = array_reverse($bread);
$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'],$bread);

?>
        <div id="internet_shop" class="contents">
            <div class="container">
                <h1 class="mb-3 title"><?=$title?></h1>
                <?php if(sizeof($services)>0){?>
                    <div class="row">
                        <?php foreach ( $services as $service ){?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 item_product ">
                                <div class="shop_product">
                                    <?PHP
                                        $url = "";
                                        if($service instanceof \app\models\service\CategoryService)
                                                $url =Url::to(['/service/category', 'uname' => $service->uname]);
                                        else if($service instanceof \app\models\service\Service){
                                            switch ($service->type){
                                                case \app\models\service\Service::TYPE_COMMON:
                                                    $url =Url::to(['/service/device', 'uname' => $service->uname]);
                                                    break;
                                                case \app\models\service\Service::TYPE_PRINTER:
                                                    $url =Url::to(['/service/printer', 'uname' => $service->uname]);
                                                    break;
                                            }
                                        }
                                    ?>
                                    <a href=" <?= $url ?>">
                                        <div class="shop_img">
                                            <?= Html::img('/'.$service->getImageSrc()); ?>
                                        </div>
                                        <div class="shop_title">
                                            <p class="fz-hd-20"><?= t_admin($service->name);?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }else{ ?>
                    <h4 class="pb-5 pt-3 text-center text-secondary"><?=t_app('Ничего не найдено')?></h4>
                <?php } ?>
            </div>
        </div>