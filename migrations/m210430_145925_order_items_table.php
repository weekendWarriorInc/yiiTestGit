<?php

use yii\db\Migration;

/**
 * Class m210430_145925_order_items_table
 */
class m210430_145925_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'name' => $this->string(255),
            'price' => $this->float(),
            'qty_item' => $this->integer(),
            'sum_item' => $this->float(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('order_items');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210430_145925_order_items_table cannot be reverted.\n";

        return false;
    }
    */
}
