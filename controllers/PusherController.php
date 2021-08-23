<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;

use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class PusherController extends Controller
{

    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = "new";
        }
        parent::init();
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render("index");


        $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => "78a323b54ba0c2d92d1f",
            "secretKey" => "925311a449a3dae55493",
        ));

        $publishResponse = $beamsClient->publish(
            array("hello"),
            array("fcm" => array("notification" => array(
                "title" => "Hello",
                "body" => "Hello, World!",
            )),
                ));



        $url = "https://d321108f-575c-46b0-89af-b8d5597fa641.pushnotifications.pusher.com/publish_api/v1/instances/d321108f-575c-46b0-89af-b8d5597fa641/publishes";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer 89F2280B4B7731648573FCFDE791BD48EB7ABEE0F46889BEC846A970C521B311",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{"interests":["hello"],"web":{"notification":{"title":"Hello","body":"Hello, world!"}}}';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        var_dump($resp);

    }

        public function actionIndex2(){
            return $this->render("index");
        }

}

