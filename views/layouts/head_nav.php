<nav class="navbar navbar-default">
    <div class="container-fluid float-left">
        <ul class="nav navbar-nav pull-left">
            <li  class="menu-item <?= Yii::$app->controller->route =='profile/index'?'active':''?>">
                <?= \yii\helpers\Html::a(Yii::t('app','Profile'), ['profile/index'])?>
            </li>
        </ul>
    </div>
</nav>