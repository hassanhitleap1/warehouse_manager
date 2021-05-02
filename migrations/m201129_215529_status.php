<?php

use yii\db\Migration;

/**
 * Class m201129_215529_status
 */
class m201129_215529_status extends Migration
{

    public $data=[
        ['name_en'=>'Make a call ','name_ar'=>'اجراء مكالمة','color'=>'#292fca'], // 1
        ['name_en'=>'To be equipped','name_ar'=>'مطلوب تجهيزه','color'=>'#237923'], // 2
        ['name_en'=>'ready','name_ar'=>'تم تجهيزه','color'=>'#237923'], // 3
        ['name_en'=>'Connecting','name_ar'=>'قيد التوصيل','color'=>'#237923'],// 4
        ['name_en'=>'to be deliverd','name_ar'=>'تم توصيله','color'=>'#237923'],// 5
        ['name_en'=>'canceled','name_ar'=>'ملغي','color'=>'#eb0017'],// 6
        ['name_en'=>'canceled from company','name_ar'=>'ملغي من الشركة','color'=>'#eb0017'], // 7
        ['name_en'=>'delayed','name_ar'=>'مؤجل','color'=>'#292fca'], // 8
        ['name_en'=>'delayed form company','name_ar'=>'مؤجل من الشركة','color'=>'#292fca'], // 9
        ['name_en'=>'no answer','name_ar'=>'لا يرد','color'=>'#292fca'], // 10
        ['name_en'=>'no answer','name_ar'=>'لا يرد من الشركة','color'=>'#292fca'], // 11
        ['name_en'=>'Payment has been received','name_ar'=>'تم استلام المبلغ','color'=>'#292fca'], // 12
        ['name_en'=>'The canceled request has been received','name_ar'=>'تم استلام الطلب الملغي','color'=>'#292fca'], // 13
       
      
    ];
    
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name_en' => $this->string(250)->notNull(),
            'name_ar' => $this->string(250)->notNull(),
            'color' => $this->string(250)->notNull(),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

        Yii::$app->db
        ->createCommand()
        ->batchInsert('status', ['name_en','name_ar','color'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%status}}');
    }
}
