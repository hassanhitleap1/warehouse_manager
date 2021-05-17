<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_delivery}}`.
 */
class m210517_095403_create_company_delivery_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company_delivery}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(250)->notNull(),
            'address'=>$this->string(300),
            'phone'=>$this->string(25),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%company_delivery}}');
    }


}
