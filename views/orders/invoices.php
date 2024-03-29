<?php

use Carbon\Carbon;
use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = "invoices";
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$public_path=$protocol.$_SERVER['HTTP_HOST'];
            
?>

<style>
    .invoice{
        height: 50vh;
        font-size: 14px;

    }
    .img-qr-code{
        float: left;
        width: 60px;
        height: 60px;
        margin-top: -22px;
    }
    .container{
            font-size: 15px;
        }

    @media print {
        .container{
            font-size: 10px;
        }
        .invoice{
            height: 50vh;
            /*font-size: 14px;*/
        }
        .number{
           direction: rtl ; /* Reset to default */
           display: inline-block;
 
        }
        .img-qr-code{
           float: left;
           width: 70px;
        height: 70px;
           margin-top: -22px;
        }
      
    }


</style>


<div class="container">
    <?php foreach ($models as $key_model => $model): ?>
        <div class="invoice">
            <div class="row">
                <h2  class="text-center" ><?= Yii::$app->name ?> <?= Html::img('@web/images/logo.png', ['class' => 'logo'])?></h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong><?=Yii::t('app', 'To')?> : <?= $model['user']['name'] ;?> </strong></li>
                <li class="list-group-item"><strong class="phone"><?=Yii::t('app', 'Phone')?> : <span class="number"> <?= $model['user']['phone'] ;?> </span></strong></li>
              
                    </ul>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul class="list-group list-group-flush">
                    <li  class="list-group-item"> <strong><?=Yii::t('app', 'Area')?> : <?= $model['region']['name_ar'] ;?> </strong> &nbsp &nbsp \ &nbsp &nbsp<strong><?=Yii::t('app', 'Address')?> : <?= $model['address'] ;?> </strong></li>
                <li  class="list-group-item"><strong><?=Yii::t('app', 'Date')?> : <?= Carbon::now("Asia/Amman")->toDateString() ;?> </strong></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table  table-hover">
                        <thead class="table-header">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= Yii::t('app','Name_Product') ;?></th>
                            <th scope="col"><?= Yii::t('app','Quantity') ;?></th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php $SubTotal=0; $orderItemString = '';?>
                        <?php foreach ($model->orderItems as  $key =>  $orderItem):?>
                            <?php  $SubTotal+=$orderItem->price_item_count ;  $type = '';
                            if (isset($orderItem->product->subProductCount) && count($orderItem->product->subProductCount) > 1) {
                                $type = $orderItem->subProduct->type;
                            }
                            $orderItemString = ' ' . $orderItem['product']['name'] . ' ' . $type . ' ' . Yii::t('app', 'Number') . ' ( ' . $orderItem->quantity . ' ) ';
                            ?>
                            <tr>
                                <th scope="row"><?= $key+1 ?></th>
                                <td><?= $orderItemString ;?></td>
                                <td><?= $orderItem->quantity ;?></td>
                               
                            </tr>
                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-2  col-xm-2">
                    <p><strong> <?= Yii::t('app','Total_Amount')?>  : <?= $model->total_price?> JD  </strong></p>
                </div>
                <div class="col-md-2 col-sm-2 col-xm-2">
                    <?php if(!is_null($model->note) && $model->note != "" ): ?>
                        
                        <strong> <?=Yii::t("app",'Note');?> :-  <?= $model->note ;?></strong>
                      <?php endif;?>  
                </div>

                <div class="col-md-4 col-sm-4 col-xm-4">
                    <?php $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                        echo $generator->getBarcode($model->order_id, $generator::TYPE_CODE_128);?>
                        <p style="margin-right: 50px;"><?=$model->order_id?></p>
                        
                </div>
                <div class="col-md-4 col-sm-4 col-xm-4">
                    <?php  $data = $public_path.Url::toRoute(['orders/bill', 'id' => $model->id])?>
                    <?= '<img class="img-qr-code" src="'.(new \chillerlan\QRCode\QRCode())->render($data).'" alt="QR Code" />';?>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>


