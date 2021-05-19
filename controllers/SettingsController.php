<?php

namespace app\controllers;

use Yii;

use yii\filters\VerbFilter;

/**
 * CategorisesController implements the CRUD actions for Categorises model.
 */
class SettingsController extends BaseController
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
     * Lists all Categorises models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = [];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);

    }

}
