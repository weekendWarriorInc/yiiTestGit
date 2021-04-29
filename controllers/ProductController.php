<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

use Yii;


class ProductController extends AppController
{
    public function actionView()
    {
      
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (empty($product)) { 
         
        throw new \yii\web\HttpException(404, 'Товар не інує');
        }
        $this->setMeta('E-SHOPPER ' . $product->name, $product->keywords, $product->description);
        //   $product= Product::find()->with('category')->where(['id'=>$id]);
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('view', compact('product', 'hits'));
    }
}