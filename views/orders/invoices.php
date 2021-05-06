<?php

use Carbon\Carbon;
use kartik\helpers\Html;
$this->title = "invoices";
?>

<style>
    .invoice{
        height: 50vh;
    }
    body{
        color: #000;
        font-size: 15px;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        direction: rtl;
    }

    .subpage {
        padding: 0px;
        /*border: 5px red solid;*/
        height: 256mm;
        /*outline: 2cm #FFEAEA solid;*/
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {
        .repeated-container{
            height: 100vh;
        }
        .invoice{
            height: 48vh;
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    th{
        font-weight: normal;
    }
    td{
        font-weight: normal;
        text-align: center;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
    {
        padding: 6px;
    }
</style>


<div class="container">
    <?php foreach ($models as $key_model => $model): ?>
        <div class="invoice ">
            <div class="row">
                <h1  class="text-center" ><?= Yii::$app->name ?> <?= Html::img('@web/images/logo.png', ['class' => 'logo'])?></h1>
            </div>
            <hr />
            <div class="row">
                <p style="margin-right: 10px;">
                    <?=Yii::t('app', 'Invoice')?>
                    <strong class="page-info">
                        <?=Yii::t('app', 'ID')?> : #<?= $model->id ;?>
                    </strong>
                </p>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong><?=Yii::t('app', 'To')?> : <?= $model['user']['name'] ;?> </strong></li>
                        <li class="list-group-item"><strong><?=Yii::t('app', 'Phone')?> : <?= $model['user']['phone'] ;?> </strong></li>
                        <li  class="list-group-item"><strong><?=Yii::t('app', 'Area')?> : <?= $model['region']['name_ar'] ;?> </strong></li>
                        <li  class="list-group-item"><strong><?=Yii::t('app', 'Address')?> : <?= $model['user']['address'] ;?> </strong></li>
                    </ul>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong><?=Yii::t('app', 'ID')?> : <?= $model['user']['name'] ;?> </strong></li>
                        <li  class="list-group-item"><strong><?=Yii::t('app', 'Status')?> : <?= $model->status->name_ar ;?></strong></li>
                        <li  class="list-group-item"><strong><?=Yii::t('app', 'Created_At')?> : <?= Carbon::parse( $model->created_at )->toDateString() ;?> </strong></li>
                    </ul>
                </div>

            </div>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <table class="table  table-hover">
                        <thead class="table-header">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= Yii::t('app','Name_Product') ;?></th>
                            <th scope="col"><?= Yii::t('app','Quantity') ;?></th>
                            <th scope="col"><?= Yii::t('app','Price') ;?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $SubTotal=0; $delivery_fees=2;?>
                        <?php foreach ($model->orderItems as  $key =>  $item):?>
                            <?php $SubTotal+=$item->profits_margin;?>
                            <tr>
                                <th scope="row"><?= $key+1 ?></th>
                                <td><?= $item->product->name ;?></td>
                                <td><?= $item->quantity ;?></td>
                                <td><?= $item->profits_margin ;?> jd</td>
                            </tr>
                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-offset-1 container footer-s">
                    <p><strong><?= Yii::t('app','Delivery_Fees')?> : <?= $delivery_fees?> Jd  </strong></p>
                    <p><strong> <?= Yii::t('app','SubTotal')?>  : <?= $SubTotal?> JD </strong></p>
                    <p><strong> <?= Yii::t('app','Total_Amount')?>  : <?= $SubTotal+$delivery_fees?> </strong></p>
                </div>


            </div>
        </div>
    <?php endforeach; ?>
</div>


