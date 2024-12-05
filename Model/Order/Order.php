<?php
class Order extends Connection
{
    public function createOrder($customerId, $cartid, $shippingAddress, $comment)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into orders (customer_id,cart_id,status,shipping_address,comment,total_price) value ($customerId,$cartid,'pending','$shippingAddress','$comment',0);";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function addOrderItem($orderId, $productId, $qty, $basePrice, $totalPrice)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into order_item (order_id, product_entity_id, qty, base_price, total_price) value ($orderId, $productId, $qty, $basePrice, $totalPrice);";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function getOrderCollection()
    {
        $sql = "select * from orders order by id desc;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function getOrderItemCollection($orderId)
    {
        $sql = "select * from order_item where order_id = $orderId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function getOrderById($orderId)
    {
        $sql = "select * from orders where id=$orderId;";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }

    public function updateStatusOrder($orderId, $status)
    {
        $sql = "update orders set status='$status' where id=$orderId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function getCustomerOrderCollection($customerId)
    {
        $sql = "select * from orders where customer_id=$customerId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }
}
