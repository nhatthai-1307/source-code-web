<?php
include '../../Connect/Connection.php';
include '../../Model/Category/Category.php';

$category = new Category();
if(!empty($_POST['is_avtive'])) {
    $result = $category->update($_POST['category_id'], $_POST['category_name'], $_POST['is_avtive']);
    if($result) {
        header('Location: ../../View/Admin/Categories/category.php');
        die();
    }
} else if(!empty($_POST['category_id'])) {
    $result = $category->getById($_POST['category_id']);
    if($result) {
        header('Location: ../../View/Admin/Categories/edit.php?id='.$_POST['category_id']);
        die();
    }
} else if(!empty($_POST['category_name'])) {
    $result = $category->add($_POST['category_name']);
    if($result) {
        header('Location: ../../View/Admin/Categories/Category.php');
        die();
    }
}
