<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php include '../header.php' ?>
<?php
$products = new Product();
$cart = new Cart();
if (!empty($_GET['msg'])) {
    echo "<script>alert('" . $_GET['msg'] . "')</script>";
}
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/source-code-web/View/Store/index.php">Home</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['userId'])) : ?>
                        <?php
                        $cartCollection = null;
                        $checkCart = $cart->checkCart($_SESSION['userId']);
                        if (!empty($checkCart['id'])) {
                            $cartCollection = $cart->getCollectionByCartId($checkCart['id']);
                        }
                        if ($cartCollection) :
                            $index = 1;
                            foreach ($cartCollection as $item) : ?>
                                <tr>
                                    <td style="width: 180px;" class="cart_product">
                                        <a href=""><img src="/source-code-web/<?= $products->getProductById($item['product_entity_id'])['image'] ?>" style="width: 100px;" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""><?= $products->getProductById($item['product_entity_id'])['name'] ?></a></h4>
                                        <p>Product ID: <?= $item['product_entity_id'] ?></p>
                                    </td>
                                    <td class="cart_price">
                                        <p><?= number_format($item['base_price'],0,',',' ') ?></p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <input id="input_qty_<?= $item['product_entity_id'] ?>" class="cart_quantity_input" type="text" name="quantity" value="<?= $item['qty'] ?>" autocomplete="off" size="2">
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price"><?= number_format($item['base_price'] * $item['qty'],0,',',' ') ?></p>
                                    </td>
                                    <td class="cart_actions">
                                        <a id="update_<?= $item['product_entity_id'] ?>" class="cart_quantity_update"><i class="fa fa-check"></i></a>
                                        <a id="delete_<?= $item['product_entity_id'] ?>" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                        <form hidden action="/source-code-web/Controller/Store/Cart.php" method="post">
                                            <input id="qty_<?= $item['product_entity_id'] ?>" type="hidden" name="update_qty" />
                                            <input type="hidden" name="key_item" value="<?= $item['id'] ?>" />
                                            <input id="submit_update_<?= $item['product_entity_id'] ?>" type="submit" name="update_item_cart" value="Update" />
                                            <input id="submit_delete_<?= $item['product_entity_id'] ?>" type="submit" name="delete_item_cart" value="Delete" />
                                        </form>
                                    </td>
                                    <script>
                                        $('#input_qty_<?= $item['product_entity_id'] ?>').change(function() {
                                            $('#qty_<?= $item['product_entity_id'] ?>').val($('#input_qty_<?= $item['product_entity_id'] ?>').val());
                                        });
                                        $('#update_<?= $item['product_entity_id'] ?>').click(function() {
                                            $('#submit_update_<?= $item['product_entity_id'] ?>').trigger('click');
                                        });
                                        $('#delete_<?= $item['product_entity_id'] ?>').click(function() {
                                            $('#submit_delete_<?= $item['product_entity_id'] ?>').trigger('click');
                                        });
                                    </script>
                                </tr>
                        <?php $index += 1;
                            endforeach;
                        endif; ?>
                    <?php else : ?>
                        <?php if (!empty($_SESSION['cart'])) : ?>
                            <?php $index = 1; ?>
                            <?php foreach ($_SESSION['cart'] as $key => $item) : ?>
                                <tr>
                                    <td style="width: 180px;" class="cart_product">
                                        <a href=""><img src="/source-code-web/<?= $products->getProductById($item['item_id'])['image'] ?>" style="width: 100px;" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""><?= $products->getProductById($item['item_id'])['name'] ?></a></h4>
                                        <p>Product ID: <?= $item['product_entity_id'] ?></p>
                                    </td>
                                    <td class="cart_price">
                                        <p><?= number_format($item['item_base_price'],0,',',' ') ?></p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <input id="input_qty_<?= $item['item_id'] ?>" class="cart_quantity_input" type="text" name="quantity" value="<?= $item['item_qty'] ?>" autocomplete="off" size="2">
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price"><?= number_format($item['item_base_price'] * $item['item_qty'],0,',',' ') ?></p>
                                    </td>
                                    <td class="cart_actions">
                                        <a id="update_<?= $item['item_id'] ?>" class="cart_quantity_update"><i class="fa fa-check"></i></a>
                                        <a id="delete_<?= $item['item_id'] ?>" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                        <form hidden action="/source-code-web/Controller/Store/Cart.php" method="post">
                                            <input id="qty_<?= $item['item_id'] ?>" type="hidden" name="update_qty" />
                                            <input type="hidden" name="key_item" value="<?= $item['id'] ?>" />
                                            <input id="submit_update_<?= $item['item_id'] ?>" type="submit" name="update_item_cart" value="Update" />
                                            <input id="submit_delete_<?= $item['item_id'] ?>" type="submit" name="delete_item_cart" value="Delete" />
                                        </form>
                                    </td>
                                    <script>
                                        $('#input_qty_<?= $item['product_entity_id'] ?>').change(function() {
                                            $('#qty_<?= $item['product_entity_id'] ?>').val($('#input_qty_<?= $item['product_entity_id'] ?>').val());
                                        });
                                        $('#update_<?= $item['product_entity_id'] ?>').click(function() {
                                            $('#submit_update_<?= $item['product_entity_id'] ?>').trigger('click');
                                        });
                                        $('#delete_<?= $item['product_entity_id'] ?>').click(function() {
                                            $('#submit_delete_<?= $item['product_entity_id'] ?>').trigger('click');
                                        });
                                    </script>
                                </tr>
                                <?php $index += 1; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Check Out</h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="total_area">
                    <form action="/source-code-web/Controller/Store/Order.php" method="post">
                        <ul>
                            <li>Total <span id="total_all"></span></li>
                            <li>
                                <p>Shipping Address: </p>
                                <textarea name="shipping_address" id="shipping_address" cols="30" rows="5" required></textarea>
                            </li>
                            <li>
                                <p>Comment: </p>
                                <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
                            </li>
                            <li>
                                <p>Payment Methods: </p>
                                <label for="payment_online">Payment online: </label>
                                <input type="radio" id="payment_online" name="payment_online" value="online">
                                <label for="payment_offline">Payment offline: </label>
                                <input type="radio" id="payment_offline" name="payment_offline" value="offline" checked>
                            </li>
                            <script>
                                $('#payment_online').click(function() {
                                    $('#payment_offline').prop("checked", false);
                                });
                                $('#payment_offline').click(function() {
                                    $('#payment_online').prop("checked", false);
                                });
                            </script>
                        </ul>
                        <input type="hidden" name="user_id" value="<?= !empty($_SESSION['userId']) ? $_SESSION['userId'] : '' ?>">
                        <input hidden id="input_check_out" type="submit" name="checkout_cart" name="Checkout">
                    </form>
                    <a id="a_check_out" class="btn btn-default check_out">Check Out</a>
                    <script>
                        var classTotal = $('.cart_total_price');
                        var totalAll = 0;
                        for (var i = 0; i < classTotal.length; ++i) {
                            totalAll = totalAll + parseInt(classTotal[i].innerHTML.replace(/ /g,''));
                        }
                        $('#total_all').text(totalAll.toLocaleString('vi-VN'));

                        $('#a_check_out').click(function() {
                            $('#input_check_out').trigger('click');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include '../footer.php' ?>
<script src="/source-code-web/View/View/js/jquery.js"></script>
<script src="/source-code-web/View/View/js/price-range.js"></script>
<script src="/source-code-web/View/View/js/jquery.scrollUp.min.js"></script>
<script src="/source-code-web/View/View/js/bootstrap.min.js"></script>
<script src="/source-code-web/View/View/js/jquery.prettyPhoto.js"></script>
<script src="/source-code-web/View/View/js/main.js"></script>

</html>