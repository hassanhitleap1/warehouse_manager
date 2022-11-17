<?php

namespace app\controllers;

use app\components\NotifcationHelper;
use app\components\OrderHelper;
use app\models\banner\Banner;
use app\models\categorises\Categorises;
use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\orders\CartForm;
use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\regions\Regions;
use app\models\users\Users;
use Carbon\Carbon;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\orders\OrderForm;
use app\models\products\Products;
use app\models\silder\Silder;
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

        // $this->layout='empty';
        // return $this->render('test');
        $sliders  = Silder::find()->all();
        $bansers = Banner::find()->all();
        $query =    Products::find();

        $models = $query
            ->limit(30)
            ->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
            ])
            ->all();

        return $this->render('index', [
            'models' => $models,
            'sliders' => $sliders,
            'bansers' => $bansers
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


    public  function actionCart()
    {

        $cart = \Yii::$app->cart;
        $model = new CartForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $region = Regions::findOne($model->region_id);
            $order = new Orders();
            $today = Carbon::now("Asia/Amman");
            $next_order = Orders::find()->max('id') + 1;
            $order->order_id = (string) $next_order;
            $order->delivery_time = $today->addDay(1);
            $order->country_id = 1;
            $order->delivery_price = $region->price_delivery;
            $order->region_id = $model->region_id;
            $order->phone = $model->phone;
            $order->name = $model->name;
            $order->other_phone = $model->other_phone;
            $order->address = is_null($model->address) ? $region->name_ar : $model->address;
            $order->status_id = 1;
            $order->discount = 0;


            $profit__cost = OrderHelper::cart_profit($cart);
            $profit_margin = $profit__cost["profit"];
            $cost = $profit__cost["cost"];

            $order->total_price = $region->price_delivery + $cart->getTotalCost();
            $order->amount_required = $cart->getTotalCost();
            $transaction = \Yii::$app->db->beginTransaction();



            if ($order->save()) {
                $userModel = Users::find()->where(['phone' => $model->phone])->one();
                if (is_null($userModel)) {
                    $userModel = new Users();
                }
                $user = OrderHelper::set_value_user($userModel, $model);
                $user->save();
                $orderItem = [];
                foreach ($cart->getItems() as  $c) {
                    $product = Products::findOne($c->getProduct()->id);
                    $orderItem[] = [
                        'order_id' => $order->id,
                        'product_id' => $c->getProduct()->id,
                        'sub_product_id' => $product->typeOptions[0]->id,
                        'price' => $product->selling_price,
                        'price_item_count' => $product->typeOptions[0]->price,
                        'profits_margin' => $profit_margin,
                        'profit_margin' => ($profit_margin / $product->typeOptions[0]->number),
                        'quantity' => $cart->getItem($c->getProduct()->id)->getQuantity(),
                    ];
                }

                $order->user_id = $user->id;
                $order->save(false);

                $is_inserted = Yii::$app->db->createCommand()->batchInsert(
                    OrdersItem::tableName(),
                    ['order_id', 'product_id', 'sub_product_id', 'price', 'price_item_count', 'profits_margin', 'profit_margin', 'quantity'],
                    $orderItem
                )->execute();

                if ($is_inserted) {
                    $transaction->commit();

                    Yii::$app->session->set('order_model', $order);
                    NotifcationHelper::push_order_notifcation($order);
                    return $this->redirect(['product/thanks']);
                } else {
                    Yii::$app->session->set('message', Yii::t('app', 'Error'));
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('cart', ['cart' => $cart, 'model' => $model]);
    }




    public function actionShop()
    {

        $catigories = Categorises::find()->all();
        $query =    Products::find();
        if (isset($_GET['categories'])) {
            $query->andWhere(['in', 'category_id', $_GET['categories']]);
        }

        if (isset($_GET['q'])) {
            $query->andWhere(['like', 'name', $_GET['q'] . '%', false]);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending
            ])
            ->all();

        return $this->render('shop', [
            'models' => $models,
            'pages' => $pages,
            'catigories' => $catigories

        ]);
    }
}
