<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;

use yii\widgets\Breadcrumbs;
use app\assets\MainAsset;


MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?php include ("section-client/head.php")?>
</head>

<body>
    <?php $this->beginBody() ?>
    
    <div class="wrap">
    
        <?php include ("section-client/navbar.php");?>

        <div class="container">
            <div class="loader"></div>

                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>

                <?= Alert::widget() ?>

                <?= $content ?>
            </div>
        </div>

<!--    footer-->
    <?php include ("section-client/footer.php");?>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>