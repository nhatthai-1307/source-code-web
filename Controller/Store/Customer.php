<?php
session_start();
include '../../Connect/Connection.php';
include '../../Model/Customer/Customer.php';

$customers = new Customer();

if (!empty($_POST['update_info'])) {
    $check = $customers->checkPassword($_POST['id'], $_POST['password']);
    if (!empty($check['id'])) {
        $resultAvatar = true;
        if (!empty($_FILES['avatar'])) {
            $fileName = uploadFile();
            if ($fileName) {
                $resultAvatar = $customers->updateCustomerAvatar($_POST['id'], $fileName);
            } else {
                echo '<script>if(!alert("Upload file false")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
            }
        }
        if ($resultAvatar) {
            $checkEmail = $customers->checkEmail($_POST['email']);
            if (empty($checkEmail['id']) || $checkEmail['id'] == $_POST['id']) {
                $result = $customers->updateCustomer($_POST['id'], $_POST['first_name'], $_POST['last_name'], $_POST['phone'], $_POST['email']);
                if ($result) {
                    echo '<script>if(!alert("Update success")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
                } else {
                    echo '<script>if(!alert("Update false")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
                }
            } else {
                echo '<script>if(!alert("Email exist!")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
            }
        } else {
            echo '<script>if(!alert("Update avatar false")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
        }
    } else {
        echo '<script>if(!alert("Incorrect password")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
    }
}

if (!empty($_POST['change_password'])) {
    if ($_POST['new_password'] == $_POST['confirm_new_password']) {
        $check = $customers->checkPassword($_POST['id'], $_POST['old_password']);
        if (!empty($check['id'])) {
            if ($_POST['new_password'] != $check['password']) {
                $result = $customers->updateCustomerPassword($_POST['id'], $_POST['new_password']);
                if ($result) {
                    unset($_SESSION['userId']);
                    echo '<script>if(!alert("Update password success")) document.location = "http://localhost/source-code-web/View/Store/login.php";</script>';
                } else {
                    echo '<script>if(!alert("Update password false")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
                }
            } else {
                echo '<script>if(!alert("The new password must not be the same as the old password")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
            }
        } else {
            echo '<script>if(!alert("Incorrect password")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
        }
    } else {
        echo '<script>if(!alert("Confirm new password is not correct")) document.location = "http://localhost/source-code-web/View/Store/Customers/customer.php";</script>';
    }
}

function uploadFile()
{
    $target_dir = "upload/avatar/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["avatar"]["size"] > 500000) {
        $uploadOk = 0;
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        return null;
    } else {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], "C:/xampp/htdocs/source-code-web/" . $target_file)) {
            return $target_file;
        } else {
            return null;
        }
    }
}
