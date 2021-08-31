<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%custum_export}}`.
 */
class m210831_073700_create_custum_export_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%custum_export}}', [
            'id' => $this->primaryKey(),
            'name' => $this->integer()->notNull(),
            'columns'=> $this->json()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%custum_export}}');
    }

}
