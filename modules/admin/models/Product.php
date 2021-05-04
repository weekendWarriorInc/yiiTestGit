<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $name
 * @property string|null $content
 * @property float|null $price
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $img
 * @property string|null $hit
 * @property string|null $new
 * @property string|null $sale
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }
public function getCategory()
{
    return $this->hasOne(Category::className(), ['id'=>'category_id']);
}

    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['content'], 'string'],
            [[ 'hit', 'new', 'sale'], 'boolean'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер товару',
            'category_id' => 'Категорія',
            'name' => 'Назва товару',
            'content' => 'Опис товару',
            'price' => 'Ціна',
            'keywords' => 'Ключові слова',
            'description' => 'Мета-інформація',
            'img' => 'Фото',
            'hit' => 'Хіт',
            'new' => 'Новинка',
            'sale' => 'Розпродаж',
        ];
    }
}
