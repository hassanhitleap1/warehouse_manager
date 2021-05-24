<?php

namespace app\controllers;
use app\models\Model;
use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\orders\OrderForm;
use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\regions\Regions;
use app\models\users\Users;
use Carbon\Carbon;
use Yii;
use app\models\products\Products;
use app\models\products\ProductsSearch;
use app\models\productsimage\ProductsImage;
use app\models\subproductcount\SubProductCount;
use Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends BaseController 
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $subProductCounts = [new SubProductCount()];
        $type_options = [new OptionsSellProduct()];
        $newId = Products::find()->max('id') + 1;

        if ($model->load(Yii::$app->request->post())) {
           
            $subProductCounts = Model::createMultiple(SubProductCount::classname());
            $type_options= Model::createMultiple(OptionsSellProduct::classname());
            Model::loadMultiple($subProductCounts, Yii::$app->request->post());
            Model::loadMultiple($type_options, Yii::$app->request->post());
        
             // validate all models
             $valid = $model->validate();
             $valid =    Model::validateMultiple($subProductCounts) && $valid;
            $valid =Model::validateMultiple($type_options) && $valid;
            $valid =boolval($valid);

            // foreach ($type_options as $key => $type_option) {
            //     var_dump($type_option->getErrors());
            // }

            // var_dump($_POST);
            // foreach ($subProductCounts as $key => $subProductCount) {
            //     var_dump($subProductCount->getErrors());
            // }
            // var_dump($model->getErrors());
            // exit;
           // var_dump($type_options[0]->getErrors());
            // var_dump($model->getErrors());
            // var_dump($type_options);
            // var_dump($subProductCounts[0]->getErrors());
            // var_dump($type_options[0]->getErrors());

       
             if ($valid) {

                
                $transaction = \Yii::$app->db->beginTransaction();
                
                try {
                  

                    $file = UploadedFile::getInstance($model, 'file');
                    $images_product = UploadedFile::getInstances($model, 'images_product');
                    if (!is_null($file)) {
                        $folder_path = "products/$newId";
                        FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                        $thumbnail_path = "$folder_path/index" . "." . $file->extension;
                        $model->thumbnail= $thumbnail_path;
                        $file->saveAs($thumbnail_path);
                        $model->thumbnail = $thumbnail_path;
                    }


                    if (!is_null($images_product)) {

                        $folder_path = "products/$newId";
                        
                        FileHelper::createDirectory("$folder_path/images",
                             $mode = 0775, $recursive = true);
                        foreach ($images_product as $key => $image_product) {
                            $modelImagesProduct = new  ProductsImage();
                            $file_path = "$folder_path/images/$key" . "." . $image_product->extension;
                            $modelImagesProduct->product_id = $newId;
                            $modelImagesProduct->path = $file_path;
                            $image_product->saveAs($file_path);
                            $modelImagesProduct->save(false);
                
                        }
                    }

                  
                    if ($flag = $model->save(false)) {
                    
                        if(count($subProductCounts) > 1){
                            foreach ($subProductCounts as $subProductCount) {
                                $subProductCount->product_id = $model->id;
                                if (! ($flag = $subProductCount->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        
                        }else{
                           
                            $subProductCount = new SubProductCount();
                             $subProductCount->product_id = $model->id;
                             $subProductCount->type=$model->name;
                             $subProductCount->count=$model->quantity;
                            $subProductCount->save();
                        }

                        foreach ($type_options as $type_option) {
                            $type_option->product_id = $model->id;
                            if (! ($flag = $type_option->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    
                    }
                    

                    if ($flag) {
                        // var_dump($model->getErrors());
                        // var_dump($subProductCount->getErrors());
                        // var_dump($type_options[0]->getErrors());
                        // exit;
                    
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();

                    // var_dump($model->getErrors());
                    // var_dump($subProductCount->getErrors());
                    // var_dump($type_options[0]->getErrors());
                    // exit;
                }
            }
            // var_dump($model->getErrors());
            // var_dump($model);
            // var_dump($type_options);
            // // var_dump($subProductCount->getErrors());
            // var_dump($type_options[0]->getErrors());
            // exit;
        }


        
        return $this->render('create', [
            'model' => $model,
            'subProductCounts' => (empty($subProductCounts)) ? [new SubProductCount] : $subProductCounts,
            'type_options' => (empty($type_options)) ? [new OptionsSellProduct] : $type_options,
        ]);

   
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $newId=$id;
        
        $modelSubProductCount = $model->subProductCount;
        $type_options = $model->typeOptions;

        if ($model->load(Yii::$app->request->post())) {
            
            $oldIDs = ArrayHelper::map($modelSubProductCount, 'id', 'id');
            $type_options_old_ids = ArrayHelper::map($type_options, 'id', 'id');

            $modelSubProductCount = Model::createMultiple(SubProductCount::classname(), $modelSubProductCount);
            Model::loadMultiple($modelSubProductCount, Yii::$app->request->post());

            $type_options = Model::createMultiple(OptionsSellProduct::classname(), $type_options);
            Model::loadMultiple($type_options, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelSubProductCount, 'id', 'id')));
            $deleted_ids_type_options = array_diff($oldIDs, array_filter(ArrayHelper::map($type_options, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($type_options) &&  Model::validateMultiple($modelSubProductCount) && $valid;

            $valid = boolval($valid);
            
            if ($valid) {
               $transaction = \Yii::$app->db->beginTransaction();
               try {
                    $file = UploadedFile::getInstance($model, 'file');
                    $images_product = UploadedFile::getInstances($model, 'images_product');
                    if (!is_null($file)) {
                        $folder_path = "products/$newId";
                        FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                        $thumbnail_path = "$folder_path/index" . "." . $file->extension;
                        $model->thumbnail = $thumbnail_path;
                        $file->saveAs($thumbnail_path);
                        $model->thumbnail = $thumbnail_path;
                    }

                    if (!is_null($images_product)) {


                        $folder_path = "products/$newId";

                        FileHelper::createDirectory(
                            "$folder_path/images",
                            $mode = 0775,
                            $recursive = true
                        );
                        if (count($images_product)) {
                            foreach ($images_product as $key => $image_product) {
                                $modelImagesProduct = new  ProductsImage();
                                $file_path = "$folder_path/images/$key" . "." . $image_product->extension;
                                $modelImagesProduct->product_id = $newId;
                                $modelImagesProduct->path = $file_path;
                                $image_product->saveAs($file_path);
                                $modelImagesProduct->save(false);
                            }
                        }
                    }

                

           
                    if ($flag = $model->save(false)) {
                        foreach ($modelSubProductCount as $subProductCount) {
                            $subProductCount->product_id = $model->id;
                            if (!($flag = $subProductCount->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($type_options as $type_option) {
                            $type_option->product_id = $model->id;
                            if (!($flag = $type_option->save(false))) {
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

   

        return $this->render('update', [
            'model' => $model,
            'subProductCounts' => (empty($modelSubProductCount)) ? [new SubProductCount] : $modelSubProductCount,
            'type_options' => (empty($type_options)) ? [new OptionsSellProduct] : $type_options
        ]);
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }



    public function actionFasterOrder($id){
        $modelOrder= new OrderForm();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($modelOrder->load(Yii::$app->request->post()) && $modelOrder->validate()) {

                $product=Products::findOne($id);
                $next_order=Orders::find()->max('id') + 1;
                $region=Regions::findOne($modelOrder->region_id);
                $typeoption=OptionsSellProduct::findOne($modelOrder->typeoption);
                $today=Carbon::now("Asia/Amman");
                $delivery_price=$region->price_delivery;
                $discount=($typeoption->number *$product->selling_price) - $typeoption->price;
                $profit_margin= $typeoption->price  -  ($product->purchasing_price * $typeoption->number) ;
                $order_model=new Orders;
                $order_model->order_id = (string) $next_order;
                $order_model->delivery_time=$today->addDay(1);
                $order_model->country_id=1;
                $order_model->region_id=$modelOrder->region_id;
                $order_model->phone=$modelOrder->phone;
                $order_model->name=$modelOrder->name;
                $order_model->other_phone=$modelOrder->other_phone;
                $order_model->address=is_null($modelOrder->address)?$region->name_ar:$modelOrder->address;
                $order_model->status_id=1;
                $order_model->delivery_price =$delivery_price;
                $order_model->discount= $discount;
                $order_model->total_price=$delivery_price+$typeoption->price;
                $order_model->profit_margin=  $profit_margin ;
                $order_model->amount_required=$order_model->total_price-$delivery_price;
                $transaction = \Yii::$app->db->beginTransaction();
                if ($order_model->save()) {
                    $userModel = Users::find()->where(['phone'=> $modelOrder->phone])->one();
                    if(is_null($userModel)){
                        $userModel= new Users();
                    }
                    $user=$this->set_value_user($userModel,$order_model);
                    $user->save();
                    $orderItemModel=new OrdersItem;
                    $orderItemModel->order_id = $order_model->id;
                    $orderItemModel->product_id=$id;
                    $orderItemModel->sub_product_id=$modelOrder->type;
                    $orderItemModel->price=$product->selling_price;
                    $orderItemModel->price_item_count=$typeoption->price ;
                    $orderItemModel->profits_margin=$profit_margin * $typeoption->number;
                    $orderItemModel->profit_margin=$profit_margin;
                    $orderItemModel->quantity=$typeoption->number ;
                    $order_model->user_id=$user->id;
                    $order_model->save(false);

                    if($orderItemModel->save()){
                        $transaction->commit();
                        return [
                            'data' => [
                                'success' => true,
                                'model' => $order_model,
                                'message' => 'Model has been saved.',
                            ],
                            'code' => 0,
                        ];
                    }else{
                        return [
                            'data' => [
                                'success' => false,
                                'model' => null,
                                'message' => 'An error occured.',
                            ],
                            'code' => 1, // Some semantic codes that you know them for yourself
                        ];
                    }
                }

                return [
                    'data' => [
                        'success' => true,
                        'model' => $order_model,
                        'message' => 'Model has been saved.',
                    ],
                    'code' => 0,
                ];
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'model' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
        }

        if ($modelOrder->load(Yii::$app->request->post())&&  $modelOrder->validate()) {
            $product=Products::findOne($id);
            $next_order=Orders::find()->max('id') + 1;
            $region=Regions::findOne($modelOrder->region_id);
            $typeoption=OptionsSellProduct::findOne($modelOrder->typeoption);
            $today=Carbon::now("Asia/Amman");
            $delivery_price=$region->price_delivery;
            $discount=($typeoption->number *$product->selling_price) - $typeoption->price;
            $profit_margin= $typeoption->price  -  ($product->purchasing_price * $typeoption->number) ;
            $order_model=new Orders;
            $order_model->order_id = (string) $next_order;
            $order_model->delivery_time=$today->addDay(1);
            $order_model->country_id=1;
            $order_model->region_id=$modelOrder->region_id;
            $order_model->phone=$modelOrder->phone;
            $order_model->name=$modelOrder->name;
            $order_model->other_phone=$modelOrder->other_phone;
            $order_model->address=is_null($modelOrder->address)?$region->name_ar:$modelOrder->address;
            $order_model->status_id=1;
            $order_model->delivery_price =$delivery_price;
            $order_model->discount= $discount;
            $order_model->total_price=$delivery_price+$typeoption->price;
            $order_model->profit_margin=  $profit_margin ;
            $order_model->amount_required=$order_model->total_price-$delivery_price;
            $transaction = \Yii::$app->db->beginTransaction();
            if ($order_model->save()) {
                $userModel = Users::find()->where(['phone'=> $modelOrder->phone])->one();
                if(is_null($userModel)){
                    $userModel= new Users();
                }
                $user=$this->set_value_user($userModel,$order_model);
                $user->save();
                $orderItemModel=new OrdersItem;
                $orderItemModel->order_id = $order_model->id;
                $orderItemModel->product_id=$id;
                $orderItemModel->sub_product_id=$modelOrder->type;
                $orderItemModel->price=$product->selling_price;
                $orderItemModel->price_item_count=$typeoption->price ;
                $orderItemModel->profits_margin=$profit_margin * $typeoption->number;
                $orderItemModel->profit_margin=$profit_margin;
                $orderItemModel->quantity=$typeoption->number ;
                $order_model->user_id=$user->id;
                $order_model->save(false);
                if($orderItemModel->save()){
                    $transaction->commit();
                    return $this->render(['index']);
                }else{
                    return $this->renderAjax('faster_order',[
                        'modelOrder'=>$modelOrder
                    ]);
                    $transaction->rollBack();
                }

            }
        }
        return $this->renderAjax('faster_order',[
            'model' => $this->findModel($id),
           'modelOrder'=>$modelOrder
        ]);
    }


    private function set_value_user($user ,$model){
        $user->phone = $model->phone;
        $user->other_phone = $model->other_phone;
        $user->name = $model->name;;
        $user->country_id = ($model->country_id !='') ? $model->country_id :null  ;
        $user->region_id = ($model->region_id !='') ? $model->region_id :null  ;
        $user->area_id = ($model->area_id !='') ? $model->area_id :null  ;
        $user->address =($model->address !='') ? $model->address :null  ;
        $user->username=null;
        $user->email =null;
        $user->auth_key =null;
        $user->name_in_facebook = ($model->name_in_facebook !='') ? $model->name_in_facebook :null  ; $model->name_in_facebook;
        $user->password_hash =null;
        $user->password_reset_token =null;
        // $user->created_at=null;
        // $user->updated_at=null;

        return $user;
    }
}
