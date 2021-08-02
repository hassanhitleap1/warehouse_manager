<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_status}}`.
 */
class m210802_083138_create_history_status_table extends Migration
{


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%history_status}}', [
            'id' => $this->primaryKey(),
            'status_id' => $this->smallInteger()->notNull(),
            'order_id'=> $this->integer()->notNull(1),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%history_status}}');
    }


}
