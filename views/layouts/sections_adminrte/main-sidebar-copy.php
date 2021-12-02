<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a  class="brand-link">
        <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->user->identity->name?> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo  Yii::$app->request->baseUrl;?>/theme/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">><?= Yii::$app->user->identity->name?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?=Yii::t('app','Dashboard')?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Url::to('dashboard/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='dashboard/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Main')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('dashboard/sales')?>" class="nav-link
                                <?= Yii::$app->controller->route =='dashboard/sales'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','The_Sales')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to('dashboard/outlay')?>" class="nav-link
                                <?= Yii::$app->controller->route =='dashboard/outlay'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','The_Outlay')?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to('dashboard/best-seller')?>" class="nav-link
                                <?= Yii::$app->controller->route =='dashboard/best-seller'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Best_Seller')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('dashboard/orders')?>" class="nav-link
                                <?= Yii::$app->controller->route =='dashboard/orders'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','The_Orders')?></p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?=Yii::t('app','Orders')?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Url::to('orders/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='orders/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Orders')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('orders/create')?>" class="nav-link
                                <?= Yii::$app->controller->route =='orders/create'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Create_Order')?></p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?=Yii::t('app','Products')?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Url::to('products/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='products/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Products')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('sub-product-count/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='sub-product-count/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','SubProductCount')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('options-sell-product/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='options-sell-product/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Type_Options')?></p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?=Yii::t('app','Users')?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Url::to('suppliers/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='suppliers/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Suppliers')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('users/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='users/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Users')?></p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?=Yii::t('app','Users')?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Url::to('countries/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='countries/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Countries')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('regions/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='regions/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Regions')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('area/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='area/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Area')?></p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            <?=Yii::t('app','Additional')?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Url::to('categorises/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='categorises/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Categorises')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('units/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='units/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Units')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('status/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='status/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Status')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('warehouse/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='warehouse/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Warehouse')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('company-delivery/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='company-delivery/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Company_Delivery')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('price-company-delivery/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='price-company-delivery/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Price_Company_Delivery')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('change-password/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='change-password/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Change_Password')?></p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= Url::to('outlays/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='outlays/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Outlays')?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to('type-outlay/index')?>" class="nav-link
                                <?= Yii::$app->controller->route =='type-outlay/index'?'active':''?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?=Yii::t('app','Type_Outlay')?></p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= Url::to('settings/index')?>"  class="nav-link <?= Yii::$app->controller->route =='settingss/index'?'active':''?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p><?=Yii::t('app','Settings')?></p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>