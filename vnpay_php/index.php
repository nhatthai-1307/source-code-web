<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php include '../View/Store/header.php' ?>
    <?php
    $orders = new Order();
    $orderId = null;
    $collectionItem = null;
    $totalPrice = 0;
    if (!empty($_GET['order'])) {
        $orderId = $_GET['order'];
        $collectionItem = $orders->getOrderItemCollection($orderId);
        foreach ($collectionItem as $item) {
            $totalPrice += $item['base_price'] * $item['qty'];
        }
    }
    ?>
    <?php require_once("./config.php"); ?>
    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/source-code-web/View/Store/index.php">Home</a></li>
                    <li class="active">Payment</li>
                </ol>
            </div>
            <div class="table-responsive">
                <form action="/source-code-web/vnpay_php/vnpay_create_payment.php" id="create_form" method="post">

                    <div class="form-group">
                        <label for="order_type">Payment type</label>
                        <select name="order_type" id="order_type" class="form-control" required>
                            <option value="billpayment">Pay the bill</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_id">Order Id</label>
                        <input class="form-control" id="order_id" name="order_id" type="text" value="<?= $orderId ? $orderId : '' ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="amount">Total price</label>
                        <input class="form-control" id="amount" name="amount" type="number" value="<?= $totalPrice ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label for="order_desc">Content billing</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2" placeholder="Nội dung thanh toán" required></textarea>
                    </div>
                    <div class="form-group" required>
                        <label for="bank_code">Bank</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Not selected</option>
                            <option value="NCB"> NCB Bank</option>
                            <option value="AGRIBANK"> Agribank Bank</option>
                            <option value="SCB"> SCB Bank</option>
                            <option value="SACOMBANK"> SacomBank Bank</option>
                            <option value="EXIMBANK"> EximBank Bank</option>
                            <option value="MSBANK"> MSBANK Bank</option>
                            <option value="NAMABANK"> NamABank Bank</option>
                            <option value="VNMART"> e-wallet VnMart</option>
                            <option value="VIETINBANK"> Vietinbank Bank</option>
                            <option value="VIETCOMBANK"> VCB Bank</option>
                            <option value="HDBANK"> HDBank Bank</option>
                            <option value="DONGABANK"> Dong A Bank</option>
                            <option value="TPBANK"> TPBank Bank</option>
                            <option value="OJB"> OceanBank Bank</option>
                            <option value="BIDV"> BIDV Bank</option>
                            <option value="TECHCOMBANK"> Techcombank Bank</option>
                            <option value="VPBANK"> VPBank Bank</option>
                            <option value="MBBANK"> MBBank Bank</option>
                            <option value="ACB"> ACB Bank</option>
                            <option value="OCB"> OCB Bank</option>
                            <option value="IVB"> IVB Bank</option>
                            <option value="VISA"> VISA/MASTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Vietnamese</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <button type="submit" name="redirect" id="redirect" class="btn btn-default">Thanh toán Redirect</button>
                </form>
            </div>
            <p>
                &nbsp;
            </p>
        </div>
    </section>
    <?php include '../View/Store/footer.php' ?>
</body>

</html>