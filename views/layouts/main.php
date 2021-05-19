<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\MainAsset;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

<body>
    <?php $this->beginBody() ?>
    
    <div class="wrap">
    
        <?php

        $menuItemsleft = [];
        $menuItems = [];

        NavBar::begin([
            //'brandLabel' => Html::img('@web/images/logo.svg'),
            // 'brandLabel' => Yii::$app->name ,
            'brandLabel' => '<div>' . Yii::$app->name . Html::img('@web/images/logo.png', ['class' => 'logo']) . '</div>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        if (Yii::$app->user->isGuest) {
            $menuItemsleft[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/index']];
            $menuItems[] = [
                'label' => Yii::t('app', 'Countries'),
                'items' => [
                    ['label' => Yii::t('app', 'Countries'), 'url' => ['/countries/index']],
                    ['label' => Yii::t('app', 'Regions'), 'url' => ['/regions/index']],
                    ['label' => Yii::t('app', 'Area'), 'url' => ['/area/index']],

                ],
            ];

            $menuItems[] = [
                'label' => Yii::t('app', 'Additional'),
                'items' => [
                    ['label' => Yii::t('app', 'Categorises'), 'url' => ['/categorises/index']],
                    ['label' => Yii::t('app', 'Units'), 'url' => ['/units/index']],
                    ['label' => Yii::t('app', 'Status'), 'url' => ['/status/index']],
                    ['label' => Yii::t('app', 'Warehouse'), 'url' => ['/warehouse/index']],
                    ['label' => Yii::t('app', 'Company_Delivery'), 'url' => ['/company-delivery/index']],
                    ['label' => Yii::t('app', 'Price_Company_Delivery'), 'url' => ['/price-company-delivery/index']],
                    ['label' => Yii::t('app', 'Settings'), 'url' => ['/settings/index']],

                ],
            ];

            $menuItems[] = [
                'label' => Yii::t('app', 'Users'),
                'items' => [
                    ['label' => Yii::t('app', 'Suppliers'), 'url' => ['/suppliers/index']],
                    ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']],

                ],
            ];

            $menuItems[] = [
                'label' => Yii::t('app', 'Products'),
                'items' => [
                    ['label' => Yii::t('app', 'Products'), 'url' => ['/products/index']],
                    ['label' => Yii::t('app', 'SubProductCount'), 'url' => ['/sub-product-count/index']],
                    ['label' => Yii::t('app', 'Type_Options'), 'url' => ['/options-sell-product/index']],


                ],
            ];


            $menuItems[] = ['label' => Yii::t('app', 'Orders'), 'url' => ['/orders/index']];

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '( ' . Yii::t('app', 'Logout') . ' ' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItemsleft,
        ]);
        NavBar::end();
        ?>


        <div class="container">
        <div class="loader"></div>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
           
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Yii::$app->name . ' ' . date('Y') ?></p>

        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>