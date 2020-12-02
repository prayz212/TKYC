<?php

class Home extends Controller{

    // Must have Error()
    function Error(){
        echo "sai url";
    }

    function Intro() {
        //Call view
        $this->view("HomeView", [
            "IntroView" => "true"
        ]);
    }

    function getUserInfo() {
        $id_user = $_SESSION["loggedIn"];
        $permission_user = $_SESSION["permission"];

        $userModel = $this->model("UserModel");
        $user = $userModel->getUserInfo($id_user, $permission_user);

        return $user;
    }

    function Order() {
        //Call model
        $orderModel = $this->model("OrderModel");

        $user = $this->getUserInfo();
        $temp = $this->getUserInfo();
        $info = $temp->fetch_assoc();
        $id_cus = $info["IdKh"];

        $orderList = $orderModel->getAllOrderByIdCustomer($id_cus);

        if ($user != false) {
            //Call view
            $this->view("MainView", [
                "ListOrderView" => "true",
                "ListOrder" => $orderList,
                "userInfo" => $user
            ]);
        } else {
            die ("order function user info return false");
        }
    }

    function ProcessOrder() {
        //Call model
        $orderModel = $this->model("OrderModel");

        $user = $this->getUserInfo();
        $orderList = $orderModel->getAllOrder();

        if ($user != false) {
            //Call view
            $this->view("MainView", [
                "ListOrderView" => "true",
                "ListOrder" => $orderList,
                "userInfo" => $user
            ]);
        } else {
            die ("process order function user info return false");
        }
    }

    function StockManagement() {
        $id_user = $_SESSION["loggedIn"];
        $permission_user = $_SESSION["permission"];

        //Call model
        $userModel = $this->model("UserModel");
        $requestModel = $this->model("RequestModel");

        
        //Call model
        $user = $userModel->getUserInfo($id_user, $permission_user);
        $requests = $requestModel->getAllRequestStockIn();

        //Call view
        $this->view("MainView", [
            "StockInView" => "true",
            "RequestList" => $requests,
            "userInfo" => $user
        ]);

    }

    function NewStockInRequest() {
        $id = $_POST["request_id"];

        $stock = $_POST["stock"];
        $note = $_POST["note"];
        $now = date('d/m/Y');

        $requestModel = $this->model("RequestModel");
        $requests = $requestModel->insertRequest($id, $note, $now, $stock);

        if ($requests) {
            header("Location: ../Home/StockManagement");
            exit();
        }
        else {
            echo "Khong the nhap hang";
        }
    }

    function StockOut($id) {
        $requestModel = $this->model("RequestModel");
        $requests = $requestModel->deleteRequest($id);

        if ($requests) {
            header("Location: ../StockManagement");
            exit();
        }
        else {
            echo "Khong the xuat hang";
        }
    }

    function EmployerManagement() {
        //Call model
        $userModel = $this->model("UserModel");
        $employers = $userModel->getAllEmployer();

        $user = $this->getUserInfo();

        //Call view
        $this->view("MainView", [
            "ManegementView" => "true",
            "EmployerList" => $employers,
            "userInfo" => $user
        ]);
    }

//    --------------------------------------------    ORDER   -------------------------------------------- //

    function NewOrder() {
        $receiverName = $_POST["fullname"];
        $receiverPhone = $_POST["phone"];
        $receiverAddress = $_POST["address"];
        $weight = $_POST["weight"];
        $collect = $_POST["collect"];

        $permission_user = $_SESSION["permission"];

        if ($permission_user == 4) {
            $user = $this->getUserInfo();
            $info = $user->fetch_assoc();
            $id_cus = $info["IdKh"];

            //Insert new order
            $orderModel = $this->model("OrderModel");
            $insertResult = $orderModel->insertOrder($receiverName, $receiverPhone, $receiverAddress, $weight, $collect, $id_cus);

            if (!$insertResult) {
                die("insert new order fail in NewOrder function");
            }
        }

        header("Location: ./Order");
    }

    function DetailOrder($id) {
        //Call model
        $orderModel = $this->model("OrderModel");

        $user = $this->getUserInfo();
        $orderDetail = $orderModel->getOrderById($id);

        if ($orderDetail == false) {
            die("select detail order fail in DetailOrder function");
        }

        $this->view("MainView", [
            "DetailOrderView" => "true",
            "OrderInfo" => $orderDetail,
            "userInfo" => $user
        ]);
    }

    function DeleteOrder($id) {
        //Call model
        $orderModel = $this->model("OrderModel");
        $deleteResult = $orderModel->deteleOrderById($id);

        if (!$deleteResult) {
            die("delete order fail in DeleteOrder function");
        }

        header("Location: ../../Home/Order");
        exit();
    }

    function UpdateOrder($id) {
        $receiverName = $_POST["fullname"];
        $receiverPhone = $_POST["phone"];
        $receiverAddress = $_POST["address"];
        $weight = $_POST["weight"];
        $collect = $_POST["collect"];

        //Call model
        $orderModel = $this->model("OrderModel");
        $updateResult = $orderModel->updateOrderById($id, $receiverName, $receiverAddress, $receiverPhone, $weight, $collect);

        if (!$updateResult) {
            die("update order fail in UpdateOrder function");
        }

        header("Location: ../../Home/Order");
        exit();
    }

    //    --------------------------------------------    END ORDER   -------------------------------------------- //


    //    --------------------------------------------    PROCESS ORDER   -------------------------------------------- //
    function UpdateProcessOrder($id) {
        $receiverName = $_POST["fullname"];
        $receiverPhone = $_POST["phone"];
        $receiverAddress = $_POST["address"];
        $weight = $_POST["weight"];
        $collect = $_POST["collect"];
        $cost = $_POST["cost"];
        $status = $_POST["status"];
        $picktime = $_POST["picktime"];
        $deliverytime = $_POST["deliverytime"];

        //Call model
        $orderModel = $this->model("OrderModel");
        $updateResult = $orderModel->updateProcessOrderById($id, $receiverName, $receiverAddress, $receiverPhone, $weight, $collect, $cost, $status, $picktime, $deliverytime);

        if (!$updateResult) {
            die("update process order fail in UpdateProcessOrder function");
        }

        header("Location: ../../Home/ProcessOrder");
        exit();
    }

    //    --------------------------------------------   END PROCESS ORDER   -------------------------------------------- //


    //    --------------------------------------------    DETAIL EMPLOYER   -------------------------------------------- //
    function DetailEmployer($id) {
        //Call model
        $userModel = $this->model("UserModel");
        $employerInfo = $userModel->getEmployerById($id);

        $user = $this->getUserInfo();

        $this->view("MainView", [
            "DetailEmployerView" => "true",
            "EmployerInfo" => $employerInfo,
            "userInfo" => $user
        ]);
    }

    function UpdateEmployer($id) {
        //SPLIT FULLNAME INTO FIRSTNAME AND LASTNAME
        $fullname = $_POST["fullname"];
        $name = explode(" ", $fullname);
        $n = count($name);
        $firstName = $name[$n - 1];
        $lastName = "";
        for ($i = 0; $i < $n - 1; $i++) {
            $lastName .= $name[$i];

            if (($i + 1) < ($n - 1)) {
                $lastName .= " ";
            }
        }

        $permission = $_POST["permission"];
        $dob = $_POST["dob"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $senior = $_POST["senior"];

        //Call model
        $userModel = $this->model("UserModel");

        $update = $userModel->updateEmployerById($id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior);
        if (!$update) {
            die("update employer fail in UpdateEmployer function");
        }

        header("Location: ../../Home/EmployerManagement");
        exit();
    }

    function DeleteEmployer($idEmployer) {
        $userModel = $this->model("UserModel");
        $user = $userModel->getEmployerById($idEmployer);

        if ($user != false) {
            $info = $user->fetch_assoc();
            $idAccount = $info["IdAccount"];

            $deleteResult = $userModel->deleteEmployerById($idEmployer, $idAccount);
            if (!$deleteResult) {
                die("delete employer fail in DeleteEmployer function");
            }
        }

        header("Location: ../../Home/EmployerManagement");
        exit();
    }

    function NewEmployer() {
        //SPLIT FULLNAME INTO FIRSTNAME AND LASTNAME
        $fullname = $_POST["fullname"];
        $name = explode(" ", $fullname);
        $n = count($name);
        $firstName = $name[$n - 1];
        $lastName = "";
        for ($i = 0; $i < $n - 1; $i++) {
            $lastName .= $name[$i];

            if (($i + 1) < ($n - 1)) {
                $lastName .= " ";
            }
        }

        $permission = $_POST["permission"];
        $dob = $_POST["dob"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $senior = 0;

        $userModel = $this->model("UserModel");
        $insertResult = $userModel->insertEmployer($firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $username, $password);
        if (!$insertResult) {
            die("create employer fail in NewEmployer function");
        }

        header("Location: ../Home/EmployerManagement");
        exit();
    }
    //    --------------------------------------------    END DETAIL EMPLOYER   -------------------------------------------- //
}
?>