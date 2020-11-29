<?php

use yii\db\Migration;

/**
 * Class m201129_224101_products_image
 */
class m201129_224101_products_image extends Migration
{
    public function up()
    {

        $this->createTable('{{%products_image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'path'=> $this->string(200)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%products_image}}');
    }
}
