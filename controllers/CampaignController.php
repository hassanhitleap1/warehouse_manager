<?php

namespace app\controllers;

use app\models\CampaignGroupSelected\CampaignGroupSelected;
use app\models\User;
use Carbon\Carbon;
use Yii;
use app\models\campaign\Campaign;
use app\models\campaign\CampaignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CampaignController implements the CRUD actions for Campaign model.
 */
class CampaignController extends Controller
{

    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = "adminrte";
            if (Yii::$app->user->identity->type != User::SUPER_ADMIN) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
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
     * Lists all Campaign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Campaign model.
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
     * Creates a new Campaign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Campaign();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $model->save();
                $inserted=[];
                $today=Carbon::now("Asia/Amman");
                foreach ($model->campaign_group_selected  as $selected){
                    $inserted[]=[
                        'campaign_id'=>$model->id,
                        'groups_subscribe_id'=>$selected,
                        'created_at'=>$today
                    ] ;
                }

                Yii::$app->db
                    ->createCommand()
                    ->batchInsert('campaign_group_selected', ['campaign_id','groups_subscribe_id','created_at'], $inserted)
                    ->execute();
                $transaction->commit();
            }catch (\Exception $exception){

            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Campaign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            CampaignGroupSelected::find()->where(['=','campaign_id',$model->id])->delete();
            try {
                $model->save();
                $inserted=[];
                $today=Carbon::now("Asia/Amman");
                foreach ($model->campaign_group_selected  as $selected){
                    $inserted[]=[
                        'campaign_id'=>$model->id,
                        'groups_subscribe_id'=>$selected,
                        'created_at'=>$today
                    ] ;
                }

                Yii::$app->db
                    ->createCommand()
                    ->batchInsert('campaign_group_selected', ['campaign_id','groups_subscribe_id','created_at'], $inserted)
                    ->execute();
                $transaction->commit();
            }catch (\Exception $exception){

            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Campaign model.
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
     * Finds the Campaign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaign::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
