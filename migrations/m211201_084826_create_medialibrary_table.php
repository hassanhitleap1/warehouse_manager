<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medialibrary}}`.
 */
class m211201_084826_create_medialibrary_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%medialibrary}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'path'=> $this->string(),
            'extension'=> $this->string(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%medialibrary}}');
    }


}
