<?php

namespace app\components;

use app\models\area\Area;
use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\products\Products;
use app\models\productsimage\ProductsImage;
use app\models\subproductcount\SubProductCount;
use app\models\User;
use app\models\users\Users;
use Carbon\Carbon;
use Yii;
use yii\base\BaseObject;
use yii\helpers\FileHelper;
use yii\console\Controller;


class OrderShpifyHelper extends BaseObject
{

    public static $domain = '9d8b9f.myshopify.com';

    public static $apiKey = "20a0a98b6ff2a077c6f235960d0f7bc0";
    public static $apiSecret = "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";





    public static function getOrdersById($id)
    {
        $api_url = "https://" . self::$domain . "/admin/api/2021-07/orders/$id.json";
        // Construct the API endpoint URL

        // Initialize cURL session
        $ch = curl_init($api_url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors and HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close cURL session
        curl_close($ch);

        if ($httpCode === 200) {

            return json_decode($response, true);


        }


        throw new \Exception("error in rquast httpCode");
    }



    public static function getApiOrderByDate($form, $to)
    {

        $api_url = "https://" . self::$domain . "/admin/api/2021-07/orders.json?created_at_min=$form&created_at_max=$to";

        $ch = curl_init($api_url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors and HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close cURL session
        curl_close($ch);

        if ($httpCode === 200) {
            return json_decode($response, true);
        }

        throw new \Exception("error in rquast httpCode");

    }







    public static function getOrders()
    {
        $api_url = "https://" . self::$domain . "/admin/api/2021-07/orders.json";
        // Construct the API endpoint URL

        // Initialize cURL session
        $ch = curl_init($api_url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors and HTTP status code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close cURL session
        curl_close($ch);

        if ($httpCode === 200) {

            return json_decode($response, true);


        }

        throw new \Exception("error in rquast httpCode");
    }





    public static function saveOrder($order, $keyOrder, $countryModel, $category, $regionsModel, $supplier, $warehouse)
    {

        $flag = true;
        $transaction = \Yii::$app->db->beginTransaction();
        $newLine = "<br/>";
        $model = Orders::find()->where(['order_shopify_id' => (string) $order['id']])->one();
        $areaModel = Area::find()->one();
        $address = $order['shipping_address']['address1'];
        $firstName = $order['shipping_address']['first_name'];
        $lastName = $order['shipping_address']['last_name'];
        $fullName = "$firstName $lastName";
        $phoneNumber = self::getPhone($order['billing_address']['phone']);

        if (is_null($model)) {
            $model = new Orders();
            $id_lead_last = Yii::$app->db->createCommand("SELECT MAX(`id`) as `max` FROM `orders` WHERE 1")->queryScalar();
            $order_id = $id_lead_last + 1000000;
            $model->order_shopify_id = (string) $order['id'];

        } else {
            $order_id = $model->order_id;

        }

        $model->order_id = $order_id;
        $model->status_id = 2;
        $model->region_id = $regionsModel->id;
        $model->delivery_price = (float) $order['total_shipping_price_set']['shop_money']['amount'];
        $model->amount_required = (float) $order['total_price'] - $order['total_shipping_price_set']['shop_money']['amount'];
        $model->total_price = (float) $order['total_price'];
        $model->discount = 0;
        $model->profit_margin = 0;
        $model->name = $fullName;
        $model->phone = $phoneNumber;

        $model->address = $address;
        if (is_null($user = Users::find()->where(['phone' => $phoneNumber])->one())) {
            $user = new Users();
        }

        $user = self::defaultDataUser($order, $user, $phoneNumber, $countryModel, $regionsModel, $areaModel);

        $model->delivery_time = Carbon::now("Asia/Amman")->toTimeString();
        if (!$user->save()) {
            $allErrors = $user->getErrors();
            foreach ($allErrors as $attributeErrors) {
                foreach ($attributeErrors as $error) {
                    echo "<user> $error $newLine";
                }
            }
            $flag = false;

            $transaction->rollBack();
            return Controller::EXIT_CODE_ERROR; // exit with an error code

        }


        if (!$model->save()) {
            $allErrors = $model->getErrors();
            foreach ($allErrors as $attributeErrors) {
                foreach ($attributeErrors as $error) {
                    echo "<order> $error $newLine";
                }
            }
            $flag = false;
            return Controller::EXIT_CODE_ERROR; // exit with an error code
        }


        if (count($order['line_items']) >= 0) {
            foreach ($order['line_items'] as $item) {

                $orderItem = new OrdersItem();
                $subProductCount = SubProductCount::find()->where(['variant_id' => (string) $item['variant_id']])->one();

                if (is_null($subProductCount)) {
                    $product = ProductShpifyHelper::getProductById($item['product_id'])['product'];

                    $nextId = Products::find()->max('id') + 1;
                    $productModel = Products::find()->where(['product_id' => $item['product_id']])->one();
                    $productModel = ProductShpifyHelper::saveProduct(
                        $product,
                        $productModel,
                        $nextId,
                        $category,
                        $supplier,
                        $warehouse,
                        1
                    );

                    if (!is_null($productModel)) {
                        $subProductCount = SubProductCount::find()->where(['variant_id' => $item['variant_id']])->one();
                    } else {
                        $transaction->rollBack();
                        $flag = false;
                        break;
                    }


                }

                $orderItem = self::setOrderItems($model, $orderItem, $item, $subProductCount);

                if (!$orderItem->save()) {
                    echo "error in  orderItem <<<<<<<<<>>>>>>>>>>>>>>>>>>> $keyOrder $newLine";


                    echo "----------<<<<<<<<<<>>>>>>>>>>>>>>>>>>>------------------------$newLine";
                    echo "variant_id " . $item['variant_id'] . "$newLine";
                    echo "product_id " . $item['product_id'] . "$newLine";

                    echo "----------<<<<<<<<<<>>>>>>>>>>>>>>>>>>>------------------------$newLine";


                    $allErrors = $orderItem->getErrors();
                    foreach ($allErrors as $attributeErrors) {
                        foreach ($attributeErrors as $error) {
                            echo "$error $newLine";
                        }
                    }

                    $flag = false;

                    $transaction->rollBack();

                    return Controller::EXIT_CODE_ERROR; // exit with an error code


                } else {
                    echo "save orderItem  $newLine";
                }



            }

        } else {
            echo "count number line_items   " . count($order['line_items']) . "$newLine";
        }




        if ($flag) {
            // echo "commit  order number $keyOrder  $newLine";
            $transaction->commit();
        }
        // else {
        //     echo "noooooot <<<<<<>>>><<<>>   commit order number $keyOrder  $newLine";
        // }

        $flag = (int) $flag;

        return $model;
    }



    public static function setOrderItems($model, $orderItem, $item, $subProductCount)
    {

        $orderItem->order_id = $model->id;
        $orderItem->sub_product_id = $subProductCount->id;
        $orderItem->quantity = 1;
        $orderItem->order_id = $model->id;
        $orderItem->price = 1.00; //$item['price'];
        $orderItem->profit_margin = 1.00; //$item['price'];
        $orderItem->price_item_count = 1.00; //$item['price'];
        $orderItem->profits_margin = 1.00; //$item['price'];
        $orderItem->product_id = $subProductCount->product_id;
        return $orderItem;
    }

    public static function isFirstCharacterZero($phoneNumber)
    {
        // Use the substr function to get the first character of the string
        $firstCharacter = substr($phoneNumber, 0, 1);

        // Check if the first character is '0'
        return $firstCharacter === '0';
    }




    public static function defaultDataUser($order, $user, $phoneNumber, $countryModel, $regionModel, $areaModel)
    {


        $firstName = $order['shipping_address']['first_name'];
        $lastName = $order['shipping_address']['last_name'];
        $address = $order['shipping_address']['address1'];
        $city = $order['shipping_address']['city'];
        $country = $order['shipping_address']['country'];
        $user->phone = $phoneNumber;
        $user->name = "$firstName $lastName";
        $user->avatar = "dsd";
        $user->country_id = is_null($countryModel) ? $countryModel->id : 1;
        $user->region_id = is_null($regionModel) ? $regionModel->id : 1;
        $user->area_id = is_null($areaModel) ? $areaModel->id : 1;
        $user->address = $address;
        $user->username = null;
        $user->email = null;
        $user->auth_key = null;
        $user->name_in_facebook = null;
        $user->password_hash = null;
        $user->password_reset_token = null;
        $user->created_at = null;
        $user->updated_at = null;
        return $user;

    }





    public static function getPhone($phoneNumber)
    {
        $phoneNumber = str_replace('+962', '', $phoneNumber);
        $phoneNumber = str_replace('00962', '', $phoneNumber);
        $with = static::isFirstCharacterZero($phoneNumber) ? '' : '0';
        return $with . $phoneNumber;

    }


}

