<?php

namespace app\controllers;

use app\models\historystatus\HistoryStatus;
use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\Outlays\Outlays;
use Carbon\Carbon;
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
        
        $date=Carbon::now("Asia/Amman")->toDateString();
        $orders = Orders::find()->select(['count(*) as count_order',
            'sum(orders.amount_required) as total_sales' ,
            "(SELECT sum(profits_margin) FROM `orders_item`  inner join orders on  orders.id = orders_item.order_id where date(orders_item.created_at) ='$date' and orders.status_id in (1,2,3,4)  )  as  profit_margin",
             "(SELECT sum(quantity) FROM `orders_item`  inner join orders on  orders.id = orders_item.order_id  where date(orders_item.created_at) ='$date' and  orders.status_id in (1,2,3,4) )  as  quantity",
             "(SELECT sum(value) FROM `outlays`  where date(outlays.created_at) ='$date')  as  outlays",
            ])->andWhere('date(orders.created_at) >= :date', [':date' => $date])
            ->andWhere(['in','orders.status_id', [1,2,3,4]])
            ->groupBy(['DAY(orders.created_at)'])
            ->asArray()->one();
    
        $subQuery = Orders::find()->select('id')->andWhere(['in','orders.status_id', [1,2,3,4]])->andWhere('date(orders.created_at) >= :date', [':date' => $date]);
        $details=OrdersItem::find()->select(['sum(orders_item.quantity) as sum_quantity','orders_item.product_id','orders_item.sub_product_id','orders_item.quantity','products.name','sub_product_count.type'])
            ->innerJoin('products', 'products.id=orders_item.product_id')
            ->innerJoin('sub_product_count', 'sub_product_count.id= orders_item.sub_product_id')
            ->andWhere('date(orders_item.created_at) >= :date', [':date' => $date])
            ->where(['in', 'orders_item.order_id', $subQuery])
            ->groupBy(['orders_item.sub_product_id'])->asArray()->all();

        $status_orders=Orders::find()->select(['count(*) as count_order','orders.status_id','status.name_ar'])
            ->innerJoin('status', 'status.id=orders.status_id')
            ->andWhere('date(orders.created_at) >= :date', [':date' => $date])
            ->groupBy(['orders.status_id'])->asArray()->all();

        $products_order=OrdersItem::find()->select([ 'count(*) as count_order','orders_item.order_id','products.name'])
            ->innerJoin('products', 'products.id=orders_item.product_id')
            ->innerJoin('orders', 'orders.id=orders_item.order_id')
            ->andWhere(['in','orders.status_id', [1,2,3,4]])
            ->andWhere('date(orders_item.created_at) >= :date', [':date' => $date])
            ->groupBy(['orders_item.product_id'])->asArray()->all();


        $status_statisticis=HistoryStatus::find()->select(["count(*) as count_order",'history_status.status_id','status.name_ar'])
            ->innerJoinWith('status','history_status.status_id = status.id')
            ->andWhere('date(history_status.created_at) >= :date', [':date' => $date])
            ->andWhere(['not in', 'history_status.order_id', Orders::find()->select('id')->andWhere('date(orders.created_at) >= :date', [':date' => $date])])
            ->groupBy(['history_status.status_id'])->asArray()->all();

          return $this->render('index',[
            'orders'=>$orders, 'details'=>$details,'status_orders'=>$status_orders,'status_statisticis'=>$status_statisticis,'products_order'=>$products_order
        ]);
    }


    public function actionSales(){
        $date=Carbon::now("Asia/Amman");
        $year=$date->format('Y');
        $month=$date->format('m');

        $profits_day_model = Orders::find()->select([
             'count(*) as count_order',
            "orders.created_at",
            'MONTH(`orders`.`created_at`) as month',
            "(SELECT SUM(orders_item.quantity) FROM `orders_item`
                    inner join orders as ord on  ord.id = orders_item.order_id
                    WHERE 
                    date(orders_item.created_at) = date(`orders`.`created_at`) 
                    and
                    orders.status_id not in (6,7,8,9,10,11,13)  ) 
                    as
                    quantity",

                    "(SELECT SUM(orders_item.profits_margin) FROM `orders_item`
                    inner join orders as ord on  ord.id = orders_item.order_id
                    WHERE 
                    date(orders_item.created_at) = date(`orders`.`created_at`) 
                    and
                    orders.status_id not in (6,7,8,9,10,11,13)  ) 
                    as
                    profit_margin",
         

             'DAY(orders.created_at) as day',
             "(SELECT sum(value) FROM `outlays` 
                    where 
                    date(outlays.created_at) = date(`orders`.`created_at`) and 
                    MONTH(outlays.created_at) = MONTH(`orders`.`created_at`) and
                    DAY(outlays.created_at) = DAY(`orders`.`created_at`))  as 
                    outlays",
             
             ])
             
             ->andWhere('YEAR(orders.created_at)=:year', [':year' => $year])
            ->andWhere('MONTH(orders.created_at)=:month', [':month' => $month])
            ->groupBy(['DAY(`orders`.`created_at`)'])
            ->orderBy(['orders.created_at'=>SORT_ASC])
            ->asArray()->all();    
            
            



        $profits_month_model = Orders::find()->select([
            'count(*) as count_order',
            'orders.created_at',
            'MONTH(orders.created_at) as month',


            "(SELECT SUM(orders_item.profits_margin) FROM `orders_item`
                    inner join orders as ord on  ord.id = orders_item.order_id
                    WHERE 
                    YEAR(orders_item.created_at) = YEAR(`orders`.`created_at`) and
                    MONTH(orders_item.created_at) = MONTH(`orders`.`created_at`)
                    and
                    orders.status_id not in (6,7,8,9,10,11,13)  ) 
                    as
                    profit_margin",


                    "(SELECT SUM(orders_item.quantity) FROM `orders_item`
                    inner join orders as ord on  ord.id = orders_item.order_id
                    WHERE 
                    YEAR(orders_item.created_at) = YEAR(`orders`.`created_at`) and
                    MONTH(orders_item.created_at) = MONTH(`orders`.`created_at`)
                    and
                    orders.status_id not in (6,7,8,9,10,11,13)  ) 
                    as
                    quantity",

                    "(SELECT sum(value) FROM `outlays` 
                    where 
                    YEAR(outlays.created_at) = YEAR(`orders`.`created_at`) and 
                    MONTH(outlays.created_at) = MONTH(`orders`.`created_at`))  as 
                    outlays",
        ])

        ->andWhere('YEAR(orders.created_at)=:year', [':year' => $year])
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
        $date=Carbon::now("Asia/Amman")->toDateString();
        $date_day = date('Y-m-d', strtotime($date. ' -15 day'));
        $date_month = date('Y-m-d', strtotime($date. ' -7 month'));

        $day_data = Orders::find()->select([
            'count(*) as count_order',
            'date(`created_at`) as date',
            '(SELECT SUM(orders_item.quantity)   FROM `orders_item` inner join orders as ord on ord.id = orders_item.order_id where 
               ord.status_id not in (6,7,8,9,10,11,13)  and date(orders_item.created_at) = date(orders.created_at)) as quantities',
            '(SELECT SUM(orders_item.profits_margin)   FROM `orders_item` inner join orders as ord on ord.id = orders_item.order_id where 
               ord.status_id not in (6,7,8,9,10,11,13)  and date(orders_item.created_at) = date(orders.created_at)) as profits_margin',
            ])
            ->andWhere('date(created_at) >= :date', [':date' => $date_day])
            ->groupBy(['DAY(`created_at`)'])
            ->orderBy(['created_at' => SORT_ASC])
         ->asArray()->all();

        $month_data = Orders::find()->select([
            'count(*) as count_order',
            '(SELECT SUM(orders_item.profits_margin)   FROM `orders_item` inner join orders as ord on ord.id = orders_item.order_id where 
               ord.status_id not in (6,7,8,9,10,11,13)  and MONTH(orders_item.created_at) = MONTH(orders.created_at) and  year(orders_item.created_at) = year(orders.created_at)) as profits_margin',
            '(SELECT SUM(orders_item.quantity)   FROM `orders_item` inner join orders as ord on ord.id = orders_item.order_id where 
               ord.status_id not in (6,7,8,9,10,11,13)  and MONTH(orders_item.created_at) = MONTH(orders.created_at) and  year(orders_item.created_at) = year(orders.created_at)) as quantities',
            'MONTH(`created_at`) as month'])
            ->andWhere('date(created_at) >= :date', [':date' => $date_month])
            ->groupBy(['MONTH(`created_at`)'])
            ->orderBy(['month' => SORT_ASC])
            ->asArray()->all();

        return $this->render('orders',[
            'day_data'=>$day_data,
            'month_data'=>$month_data,

        ]);
    }

    public function actionOutlay(){


        $date=Carbon::now("Asia/Amman")->toDateString();
        $date_day = date('Y-m-d', strtotime($date. ' -15 day'));
        $date_month = date('Y-m-d', strtotime($date. ' -7 month'));

        // SELECT count(*) ,count(`profit_margin`) FROM `orders` GROUP BY YEAR(`created_at`), MONTH(`created_at`),DAY(`created_at`)
        $outlays_day_model = Outlays::find()->select([ 'sum(value)  as outlays','date(`created_at`) as created_at'])
            ->andWhere('Date(created_at) >= :date', [':date' => $date_day])
            ->groupBy(['date(`created_at`)'])
            ->asArray()->all();

        $outlays_month_model = Outlays::find()->select([ 'sum(value)  as outlays','MONTH(`created_at`) as month'])
            ->andWhere('Date(created_at) >= :date', [':date' => $date_day])
            ->groupBy([' MONTH(`created_at`)'])
            ->asArray()->all();


        return $this->render('outlay',[
            'outlays_day_model'=>$outlays_day_model,
            'outlays_month_model'=>$outlays_month_model,
        ]);
    }

    public function actionBestSeller(){
        $date=Carbon::now("Asia/Amman")->toDateString();
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