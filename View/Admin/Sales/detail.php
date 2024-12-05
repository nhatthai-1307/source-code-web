<?php
session_start();
if (empty($_SESSION['adminId'])) {
    header('Location: ../../Admin/login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sales</title>
    <link href="/source-code-web/View/View/Css/admin-styles.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/bootstrap.min.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/font-awesome.min.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/prettyPhoto.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/price-range.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/animate.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/main.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="/source-code-web/View/View/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/source-code-web/View/View/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/source-code-web/View/View/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/source-code-web/View/View/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/source-code-web/View/View/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
    <?php include '../header.php'; ?>
    <?php
    $order = new Order();
    $product = new Product();
    $customer = new Customer();
    $payments = new Payment();

    $thisOrder = null;
    $isPayment = array();
    if (!empty($_GET['id'])) {
        $totalPrice = 0;
        $isPayment = $payments->getPaymentByOrderId($_GET['id']);
        $thisOrder = $order->getOrderById($_GET['id']);
        $thisCustomer = $customer->getCustomerById($thisOrder['customer_id']);
        $thisOrderItemCollection = $order->getOrderItemCollection($_GET['id']);
        foreach ($thisOrderItemCollection as $item) {
            $totalPrice += $item['qty'] * $item['base_price'];
        }
    } else {
        header('Location: sales.php');
        die();
    }
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%; height: 100vh;overflow-y: scroll;">
            <div class="container-detail">
                <div class="submit-add">
                    <h2>Order Details</h2>
                    <div class="order-detail-submit">
                        <div class="update-status-form">
                            <form class="form-submit-head" action="../../../Controller/Admin/Sales.php" method="post">
                                <input type="hidden" name="order_id" value="<?= $thisOrder['id'] ?>">
                                <?php if ($thisOrder['status'] != 'cancel' && $thisOrder['status'] == 'pending') : ?>
                                    <input class="btn btn-default" type="submit" name="update_accepted" value="Accepted">
                                    <?php if (empty($isPayment['id'])) : ?>
                                        <input class="btn btn-default" type="submit" name="update_cancel" value="Cancel">
                                    <?php endif; ?>
                                <?php elseif ($thisOrder['status'] != 'cancel' && $thisOrder['status'] == 'accepted') : ?>
                                    <input class="btn btn-default" type="submit" name="update_delivery" value="Delivery">
                                <?php elseif ($thisOrder['status'] != 'cancel' && $thisOrder['status'] == 'delivery') : ?>
                                    <input class="btn btn-default" type="submit" name="update_completed" value="Completed">
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="information">
                    <div class="order-information">
                        <h4>Order Information</h4>
                        <table>
                            <tr>
                                <th>Order Id</th>
                                <td><?= $thisOrder['id'] ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?= $thisOrder['status'] ?></td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td><?= number_format($totalPrice,0,',',' ') ?></td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td><?= !empty($isPayment) ? 'paid' : 'unpaid' ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="customer-information">
                        <h4>Customer Information</h4>
                        <table>
                            <tr>
                                <th>Customer Name</th>
                                <td><?= $thisCustomer['first_name'] . ' ' . $thisCustomer['last_name'] ?></td>
                            </tr>
                            <tr>
                                <th>Customer Phone / Email</th>
                                <td><?= $thisCustomer['phone'] . ' - ' . $thisCustomer['email'] ?></td>
                            </tr>
                            <tr>
                                <th>Shipping Address</th>
                                <td><?= $thisOrder['shipping_address'] ?></td>
                            </tr>
                            <tr>
                                <th>Comment</th>
                                <td><?= $thisOrder['comment'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="table-product">
                    <h4>Information Product</h4>
                    <table class="table table-condensed">
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        <?php foreach ($thisOrderItemCollection as $item) : ?>
                            <tr>
                                <td><?= $item['product_entity_id'] ?></td>
                                <td><img src="<?= '../../../' . $product->getProductById($item['product_entity_id'])['image'] ?>" alt="" style="width: 50px;"></td>
                                <td><?= $product->getProductById($item['product_entity_id'])['name'] ?></td>
                                <td><?= $item['qty'] ?></td>
                                <td><?= number_format($item['qty'] * $item['base_price'],0,',',' ') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <script src="../View/js/jquery.js"></script>
    <script src="../View/js/price-range.js"></script>
    <script src="../View/js/jquery.scrollUp.min.js"></script>
    <script src="../View/js/bootstrap.min.js"></script>
    <script src="../View/js/jquery.prettyPhoto.js"></script>
    <script src="../View/js/main.js"></script>
</body>

</html>