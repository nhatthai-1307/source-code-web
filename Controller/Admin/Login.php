<?php
include '../../Connect/Connection.php';
include '../../Model/Admin/Admin.php';
session_start();

$admin = new Admin();

if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $result = $admin->login($_POST['username'], $_POST['password']);
    if($result) {
        $_SESSION['adminId'] = $result['id'];
        header('Location: ../../View/Admin/index.php');
        die();
    }
}

if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        unset($_SESSION['adminId']);
        header('Location: ../../View/Admin/login.php');
        die();
    }
}
