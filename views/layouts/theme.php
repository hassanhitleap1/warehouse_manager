<?php

$path_theme= Yii::getAlias('@web').'theme/shop/'
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">


<head>
    <meta charset="<?= Yii::$app->charset ?>">
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
	
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="<?= $path_theme?>css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="<?= $path_theme?>css/style.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    <link href="<?= $path_theme?>css/product_page.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?= $path_theme?>css/custom.css" rel="stylesheet">







    <?php $this->registerCsrfMetaTags() ?>

    <?php $this->head() ?>
   

</head>



<body>
<?php $this->beginBody() ?>
	<div id="page">
    <div class="loader"></div>
    <?php include  ("app/header.php") ?>
	<!-- /header -->

    

    <?= $content ?>
	<!-- /main -->
	
    <?php include("app/footer.php")?>
	<!--/footer-->
	</div>
	<!-- page -->
	
    <div class="top_panel">
        <div class="container header_panel">
            <a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
            <small><?= Yii::t('app','What are you looking for?') ?></small>
        </div>
        <!-- /header_panel -->

        <div class="container">
            <form  method="get" action="index.php?r=site/shop">
                 <div class="search-input">
                    <input type="text" name="q" placeholder="<?= Yii::t('app','Search') ?>">
                    <button type="submit"><i class="ti-search"></i></button>
                </div> 
            </form>
            

        </div>
        <!-- /related -->
    </div>


	<!-- /add_cart_panel -->

	
 	<!-- COMMON SCRIPTS -->
    <script src="<?= $path_theme ?>js/common_scripts.min.js"></script>
    <script src="<?= $path_theme ?>js/main.js"></script>
  
    <!-- SPECIFIC SCRIPTS -->
    <script  src="<?= $path_theme ?>js/carousel_with_thumbs.js"></script>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

