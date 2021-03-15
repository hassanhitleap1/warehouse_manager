<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%options_sell_product}}`.
 */
class m210315_133754_create_options_sell_product_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%options_sell_product}}', [
            'id' => $this->primaryKey(),
            'type'=> $this->char(2)->notNull(),
            'number' => $this->smallInteger()->notNull(),
            'text'=> $this->string(500)->notNull(),
            'product_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);


    }

    public function down()
    {
        $this->dropTable('{{%options_sell_product}}');
    }
}
