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

            $orders = Orders::find()->select(['count(*) as count_order',
            'sum(orders.amount_required) as total_sales' ,

            "(SELECT sum(profits_margin) FROM `orders_item` 
                    inner join orders on  orders.id = orders_item.order_id
                    where date(orders_item.created_at) ='$date' and 
                            orders.status_id in (1,2,3,4)  )  as 
             profit_margin",
             
             "(SELECT sum(quantity) FROM `orders_item` 
                     inner join orders on  orders.id = orders_item.order_id
                    where date(orders_item.created_at) ='$date' and
                    orders.status_id in (1,2,3,4) )  as 
                    quantity",
             "(SELECT sum(value) FROM `outlays` 
                    where date(outlays.created_at) ='$date')  as 
                    outlays",       
            ])
            ->andWhere('date(orders.created_at) >= :date', [':date' => $date])
            ->andWhere(['in','orders.status_id', [1,2,3,4]])
            ->groupBy(['DAY(orders.created_at)'])
            ->asArray()->one();
     
          return $this->render('index',[
            'orders'=>$orders,
        ]);
    }


    public function actionSales(){

        $year=date('Y');
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
                    MONTH(outlays.created_at) = MONTH(`orders`.`created_at`)
                    and
                    DAY(outlays.created_at) = DAY(`orders`.`created_at`))  as 
                    outlays",
             
             ])
             
             ->andWhere('YEAR(orders.created_at)=:year', [':year' => date('Y')])
            ->andWhere('MONTH(orders.created_at)=:month', [':month' => date('m')])
            ->groupBy(['DAY(`orders`.`created_at`)'])
            ->orderBy(['orders.created_at'=>SORT_ASC])
            ->asArray()->all();    
            
            



        $profits_month_model = Orders::find()->select([
            'count(*) as count_order',
            'orders.created_at',
            'MONTH(orders.created_at) as month',
            // 'sum(orders.profit_margin)  as profit_margin',

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
        $profits_day_model = Orders::find()->select([
            'count(*) as count_order', 
            'sum(profit_margin)  as profit_margin',
            'MONTH(`created_at`) as month',
            'DAY(`created_at`) as day'])
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