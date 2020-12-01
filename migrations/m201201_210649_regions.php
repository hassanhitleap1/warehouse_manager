<?php

use yii\db\Migration;

/**
 * Class m201201_210649_regions
 */
class m201201_210649_regions extends Migration
{
   
    public $data = [
        ['name_ar' => 'عمان'],
        ['name_ar' => 'اربد'],
        ['name_ar' => 'الزرقاء'],
        ['name_ar' => 'معان'],
        ['name_ar' => 'المفرق'],
        ['name_ar' => 'العقبة'],
        ['name_ar' => 'مادبا'],
        ['name_ar' => 'السلط'],
        ['name_ar' => 'الكرك'],
        ['name_ar' => 'الطفيلة'],
        ['name_ar' => 'عجلون'],
        ['name_ar' => 'جرش'],
        ['name_ar' => 'البلقاء'],
    ];
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'name_en' => $this->string()->defaultValue(null),
            'name_ar'=> $this->string()->notNull(),
            'price_delivery'=>$this->double()->defaultValue(null),
            'country_id'=> $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);


        Yii::$app->db
        ->createCommand()
        ->batchInsert('regions', ['name_ar'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%regions}}');
    }

}
