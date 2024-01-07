<?php

namespace app\controllers;


use app\components\OrderShpifyHelper;
use app\components\ProductShpifyHelper;
use app\models\countries\Countries;
use app\models\regions\Regions;
use Carbon\Carbon;
use Yii;
use Intervention\Image\ImageManagerStatic as Image;

use app\models\User;
use Shopify\Shopify;
use Shopify\Clients\Rest;
use PHPShopify\ShopifySDK;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use Shopify\Clients\AdminRest;
use app\models\products\Products;
use yii\web\NotFoundHttpException;
use app\controllers\BaseController;
use app\models\suppliers\Suppliers;
use app\models\warehouse\Warehouse;
use app\models\categorises\Categorises;
use app\models\productsimage\ProductsImage;
use app\models\subproductcount\SubProductCount;
use app\models\OptionsSellProduct\OptionsSellProduct;

/**
 * CountriesController implements the CRUD actions for Countries model.
 */
class ImportController extends BaseController
{

    public $domain = '9d8b9f.myshopify.com';

    public $apiKey = "20a0a98b6ff2a077c6f235960d0f7bc0";
    public $apiSecret = "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";

    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = "new";
            if (Yii::$app->user->identity->type != User::SUPER_ADMIN) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
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


    public function actionIndex()
    {

        $from = Carbon::now()->addDays(-300)->toIso8601String();
        $to = Carbon::now()->addDays(1)->toIso8601String();



        $category = Categorises::find()->one();

        $supplier = Suppliers::find()->one();

        $warehouse = Warehouse::find()->one();

        $countryModel = Countries::find()->one();
        $regionsModel = Regions::find()->one();


        //$ordersData = OrderShpifyHelper::getApiOrderByDate($from, $to);

        $ordersData = OrderShpifyHelper::getOrders();
        echo "number order " . count($ordersData['orders']) . "<br/>";


        foreach ($ordersData['orders'] as $keyOrder => $order) {




            $productModel = OrderShpifyHelper::saveOrder(
                $order,
                $keyOrder,
                $countryModel,
                $regionsModel,
                $category,
                $supplier,
                $warehouse
            );

        }





    }


    public function actionOrder($id)
    {
        $order = OrderShpifyHelper::getOrdersById($id)['order'];
        $category = Categorises::find()->one();

        $supplier = Suppliers::find()->one();

        $warehouse = Warehouse::find()->one();

        $countryModel = Countries::find()->one();
        $regionsModel = Regions::find()->one();
        $countryModel = Countries::find()->one();
        $regionsModel = Regions::find()->one();
        $orderModel = OrderShpifyHelper::saveOrder(
            $order,
            1,
            $countryModel,
            $regionsModel,
            $category,
            $supplier,
            $warehouse
        );

    }




    public function actionProducts()
    {

        $category = Categorises::find()->one();

        $supplier = Suppliers::find()->one();

        $warehouse = Warehouse::find()->one();

        $productsData = ProductShpifyHelper::getProduct();

        foreach ($productsData['products'] as $key => $product) {
            $nextId = Products::find()->max('id') + 1;
            $productModel = Products::find()->where(['product_id' => $product['id']])->one();
            $productModel = ProductShpifyHelper::saveProduct($product, $productModel, $nextId, $category, $supplier, $warehouse, $key);

        }


    }
}
