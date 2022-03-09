<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wishlists}}`.
 */
class m220309_122130_create_wishlists_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wishlists}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'product_id'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wishlists}}');
    }
}
