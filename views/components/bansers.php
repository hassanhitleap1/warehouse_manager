<ul id="banners_grid" class="clearfix">
    <?php foreach($bansers  as  $key => $banser):?>
        <li>
            <a href="<?= $banser->link ?>" class="img_container">
                <?= \yii\helpers\Html::img($banser->image,['class'=>"lazy",'data-src'=>$banser->image])?>
                <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <h3><?= $banser->title?> </h3>
                    <div><span class="btn_1"><?=Yii::t('app','Shop Now')?></span></div>
                </div>
            </a>
        </li>
    <?php endforeach; ?>

</ul>