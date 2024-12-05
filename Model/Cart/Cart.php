<?php
class Cart extends Connection
{
    public function createCart($customerId)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into carts (customer_id, is_active, total_price) value ($customerId, 1, 0);";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function checkCart($customerId)
    {
        $conn = $this->connectDb();
        $sql = "select * from carts where customer_id = $customerId and is_active = 1;";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function addCartItem($cartId, $productId, $qty, $basePrice, $totalPrice)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into cart_item (cart_id, product_entity_id, qty, base_price, total_price) value ($cartId, $productId, $qty, $basePrice, $totalPrice);";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function updateTotalPriceCart($cartId, $totalPrice)
    {
        $sql = "update carts set total_price=$totalPrice where id=$cartId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function checkCartHaveProduct($cartId, $productId)
    {
        $conn = $this->connectDb();
        $sql = "select * from cart_item where cart_id = $cartId and product_entity_id = $productId;";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateCartItem($cartItemId, $qty)
    {
        $sql = "update cart_item set qty=$qty where id=$cartItemId;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }

    public function getCollectionByCartId($cartId)
    {
        $conn = $this->connectDb();
        $sql = "select ct.id,ct.product_entity_id,ct.qty,ct.base_price,ct.total_price,c.total_price as sum_total from carts c inner join cart_item ct on c.id = ct.cart_id where c.id = $cartId;";
        $result = $conn->query($sql);
        return $result;
    }

    public function deleteCartItem($id)
    {
        $conn = $this->connectDb();
        $sql = "delete from cart_item where id=$id;";
        $result = $conn->query($sql);
        return $result;
    }

    public function checkCartItem($cartId)
    {
        $conn = $this->connectDb();
        $sql = "select * from cart_item where cart_id = $cartId;";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    public function getCartItemByCartId($id)
    {
        $conn = $this->connectDb();
        $sql = "select * from cart_item where cart_id = $id;";
        $result = $conn->query($sql);
        return $result;
    }

    public function disableCart($id)
    {
        $sql = "update carts set is_active=0 where id=$id;";
        $result = $this->connectDb()->query($sql);
        return $result;
    }
}
