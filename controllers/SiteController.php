<?php

namespace app\controllers;

use app\models\banner\Banner;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\products\Products;
use app\models\silder\Silder;
use yii\data\Pagination;

class SiteController extends Controller
{

   public function __construct($id, $module, $config = [])
   {
       parent::__construct($id, $module, $config);
       $this->layout='app';
   }

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

        // $this->layout='empty';
        // return $this->render('test');
        $sliders  = Silder::find()->all();
        $bansers= Banner::find()->all();
        $query =    Products::find();
        if(isset($_GET['category'])){
            $query->where(['category_id'=>$_GET['category']]) ;
        }
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
            'sliders'=>$sliders,
            'bansers'=>$bansers 
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

    public function actionConnectUs()
    {
        return $this->render('connect-us');
    }
    


    public function actionPrivacy()
    {
        return $this->render('privacy');
    }


    public function actionTermsAndConditions()
    {
        return $this->render('terms-and-conditions');
    }


    public  function actionCart(){

        $cart = \Yii::$app->cart;

        return $this->render('cart',['cart'=>$cart]);
    }


    public function actionShop(){
        $query =    Products::find();
        if(isset($_GET['category'])){
            $query->where(['category_id'=>$_GET['category']]) ;
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending
            ])
            ->all();
        return $this->render('shop',[
            'models' => $models,
            'pages' => $pages,

        ]);


    }

}
