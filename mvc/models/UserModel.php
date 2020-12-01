<?php
class UserModel extends DB{
    function login($userName, $password) {
        $sql = "SELECT * FROM taikhoan WHERE UserName = ? AND Password = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('ss', $userName, $password);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function getUserInfo($id, $permission) {

        if ($permission == 4) { //khach hang
            $sql = "SELECT * FROM khachhang WHERE IdAccount = ?";
        } else { //nhan vien
            $sql = "SELECT * FROM nhanvien WHERE IdAccount = ?";
        }

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
}
?>