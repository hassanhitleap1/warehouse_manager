<?php

namespace app\controllers;

use app\components\OrderHelper;
use app\models\Model;
use app\models\status\Status;
use Yii;
use app\models\orders\Orders;
use app\models\orders\OrdersSearch;
use app\models\ordersitem\OrdersItem;
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
        $this->layout = "app";
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
            $order_id =  Orders::find()->count() + 1 ;
            $model->order_id=$order_id;
            $model->status_id=2;
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
                                if($model->status_id < 2 ){
                                    $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
                                    OrderHelper::stock_minus($orderItemModel);
                                }
                                $transaction->rollBack();
                                break;
                            }
                        }

                        if($model->status_id == 7){
                            OrderHelper::stock_plus($ordersItem);   
                        }
                                            
                    }

                   
                    if ($flag) {
                        $transaction->commit();
                      
                        $session = Yii::$app->session;
                        $session->set('message', Yii::t('app','Successfuly_Create_Order'));

                        return $this->redirect(['create']);
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
                try {
                    //OrdersItem::deleteAll(['=','order_id',$id]);
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
                        $session = Yii::$app->session;
                        $session->set('message', Yii::t('app','Successfuly_Update_Order'));
                      
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) 
                {
                    print_r($e);
                    exit;
                    $transaction->rollBack();
                }
            }
        }

        


        return $this->render('update', [
            'model' => $model,
            'ordersItem' => (empty($ordersItem)) ? [new OrdersItem()] : $ordersItem
        ]);

    }



    public function actionChangeStatusSelected(){
        $string_id=$_GET['string_id'];
        $status_id=$_GET['status_id'];
        $ides = explode(",", $string_id);
        $models=Orders::find()->where(['in','id',$ides])->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data=[];
        foreach($models as $key =>$model){
            $status_name=OrderHelper::management_stock_product($model,$status_id);
            $data[]=['id'=>$model->id,'status_id'=>$status_id,'status_name'=>$status_name];
        }
        return ['code'=>201,'data'=>$data];
    }


    public function actionDeleteOrderSelected(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $string_id=$_GET['string_id'];
        $ides = explode(",", $string_id);
        Orders::deleteAll(['in','id',$ides]);
        OrdersItem::deleteAll(['in','order_id',$ides]);
        return ['code'=>201,'data'=>$ides];
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
        OrdersItem::deleteAll(['=','order_id',$id]);
        return $this->redirect(['index']);
    }




    public function actionChangeStatus($id){
        $model = $this->findModel($id);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $status_id=$_GET['status_id'];
        OrderHelper::management_stock_product($model,$status_id);
         return ['code'=>201];  
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



    public function actionSetStatus($id)
    {
        $model=$this->findModel($id);
        $status=OrderHelper::get_status($model->status_id);
        return $this->renderAjax('set_status',['model'=> $model,'status'=>$status]);
    }


    public function actionSetStatusSelected()
    {
        $string_id=$_GET['string_id'];
        $status= $status=Status::find()->all();
        return $this->renderAjax('set_status_all',['status'=>$status,'string_id'=>$string_id]);
    }


    public function actionExportPdf(){
        $string_id=$_GET['string_id'];
        $ides = explode(",", $string_id);
        $models=Orders::find()->where(['in','id',$ides])->all();
        $this->layout = "empty";
        return $this->render('invoices', [
            'models' => $models,
        ]);

    }
}
