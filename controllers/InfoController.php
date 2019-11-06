<?php

namespace app\controllers;

use app\models\CallBack;
use app\models\Config;
use app\models\news\News;
use keltstr\simplehtmldom\SimpleHTMLDom;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\web\Response;


class InfoController extends AppController
{


    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'call-back' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIhbbkb(){
        $this->layout = null;
        Yii::$app->cache->flush();
        return $this->goHome();
    }

    public function actionMain(){
        return $this->render('main', [
            'title' => Config::getValue(Config::MAIN_TITLE)
        ]);
    }

    public function actionNews($id){
        $newsItem = News::findOne($id);
        if ($newsItem) {
            return $this->render('news', [
                'news' => $newsItem
            ]);
        }
    }

    public function actionAbout(){
        return $this->render('about', ['title' => 'О нас', 'permission' => '',]);
    }



    public function actionContact(){
        $title = 'Контакты';

        return $this->render('contact', [
            'title' => $title,
            'permission' => '',
        ]);
    }

    function mkpass($password, $salt=null)
    {
        if (!isset($password)) return false;
        if (null===$salt) $salt=substr(sha1(mt_rand()), 0, 16);
        return crypt(md5($password), '$1$' . $salt . '$');
    }

    function salt_generation($length=18)
    {
        return substr(sha1(mt_rand()), 0, $length);
    }


    public function actionTerms(){
        $title = 'Пользовательское соглашение';
        return $this->render('privacy-policy', [
            'title' => $title,
            'permission' => '',
        ]);
    }
    public function actionProducers(){
        $title = 'Производители';
        return $this->render('producers', [
            'title' => $title,
            'permission' => '',
        ]);
    }


    public function actionDelivery(){
        $title = 'Условие доставки';
        return $this->render('delivery',[
            'title' => $title,
            'permission' => '',
        ]);
    }

    public function actionPayment(){
        $title = 'Условие оплаты';
        return $this->render('payment',[
            'title' => $title,
            'permission' => '',
        ]);
    }

    public function actionDiscount(){

        $title = 'Акции';
        $isGuest = Yii::$app->user->isGuest;
        $page = 24;
        if($val = Yii::$app->request->get('per-page')){
            $page = $val;
        }
        $sort_val = SORT_DESC;
        $sort = "name";
        if($valSort = Yii::$app->request->get('o')){
            switch ($valSort){
                case 1: $sort = "name";
                    $sort_val = SORT_DESC;
                    break;
                case 2: $sort = "price";
                    $sort_val = SORT_ASC;
                    break;
                case 3: $sort = "price";
                    $sort_val = SORT_DESC;
                    break;
                case 4: $sort = "id";
                    $sort_val = SORT_ASC;
                    break;
            }
        }
        if(isset($_GET['uname'])){
            $uname = $_GET['uname'];
            $discount = Discount::findOne(['uname' => $uname]);
            $query = $discount->getProducts();
            $title = $discount->title;
        }else{
            $query = Product::find()
                ->leftJoin("product_to_discount as ptd","product.id=ptd.p_id")
                ->leftJoin("discount as disc","disc.id=ptd.d_id")
                ->where(["<=","disc.date_start",new Expression("NOW()")])
                ->andWhere([">=","disc.date_expire",new Expression("NOW()")])
                ->andWhere(["disc.enabled"=>true]);
        }


        //list of categories
        $category_ids = ArrayHelper::getColumn($query->all(), 'id_category_shop');
        $categories = CategoryShop::find()->where(['in', 'id', $category_ids])->all();

        //producers list
        $producers = ArrayHelper::getColumn($query->all(), 'producer', false);
        //delete all empty values
        $producers = array_filter($producers);

        //county select list
        $countryList = getCountryListRu();

        $categoryModel = null;
        //CATEGORY search
        if(isset($_GET['category'])){
            $catGetId = $_GET['category'];
            if($catGetId != 0)// 0 - search by all categories
            {
                $query->andWhere(['=', "id_category_shop", $catGetId]);

                $categoryModel = CategoryShop::findOne($catGetId);
                unset($_GET['Feature']);
                $features = \Yii::$app->request->get("Feature");
                if(is_array($features )) {
                    //debug($features);die;
                    foreach ($features as $feature_id => $val) {
                        //debug($features);die;
                        if (is_array($val) && isset($val["min"]) && isset($val["max"])) {
                            $subQuery = (new Query())->select("product.id")
                                ->from("product")
                                ->leftJoin("feature_value_to_product as fvtp", "fvtp.product_id = product.id")
                                ->leftJoin("feature_value as fv", "fv.id = fvtp.feature_value_id")
                                ->leftJoin("feature", "fv.feature_id=feature.id")
                                ->where(["feature.id" => $feature_id])
                                ->andWhere([">=", "fv.name", $val["min"]])
                                ->andWhere(["<=", "fv.name", $val["max"]]);
                        } else {
                            $subQuery = (new Query())->select("product.id")
                                ->from("product")
                                ->leftJoin("feature_value_to_product as fvtp", "fvtp.product_id = product.id")
                                ->leftJoin("feature_value as fv", "fv.id = fvtp.feature_value_id")
                                ->leftJoin("feature", "fv.feature_id=feature.id")
                                ->where(["=", "feature.id", $feature_id])
                                ->andWhere(["fv.id" => $val]);
                        }
                        $query->andWhere(["in", "product.id", $subQuery]);
                    }
                }

            }
        }
        //PRODUCER SEARCH
        if(isset($_GET['p']) && is_array($_GET['p'])){
            $producerParam = $_GET['p'];
            $query->andWhere(['in', 'producer', $producerParam]);
        }
        //COUNTRY search
        if( isset($_GET['country']) ){
            $countryParam = $_GET['country'];
            if($countryParam !== '0'){
                $query->andWhere(['country'=>$countryParam ]);
            }
        }

        //price slider
        $maxPriceSlider = $query->max('price');
        $minPrice = Yii::$app->request->get("price_min",0);
        $maxPrice = Yii::$app->request->get("price_max",$maxPriceSlider);

        //price filter
        $query->andFilterWhere([">=","product.price",$minPrice]);
        $query->andFilterWhere(["<=","product.price",$maxPrice]);

        //status filter
        if(is_array(Yii::$app->request->get("status")))
            $query->andWhere(["in","product.id_status",Yii::$app->request->get("status")]);

        $sales = Discount::find()->where(['on_main'=>true])
            ->andWhere(["<=","date_start",new Expression("NOW()")])
            ->andWhere([">=","date_expire",new Expression("NOW()")])
            ->andWhere(["enabled"=>true])
            ->all();

        $dpProducts = new ActiveDataProvider(['query'=>$query, 'pagination'=>['pageSize'=>$page],
            'sort' => [
                'defaultOrder' => [
                    $sort => $sort_val,
                ]
            ],
        ]);
        return $this->render('discount',[
            'title' => $title,
            'dpProducts' => $dpProducts,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'maxPriceSlider' => $maxPriceSlider,
            'page'=>$page,
            'isGuest'=>$isGuest,
            'categoryModel'=>$categoryModel,
            'categories' => $categories,
            'producers' => $producers,
            'countryList' => $countryList,
            'sales' => $sales
        ]);
    }

    //TODO SMSFLY
    public function actionCallBack(){
        addGrowl('Ожидайте звонка!');
        $modalCallMe = new CallBack();
        if(Yii::$app->request->isPost){
            if($modalCallMe->load(Yii::$app->request->post())){
                if(empty($modalCallMe->name)){
                    if(!Yii::$app->user->isGuest){
                        $modalCallMe->name = Yii::$app->user->identity->getFullName();
                    }else{
                        $modalCallMe->name = "—";
                    }
                }
                if($modalCallMe->save()){
                    return $this->goHome();
                }else{

                    return $this->goHome();
                }
            }
        }
        return $this->goHome();
    }



    /*public function actionSearch(){
        $isGuest = Yii::$app->user->isGuest;
        if(isset($_GET['url']) && isset($_GET['name']))
        {
            $url = $_GET['url'];
            //debug($url);die;
            $name = $_GET['name'];
            if($isGuest){
                $ss = new SearchSession();
                //$newUrl = $url[0].'?search='.$url['search'];
                //$newUrl = Url::to(['/info/search','search'=>$search]);
                $ss->addSearch(['name'=>$name, 'url'=>$url]);
            }else{
                $search = new UserSearch();
                $search->url = $url;
                $search->name = $name;
                $search->user_id = Yii::$app->user->getId();
                $search->save();
            }
            return $this->redirect($_GET['url']);
        }elseif (isset($_GET['search']))
        {
            $search = $_GET['search'];
            if(empty($search))
                return $this->goHome();
            if($isGuest){
                $ss = new SearchSession();
                $ss->addSearch(['name'=>$search, 'url'=>Url::to(['/info/search','search'=>$search])]);
            }else{
                $searchM = new UserSearch();
                $searchM->name= $search;
                $searchM->url = Url::to(['/info/search','search'=>$search]);
                $searchM->user_id = Yii::$app->user->getId();
                $searchM->save();
            }
            $title2 = 'Результаты поиска по'." \"$search\".";
            $title3 = 'По запросу'." \"$search\" ".'ничего не найдено.';
            $title = 'Поиск';
            $services = CategoryService::find()->where(['like','name',$search])->all();
            $products = Product::find()->where(['like','name',$search])->all();
            return $this->render('search', [
                'title' => $title,
                'title2' => $title2,
                'title3' => $title3,
                'services' => $services,
                'products' => $products,
            ]);
        }else{
            throw new UserException('Отсутствуют обязательные параметры!');
        }
    }*/




    //search on typing (key pressed) in input search
    public function actionTypeSearch(){
        if(Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $nothingFound = 'Ничего не найдено';
            if(Yii::$app->language == 'uk'){
                $nothingFound = 'Нічого не знайдено';
            }
            $data = "<p class='text-center' style='padding:14px 20px;color:grey;'>$nothingFound</p>";
            $param = Yii::$app->request->post('val');
            if(empty($param))
                return "";
            $services = CategoryService::find()->where(['like', 'name', $param])->all();
            $products = Product::find()->where(['like', 'name',$param])->all();
            if(sizeof($services) == 0 && sizeof($products) == 0){
                return $data;
            }else{
                $seeAllLabel = 'Смотреть все результаты';
                $urlAll = Url::to(["/info/search", 'search'=>$param]);
                $data = <<<EOT
                    <a href="$urlAll" class="all_results">$seeAllLabel <i class="fas fa-arrow-right"></i></a>
                        <div style="padding: 12px;">
                            <div class="serch_content">
EOT;
            }

            if(sizeof($services) > 0 )
            {
                $label = 'Услуги';
                $data.=<<<EOT
                <div class="serch_group">
                    <p class="serch_group_title">$label</p>
EOT;
                foreach ($services as $service){
                    $url = Url::to(["search", "url" => "/service/category","uname=".$service->uname, 'name'=>$service->name]);
                    //$name = str_ireplace($param, "<strong>$param</strong>", $service->name);
                    $name = preg_replace("/".preg_quote($param)."/ui", "<b>$0</b>", $service->name);
                    $data.=<<<EOT
                    <div class="serch_group_item">
                        <a href="$url">$name</a>
                            </div>
EOT;
                }
                $data.="</div>";

            }
            if(sizeof($products) > 0 ){
                $label = 'Товары';
                $data.=<<<EOT
                <div class="serch_group">
                    <p class="serch_group_title">$label</p>
EOT;
                foreach ($products as $product){
                    $url = Url::to(["search", "url" => "/product/".$product->uname, 'name'=>$product->name]);
                    $name = preg_replace("/".preg_quote($param)."/ui", "<b>$0</b>", $product->name);
                    $img_src = $product->getImageSrc();
                    $data.=<<<EOT
                    <div class="serch_group_item">
                        <a href="$url">
                            <img src="/$img_src" alt="">
                            $name
                        </a>
                    </div>
EOT;
                }
                $data.="</div>";
            }
            return $data;
        }
    }

    public function actionWishList(){
        return $this->render('wish-list',['title'=>'Избранное',]);
    }

}