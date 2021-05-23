<?php

namespace app\controllers;

use app\components\InvoiceHelper;
use app\models\orders\Orders;
use Yii;
use yii\filters\VerbFilter;


/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class PdfController extends BaseController
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

    public function actionExportPdf(){
        $string_id=$_GET['string_id'];
        $ides = explode(",", $string_id);
        $models=Orders::find()->where(['in','id',$ides])->all();
        $mpdf =  new \Mpdf\Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->SetDirectionality('rtl');
        foreach($models as $key =>$model){
            $html=InvoiceHelper::html_invice($model);
            $mpdf->WriteHTML($html);
            if(count($models) > $key+1){
                $mpdf->AddPageByArray(array(
                    'orientation' => '',
                ));
            }
           
        }
        
        

        
        $mpdf->Output();
        exit;

    }


    public function actionView($id){
        return $this->render('view',['id'=>$id]);
    }
}
