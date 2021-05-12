<?php

use yii\helpers\Html;
$this->title = Yii::t('app','Successfuly_Applay');

?>
<div class="row">
<p>
<h1>
<?= Yii::t('app','Success_For_Name') . ' '. $model->name;?>
</h1>
</p>
<p>
</div>
<div class="row">
<h1>
<?= Yii::t('app','Order_Price_Total') . ' '. $model->total_price ." JOD";?>
</h1>
</p>
</div>
<div class="row">
<p>
<h1>

<?= Yii::t('app','Order_Conected') ?>
</h1>
</p>
</div>
<div class="row">
<p>
<h1>
<?= Yii::t('app','See_Other_Product')?>
</h1>
</p>
</div>


<div class="row">
            <div class="row">
                <div class="col-md-9">
                    <h5> <?=Yii::t('app','Product_Suggested');?></h5>
                </div>
                <div class="col-md-3">
                    <!-- Controls -->
                    <div class="controls pull-right ">
                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                           data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                                                    data-slide="next"></a>
                    </div>
                </div>
            </div>
            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row">
                            <?php if(isset($product_suggested[0])):?>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="card card-sugested" onclick="window.location.href = '<?= 'index.php?r=product/view&id='.$product_suggested[0]->id?>'">
                                        <?= Html::img($product_suggested[0]->thumbnail, ['style' => 'width:100%']) ?>
                                        <h5><?= $product_suggested[0]->name ?></h5>
                                        <p class="price">$<?= $product_suggested[0]->selling_price ?></p>
                                        <p><?= $product_suggested[0]->description ?>.</p>
                                        <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view', 'id' => $product_suggested[0]->id], ['class' => 'btn  btn-green']); ?></p>
                                    </div>
                                </div>
                            <?php endif;?>

                            <?php if(isset($product_suggested[1])):?>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="card card-sugested" onclick="window.location.href = '<?= 'index.php?r=product/view&id='.$product_suggested[1]->id?>'">
                                        <?= Html::img($product_suggested[1]->thumbnail, ['style' => 'width:100%']) ?>
                                        <h5><?= $product_suggested[1]->name ?></h5>
                                        <p class="price">$<?= $product_suggested[1]->selling_price ?></p>
                                        <p><?= $product_suggested[1]->description ?>.</p>
                                        <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view', 'id' => $product_suggested[1]->id], ['class' => 'btn  btn-green']); ?></p>
                                    </div>
                                </div>
                            <?php endif;?>

                        </div>
                    </div>

                    <div class="item">
                        <div class="row">
                            <?php if(isset($product_suggested[2])):?>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="card card-sugested" onclick="window.location.href = '<?= 'index.php?r=product/view&id='.$product_suggested[2]->id?>'">
                                        <?= Html::img($product_suggested[2]->thumbnail, ['style' => 'width:100%']) ?>
                                        <h5><?= $product_suggested[2]->name ?></h5>
                                        <p class="price">$<?= $product_suggested[2]->selling_price ?></p>
                                        <p><?= $product_suggested[2]->description ?>.</p>
                                        <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view', 'id' => $product_suggested[2]->id], ['class' => 'btn  btn-green']); ?></p>
                                    </div>
                                </div>
                            <?php endif;?>

                            <?php if(isset($product_suggested[3])):?>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="card card-sugested" onclick="window.location.href = '<?= 'index.php?r=product/view&id='.$product_suggested[3]->id?>'">
                                        <?= Html::img($product_suggested[3]->thumbnail, ['style' => 'width:100%']) ?>
                                        <h5><?= $product_suggested[3]->name ?></h5>
                                        <p class="price">$<?= $product_suggested[3]->selling_price ?></p>
                                        <p><?= $product_suggested[2]->description ?>.</p>
                                        <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view', 'id' => $product_suggested[3]->id], ['class' => 'btn  btn-green']); ?></p>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<script type="text/javascript">
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', <?=Yii::$app->params['facebook_id']?>);
    fbq('track', 'Purchase', {currency: "USD", value: 10.00});
</script>

  <!-- Snap Pixel Code -->
  <script type='text/javascript'>
  
        (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
        {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
        a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
        r.src=n;var u=t.getElementsByTagName(s)[0];
        u.parentNode.insertBefore(r,u);})(window,document,
        'https://sc-static.net/scevent.min.js');

        snaptr('init',<?=Yii::$app->params['sanpchat_id']?>, {
        'user_email': <?=Yii::$app->params['sanpchat_email']?>
        });

        snaptr('track','PURCHASE'); 

    </script>
    <!-- End Snap Pixel Code -->

