<?php


namespace app\models\order;


class CustomerData
{
    public $f_name;
    public $l_name;
    public $p_name;
    public $email;
    public $phone;
    public $city;
    public $post_index;
    public $address;

    public function __construct($f_name, $l_name,$p_name, $email, $phone,  $city, $post_index, $address)
    {
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->p_name = $p_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->city = $city;
        $this->post_index = $post_index;
        $this->address = $address;
    }


}