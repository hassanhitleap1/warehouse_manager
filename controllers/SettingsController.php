<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\settings\Settings;

use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * CategorisesController implements the CRUD actions for Categorises model.
 */
class SettingsController extends BaseController
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
     * Lists all Categorises models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new Settings();
        $params=Yii::$app->params;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $params['adminEmail'] = $model->adminEmail;
            $params['senderEmail'] = $model->senderEmail;
            $params['senderName'] = $model->senderName;
            $params['bsDependencyEnabled'] = $model->bsDependencyEnabled;
            $params['phone'] = $model->phone;
            $params['facebook_id'] = $model->facebook_id;
            $params['sanpchat_id'] = $model->sanpchat_id;
            $params['sanpchat_email'] = $model->sanpchat_email;
            $params['tiktok_id'] = $model->tiktok_id;
            $params['company_delivery'] = $model->company_delivery;
            $params['massage_whatsapp']= $model->massage_whatsapp;
            $params['name_of_store']= $model->name_of_store;



            $file = UploadedFile::getInstance($model, 'logo');
            if (!is_null($file)) {
                $path="images/logo" . "." . $file->extension;
                $file->saveAs($path);
            }

            $parh="../config/params.php";
            $string="<?php \n return [ \n";
            foreach ($params as $key=> $param){
                $string.="'$key' => '$param', \n";
            }
            $string.="];\n ?>";
            // echo $string;
            // exit;
            file_put_contents($parh, $string);


            
            // set session save
            Yii::$app->session->set('message', 'successfuly update' );
        }

        return $this->render('index', [
            'model' => $model,
            'params'=>$params
        ]);

    }

}
