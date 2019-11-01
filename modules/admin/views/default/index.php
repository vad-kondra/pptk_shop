
<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $newOrderCount integer */

$this->title = 'Рабочий стол';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-default-index">
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?=$newOrderCount?></h3>
                        <p>Новых заказов</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="<?=Url::to('/admin/order/index?OrderSearch%5Bcreated_at%5D=&OrderSearch%5Buser_id%5D=&OrderSearch%5Bcost%5D=&OrderSearch%5Bcurrent_status%5D=1')?>" class="small-box-footer">Подробней <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</div>
