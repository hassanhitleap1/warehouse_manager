<?php

use yii\db\Migration;

/**
 * Class m201204_005239_sub_product_count
 */
class m201204_005239_sub_product_count extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sub_product_count}}', [
            'id' => $this->primaryKey(),
            'type'=> $this->string()->notNull(),
            'count' => $this->smallInteger()->notNull(),
            'product_id'=> $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
            

        ], $tableOptions);

      
    }

    public function down()
    {
        $this->dropTable('{{%sub_product_count}}');
    }
}
