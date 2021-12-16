<?php

namespace app\models\customers;

use app\models\area\Area;
use app\models\countries\Countries;
use app\models\regions\Regions;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string|null $username
 * @property string $phone
 * @property string|null $other_phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int $status
 * @property int|null $country_id
 * @property int|null $region_id
 * @property int|null $area_id
 * @property string|null $address
 * @property int $created_at
 * @property int $updated_at
 */
class Customers extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone','name'], 'required'],
            [['status', 'country_id', 'region_id', 'area_id','type'], 'integer'],
            [['username', 'email','name'], 'string', 'max' => 255],
            [['phone', 'other_phone', 'auth_key'], 'string', 'max' => 32],
            [['address'], 'string', 'max' => 250],
            [['email','username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'other_phone' => Yii::t('app', 'Other_Phone'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'country_id' => Yii::t('app', 'Country'),
            'region_id' => Yii::t('app', 'Region'),
            'area_id' => Yii::t('app', 'Area'),
            'address' => Yii::t('app', 'Address'),
            'type'=> Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
            'password'=> Yii::t('app', 'Password'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomersQuery(get_called_class());
    }


    
       /**
     * @inheritdoc
     */




    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }
}
