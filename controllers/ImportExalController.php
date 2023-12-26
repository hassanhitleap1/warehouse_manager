<?php

namespace app\controllers;


use app\models\orders\Orders;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
class ImportExalController extends BaseController
{



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
        set_time_limit(30000000000000000);
        ini_set('memory_limit', '-1');

        $orderModel = new Orders();
        $productModel = new Products();




        if (\Yii::$app->request->isPost) {

            $file = \yii\web\UploadedFile::getInstanceByName('excelFile');

            if ($file && $file->tempName) {

                $spreadsheet = IOFactory::load($file->tempName);
                $sheet = $spreadsheet->getActiveSheet();

                foreach ($sheet->getRowIterator() as $row) {
                    $rowData = $row->getValues();

                    $product = Products::find()->where(['name' => trim($rowData[2])])->one();



                }

                \Yii::$app->session->setFlash('success', 'Import successful.');

            }

        }




    }



}
