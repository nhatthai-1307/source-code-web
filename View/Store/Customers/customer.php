<?php
session_start();
?>

<head>
    <title>My Account | DMD</title>
</head>
<html lang="en">
<?php include '../header.php' ?>
<?php
$customer = new Customer();
$orders = new Order();
$products = new Product();
$payments = new Payment();
$thisCustomer = $customer->getCustomerById($_SESSION['userId']);
$thisOrderCollection = $orders->getCustomerOrderCollection($_SESSION['userId']);
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/source-code-web/View/Store/index.php">Home</a></li>
                <li class="active">My Account</li>
            </ol>
        </div>
        <div class="container-my-account">
            <form action="/source-code-web/Controller/Store/Customer.php" method="post" enctype="multipart/form-data">
                <div class="form-customer">
                    <h2>Customer informations</h2>
                    <div class="input-avatar-customer">
                        <label for="">Avatar</label>
                        <?php if ($thisCustomer['avatar']) : ?>
                            <img style="width: 100px;" src="/source-code-web/<?= $thisCustomer['avatar'] ?>" alt="">
                        <?php endif; ?>
                        <input type="file" name="avatar">
                    </div>
                    <div class="input-customer">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" value="<?= $thisCustomer['first_name'] ?>" required>
                    </div>
                    <div class="input-customer">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" value="<?= $thisCustomer['last_name'] ?>" required>
                    </div>
                    <div class="input-customer">
                        <label for="">Email</label>
                        <input type="text" name="email" value="<?= $thisCustomer['email'] ?>" required>
                    </div>
                    <div class="input-customer">
                        <label for="">Phone</label>
                        <input type="text" name="phone" value="<?= $thisCustomer['phone'] ?>" required>
                    </div>
                    <div class="input-customer">
                        <label for="">Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $thisCustomer['id'] ?>">
                    <input type="submit" name="update_info" value="Update Info">
                </div>
            </form>
            <form action="/source-code-web/Controller/Store/Customer.php" method="post">
                <div class="form-customer">
                    <h2>Change Password</h2>
                    <div class="input-customer">
                        <label for="">New Password</label>
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </div>
                    <div class="input-customer">
                        <label for="">Confirm New Password</label>
                        <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required>
                    </div>
                    <div class="input-customer">
                        <label for="">Password</label>
                        <input type="password" name="old_password" placeholder="Old Password" required>
                    </div>
                    <input type="hidden" name="id" value="<?= $thisCustomer['id'] ?>">
                    <input type="submit" name="change_password" value="Change Password">
                </div>
            </form>
        </div>
        <div class="container-order-account">
            <h2>Order informations</h2>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th class="head-table-order">Order Id</th>
                        <th class="head-table-order">Status</th>
                        <th class="head-table-order">Item Info</th>
                        <th class="head-table-order">Total Price</th>
                        <th class="head-table-order">Payment</th>
                        <th class="head-table-order">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($thisOrderCollection as $order) : ?>
                        <?php $checkPayment = $payments->getPaymentByOrderId($order['id']); ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= $order['status'] ?></td>
                            <td>
                                <?php
                                $totalPrice = 0;
                                $orderItem = $orders->getOrderItemCollection($order['id']);
                                foreach ($orderItem as $item) :
                                ?>
                                    <p><span><?= $products->getProductById($item['product_entity_id'])['name'] ?></span>: <span><?= $item['qty'] ?></span></p>
                                    <?php $totalPrice += $item['qty'] * $item['base_price']; ?>
                                <?php endforeach; ?>
                            </td>
                            <td><?= number_format($totalPrice,0,',',' ') ?></td>
                            <td> <?= !empty($checkPayment['id']) ? "Paid" : "Unpaid" ?> </td>
                            <td>
                                <?php if ($order['status'] == 'pending' && empty($checkPayment['id'])) : ?>
                                    <form action="/source-code-web/Controller/Store/Order.php" method="post">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <input type="submit" name="cancel_order" value="Cancel">
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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