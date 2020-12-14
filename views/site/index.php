<?php

/* @var $this yii\web\View */

$this->title = 'روند';
use yii\widgets\LinkPager;
use yii\helpers\Html;
?>
<div class="container">
    
    <div class="row">
		<?php foreach ($models as  $key => $model) : ?>
            <div class="col-md-4>
                <div class="panel-group">
                  <div class="panel panel-primary">
                    <div class="panel-body"><?= $model->name?></div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-body">
                          <?= Html::img($model->thumbnail)?>
                    </div>
                    <div class="panel-footer">
                     </div>                      
                  </div>
                </div>
           </div>
        <?php endforeach; ?>
    </div>    
    <div class="row">
		<?= LinkPager::widget([
			'pagination' => $pages,
		]); ?>
	</div>
</div>
