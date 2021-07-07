<?php

namespace app\models\Outlays;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "outlays".
 *
 * @property int $id
 * @property string $title
 * @property int $type
 * @property int|null $product_id
 * @property string $created_at
 * @property string $updated_at
 */
class Outlays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outlays';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['type', 'product_id'], 'integer'],
            
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
            'type' => 'Type',
            'product_id' => 'Product',
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
