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
    </div>
</div>


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