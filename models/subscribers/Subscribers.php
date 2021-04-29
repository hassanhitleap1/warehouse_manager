<?php

namespace app\models\subscribers;

use Yii;

/**
 * This is the model class for table "{{%subscribers}}".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscribers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubscribersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribersQuery(get_called_class());
    }
}
