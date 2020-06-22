<?php

namespace app\models;

use yii\base\Model;

class TermsContentForm extends Model
{
    public $terms_text;

    public function attributeLabels()
    {
        return [
            'terms_text' => 'Текст страницы',

        ];
    }

    public function rules()
    {
        return [
            [['terms_text'], 'required'],
            [['terms_text'], 'string', 'max' => 255],
            [['terms_text'], 'trim'],
        ];
    }
}