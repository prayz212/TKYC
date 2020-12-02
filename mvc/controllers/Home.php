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
        echo "stock managment";
    }

    function AccountManagement() {
        echo "account management";
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
}
?>