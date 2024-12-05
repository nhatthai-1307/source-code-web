<?php
include '../../Connect/Connection.php';
include '../../Model/Customer/Customer.php';

$customers = new Customer();
if(!empty($_POST['info_customer_id'])) {
    $result = $customers->getCustomerById($_POST['info_customer_id']);
    if($result) {
        header('Location: ../../View/Admin/Customers/info.php?id='.$_POST['info_customer_id']);
        die();
    }
}
if (!empty($_POST['edit_customer'])) {
    $password = $_POST['password'];
    $check = $customers->checkPassword($_POST['customer_id'], $password);
    if (!empty($check['id'])) {
        $result = $customers->updateCustomer($_POST['customer_id'],$_POST['customer_first_name'],$_POST['customer_last_name'],$_POST['phone'],$_POST['email']);
        if ($result) {
            echo '<script>if(!alert("Update success")) document.location = "http://localhost/source-code-web/View/Admin/Customers/info.php?id='.$_POST['customer_id'].'";</script>';
        } else {
            echo '<script>if(!alert("Update false")) document.location = "http://localhost/source-code-web/View/Admin/Customers/info.php?id='.$_POST['customer_id'].'";</script>';
        }
    } else {
        echo '<script>if(!alert("Incorrect password")) document.location = "http://localhost/source-code-web/View/Admin/Customers/info.php?id='.$_POST['customer_id'].'";</script>';
    }
}
