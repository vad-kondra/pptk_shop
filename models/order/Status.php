<?php


namespace app\models\order;


class Status
{
    const NEW = 1; //Новый статус
    const PROCESSING = 2; //В обработке
    const COMPLETED = 4; //Завершен
    const CANCELED = 5; //Отменен


    public $user_id;
    public $value;
    public $created_at;

    public function __construct($user_id, $value, $created_at)
    {
        $this->user_id = $user_id;
        $this->value = $value;
        $this->created_at = $created_at;
    }
}