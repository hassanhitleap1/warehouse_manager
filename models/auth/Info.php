<?php

namespace app\models\auth;

use Yii;
use yii\base\Model;


/**
 * Signup form
 */
class Info extends \yii\db\ActiveRecord
{
    public $name;
    public $avatar;
    public $phone;
    public $email;
    public $username;


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
            [['name'], 'required'],
            [['avatar'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,gif'],
            ['email', 'unique', 'targetClass' => '\app\models\User',
                'message' => 'This email address has already been taken.',
                'when' => function ($model) {
                    return $model->email != Yii::$app->user->identity->email; // or other function for get current username
                }
                ],
            ['username', 'unique', 'targetClass' => '\app\models\User',
                'message' => 'This email address has already been taken.',
                'when' => function ($model) {
                    return $model->username != Yii::$app->user->identity->username; // or other function for get current username
                }

            ],
            ['phone', 'unique', 'targetClass' => '\app\models\User',
                'message' => 'This email address has already been taken.',
                'when' => function ($model) {
                    return $model->phone != Yii::$app->user->identity->phone; // or other function for get current username
                }

            ],

        ];
    }


    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           
            'name' => Yii::t('app', 'Name'),
            'avatar' => Yii::t('app', 'Avatar'),
            'phone' => Yii::t('app', 'Phone'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
        ];
    }


}

