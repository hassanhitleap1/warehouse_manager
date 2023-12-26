<?php

namespace app\controllers;


use app\components\ProductShpifyHelper;
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

    /**
     * Lists all Countries models.
     * @return mixed
     */
    //     public function actionIndex()
//     {


    //         $domain = '9d8b9f.myshopify.com';
//         //$domain =  'dupamine.com';
//         //$apiKey = '6137dbfb9c9c6c98ca016128455fbd55';
//         $apiSecret = '24040447826bc0fcc592196233428f35';
//        // $accessToken="fe25c49239f535d5f5ed1c988217a870";
//         $accessToken ="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";
//         $apiKey="20a0a98b6ff2a077c6f235960d0f7bc0";
//         $apiSecret="24040447826bc0fcc592196233428f35";
//         $shopifyPassword="Programerhk92@";//////////////




    //         // $api_url = "https://$domain/admin/api/2023-10/orders.json";

    //         $api_url="https://9d8b9f.myshopify.com/admin/api/2023-10/orders.json";


    //         $api_url="https://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:Programerhk92@9d8b9f.myshopify.com/admin/api/2023-10/orders.json";


    //             // Create cURL resource
//         $ch = curl_init($api_url);

    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
//         curl_setopt($ch, CURLOPT_USERPWD, "$apiKey:$shopifyPassword");

    //         // Execute cURL request and get response
//         $response = curl_exec($ch);

    //         echo $response;
//         print_r($response);


    //         // Check for cURL errors
//         if (curl_errno($ch)) {
//             echo 'Curl error: ' . curl_error($ch);
//         }

    //         // Close cURL resource
//         curl_close($ch);

    //         // Decode the JSON response
//         $orders = json_decode($response, true);


    //         print_r($orders);

    //         exit;
//         //////////////////////////////


    //         // $shopifyClient = new \Shopify\Clients\AdminRest($domain, $accessToken);


    //         $apiEndpoint = "https://$domain/admin/api/2021-10/orders.json";


    //         $headers = [
//             'Authorization' => 'Basic ' . base64_encode("$apiKey:$shopifyPassword"),
//             'Content-Type' => 'application/json',
//         ];

    //         // Create a Guzzle HTTP client
//         $client = new \GuzzleHttp\Client();

    //         // Send a GET request to Shopify API
//         try {
//             $response = $client->request('GET', $apiEndpoint, [
//                 'headers' => $headers,
//             ]);

    //             // Check for a successful response
//             if ($response->getStatusCode() == 200) {
//                 $data = json_decode($response->getBody(), true);
//                 // $data contains the list of orders
//                 print_r($data);
//             } else {
//                 echo "Error: Unable to fetch orders.";
//             }
//         } catch (\GuzzleHttp\Exception\RequestException $e) {
//             echo "Error: " . $e->getMessage();
//         }







    //         exit;



    //         $config = array(
//             'ShopUrl' => $domain,
//             'AccessToken' =>  $accessToken,
//         );



    //         $shopifyClient = new \Shopify\Clients\AdminRest($domain, $accessToken);

    //         $ordersResponse = $shopifyClient->get('orders');

    //         if ($ordersResponse->isSuccess()) {
//             $orders = $ordersResponse->getBody('orders');

    //             foreach ($orders as $order) {
//                 // Process the order here
//             }
//         } else {
//             echo $ordersResponse->getErrorMessage();
//         }


    //         print_r($orders );
//         exit;



    //         \PHPShopify\ShopifySDK::config($config);
//         $shopify= new  \PHPShopify\ShopifySDK;
//      $orders = $shopify->Order->get([
//                 'status' => 'open',
//             ]);   
//         print_r($orders );
//         exit;

    //         // $config = array(
//         //     'ShopUrl' => $domain ,
//         //     'ApiKey' => $apiKey ,
//         //     'Password' =>  $apiSecret,   
//         //     'Curl' => array(
//         //         CURLOPT_TIMEOUT => 10,
//         //         CURLOPT_FOLLOWLOCATION => true
//         //     )
//         // );


    //         // print_r($products);
//         // exit;


    //         $shopifyClient = new \Shopify\Clients\Rest($domain, $apiKey, $apiSecret);

    //         $order = $shopifyClient->get('orders/order_id.json');

    //         if ($order->isSuccess()) {
//             // Process the order here
//         } else {
//             echo $order->getErrorMessage();
//         }

    //         // $shopify = new ShopifySDK([
//         //     'api_key' => '6137dbfb9c9c6c98ca016128455fbd55',
//         //     'api_secret' => 'fe25c49239f535d5f5ed1c988217a870',
//         //     'shop_name' => '9d8b9f',
//         //     'ShopUrl' => $domain ,
//         // ]);

    //         // $shopify = new \PHPShopify\ShopifySDK([
//         //     'api_key' => '20a0a98b6ff2a077c6f235960d0f7bc0',
//         //     'api_secret' => '24040447826bc0fcc592196233428f35',
//         //     'shop_name' => '9d8b9f.myshopify.com',
//         // ]);
//         $products = $shopify->Product->get();

    //         print_r($products);
//         exit;
//         // $orders = $shopify->Order->get([
//         //     'status' => 'open',
//         // ]);

    //         // foreach ($orders as $order) {
//         //     echo $order->id . ' - ' . $order->name . PHP_EOL;
//         // }




    //         print_r($orders);


    // exit;





    //         $shopifyClient = new AdminRest($domain, $apiKey, $apiSecret);

    //         $order = $shopifyClient->get('orders/order_id.json');
//         print_r($order);
//         exit;

    //         // Method 1
//         $ordersResponse = $shopifyClient->get('orders', [
//             'created_at_min' => '2023-01-10',
//             'created_at_max' => '2023-01-10',
//         ]);




    //         // $shopifyClient = new Rest("9d8b9f.myshopify.com", "20a0a98b6ff2a077c6f235960d0f7bc0", "24040447826bc0fcc592196233428f35");









    //         $shopifyClient = new \Shopify\Clients\Rest($domain, $apiKey, $apiSecret);

    //         $ordersResponse = $shopifyClient->post('orders/search', [
//             'json' => [
//                 'query' => 'created_at:2023-01-10',
//             ],
//         ]);



    //         if ($response->getStatusCode() === 200) {
//             // Parse the JSON response to get product data
//             $data = json_decode($response->getBody());

    //             // Loop through the products and do something with each one
//             foreach ($data->products as $product) {
//                 // Access product information here
//                 echo 'Product Title: ' . $product->title . '<br>';
//                 echo 'Product ID: ' . $product->id . '<br>';
//                 echo '<br>';
//             }
//         } else {
//             echo 'Failed to fetch products. HTTP Status Code: ' . $response->getStatusCode();
//         }


    //         exit;







    //         $shopifyClient = new \Shopify\Clients\Rest($domain, $apiKey, $apiSecret);

    //         // Method 1
//         $ordersResponse = $shopifyClient->get('orders', [
//             'created_at_min' => '2023-01-10',
//             'created_at_max' => '2023-01-10',
//         ]);

    //         $orders = $shopifyClient->get('orders', [
//             'limit' => 250,
//         ]);
//         print_r($orders);
//         exit;





    //         if ($ordersResponse->isSuccess()) {
//             $orders = $ordersResponse->getBody('orders');

    //             foreach ($orders as $order) {
//                 // Process the order here
//             }
//         } else {
//             echo $ordersResponse->getErrorMessage();
//         }


    //     }




    public function actionProducts()
    {

        $category = Categorises::find()->one();

        $supplier = Suppliers::find()->one();

        $warehouse = Warehouse::find()->one();

        $productsData = ProductShpifyHelper::getProduct();

        foreach ($productsData['products'] as $key => $product) {
            $nextId = Products::find()->max('id') + 1;

            $productModel = Products::find()->where(['product_id' => $product['id']])->one();
            if (ProductShpifyHelper::isActive($product)) {
                $productModel = ProductShpifyHelper::saveProduct($product, $productModel, $nextId, $category, $supplier, $warehouse, $key);
            }
        }


    }
}
