<?php


namespace app\modules\admin\models;



use app\models\CompositeForm;
use app\models\PhotoForm;
use yii\base\Model;

/**
 * Class MainContentForm
 * @package app\modules\admin\models
 *
 * @property string $main_title
 * @property string $main_short_title
 * @property string $main_phone_1
 * @property string $main_phone_2
 * @property string $main_email
 * @property string $main_address
 * @property string $time_work
 *
 */

class MainContentForm extends Model
{
    public $main_title;
    public $main_short_title;
    public $main_phone_1;
    public $main_phone_2;
    public $main_email;
    public $main_address;
    public $time_work;


    public function attributeLabels()
    {
        return [
            'main_title' => 'Полное название сайта',
            'main_short_title' => 'Короткое название',
            'main_phone_1' => 'Телефон № 1',
            'main_phone_2' => 'Телефон № 2',
            'main_email' => 'Электронная почта',
            'main_address' => 'Фактический адрес',
            'time_work' => 'Режим работы'
        ];
    }

    public function rules()
    {
        return [
            [['main_title','main_short_title', 'main_phone_1', 'main_email','main_address', 'time_work'], 'required'],
            [['main_title', 'main_phone_1','main_phone_2', 'main_email','main_address', 'time_work'], 'string', 'max' => 255],
            [['time_work'], 'string', 'max' => 25],
            [['main_short_title'], 'string', 'max' => 120],
            [['main_title','main_short_title', 'main_phone_1','main_phone_2', 'main_email','main_address', 'time_work'], 'trim'],
        ];
    }


}