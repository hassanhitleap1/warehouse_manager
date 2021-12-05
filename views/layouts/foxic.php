
<?php

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Foxic HTML Template - Index Page - Layout 4</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <link  href="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/css/vendor/bootstrap.min.css" rel="stylesheet">
    <link  href="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/css/vendor/vendor.min.css" rel="stylesheet">
    <link  href="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/css/style-sport.css" rel="stylesheet">
    <link  href="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/fonts/icomoon/icons.css" rel="stylesheet">
    <link  href="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap" rel="stylesheet">


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Snap Pixel Code -->
    <script type='text/javascript'>
        (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
        {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
            a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
            r.src=n;var u=t.getElementsByTagName(s)[0];
            u.parentNode.insertBefore(r,u);})(window,document,
            'https://sc-static.net/scevent.min.js');

        snaptr('init', '<?=Yii::$app->params['sanpchat_id']?>' , {
            'user_email': '<?=Yii::$app->params['sanpchat_email']?>'
        });

        snaptr('track', 'PAGE_VIEW');

    </script>
    <!-- End Snap Pixel Code -->

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?=Yii::$app->params['facebook_id']?>' );
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=<?=Yii::$app->params['facebook_id']?>&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->


    <!-- TikTok Pixel Code Start -->
    <script>
        !function (w, d, t) {
            w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
            ttq.load('<?=Yii::$app->params['tiktok_id']?>');
            ttq.page();
        }(window, document, 'ttq');
    </script>
    <!-- TikTok Pixel Code End -->



</head>

<body class="has-smround-btns has-loader-bg equal-height">
<?php $this->beginBody() ?>


<?= include ("foxic/header.php");?>





<div class="page-content">

    <div class="holder holder-mt-xsmall">
        <div class="container-fluid px-0">
            <div class="row grid vert-margin-small">
                <div class="col-18 col-md-up-quarter">
                    <a href="product.html" class="bnr-wrap">
                        <div class="bnr shop-feature-title-lgimage-hover-scale bnr--center bnr--middle" data-fontratio=8.7>
                            <div class="bnr-img  image-container" style="color:#fff; padding-bottom: 99.57%">
                                <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/banners/banner-index-15.webp" class="lazyload fade-up" alt="">
                            </div>
                            <div class="bnr-caption">
                                <div class="bnr-text3 heading-font mt-0 order-1" style="color:#fff; font-size:0.75em; font-weight:800; line-height:1.2em">HOME<br>FITNESS!</div>
                                <div class="bnr-text3 heading-font mt-sm order-2" style="color:#fff; font-size:0.4em; font-weight:400; line-height:1em;">Starting at $6.99</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-18 col-md-up-quarter order-md-last">
                    <a href="product.html" class="bnr-wrap">
                        <div class="bnr shop-feature-title-lgimage-hover-scale bnr--center bnr--middle" data-fontratio=8.7>
                            <div class="bnr-img  image-container" style="color:#fff; padding-bottom: 99.57%">
                                <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/banners/banner-index-16.webp" class="lazyload fade-up" alt="">
                            </div>
                            <div class="bnr-caption">
                                <div class="bnr-text3 heading-font mt-0 order-1" style="color:#fff; font-size:0.4em; font-weight:400; line-height:1em;">Up To 60% OFF</div>
                                <div class="bnr-text3 heading-font mt-sm order-2" style="color:#fff; font-size:0.75em; font-weight:800; line-height:1.2em">LAST<br>CHANCE</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-18 col-md-9 d-none d-md-block">
                    <div class="lazyload fade-up bg-cover w-100 h-100" data-bgset="images/banners/banner-index-17.webp">
                        <div class="bnr-categories">
                            <h3 class="bnr-categories-title">SPORTS FOOTWEAR</h3>
                            <div class="row">
                                <div class="col-sm-auto">
                                    <ul class="bnr-categories-list">
                                        <li><a href="#">Court & Indoor trainers</a></li>
                                        <li><a href="#">Cycling Shoes</a></li>
                                        <li><a href="#">Equestrian Boots</a></li>
                                        <li><a href="#">Fitness Trainers</a></li>
                                        <li><a href="#">Football Boots</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-auto">
                                    <ul class="bnr-categories-list">
                                        <li><a href="#">Golf Shoes</a></li>
                                        <li><a href="#">Running Shoes</a></li>
                                        <li><a href="#">Walking Boots & Shoes</a></li>
                                        <li><a href="#">Tennis Shoes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="title-wrap text-center"><h2 class="h1-style">NEW ARRIVAL</h2>
                <div class="h-sub maxW-825">Hurry up! Limited</div>
            </div>
            <div class="prd-grid-wrap position-relative">
                <div class="prd-grid data-to-show-5 data-to-show-lg-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-2 js-category-grid" data-grid-tab-content>
                    <div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-01.webp" alt="Legging Red/Black" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                        <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                            <div class="countdown-circle">
                                                <div class="countdown js-countdown" data-countdown="2021/07/01"></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                    <div class="colorswatch-label colorswatch-label--variants js-prd-colorswatch">
                                        <i class="icon-palette"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                                        <ul>
                                            <li data-image="images/products/product-01.webp"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/colorswatch/color-red.html" alt=""></a></li>
                                            <li data-image="images/products/product-01-1.webp"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/colorswatch/color-mint.html" alt=""></a></li>
                                            <li data-image="images/products/product-01-2.webp"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/colorswatch/color-violet.html" alt=""></a></li>
                                            <li data-image="images/products/product-01-3.webp"><a class="js-color-toggle" data-toggle="tooltip" data-placement="left" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/colorswatch/color-green.html" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <ul class="list-options color-swatch">
                                    <li data-image="images/products/product-01.webp" class="active"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-01.webp" class="lazyload fade-up" alt="Color Name"></a></li>
                                    <li data-image="images/products/product-01-1.webp"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-01-1.webp" class="lazyload fade-up" alt="Color Name"></a></li>
                                    <li data-image="images/products/product-01-2.webp"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-01-2.webp" class="lazyload fade-up" alt="Color Name"></a></li>
                                    <li data-image="images/products/product-01-3.webp"><a href="#" class="js-color-toggle" data-toggle="tooltip" data-placement="right" title="Color Name"><img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-01-3.webp" class="lazyload fade-up" alt="Color Name"></a></li>
                                </ul>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Legging Red/Black</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-old">$ 200</div>
                                        <div class="price-new">$ 180</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Legging Red/Black", "path":"images/products/product-01.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-06.webp" alt="Fitness Jumpsuit Camouflage" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                        <div class="label-new"><span>New</span></div>
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Fitness Jumpsuit Camouflage</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 180</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Fitness Jumpsuit Camouflage", "path":"images/products/product-06.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-07.webp" alt="Fitness Jumpsuit Black" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Fitness Jumpsuit Black</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 180</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Fitness Jumpsuit Black", "path":"images/products/product-07.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-03.webp" alt="Striped Leggings and Top" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                        <div class="label-sale"><span>-50% <span class="sale-text">Sale</span></span>
                                        </div>
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Striped Leggings and Top</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-old">$ 149</div>
                                        <div class="price-new">$ 299</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Striped Leggings and Top", "path":"images/products/product-03.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-04.webp" alt="Fitness Jumpsuit" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Fitness Jumpsuit</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 280</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Fitness Jumpsuit", "path":"images/products/product-04.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-05.webp" alt="Fitness Jumpsuit Khaki/Black" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                        <div class="label-sale"><span>-10% <span class="sale-text">Sale</span></span>
                                        </div>
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Fitness Jumpsuit Khaki/Black</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-old">$ 200</div>
                                        <div class="price-new">$ 180</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Fitness Jumpsuit Khaki/Black", "path":"images/products/product-05.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-14.webp" alt="Active Sports Black Shirt" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Active Sports Black Shirt</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 159</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Active Sports Black Shirt", "path":"images/products/product-14.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-15.webp" alt="Demi Puffer Jacket" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Demi Puffer Jacket</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 389</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Demi Puffer Jacket", "path":"images/products/product-15.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-20.webp" alt="Winter Puffer Jacket" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Winter Puffer Jacket</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 359</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Winter Puffer Jacket", "path":"images/products/product-20.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="prd ">
                        <div class="prd-inside">
                            <div class="prd-img-area">
                                <a href="product.html" class="prd-img image-hover-scale image-container">
                                    <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/images/products/product-18.webp" alt="Jumpsuit with a hood" class="js-prd-img lazyload">
                                    <div class="foxic-loader"></div>
                                    <div class="prd-big-circle-labels">
                                    </div>
                                </a>
                                <div class="prd-circle-labels">
                                    <a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a>
                                    <a href="#" class="circle-label-qview js-prd-quickview prd-hide-mobile" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a>
                                </div>
                            </div>
                            <div class="prd-info">
                                <div class="prd-info-wrap">
                                    <div class="prd-info-top">
                                        <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                        <div class="prd-tag"><a href="#">FOXic</a></div>
                                    </div>
                                    <h2 class="prd-title"><a href="product.html">Jumpsuit with a hood</a></h2>
                                    <div class="prd-description">
                                        Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante sed lacinia.
                                    </div>
                                </div>
                                <div class="prd-hovers">
                                    <div class="prd-circle-labels">
                                        <div><a href="#" class="circle-label-compare circle-label-wishlist--add js-add-wishlist mt-0" title="Add To Wishlist"><i class="icon-heart-stroke"></i></a><a href="#" class="circle-label-compare circle-label-wishlist--off js-remove-wishlist mt-0" title="Remove From Wishlist"><i class="icon-heart-hover"></i></a></div>
                                        <div><a href="#" class="circle-label-qview prd-hide-mobile js-prd-quickview" data-src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/ajax/ajax-quickview.html"><i class="icon-eye"></i><span>QUICK VIEW</span></a></div>
                                    </div>
                                    <div class="prd-price">
                                        <div class="price-new">$ 189</div>
                                    </div>
                                    <div class="prd-action">
                                        <div class="prd-action-left">
                                            <form action="#">
                                                <button class="btn js-prd-addtocart" data-product='{"name": "Jumpsuit with a hood", "path":"images/products/product-18.webp", "url":"product.html", "aspect_ratio":0.778}'>Add To Cart</button>
                                            </form>
                                        </div>
                                        <div class="prd-action-right">
                                            <div class="prd-action-right-inside">
                                                <div class="prd-tag"><a href="#">FOXic</a></div>
                                                <div class="prd-rating"><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i><i class="icon-star-fill fill"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="text-icn-blocks-bg-row">
                <div class="text-icn-block-bg">
                    <div class="icn">
                        <i class="icon-delivery-truck"></i>
                    </div>
                    <div class="text">
                        <h4>Fast Shipping</h4>
                        <p>We will help you send your wishes to your loved ones. We drive to save time.</p>
                    </div>
                </div>
                <div class="text-icn-block-bg">
                    <div class="icn">
                        <i class="icon-return"></i>
                    </div>
                    <div class="text">
                        <h4>Easy Return</h4>
                        <p>Items must be returned within 30 Days from date of delivery in its original condition</p>
                    </div>
                </div>
                <div class="text-icn-block-bg">
                    <div class="icn">
                        <i class="icon-call-center"></i>
                    </div>
                    <div class="text">
                        <h4>24/7 Customer Support </h4>
                        <p>Customer support is not a service, it’s an attitude. Making every conversation count.</p>
                    </div>
                </div>
                <div class="text-icn-block-bg">
                    <div class="icn">
                        <i class="icon-tag"></i>
                    </div>
                    <div class="text">
                        <h4>Best price</h4>
                        <p>A price match guarantee for best prices on all our products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="form-card-bg">
                <h2 class="text-center">WRITE TO US</h2>
                <div class="form-wrapper">
                    <form class="contact-form" id="contactForm">
                        <div class="form-confirm">
                            <div class="success-confirm">
                                Thanks! Your message has been sent.
                            </div>
                            <div class="error-confirm">
                                Oops! There was an error submitting form. Refresh and send again.
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row vert-margin-middle">
                                <div class="col-lg">
                                    <input type="text" name="username" class="form-control"  placeholder="Name" required>
                                </div>
                                <div class="col-lg">
                                    <input type="text" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-lg">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control textarea--height-170" name="message" placeholder="Message" required></textarea>
                        </div>
                        <div class="text-center mt-0">
                            <button class="btn btn-submit" type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="contact-map-under-form">
            <iframe src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2201.3258493677126!2d-74.01291322172017!3d40.70657451080482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sua!4v1492962272380"></iframe>
        </div>
    </div>

</div>

<?= include ("foxic/footer.php");?>




<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/vendor-special/lazysizes.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/vendor-special/ls.bgset.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/vendor-special/ls.aspectratio.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/vendor-special/jquery.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/vendor-special/jquery.ez-plus.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/vendor/vendor.min.js"></script>
<script src="<?php echo  Yii::$app->request->baseUrl;?>/theme/foxic/js/app-html.js"></script>



<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
