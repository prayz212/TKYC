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

    function getAllEmployer() {

        $sql = "SELECT * FROM nhanvien";

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

    function getEmployerById($id) {
        $sql = "SELECT `nhanvien`.`IdNv`, `nhanvien`.`IdAccount`, `nhanvien`.`FirstName`, `nhanvien`.`LastName`, `nhanvien`.`Phone`, `nhanvien`.`Address`, `nhanvien`.`DOB`, `nhanvien`.`Email`, `nhanvien`.`Senior`, `taikhoan`.`Permission`
                FROM `nhanvien`, `taikhoan` WHERE `taikhoan`.`IdAccount` = `nhanvien`.`IdAccount` AND `nhanvien`.`IdNv` = ?";

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

    function updateEmployerById($id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior) {
        $update = "UPDATE `nhanvien`, `taikhoan` SET `nhanvien`.`FirstName` = ?, `nhanvien`.`LastName` = ?, `taikhoan`.`Permission` = ?,
                    `nhanvien`.`DOB` = ?, `nhanvien`.`Phone` = ?, `nhanvien`.`Email` = ?, `nhanvien`.`Address` = ?, `nhanvien`.`Senior` = ?
                   WHERE `nhanvien`.`IdNv` = ? AND `nhanvien`.`IdAccount` = `taikhoan`.`IdAccount`";
        $stm = $this->con->prepare($update);
        $stm->bind_param('ssissssii',$firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $id);

        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function deleteEmployerById($idNv, $idAccount) {
        $sql = 'DELETE FROM `nhanvien` WHERE `IdNv` = ?';
        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $idNv);
        if (!$stm->execute()) {
            return false;
        }

        $sql = 'DELETE FROM `taikhoan` WHERE `IdAccount` = ?';
        $stm = $this->con->prepare($sql);
        $stm->bind_param('i', $idAccount);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function insertEmployer($firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $username, $password) {
        $sql = "INSERT INTO taikhoan (UserName, Password, Permission) VALUES (?, ?, ?)";
        $stm = $this->con->prepare($sql);
        $stm->bind_param('ssi',$username, $password, $permission);
        if (!$stm->execute()) {
            die($stm->error);
            return false;
        }

        $idAccount = $stm->insert_id;

        $sql = "INSERT INTO nhanvien (IdAccount, FirstName, LastName, Phone, Address, DOB, Email, Senior)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('isssssss', $idAccount, $firstName, $lastName, $phone, $address, $dob, $email, $senior);
        if (!$stm->execute()) {
            die($stm->error);
            return false;
        }

        return true;
    }

    function registerUser($firstName, $lastName, $user, $email, $password, $address,
                        $phone, $gender, $birthday) {

        $sql1 = "INSERT INTO taikhoan(UserName, Password, Permission) VALUES (?, ?, ?)";

        $per = 4;
        $stm1 = $this->con->prepare($sql1);
        $stm1->bind_param("ssi", $user, $password, $per);

        if (!$stm1->execute()) {
            return false;
        }

        $sql2 = "INSERT INTO khachhang(IdAccount, FirstName, LastName, Phone, DOB, Gender, Email, Address)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $id =  $stm1->insert_id;
        $stm1 = $this->con->prepare($sql2);
        $stm1->bind_param("isssssss", $id, $firstName, $lastName, $phone, $birthday, $gender, $email, $address);

        if (!$stm1->execute()) {
            return false;
        }

        return true;
    }
}
?>