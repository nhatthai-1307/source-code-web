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
    <title>Product</title>
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
    $product = new Product();
    $categories = new Category();
    $listCategory = $categories->getCollection();
    $attributeCollection = $product->getAttrCollection();
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%;height: 100vh;overflow-y: scroll;">
            <form action="../../../Controller/Admin/Product.php" method="post" enctype="multipart/form-data">
                <div class="container-add-attribute-product">
                    <div class="submit-add">
                        <h2>Add Product</h2>
                        <div class="add">
                            <a class="btn btn-default" onclick="validatorBeforeAdd()">Add</a>
                            <input style="display: none;" id="add_product" class="btn btn-default" type="submit" name="add_product" value="Add">
                        </div>
                    </div>
                    <div class="add-base-value">
                        <h4>Add Base Column</h4>
                        <div class="input-from">
                            <label for="">Category Id</label>
                            <select name="category_id" id="category_id">
                                <?php foreach($listCategory as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-from">
                            <label for="">Product Name</label>
                            <input class="form-control py-4" type="text" placeholder="Product Name" name="product_name" value="" required>
                        </div>
                        <div class="input-from">
                            <label for="">Decription</label>
                            <input class="form-control py-4" type="text" placeholder="Decription" name="decription" value="" required>
                        </div>
                        <div class="input-from">
                            <label for="">Price</label>
                            <input class="form-control py-4" type="text" placeholder="Price" name="price" value="" required>
                        </div>
                        <div class="input-from">
                            <label for="">Qty</label>
                            <input class="form-control py-4" type="text" placeholder="Qty" name="qty" value="" required>
                        </div>
                        <div class="input-from">
                            <label for="">Image</label>
                            <input type="file" name="image" required>
                        </div>
                    </div>
                    <div class="add-old-attribute">
                        <h4>Add Old Attribute</h4>
                        <div class="select-attribute">
                            <select id="select-attribute" placeholder="...">
                                <option value="">Select a attribute...</option>
                                <?php foreach ($attributeCollection as $attribute) : ?>
                                    <option value="<?= $attribute['name'] ?>" name="<?= $attribute['title'] ?>"><?= $attribute['title'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <a onclick="addOldantribute()"><i class="fa fa-plus fa-1x">Add Old Attribute</i></a>
                        </div>
                        <div class="add-attr-value" id="add_old_attribute"></div>
                    </div>
                    <div class="add-new-attribute">
                        <h4>Add New Attribute</h4>
                        <a style="cursor: pointer;" id="add_attribute" onclick="addantribute()"><i class="fa fa-plus fa-1x">Add New Attribute</i></a>
                        <div class="table-new-attr" style="margin-top: 20px;">
                            <table id="table_attribute" style="display: none;">
                                <tr>
                                    <th>Attribute Title</th>
                                    <th>Attribute Name</th>
                                    <th>Attribute Value</th>
                                    <th><a style="cursor: pointer;" onclick="delNewAttr()">Delete last row</a></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <script>
                        let oldantr = 0;
                        function checkIfDuplicateExists(arr) {
                            return new Set(arr).size !== arr.length
                        }

                        function validatorBeforeAdd() {
                            var listElTitle = document.getElementsByName("attribute_title[]");
                            var listElName = document.getElementsByName("attribute_name[]");
                            var arrayTitle = [];
                            var arrayName = [];
                            for (var i = 0; i < listElTitle.length; i++) {
                                arrayTitle.push(listElTitle[i].value);
                                arrayName.push(listElName[i].value);
                            }
                            if (checkIfDuplicateExists(arrayTitle)) {
                                alert('Title attribute not duplicate');
                            } else if (checkIfDuplicateExists(arrayName)) {
                                alert('Name attribute not duplicate');
                            } else {
                                document.getElementById("add_product").click();
                            }
                        }

                        function addantribute() {
                            var tableAttribute = document.getElementById("table_attribute");
                            var row = tableAttribute.insertRow(tableAttribute.rows.length);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            cell1.innerHTML = "<input class=\"form-control py-4\" type=\"text\" placeholder=\"Attribute Title\" name=\"attribute_title[]\" required>";
                            cell2.innerHTML = "<input class=\"form-control py-4\" type=\"text\" placeholder=\"Attribute Name\" name=\"attribute_name[]\" required>";
                            cell3.innerHTML = "<input class=\"form-control py-4\" type=\"text\" placeholder=\"Attribute Value\" name=\"attribute_value[]\" required>";
                            tableAttribute.style.display = '';
                        }
                        function delNewAttr(index) {
                            var tableAttribute = document.getElementById("table_attribute");
                            tableAttribute.deleteRow((tableAttribute.rows.length)-1);
                        }

                        function addOldantribute() {
                            var divAddOldantr = document.getElementById("add_old_attribute");
                            var attr = document.getElementById("select-attribute");
                            if (attr.value) {
                                if (document.getElementsByName('old_attribute[' + attr.value + ']').length) {
                                    alert('Already exist attribute')
                                } else {
                                    divAddOldantr.innerHTML += "<div id=\"oldantr"+oldantr+"\" class=\"input-from\"><lable class=\"lable-input\" for=''>" + attr.options[attr.selectedIndex].text + "</lable><input class=\"form-control py-4\" type=\"text\" name=\"old_attribute[" + attr.value + "]\" required><a style=\"cursor: pointer;\" onclick=\"delOldantr('oldantr"+oldantr+"')\">Delete</a></div>";
                                    divAddOldantr.innerHTML +=""
                                    oldantr++;
                                }
                            }
                        }
                        function delOldantr(id) {
                            var thisId = document.getElementById(id);
                            thisId.remove();
                        }
                    </script>
                </div>
            </form>
        </section>
    </div>
    <script src="/source-code-web/View/View/js/jquery.js"></script>
    <script src="/source-code-web/View/View/js/price-range.js"></script>
    <script src="/source-code-web/View/View/js/jquery.scrollUp.min.js"></script>
    <script src="/source-code-web/View/View/js/bootstrap.min.js"></script>
    <script src="/source-code-web/View/View/js/jquery.prettyPhoto.js"></script>
    <script src="/source-code-web/View/View/js/main.js"></script>
</body>

</html>