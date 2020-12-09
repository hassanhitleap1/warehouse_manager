<?php

use yii\db\Migration;

/**
 * Class m201201_210649_regions
 */
class m201201_210649_regions extends Migration
{
   
    public $data = [
        ['name_ar' => 'عمان' ,'price_delivery'=>2],
        ['name_ar' => 'اربد','price_delivery'=>4],
        ['name_ar' => 'الزرقاء','price_delivery'=>4],
        ['name_ar' => 'معان','price_delivery'=>4],
        ['name_ar' => 'المفرق','price_delivery'=>4],
        ['name_ar' => 'العقبة','price_delivery'=>4],
        ['name_ar' => 'مادبا','price_delivery'=>4],
        ['name_ar' => 'السلط','price_delivery'=>4],
        ['name_ar' => 'الكرك','price_delivery'=>4],
        ['name_ar' => 'الطفيلة','price_delivery'=>4],
        ['name_ar' => 'عجلون','price_delivery'=>4],
        ['name_ar' => 'جرش','price_delivery'=>4],
        ['name_ar' => 'البلقاء','price_delivery'=>4],
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
        ->batchInsert('regions', ['name_ar','price_delivery'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%regions}}');
    }

}
