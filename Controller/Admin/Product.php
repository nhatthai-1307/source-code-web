<?php
include '../../Connect/Connection.php';
include '../../Model/Product/Product.php';



$product = new Product();
if (!empty($_POST['add_product'])) {
    $fileName = uploadFile();
    if ($fileName) {
        $prod = $product->addProduct($_POST['category_id'], $_POST['product_name'], $_POST['decription'], $_POST['price'], $_POST['qty'], $fileName);
        if (!empty($_POST['old_attribute'])) {
            $oldantr = $_POST['old_attribute'];
            $keyOldantr = array_keys($oldantr);
            foreach ($keyOldantr as $key) {
                $attrItem = $product->getAttrByName($key);
                $product->addValue($prod, $attrItem['id'], $oldantr[$key]);
            }
        }
        if (!empty($_POST['attribute_title']) && !empty($_POST['attribute_name']) && !empty($_POST['attribute_value'])) {
            $attrTitle = $_POST['attribute_title'];
            $attrName = $_POST['attribute_name'];
            $attrValue = $_POST['attribute_value'];
            for ($i = 0; $i < count($attrName); $i++) {
                $attr = $product->addantr($attrName[$i], $attrTitle[$i]);
                $product->addValue($prod, $attr, $attrValue[$i]);
            }
        }

        header('Location: ../../View/Admin/Products/product.php');
        die();
    }
}
if (!empty($_POST['edit_product'])) {
    $prodId = $_POST['prod_id'];
    $result = $product->getProductById($prodId);
    if ($result) {
        header('Location: ../../View/Admin/Products/edit_product.php?id=' . $prodId);
        die();
    }
}
if (!empty($_POST['save_edit_product'])) {
    if (!empty($_POST['image'])) {
        $fileName = uploadFile();
        if ($fileName) {
            $product->updateImageProduct($_POST['id'], $fileName);
        }
    }
    $product->updateProduct($_POST['id'], $_POST['category_id'], $_POST['name'], $_POST['decription'], $_POST['price'], $_POST['qty']);
    $arrayAttributeValue = count($_POST['attribute']) ? $_POST['attribute'] : false;
    if ($arrayAttributeValue) {
        $keyAAV = array_keys($arrayAttributeValue);
        foreach ($keyAAV as $key) {
            $editAttr = $product->getAttrByName($key);
            $product->updateAttributeProduct($_POST['id'], $editAttr['id'], $arrayAttributeValue[$key]);
        }
    }
    if (!empty($_POST['old_attribute'])) {
        $oldantr = $_POST['old_attribute'];
        $keyOldantr = array_keys($oldantr);
        foreach ($keyOldantr as $key) {
            $attrItem = $product->getAttrByName($key);
            $product->addValue($_POST['id'], $attrItem['id'], $oldantr[$key]);
        }
    }
    if (!empty($_POST['new_attribute_title']) && !empty($_POST['new_attribute_name']) && !empty($_POST['new_attribute_value'])) {
        $attrTitle = $_POST['new_attribute_title'];
        $attrName = $_POST['new_attribute_name'];
        $attrValue = $_POST['new_attribute_value'];
        for ($i = 0; $i < count($attrName); $i++) {
            $attr = $product->addantr($attrName[$i], $attrTitle[$i]);
            $product->addValue($_POST['id'], $attr, $attrValue[$i]);
        }
    }
    header('Location: ../../View/Admin/Products/edit_product.php?id=' . $_POST['id']);
    die();
}
if (!empty($_POST['delete_product'])) {
    $result = $product->deleteProduct($_POST['prod_id']);
    if ($result) {
        header('Location: ../../View/Admin/Products/product.php');
        die();
    }
}

function uploadFile()
{
    $target_dir = "upload/product/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    if ($_FILES["image"]["size"] > 500000) {
        $uploadOk = 0;
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp"
    ) {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        return null;
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "C:/xampp/htdocs/source-code-web/" . $target_file)) {
            return $target_file;
        } else {
            return null;
        }
    }
}
