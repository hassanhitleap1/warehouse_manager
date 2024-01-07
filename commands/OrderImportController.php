<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\OrderShpifyHelper;
use app\components\ProductShpifyHelper;
use app\models\categorises\Categorises;
use app\models\countries\Countries;
use app\models\orders\Orders;
use app\models\products\Products;
use app\models\regions\Regions;
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
class OrderImportController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {


        $filters = [
            // 'created_at_min' => $from,
            // 'created_at_max' => $to,

        ];
        $ordersData = OrderShpifyHelper::getOrdersFiltered($filters);


        echo "number order " . count($ordersData['orders']) . "\n";

        foreach ($ordersData['orders'] as $key => $order) {

            $countryModel = Countries::find()->one();
            $regionsModel = Regions::find()->one();
            $productModel = OrderShpifyHelper::saveOrder($order, $key, $countryModel, $regionsModel);
        }


        return ExitCode::OK;
    }
}
