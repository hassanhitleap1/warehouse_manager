<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%groups_subscribe}}`.
 */
class m210429_114854_create_groups_subscribe_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%groups_subscribe}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%groups_subscribe}}');
    }


}
