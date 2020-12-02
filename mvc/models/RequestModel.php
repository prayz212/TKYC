<?php 

class RequestModel extends DB {
    function getAllRequestStockIn() {
        $sql = "SELECT * FROM `yeucau`, `kho` WHERE `yeucau`.`IdKho` = `kho`.`IdKho`";

        $stm = $this->con->prepare($sql);

        if(!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();
        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function insertRequest($id, $note, $date, $stock) {
        $sql = "INSERT INTO `yeucau`(IdDonHang, IdKho, Date, Note) VALUES (?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('iiss', $id, $stock, $date, $note);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function deleteRequest($id) {
        $sql = "DELETE FROM yeucau WHERE IdRequest = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $id);

        if (!$stm->execute()) {
            return false;
        }

        return true;
    }
}

?>