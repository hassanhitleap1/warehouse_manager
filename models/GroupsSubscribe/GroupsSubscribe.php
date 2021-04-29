<?php

namespace app\models\GroupsSubscribe;

use Yii;

/**
 * This is the model class for table "{{%groups_subscribe}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class GroupsSubscribe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%groups_subscribe}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return GroupsSubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupsSubscribeQuery(get_called_class());
    }
}
