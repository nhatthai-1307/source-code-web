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
    $categoryCollection = $categories->getCollection();
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%; height: 100vh;overflow-y: scroll;">
            <div class="add-category">
                <a href="/source-code-web/View/Admin/Categories/add.php"><i class="fa fa-plus fa-2x">Add New Category</i></a>
            </div>
            <div class="show-category">
                <h2>List Category</h2>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category name</th>
                            <th>Show/Hidden</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categoryCollection as $category) : ?>
                            <tr id="<?= $category['name'] ?>" onclick="clickRow(this)">
                                <td><?= $category['id'] ?></td>
                                <td><?= $category['name'] ?></td>
                                <td><?= $category['is_active'] == 1 ? 'Show' : 'Hidden' ?></td>
                                <td><?= $category['created_at'] ?></td>
                                <td><?= $category['updated_at'] ?></td>
                                <form action="../../../Controller/Admin/Category.php" method="post">
                                    <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                    <input id="<?= $category['id'] ?>" style="display: none;" type="submit">
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <script>
                function clickRow(row) {
                    var categoryId = row.lastElementChild.value;
                    var categorySubmit = document.getElementById(categoryId);
                    categorySubmit.click();
                }
            </script>
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