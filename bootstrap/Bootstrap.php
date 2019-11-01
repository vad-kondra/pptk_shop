<?php


namespace app\bootstrap;


use app\models\cart\Cart;
use app\models\cart\cost\calculator\DynamicCost;
use app\models\cart\cost\calculator\SimpleCost;
use app\models\cart\storage\HybridStorage;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton(Cart::class, function () use ($app) {
            return new Cart(
                new HybridStorage($app->get('user'), 'cart', 3600 * 24, $app->db),
                new DynamicCost(new SimpleCost())
            );
        });

        $container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });

    }
}