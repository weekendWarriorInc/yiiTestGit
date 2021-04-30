<?php

namespace app\models;

use \yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;


class Order extends ActiveRecord
{
  
    public static function tableName()
    {
        return 'order';
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id'=>'id']);
    }


    public function rules()
    {
        return [
            [['name','email', 'phone','address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'status'], 'integer'],
            [['sum'], 'boolean'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    
    public function attributeLabels()
    {
        return [
          
            'name' => 'Ім\'я',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адреса',
        ];
    }
}
