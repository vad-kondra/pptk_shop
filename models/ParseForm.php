<?php


namespace app\models;


use yii\base\Model;
/**
 * @property string $code
 */

class ParseForm extends Model
{
    public $code;

    public function rules(): array
    {
        return [
            [['code'], 'required'],
            [['code', ], 'string', 'max' => 65],
            [['code', ], 'trim'],
            [['code'], 'unique', 'targetClass' => Product::class, 'message' => 'Товар с таким кодом уже добавлен на сайт'],
        ];
    }

    public function attributeLabels()
    {
        return ['code' => 'Код товара c сайта "etm.ru/im"',];
    }
}