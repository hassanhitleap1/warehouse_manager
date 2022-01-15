<?php

namespace app\models\silder;

use Yii;

/**
 * This is the model class for table "{{%silder}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property string|null $image
 * @property string|null $link
 */
class Silder extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%silder}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','link','body'],'required'],
            [['title'], 'string', 'max' => 400],
            [['body'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 256],
            ['link','string'],
            [['file'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'link'=> Yii::t('app', 'Link'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SQuery(get_called_class());
    }
}
