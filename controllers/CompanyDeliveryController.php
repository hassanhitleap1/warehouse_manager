<?php

namespace app\controllers;

use app\models\Model;
use app\models\pricecompanydelivery\PriceCompanyDelivery;
use Yii;
use app\models\companydelivery\CompanyDelivery;
use app\models\companydelivery\CompanyDeliverySearch;
use app\models\regions\Regions;
use Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyDeliveryController implements the CRUD actions for CompanyDelivery model.
 */
class CompanyDeliveryController extends Controller
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
     * Lists all CompanyDelivery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyDeliverySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyDelivery model.
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
     * Creates a new CompanyDelivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyDelivery();
        $prices_delivery = [new PriceCompanyDelivery()];

        
        if ($model->load(Yii::$app->request->post()) ) {
            $prices_delivery= Model::createMultiple(PriceCompanyDelivery::classname());
            Model::loadMultiple($prices_delivery, Yii::$app->request->post());
            // validate all models
            $valid = $model->validate();
            $valid =    Model::validateMultiple($prices_delivery) && $valid;
            $valid =boolval($valid);
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($prices_delivery as $price_delivery) {
                            $price_delivery->company_delivery_id = $model->id;
                            if (! ($flag = $price_delivery->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {


                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }catch (Exception $e) {
                    $transaction->rollBack();
                }

            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'prices_delivery' => (empty($prices_delivery)) ? [new PriceCompanyDelivery] : $prices_delivery,
        ]);
    }

    /**
     * Updates an existing CompanyDelivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $prices_delivery=$model->priceCompanyDelivery;
        
        if ($model->load(Yii::$app->request->post()) ) {
            $oldIDs = ArrayHelper::map($prices_delivery, 'id', 'id');
            $prices_delivery = Model::createMultiple(PriceCompanyDelivery::classname(), $prices_delivery);
            Model::loadMultiple($prices_delivery, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($prices_delivery, 'id', 'id')));
            $valid = $model->validate();
            $valid = Model::validateMultiple($prices_delivery)  && $valid;
            $valid = boolval($valid);

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {

                    if ($flag = $model->save(false)) {
                        foreach ($prices_delivery as $price_delivery) {
                            $price_delivery->company_delivery_id = $model->id;
                            if (!($flag = $price_delivery->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                    }
                }



                    if ($flag) {

                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }


                }catch (Exception $e) {
                    $transaction->rollBack();
                }

        }

    }
        return $this->render('update', [
            'model' => $model,
            'prices_delivery' => (empty($prices_delivery)) ? [new PriceCompanyDelivery()] : $prices_delivery
        ]);
    }

    /**
     * Deletes an existing CompanyDelivery model.
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
     * Finds the CompanyDelivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyDelivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyDelivery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
