<?php

namespace app\controllers\Products;

use Yii;
use app\controllers\BaseController;
use app\models\orders\OrderForm;
use app\models\products\Products;
use yii\filters\VerbFilter;


/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends BaseController
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


    public function actionIndex(){
        return "ddsd";
    }
    public function actionFasterOrder($id){
        $modelOrder= new OrderForm();
        return $this->renderAjax('faster_order',[
            'model' => $this->findModel($id),
           'modelOrder'=>$modelOrder
        ]);
    }

    public function actionSearch()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $search=$_GET["q"];
        $products =    Products::find()->andFilterWhere(['like', 'name', $search])->andFilterWhere(['like', 'description', $search])->orderBy(['id' => SORT_DESC])->all();
        return ["total_count"=>count($products),"incomplete_results"=>false,'items'=> $products];

    }

}
