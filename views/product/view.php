<?php

use yii\helpers\Html;




$this->title = $model->name;

?>
<div class="container">
        <?= Html::img($model->thumbnail,['class'=>'thumbnail','width'=>'100','height'=>'400'])?>
    <?php foreach($model->imagesProduct as $img):?>
        <?= Html::img($img->path,['width'=>'300','height'=>'200'])?>
    <?php endforeach;?>

    <iframe width="500" height="350" src="<?= str_replace('watch?v=','embed/',$model->video_url)?>">  </iframe> 
    <!-- https://www.youtube.com/watch?v=JLiOmeU3s-E -->

    
    
</div>
