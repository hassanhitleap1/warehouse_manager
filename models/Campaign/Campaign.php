<?php

namespace app\models\campaign;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%campaign}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $start_date
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%campaign}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['start_date', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
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
            'start_date' => Yii::t('app', 'Start_Date'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }



    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = $today;
                $this->updated_at = $today;
            } else {
                $this->updated_at =$today;
            }

            return true;
        } else {
            return false;
        }
    }
    /**
     * {@inheritdoc}
     * @return CampaignQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampaignQuery(get_called_class());
    }
}
