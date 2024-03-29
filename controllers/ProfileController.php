<?php

namespace app\controllers;
use app\models\auth\ChangePassword;
use app\models\auth\Info;
use app\models\User;
use app\models\users\Users;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class ProfileController extends BaseController
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
     * Lists all Area models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Info();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user=Users::findOne(Yii::$app->user->identity->id);
            $user->name=$model->name;
            $user->phone=$model->phone;
            $user->username=$model->username;
            $user->email=$model->email;
            $file = UploadedFile::getInstance($model, 'avatar');
            if (!is_null($file)) {
                $folder_path = "uploads/avatar/$user->id";
                FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                $avatar = "$folder_path/index" . "." . $file->extension;
                $user->avatar = $avatar;
                $file->saveAs($avatar);
            }

            $user->save(false);
            Yii::$app->session->set('message', Yii::t('app', 'Succ_Mess_Pass'));
            return $this->render('index', ['model' => $model]);
        }

        return $this->render('index',['model'=>$model]);
    }



}

