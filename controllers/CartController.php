<?php

namespace app\controllers;
use Yii;
use app\models\products\Products;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CartController  extends  Controller
{

    protected $cart;

    public function init()
    {
        $this->cart = \Yii::$app->cart;
        parent::init();
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionAdd(){

        if ($this->request->isPost) {
            $this->enableCsrfValidation = false;
            $request = Yii::$app->request;
            $name = $request->post('name');
            $discount=$request->post('discount',0);
            $id = $request->post('id');
           $price=$request->post('price',0);
           $product = Products::findOne($id);
           if ($this->haveItem($id)){
               $this->cart->plus($product->id, 1);
           }else{
               $this->cart->add($product, 1);
           }

        }
    }



    public function actionPlusItem(){
        if ($this->request->isPost) {
            $request = Yii::$app->request;
            $id = $request->post('id');
            $this->cart->plus($id, 1);
        }
    }





    public function actionMinusItem(){
        if ($this->request->isPost) {
            $request = Yii::$app->request;
            $id = $request->post('id');
            $this->cart->plus($id, -1);
        }
    }

    public function actionRemoveItem(){
        if ($this->request->isPost) {
            $request = Yii::$app->request;
            $id = $request->post('id');
              $this->cart->remove($id);
        }
    }


    private function haveItem($id){
       $item=  $this->cart->getItem($id);
        if(is_null($item)){
            return false;
        }
        return true;
    }

    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}