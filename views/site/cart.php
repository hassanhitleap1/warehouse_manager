<?php
$path_theme = Yii::getAlias('@web') . 'theme/shop/' ?>


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

    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                        <li>
                            <span>Subtotal</span> $240.00
                        </li>
                        <li>
                            <span>Shipping</span> $7.00
                        </li>
                        <li>
                            <span>Total</span> $247.00
                        </li>
                    </ul>
                    <a href="cart-2.html" class="btn_1 full-width cart">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /box_cart -->

</main>
