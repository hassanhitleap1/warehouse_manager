<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\ProductShpifyHelper;
use app\models\categorises\Categorises;
use app\models\products\Products;
use app\models\suppliers\Suppliers;
use app\models\warehouse\Warehouse;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProductImportController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {

        $category = Categorises::find()->one();
        $supplier = Suppliers::find()->one();
        $warehouse = Warehouse::find()->one();

        $productsData = ProductShpifyHelper::getDraftProducts();
        foreach ($productsData['products'] as $key => $product) {
            $nextId = Products::find()->max('id') + 1;
            $productModel = Products::find()->where(['product_id' => $product['id']])->one();
            $productModel = ProductShpifyHelper::saveProduct($product, $productModel, $nextId, $category, $supplier, $warehouse, $key);
        }

        $productsData = ProductShpifyHelper::getArchivedProducts();
        foreach ($productsData['products'] as $key => $product) {
            $nextId = Products::find()->max('id') + 1;
            $productModel = Products::find()->where(['product_id' => $product['id']])->one();
            $productModel = ProductShpifyHelper::saveProduct($product, $productModel, $nextId, $category, $supplier, $warehouse, $key);
        }

        $productsData = ProductShpifyHelper::getActiveProducts();
        foreach ($productsData['products'] as $key => $product) {
            $nextId = Products::find()->max('id') + 1;
            $productModel = Products::find()->where(['product_id' => $product['id']])->one();
            $productModel = ProductShpifyHelper::saveProduct($product, $productModel, $nextId, $category, $supplier, $warehouse, $key);

        }


        return ExitCode::OK;
    }



    public function actionProduct($id)
    {


        $category = Categorises::find()->one();

        $supplier = Suppliers::find()->one();

        $warehouse = Warehouse::find()->one();

        $product = ProductShpifyHelper::getProductById($id);

        $nextId = Products::find()->max('id') + 1;

        $productModel = Products::find()->where(['product_id' => $product['id']])->one();
        if (ProductShpifyHelper::isActive($product)) {
            $productModel = ProductShpifyHelper::saveProduct(
                $product,
                $productModel,
                $nextId,
                $category,
                $supplier,
                $warehouse,
                1
            );
        }

        return ExitCode::OK;
    }
}
