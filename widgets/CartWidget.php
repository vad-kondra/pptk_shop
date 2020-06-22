<?php


namespace app\widgets;


use app\services\cartService\CartService;
use yii\base\Widget;

class CartWidget extends Widget
{

    private $cartService;

    public function __construct(CartService $cartService, $config = [])
    {
        $this->cartService = $cartService;
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cart = $this->cartService->getCart();

        return $this->render('cart', [
            'cart' => $cart,
        ]);

    }

}