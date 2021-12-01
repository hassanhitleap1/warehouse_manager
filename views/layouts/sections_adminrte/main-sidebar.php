<?php
use yii\helpers\Html;
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

                            <?= Html::a('<i class="far fa-circle nav-icon"></i>
                                <p>'. Yii::t('app','Main').'</p>',
                                ['dashboard/index'] ,['class'=> function(){
                                    return (Yii::$app->controller->route=='dashboard/index')?'nav-link active':'nav-link';
                                }])
                            ?>
                        </li>


                        <li class="nav-item">
                            <?= Html::a('<i class="far fa-circle nav-icon"> </i> 
                                <p> '.Yii::t('app','Main').'</p>',
                                ['dashboard/index'], ['class'=>"nav-link " .Yii::$app->controller->route =='dashboard/index'?'active':''] )
                            ?>
                        </li>

                        <li class="nav-item">
                            <?= Html::a('<i class="far fa-circle nav-icon"> </i> 
                                <p> '.Yii::t('app','Dashboard').'</p>',
                                ['dashboard/orders'], ['class'=>"nav-link ".Yii::$app->controller->route =='dashboard/orders'?'active':''] )
                            ?>
                        </li>


                        <li class="nav-item">
                            <?= Html::a('<i class="far fa-circle nav-icon"> </i> 
                                <p> '.Yii::t('app','The_Outlay').'</p>',
                                ['dashboard/outlay'], ['class'=>"nav-link" .Yii::$app->controller->route =='dashboard/outlay'?'active':''] )
                            ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="far fa-circle nav-icon"> </i> 
                                <p> '.Yii::t('app','The_Sales').'</p>',
                                ['dashboard/sales'], ['class'=>"nav-link " .Yii::$app->controller->route =='dashboard/sales'?'active':''] )
                            ?>
                        </li>

                        <li class="nav-item">
                            <?= Html::a('<i class="far fa-circle nav-icon"> </i> 
                                <p> '.Yii::t('app','Best_Seller').'</p>',
                                ['dashboard/sales'], ['class'=>"nav-link ".Yii::$app->controller->route =='dashboard/sales'?'active':''] )
                            ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('<i class="far fa-circle nav-icon"> </i> 
                                <p> '.Yii::t('app','The_Orders').'</p>',
                                ['dashboard/orders'], ['class'=>"nav-link " .Yii::$app->controller->route =='dashboard/orders'?'active':''] )
                            ?>
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
                        <li  class="menu-item <?= Yii::$app->controller->route =='orders/index'?'active':''?>">
                            <?= Html::a(Yii::t('app','Orders'), ['orders/index'])?>
                        </li>
                        <li  class="menu-item <?= Yii::$app->controller->route =='orders/create'?'active':''?>">
                            <?= Html::a(Yii::t('app','Create_Order'), ['orders/create'])?>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>