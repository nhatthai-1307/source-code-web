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
    <title>Product</title>
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
    $products = new Product();
    $productCollection = $products->getProductCollection();
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%; height: 100vh;overflow-y: scroll;">
            <div class="add-attribute-product">
                <a href="/source-code-web/View/Admin/Products/add_product.php"><i class="fa fa-plus fa-2x">Add New Product</i></a>
            </div>
            <div class="list-product">
                <h2>List Product</h2>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productCollection as $pro) : ?>
                            <tr>
                                <td><?= $pro['id'] ?></td>
                                <td><img src="<?= "../../../" . $pro['image'] ?>" alt="" style="width: 100px;"></td>
                                <td><span><?= $pro['name'] ?></span></td>
                                <td><span><?= number_format($pro['price'],0,',',' ') ?></span></td>
                                <td><span><?= $pro['qty'] ?></span></td>
                                <td><span><?= $pro['created_at'] ?></span></td>
                                <td><span><?= $pro['updated_at'] ?></span></td>
                                <td>
                                    <form action="../../../Controller/Admin/Product.php" method="post">
                                        <input type="hidden" name="prod_id" value="<?= $pro['id'] ?>">
                                        <input type="submit" name="edit_product" value="Edit">
                                        <input type="submit" name="delete_product" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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