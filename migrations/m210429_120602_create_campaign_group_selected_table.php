<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%campaign_group_selected}}`.
 */
class m210429_120602_create_campaign_group_selected_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%campaign_group_selected}}', [
            'id' => $this->primaryKey(),
            'campaign_id'=>$this->integer()->notNull(),
            'groups_subscribe_id'=>$this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%campaign_group_selected}}');
    }



}
