<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;



class NotifcationHelper extends BaseObject
{

        const  cluster = 'ap2';
        const auth_key='01d79c8e5aa5482515d5';
        const secret='37cdba311951cfcad1ec';
        const app_id='1319603';

        public static  function push_order_notifcation($model){

            $options = array(
                'cluster' => self::cluster,
                'useTLS' => true
            );
            $pusher = new \Pusher\Pusher(
                 self::auth_key,
                self::secret,
                self::app_id,
                $options
            );

            $data['message'] = 'hello world';
            $pusher->trigger('my-channel', 'my-event', $data);



        }


}

