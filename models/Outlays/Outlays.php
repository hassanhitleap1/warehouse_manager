<?php

namespace app\models\Outlays;

use app\models\products\Products;
use app\models\TypeOutlay\TypeOutlay;
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
            [['title', 'type','value'], 'required'],
            [['type', 'product_id'], 'integer'],
            [['value'], 'double'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' =>Yii::t('app',"ID") ,
            'title' =>Yii::t('app',"Title") ,
            'type' => Yii::t('app',"Type"),
            'value'=>Yii::t('app',"Value"),
            'product_id' =>Yii::t('app',"Product") ,
            'created_at' => Yii::t('app',"Created_At"),
            'updated_at' => Yii::t('app',"Updated_At"),
        ];
    }



    
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getTypeoulay(){
        return $this->hasOne(TypeOutlay::className(),['id' => 'type']);
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
