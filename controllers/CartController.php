<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\OrderItems;
use app\models\Order;
use Yii;


class CartController extends AppController
{
    public function actionAdd()
    {
        $this->layout = false;
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if (!$product) return false;

        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        if(!Yii::$app->request->isAjax) return $this->redirect(Yii::$app->request->referrer);//якщо запит не аякс тоді перенаправляємо користувача на сторінку з якої він прийшов
       

        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        return $this->render('cart-modal', compact('session'));
    }
    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);

        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $this->layout = false;
        $session = Yii::$app->session;
        $session->open();
        return $this->render('cart-modal', compact('session'));
    }
    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();       
       $this->setMeta('Кошик');
       $order = new Order();
        return $this->render('view', compact('session', 'order'));
    }
}
