<?php


namespace app\models;


use app\models\order\Order;
use yii\base\Model;

/**
 * Class CustomerForm
 * @package app\models
 * @property string $email
 * @property string $phone
 * @property string $f_name
 * @property string $l_name
 * @property string $p_name
 * @property string $city
 * @property string $post_index
 * @property string $address
 */


class CustomerForm extends Model
{
    public $f_name;
    public $l_name;
    public $p_name;
    public $email;
    public $phone;


    public $city;
    public $post_index;
    public $address;

    public function __construct(Order $order = null, array $config = [])
    {
        if ($order) {
            $this->f_name = $order->l_name;
            $this->l_name = $order->l_name;
            $this->p_name = $order->p_name;
            $this->email = $order->email;
            $this->phone = $order->phone;
            $this->city = $order->city;
            $this->post_index = $order->post_index;
            $this->address = $order->address;
        }
        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['f_name', 'l_name', 'phone', 'email'], 'required',  'message' => getRuleMessage('required')],
            [[ 'address'], 'string', 'max' => 255],
            [[ 'phone', 'email','f_name', 'l_name','p_name', 'city', 'post_index'], 'string', 'max' => 65],
            ['email', 'email', 'message' => getRuleMessage('email')],
        ];
    }

    public function attributeLabels()
    {
        return [

            'f_name' => 'Имя',
            'l_name' => 'Фамилия',
            'p_name' => 'Отчество',
            'email' => 'Электронная почта',
            'phone' => 'Телефон',
            'city' => 'Город',
            'post_index' => 'Почтовый индекс',
            'address' => 'Адрес(улица, дом)',

        ];
    }
}