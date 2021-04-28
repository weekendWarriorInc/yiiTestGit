<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;

use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $this->setMeta('E-SHOPPER');
        $hitsInCache = Yii::$app->cache->get('hits');
        if ($hitsInCache) {
            return $this->render('index', compact('hitsInCache'));
        } else {
            $hits = Product::find()->where(['hit' => '1'])->all();
            Yii::$app->cache->set('hits', $hits, 60);
            return $this->render('index', compact('hits'));
        }
    }

    public function actionView()

    {
        $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        $this->setMeta('E-SHOPPER ' . $category->name, $category->keywords, $category->description);
     //   $products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id]);
        $pages =new Pagination(['totalCount'=>$query->count(), 'pageSize'=>'3', 'forcePageParam'=>false, 'pageSizeParam'=>false]);
        $products=$query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('view', compact('products', 'category', 'pages'));
    }
}
