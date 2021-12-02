<?php

namespace app\controllers;

use app\models\Model;
use Yii;
use app\models\medialibrary\Medialibrary;
use app\models\medialibrary\MedialibrarySearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MedialibraryController implements the CRUD actions for Medialibrary model.
 */
class MedialibraryController extends Controller
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
     * Lists all Medialibrary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedialibrarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medialibrary model.
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
     * Creates a new Medialibrary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medialibrary();
        if ($model->load(Yii::$app->request->post()) ) {
            $models= Model::createMultiple(Medialibrary::classname());
            Model::loadMultiple($models, Yii::$app->request->post());
            $valid =Model::validateMultiple($models) ;
            $valid =boolval($valid);
            $images_media = UploadedFile::getInstances($model, 'media');
            if(true){
                $i=1;
                $path="uploads/".date('Y/m/d')."/$i";
                while (file_exists($path)){
                    ++$i;
                    $path="uploads/".date('Y/m/d')."/$i";
                }

                FileHelper::createDirectory($path,
                    $mode = 0775, $recursive = true);
                if (!is_null($images_media)) {
                    foreach ($images_media as $key => $media) {
                        $modelMedia = new  Medialibrary();
                        $file_path = "$path/$key" . "." . $media->extension;
                        $modelMedia->path = $file_path;
                        $modelMedia->name="$path";
                        $modelMedia->extension=$media->extension;
                        $media->saveAs($file_path);
                        $modelMedia->save(false);

                    }
                }

            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Deletes an existing Medialibrary model.
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
     * Finds the Medialibrary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Medialibrary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medialibrary::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
