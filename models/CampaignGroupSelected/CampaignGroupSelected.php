<?php

namespace app\models\CampaignGroupSelected;

use Yii;

/**
 * This is the model class for table "{{%campaign_group_selected}}".
 *
 * @property int $id
 * @property int $campaign_id
 * @property int $groups_subscribe_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class CampaignGroupSelected extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%campaign_group_selected}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['campaign_id', 'groups_subscribe_id'], 'required'],
            [['campaign_id', 'groups_subscribe_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'campaign_id' => Yii::t('app', 'Campaign ID'),
            'groups_subscribe_id' => Yii::t('app', 'Groups Subscribe ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CampaignGroupSelectedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampaignGroupSelectedQuery(get_called_class());
    }
}
