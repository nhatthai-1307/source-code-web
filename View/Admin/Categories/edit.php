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
    <link href="/source-code-web/View/View/Css/admin-styles.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/bootstrap.min.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/font-awesome.min.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/prettyPhoto.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/price-range.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/animate.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/main.css" rel="stylesheet">
    <link href="/source-code-web/View/View/Css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="/source-code-web/View/View/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/source-code-web/View/View/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/source-code-web/View/View/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/source-code-web/View/View/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/source-code-web/View/View/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
    <?php include '../header.php'; ?>
    <?php
    $categories = new Category();
    if (!empty($_GET['id'])) {
        $category = $categories->getById($_GET['id']);
    }
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%; height: 100vh;overflow-y: scroll;">
            <form action="../../../Controller/Admin/Category.php" method="post">
                <div class="container-edit-category">
                    <div class="submit-add">
                        <h2>Edit Category</h2>
                        <div class="add">
                            <input class="btn btn-default" type="submit" name="add_category" value="Edit">
                        </div>
                    </div>
                    <div class="edit-categroy-form">
                        <div class="input-from">
                            <label for="">Category ID</label>
                            <input class="form-control py-4" type="text" name="category_id" value="<?= $category['id'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Category Name</label>
                            <input class="form-control py-4" type="text" name="category_name" value="<?= $category['name'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Is Active</label>
                            <input class="form-control py-4" type="text" name="is_avtive" value="<?= $category['is_active'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Created At</label>
                            <input class="form-control py-4" type="text" name="created_at" value="<?= $category['created_at'] ?>">
                        </div>
                        <div class="input-from">
                            <label for="">Updated At</label>
                            <input class="form-control py-4" type="text" name="updated_at" value="<?= $category['updated_at'] ?>">
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