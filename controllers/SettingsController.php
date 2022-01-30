<?php

namespace app\controllers;

use app\components\CssHelper;
use app\components\SettingsHelper;
use app\models\settings\ThemeSettings;
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
     * Lists all Categorises models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new Settings();
        $params=Yii::$app->params;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $settings_helper= new SettingsHelper();
            $settings_helper->checked_isset();


            $params['adminEmail'] = $model->adminEmail;
            $params['senderEmail'] = $model->senderEmail;
            $params['senderName'] = $model->senderName;
            $params['address']=$model->address;
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


   
   public function actionTheme()
   {

       $model = new ThemeSettings();
       $params=Yii::$app->params;
       $settings_helper= new SettingsHelper();
       $settings_helper->checked_isset();

       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $css=[
               ":root"=>[
                   '--color_site' => $model->color_site,
                   '--font_color'=> $model->font_color,
                   '--background_nav' => "linear-gradient($model->background_duration, $model->background_first_color,  $model->background_second_color)",
                ],
           ];


           $string_css =CssHelper::css_array_to_css($css);
           $parh_css=Yii::getAlias('@webroot')."/css/variable.css";
           file_put_contents($parh_css, $string_css);

           $params['color_site'] = $model->color_site;
           $params['font_color'] = $model->font_color;
           $params['background_duration'] = $model->background_duration;
           $params['background_first_color'] = $model->background_first_color;
           $params['background_second_color'] = $model->background_second_color;
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

       return $this->render('theme', [
           'model' => $model,
           'params'=>$params
       ]);

   }

}
