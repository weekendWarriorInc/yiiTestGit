<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;

use Yii;


class CartController extends AppController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if(!$product) return false;
       
        $session=Yii::$app->session;
        $session->open();
        $cart=new Cart();
        $cart->addToCart($product);
        debug($session['cart']);
    }

}
