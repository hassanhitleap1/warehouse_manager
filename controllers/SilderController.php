<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\silder\Silder;
use app\models\silder\SilderSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SilderController implements the CRUD actions for Silder model.
 */
class SilderController extends Controller
{


    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            $this->layout = "new";
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
     * Lists all Silder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SilderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Silder model.
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
     * Creates a new Silder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Silder();
        $newId = Silder::find()->max('id') + 1;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $file = UploadedFile::getInstance($model, 'file');
            if (!is_null($file)) {
                FileHelper::createDirectory('uploads/sider');

                $path="uploads/sider/$newId" . "." . $file->extension;
                $file->saveAs($path);
                $model->image=$path;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Silder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $file = UploadedFile::getInstance($model, 'file');
            if (!is_null($file)) {
                FileHelper::removeDirectory($model->image);
                $path="uploads/sider/$model->id" . "." . $file->extension;
                $file->saveAs($path);
                $model->image=$path;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Silder model.
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
     * Finds the Silder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Silder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Silder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
