<?php

use yii\db\Migration;

/**
 * Class m201129_214103_user
 */
class m201129_214103_user extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->unique()->defaultValue(null),
            'phone' => $this->string(32)->notNull()->defaultValue(null),
            'name'=> $this->string(255)->notNull()->defaultValue(null),
            'other_phone' => $this->string(32)->defaultValue(null),
            'auth_key' => $this->string(32)->notNull()->defaultValue(null),
            'password_hash' => $this->string()->notNull()->defaultValue(null),
            'password_reset_token' => $this->string()->unique()->defaultValue(null),
            'email' => $this->string()->unique()->defaultValue(null),
            'type'=>$this->smallInteger()->defaultValue(2),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'country_id'=>$this->integer()->defaultValue(null),
            'region_id'=>$this->integer()->defaultValue(null),
            'area_id'=>$this->integer()->defaultValue(null),
            'address' => $this->string(250)->defaultValue(null),
            'name_in_facebook' => $this->string(250)->defaultValue(null),
            'created_at' => $this->integer()->notNull()->defaultValue(null),
            'updated_at' => $this->integer()->notNull()->defaultValue(null),
        ], $tableOptions);
        $data=[
            ['username'=>'admin','name'=>'admin','type'=>1,'password_hash'=>Yii::$app->security->generatePasswordHash("admin")]
        ];
        Yii::$app->db
            ->createCommand()
            ->batchInsert('user', ['username','name','type','password_hash'], $data)
            ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
