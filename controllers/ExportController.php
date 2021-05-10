<?php

namespace app\controllers;


use app\models\orders\OrdersSearch;
use Yii;
use yii\filters\VerbFilter;
use kartik\export\ExportMenu;


/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class ExportController extends BaseController
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

    public function actionExport(){
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('export', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
}
