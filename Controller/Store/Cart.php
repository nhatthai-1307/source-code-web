<?php
include '../../Connect/Connection.php';
include '../../Model/Cart/Cart.php';
include '../../Model/Product/Product.php';
session_start();
$cart = new Cart();
$products = new Product();
if (!empty($_POST['add_to_cart'])) {
    $product = $products->getProductById($_POST['product_id']);
    if (!empty($_SESSION['userId'])) {
        $checkCart = $cart->checkCart($_SESSION['userId']);
        if (!empty($checkCart['id'])) {
            $checkCartHaveProduct = $cart->checkCartHaveProduct($checkCart['id'], $product['id']);
            if (empty($checkCartHaveProduct['id'])) {
                $cart->addCartItem($checkCart['id'], $product['id'], 1, $product['price'], $product['price']);
                header('Location: ../../View/Store/Carts/cart.php');
                die();
            } else {
                $cart->updateCartItem($checkCartHaveProduct['id'], $checkCartHaveProduct['qty'] + 1);
                header('Location: ../../View/Store/Carts/cart.php');
                die();
            }
        } else {
            $cart->createCart($_SESSION['userId']);
            header('Location: ../../View/Store/index.php');
            die();
        }
    } else {
        if (!empty($_SESSION['cart'])) {
            $array_item_id = array_column($_SESSION['cart'], 'item_id');
            if (in_array($_POST['product_id'], $array_item_id)) {
                $index = 0;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($_POST['product_id'] == $cart_item['item_id']) {
                        $_SESSION['cart'][0]['item_qty'] = $_SESSION['cart'][0]['item_qty'] + 1;
                    }
                    $index += 1;
                }
            } else {
                $array_item = [
                    'item_id' => $product['id'],
                    'item_name' => $product['name'],
                    'item_base_price' => $product['price'],
                    'item_qty' => 1
                ];
                $_SESSION['cart'][count($_SESSION['cart'])] = $array_item;
            }
            header('Location: ../../View/Store/Carts/cart.php');
            die();
        } else {
            $array_item = [
                'item_id' => $product['id'],
                'item_name' => $product['name'],
                'item_base_price' => $product['price'],
                'item_qty' => 1
            ];
            $_SESSION['cart'] = array();
            $_SESSION['cart'][0] = $array_item;
            header('Location: ../../View/Store/Carts/cart.php');
            die();
        }
    }
}

if (!empty($_POST['update_item_cart'])) {
    if (!empty($_SESSION['userId'])) {
        $cart->updateCartItem($_POST['key_item'], $_POST['update_qty']);
        header('Location: ../../View/Store/Carts/cart.php');
        die();
    } elseif (!empty($_SESSION['cart'])) {
        $_SESSION['cart'][$_POST['key_item']]['item_qty'] = $_POST['update_qty'];
        header('Location: ../../View/Store/Carts/cart.php');
        die();
    }
}

if (!empty($_POST['delete_item_cart'])) {
    if (!empty($_SESSION['userId'])) {
        $cart->deleteCartItem($_POST['key_item']);
        header('Location: ../../View/Store/Carts/cart.php');
        die();
    } elseif (!empty($_SESSION['cart'])) {
        unset($_SESSION['cart'][$_POST['key_item']]);
        header('Location: ../../View/Store/Carts/cart.php');
        die();
    }
}
