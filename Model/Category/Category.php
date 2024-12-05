<?php

class Category extends Connection
{

    public function getCollection()
    {
        $sql = "select * from categories where is_active=1;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function getById($id)
    {
        $sql = "select * from categories where id='$id';";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function add($name)
    {
        $sql = "insert into categories (name, is_active) value ('$name', 1);";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function update($id, $name, $isActive)
    {
        $sql = "update categories set name='$name', is_active=$isActive where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }
}
