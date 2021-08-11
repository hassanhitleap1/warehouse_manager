<?php

namespace app\controllers;


use app\components\ApiOrderHelper;
use app\models\orders\Orders;
use app\models\orders\OrdersSearch;
use Yii;
use yii\filters\VerbFilter;
use kartik\export\ExportMenu;


/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class ExportController extends BaseController
{
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

    public function actionExport(){
        $string_id=$_GET['string_id'];
        $ides = explode(",", $string_id);
        $models=Orders::find()->where(['in','id',$ides])->all();
        $out = fopen("php://output", 'w');
        foreach($models as $key =>$model){
            $data=[
                "order_id"=>$model['order_id'],
                "name"=>$model['user']['name'],
                'phone'=>$model['user']['phone'] ,
                "region"=>$model['region']['name_ar'],
                "area"=>$model['region']['name_ar'],
                "smaplearea"=>$model['region']['name_ar'],
                'address'=>$model['user']['address'] ,
                'amount'=>$model['total_price'],
            ];
            fputcsv($out, $data,"\t");
        }


        header("Content-Disposition: attachment; filename=\"demo.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        fclose($out);
    }



    public function actionExportToDriver(){
        $string_id=$_GET['string_id'];
        $ides = explode(",", $string_id);
        $models=Orders::find()->where(['in','id',$ides])->all();
        $api = new ApiOrderHelper();
        $respoance=[];
        foreach ($models as $key => $model){
            $res=$api->push_order($model);
            $respoance[]=["status"=>$res["status"],"data"=>$model];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $respoance;
    }
}
