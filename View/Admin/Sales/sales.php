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
    $orderCollection = $order->getOrderCollection();
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%;height: 100vh;overflow-y: scroll;">
            <div class="list-order">
                <h2>List Order</h2>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Shipping Address</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderCollection as $odc) : ?>
                            <tr onclick="clickRow(this)">
                                <td><?= $odc['id'] ?></td>
                                <td><?= $odc['status'] ?></td>
                                <td>
                                    <?php foreach ($order->getOrderItemCollection($odc['id']) as $item) : ?>
                                        <p><?= $product->getProductById($item['product_entity_id'])['name'] ?></p>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $customer->getCustomerById($odc['customer_id'])['first_name'] . ' ' . $customer->getCustomerById($odc['customer_id'])['last_name'] ?></td>
                                <td><?= $odc['shipping_address'] ?></td>
                                <td><?= $odc['comment'] ?></td>
                                <form action="../../../Controller/Admin/Sales.php" method="post">
                                    <input type="hidden" name="order_id" value="<?= $odc['id'] ?>">
                                    <input id="<?= $odc['id'] ?>" style="display: none;" type="submit" name="order_detail" value="Order Detail">
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <script>
                function clickRow(row) {
                    var orderId = row.lastElementChild.value;
                    var orderSubmit = document.getElementById(orderId);
                    orderSubmit.click();
                    console.log(orderId);
                }
            </script>
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