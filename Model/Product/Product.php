<?php
class Product extends Connection
{

    public function addProduct($categoryId, $name, $decription, $price, $qty, $image)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into product_entity (category_id, name, decription, price, qty, image) value ($categoryId, '$name', '$decription', $price, $qty, '$image');";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function addantr($name, $title)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into product_attribute (name, title) value ('$name', '$title');";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function addValue($productId, $attributeId, $value)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into product_value (product_entity_id, product_attribute_id, value) value ($productId, $attributeId, '$value');";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function getAttrCollection()
    {
        $conn = $this->connectDb();
        $sql = "select * from product_attribute;";
        $result = $conn->query($sql);
        return $result;
    }

    public function getAttrByName($name)
    {
        $conn = $this->connectDb();
        $sql = "select * from product_attribute where name = '$name';";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function getProductCollection()
    {
        $conn = $this->connectDb();
        $sql = "select * from product_entity;";
        $result = $conn->query($sql);
        return $result;
    }

    public function getProductById($id)
    {
        $conn = $this->connectDb();
        $sql = "select * from product_entity where id = $id;";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function getAttributeValueById($id)
    {
        $conn = $this->connectDb();
        $sql = "select a.title, a.name, v.value from ((product_entity e inner join product_value v on e.id = v.product_entity_id) inner join product_attribute a on v.product_attribute_id = a.id) where e.id = $id";
        $result = $conn->query($sql);
        return $result;
    }

    public function updateProduct($id, $categoryId, $name, $decription, $price, $qty)
    {
        $sql = "update product_entity set category_id=$categoryId, name='$name',decription='$decription',price=$price,qty=$qty where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function updateImageProduct($id, $image)
    {
        $sql = "update product_entity set image=$image where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function updateAttributeProduct($id, $attrId, $value)
    {
        $sql = "update product_value set value='$value' where product_entity_id=$id and product_attribute_id=$attrId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function deleteProduct($id)
    {
        $conn = $this->connectDb();
        $sql1 = "delete from product_value where product_entity_id=$id;";
        $sql2 = "delete from product_entity where id=$id;";
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        $result = false;
        if ($result1 && $result2) {
            $result = true;
        }
        return $result;
    }

    public function getProductCollectionByCategoryId($categoryId)
    {
        $conn = $this->connectDb();
        $sql = "select * from product_entity where category_id = $categoryId;";
        $result = $conn->query($sql);
        return $result;
    }

    public function getProductCollectionBySearch($keyword)
    {
        $conn = $this->connectDb();
        $sql = "select * from product_entity where name like '%$keyword%';";
        $result = $conn->query($sql);
        return $result;
    }
    public function updateProductQty($productId, $qty)
    {
        $sql = "update product_entity set qty=$qty where id=$productId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }
}
