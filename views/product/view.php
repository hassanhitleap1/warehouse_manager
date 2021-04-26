<?php

use app\models\products\Products;
use app\models\regions\Regions;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$regions_model = Regions::find()->all();
$regions = [];
foreach ($regions_model as $key => $value) {
    $regions[$value->id] = $value->name_ar . " ".Yii::t('app','Delivery_Price')." ( " . $value->price_delivery . " )";
}
$this->title = $model->name;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.0/viewer.min.js" integrity="sha512-0goo56vbVLOJt9J6TMouBm2uE+iPssyO+70sdrT+J5Xbb5LsdYs31Mvj4+LntfPuV+VlK0jcvcinWQG5Hs3pOg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.9.0/viewer.css" integrity="sha512-HHYZlJVYgHVdz/pMWo63/ya7zc22sdXeqtNzv4Oz76V3gh7R+xPqbjNUp/NRmf0R85J++Yg6R0Kkmz+TGYHz8g==" crossorigin="anonymous" />

<?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['site/index'], ['class' => 'btn btn-green pull-left']) ?>

<div class="card-single">



    <div class="container-fliud">
        <div class="wrapper row">
            <div class="preview col-md-6">
                <div class="preview-pic tab-content">

                    <div class="tab-pane active" id="pic-1">
                        <?= Html::img($model->thumbnail, ['data-original' => $model->thumbnail]) ?>
                    </div>

                    <?php foreach ($model->imagesProduct as $key => $img) : ?>
                        <div class="tab-pane" id="pic-<?= $key + 2 ?>">
                            <?= Html::img($img->path, ['data-original' => $img->path]) ?>
                        </div>

                    <?php endforeach; ?>

                </div>
                <div id="galley">
                    <ul class="preview-thumbnail nav nav-tabs pictures">
                        <li class="active">
                            <a data-target="#pic-1" data-toggle="tab">
                                <?= Html::img($model->thumbnail, ['data-original' => $model->thumbnail]) ?>
                            </a>
                        </li>
                        <?php foreach ($model->imagesProduct as $key => $img) : ?>
                            <li>
                                <a data-target="#pic-<?= $key + 2 ?>" data-toggle="tab">
                                    <?= Html::img($img->path, ['data-original' => $img->path]) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="details col-md-6">
                <h5 class="product-title"><?= $this->title ?></h5>

                <p class="product-description"><?= $model->description ?> .</p>
                <h4 class="price"><?= Yii::t('app', 'Price') ?> : <span><?= $model->selling_price ?> JOD</span></h4>

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?= str_replace('watch?v=', 'embed/', $model->video_url) ?>" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="wrapper row" style="margin-top: 10px;">
            <div class="col-md-12">
            <p> <strong style="color:red;"><?=Yii::t('app','Delivery_Price_Added')?> </strong> </p>
            </div>
            
        </div>
        <div class="wrapper row">
            <div class="preview col-md-12">
                <?php $form = ActiveForm::begin(['id' => "order_landig"]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($modelOrder, 'phone')->textInput(['required' => true,'placeholder' => "07xxxxxxxx"]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($modelOrder, 'other_phone')->textInput(['placeholder' => "07xxxxxxxx"]) ?>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'address')->textInput(['required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                    <?= $form->field($modelOrder, 'region_id')->widget(Select2::classname(), [
                        'data' =>  $regions,
                        'language' => 'ar',
        
                        ]); ?>
                       
                    </div>
                </div>
             

                <div class="row">
                    <?php if (count($model->subProductCount) >= 2 ) : ?>
                        <div class="col-md-6">
                            <?= $form->field($modelOrder, 'type')->dropDownList(ArrayHelper::map($model->subProductCount, 'id', 'type')) ?>
                        </div>
                    <?php else : ?>
                        <?= $form->field($modelOrder, 'type')->hiddenInput(['value' => $model->subProductCount[0]->id])->label(false); ?>
                    <?php endif; ?>

                    <div class="col-md-6">
                        <?php if ($model->type_options == Products::TYPE_CHOOSE_BOX) : ?>
                            <?= $form->field($modelOrder, 'typeoption')->radioList(ArrayHelper::map($model->typeOptions, 'id', 'text'), ['style' => 'display: grid;']) ?>
                        <?php else : ?>
                            <?= $form->field($modelOrder, 'typeoption')->dropDownList(ArrayHelper::map($model->typeOptions, 'id', 'text')) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Order_Now') . ' <span class="glyphicon glyphicon-shopping-cart"> </span>', ['class' => 'btn btn-green btn-lg btn-block', 'id' => 'send_order']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>




            </div>
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
                                        
                                        <p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view', 'id' => $product_suggested[3]->id], ['class' => 'btn  btn-green']); ?></p>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<div class="row productmainbtn" style="display: block;">
    <div class="col-md-12">
        <a href="#" id="ordernow" class="btn btn-green btn-lg btn-block" style="width:100%"><i class="glyphicon glyphicon-shopping-cart"></i> <?= Yii::t('app', 'Order_Now') ?> </a>
    </div>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=<?=Yii::$app->params['phone']?>&text=<?= Yii::t('app','Need_Product'). ' '. $model->name?>."
 class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>


</a>
 
<?php if (Yii::$app->session->has('message')) : ?>
    <script type="text/javascript">
        setTimeout(function() {
            Swal.fire('<?= Yii::$app->session->get('message'); ?>');
        }, 1000);
    </script>
    <?php Yii::$app->session->remove('message'); ?>
<?php endif; ?>