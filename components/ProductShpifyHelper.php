<?php

namespace app\components;

use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\products\Products;
use app\models\productsimage\ProductsImage;
use app\models\subproductcount\SubProductCount;
use Yii;
use yii\base\BaseObject;
use yii\helpers\FileHelper;
use yii\console\Controller;


class ProductShpifyHelper extends BaseObject
{

    public static $domain = '9d8b9f.myshopify.com';

    public static $apiKey = "20a0a98b6ff2a077c6f235960d0f7bc0";
    public static $apiSecret = "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";


    public static function getProduct()
    {
        $api_url = "https://" . self::$domain . "/admin/api/2021-07/products.json";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        throw new \Exception("error in rquast httpCode");
    }




    public static function getActiveProducts()
    {
        $api_url = "https://" . self::$domain . "/admin/api/2022-01/products.json?status=active";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        throw new \Exception("error in rquast httpCode");

    }

    public static function getArchivedProducts()
    {
        $api_url = "https://" . self::$domain . "/admin/api/2022-01/products.json?status=archived";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        throw new \Exception("error in rquast httpCode");

    }

    public static function getDraftProducts()
    {

        $api_url = "https://" . self::$domain . "/admin/api/2022-01/products.json?status=draft";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        throw new \Exception("error in rquast httpCode");

    }



    public static function getProductById($id)
    {
        $api_url = "https://" . self::$domain . "/admin/api/2021-07/products/$id.json";
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_USERPWD, self::$apiKey . ":" . self::$apiSecret);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        throw new \Exception("error in rquast httpCode");
    }


    public static function isActive($product)
    {
        if ($product['status'] == "active") {
            return true;
        }
        return false;
    }



    public static function saveProduct($product, $productModel, $nextId, $category, $supplier, $warehouse, $keyProduct)
    {

        $isNew = true;
        $newLine = "<br/>";
        echo "key $keyProduct $newLine";

        if (is_null($productModel)) {
            $isNew = false;
            $productModel = new Products();
            $nextId = $productModel->id;
        }
        $productModel->scenario = Products::SCENARIO_IMPORT;

        $productModel->name = !isset($product['title']) && $product['title'] !== "" ? $product['title'] : ".....";
        $productModel->product_id = (string) $product['id'];
        $productModel->description = "description"; //$product['body_html'];
        $productModel->purchasing_price = ($product['variants'][0]['price'] * 0.20) - $product['variants'][0]['price'];
        $productModel->selling_price = (float) $product['variants'][0]['price'];
        $productModel->quantity = 10;
        $productModel->quantity_come = 10;
        $productModel->category_id = !is_null($category) ? $category->id : 1;
        $productModel->supplier_id = !is_null($supplier) ? $supplier->id : 1;
        $productModel->warehouse_id = !is_null($warehouse) ? $warehouse->id : 1;
        if (isset($product['image']['src'])) {
            $dataThumbnail = self::saveImageInStorage($product['image']['src'], $nextId, $isNew);
        } else {
            $dataThumbnail['thumbnail'] = 'thumbnail.png';
            $dataThumbnail['thumb'] = 'thumb.png';
        }

        $productModel->thumbnail = $dataThumbnail['thumbnail'];
        $productModel->thumb = $dataThumbnail['thumb'];
        $productModel->unit_id = 1;
        $productModel->type_options = 1;
        $productModel->featured = 1;
        $productModel->top_selling = 1;
        $productModel->discount = "10";
        $productModel->days = 2;
        $productModel->hours = 8;
        $productModel->muints = 45;
        $productModel->second = 45;
        $productModel->status = 1;

        $productModel->images_product = "";


        if (!$productModel->save()) {
            echo "error in  product $keyProduct\n";
            $allErrors = $productModel->getErrors();
            foreach ($allErrors as $attributeErrors) {
                foreach ($attributeErrors as $error) {
                    echo "$error \n";
                }
            }
        }

        self::saveImagesInStorage($product['images'], $productModel, $isNew);


        self::saveVariants($product['variants'], $productModel, $isNew);


        return $productModel;
    }




    public static function saveImageInStorage($imageUrl, $nextId, $isNew)
    {


        $folderPath = "products/$nextId";
        FileHelper::createDirectory($folderPath, 0777, true);
        $filePath = $folderPath . '/1.png';
        if (self::storeImageInStorage(Yii::getAlias('@app/web') . '/' . $filePath, $imageUrl)) {
            return [
                'thumbnail' => $filePath,
                'thumb' => $filePath,
            ];
        }


        return [
            'thumbnail' => '/',
            'thumb' => './'
        ];










    }




    public static function storeImageInStorage($filePath, $src)
    {

        return true;
        $imageContent = file_get_contents($src);

        if ($imageContent === false) {
            return false;
        }

        if (file_put_contents($filePath, $imageContent) !== false) {
            return true;
        }
        return false;
    }


    public static function saveImagesInStorage($images, $productModel, $isNew)
    {


        $folderPath = "products/$productModel->id";
        FileHelper::createDirectory($folderPath, 0777, true);
        foreach ($images as $key => $image) {
            $modelImagesProduct = new ProductsImage();
            $filePath = "$folderPath/$key" . ".png";
            if (self::storeImageInStorage(Yii::getAlias('@app/web') . '/' . $filePath, $image['src'])) {
                $modelImagesProduct->product_id = $productModel->id;
                $modelImagesProduct->path = $filePath;
                $modelImagesProduct->thumbnail = $filePath;
                $modelImagesProduct->save(false);
            }

        }

    }





    public static function saveVariants($variants, $productModel, $isNew)
    {


        if ($isNew) {
            foreach ($variants as $variant) {
                $subProductCount = new SubProductCount();
                $subProductCount->product_id = $productModel->id;
                $subProductCount->variant_id = (string) $variant['id'];
                $subProductCount->type = $variant['title'];
                $subProductCount->count = 10000;
                $subProductCount->save(false);
            }

            $optionsSellProduct = new OptionsSellProduct();
            $optionsSellProduct->number = 1;
            $optionsSellProduct->product_id = $productModel->id;
            $optionsSellProduct->text = $productModel->name;
            $optionsSellProduct->price = (float) $variant['price'];
            $optionsSellProduct->save(false);

        } else {

            foreach ($variants as $variant) {
                $subProductCount = SubProductCount::find()->where(['variant_id' => $variant['id']])->one();
                if (is_null($subProductCount)) {
                    $subProductCount = new SubProductCount();
                    $subProductCount->product_id = $productModel->id;
                    $subProductCount->variant_id = $variant['id'];
                    $subProductCount->type = $variant['title'];
                    $subProductCount->count = 10000;
                    $subProductCount->save();
                } else {
                    $subProductCount->product_id = $productModel->id;
                    $subProductCount->variant_id = $variant['id'];
                    $subProductCount->type = $variant['title'];
                    $subProductCount->count = 10000;
                    $subProductCount->save();
                }

            }


            $optionsSellProduct = OptionsSellProduct::find()->where(['product_id' => $productModel->id])->one();
            if (!empty($subProductCount)) {
                $optionsSellProduct = new OptionsSellProduct();
                $optionsSellProduct->number = 1;
                $optionsSellProduct->product_id = $productModel->id;
                $optionsSellProduct->text = $productModel->name;
                $optionsSellProduct->price = (float) $variant['price'];
                $optionsSellProduct->save(false);

            } else {
                $optionsSellProduct->number = 1;
                $optionsSellProduct->product_id = $productModel->id;
                $optionsSellProduct->text = $productModel->name;
                $optionsSellProduct->price = (float) $variant['price'];
                $optionsSellProduct->save(false);

            }

        }

    }


}

