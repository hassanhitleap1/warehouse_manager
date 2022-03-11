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


    public function actionIndex(){
        $product = $this->findModel(1);
        $this->cart->add($product, 1);
    }


    public function actionGet(){
        var_dump( $this->cart->getItems());
    }
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}