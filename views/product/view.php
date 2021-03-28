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
    $regions[$value->id] = $value->name_ar . " ( " . $value->price_delivery . " )";
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
                <h3 class="product-title"><?= $this->title ?></h3>

                <p class="product-description"><?= $model->purchasing_price ?>.</p>
                <h4 class="price"><?= Yii::t('app', 'Price') ?> : <span>$<?= $model->purchasing_price ?></span></h4>

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?= str_replace('watch?v=', 'embed/', $model->video_url) ?>" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="wrapper row">
            <div class="preview col-md-12">
                <?php $form = ActiveForm::begin(['id' => "order_landig"]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'phone')->textInput(['required' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'other_phone')->textInput([]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($modelOrder, 'region_id')->dropDownList($regions); ?>
                    </div>
                </div>

                <div class="row">
                    <?php if ($model->subProductCount > 1) : ?>
                        <div class="col-md-6">
                            <?= $form->field($modelOrder, 'type')->dropDownList(ArrayHelper::map($model->subProductCount, 'id', 'type')) ?>
                        </div>
                    <?php else : ?>
                        <?= $form->field($model, 'type')->hiddenInput(['value' => $model->subProductCount[0]->id])->label(false); ?>

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


<!--        <div class="row">-->
<!--            <div class="row">-->
<!--                <div class="col-md-9">-->
<!--                    <h3>-->
<!--                        Carousel Product Cart Slider</h3>-->
<!--                </div>-->
<!--                <div class="col-md-3">-->
<!--                    <!-- Controls -->-->
<!--                    <div class="controls pull-right ">-->
<!--                        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"-->
<!--                           data-slide="prev"></a><a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"-->
<!--                                                    data-slide="next"></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div id="carousel-example" class="carousel slide" data-ride="carousel">-->
<!--                <!-- Wrapper for slides -->-->
<!--                <div class="carousel-inner">-->
<!--                    <div class="item active">-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-12 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Sample Product</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $199.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="fa fa-star"></i>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-12 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Product Example</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $249.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-12 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Next Sample Product</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $149.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="fa fa-star"></i>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-12 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Sample Product</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $199.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="fa fa-star"></i>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="item">-->
<!--                        <div class="row">-->
<!--                            <div class="col-sm-3 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Product with Variants</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $199.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="fa fa-star"></i>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Grouped Product</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $249.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Product with Variants</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $149.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="fa fa-star"></i>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-sm-3 col-xs-12">-->
<!--                                <div class="col-item">-->
<!--                                    <div class="photo">-->
<!--                                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />-->
<!--                                    </div>-->
<!--                                    <div class="info">-->
<!--                                        <div class="row">-->
<!--                                            <div class="price col-md-6">-->
<!--                                                <h5>-->
<!--                                                    Product with Variants</h5>-->
<!--                                                <h5 class="price-text-color">-->
<!--                                                    $199.99</h5>-->
<!--                                            </div>-->
<!--                                            <div class="rating hidden-sm col-md-6">-->
<!--                                                <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">-->
<!--                                                </i><i class="fa fa-star"></i>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="separator clear-left">-->
<!--                                            <p class="btn-add">-->
<!--                                                <i class="fa fa-shopping-cart"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">Add to cart</a></p>-->
<!--                                            <p class="btn-details">-->
<!--                                                <i class="fa fa-list"></i><a href="http://www.jquery2dotnet.com" class="hidden-sm">More details</a></p>-->
<!--                                        </div>-->
<!--                                        <div class="clearfix">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->





        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Bitter" rel="stylesheet" type="text/css">
        <div class="container">
            <div class="row header-row">
                <div class="col-md-offset-2 col-md-8 title">
                    <img alt="" class="img-responsive logo" src="//static.rtpdesign.co.uk/blog/img/blog-logo.png">
                    <h1>Bootstrap 3 Show Many Slide One Carousel</h1>
                    <p>Find out more about <a href="https://github.com/rtpHarry/Bootstrap3-ShowManySlideOneCarousel">this code sample</a>.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel carousel-showmanymoveone slide" id="carousel123">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=1" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=2" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/d6d6d6/333&amp;text=3" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002040/eeeeee&amp;text=4" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=5" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=6" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/40a1ff/002040&amp;text=8" class="img-responsive"></a></div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel123" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#carousel123" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Second carousel test</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel carousel-showmanymoveone slide" id="carouselABC">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=A" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=B" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/d6d6d6/333&amp;text=C" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002040/eeeeee&amp;text=D" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=E" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=F" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=G" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/40a1ff/002040&amp;text=H" class="img-responsive"></a></div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carouselABC" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#carouselABC" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <script type="text/javascript">

    (function(){
        // setup your carousels as you normally would using JS
        // or via data attributes according to the documentation
        // https://getbootstrap.com/javascript/#carousel
        $('#carousel123').carousel({ interval: 2000 });
        $('#carouselABC').carousel({ interval: 3600 });
    }());

    (function(){
        $('.carousel-showmanymoveone .item').each(function(){
            var itemToClone = $(this);

            for (var i=1;i<4;i++) {
                itemToClone = itemToClone.next();

                // wrap around if at end of item collection
                if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                }

                // grab item, clone, add marker class, add to collection
                itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-"+(i))
                    .appendTo($(this));
            }
        });
    }());
</script>

<style>

    .carousel-showmanymoveone
    {
    .carousel-control
    {
        width: 4%;
        background-image:none;

    &.left
     {
         margin-left:15px;
     }

    &.right
     {
         margin-right:15px;
     }
    }

    .cloneditem-1,
    .cloneditem-2,
    .cloneditem-3
    {
        display: none;
    }

    .carousel-inner
    {
    @media all and (min-width: 768px)
    {
        @media (transform-3d), (-webkit-transform-3d)
        {
            > .item.active.right,
            > .item.next
            {
                transform: translate3d(50%, 0, 0);
                left: 0;
            }

            > .item.active.left,
            > .item.prev
            {
                transform: translate3d(-50%, 0, 0);
                left: 0;
            }

            > .item.left,
            > .item.prev.right,
            > .item.active
            {
                transform: translate3d(0, 0, 0);
                left: 0;
            }
        }

        > .active.left,
        > .prev
        {
            left: -50%;
        }

        > .active.right,
        > .next
        {
            left:  50%;
        }

        > .left,
        > .prev.right,
        > .active
        {
            left: 0;
        }

        .cloneditem-1
        {
            display: block;
        }
    }

    @media all and (min-width: 992px)
    {
        @media (transform-3d), (-webkit-transform-3d)
        {
            > .item.active.right,
            > .item.next
            {
                transform: translate3d(25%, 0, 0);
                left: 0;
            }

            > .item.active.left,
            > .item.prev
            {
                transform: translate3d(-25%, 0, 0);
                left: 0;
            }

            > .item.left,
            > .item.prev.right,
            > .item.active
            {
                transform: translate3d(0, 0, 0);
                left: 0;
            }
        }

        > .active.left,
        > .prev
        {
            left: -25%;
        }

        > .active.right,
        > .next
        {
            left:  25%;
        }

        > .left,
        > .prev.right,
        > .active
        {
            left: 0;
        }

        .cloneditem-2,
        .cloneditem-3
        {
            display: block;
        }
    }
    }
    }


    // demo setup only, not needed for carousel
    .container
       {
           margin-bottom: 50px;
       }
    body
    {
        font-family: 'Bitter', sans-serif;
        color: #E54A41;
        background-image: url('//static.rtpdesign.co.uk/blog/img/background.png');
        background-repeat: no-repeat;
        background-position: right top;
        background-size: 20%;
    }
    p
    {
        font-family: 'Open Sans', sans-serif;
        color: #333;
        margin-bottom: 2em;
    }
    h2
    {
        margin: 2em 0 1em;
    }

    .logo
    {
        margin: 20px auto;
        height: 100px;

    @media only screen and (min-width : 768px) {
        margin: 28px;
        float: left;
    }
    }

    .title
    {
        padding: 28px;
        display: table-cell;
        position: relative;
        vertical-align: middle;
        text-align: center;
    }



    /*@import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);*/
    /*.col-item*/
    /*{*/
    /*    border: 1px solid #E1E1E1;*/
    /*    border-radius: 5px;*/
    /*    background: #FFF;*/
    /*}*/
    /*.col-item .photo img*/
    /*{*/
    /*    margin: 0 auto;*/
    /*    width: 100%;*/
    /*}*/

    /*.col-item .info*/
    /*{*/
    /*    padding: 10px;*/
    /*    border-radius: 0 0 5px 5px;*/
    /*    margin-top: 1px;*/
    /*}*/

    /*.col-item:hover .info {*/
    /*    background-color: #F5F5DC;*/
    /*}*/
    /*.col-item .price*/
    /*{*/
    /*    !*width: 50%;*!*/
    /*    float: left;*/
    /*    margin-top: 5px;*/
    /*}*/

    /*.col-item .price h5*/
    /*{*/
    /*    line-height: 20px;*/
    /*    margin: 0;*/
    /*}*/

    /*.price-text-color*/
    /*{*/
    /*    color: #219FD1;*/
    /*}*/

    /*.col-item .info .rating*/
    /*{*/
    /*    color: #777;*/
    /*}*/

    /*.col-item .rating*/
    /*{*/
    /*    !*width: 50%;*!*/
    /*    float: left;*/
    /*    font-size: 17px;*/
    /*    text-align: right;*/
    /*    line-height: 52px;*/
    /*    margin-bottom: 10px;*/
    /*    height: 52px;*/
    /*}*/

    /*.col-item .separator*/
    /*{*/
    /*    border-top: 1px solid #E1E1E1;*/
    /*}*/

    /*.clear-left*/
    /*{*/
    /*    clear: left;*/
    /*}*/

    /*.col-item .separator p*/
    /*{*/
    /*    line-height: 20px;*/
    /*    margin-bottom: 0;*/
    /*    margin-top: 10px;*/
    /*    text-align: center;*/
    /*}*/

    /*.col-item .separator p i*/
    /*{*/
    /*    margin-right: 5px;*/
    /*}*/
    /*.col-item .btn-add*/
    /*{*/
    /*    width: 50%;*/
    /*    float: left;*/
    /*}*/

    /*.col-item .btn-add*/
    /*{*/
    /*    border-right: 1px solid #E1E1E1;*/
    /*}*/

    /*.col-item .btn-details*/
    /*{*/
    /*    width: 50%;*/
    /*    float: left;*/
    /*    padding-left: 10px;*/
    /*}*/
    /*.controls*/
    /*{*/
    /*    margin-top: 20px;*/
    /*}*/
    /*[data-slide="prev"]*/
    /*{*/
    /*    margin-right: 10px;*/
    /*}*/

</style>


<div class="row productmainbtn" style="display: block;">
    <div class="col-md-12">
        <a href="#" id="ordernow" class="btn btn-green btn-lg btn-block" style="width:100%"><i class="glyphicon glyphicon-shopping-cart"></i> <?= Yii::t('app', 'Order_Now') ?> </a>
    </div>
</div>

<?php if (Yii::$app->session->has('message')) : ?>
    <script type="text/javascript">
        setTimeout(function() {
            Swal.fire('<?= Yii::$app->session->get('message'); ?>');
        }, 1000);
    </script>


    <?php Yii::$app->session->remove('message'); ?>
<?php endif; ?>