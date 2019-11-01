<?php
/**
 * Created by PhpStorm.
 * User: emrissol
 * Date: 26-Nov-18
 * Time: 3:29 PM
 */

namespace app\models\seo;


use yii\base\Model;

class ModelSeo extends Model
{
    //common
    //public $site_common_title;
    public $site_common_desc;

    //products
    public $product_common_title;
    public $product_common_desc;

    //category_service repair
    public $category_service_repair_title;
    public $category_service_repair_desc;

    //category_service refill
    public $category_service_refill_title;
    public $category_service_refill_desc;


    public $category_seo_text;

    public function attributeLabels()
    {
        return [
            //'site_common_title' => t_app('Общий шаблон') . " title",
            'site_common_desc' => t_app('Общий шаблон') . " description",

            'product_common_title' => t_app('Шаблон для продуктов'). " title",
            'product_common_desc' => t_app('Шаблон для продуктов')." description",

            'category_service_repair_title' => t_app('Шаблон для ремонта'). " title",
            'category_service_repair_desc' => t_app('Шаблон для ремонта')." description",

            'category_service_refill_title' => t_app('Шаблон для заправки'). " title",
            'category_service_refill_desc' => t_app('Шаблон для заправки')." description",
        ];
    }

    public function rules()
    {
        return [
            [
                [
                //'site_common_title',
                'site_common_desc',
                'product_common_title',
                'product_common_desc',
                'category_service_repair_title',
                'category_service_repair_desc',
                'category_service_refill_title',
                'category_service_refill_desc',
                ], 'string', 'skipOnEmpty' => false],
        ];
    }


}