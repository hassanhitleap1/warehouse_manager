<?php

namespace app\models\medialibrary;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "medialibrary".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $path
 * @property string|null $extension
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Medialibrary extends \yii\db\ActiveRecord
{
    public $media;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medialibrary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path', 'extension'], 'string', 'max' => 255],
            [['media'],'required']
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
            'path' => Yii::t('app', 'Path'),
            'extension' => Yii::t('app', 'Extension'),
            'media'=>  Yii::t('app', 'Media'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MedialibraryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MedialibraryQuery(get_called_class());
    }



    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
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
