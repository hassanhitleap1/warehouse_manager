<?php

/* @var $this yii\web\View */

$this->title = 'روند';
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="container">
    
    <div class="row">
		<?php foreach ($models as  $key => $model) : ?>
        <div class="col-md-4">
			<a href="<?= Url::toRoute(['product/view','id' => $model->id])?>"> 
			<div class="panel panel-primary ">
				<div class="panel-heading product-name"><?= $model->name?></div>
					<div class="panel-body">
						<?= Html::img($model->thumbnail,['class'=>'thumbnail','width'=>'400','height'=>'200'])?>
					</div>
					<div class="panel-footer">
                            <div class="row">
                                <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-xs-offset-5">
                                    <?= Html::a(Yii::t('app','More_Info') .' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view','id' => $model->id], ['class' => 'btn  btn-green']);?>
                                </div>

                            </div>

					</div>   
			</div> 
		    </a>
        </div>
        <?php endforeach; ?>
    </div>    
    <div class="row">
		<?= LinkPager::widget([
			'pagination' => $pages,
		]); ?>
	</div>
</div>
