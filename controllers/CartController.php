<?php

namespace app\controllers;

use app\models\AddToCartForm;
use app\models\OrderForm;
use app\repositories\ProductReadRepository;
use app\services\CartService;
use app\services\OrderService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;


class CartController extends AppController
{
    private $products;
    private $cartService;
    private $orderService;
    private $cart;

    public function __construct($id, $module, OrderService $orderService, CartService $cartService, ProductReadRepository $products, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->cart = $cartService->getCart();
    }


    public function actionIndex()
    {
        $cart = $this->cartService->getCart();

        return $this->render('index', [
            'cart' => $cart,
        ]);
    }


    public function actionShowModal()
    {
        $this->layout = false;

        return $this->render('cart-modal', [
            'cart' => $this->cartService->getCart()
        ]);
    }

    public function actionCount()
    {
        $this->layout = false;
        $cart = $this->cartService->getCart();
        return $cart->getAmount();
    }


    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAdd($id) {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('Продукт с данным ID не найден.');
        }
        $defQty = 1;

        $this->cartService->add($product->id,  (int)$defQty);

        $this->layout = false;

        return $this->render('cart-modal', [
           'cart' => $this->cartService->getCart()
        ]);


//        $form = new AddToCartForm($product);
//        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
//            try {
//                $this->cartService->add($product->id, $form->quantity);
//                return $this->redirect(['index']);
//            } catch (\DomainException $e) {
//                Yii::$app->errorHandler->logException($e);
//                Yii::$app->session->setFlash('error', $e->getMessage());
//            }
//        }
//        return $this->render('add', [
//            'product' => $product,
//            'model' => $form,
//        ]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function actionQuantity($id)
    {
        try {
            $this->cartService->set($id, (int)Yii::$app->request->post('quantity'));
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function actionRemove($id)
    {
        $this->cartService->remove($id);

        $this->layout = false;

        return $this->render('cart-modal', [
            'cart' => $this->cartService->getCart()
        ]);

    }


    public function actionClear()
    {
        $this->cartService->getCart()->clear();
        $this->layout = false;
        return $this->render('cart-modal', [
            'cart' => $this->cartService->getCart()
        ]);
    }


    /**
     * @return mixed
     */
    public function actionCheckout(){

        if ($this->cartService->getCart()->getAmount() == 0) {
            return $this->redirect('/cart');
        }
        $form = new OrderForm(Yii::$app->user->identity);


        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->orderService->checkout(Yii::$app->user->id, $form);
                addGrowl('Ваш заказ оформлен, наш менеджер свяжется с Вами в ближайшее время', 1400, 'success');
                return $this->redirect(['/profile/']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('checkout', [
            'cart' => $this->cart,
            'model' => $form,
        ]);
    }
}