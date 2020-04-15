<?php

use yii\db\Migration;

/**
 * Class m210707_080930_create_type_outlay_tabel
 */
class m210707_080930_create_type_outlay_tabel extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%type_outlay}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);


    }

    public function down()
    {
        $this->dropTable('{{%type_outlay}}');
    }
}
