<?php

namespace app\models\historystatus;

use app\models\orders\Orders;
use app\models\status\Status;
use app\models\subproductcount\SubProductCount;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%history_status}}".
 *
 * @property int $id
 * @property int $status_id
 * @property int $order_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class HistoryStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%history_status}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'order_id'], 'required'],
            [['status_id', 'order_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_id' => Yii::t('app', 'Status'),
            'order_id' => Yii::t('app', 'Order_Id'),
            'time'=> Yii::t('app', 'Time'),
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

    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
    /**
     * {@inheritdoc}
     * @return HistoryStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoryStatusQuery(get_called_class());
    }
}
