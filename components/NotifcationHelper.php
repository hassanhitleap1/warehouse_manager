<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;



class NotifcationHelper extends BaseObject
{
        private  $app_id='572683';
        private   $app_key = '627b6a0bb17dace13a6f';
        private $app_secret = '78b24397ebd942fead2c';
        private  $app_cluster = 'mt1';

        public static  function push_order_notifcation($model){
            $options = [
                'cluster' => self::app_cluster,
                'useTLS' => false
            ];
            $pusher = new \Pusher(self::app_key, self::app_secret, self::app_id, $options);
            $data['message'] =Yii::t('app','New_Order');
            $pusher->trigger('my-channel', 'my-event', $data);
        }


}

