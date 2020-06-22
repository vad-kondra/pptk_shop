<?php


namespace app\services;


use app\models\order\CustomerData;
use app\models\OrderEditForm;
use app\repositories\OrderRepository;

class OrderManageService
{
    private $orders;

    public function __construct(OrderRepository $orders )
    {
        $this->orders = $orders;

    }

    public function edit($id, OrderEditForm $form): void
    {
        $order = $this->orders->get($id);

        $order->edit(
            new CustomerData(
                $form->customer->f_name,
                $form->customer->l_name,
                $form->customer->p_name,
                $form->customer->email,
                $form->customer->phone,
                $form->customer->city,
                $form->customer->post_index,
                $form->customer->address
            ),
            $form->comment
        );


        $this->orders->save($order);
    }

    public function remove($id): void
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }

    public function getAllUserOrders(int $userId)
    {
        return $this->orders->getAllOrdersByUserId($userId);
    }
}