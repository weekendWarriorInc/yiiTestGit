<?php

use yii\db\Migration;

/**
 * Class m210430_144117_migrate
 */
class m210430_144117_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'qty' => $this->integer(),
            'sum' => $this->float(),
            'status' => $this->boolean()->defaultValue(0),
            'name' => $this->string(255),
            'email' => $this->string(255),
            'phone' => $this->string(255),
            'address' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210430_144117_migrate cannot be reverted.\n";

        return false;
    }
    */
}
