<?php
require "/xampp/htdocs/source-code-web/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../Connect/Connection.php';
include '../../Model/Order/Order.php';
include '../../Model/Product/Product.php';
include '../../Model/Customer/Customer.php';

$order = new Order();
$product = new Product();
$customers = new Customer();

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp-relay.sendinblue.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "thanh.vinh@hotmail.com";
$mail->Password = "xfgO5mNqkEp6cFrw";

if (!empty($_POST['order_detail'])) {
    header('Location: ../../View/Admin/Sales/detail.php?id='.$_POST['order_id']);
    die();
}
if (!empty($_POST['update_accepted'])) {
    $order->updateStatusOrder($_POST['order_id'], 'accepted');
    $customerId = $order->getOrderById($_POST['order_id'])['customer_id'];
    $custoemr = $customers->getCustomerById($customerId);

    $mail->setFrom("localhost@gmail.com", "DM Store");
    $mail->addAddress($custoemr['email'], $custoemr['first_name'].' '.$custoemr['last_name']);
    $mail->Subject = 'Order Accepted';
    $mail->Body    = 'Welcome,
                        Order ID: '.$_POST['order_id'].' has been accepted.
                        Thank you for trusting us.
                        Regards,
                        *Please do not reply to this email*';
    $mail->send();

    header('Location: ../../View/Admin/Sales/detail.php?id='.$_POST['order_id']);
    die();
} elseif (!empty($_POST['update_cancel'])) {
    $order->updateStatusOrder($_POST['order_id'], 'cancel');
    $orderItem = $order->getOrderItemCollection($_POST['order_id']);
    foreach ($orderItem as $item) {
        $thisProduct = $product->getProductById($item['product_entity_id']);
        $product->updateProductQty($item['product_entity_id'], $thisProduct['qty'] + $item['qty']);
    }
    $customerId = $order->getOrderById($_POST['order_id'])['customer_id'];
    $custoemr = $customers->getCustomerById($customerId);

    $mail->setFrom("localhost@gmail.com", "DM Store");
    $mail->addAddress($custoemr['email'], $custoemr['first_name'].' '.$custoemr['last_name']);
    $mail->Subject = 'Order Canceled';
    $mail->Body    = 'Welcome,
                        Order ID: '.$_POST['order_id'].' has been canceled.
                        Thank you for trusting us.
                        Regards,
                        *Please do not reply to this email*';
    $mail->send();

    header('Location: ../../View/Admin/Sales/detail.php?id='.$_POST['order_id']);
    die();
} elseif (!empty($_POST['update_delivery'])) {
    $order->updateStatusOrder($_POST['order_id'], 'delivery');
    $customerId = $order->getOrderById($_POST['order_id'])['customer_id'];
    $custoemr = $customers->getCustomerById($customerId);

    $mail->setFrom("localhost@gmail.com", "DM Store");
    $mail->addAddress($custoemr['email'], $custoemr['first_name'].' '.$custoemr['last_name']);
    $mail->Subject = 'Order Delivery';
    $mail->Body    = 'Welcome,
                        Order ID: '.$_POST['order_id'].' being delivery.
                        Thank you for trusting us.
                        Regards,
                        *Please do not reply to this email*';
    $mail->send();

    header('Location: ../../View/Admin/Sales/detail.php?id='.$_POST['order_id']);
    die();
} elseif (!empty($_POST['update_completed'])) {
    $order->updateStatusOrder($_POST['order_id'], 'completed');
    $customerId = $order->getOrderById($_POST['order_id'])['customer_id'];
    $custoemr = $customers->getCustomerById($customerId);

    $mail->setFrom("localhost@gmail.com", "DM Store");
    $mail->addAddress($custoemr['email'], $custoemr['first_name'].' '.$custoemr['last_name']);
    $mail->Subject = 'Order Completed';
    $mail->Body    = 'Welcome,
                        Order ID: '.$_POST['order_id'].' has been completed.
                        Thank you for trusting us.
                        Regards,
                        *Please do not reply to this email*';
    $mail->send();

    header('Location: ../../View/Admin/Sales/detail.php?id='.$_POST['order_id']);
    die();
}
