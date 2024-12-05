<?php
class Customer extends Connection
{
    public function login($email, $password)
    {
        $sql = "select * from customers where email = '$email' and password = '$password' ;";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function getCustomerById($id)
    {
        $sql = "select * from customers where id =$id ;";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function createCustomer($firstName, $lastName, $phone, $email, $password, $confirm)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into customers (first_name,last_name,phone,email,password,confirm) values ('$firstName','$lastName','$phone','$email','$password','$confirm')";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function getCollections()
    {
        $sql = "select * from customers;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function checkPassword($id, $password)
    {
        $sql = "select * from customers where id=$id and password='$password';";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function updateCustomer($id, $fn, $ln, $phone, $email)
    {
        $sql = "update customers set first_name='$fn', last_name='$ln', phone='$phone', email='$email' where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function updateCustomerAvatar($id, $avatar)
    {
        $sql = "update customers set avatar='$avatar' where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function updateCustomerPassword($id, $password)
    {
        $sql = "update customers set password='$password' where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function getCustomerByConfirm($confirm)
    {
        $sql = "select * from customers where confirm='$confirm';";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function confirmAccount($id)
    {
        $sql = "update customers set confirm='' where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function checkEmail($email)
    {
        $sql = "select * from customers where email='$email';";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }
}
