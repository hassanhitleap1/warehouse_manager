<?php
$path_theme = Yii::getAlias('@web') . 'theme/shop/';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$regions_model = \app\models\regions\Regions::find()->all();
$regions = [];
foreach ($regions_model as $key => $value) {
    $regions[$value->id] = $value->name_ar . " ".Yii::t('app','Delivery_Price')." ( " . $value->price_delivery . " )";
}


?>


<link href="<?= $path_theme ?>css/cart.css" rel="stylesheet">

<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li>Page active</li>
                </ul>
            </div>
            <h1>Cart page</h1>
        </div>
        <!-- /page_header -->
        <table class="table table-striped cart-list">
            <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Subtotal
                </th>
                <th>

                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart->getItems() as  $c):?>


                <tr>
                    <td>
                        <div class="thumb_cart">
                            <?= \yii\helpers\Html::img($c->getProduct()->thumbnail , ['data-src'=>$c->getProduct()->thumbnail,'class'=>'lazy'])?>

                        </div>
                        <span class="item_cart"><?= $c->getProduct()->name ?></span>
                    </td>
                    <td>
                        <strong><?= $c->getProduct()->selling_price ?></strong>
                    </td>
                    <td>
                        <div class="numbers-row"  att_product_id="<?= $c->getProduct()->id ?>">
                            <input type="text" value="<?= $cart->getItem($c->getProduct()->id)->getQuantity() ?>"
                                   id="quantity_1" class="qty2" name="quantity_1">
                            <div class="inc button_inc inc_item but_inc">
                                +
                            </div>
                            <div class="dec button_inc  but_dic">
                                -
                            </div>
                        </div>
                    </td>
                    <td>
                        <strong><?= $c->getProduct()->selling_price ?></strong>
                    </td>
                    <td class="options">
                        <a href="#"><i class="ti-trash" att_product_id="<?= $c->getProduct()->id ?>" ></i></a>
                    </td>
                </tr>
            <?php endforeach;?>


            </tbody>
        </table>


        <!-- /cart_actions -->

    </div>
    <!-- /container -->
    <div class="row">
        <div class="col-md-8">
            <div class="container">
                <?php $form = \yii\widgets\ActiveForm::begin(['id' => "order_landig"]); ?>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'required' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'other_phone')->textInput(['placeholder' => "07xxxxxxxx"]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'phone')->textInput(['required' => true,'placeholder' => "07xxxxxxxx"]) ?>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        <?= $form->field($model, 'address')->textInput(['required' => true]) ?>
                    </div>
                    <div class="col-md-6">

                        <?= $form->field($model, 'region_id')->dropDownList($regions) ?>

                    </div>
                </div>




                <div class="form-group">

                    <?= Html::submitButton(
                        '<span class="spinner spinner-border spinner-border-sm" id="spinner" role="status" aria-hidden="true"></span>'.
                        Yii::t('app', 'Order_Now') . ' <span class="fas fa-shopping-cart"></span> ', ['class' => 'btn_1  cart', 'id' => 'send_order','data-loading-text'=>"Loading..."]) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
        <div class="col-md-4">
            <h3><?=Yii::t('app',"Total")?>
            <?=$cart->getTotalCost() + 2?>
            </h3>
        </div>
    </div>

    <!-- /box_cart -->



</main>
