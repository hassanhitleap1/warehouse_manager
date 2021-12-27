<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
use yii\helpers\Html;
?>


<div class="container">
    <div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(https://static.wixstatic.com/media/a45867_b3fedc3730f84151a6aaf6b5dc4d6f8b~mv2.jpg/v1/fill/w_1065,h_415,al_c,q_85,usm_0.66_1.00_0.01/a45867_b3fedc3730f84151a6aaf6b5dc4d6f8b~mv2.webp);">
        <h1 class="mb-4">
            تسوق بذكاء
        </h1>

        <a href="#list-products" class="btn btn-primary">تسوق الان   </a>
    </div>

</div>

<div class="container">

    <div class="row " id="list-products">
        <?php foreach ($models as  $key => $model) : ?>
            <div class="col-md-4 col-sm-6 card-product  animate__animated animate__bounce animate__repeat-1" >
                <div class="product-grid">
                    <div class="product-image">
                        <a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>" class="image">
                            <?= Html::img($model->thumbnail, ['class' => 'pic-1']) ?>
                            <?php if(count($model->imagesProduct)): ?>
                                <?= Html::img($model->imagesProduct[0]['path'], ['class' => 'pic-2']) ?>
                            <?php else: ?>
                                <?= Html::img($model->thumbnail, ['class' => 'pic-2']) ?>
                            <?php endif ?>


                        </a>
                        <a href="#" class="product-like-icon" data-tip="Add to Wishlist">
                            <i class="far fa-heart"></i>
                        </a>
                        <ul class="product-links">
                            <li><a href="<?= \yii\helpers\Url::to(['/product/view','id'=>$model->id]) ?>"><i class="fa fa-search"></i></a></li>
                            <!-- <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                            <li><a href="#"><i class="fa fa-random"></i></a></li> -->
                        </ul>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#"><?= $model->name ?></a></h3>
                        <div class="price"><?= $model->selling_price ?> JD</div>
                    </div>
                </div>
            </div>


        <?php endforeach; ?>
    </div>

    <a  class="whats-app" href="https://api.whatsapp.com/send?phone=<?=Yii::$app->params['phone']?>&text=أرجو الاتصال بي" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
</div>

