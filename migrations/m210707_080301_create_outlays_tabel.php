<?php

use yii\db\Migration;

/**
 * Class m210707_080301_create_outlays_tabel
 */
class m210707_080301_create_outlays_tabel extends Migration
{


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%outlays}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250)->notNull(),
            "value"=> $this->double()->notNull(),
            "type"=> $this->integer()->notNull(),
            'product_id'=>$this->integer()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);


    }

    public function down()
    {
        $this->dropTable('{{%outlays}}');
    }

}
