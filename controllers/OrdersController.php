<?php

namespace app\controllers;

use app\components\OrderHelper;
use app\models\Model;
use Yii;
use app\models\orders\Orders;
use app\models\orders\OrdersSearch;
use app\models\ordersitem\OrdersItem;
use app\models\products\Products;
use app\models\subproductcount\SubProductCount;
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
            $valid = $model->validate();
            $valid = Model::validateMultiple($ordersItem) && $valid;
            if(is_null($user = Users::find()->where(['phone'=> $model->phone])->one())){
                $user= new Users();
            }
            $user=$this->set_value_user($user,$model);

            if ($valid && $user->save()) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model->user_id=$user->id;
                $model->delivery_time= date("H:i", strtotime($model->delivery_time));
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($ordersItem as $orderItem) {
                            $orderItem->order_id = $model->id;
                            if (! ($flag = $orderItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }else{
                                if($model->status_id < 2 ){
                                    $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
                                    OrderHelper::stock_minus($orderItemModel);
                                }
                                
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
        $status_id=$model->status_id;
        $ordersItem = $model->orderItems;
        
        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($ordersItem, 'id', 'id');
            $ordersItem = Model::createMultiple(OrdersItem::classname(), $ordersItem);
            Model::loadMultiple($ordersItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($ordersItem, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($ordersItem) && $valid;
            $user= Users::findOne($model->user_id);
            $user=$this->set_value_user($user,$model);
            if ($valid && $user->save()) 
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try 
                {
                    if ($flag = $model->save(false)) 
                    {
                        foreach ($ordersItem as $orderItem) 
                        {
                            $orderItem->order_id = $model->id;
                           if (! ($flag = $orderItem->save(false))) 
                           {
                                $transaction->rollBack();
                                break;
                            }
                            else
                            {
                                OrderHelper::management_stock_product($model,$status_id);
                            }
                        }
                    }

                    if ($flag) 
                    {
                       $transaction->commit();
                       return $this->redirect(['view', 'id' => $model->id]);
                   }
                } catch (Exception $e) 
                {
                    $transaction->rollBack();
                }
            }
        }

        


        return $this->render('update', [
            'model' => $model,
            'ordersItem' => (empty($ordersItem)) ? [new OrdersItem()] : $ordersItem
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




    public function actionChangeStatus($id){
        $model = $this->findModel($id);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($model->load(Yii::$app->request->post())) 
        {
            $status_id=$_POST["Orders"][$_GET['index']]["status_id"];
           if($status_id !=$model->status_id){
               OrderHelper::management_stock_product($model,$status_id);
           }

            return [ 'output' => $model->status->name_ar];
        }
          


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

    private function set_value_user($user ,$model){
        $user->phone = $model->phone;
        $user->other_phone = $model->other_phone;
        $user->name = $model->name;;
        $user->country_id = ($model->country_id !='') ? $model->country_id :null  ;
        $user->region_id = ($model->region_id !='') ? $model->region_id :null  ;
        $user->area_id = ($model->area_id !='') ? $model->area_id :null  ;
        $user->address = $model->address;
        $user->username=null;
        $user->email =null;
        $user->auth_key =null;
        $user->name_in_facebook =$model->name_in_facebook;
        $user->password_hash =null;
        $user->password_reset_token =null;
        $user->created_at=null;
        $user->updated_at=null;

        return $user;
    }
}
