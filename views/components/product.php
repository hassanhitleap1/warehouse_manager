<?php

use yii\helpers\Html;
?>
<div class="product__item">
    <div class="product__item__pic set-bg" data-setbg="<?= Yii::getAlias('@web') . "/" . $model->thumbnail ?>">
        <ul class="product__hover">
            <!-- <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                                            <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                                            </li>
                                            <li><a href="#"><img src="img/icon/search.png" alt=""></a></li> -->
        </ul>
    </div>
    <div class="product__item__text">
        <h6><?= $model->name ?></h6>

        <?= Html::a(Yii::t('app', 'Update'), ['/product/view', 'id' => $model->id], ['class' => 'add-cart']) ?>

        <div class="rating">
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
        </div>
        <h5><?= $model->purchasing_price ?> JOD</h5>
        <div class="product__color__select">
            <!-- <label for="pc-4">
                                                <input type="radio" id="pc-4">
                                            </label>
                                            <label class="active black" for="pc-5">
                                                <input type="radio" id="pc-5">
                                            </label>
                                            <label class="grey" for="pc-6">
                                                <input type="radio" id="pc-6">
                                            </label> -->
        </div>
    </div>
</div>