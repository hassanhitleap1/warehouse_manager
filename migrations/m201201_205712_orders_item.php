<?php

use yii\db\Migration;

/**
 * Class m201201_205712_orders_item
 */
class m201201_205712_orders_item extends Migration
{
   
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%orders_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->string()->notNull(),
            'product_id'=> $this->integer()->notNull(),
            'sub_product_id'=> $this->integer()->notNull(),
            'quantity'=> $this->smallInteger()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%orders_item}}');
    }
}
