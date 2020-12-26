<?php

use yii\db\Migration;

/**
 * Class m201129_215529_status
 */
class m201129_215529_status extends Migration
{

    public $data=[
        ['name_en'=>'To be equipped','name_ar'=>'مطلوب تجهيزه'],
        ['name_en'=>'to be ready','name_ar'=>'قيد التجهيز'],
        ['name_en'=>'ready','name_ar'=>'تم تجهيزه'],
        ['name_en'=>'to be deliverd','name_ar'=>'قيد التوصيل'],
        ['name_en'=>'to be deliverd','name_ar'=>'تم توصيله'],
        ['name_en'=>'canceled','name_ar'=>'ملغي'],
        ['name_en'=>'delayed','name_ar'=>'مؤجل'],
      
    ];
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name_en' => $this->string(32)->notNull(),
            'name_ar' => $this->string(32)->notNull(),
            'created_at' => $this->dateTime()->default(null),
            'updated_at' => $this->dateTime()->default(null),
        ], $tableOptions);

        Yii::$app->db
        ->createCommand()
        ->batchInsert('status', ['name_en','name_ar'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%status}}');
    }
}
