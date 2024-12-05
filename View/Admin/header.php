<?php
include '/xampp/htdocs/source-code-web/Connect/Connection.php';
include '/xampp/htdocs/source-code-web/Model/Customer/Customer.php';
include '/xampp/htdocs/source-code-web/Model/Product/Product.php';
include '/xampp/htdocs/source-code-web/Model/Category/Category.php';
include '/xampp/htdocs/source-code-web/Model/Cart/Cart.php';
include '/xampp/htdocs/source-code-web/Model/Order/Order.php';
include '/xampp/htdocs/source-code-web/Model/Payment/Payment.php';
include '/xampp/htdocs/source-code-web/Model/Admin/Admin.php';

$admins = new Admin();

$admin = $admins->getAdminById($_SESSION['adminId']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
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
    <header id="header">
        <div class="container header-admin">
            <div class="row">
                <div class="col-sm-4 logo-admin">
                    <div class="logo pull-left">
                        <a href="/source-code-web/View/Admin/index.php"><img src="/source-code-web/View/View/images/home/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8 info-admin">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a style="background: #e5e5e5;" href=""><i class="fa fa-user"></i><?= $admin['first_name'] . ' ' . $admin['last_name'] ?></a></li>
                            <li><a href="/source-code-web/View/Admin/login.php?action=logout" class="active header-admin"><i class="fa fa-lock"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="/source-code-web/View/View/js/jquery.js"></script>
    <script src="/source-code-web/View/View/js/price-range.js"></script>
    <script src="/source-code-web/View/View/js/jquery.scrollUp.min.js"></script>
    <script src="/source-code-web/View/View/js/bootstrap.min.js"></script>
    <script src="/source-code-web/View/View/js/jquery.prettyPhoto.js"></script>
    <script src="/source-code-web/View/View/js/main.js"></script>
</body>

</html>