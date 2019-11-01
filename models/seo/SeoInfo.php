<?php

namespace app\models\seo;

use app\models\product\CategoryShop;
use Yii;
use yii\caching\TagDependency;

/**
 * This is the model class for table "seo_info".
 *
 * @property int $id
 * @property string $key_v
 * @property string $value
 */
class SeoInfo extends \yii\db\ActiveRecord
{
    //const KEY_SITE_TITLE = 'site_common_title';
    const KEY_SITE_DESC = 'site_common_desc';

    const KEY_PRODUCT_COMMON_TITLE = 'product_common_title';
    const KEY_PRODUCT_COMMON_DESC = 'product_common_desc';

    const KEY_CATEGORY_REPAIR_TITLE = 'category_service_repair_title';
    const KEY_CATEGORY_REPAIR_DESC = 'category_service_repair_desc';

    const KEY_CATEGORY_REFILL_TITLE = 'category_service_refill_title';
    const KEY_CATEGORY_REFILL_DESC = 'category_service_refill_desc';

    const CACHE_TAG_DEPENDENCY_SEO_INFO = 'cage_tag_seo_info';


    //PRODUCT
    public static function getProductCommonTitle($prod_name, $desc, $price){
        $data = t_app( self::getValue(self::KEY_PRODUCT_COMMON_TITLE) );
        if(empty($data)) {
            $data = self::getDefaultValues()[self::KEY_PRODUCT_COMMON_TITLE];
        }
        $str = str_replace('{name}', $prod_name, $data);
        $str = str_replace('{desc}', $desc, $str);
        $str2 = str_replace('{price}', $price, $str);
        return strip_tags($str2);
    }
    public static function getProductCommonDesc($prod_name, $desc, $price){
        $data = self::getValue(self::KEY_PRODUCT_COMMON_DESC);
        if(empty($data)) {
            $data = self::getDefaultValues()[self::KEY_PRODUCT_COMMON_DESC];
        }
        $str = str_replace('{name}', $prod_name, $data);
        $str = str_replace('{desc}', $desc, $str);
        $str2 = str_replace('{price}', $price, $str);
        return strip_tags($str2);
    }

    public static function getRepairCommonTitle($name, $desc, $price){
        $data = t_app( self::getValue(self::KEY_CATEGORY_REPAIR_TITLE) );
        if(empty($data)) {
            $data = self::getDefaultValues()[self::KEY_CATEGORY_REPAIR_TITLE];
        }
        $str = str_replace('{name}', $name, $data);
        $str = str_replace('{desc}', $desc, $str);
        $str2 = str_replace('{price}', $price, $str);
        return strip_tags($str2);
    }
    public static function getRepairCommonDesc($name, $desc, $price){
        $data = self::getValue(self::KEY_CATEGORY_REPAIR_DESC);
        if(empty($data)) {
            $data = self::getDefaultValues()[self::KEY_CATEGORY_REPAIR_DESC];
        }
        $str = str_replace('{name}', $name, $data);
        $str = str_replace('{desc}', $desc, $str);
        $str2 = str_replace('{price}', $price, $str);
        return strip_tags($str2);
    }

    //REFILL
    public static function getRefillCommonTitle($name, $desc, $price){
        $data = t_app( self::getValue(self::KEY_CATEGORY_REFILL_TITLE));
        if(empty($data)) {
            $data = self::getDefaultValues()[self::KEY_CATEGORY_REFILL_TITLE];
        }
        $str = str_replace('{name}', $name, $data);
        $str = str_replace('{desc}', $desc, $str);
        $str2 = str_replace('{price}', $price, $str);
        return strip_tags($str2);
    }
    public static function getRefillCommonDesc($name, $desc, $price){
        $data = self::getValue(self::KEY_CATEGORY_REFILL_DESC);
        if(empty($data)) {
            $data = self::getDefaultValues()[self::KEY_CATEGORY_REFILL_DESC];
        }
        $str = str_replace('{name}', $name, $data);
        $str = str_replace('{desc}', $desc, $str);
        $str2 = str_replace('{price}', $price, $str);
        return strip_tags($str2);
    }

    public static function getDefaultValues(){
        return[
            //self::KEY_SITE_TITLE => '',
            self::KEY_SITE_DESC=> '',

            self::KEY_PRODUCT_COMMON_TITLE => '{name}',
            self::KEY_PRODUCT_COMMON_DESC => '{desc}',

            self::KEY_CATEGORY_REPAIR_TITLE => '{name}',
            self::KEY_CATEGORY_REPAIR_DESC => '{desc}',

            self::KEY_CATEGORY_REFILL_TITLE => '{name}',
            self::KEY_CATEGORY_REFILL_DESC => '{desc}',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_v', 'value'], 'required'],
            [['value'], 'string'],
            [['key_v'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key_v' => 'Key V',
            'value' => 'Value',
            'item_id' => 'Item ID',
        ];
    }

    public static function setValue($key,$val){

        self::deleteAll(["key_v"=>$key]);
        $model = new SeoInfo();
        $model->key_v = $key;
        $val = trim($val);
        if( !empty($val)) {
            $model->value = $val;
        }else{
            $model->value = self::getDefaultValues()[$key];
        }
        $model->save();
        TagDependency::invalidate(Yii::$app->getCache(), self::CACHE_TAG_DEPENDENCY_SEO_INFO);
    }

    public static function getValue($key){
        $val  = self::find()->where(["key_v"=>$key])->cache(0,new TagDependency(['tags'=>self::CACHE_TAG_DEPENDENCY_SEO_INFO]))->all();//кешируем
        if(count($val) == 0) {
            $val = self::find()->where(["key_v"=>$key])->cache(0,new TagDependency(['tags'=>self::CACHE_TAG_DEPENDENCY_SEO_INFO]))->limit(1)->all();
        }
        if(count($val) == 0) {
            $val = "";
        }
        else {
            $val = $val[0]->value;
        }
        return $val;
    }

    public static function invalidateTagDependency(){
        TagDependency::invalidate(Yii::$app->getCache(), self::CACHE_TAG_DEPENDENCY_SEO_INFO);
    }


    public static function getMetaKeyWordsAsArray(){
        return Yii::$app->name.','.'заказать услугу,ремонт ноутбуков,большой выбор техники,акция,купить продукт,ремонт техники в Киеве,заправка катриджей в Киеве,недорого,с доставкой,по категориям: '.implode(",",CategoryShop::getChildsAssoc());
    }
}
