<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;



class NotifcationHelper extends BaseObject
{
        const  app_id='572683';
        const   app_key = '627b6a0bb17dace13a6f';
        const app_secret = '78b24397ebd942fead2c';
        const  app_cluster = 'mt1';
        const Instance='d321108f-575c-46b0-89af-b8d5597fa641';
        const secretKey='89F2280B4B7731648573FCFDE791BD48EB7ABEE0F46889BEC846A970C521B311';

        public static  function push_order_notifcation($model){
//            $options = [
//                'cluster' => self::app_cluster,
//                'useTLS' => false
//            ];
//            $pusher = new \Pusher(self::app_key, self::app_secret, self::app_id, $options);
//            $data['message'] =Yii::t('app','New_Order');
//            $pusher->trigger('my-channel', 'my-event', $data);

//            $pushNotifications = new \Pusher\PushNotifications\PushNotifications(array(
//                "instanceId" => self::Instance,
//                "secretKey" => self::secretKey,
//            ));
//            $pusher = new \Pusher\Pusher(self::app_id, self::secretKey , self::app_id, ['cluster' => self::app_cluster]);
//
//            $options = [
//                'cluster' =>  self::app_cluster,
//                'useTLS' => false
//            ];
          //  $pusher = new \Pusher\Pusher(self::app_key, self::app_secret, self::app_id, $options);


//            $pusher = new \Pusher\Pusher(self::app_key, self::secretKey,
//                self::app_id, array('cluster' => self::app_cluster));
//
//            $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world'));



            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
            );
            $pusher = new \Pusher\Pusher(
                '01d79c8e5aa5482515d5',
                '37cdba311951cfcad1ec',
                '1319603',
                $options
            );

            $data['message'] = 'hello world';
            $pusher->trigger('my-channel', 'my-event', $data);



        }


}

