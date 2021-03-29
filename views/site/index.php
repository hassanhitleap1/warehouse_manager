<?php

/* @var $this yii\web\View */

$this->title = 'روند';

use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="container">

	<div class="row" id="list-products">
		<?php foreach ($models as  $key => $model) : ?>

			<div class="col-md-4">

				<div class="card" onclick="window.location.href = '<?= 'index.php?r=product/view&id='.$model->id?>'">
					<?= Html::img($model->thumbnail, ['style' => 'width:100%']) ?>
					<h1><?= $model->name ?></h1>
					<p class="price">$<?= $model->selling_price ?></p>
					<p><?= $model->description ?>.</p>
					<p><?= Html::a(Yii::t('app', 'More_Info') . ' <span class="glyphicon glyphicon-eye-open" ></span>', ['product/view', 'id' => $model->id], ['class' => 'btn  btn-green']); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

</div>