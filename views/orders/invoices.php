<?php

use Carbon\Carbon;
use kartik\helpers\Html;
$this->title = "invoices";
?>

<style>
    .invoice{
        height: 50vh;
        /*font-size: 14px;*/

    }

    @media print {
        .invoice{
            height: 50vh;
            /*font-size: 14px;*/
        }
      
    }


</style>


<div class="container">
    <?php foreach ($models as $key_model => $model): ?>
        <div class="invoice">
            <div class="row">
                <h1  class="text-center" ><?= Yii::$app->name ?> <?= Html::img('@web/images/logo.png', ['class' => 'logo'])?></h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong><?=Yii::t('app', 'To')?> : <?= $model['user']['name'] ;?> </strong></li>
                <li class="list-group-item"><strong><?=Yii::t('app', 'Phone')?> : <?= $model['user']['phone'] ;?> </strong></li>
                <li  class="list-group-item"><strong><?=Yii::t('app', 'Area')?> : <?= $model['region']['name_ar'] ;?> </strong></li>
                    </ul>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul class="list-group list-group-flush">
                    <li  class="list-group-item"><strong><?=Yii::t('app', 'Address')?> : <?= $model['address'] ;?> </strong></li>
                <li  class="list-group-item"><strong><?=Yii::t('app', 'Created_At')?> : <?= Carbon::parse( $model->created_at )->toDateString() ;?> </strong></li>
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
                        <?php $SubTotal=0; ?>
                        <?php foreach ($model->orderItems as  $key =>  $item):?>
                            <?php $SubTotal+=$item->price_item_count ;?>
                            <tr>
                                <th scope="row"><?= $key+1 ?></th>
                                <td><?= $item->product->name ;?></td>
                                <td><?= $item->quantity ;?></td>
                               
                            </tr>
                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-offset-1 container footer-s">
                   
                  
                    <p><strong> <?= Yii::t('app','Total_Amount')?>  : <?= $model->total_price?> JD  </strong></p>
                </div>


            </div>
        </div>
    <?php endforeach; ?>
</div>


