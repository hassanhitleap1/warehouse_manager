<?php

use yii\db\Migration;

/**
 * Class m201129_215853_suppliers
 */
class m201129_215853_suppliers extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%suppliers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->unique(),
            'phone' => $this->string(32)->notNull(),
            'other_phone' => $this->string(32)->defaultValue(null),
            'site' => $this->string(32)->defaultValue(null),
            'location' => $this->string(254)->defaultValue(null),
            'email' => $this->string()->unique(),
            'country_id'=>$this->integer()->defaultValue(null),
            'region_id'=>$this->integer()->defaultValue(null),
            'area_id'=>$this->integer()->defaultValue(null),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%suppliers}}');
    }
}
