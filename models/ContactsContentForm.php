<?php

namespace app\models;

use yii\base\Model;

class ContactsContentForm extends Model
{
    public $contacts_text;

    public function attributeLabels()
    {
        return [
            'contacts_text' => 'Текст страницы',
        ];
    }

    public function rules()
    {
        return [
            [['contacts_text'], 'required'],
            [['contacts_text'], 'string'],
            [['contacts_text'], 'trim'],
        ];
    }
}