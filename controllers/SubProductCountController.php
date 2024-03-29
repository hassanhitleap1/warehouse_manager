<?php

namespace app\controllers;

use Yii;
use app\models\subproductcount\SubProductCount;
use app\models\subproductcount\SubProductCountSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\products\Products;

/**
 * SubProductCountController implements the CRUD actions for SubProductCount model.
 */
class SubProductCountController extends BaseController 
{
    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = "new";
        }
        parent::init();
    }
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
     * Lists all SubProductCount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubProductCountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubProductCount model.
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
     * Displays a single SubProductCount model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGetProductItems($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
         $product= Products::findOne($id);
        return ['data'=> $product->subProductCount,'product'=>$product];
      
    }

    public function actionGetSubProduct($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data=[];
        $model=SubProductCount::findOne($id);
        $data['sub_product']= $model;
        $data['product']= $model->product;
        $data['type_options'] =$model->product->typeOptions;

        return ['data'=> $data]; 
    }


    /**
     * Creates a new SubProductCount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubProductCount();
      
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelProduct =Products::findOne($model->product_id);
            $modelProduct->quantity=$modelProduct->quantity+$model->count;
            $modelProduct->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SubProductCount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $count_befor=$model->count;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelProduct =Products::findOne($model->product_id);
            $modelProduct->quantity=$modelProduct->quantity- $count_befor +$model->count ;
            $modelProduct->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SubProductCount model.
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
     * Finds the SubProductCount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubProductCount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubProductCount::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
