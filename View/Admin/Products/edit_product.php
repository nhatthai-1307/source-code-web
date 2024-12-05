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
    <link rel="stylesheet" href="product.css">
</head>

<body>
    <?php include '../header.php'; ?>
    <?php
    $products = new Product();
    if (!empty($_GET['id'])) {
        $product = $products->getProductById($_GET['id']);
        $eavProduct = $products->getAttributeValueById($_GET['id']);
        $attributeCollection = $products->getAttrCollection();
    }
    ?>
    <div class="container-admin">
        <?php include '../ToolBar.php'; ?>
        <section style="width: 100%;height: 100vh;overflow-y: scroll;">
            <form action="../../../Controller/Admin/Product.php" method="post">
                <div class="container-edit-product">
                    <div class="submit-add">
                        <h2>Edit Product</h2>
                        <div class="add">
                            <input class="btn btn-default" type="submit" name="save_edit_product" value="Edit">
                        </div>
                    </div>

                    <div class="info-product">
                        <div class="input-from">
                            <label for="">Product ID</label>
                            <input class="form-control py-4" type="text" name="id" value="<?= $product['id'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Category Id</label>
                            <input class="form-control py-4" type="text" name="category_id" value="<?= $product['category_id'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Product Name</label>
                            <input class="form-control py-4" type="text" name="name" value="<?= $product['name'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Image</label>
                            <img src="<?= "../../../" . $product['image'] ?>" alt="" style="width: 100px;">
                            <input type="file" name="image">
                        </div>
                        <div class="input-from">
                            <label for="">Decription</label>
                            <input class="form-control py-4" type="text" name="decription" value="<?= $product['decription'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Price</label>
                            <input class="form-control py-4" type="text" name="price" value="<?= $product['price'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Quantity</label>
                            <input class="form-control py-4" type="text" name="qty" value="<?= $product['qty'] ?>" required>
                        </div>
                        <div class="input-from">
                            <label for="">Created At</label>
                            <input class="form-control py-4" type="text" name="created_at" value="<?= $product['created_at'] ?>">
                        </div>
                        <div class="input-from">
                            <label for="">Updated At</label>
                            <input class="form-control py-4" type="text" name="updated_at" value="<?= $product['updated_at'] ?>">
                        </div>
                        <div class="now-attribute">
                            <?php foreach ($eavProduct as $eav) : ?>
                                <div class="input-from">
                                    <label for=""><?= $eav['title'] ?></label>
                                    <input class="form-control py-4" type="text" name="attribute[<?= $eav['name'] ?>]" value="<?= $eav['value'] ?>" required>
                                </div>
                            <?php endforeach; ?>
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
                        <a id="add_attribute" onclick="addantribute()"><i class="fa fa-plus fa-1x">Add New Attribute</i></a>
                        <div class="table-new-attr" style="margin-top: 20px;">
                            <table id="table_attribute" style="display: none;">
                                <tr>
                                    <th>Attribute Title</th>
                                    <th>Attribute Name</th>
                                    <th>Attribute Value</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <script>
                        function addantribute() {
                            var tableAttribute = document.getElementById("table_attribute");
                            var row = tableAttribute.insertRow(tableAttribute.rows.length);
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            var cell3 = row.insertCell(2);
                            cell1.innerHTML = "<input class=\"form-control py-4\" type=\"text\" placeholder=\"Attribute Title\" name=\"new_attribute_title[]\" required>";
                            cell2.innerHTML = "<input class=\"form-control py-4\" type=\"text\" placeholder=\"Attribute Name\" name=\"new_attribute_name[]\" required>";
                            cell3.innerHTML = "<input class=\"form-control py-4\" type=\"text\" placeholder=\"Attribute Value\" name=\"new_attribute_value[]\" required>";
                            tableAttribute.style.display = '';
                        }

                        function addOldantribute() {
                            var divAddOldantr = document.getElementById("add_old_attribute");
                            var attr = document.getElementById("select-attribute");
                            if (attr.value) {
                                divAddOldantr.innerHTML += "<div class=\"input-from\"><lable class=\"lable-input\" for=''>" + attr.options[attr.selectedIndex].text + "</lable><input class=\"form-control py-4\" type=\"text\" name=\"old_attribute[" + attr.value + "]\" required></div>";
                            }
                        }
                    </script>
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