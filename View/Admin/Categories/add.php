<?php
session_start();
if (empty($_SESSION['adminId'])) {
    header('Location: ../../Admin/login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Category</title>
    <link rel="stylesheet" href="category.css">
</head>

<body>
    <?php include '../header.php'; ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%;height: 100vh;overflow-y: scroll;">
            <form action="/source-code-web/Controller/Admin/Category.php" method="post">
                <div class="container-add-category">
                    <div class="submit-add">
                        <h2>Add Category</h2>
                        <div class="add">
                            <input class="btn btn-default" type="submit" name="add_category" value="Add">
                        </div>
                    </div>
                    <div class="input-category">
                        <div class="input-from">
                            <label for="">Category Name</label>
                            <input class="form-control py-4" placeholder="Category Name" name="category_name" value="" required>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <script src="../View/js/jquery.js"></script>
    <script src="../View/js/price-range.js"></script>
    <script src="../View/js/jquery.scrollUp.min.js"></script>
    <script src="../View/js/bootstrap.min.js"></script>
    <script src="../View/js/jquery.prettyPhoto.js"></script>
    <script src="../View/js/main.js"></script>
</body>

</html>