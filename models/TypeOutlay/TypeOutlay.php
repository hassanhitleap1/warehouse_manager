<?php

namespace app\models\TypeOutlay;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "type_outlay".
 *
 * @property int $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class TypeOutlay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_outlay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title',], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_at' => 'Created_At',
            'updated_at' => 'Updated_At',
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
}
