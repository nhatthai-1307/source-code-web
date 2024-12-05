<?php
class Admin extends Connection
{

    public function login($email, $password)
    {
        $sql = "select * from admins where email = '$email' and password = '$password' ;";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function getAdminById($adminId)
    {
        $sql = "select * from admins where id = $adminId ;";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }
}
