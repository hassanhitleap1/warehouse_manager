<?php

use yii\db\Migration;

/**
 * Class m201201_210555_countries
 */
class m201201_210555_countries extends Migration
{
   
     
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey(),
            'country_code' => $this->string(5)->defaultValue(null),
            'name_en'=> $this->string()->notNull(),
            'name_ar'=> $this->string()->notNull(),
            'nationality_en' => $this->string()->defaultValue(null),
            'nationality_ar' => $this->string()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%countries}}');
    }
}
