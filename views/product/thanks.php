<?php


$this->title = Yii::t('app', 'Successfuly_Applay');

?>
<div class="container">


    <div class="thanck-continaer">
        <p>
            <?= Yii::t('app', 'Success_For_Name') . ' ' . $model->name; ?>
        </p>
        <p>
            <?= Yii::t('app', 'Order_Price_Total') . ' ' . $model->total_price . " JOD"; ?>
        </p>
        <p>
            <?= Yii::t('app', 'Order_Conected') ?><br />
        </p>



        <p>
            <?= Yii::t('app', 'See_Other_Product') ?>
        </p>

    </div>



</div>



<script type="text/javascript">
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '<?= Yii::$app->params['facebook_id'] ?>');
    fbq('track', 'Purchase', {
        currency: "USD",
        value: 10.00
    });

    snaptr('track', 'PURCHASE');
</script>