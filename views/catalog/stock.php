<?PHP
$this->title = $title;
$this->params['breadcrumbs'][] =  [
    'template' => "<li>/ <span>{link}</span></li>",
    'label' => $this->title,
];
$urlProductPage = \yii\helpers\Url::to('/product');//catalog/view TODO
?>

<!-- CONTAIN START -->
<!--small banner Block Start-->
<section class="mt-30">
    <div class="container">
        <div class="card-columns">
            <div class="col-md-6 pr-2 pl-2">
                <div class="small-banner">
                    <a>
                        <img src="images/sub-banner1.jpg" alt="Electrro">
                    </a>
                    <div class="small-banner-detail">
                        <div class="small-banner-title">Best collection  of cctv Camera</div>
                        <div class="small-banner-subtitle">from Sony, Zicom & more </div>
                        <a class="btn btn-color" href="">Просмотр</a>
                    </div>
                </div>
                <div class="small-banner">
                    <a>
                        <img src="images/small-banner1.jpg" alt="Electrro">
                    </a>
                    <div class="small-banner-detail">
                        <div class="small-banner-title">Best collection  of cctv Camera</div>
                        <div class="small-banner-subtitle">from Sony, Zicom & more </div>
                        <a class="btn btn-color" href="">Просмотр</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pr-2 pl-2">
                <div class="small-banner">
                    <a>
                        <img src="images/small-banner2.jpg" alt="Electrro">
                    </a>
                    <div class="small-banner-detail">
                        <div class="small-banner-title">Osmo Mobile Handheld</div>
                        <div class="small-banner-subtitle">Shop for Osmo Mobile Handheld</div>
                        <a class="btn btn-color" href="">Просмотр</a>
                    </div>
                </div>
                <div class="small-banner">
                    <a>
                        <img src="images/sub-banner3.jpg" alt="Electrro">
                    </a>
                    <div class="small-banner-detail">
                        <div class="small-banner-title">Osmo Mobile Handheld</div>
                        <div class="small-banner-subtitle">Shop for Osmo Mobile Handheld</div>
                        <a class="btn btn-color" href="">Просмотр</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!--small banner Block Start-->
