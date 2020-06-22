<?php

namespace app\bootstrap;

use app\models\cart\Cart;
use app\models\cart\cost\calculator\DynamicCost;
use app\models\cart\cost\calculator\SimpleCost;
use app\models\cart\storage\HybridStorage;
use app\repositories\productRepository\IProductRepository;
use app\repositories\productRepository\ProductRepository;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(Cart::class, function () use ($app) {
            return new Cart(
                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
                new DynamicCost(new SimpleCost())
            );
        });

        $container->setSingleton(IProductRepository::class, ProductRepository::class );

    }
}