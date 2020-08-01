<?php

namespace app\modules\admin\models;

use yii\base\Model;

/**
 * Class MainContentForm
 * @package app\modules\admin\models
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $first_name
 * @property string $position
 * @property string $tel_1
 * @property string $tel_2
 * @property string $email
 * @property string $skype
 *
 */

class ManagementForm extends Model
{
    public $id;
    public $name;
    public $surname;
    public $first_name;
    public $position;
    public $tel_1;
    public $tel_2;
    public $email;
    public $skype;


    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'first_name' => 'Отчество',
            'position' => 'Должность',
            'tel_1' => 'Телефон № 1',
            'tel_2' => 'Телефон № 2',
            'email' => 'Email',
            'skype' => 'Skype',
        ];
    }

    public function rules()
    {
        return [
            [['name','surname', 'first_name', 'position','tel_1', 'email'], 'required'],
            [['name', 'surname','first_name', 'position','tel_1', 'tel_2', 'email', 'skype'], 'string', 'max' => 255],
            [['name','surname', 'first_name','position', 'tel_1','tel_2', 'email', 'skype'], 'trim'],
        ];
    }
}