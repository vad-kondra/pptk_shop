<?php


namespace app\models;


use yii\base\Model;

class AboutContentForm extends Model
{
    public $about_text;
    public $about_title;
    public $about_image;


    public function attributeLabels()
    {
        return [
            'about_text' => 'Текст страницы',
            'about_title' => 'Заголовок страницы',
        ];
    }

    public function rules()
    {
        return [
            [['about_text'], 'required'],
            [['about_text', 'about_title'], 'string'],
            [['about_text', 'about_title'], 'trim'],
        ];
    }
}