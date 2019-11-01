<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 09.08.2018
 * Time: 14:38
 */

namespace app\models;


use app\modules\admin\models\FooterContentForm;
use app\modules\admin\models\HeaderContentForm;
use app\modules\admin\models\MainContentForm;
use yii\caching\TagDependency;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\ForbiddenHttpException;

/**
 * Class Config
 *
 * @property string $key
 * @property string $value
 * @property Photo $logo
 */


class Config extends ActiveRecord
{
    const CLASS_CACHE_TAG = 'config_cache';

    //параметры
    const MAIN_LOGO = 'logo_main';
    const MAIN_TITLE = 'main_title';
    const MAIN_SHORT_TITLE = 'main_short_title';
    const MAIN_PHONE_1 = 'main_phone_1';
    const MAIN_PHONE_2 = 'main_phone_2';
    const MAIN_ADDRESS = 'main_address';
    const MAIN_EMAIL = 'main_email';

    const TIME_WORK = 'time_work';
    const ABOUT_TEXT = 'about_text';
    const PRIVATE_POLICY_TEXT = 'private_policy_text';

    public static function tableName()
    {
        return "shop_config";
    }

    public static $defaultValues = [
        self::MAIN_TITLE => 'Интернет-магазин электрики и светотехники "ППТК" в Луганске',
        self::MAIN_SHORT_TITLE => 'ППТК',
        self::MAIN_PHONE_1 => '+38 (050) 000-00-00',
        self::MAIN_PHONE_2 => '+38 (072) 000-00-00',
        self::MAIN_EMAIL => 'support@pptk-lnr.ru',
        self::MAIN_ADDRESS => 'г. Луганск',

        self::TIME_WORK => 'Пн – Пт: 8:00 – 18:00',
        self::ABOUT_TEXT => 'Отредактируйте данный текст в конфигурации сайта в секции "О нас"',
        self::PRIVATE_POLICY_TEXT => 'Отредактируйте данный текст в конфигурации сайта в секции "Пользовательское соглашение"',
    ];


    /**
     * @param $key
     * @param $val
     * @return bool
     */
    public static function setValue($key, $val): bool
    {
        Config::deleteAll(["key"=>$key]);
        $cfg = new Config();
        $cfg->key = $key;
        $cfg->value = $val;
        if($cfg->save()){
            TagDependency::invalidate(\Yii::$app->cache,self::CLASS_CACHE_TAG);
            return true;
        }
        return false;
    }

    /**
     * @param $key
     * @return array|mixed|ActiveRecord[]
     * @throws ForbiddenHttpException
     */
    public static function getValue($key){
        $find  = Config::find()->where(["key"=>$key])->cache(3600,new TagDependency(["tags"=>[self::CLASS_CACHE_TAG]]))->all();

        if(count($find) == 0) {
            if(!array_key_exists($key,Config::$defaultValues))
                throw new ForbiddenHttpException("Не найдено значение по умолчанию для ключа '$key'");
            $cfg = new Config();
            $cfg->key = $key;
            $cfg->value = Config::$defaultValues[$key];
            $cfg->save();
            TagDependency::invalidate(\Yii::$app->cache,self::CLASS_CACHE_TAG);
            return $cfg->value;
        }
        return $find[0]->value;
    }


    public function getMain(): MainContentForm
    {
        $main = new MainContentForm();
        $main->main_title = $this->main_title;
        $main->main_short_title = $this->main_short_title;
        $main->main_phone_1 = $this->main_phone_1;
        $main->main_phone_2 = $this->main_phone_2;
        $main->main_email = $this->main_email;
        $main->main_address = $this->main_address;
        return $main;
    }

    public function getHeader(): HeaderContentForm
    {
        $header = new HeaderContentForm();
        $header->img_logo = $this->logo;
        return $header;
    }

    public function getFooter(): FooterContentForm
    {
        $footer = new FooterContentForm();
        return $footer;
    }

    public function getLogo(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'main_logo']);
    }
}