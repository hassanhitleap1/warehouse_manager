<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app','Dashboard');
$this->params['breadcrumbs'][] = $this->title;


$label=[];
$label_gin=[];
$label_orders=[];
$data=[];
$data_gin=[];
$data_orders=[];
$label_product_order=[];
$data_product_order=[];
$label_delivery_order=[];
$data_delivery_order=[];

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="site-about">
    <div class="row" >
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["count_order"]?>  عدد طلبات اليوم</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["total_sales"]?>  مبيعات اليوم</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= $orders["quantity"]?>  عدد القطع</div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= round($orders["outlays"],2)?>  النفقات</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?=  $orders["total_sales"] - $cost_products  ?>    المرابح</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-body"> <?= round ($orders["total_sales"] - $cost_products  - $orders["outlays"] ,2)?>   صافي المرابح</div>
            </div>
        </div>

    </div>

    <hr />

    <div class="row">
         <div class="col-md-6">
         <h2 class="text-center"><?= Yii::t('app','Number_Of_Grains')?></h2>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?= Yii::t('app','Name')?></th>
                        <th scope="col"><?= Yii::t('app','Number_Of_Grains')?></th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach ($details as $key_det=> $detail):?>
                    <tr>
                        <th scope="row"><?= ++$key_det ?></th>
                        <td><?= $detail['type'] ?> </td>
                        <td><?= $detail['sum_quantity'] ?></td>
                    </tr>
                    <?php $label_gin[] =$detail['type'] ; $data_gin[]=$detail['sum_quantity']; ?>
                <?php endforeach;?>
            </tbody>
            </table>
        </div>


        <div class="col-md-6">
            <?= Html::a(Yii::t('app','More'), ['dashboard/sales'],['class'=>'pull-left']) ?>
            <canvas class="" id="chart_gin"></canvas>
        </div>   
       
       
    </div>   

    <hr />
    <div class="row">
        <div class="col-md-6">
        <h2 class="text-center"><?= Yii::t('app','Orders')?></h2>
        <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= Yii::t('app','Status')?></th>
                    <th scope="col"><?= Yii::t('app','Count_Orders')?></th>
                    
                </tr>
                </thead>
                <tbody>
                <?php foreach ($status_orders as $key_stat => $status_order):?>
                    <tr>
                        <th scope="row"><?= ++$key_stat ?></th>
                        <td><?= $status_order['name_ar'] ?> </td>
                        <td><?= $status_order['count_order'] ?></td>
                    </tr>
                    <?php $label_orders[] =$status_order['name_ar'] ; $data_orders[]=$status_order['count_order']  ?>
                <?php endforeach;?>


                </tbody>
            </table>
        </div>   
        <div class="col-md-6">
            <?= Html::a(Yii::t('app','More'), ['dashboard/orders'],['class'=>'pull-left']) ?>
            <canvas class="" id="chart_orders"></canvas>
           
        </div> 
    </div>



    <hr />
    <div class="row" >
        <h2><?= Yii::t('app','Previous_Order_Statuses')?></h2>
        <div class="col-md-6">
            <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?= Yii::t('app','Status')?></th>
                <th scope="col"><?= Yii::t('app','Count_Orders')?></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($status_statisticis as $key_stici => $status_statistici):?>
                <tr>
                    <th scope="row"><?= ++$key_stici ?></th>
                    <td><?= $status_statistici['name_ar'] ?> </td>
                    <td><?= $status_statistici['count_order'] ?></td>
                </tr>
                <?php

                $label[]=$status_statistici["name_ar"];
                $data[]=$status_statistici["count_order"];
                ?>
            <?php endforeach;?>


            </tbody>
        </table>
        </div>
        <div class="col-md-6">
            <?= Html::a(Yii::t('app','More'), ['dashboard/outlay'],['class'=>'pull-left']) ?>
            <?= Html::a(Yii::t('app','Previous_Order_Statuses'), ['dashboard/status'],['class'=>'pull-left']) ?>
            <canvas id="chart"></canvas>
        </div>

    </div>

    <hr />

    <div class="row">
        <div class="col-md-6">
            <h2 class="text-center"><?= Yii::t('app','Best_Seller')?></h2>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= Yii::t('app','Name')?></th>
                    <th scope="col"><?= Yii::t('app','Count_Orders')?></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($products_order as $key_product_or => $product_order):?>
                    <tr>
                        <th scope="row"><?= ++$key_product_or ?></th>
                        <td><?= $product_order['name'] ?> </td>
                        <td><?= $product_order['count_order'] ?></td>
                    </tr>
                    <?php $label_product_order[] =$product_order['name'] ; $data_product_order[]=$product_order['count_order']  ?>
                <?php endforeach;?>


                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <?= Html::a(Yii::t('app','More'), ['dashboard/best-seller'],['class'=>'pull-left']) ?>
            <canvas class="" id="chart_product_order"></canvas>

        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-6">
            <h2 class="text-center"><?= Yii::t('app','Campany_Delivery')?></h2>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= Yii::t('app','Name')?></th>
                    <th scope="col"><?= Yii::t('app','Count_Orders')?></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($delivery_order as $key_delivery_or => $delivery_or):?>
                    <tr>
<!--                        OrdersSearch%5Bcreated_at%5D=2021-08-17+-+2021-08-18  -->
<!--                        v/index.php?r=orders%2Findex&amp;1%5BOrdersSearch%5Bcompany_delivery_id%5D%5D=2021-08-17%2B-%2B2021-08-17-->
                        <th scope="row"><?= ++$key_delivery_or ?></th>
                        <td> <?= Html::a( $delivery_or['name'], ['orders/index' ,["OrdersSearch[company_delivery_id]" =>$delivery_or["company_delivery_id"], "OrdersSearch[company_delivery_id]"=>"$date+-+$date"   ]]) ?></td>
                        <td><?= Html::a(  $delivery_or['count_order'], ['orders/index']) ?></td>
                    </tr>
                    <?php $label_delivery_order[] =$delivery_or['name'] ; $data_delivery_order[]=$delivery_or['count_order']  ?>
                <?php endforeach;?>


                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <?= Html::a(Yii::t('app','More'), ['dashboard/delivery'],['class'=>'pull-left']) ?>
            <canvas class="" id="chart_delivery_order"></canvas>

        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-md-4">
            <h2 class="text-center"><?= Yii::t('app','Regions')?></h2>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= Yii::t('app','Name')?></th>
                    <th scope="col"><?= Yii::t('app','Count_Orders')?></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($regions_order as $key_region_or => $region_order):?>
                    <tr>
                        <!--                        OrdersSearch%5Bcreated_at%5D=2021-08-17+-+2021-08-18  -->
                        <!--                        v/index.php?r=orders%2Findex&amp;1%5BOrdersSearch%5Bcompany_delivery_id%5D%5D=2021-08-17%2B-%2B2021-08-17-->
                        <th scope="row"><?= ++$key_region_or ?></th>
                        <td> <?= Html::a( $region_order['name_ar'], ['orders/index' ,["OrdersSearch[region_id]" =>$region_order["region_id"], "OrdersSearch[region_id]"=>"$date+-+$date"   ]]) ?></td>
                        <td><?= Html::a(  $region_order['count_order'], ['orders/index']) ?></td>
                    </tr>
                    <?php $label_region_order[] =$region_order['name_ar'] ; $data_region_order[]=$region_order['count_order']  ?>
                <?php endforeach;?>


                </tbody>
            </table>
        </div>
        <div class="col-md-12" >
            <?= Html::a(Yii::t('app','More'), ['dashboard/region'],['class'=>'pull-left']) ?>
            <div  style=" width: 100%;
                height: 400px;" id="chart_region_order"></div>
        </div>
    </div>


</div>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
<script src="https://cdn.amcharts.com/lib/4/geodata/jordanLow.js"></script>

<script>

    var ctx = document.getElementById('chart').getContext('2d');
    ctx.canvas.parentNode.style.height = '400px';
     ctx.canvas.parentNode.style.width = '400px';
    data = {
        labels: <?=json_encode($label)?>,
        datasets: [{
            label: 'الاكثر مبيعا',
            data: <?=json_encode($data)?> ,
            borderWidth: 1,
            backgroundColor: ['#B30C1C', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400', '#57AE60', '#894EA0', '#D37400','#27AE60', '#884EA0', '#D35400'],
        }]
    };

    var config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('chart'),
        config
    );



     ctx = document.getElementById('chart_gin').getContext('2d');

     ctx.canvas.parentNode.style.height = '400px';
     ctx.canvas.parentNode.style.width = '400px';
    data = {
        labels: <?=json_encode($label_gin)?>,
        datasets: [{
            label: '<?= Yii::t('app','Number_Of_Grains')?>',
            data: <?=json_encode($data_gin)?> ,
            borderWidth: 1,
            backgroundColor: ['#B30C1C', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400', '#57AE60', '#894EA0', '#D37400','#27AE60', '#884EA0', '#D35400'],
        }]
    };

    var config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('chart_gin'),
        config
    );




    ctx = document.getElementById('chart_orders').getContext('2d');
    ctx.canvas.parentNode.style.height = '400px';
     ctx.canvas.parentNode.style.width = '400px';
    data = {
        labels: <?=json_encode($label_orders)?>,
        datasets: [{
            label: '<?= Yii::t('app','Orders')?>',
            data: <?=json_encode($data_orders)?> ,
            borderWidth: 1,
            backgroundColor: ['#B30C1C', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400', '#57AE60', '#894EA0', '#D37400','#27AE60', '#884EA0', '#D35400'],
        }]
    };

    var config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('chart_orders'),
        config
    );



    ctx = document.getElementById('chart_product_order').getContext('2d');
    ctx.canvas.parentNode.style.height = '400px';
    ctx.canvas.parentNode.style.width = '400px';
    data = {
        labels: <?=json_encode($label_product_order)?>,
        datasets: [{
            label: '<?= Yii::t('app','Best_Seller')?>',
            data: <?=json_encode($data_product_order)?> ,
            borderWidth: 1,
            backgroundColor: ['#B30C1C', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400', '#57AE60', '#894EA0', '#D37400','#27AE60', '#884EA0', '#D35400'],
        }]
    };

    var config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('chart_product_order'),
        config
    );





    
    ctx = document.getElementById('chart_delivery_order').getContext('2d');
    ctx.canvas.parentNode.style.height = '400px';
    ctx.canvas.parentNode.style.width = '400px';
    data = {
        labels: <?=json_encode($label_delivery_order)?>,
        datasets: [{
            label: '<?= Yii::t('app','Campany_Delivery')?>',
            data: <?=json_encode($data_delivery_order)?> ,
            borderWidth: 1,
            backgroundColor: ['#B30C1C', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400', '#57AE60', '#894EA0', '#D37400','#27AE60', '#884EA0', '#D35400'],
        }]
    };

    var config = {
        type: 'pie',
        data: data,
        options: {}
    };

    new Chart(
        document.getElementById('chart_delivery_order'),
        config
    );



    var regions=<?=json_encode($regions_order)?>;

    var chart = am4core.create("chart_region_order", am4maps.MapChart);
    chart.geodata = am4geodata_jordanLow;
    chart.projection = new am4maps.projections.Miller();

    // Create map polygon series
    var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

    // Make map load polygon (like country names) data from GeoJSON
    polygonSeries.useGeodata = true;

    // Configure series
    var polygonTemplate = polygonSeries.mapPolygons.template;

    var features=am4geodata_jordanLow.features;
    var temp;
    console.log(regions)
    $.each( features, function( key, value ) {
         temp =  regions.filter(function(region) {
            return region.key == value.id;
        });


        if(temp.length > 0){
            am4geodata_jordanLow.features[key].properties["count_order"]=temp[0]["count_order"];
            am4geodata_jordanLow.features[key].properties["name"]=temp[0]["name_ar"];
            am4geodata_jordanLow.features[key].properties["NAME_EN"]=temp[0]["name_ar"];
        }else {
            am4geodata_jordanLow.features[key].properties["count_order"]= 0;

        }

    });


    console.log(am4geodata_jordanLow.features);

    polygonTemplate.tooltipText= " {count_order} - {name}";

    polygonTemplate.fill = am4core.color("#74B266");

    // Create hover state and set alternative fill color
    var hs = polygonTemplate.states.create("hover");
    hs.properties.fill = am4core.color("#367B25");

</script>
