<?php

namespace app\controllers;

use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\Outlays\Outlays;
use Yii;
use yii\filters\VerbFilter;

class  DashboardController extends BaseController {


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
     * Lists all Categorises models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $date=date('Y-m-d');
        $orders = Orders::find()->select(['count(*) as count_order', 'sum(amount_required) as total_sales' ,'sum(profit_margin)  as profit_margin',
            "(select count(orders_item.quantity) from orders_item where date(created_at) = '$date' ) as quantity"])
            ->andWhere('date(created_at) >= :date', [':date' => $date])
            ->groupBy(['DAY(`created_at`)'])
            ->asArray()->one();

     
          return $this->render('index',[
            'orders'=>$orders,
        ]);
    }


    public function actionSales(){

        if(date('m') < 7 ){
            $month=date('m');
        }else{
            $month = date('m', strtotime(date('Y-m-d'). ' -7 month'));
        }

        if(date('d') < 7 ){
            $day=date('d');
        }else{
            $day = date('d', strtotime(date('Y-m-d'). ' -7 day'));
        }
        $profits_day_model = Orders::find()->select([
             'count(*) as count_order',
             'sum(orders.profit_margin)  as profit_margin',
             'MONTH(`orders`.`created_at`) as month',
             'count(orders_item.quantity) as quantity',
             'DAY(orders.created_at) as day',
             'sum(outlays.value)  as outlays',
             ])
             ->join('inner JOIN', 'orders_item', 'orders_item.order_id = orders.id')
             ->join('left JOIN', 'outlays', 'Date(outlays.created_at) = Date(orders.created_at)')
             ->andWhere('YEAR(orders.created_at)=:year', [':year' => date('Y')])
            ->andWhere('MONTH(orders.created_at)=:month', [':month' => date('m')])
            ->groupBy(['DAY(`orders`.`created_at`)'])
            ->orderBy(['orders.created_at'=>SORT_ASC])
            ->asArray()->all();
            
        $profits_month_model = Orders::find()->select([
            'count(*) as count_order',
            'sum(orders.profit_margin)  as profit_margin',
            'MONTH(orders.created_at) as month',
            'count(orders_item.quantity) as quantity',
            'sum(outlays.value)  as outlays',
        ])
        ->join('inner JOIN', 'orders_item', 'orders_item.order_id = orders.id')
        ->join('left JOIN', 'outlays', 'Date(outlays.created_at) = Date(orders.created_at)')
        ->andWhere('YEAR(orders.created_at)=:year', [':year' => date('Y')])
            ->groupBy(['MONTH(orders.created_at)'])
            ->orderBy(['orders.created_at'=>SORT_ASC])
            ->asArray()->all();


        return $this->render('sales',[
            'profits_day_model'=>$profits_day_model,
            'profits_month_model'=>$profits_month_model,
        ]);
    }


    public function actionProduct(){
        $product_id=-1;
        $models = OrdersItem::find()->select([
            'count(orders_item.quantity) as count_quantity',
            'sum(price_item_count) as total_sales' ,
            'sum(profits_margin)  as profits_margin',
            'products.name',
            'sub_product_count.type'])
            ->join('inner JOIN', 'products', 'products.id = orders_item.product_id')
            ->join('inner JOIN', 'sub_product_count', 'sub_product_count.id = orders_item.sub_product_id')
            ->where(["product_id",$product_id])
            ->orderBy(['profits_margin'=>SORT_ASC])
            ->asArray()->limit(30)->all();


        return $this->render('product',[
            'models'=>$models
        ]);
    }

    public function actionOrders(){

        if(date('m') < 7 ){
            $month=date('m');
        }else{
            $month = date('m', strtotime(date('Y-m-d'). ' -7 month'));
        }

        if(date('d') < 7 ){
            $day=date('d');
        }else{
            $day = date('d', strtotime(date('Y-m-d'). ' -7 day'));
        }

        // SELECT count(*) ,count(`profit_margin`) FROM `orders` GROUP BY YEAR(`created_at`), MONTH(`created_at`),DAY(`created_at`)
        $profits_day_model = Orders::find()->select(['count(*) as count_order', 'sum(profit_margin)  as profit_margin','MONTH(`created_at`) as month','DAY(`created_at`) as day'])
            ->andWhere('YEAR(created_at)=:year', [':year' => date('Y')])
            ->andWhere('MONTH(created_at)=:month', [':month' => date('m')])
            ->andWhere('DAY(created_at) >= :day', [':day' => $day])
            ->groupBy(['YEAR(`created_at`)', ' MONTH(`created_at`)','DAY(`created_at`)'])
            ->asArray()->all();

        $profits_month_model = Orders::find()->select(['count(*) as count_order', 'sum(profit_margin)  as profit_margin','MONTH(`created_at`) as month'])
            ->andWhere('YEAR(created_at)=:year', [':year' => date('Y')])
            ->andWhere('MONTH(created_at)>= :month', [':month' => $month])
            ->groupBy(['YEAR(`created_at`)', ' MONTH(`created_at`)'])
            ->asArray()->all();

        $label_month=[];
        $label_day=[];
        $orders_count_month=[];
        $orders_count_day=[];
        $profits_month=[];
        $profits_day=[];

        foreach($profits_day_model as $profit_day){
            $label_day[]=$profit_day['day'];
            $orders_count_day[]=$profit_day['count_order'];
            $profits_day[]=$profit_day['profit_margin'];
        }


        foreach($profits_month_model as $profit_month){
            $label_month[]=$profit_day['month'];
            $orders_count_month[]=$profit_day['count_order'];
            $profits_month[]=$profit_day['profit_margin'];
        }
        return $this->render('orders',[
            'label_month'=>$label_month,
            'label_day'=>$label_day,
            'orders_count_month'=>$orders_count_month,
            'orders_count_day'=>$orders_count_day,
            'profits_month'=>$profits_month,
            'profits_day'=> $profits_day,
        ]);
    }

    public function actionOutlay(){

        if(date('m') < 7 ){
            $month=date('m');
        }else{
            $month = date('m', strtotime(date('Y-m-d'). ' -7 month'));
        }

        if(date('d') < 7 ){
            $day=date('d');
        }else{
            $day = date('d', strtotime(date('Y-m-d'). ' -7 day'));
        }

        // SELECT count(*) ,count(`profit_margin`) FROM `orders` GROUP BY YEAR(`created_at`), MONTH(`created_at`),DAY(`created_at`)
        $outlays_day_model = Outlays::find()->select([ 'sum(value)  as outlays','MONTH(`created_at`) as month','DAY(`created_at`) as day'])
            ->andWhere('YEAR(created_at)=:year', [':year' => date('Y')])
            ->andWhere('MONTH(created_at)=:month', [':month' => date('m')])
            ->andWhere('DAY(created_at) >= :day', [':day' => $day])
            ->groupBy(['YEAR(`created_at`)', ' MONTH(`created_at`)','DAY(`created_at`)'])
            ->asArray()->all();

        $outlays_month_model = Outlays::find()->select([ 'sum(value)  as outlays','MONTH(`created_at`) as month'])
            ->andWhere('YEAR(created_at)=:year', [':year' => date('Y')])
            ->andWhere('MONTH(created_at)>= :month', [':month' => $month])
            ->groupBy(['YEAR(`created_at`)', ' MONTH(`created_at`)'])
            ->asArray()->all();


        return $this->render('outlay',[
            'outlays_day_model'=>$outlays_day_model,
            'outlays_month_model'=>$outlays_month_model,
        ]);
    }

    public function actionBestSeller(){
        $date=date('Y-m-d');
        $orders = OrdersItem::find()->select([
            'count(orders_item.quantity) as count_quantity', 
            'sum(price_item_count) as total_sales' ,
            'sum(profits_margin)  as profits_margin',
            'products.name',
            'sub_product_count.type'])
            ->join('inner JOIN', 'products', 'products.id = orders_item.product_id')
            ->join('inner JOIN', 'sub_product_count', 'sub_product_count.id = orders_item.sub_product_id')
            ->groupBy(['sub_product_id'])
            ->orderBy(['count_quantity'=>SORT_DESC])
            ->asArray()->limit(24)->all();
        
       
        return $this->render('best-seller',['orders'=>$orders]);
    }
    
}