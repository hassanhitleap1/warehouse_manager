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
        <div class="sidebar-header profile" type="<?= (Yii::$app->user->identity->type== User::SUPER_ADMIN)?'admin':"dataentry" ;?>">
            <div class="user-pic">
                <?php
                try {
                    $avatar=Yii::$app->user->identity->avatar;
                }catch (Exception $exception){
                    $avatar='';
                }
                ?>
                <?= Html::img($avatar, ['class' => 'img-responsive img-rounded']) ?>
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
<!--        <div class="sidebar-search">-->
<!--            <div>-->
<!--                <div class="input-group">-->
<!--                    <input type="text" class="form-control search-menu" placeholder="Search...">-->
<!--                    <div class="input-group-append">-->
<!--              <span class="input-group-text">-->
<!--                <i class="fa fa-search" aria-hidden="true"></i>-->
<!--              </span>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- sidebar-search  -->
        
        <div class="sidebar-menu">
            <ul>
<!--                <li class="header-menu">-->
<!--                    <span>General</span>-->
<!--                </li>-->
                <?php if(Yii::$app->user->identity->type == User::SUPER_ADMIN):?>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-chart-bar"></i>
                        <span><?=Yii::t('app','Statistics')?></span>
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
                <?php endif;?>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span><?=Yii::t('app','Orderss')?></span>
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
                <?php if(Yii::$app->user->identity->type == User::SUPER_ADMIN):?>
                <li>
                    <?= Html::a('<i class="fab fa-product-hunt"></i>'.Yii::t('app','Products'), ['products/index'])?>

                </li>


                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-users"></i>
                        <span><?=Yii::t('app','Users')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->id =='suppliers'?'active':''?>">
                                <?= Html::a(Yii::t('app','Suppliers'), ['suppliers/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='users'?'active':''?>">
                                <?= Html::a(Yii::t('app','Users'), ['users/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='customers'?'active':''?>">
                                <?= Html::a(Yii::t('app','Customers'), ['customers/index'])?>
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
                            <li  class="menu-item <?= Yii::$app->controller->id =='countries'?'active':''?>">
                                <?= Html::a(Yii::t('app','Countries'), ['countries/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='regions'?'active':''?>">
                                <?= Html::a(Yii::t('app','Regions'), ['regions/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='area'?'active':''?>">
                                <?= Html::a(Yii::t('app','Area'), ['area/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>
<!--                <li class="header-menu">-->
<!--                    <span>--><?//= Yii::t('app', 'Additional')?><!--</span>-->
<!--                </li>-->
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-globe"></i>
                        <span><?=Yii::t('app','Additional')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->id =='categorises'?'active':''?>">
                                <?= Html::a(Yii::t('app','Categorises'), ['categorises/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='units'?'active':''?>">
                                <?= Html::a(Yii::t('app','Units'), ['units/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='status'?'active':''?>">
                                <?= Html::a(Yii::t('app','Status'), ['status/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='warehouse'?'active':''?>">
                                <?= Html::a(Yii::t('app','Warehouse'), ['warehouse/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='company-delivery'?'active':''?>">
                                <?= Html::a(Yii::t('app','Company_Delivery'), ['company-delivery/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='price-company-delivery'?'active':''?>">
                                <?= Html::a(Yii::t('app','Price_Company_Delivery'), ['price-company-delivery/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='change-password'?'active':''?>">
                                <?= Html::a(Yii::t('app','Change_Password'), ['change-password/index'])?>

                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='outlays'?'active':''?>">
                                <?= Html::a(Yii::t('app','Outlays'), ['outlays/index'])?>

                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->id =='type-outlay'?'active':''?>">
                                <?= Html::a(Yii::t('app','Type_Outlay'), ['type-outlay/index'])?>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-cogs"></i>
                        <span><?=Yii::t('app','Settings')?></span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li  class="menu-item <?= Yii::$app->controller->route =='settings/index'?'active':''?>">
                                <?= Html::a(Yii::t('app','Settings'), ['settings/index'])?>
                            </li>
                            <li  class="menu-item <?= Yii::$app->controller->route =='settings/theme'?'active':''?>">
                                    <?= Html::a(Yii::t('app','Theme_Settings'), ['settings/theme'])?>
                            </li>
                        </ul>
                    </div>
                </li>


                <?php endif;?>
            </ul>
        </div>
        <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
        <a href="#">
            <?=
            Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton('',["class"=>"btn-danger fa fa-power-off"]

            )
            . Html::endForm()
            ?>

        </a>
    </div>
</nav>