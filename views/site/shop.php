<?php
$path_theme = Yii::getAlias('@web') . 'theme/shop/' ?>


<link href="<?= $path_theme ?>css/listing.css" rel="stylesheet">

<main>
    <div class="container margin_30">
        <div class="row">
            <div class="col-lg-9">
                <div class="top_banner">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                        <div class="container pl-lg-5">
                            <h1><?= Yii::t('app','Shop')?></h1>
                        </div>
                    </div>
                    <img src="img/bg_cat_shoes.jpg" class="img-fluid" alt="">
                </div>
                <!-- /top_banner -->
                <div id="stick_here"></div>
                <div class="toolbox elemento_stick add_bottom_30">
                    <div class="container">

                    </div>
                </div>
                <!-- /toolbox -->
                <div class="row small-gutters">

                    <?php foreach ($models as $model):?>
                        <?= $this->render('@app/views/components/shop_product', ['model' => $model]); ?>
                    <?php endforeach;?>

                </div>
                <!-- /row -->
                <div class="pagination__wrapper">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'prevPageLabel' => false,
                        'nextPageLabel' => false,
                        'maxButtonCount'=>2,
                    ]); ?>

                </div>
            </div>
            <!-- /col -->

            <aside class="col-lg-3" id="sidebar_fixed">
                <div class="filter_col">
                    <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
                    <?php $form = \yii\widgets\ActiveForm::begin([ 'method' => 'get' ,'action' => 'index.php?r=site%2Fshop']); ?>
                            <div class="filter_type version_2">
                                <h4><a href="#filter_1" data-toggle="collapse" class="opened"><?= Yii::t('app','Categories')?></a></h4>
                                <div class="collapse show" id="filter_1">


                                    <ul>
                                        <?php foreach ($catigories as $catgory):?>
                                            <li>
                                                <label class="container_check"><?= $catgory->name_ar?></small>
                                                    <input type="checkbox" name="categories[]"  <?= isset($_GET['categories']) && in_array($catgory->id ,$_GET['categories']) ? 'checked':''  ?>  value="<?= $catgory->id ?>">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        <?php endforeach;;?>

                                    </ul>
                                </div>
                                <!-- /filter_type -->
                            </div>
                            <!-- /filter_type -->
                            <div class="buttons">
                                <button  class="btn_1"><?= Yii::t('app','Filter')?></button>
                                <a href="<?= \yii\helpers\Url::to(['/site/shop']) ?>" class="btn_1 gray"> <?= Yii::t('app','Reset')?></a>
                            </div>
                    <?php \yii\widgets\ActiveForm::end(); ?>
                </div>
            </aside>

            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>



