<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
use yii\helpers\Html;
?>
  <div class="container">
            <div class="row">

			<?php foreach ($models as  $key => $model) : ?>
				<div class="col-md-6 col-sm-6  animate__animated animate__bounce animate__repeat-1" >
                    <div class="product-grid">
                        <div class="product-image">
                            <a href="#" class="image">
								<?= Html::img($model->thumbnail, ['class' => 'pic-1']) ?>
								<?= Html::img($model->thumbnail, ['class' => 'pic-2']) ?>
                                
                            </a>
                            <a href="#" class="product-like-icon" data-tip="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </a>
                            <ul class="product-links">
                                <li><a href="#"><i class="fa fa-search"></i></a></li>
                                <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                <li><a href="#"><i class="fa fa-random"></i></a></li>
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
        </div>

