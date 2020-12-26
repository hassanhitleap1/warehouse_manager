<?php

use yii\db\Migration;

/**
 * Class m201129_215625_warehouse
 */
class m201129_215625_warehouse extends Migration
{
    public $data=[
       ['name' =>"مستودع 1 "]
    ];
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%warehouse}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'localtion'=> $this->string(32)->notNull(),
            'created_at' => $this->dateTime()->default(null),
            'updated_at' => $this->dateTime()->default(null),
        ], $tableOptions);
        Yii::$app->db
        ->createCommand()
        ->batchInsert('warehouse', ['name'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%warehouse}}');
    }
}
