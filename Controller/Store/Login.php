<?php
require "/xampp/htdocs/source-code-web/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../../Connect/Connection.php';
include '../../Model/Customer/Customer.php';
include '../../Model/Cart/Cart.php';
session_start();

$customer = new Customer();
$cart = new Cart();

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp-relay.sendinblue.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "thanh.vinh@hotmail.com";
$mail->Password = "xfgO5mNqkEp6cFrw";

if (!empty($_GET['confirm'])) {
    $userConfirm = $customer->getCustomerByConfirm($_GET['confirm']);
    if (!empty($userConfirm['id'])) {
        $result = $customer->confirmAccount($userConfirm['id']);
        if ($result) {
            echo "<script>if(!alert('Confirm success!')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
        } else {
            echo "<script>if(!alert('Confirm failse!')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
        }
    }
}

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $result = $customer->login($_POST['username'], $_POST['password']);
    if ($result) {
        if ($result['confirm']) {
            echo "<script>if(!alert('Unconfirmed account!')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
        } else {
            $_SESSION['userId'] = $result['id'];
            $checkCart = $cart->checkCart($result['id']);
            if (empty($checkCart['id'])) {
                $cartId = $cart->createCart($result['id']);
                if (!empty($_SESSION['cart'])) {
                    $totalPrice = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $cartItemId = $cart->addCartItem($cartId, $item['item_id'], $item['item_qty'], $item['item_base_price'], $item['item_qty'] * $item['item_base_price']);
                        $totalPrice += $item['item_qty'] * $item['item_base_price'];
                    }
                    $cart->updateTotalPriceCart($cartId, $totalPrice);
                    unset($_SESSION['cart']);
                }
            } else {
                if (!empty($_SESSION['cart'])) {
                    $totalPrice = $checkCart['total_price'];
                    foreach ($_SESSION['cart'] as $item) {
                        $checkCartHaveProduct = $cart->checkCartHaveProduct($checkCart['id'], $item['item_id']);
                        if (empty($checkCartHaveProduct['id'])) {
                            $cartItemId = $cart->addCartItem($checkCart['id'], $item['item_id'], $item['item_qty'], $item['item_base_price'], $item['item_qty'] * $item['item_base_price']);
                        } else {
                            $cart->updateCartItem($checkCartHaveProduct['id'], $checkCartHaveProduct['qty'] + $item['item_qty']);
                        }
                        $totalPrice += $item['item_qty'] * $item['item_base_price'];
                    }
                    $cart->updateTotalPriceCart($checkCart['id'], $totalPrice);
                    unset($_SESSION['cart']);
                }
            }
            header('Location: ../../View/Store/index.php');
            die();
        }
    } else {
        echo "<script>if(!alert('Incorrect customer information')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
    }
}
if (!empty($_POST['login'])) {
    header('Location: ../../View/Store/login.php');
    die();
}
if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        unset($_SESSION['userId']);
        header('Location: ../../View/Store/login.php');
        die();
    }
}

if (!empty($_POST['signup'])) {
    if ($_POST['password'] == $_POST['password_confirm']) {
        $checkMail = $customer->checkEmail($_POST['email']);
        if (!empty($checkMail['id'])) {
            echo "<script>if(!alert('Email exists!')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
        } else {
            $stringConfirm = generateRandomString(32);
            $customerId = $customer->createCustomer($_POST['first_name'], $_POST['Last_name'], $_POST['phone'], $_POST['email'], $_POST['password'], $stringConfirm);
            $user = $customer->getCustomerById($customerId);
            $mail->setFrom("localhost@gmail.com", "DM Store");
            $mail->addAddress($user['email'], $user['first_name'] . ' ' . $user['last_name']);
            $mail->Subject = 'Create Account';
            $mail->Body    = 'Welcome,
                                Please notify you have successfully registered DM Store account. Please click the following link to activate your account !
                                http://localhost/source-code-web/Controller/Store/Login.php?confirm=' . $stringConfirm . '
                                *If you do not submit this request, please contact us immediately!*
                                Hotline: 0962339978
                                Regards,
                                *Please do not reply to this email*';
            $mail->send();

            echo "<script>if(!alert('Signup success! Please check your email to confirm your account.')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
        }
    } else {
        echo "<script>if(!alert('Password confirm unlike password')) document.location = 'http://localhost/source-code-web/View/Store/login.php';</script>";
    }
}


function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
