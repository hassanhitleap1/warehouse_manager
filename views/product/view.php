<?php


$this->title = $model->name;
use app\models\pricecompanydelivery\PriceCompanyDelivery;
use app\models\products\Products;
use app\models\regions\Regions;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$regions_model = Regions::find()->all();
$regions = [];
if(is_null($model->company_delivery_id)){

    foreach ($regions_model as $key => $value) {
        $regions[$value->id] = $value->name_ar . " ".Yii::t('app','Delivery_Price')." ( " . $value->price_delivery . " )";
    }

}else{

    $price_company_delivery=PriceCompanyDelivery::find()
        ->select(['regions.*','price_company_delivery.*'])
        ->leftJoin('regions', 'regions.id=price_company_delivery.region_id')
        ->where(['=','price_company_delivery.company_delivery_id',$model->company_delivery_id])->asArray()->all();
    foreach ($price_company_delivery as $key => $value) {
        $regions[$value['region_id']] = $value['name_ar'] . " ".Yii::t('app','Delivery_Price')." ( " . $value['price'] . " )";

    }

}
$path_theme = Yii::getAlias('@web') . 'theme/shop/'

?>
<main>
	    <div class="container margin_30">
	        <div class="countdown_inner">-20% This offer ends in <div data-countdown="2019/05/15" class="countdown"></div>
	        </div>
	        <div class="row">
	            <div class="col-md-6">
	                <div class="all">
	                    <div class="slider">
	                        <div class="owl-carousel owl-theme main">
                                <?php foreach ($model->imagesProduct as $key => $img) : ?>
                                    <div style="background-image: url(<?= $img->path ?>);" class="item-box"></div>
                                   
                                <?php endforeach; ?>
	                           
	                        </div>
	                        <div class="left nonl"><i class="ti-angle-left"></i></div>
	                        <div class="right"><i class="ti-angle-right"></i></div>
	                    </div>
	                    <div class="slider-two">
	                        <div class="owl-carousel owl-theme thumbs">
                            <?php foreach ($model->imagesProduct as $key => $img) : ?>
                                
                                    <div style="background-image: url(<?= $img->path ?>);" class="item active"></div>
                                <?php endforeach; ?>
	   
	                        </div>
	                        <div class="left-t nonl-t"></div>
	                        <div class="right-t"></div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6">
	              
	                <!-- /page_header -->
	                <div class="prod_info">
                        <h1> <?=$model->name;?></h1>
	              
                        <p> <br>
                        <?php print  $model->description ?>
                    </p>

                  
    
                    <?php $uri  =  Url::to(['product/view', 'id' => $model->id]);?>
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                    <div class="prod_options">
                        <form id='order_landig' action="<?=$uri?> " method='post'>
                                

                        <div class="row">
                                <div class="col-12 ">
                                    <div class="form-group field-orderform-name required">
                                        <input type="text" id="orderform-name" class="form-control"  placeholder="الأسم" name="OrderForm[name]"  value="<?= isset($_POST['OrderForm']['name']) ?$_POST['OrderForm']['name'] :''?>"  aria-required="true">
                                        <?php if($modelOrder->hasErrors("name")):?>
                                        <div class="help-block"><?= $modelOrder->getErrors("name")[0]?></div>
                                        <?php endif;?>
                                    </div>
                                </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group field-orderform-phone required has-error">
                                        <label class="control-label" for="orderform-phone">هاتف </label>
                                        <input type="text" id="orderform-phone"  class="form-control" name="OrderForm[phone]"  placeholder="07xxxxxxxx" value="<?= isset($_POST['OrderForm']['phone']) ?$_POST['OrderForm']['phone'] :''?>" aria-required="true" aria-invalid="true">
                                        <?php if($modelOrder->hasErrors("phone")):?>
                                        <div class="help-block"><?= $modelOrder->getErrors("phone")[0]?></div>
                                        <?php endif;?>
                                    </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group field-orderform-other_phone">
                                    <label class="control-label" for="orderform-other_phone">هاتف اخر</label>
                                    <input type="text" id="orderform-other_phone" class="form-control" name="OrderForm[other_phone]"  value="<?= isset($_POST['OrderForm']['other_phone']) ?$_POST['OrderForm']['other_phone'] :''?>" placeholder="07xxxxxxxx">
                                    <?php if($modelOrder->hasErrors("other_phone")):?>
                                    <div class="help-block"><?= $modelOrder->getErrors("other_phone")[0]?></div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group field-orderform-address required has-error">
                                    <label class="control-label" for="orderform-address">العنوان</label>
                                    <input type="text" id="orderform-address" class="form-control" name="OrderForm[address]"   value="<?= isset($_POST['OrderForm']['address']) ?$_POST['OrderForm']['address'] :''?>" aria-required="true" aria-invalid="true">
                                    <?php if($modelOrder->hasErrors("address")):?>
                                    <div class="help-block"><?= $modelOrder->getErrors("address")[0]?></div>
                                    <?php endif;?>
                                </div>                           
                            </div>
                         
                            <div class="col-md-6">
                                <div class="form-group field-orderform-region_id">
                                <label class="control-label" for="orderform-region_id">المحافظة</label>
                                <select id="orderform-region_id" class="form-control" name="OrderForm[region_id]">
                                    <?php foreach($regions as $key=> $region):?>
                                        <option value="<?=$key?>"  <?= isset($_POST['OrderForm']['region_id']) && $_POST['OrderForm']['region_id'] == $key ?'selected' :''?> ><?= $region?></option>
                                     <?php endforeach;?>   
                                </select>

                                <?php if($modelOrder->hasErrors("region_id")):?>
                                    <div class="help-block"><?= $modelOrder->getErrors("region_id")[0]?></div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php if (count($model->subProductCount) >= 2 ) : ?>
                                <div class="col-md-6">

                                <div class="form-group field-orderform-type">
                                <label class="control-label" for="orderform-region_id">النوع</label>
                                <select id="orderform-type" class="form-control" name="OrderForm[type]">
                                    <?php foreach($model->subProductCoun as $key=> $subProductCoun):?>
                                        <option value="<?=$subProductCoun->id?>"  <?= isset($_POST['OrderForm']['type']) && $_POST['OrderForm']['type'] == $subProductCoun->id?'selected' :''?> ><?= $subProductCoun->text?></option>
                                     <?php endforeach;?>   
                                </select>

                                <?php if($modelOrder->hasErrors("type")):?>
                                    <div class="help-block"><?= $modelOrder->getErrors("type")[0]?></div>
                                    <?php endif;?>
                                </div>

                              
                                </div>
                            <?php else : ?>
                                <input type="hidden" name="OrderForm[type]" value="<?=$model->subProductCount[0]->id?>" >
                               
                            <?php endif; ?>

                            <div class="col-md-6">
                                <?php if ($model->type_options == Products::TYPE_CHOOSE_BOX) : ?>
                                    
                                <div class="form-group field-orderform-typeoption">
                                <label class="control-label" for="orderform-typeoption">النوع</label>
                                <select id="orderform-typeoption" class="form-control" name="OrderForm[typeoption]">
                                    <?php foreach($model->typeOptions as $key=> $typeOptions):?>
                                        <option value="<?=$typeOptions->id?>"  <?= isset($_POST['OrderForm']['typeoption']) && $_POST['OrderForm']['typeoption'] == $typeOptions->id?'selected' :''?> ><?= $typeOptions->text?></option>
                                     <?php endforeach;?>   
                                </select>

                                <?php if($modelOrder->hasErrors("typeoption")):?>
                                    <div class="help-block"><?= $modelOrder->getErrors("typeoption")[0]?></div>
                                    <?php endif;?>
                                </div>





                                <?php else : ?>





                                <div class="form-group field-orderform-typeoption">
                                <label class="control-label" for="orderform-typeoption">النوع</label>
                                <select id="orderform-typeoption" class="form-control" name="OrderForm[typeoption]">
                                    <?php foreach($model->typeOptions as $key=> $typeOptions):?>
                                        <option value="<?=$typeOptions->id?>"  <?= isset($_POST['OrderForm']['typeoption']) && $_POST['OrderForm']['typeoption'] == $typeOptions->id?'selected' :''?> ><?= $typeOptions->text?></option>
                                     <?php endforeach;?>   
                                </select>

                                <?php if($modelOrder->hasErrors("typeoption")):?>
                                    <div class="help-block"><?= $modelOrder->getErrors("typeoption")[0]?></div>
                                    <?php endif;?>
                                </div>



                                <?php endif; ?>
                            </div>
                        </div>
                   
               




                    



                      

                        <div class="form-group">

                            <?= Html::submitButton(
                                '<span class="spinner spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>'.
                                Yii::t('app', 'Order_Now') . ' <span class="fas fa-shopping-cart"></span> ', ['class' => 'btn_1  cart', 'id' => 'send_order','data-loading-text'=>"Loading..."]) ?>
                        </div>


                        </form>
                    </div>

                    
	                </div>
	       
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	    
	

        
    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab"> <?= Yii::t('app','Description') ?></a>
                </li>

            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">

                                <?= Yii::t('app','Description') ?>
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-12">
                                    <h3><?= Yii::t('app','Details') ?></h3>
                                    <p>   <?php print  $model->description ?> </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <?= $this->render('@app/views/components/related', ['model' => $model,'product_suggested'=>$product_suggested]); ?>

    <!-- /container -->

	</main>