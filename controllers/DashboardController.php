<?php

namespace app\controllers;

use app\models\orders\Orders;
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
            '(select count(quantity) from orders_item where orders_item.orders_item = orders.id ) as quantity'])
            ->andWhere('date(created_at) >= :date', [':date' => $date])
            ->groupBy(['DAY(`created_at`)'])
            ->asArray()->all();

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
        return $this->render('sales',[
            'label_month'=>$label_month,
            'label_day'=>$label_day,
            'orders_count_month'=>$orders_count_month,
            'orders_count_day'=>$orders_count_day,
            'profits_month'=>$profits_month,
            'profits_day'=> $profits_day,
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
        return $this->render('outlay',[
            'label_month'=>$label_month,
            'label_day'=>$label_day,
            'orders_count_month'=>$orders_count_month,
            'orders_count_day'=>$orders_count_day,
            'profits_month'=>$profits_month,
            'profits_day'=> $profits_day,
        ]);
    }

    public function actionBestSeller(){

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
        return $this->render('best-seller',[
            'label_month'=>$label_month,
            'label_day'=>$label_day,
            'orders_count_month'=>$orders_count_month,
            'orders_count_day'=>$orders_count_day,
            'profits_month'=>$profits_month,
            'profits_day'=> $profits_day,
        ]);
    }
    
}