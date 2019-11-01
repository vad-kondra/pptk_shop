<?php

namespace app\modules\admin\models;

use yii\base\Model;

class ModelHeader extends Model
{
    public $img_logo;

    public $f_phone;
    public $s_phone;


    public function rules()
    {
        return [
            [['img_logo'], 'image', 'extensions' => 'jpg, gif, png', 'wrongExtension' => 'Неверное разсширение'],
            [['f_phone','s_phone'], 'string', 'skipOnEmpty' => true]
        ];
    }
//'maxWidth' => '300', 'maxHeight'=>'70', 'overWidth' => t_app('Картинка слишком большая по ширине'), 'overHeight'=>t_app('Картинка слишком большая по высоте')

    public function attributeLabels()
    {
        return [
            'img_logo' => 'Логотип сайта',
            'f_phone' => 'Телефон в хедере № 1',
            's_phone' => 'Телефон в хедере № 2',
        ];
    }


}