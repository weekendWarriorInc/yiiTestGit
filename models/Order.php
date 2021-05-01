<?php

namespace app\models;

use \yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class Order extends ActiveRecord
{
  
    public static function tableName()
    {
        return 'order';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                 'value' => new Expression('NOW()'),
            ],
        ];
    }

    public  function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id'=>'id']);
    }


    public function rules()
    {
        return [
            [['name','email', 'phone','address'], 'required'],
            [['email'], 'email'],
            ['phone', 'safe'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'status'], 'integer'],
            [['sum'], 'integer'],
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
