<?php

namespace app\controllers;

use app\components\DateHelper;
use Yii;
use app\models\Outlays\Outlays;
use app\models\Outlays\OutlaysSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OutlaysController implements the CRUD actions for Outlays model.
 */
class OutlaysController extends Controller
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
     * Lists all Outlays models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutlaysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Outlays model.
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
     * Creates a new Outlays model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Outlays();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(is_null($model->range) ||  $model->range == "" ){
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $arr_date=explode(' - ',$model->range);
                $dates=DateHelper::getDatesFromRange($arr_date[0],$arr_date[1]);
                $data_inserted=[];
                  foreach ($dates as $data){
                    $data_inserted[]=[
                    'title'=>$model->title,
                     'value'=>$model->value  ,
                     'type'=>$model->type,
                     'product_id'=>$model->type,
                     'created_at' =>$data,
                     'updated_at' =>$data,
                    ];
                }

                Yii::$app->db
                    ->createCommand()
                    ->batchInsert('outlays', ['title','value','type','product_id','created_at','updated_at'], $data_inserted)
                    ->execute();
                $session = Yii::$app->session;
                $session->set('message', Yii::t('app','Successfuly'));

            }

            return $this->redirect(['outlays/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Outlays model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Outlays model.
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
     * Finds the Outlays model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Outlays the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Outlays::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
