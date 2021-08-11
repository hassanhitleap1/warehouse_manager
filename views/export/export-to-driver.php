<?php


use app\components\ApiOrderHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\products\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Export_To_Driver');
$this->params['breadcrumbs'][] = $this->title;
$api= new ApiOrderHelper();
?>
<div class="Create_Product">

    <h1><?= Html::encode($this->title) ?></h1>


    <table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><?= Yii::t('app','Name')?></th>
      <th scope="col"><?= Yii::t('app','Phone')?></th>
      <th scope="col"><?= Yii::t('app','Address')?></th>
      <th scope="col"><?= Yii::t('app','Region')?></th>
      <th scope="col"><?= Yii::t('app','Total_Price')?></th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($models as $key =>$model):?>
        <?php 
        // $responce=$api->push_order($model);
         if(true){
            $class_name="bg-success";
        }else{

            $class_name="bg-danger";
        }
        ?>
        <tr class="<?=$class_name?>">
            <th scope="row"><?= ++$key?></th>
            <td><?= $model["user"]["name"] ?></td>
            <td><?= $model["user"]["phone"] ?></td>
            <td><?= $model["address"] ?></td>
            <td><?= $model['region']['name_ar']?></td>
            <td><?= $model["total_price"] ?></td>
        </tr>
    
    <?php endforeach;?>

  </tbody>
</table>
</div>
