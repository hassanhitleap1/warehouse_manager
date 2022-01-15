<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%silder}}`.
 */
class m220114_024655_create_silder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%silder}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(400),
            'body'=>$this->string(),
            'image'=>$this->string(256)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%silder}}');
    }
}
