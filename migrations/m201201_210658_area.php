<?php

use yii\db\Migration;

/**
 * Class m201201_210658_area
 */
class m201201_210658_area extends Migration
{

    public $data = [
        ['name_ar' => 'عبدون الجنوبي'],
        ['name_ar' => 'عبدون الشمالي '],
        ['name_ar' => 'ابو علندا '],
        ['name_ar' => 'ابو عاليا '],
        ['name_ar' => 'ابو نصير'],
        ['name_ar' => 'عين غزال '],
        ['name_ar' => 'العبدلي '],
        ['name_ar' => 'الجبل الأخضر '],
        ['name_ar' => 'ضاحية الأميرة عاليا '],
        ['name_ar' => 'البنيات الشمالي '],
        ['name_ar' => 'الدليلة'],
        ['name_ar' => 'الهاشمي الشمالي '],
        ['name_ar' => 'الهاشمي الجنوبي '],
        ['name_ar' => 'الحي الشرقي '],
        ['name_ar' => 'الجبل الأبيض '],
        ['name_ar' => 'ضاحية الاميره هيا '],
        ['name_ar' => 'الحي التجاري '],
        ['name_ar' => 'عوجان ياجوز '],
        ['name_ar' => 'مخيم الزرقاء '],
        ['name_ar' => 'مخيم حطين '],
        ['name_ar' => 'الرصيفة'],
        ['name_ar' => 'الحمر'],
        ['name_ar' => 'شارع الحريه'],
        ['name_ar' => 'الحسنية '],
        ['name_ar' => 'مدينة الحسين الطبية '],
        ['name_ar' => 'الجندول '],
        ['name_ar' => 'الجيزة'],
        ['name_ar' => 'الكليه العلمية الإسلامية '],
        ['name_ar' => 'الكرسي '],
        ['name_ar' => 'اللبن '],
        ['name_ar' => 'المدينة الرياضية '],
        ['name_ar' => 'المحطه '],
        ['name_ar' => 'حي المنصور '],
        ['name_ar' => 'المطبة '],
        ['name_ar' => 'حي المهاجرين '],
        ['name_ar' => 'الموقر '],
        ['name_ar' => 'حي العروبه '],
        ['name_ar' => 'القسطل '],
        ['name_ar' => 'القنيطرة '],
        ['name_ar' => 'القويسمة'],
        ['name_ar' => 'وسط البلد '],
        ['name_ar' => 'عمان مول'],
        ['name_ar' => 'جامعة العلوم التطبيقيه '],
        ['name_ar' => 'ارينبة الغربية '],
        ['name_ar' => 'ارينبة الشرقية'],
        ['name_ar' => 'الطنيب '],
        ['name_ar' => 'الزهور '],
        ['name_ar' => 'بدر الجديده '],
        ['name_ar' => 'حي البركة'],
        ['name_ar' => 'بيادر وادي السير '],
        ['name_ar' => 'دابوق'],
        ['name_ar' => 'ضاحية الأمير حمزة '],
        ['name_ar' => 'ضاحية الأمير راشد '],
        ['name_ar' => 'ضاحية الروضه '],
        ['name_ar' => 'ضاحية الحسين '],
        ['name_ar' => 'غمدان '],
        ['name_ar' => 'إسكان اليوبيل '],
        ['name_ar' => 'حي المنارة '],
        ['name_ar' => 'حي الهملان '],
        ['name_ar' => 'حي نزال '],
        ['name_ar' => 'حسبان '],
        ['name_ar' => 'عراق الأمير '],
        ['name_ar' => 'جبل الأشرفية '],
        ['name_ar' => 'جبل الحسين '],
        ['name_ar' => 'جبل النصر '],
        ['name_ar' => 'جبل القلعة '],
        ['name_ar' => 'جبل القصور '],
        ['name_ar' => 'جبل التاج٦'],
        ['name_ar' => 'جبل عمان '],
        ['name_ar' => 'الويبدة '],
        ['name_ar' => 'الجبيهه '],
        ['name_ar' => ' الجيزة '],
        ['name_ar' => 'الجامعه الأردنية '],
        ['name_ar' => 'الجويده'],
        ['name_ar' => 'خلدا'],
        ['name_ar' => 'خريبة السوق '],
        ['name_ar' => 'شفا بدران الله'],
        ['name_ar' => 'الموقر '],
        ['name_ar' => 'مرج الحمام '],
        ['name_ar' => 'ماركا الشماليه '],
        ['name_ar' => 'ماركا الجنوبيه '],
        ['name_ar' => 'المقابلين '],
        ['name_ar' => 'مجلس الامه'],
        ['name_ar' => 'ناعور الوسط'],
        ['name_ar' => 'قصر المشتى'],
        ['name_ar' => 'مطار الملكة علياء '],
        ['name_ar' => 'رغدان'],
        ['name_ar' => 'الرقيم'],
        ['name_ar' => 'راس العين '],
        ['name_ar' => 'سحاب '],
        ['name_ar' => 'مدينة سحاب الصناعية '],
        ['name_ar' => 'سيل حسبان '],
        ['name_ar' => 'الشميساني '],
        ['name_ar' => 'الصوفية '],
        ['name_ar' => 'صويلح '],
        ['name_ar' => 'طبربور '],
        ['name_ar' => 'تلاع العلي '],
        ['name_ar' => 'ام السماق'],
        ['name_ar' => 'ام الأسود '],
        ['name_ar' => 'ام العمد '],
        ['name_ar' => 'ام البساتين '],
        ['name_ar' => 'ام حجير '],
        ['name_ar' => 'ام نوارة '],
        ['name_ar' => 'ام قصير '],
        ['name_ar' => 'ام رمانة '],
        ['name_ar' => 'ام اذينة '],
        ['name_ar' => 'ام العمد '],
        ['name_ar' => 'أم الكندم '],
        ['name_ar' => 'وادي الحداده '],
        ['name_ar' => 'وادي السير '],
        ['name_ar' => 'ياجوز '],
        ['name_ar' => 'زيزيا '],
        ['name_ar' => 'ايدون'],
         ['name_ar' => 'عين جنا'],
        ['name_ar' => 'البارحة'], 
        ['name_ar' => 'البويضه'],
        ['name_ar' => 'الحي الغربي'],
         ['name_ar' => 'مدينة الحسن الصناعية'],
        ['name_ar' => 'الحي الشمالي'], 
        ['name_ar' => 'الـــحــصــــن'],
        ['name_ar' => ' الحي الشرقي'],
         ['name_ar' => 'الحي الجنوبي'],
        ['name_ar' => 'لواء الهاشمية'], 
        ['name_ar' => 'المنشية'],
        ['name_ar' => 'الكته'],
         ['name_ar' => 'الكفير'],
        ['name_ar' => 'المغير'], 
        ['name_ar' => 'المزار'],
        ['name_ar' => 'المخيبه'],
         ['name_ar' => 'المخيبه التحتا'],
         ['name_ar' => 'النعيمة'], 
         ['name_ar' => 'القيروان'],
        ['name_ar' => 'الصريح'],
         ['name_ar' => 'الشجره'],
        ['name_ar' => ' الشونه الشماليه'], 
        ['name_ar' => 'الرمثا'],
        ['name_ar' => 'المصطبه'], 
        ['name_ar' => 'المشارع'],
        ['name_ar' => 'الوهادنة'],
         ['name_ar' => 'عمراوه'],
        ['name_ar' => 'عنجره'], 
        ['name_ar' => 'الطيبة'],
        ['name_ar' => 'الطره'],
         ['name_ar' => 'بيت راس'],
        ['name_ar' => 'بليلا'],
         ['name_ar' => 'بيت يافا'],
        ['name_ar' => 'باعون'],
         ['name_ar' => 'بلاص'],
        ['name_ar' => 'برما'], 
        ['name_ar' => 'دير ابي سعيد'],
        ['name_ar' => 'بشرى'],
         ['name_ar' => 'دوقرة'],
        ['name_ar' => 'فوعرا'],
         ['name_ar' => 'اشتفينا'],
        ['name_ar' => 'حكما'],
         ['name_ar' => 'حي المواجه'],
        ['name_ar' => 'حلاوه'], 
        ['name_ar' => 'حريما'],
        ['name_ar' => 'حرثا'], 
        ['name_ar' => 'حاتم'],
        ['name_ar' => 'حواره'], 
        ['name_ar' => ''],
        ['name_ar' => 'حوفا'],
         ['name_ar' => 'حبراص'],
        ['name_ar' => 'عنبة'],
         ['name_ar' => 'عبين'],
        ['name_ar' => 'المركز الصناعي'],
         ['name_ar' => 'مخيم اربد'],
        ['name_ar' => 'وسط البلد'],
         ['name_ar' => 'ارحابا'],
        ['name_ar' => ' جنين الصفا'], 
        ['name_ar' => 'جديتا'],
        ['name_ar' => ' مخيم جرش'], 
        ['name_ar' => 'معبر وادي الاردن'],
        ['name_ar' => 'جحفيه'],
         ['name_ar' => 'كتم'],
        ['name_ar' => 'خرجا'], 
        ['name_ar' => 'كريمة'],
        ['name_ar' => 'كفر اسد'], 
        ['name_ar' => 'كفر ابيل'],
        ['name_ar' => 'كفر عوان'], 
        ['name_ar' => ' كفر جايز'],
        ['name_ar' => 'كفرخل'], 
        ['name_ar' => 'كفر راكب'],
        ['name_ar' => 'كفر سوم'], 
        ['name_ar' => 'سحم'],
        ['name_ar' => 'كفرنجه'], 
        ['name_ar' => 'كفر يوبا'],
        ['name_ar' => 'مخيم الشهيد عزمي'], 
        ['name_ar' => 'ملكا'],
        ['name_ar' => 'سما الروسان'], 
        ['name_ar' => 'مرصع'],
        ['name_ar' => 'قميم'],
         ['name_ar' => 'قفقفا'],
        ['name_ar' => 'رأس منيف'], 
        ['name_ar' => 'راجب'],
        ['name_ar' => 'راسون'], 
        ['name_ar' => 'رايمون'],
        ['name_ar' => 'صخره'],
         ['name_ar' => 'ساكب'],
        ['name_ar' => 'سال'], 
        ['name_ar' => 'سموع'],
        ['name_ar' => 'صما'], 
        ['name_ar' => 'سمر'],
        ['name_ar' => 'سوف'],
         ['name_ar' => 'سوم'],
        ['name_ar' => 'تينه'],
         ['name_ar' => 'مخيم سوف'],
        ['name_ar' => 'ام قيس'],
        ['name_ar' => 'وادي الريان'],
        ['name_ar' => 'يبلا'],
         ['name_ar' => 'وقاص'],
        ['name_ar' => 'زحر'],
        ['name_ar' => 'زمال'], 
        ['name_ar' => 'زوبيا'],
        ['name_ar' => 'الرصيفة'],
        ['name_ar' => 'وسط البلد الزرقاء '],
        ['name_ar' => 'الزرقاء الجديده '],
        ['name_ar' => 'المنطقة الحره'],
        ['name_ar' => 'جامعة الزرقاء الأهلية '],
        ['name_ar' => 'الهاشمية '],
        ['name_ar' => 'الأزرق الشمالي '],
        ['name_ar' => 'الجامعة الهاشمية '],
        ['name_ar' => 'الضليل '],
        ['name_ar' => 'الرصيفة '],

       

    ];
      
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%area}}', [
            'id' => $this->primaryKey(),
            'name_ar'=> $this->string()->notNull(),
            'name_en' => $this->string()->defaultValue(null),
            'region_id'=> $this->integer()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultValue(null),
            'updated_at' => $this->dateTime()->defaultValue(null),
        ], $tableOptions);

        Yii::$app->db
        ->createCommand()
        ->batchInsert('area', ['name_ar'], $this->data)
        ->execute();
    }

    public function down()
    {
        $this->dropTable('{{%area}}');
    }
}
