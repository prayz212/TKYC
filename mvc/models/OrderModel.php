<?php

class OrderModel extends DB {

    function insertOrder($receiverName, $receiverPhone, $receiverAddress, $weight, $collect, $id_cus) {

        $status = "Đang xử lý";
        $cost = rand(25,100);
        $pickTime = "";
        $deliveryTime = "";
        $orderTime = date("d/m/Y");

        $sql = "INSERT INTO dongiaohang (idCustomer, Weight, AddressReceiver, Status, Cost, PickTime, DeliveryTime, OrderTime, Collect, FullnameReceiver, PhoneReceiver) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('iississsiss', $id_cus, $weight, $receiverAddress, $status, $cost, $pickTime, $deliveryTime, $orderTime, $collect, $receiverName, $receiverPhone);
        if (!$stm->execute()) {
            die($this->con->error);
            return false;
        }

        return true;
    }

    function getAllOrderByIdCustomer($id_cus) {
        $sql = "SELECT * FROM dongiaohang WHERE idCustomer = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $id_cus);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function getAllOrder() {
        $sql = "SELECT * FROM dongiaohang";

        $stm = $this->con->prepare($sql);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function getOrderById($id) {
        $sql = "SELECT * FROM dongiaohang WHERE idDonHang = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $id);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function deteleOrderById($id) {
        $sql = 'DELETE FROM `dongiaohang` WHERE `IdDonHang` = ?';

        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $id);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function updateOrderById($id, $receiverName, $receiverAddress, $receiverPhone, $weight, $collect) {
        $sql = "UPDATE dongiaohang SET FullnameReceiver = ?, AddressReceiver = ?, PhoneReceiver = ?, Weight = ?, Collect = ? WHERE IdDonHang = ?";
        $stm = $this->con->prepare($sql);
        $stm->bind_param('sssiii', $receiverName, $receiverAddress, $receiverPhone, $weight, $collect, $id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    function updateProcessOrderById($id, $receiverName, $receiverAddress, $receiverPhone, $weight, $collect, $cost, $status, $picktime, $deliverytime) {
        $sql = "UPDATE dongiaohang SET FullnameReceiver = ?, AddressReceiver = ?, PhoneReceiver = ?, Weight = ?, Collect = ?, Cost = ?, Status = ?, PickTime = ?, DeliveryTime = ? WHERE IdDonHang = ?";
        $stm = $this->con->prepare($sql);
        $stm->bind_param('sssiiisssi', $receiverName, $receiverAddress, $receiverPhone, $weight, $collect, $cost, $status, $picktime, $deliverytime, $id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        return false;
    }

}

?>
