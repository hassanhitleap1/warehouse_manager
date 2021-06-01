<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\orders\Orders;
use app\models\products\Products;
use yii\data\Pagination;



class SiteController extends Controller
{
//    public function __construct($id, $module, $config = [])
//    {
//        parent::__construct($id, $module, $config);
//        $this->layout='app';
//    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout='empty';
        return $this->render('test');
        $query =    Products::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
            ])
            ->all();
          return $this->render('index',[
            'models' => $models,
            'pages' => $pages,
        ]);
     
    }

    
        /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDashboard()
    {

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
          return $this->render('dashboard',[
            'label_month'=>$label_month,
            'label_day'=>$label_day,
            'orders_count_month'=>$orders_count_month,
            'orders_count_day'=>$orders_count_day, 
            'profits_month'=>$profits_month,
            'profits_day'=> $profits_day, 
        ]);
     
    }
    
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function getStatistics(){
       $statistics_day=Orders ::find()->select("count('profit_margin')");
        $statistics_week=Orders ::find()->select("count('profit_margin')");
        $statistics_month=Orders ::find()->select("count('profit_margin')");
         $date=date('Y-m-d');
        $month=date('Y-m-d');  
         $week=date('Y-m-d');  
        if(isset($_GET['date']) && $_GET['date'] !=''){
            $date= $_GET['date'];
        }
           
           if(isset($_GET['week']) && $_GET['week'] !=''){
            $week= $_GET['week'];
        }
         if(isset($_GET['month']) && $_GET['month'] !=''){
            $month= $_GET['month'];
        }
         $statistics_day= $statistics_day->andFilterWhere(['=', 'created_at', $date])->all();
        
          $statistics_week= $statistics_week->andFilterWhere(['=', 'created_at', $date])->all();
        
          $statistics_month= $statistics_month->andFilterWhere(['=', 'created_at', $date])->all();
        
        
    }
}
