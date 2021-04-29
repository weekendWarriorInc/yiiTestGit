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
        if (empty($category)) { 
            throw new \yii\web\HttpException(404, 'Категорії не інує');
        }
        $this->setMeta('E-SHOPPER ' . $category->name, $category->keywords, $category->description);
     //   $products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id]);
        $pages =new Pagination(['totalCount'=>$query->count(), 'pageSize'=>'3', 'forcePageParam'=>false, 'pageSizeParam'=>false]);
        $products=$query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('view', compact('products', 'category', 'pages'));
    }

    public function actionSearch()

    {
        $q =trim(Yii::$app->request->get('q'));
        $this->setMeta('E-SHOPPER | пошук: ' . $q);

        if(!$q) return $this->render('search');

        $query = Product::find()->where(['like', 'name', $q]);
       
        $pages =new Pagination(['totalCount'=>$query->count(), 'pageSize'=>'3', 'forcePageParam'=>false, 'pageSizeParam'=>false]);

        $products=$query->offset($pages->offset)->limit($pages->limit)->all();
   
        
        return $this->render('search', compact('products', 'pages', 'q'));
    }
}
