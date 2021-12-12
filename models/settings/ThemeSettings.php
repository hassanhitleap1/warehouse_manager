<?php
namespace app\models\settings;

use Yii;
use yii\base\Model;

class ThemeSettings extends Model
{
     public $color_site;
     public $font_color;
     public  $background_duration;
     public $background_first_color;
     public $background_second_color;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['color_site','font_color','background_duration','background_first_color','background_second_color'],'required']
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'color_site' => Yii::t('app', 'Color_Site'),
            'font_color' => Yii::t('app', 'Font_Color'),
            'background_duration' => Yii::t('app', 'Background_Duration'),
            'background_first_color' => Yii::t('app', 'Background_First_Color'),
            'background_second_color'=>  Yii::t('app', 'Background_Second_Color'),
        ];
    }
}