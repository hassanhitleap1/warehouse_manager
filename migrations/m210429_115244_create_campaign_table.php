<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%campaign}}`.
 */
class m210429_115244_create_campaign_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%campaign}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull(),
            'start_date'=>$this->dateTime()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%campaign}}');
    }


}
