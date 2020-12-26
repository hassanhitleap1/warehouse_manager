<?php

namespace app\controllers;

use app\models\Model;
use Yii;
use app\models\orders\Orders;
use app\models\orders\OrdersSearch;
use app\models\ordersitem\OrdersItem;
use app\models\users\Users;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
      /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionBill($id)
    {
        $this->layout = "empty";
        return $this->render('bill', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $ordersItem = [new OrdersItem()];

        if ($model->load(Yii::$app->request->post())) {
           
            $ordersItem = Model::createMultiple(OrdersItem::classname());
            Model::loadMultiple($ordersItem, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($ordersItem) && $valid;
         
    
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
              
                
                try {

                        
                    $user= new Users();
                    
                    $user->phone = $model->phone;
                    
                    $user->other_phone = $model->other_phone;
                 
                    $user->email =null;
                    $user->name = $model->name;;
                   
                    $user->country_id = ($model->country_id !='') ? $model->country_id :null  ;
                    $user->region_id = ($model->region_id !='') ? $model->region_id :null  ;
                    $user->area_id = ($model->area_id !='') ? $model->area_id :null  ;
                    $user->address = $model->address;
                  
                    if(! $flag = $user->save(false)){
                        print_r($user->errors);
                        exit;
                    };

                    $model->user_id=$user->id;
                 
                    if ($flag = $model->save(false)) {
                        
                        foreach ($ordersItem as $orderItem) {
                            
                            $orderItem->order_id = $model->id;
                            if (! ($flag = $orderItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                   
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }



        return $this->render('create', [
            'model' => $model,
            'ordersItem' => (empty($ordersItem)) ? [new OrdersItem()] : $ordersItem
        ]);


    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $orderItems = $model->orderItems;

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($orderItems, 'id', 'id');
            $orderItems = Model::createMultiple(OrdersItem::classname(), $orderItems);
            Model::loadMultiple($orderItems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($orderItems, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($orderItems) && $valid;




            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if ($flag = $model->save(false)) {
                        foreach ($orderItems as $orderItem) {
                            $orderItem->order_id = $model->id;
                            if (! ($flag = $orderItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $user= new Users();
                        $user->phone = $model->phone;
                        $user->other_phone = $model->other_phone;
                        $user->email =null;
                        $user->country_id = $model->country_id;
                        $user->region_id = $model->region_id;
                        $user->area_id = $model->area_id;
                        $user->address = $model->address;

                        if (! ($flag = $user->save(false))) {
                            $transaction->rollBack();
                           
                        }

                        
                       
                       $transaction->commit();
                       return $this->redirect(['view', 'id' => $model->id]);
                   }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }


        }


        return $this->render('update', [
            'model' => $model,
            'orderItems' => (empty($orderItems)) ? [new OrdersItem()] : $orderItems
        ]);

    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
