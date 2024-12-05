<?php
session_start();
if (empty($_SESSION['adminId'])) {
    header('Location: ../../View/Admin/login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <?php include 'ToolBar.php'; ?>
</body>

</html>