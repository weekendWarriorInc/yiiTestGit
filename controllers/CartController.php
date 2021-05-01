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
        if (!Yii::$app->request->isAjax) return $this->redirect(Yii::$app->request->referrer); //якщо запит не аякс тоді перенаправляємо користувача на сторінку з якої він прийшов


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
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {                
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваше замовлення прийняте');
                Yii::$app->mailer->compose('order',['session'=>$session])
                ->setFrom(['dgbzboodokai@gmail.com'=>'yii2.loc'])
                ->setTo($order->email)
                ->setSubject('Замовлення')
                ->send();
                
                $session->remove('cart');
                $session->remove('cart.sum');
                $session->remove('cart.qty');
            } else {
                Yii::$app->session->setFlash('error', 'Щось пішло не так');
            }
        }
        $id = Yii::$app->request->get('id');
        $view = Yii::$app->request->get('view');
    

        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }
}
