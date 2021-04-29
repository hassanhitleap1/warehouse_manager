<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribers}}`.
 */
class m210429_115016_create_subscribers_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscribers}}', [
            'id' => $this->primaryKey(),
            'first_name'=>$this->string(100)->defaultValue(null),
            'last_name'=>$this->string(100)->defaultValue(null),
            'email'=>$this->string(100)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%subscribers}}');
    }

}
