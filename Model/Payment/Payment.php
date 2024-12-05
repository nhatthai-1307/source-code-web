<?php
class Payment extends Connection
{
    public function createPayment($orderId, $totalPrice, $contentBilling, $vnpayId, $bankId, $timePayment, $resultPayment)
    {
        $id = 0;
        $conn = $this->connectDb();
        $sql = "insert into payments (order_id,total_price,content_billing,vnpay_id, bank_id,time_payment,result_payment) value ($orderId,$totalPrice,'$contentBilling','$vnpayId','$bankId','$timePayment','$resultPayment');";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        }
        return $id;
    }

    public function getPaymentByOrderId($orderId)
    {
        $sql = "select * from payments where order_id=$orderId;";
        $result = $this->connectDb()->query($sql);
        return $result->fetch_assoc();
    }
}
