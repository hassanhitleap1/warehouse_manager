<?php

use yii\db\Migration;

/**
 * Class m201129_220051_products
 */
class m201129_220051_products extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description'=> $this->text()->defaultValue(null),
            'thumbnail'=> $this->string(255)->notNull(),
            'thumb'=> $this->string(255)->notNull(),
            'purchasing_price'=> $this->double()->notNull(),
            'selling_price'=> $this->double()->notNull(),
            'quantity'=> $this->integer()->notNull()->defaultValue(1),
            'quantity_come'=> $this->integer()->notNull()->defaultValue(0),
            'category_id'=> $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'supplier_id'=>$this->integer()->defaultValue(null),
            'unit_id'=>$this->integer()->defaultValue(null),
            'warehouse_id'=>$this->integer()->notNull(),
            'video_url'=>$this->string(500)->defaultValue(null),
            'type_options'=> $this->smallInteger()->defaultValue(null),
            'company_delivery_id'=> $this->integer()->defaultValue(null),
            'featured'=>$this->tinyInteger()->defaultValue(0),
            'top_selling'=>$this->tinyInteger()->defaultValue(0),
            'label'=>$this->tinyInteger()->defaultValue(0),
            'countdown'=>$this->time()->defaultValue(null),
            'discount'=>$this->string()->defaultValue(null),
            'days'=>$this->smallInteger()->defaultValue(null),
            'hours'=>$this->smallInteger()->defaultValue(null),
            'muints'=>$this->smallInteger()->defaultValue(null),
            'second'=>$this->smallInteger()->defaultValue(null),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%products}}');
    }
}
