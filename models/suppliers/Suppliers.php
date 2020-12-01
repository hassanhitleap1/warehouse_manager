<?php

namespace app\models\suppliers;

use Yii;

/**
 * This is the model class for table "{{%suppliers}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string $phone
 * @property string|null $other_phone
 * @property string|null $site
 * @property string|null $location
 * @property string|null $email
 * @property int|null $country_id
 * @property int|null $region_id
 * @property int|null $area_id
 * @property string $created_at
 * @property string $updated_at
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%suppliers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'created_at', 'updated_at'], 'required'],
            [['country_id', 'region_id', 'area_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['phone', 'other_phone', 'site'], 'string', 'max' => 32],
            [['location'], 'string', 'max' => 254],
            [['email'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['email'], 'unique'],
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
            'phone' => Yii::t('app', 'Phone'),
            'other_phone' => Yii::t('app', 'Other Phone'),
            'site' => Yii::t('app', 'Site'),
            'location' => Yii::t('app', 'Location'),
            'email' => Yii::t('app', 'Email'),
            'country_id' => Yii::t('app', 'Country ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SuppliersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuppliersQuery(get_called_class());
    }
}
