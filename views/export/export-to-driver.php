<?php


use app\components\ApiOrderHelper;
use app\models\orders\Orders;
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
    <button id='export_to_driver' class='btn btn-success' title="<?= Yii::t('app', 'Export_To_Driver') ?>" > <span   class='glyphicon glyphicon-plane' > </span> </button>
    <table class="table table-sm">
      <thead>
        <tr>
          <th scope="col">
              #
                <input type="checkbox" class="select-on-check-all" name="selection" >
          </th>
          <th scope="col"><?= Yii::t('app','Name')?></th>
          <th scope="col"><?= Yii::t('app','Phone')?></th>
          <th scope="col"><?= Yii::t('app','Address')?></th>
          <th scope="col"><?= Yii::t('app','Region')?></th>
          <th scope="col"><?= Yii::t('app','Total_Price')?></th>
            <th scope="col"><?= Yii::t('app','Action')?></th>
        </tr>
      </thead>
      <tbody>
            <?php
            $total_exprot=0;
            $max_exprt=20
            ?>
          <?php foreach($models as $key =>$model):?>
            <?php
            if($model['deported'] == Orders::UN_DEPOTED ){
                if($total_exprot < $max_exprt){
//                    $responce=$api->push_order($model);
                    $responce["barcode"]="sss";
//                    $responce["error"]="ss";
                    if(isset($responce["error"])){
                        $class_name="bg-danger";
                    }else{
                        $total_exprot ++;
                        Yii::$app->db->createCommand()
                            ->update('orders', ['order_id' => $responce['barcode'],'deported'=>Orders::DEPOTED], "orders.id =". $model['id'])
                            ->execute();
                        $class_name="bg-success";
                    }
                }else{
                    $class_name="bg-danger";
                }
            }else{
                $class_name="bg-success";
            }
            ?>
            <tr class="<?=$class_name?>">
                <th scope="row">
                    <input type="checkbox" class="kv-row-checkbox" name="selection[]" value="<?=$model["id"]?>">
                    <?= ++$key?>
                </th>
                <td><?= $model["name"] ?></td>
                <td><?= $model["phone"] ?></td>
                <td><?= $model["address"] ?></td>
                <td><?= $model['name_ar']?></td>
                <td><?= $model["total_price"] ?> </td>
                <td>
                    <?php if($class_name =="bg-danger"):?>
                        <?=Html::a("<span   class='glyphicon glyphicon-plane' > </span>",
                            ['export/export-to-driver', 'string_id'=>$model["id"]],
                            ['class' => 'btn btn-success' ,"target"=>"_blank"])?>
                    <?php endif;?>
                </td>
            </tr>

        <?php endforeach;?>

      </tbody>
    </table>
</div>
