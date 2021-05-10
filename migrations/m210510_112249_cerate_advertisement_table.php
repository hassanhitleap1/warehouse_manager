<?php

use yii\db\Migration;

/**
 * Class m210510_112249_cerate_advertisement_table
 */
class m210510_112249_cerate_advertisement_table extends Migration
{


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%advertisement}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(400)->notNull(),
            'body'=>$this->text()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%advertisement}}');
    }

}
