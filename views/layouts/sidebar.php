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

                            <li>
                                <?= Html::a(Yii::t('app','Main'), ['dashboard/index'])?>
                            </li>

                            <li>
                                <?= Html::a(Yii::t('app','The_Sales'), ['dashboard/sales'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','The_Outlay'), ['dashboard/outlay'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Best_Seller'), ['dashboard/best-seller'])?>
                            </li>
                            <li>
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
                            <li>
                                <?= Html::a(Yii::t('app','Orders'), ['orders/index'])?>
                            </li>
                            <li>
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
                            <li>
                                <?= Html::a(Yii::t('app','Products'), ['products/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','SubProductCount'), ['sub-product-count/index'])?>
                            </li>
                            <li>
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
                            <li>
                                <?= Html::a(Yii::t('app','Suppliers'), ['suppliers/index'])?>
                            </li>
                            <li>
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
                            <li>
                                <?= Html::a(Yii::t('app','Countries'), ['countries/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Regions'), ['regions/index'])?>
                            </li>
                            <li>
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
                            <li>
                                <?= Html::a(Yii::t('app','Categorises'), ['categorises/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Units'), ['units/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Status'), ['status/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Warehouse'), ['warehouse/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Company_Delivery'), ['company-delivery/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Price_Company_Delivery'), ['price-company-delivery/index'])?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Change_Password'), ['change-password/index'])?>

                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Outlays'), ['outlays/index'])?>

                            </li>
                            <li>
                                <?= Html::a(Yii::t('app','Type_Outlay'), ['type-outlay/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                        <?= Html::a( '<i class="fa fa-folder"></i><span>'.Yii::t('app','Settings').'</span>', ['settings/index'])?>

                </li>
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