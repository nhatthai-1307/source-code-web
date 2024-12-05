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
    <title>Category</title>
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
    $customers = new Customer();
    if (!empty($_GET['id'])) {
        $customer = $customers->getCustomerById($_GET['id']);
    }
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%; height: 100vh;overflow-y: scroll;">
            <form action="../../../Controller/Admin/Customer.php" method="post">
                <div class="container-edit-category">
                    <div class="submit-add">
                        <h2>Info Customer</h2>
                        <div class="add">
                            <input class="btn btn-default" type="submit" name="edit_customer" value="Edit">
                        </div>
                    </div>
                    <div class="info-customer-form">
                        <div class="input-from">
                            <label for="">Customer ID</label>
                            <input class="form-control py-4" type="text" name="customer_id" value="<?= $customer['id'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Customer First Name</label>
                            <input class="form-control py-4" type="text" name="customer_first_name" value="<?= $customer['first_name'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Customer Last Name</label>
                            <input class="form-control py-4" type="text" name="customer_last_name" value="<?= $customer['last_name'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Phone</label>
                            <input class="form-control py-4" type="text" name="phone" value="<?= $customer['phone'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Email</label>
                            <input class="form-control py-4" type="text" name="email" value="<?= $customer['email'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Created At</label>
                            <input class="form-control py-4" type="text" name="created_at" value="<?= $customer['created_at'] ?>">
                        </div>
                        <div class="input-from">
                            <label for="">Updated At</label>
                            <input class="form-control py-4" type="text" name="updated_at" value="<?= $customer['updated_at'] ?>">
                        </div>
                        <hr>
                        <div class="input-from">
                            <label for="">Password Customer</label>
                            <input class="form-control py-4" type="password" name="password" value="" required>
                        </div>
                    </div>
                </div>
            </form>
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