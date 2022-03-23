<div id="carousel-home">
    <div class="owl-carousel owl-theme">
        <?php  foreach( $sliders as $slider  ):?>
            <div class="owl-slide cover" style="background-image: url(<?= $slider->image?>););">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-right white">
                                    <h2 class="owl-slide-animated owl-slide-title"><?= $slider->title?></h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        <?= $slider->body?>
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="<?= $slider->link?>" role="button">   <?= Yii::t('app' ,'Shop Now')?></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div id="icon_drag_mobile"></div>
</div>