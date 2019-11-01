<?php
/**
 * Created by PhpStorm.
 * User: twobomb
 * Date: 18.09.2018
 * Time: 16:53
 */

namespace app\assets;


use yii\web\AssetBundle;

class AssetWrapper extends AssetBundle
{
    //Версия кеша, если меняем файлы ассетов, то делаем +1
    const CACHE_VERSION_CSS = 2;
    const CACHE_VERSION_JS = 2;

    public static function getVersionJs(){
        if(YII_ENV == "dev")
            return time();
        else
            return AssetWrapper::CACHE_VERSION_JS;
    }
    public function init(){
        parent::init();
        if(YII_ENV == "dev") {
            $cssnew = [];
            foreach ($this->css as $css)///Конструкция чтобы не кешировал браузер
                array_push($cssnew, $css . "?" . time());
            $this->css = $cssnew;

            $jsnew = [];
            foreach ($this->js as $js)///Конструкция чтобы не кешировал браузер
                array_push($jsnew, $js . "?" . time());
            $this->js = $jsnew;
        }
        else{
            $cssnew = [];
            foreach ($this->css as $css)
                array_push($cssnew, $css . "?" . AppAsset::CACHE_VERSION_CSS);
            $this->css = $cssnew;

            $jsnew = [];
            foreach ($this->js as $js)
                array_push($jsnew, $js . "?" . AppAsset::CACHE_VERSION_JS);
            $this->js = $jsnew;
        }

    }
}