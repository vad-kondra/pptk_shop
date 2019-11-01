<?php


namespace app\models;


use app\models\order\Order;

/**
 * @property CustomerForm $customer
 */
class OrderEditForm extends CompositeForm
{
    public $comment;

    public function __construct(Order $order, array $config = [])
    {
        $this->comment = $order->comment;
        $this->customer = new CustomerForm($order);
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['comment'], 'string'],
        ];
    }

    protected function internalForms(): array
    {
        return ['customer'];
    }

    public function attributeLabels()
    {
        return [
            'comment' => 'Комментарий'
        ];
    }

}