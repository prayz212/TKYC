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

    function NewOrder() {
        $id_user = $_SESSION["loggedIn"];
        $permission_user = $_SESSION["permission"];

        //Call model
        $userModel = $this->model("UserModel");
        $user = $userModel->getUserInfo($id_user, $permission_user);

        if ($user != false) {
            //Call view
            $this->view("MainView", [
                "ListOrderView" => "true",
                "userInfo" => $user
            ]);
        } else {
            echo $id_user . "-" . $permission_user;
            die ("new order function user info return false");
        }


    }

    function ProcessOrder() {
        echo "process order";
    }

    function StockManagement() {
        echo "stock managment";
    }

    function AccountManagement() {
        echo "account management";
    }
}
?>