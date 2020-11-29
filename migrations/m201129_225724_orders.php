<?php

use yii\db\Migration;

/**
 * Class m201129_225724_orders
 */
class m201129_225724_orders extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->string()->notNull(),
            'delivery_date'=> $this->dateTime()->defaultValue(null),
            'delivery_time'=> $this->time()->defaultValue(null),
            'country_id'=>$this->integer()->defaultValue(null),
            'region_id'=>$this->integer()->defaultValue(null),
            'area_id'=>$this->integer()->defaultValue(null),
            'address' => $this->string(250)->defaultValue(null),
            'status_id'=> $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%orders}}');
    }
}
