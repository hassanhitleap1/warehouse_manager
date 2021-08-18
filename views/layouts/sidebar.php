<?php

use app\models\User;use yii\helpers\Html;

?>
<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="#"><?= Yii::$app->user->identity->username?></a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                     alt="User picture">
            </div>
            <div class="user-info">
          <span class="user-name">
            <strong><?= Yii::$app->user->identity->name?></strong>
          </span>
                <span class="user-role"><?= (Yii::$app->user->identity->type== User::SUPER_ADMIN)?'مدير':"مدخل بيانات" ;?></span>
                <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>متصل</span>
          </span>
            </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-search">
            <div>
                <div class="input-group">
                    <input type="text" class="form-control search-menu" placeholder="Search...">
                    <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>General</span>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-tachometer-alt"></i>
                        <span><?=Yii::t('app','Dashboard')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>

                            <li  class="menu-item <?= Yii::$app->controller->route =='dashboard/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Main'), ['dashboard/index'])?>
                            </li>

                            <li  class="menu-item <?= Yii::$app->controller->route =='dashboard/sales'?'active':''?>">
                                <?= Html::a(Yii::t('app','The_Sales'), ['dashboard/sales'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='dashboard/outlay'?'active':''?>">
                                <?= Html::a(Yii::t('app','The_Outlay'), ['dashboard/outlay'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='dashboard/best-seller'?'active':''?>">
                                <?= Html::a(Yii::t('app','Best_Seller'), ['dashboard/best-seller'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='dashboard/orders'?'active':''?>">
                                <?= Html::a(Yii::t('app','The_Orders'), ['dashboard/orders'])?>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span><?=Yii::t('app','Orders')?></span>
<!--                        <span class="badge badge-pill badge-danger">3</span>-->
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->route =='orders/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Orders'), ['orders/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='orders/create'?'active':''?>">
                                <?= Html::a(Yii::t('app','Create_Order'), ['orders/create'])?>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="far fa-gem"></i>
                        <span><?=Yii::t('app','Products')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->route =='products/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Products'), ['products/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='sub-product-count/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','SubProductCount'), ['sub-product-count/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='options-sell-product/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Type_Options'), ['options-sell-product/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-chart-line"></i>
                        <span><?=Yii::t('app','Users')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->route =='suppliers/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Suppliers'), ['suppliers/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='users/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Users'), ['users/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-globe"></i>
                        <span><?=Yii::t('app','Countries')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->route =='countries/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Countries'), ['countries/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='regions/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Regions'), ['regions/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='area/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Area'), ['area/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="header-menu">
                    <span><?= Yii::t('app', 'Additional')?></span>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-globe"></i>
                        <span><?=Yii::t('app','Additional')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->route =='categorises/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Categorises'), ['categorises/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='units/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Units'), ['units/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='status/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Status'), ['status/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='warehouse/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Warehouse'), ['warehouse/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='company-delivery/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Company_Delivery'), ['company-delivery/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='price-company-delivery/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Price_Company_Delivery'), ['price-company-delivery/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='change-password/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Change_Password'), ['change-password/index'])?>

                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='outlays/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Outlays'), ['outlays/index'])?>

                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='type-outlay/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Type_Outlay'), ['type-outlay/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                        <?= Html::a( '<i class="fa fa-folder"></i><span>'.Yii::t('app','Settings').'</span>', ['settings/index'])?>

                </li>

                <?= '<li class="fa fa-folder ">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                    '( ' . Yii::t('app', 'Logout') . ' ' . Yii::$app->user->identity->username . ') '

                    )
                    . Html::endForm()
                    . '</li>';?>
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
        <a href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-pill badge-warning notification">3</span>
        </a>
        <a href="#">
            <i class="fa fa-envelope"></i>
            <span class="badge badge-pill badge-success notification">7</span>
        </a>
        <a href="#">
            <i class="fa fa-cog"></i>
            <span class="badge-sonar"></span>
        </a>
        <a href="#">
            <i class="fa fa-power-off"></i>
        </a>
    </div>
</nav>