<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property float|null $sum
 * @property int|null $qty
 * @property bool $status
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['sum'], 'number'],
            [['qty'], 'integer'],
            [['status'], 'boolean'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ замовлення',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата зміни',
            'sum' => 'Сума',
            'qty' => 'Кількість',
            'status' => 'Статус',
            'name' => 'Ім\'я',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адреса',
        ];
    }
}
