<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price_company_delivery}}`.
 */
class m210517_095420_create_price_company_delivery_table extends Migration
{


    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%price_company_delivery}}', [
            'id' => $this->primaryKey(),
            'region_id'=>$this->integer(),
            'company_delivery_id'=>$this->integer(),
            'price'=>$this->float()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%price_company_delivery}}');
    }


}
