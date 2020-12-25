<?php

use yii\db\Migration;

/**
 * Class m201129_215922_units
 */
class m201129_215922_units extends Migration
{
    
    
    public $data=[
        ['name_en'=>'pisces','name_ar'=>'قطعة '],
        ['name_en'=>'kilo','name_ar'=>'كيلو'],
    ];

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%units}}', [
            'id' => $this->primaryKey(),
            'name_en' => $this->string(32)->notNull(),
            'name_ar' => $this->string(32)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        Yii::$app->db
        ->createCommand()
        ->batchInsert('units', ['name_en','name_ar'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%units}}');
    }
}
