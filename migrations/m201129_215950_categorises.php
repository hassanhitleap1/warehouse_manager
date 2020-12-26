<?php

use yii\db\Migration;

/**
 * Class m201129_215950_categorises
 */
class m201129_215950_categorises extends Migration
{
    public $data=[
        ['name_en'=>'Houseware','name_ar'=>'ادوات منزلية'],
        ['name_en'=>'kitchen utensils','name_ar'=>'ادوات مطبخ'],
    ];
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%categorises}}', [
            'id' => $this->primaryKey(),
            'name_en' => $this->string(32)->notNull(),
            'name_ar' => $this->string(32)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

        Yii::$app->db
        ->createCommand()
        ->batchInsert('categorises', ['name_en','name_ar'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%categorises}}');
    }
}
