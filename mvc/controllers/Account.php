<?php

class Account extends Controller {

    function Login() {
        if (isset($_SESSION["loggedIn"])) {
            header("Location: ../Home/Intro");
            exit();
        }

        if (!isset($_POST["username"]) && !isset($_POST["password"])) {
            $this->view("LoginView", []);
        }
        else {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $tmp = $this->model("UserModel");
            $data = $tmp->login($username, $password);
            if ($data) {

                $res = $data->fetch_assoc();

                echo "dang nhap thanh cong";
                $_SESSION["loggedIn"] = $res["IdAccount"];
                $_SESSION["permission"] = $res["Permission"];

                header("Location: ../Home/Intro");
                exit();
            } else {
                echo "dang nhap that bai";
            }
        }
    }

    function Register() {
        echo "register";
    }

    function Logout() {
        session_unset();
        session_destroy();

        header("Location: ../");
    }
}

?>
