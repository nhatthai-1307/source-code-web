<?php
require "/xampp/htdocs/source-code-web/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../Connect/Connection.php';
include '../../Model/Cart/Cart.php';
include '../../Model/Product/Product.php';
include '../../Model/Order/Order.php';
include '../../Model/Customer/Customer.php';
session_start();
$cart = new Cart();
$products = new Product();
$order = new Order();
$customers = new Customer();

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp-relay.sendinblue.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "thanh.vinh@hotmail.com";
$mail->Password = "xfgO5mNqkEp6cFrw";

if (!empty($_SESSION['userId'])) {
    $custoemr = $customers->getCustomerById($_SESSION['userId']);
    if (!empty($_POST['checkout_cart'])) {
        $checkCart = $cart->checkCart($_POST['user_id']);
        if (!empty($checkCart['id'])) {
            $checkCartItem = $cart->checkCartItem($checkCart['id']);
            if (!empty($checkCartItem['id'])) {
                if (!empty($_POST['shipping_address'])) {
                    $cartItemCollection = $cart->getCartItemByCartId($checkCart['id']);
                    foreach ($cartItemCollection as $item) {
                        $product = $products->getProductById($item['product_entity_id']);
                        if ($item['qty'] > $product['qty']) {
                            $msg = $product['name'] . ' ' . $product['qty'] . ' products left';
                            header('Location: ../../View/Store/Carts/cart.php?msg=' . $msg);
                            die();
                        }
                    }
                    $orderId = $order->createOrder($_SESSION['userId'], $checkCart['id'], $_POST['shipping_address'], $_POST['comment'] ? $_POST['comment'] : "");
                    foreach ($cartItemCollection as $item) {
                        $product = $products->getProductById($item['product_entity_id']);
                        $orderItemId = $order->addOrderItem($orderId, $item['product_entity_id'], $item['qty'], $item['base_price'], $item['total_price']);
                        $products->updateProductQty($item['product_entity_id'], $product['qty'] - $item['qty']);
                    }
                    $disCart = $cart->disableCart($checkCart['id']);
                    if ($disCart) {
                        $cart->createCart($_SESSION['userId']);

                        $mail->setFrom("localhost@gmail.com", "DM Store");
                        $mail->addAddress($custoemr['email'], $custoemr['first_name'] . ' ' . $custoemr['last_name']);
                        $mail->Subject = 'Order Success';
                        $mail->Body    = 'Welcome,
                                            You have successfully placed an order on DM Store with Order ID: ' . $orderId . '.
                                            Thank you for trusting us.
                                            *If you do not submit this request, please contact us immediately!*
                                            Hotline: 0962339978
                                            Regards,
                                            *Please do not reply to this email*';
                        $mail->send();
                    }
                    if (!empty($_POST['payment_online'])) {
                        header('Location: ../../vnpay_php/index.php?order=' . $orderId);
                        die();
                    } else {
                        echo "<script>if(!alert('Order success!')) document.location = 'http://localhost/source-code-web/View/Store/index.php';</script>";
                    }
                }
            } else {
                echo "<script>if(!alert('Cart must contain at least 1 product!')) document.location = 'http://localhost/source-code-web/View/Store/index.php';</script>";
            }
        } else {
            echo "<script>if(!alert('Can't create cart!')) document.location = 'http://localhost/source-code-web/View/Store/index.php';</script>";
        }
    }
} else {
    echo "<script>if(!alert('please login!')) document.location = 'http://localhost/source-code-web/View/Store/index.php';</script>";
}

if (!empty($_POST['cancel_order'])) {
    $order->updateStatusOrder($_POST['order_id'], 'cancel');
    $orderItem = $order->getOrderItemCollection($_POST['order_id']);
    foreach ($orderItem as $item) {
        $thisProduct = $products->getProductById($item['product_entity_id']);
        $products->updateProductQty($item['product_entity_id'], $thisProduct['qty'] + $item['qty']);
    }
    echo '<script>if(!alert("Cancel order success")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
}
