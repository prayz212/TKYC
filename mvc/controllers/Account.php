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
                header("Location: ../Account/Login");
                exit();
            }
        }
    }

    function Register() {
        if (!isset($_POST["email"]) && !isset($_POST["pass"])) {
            $this->view("RegisterView", []);
            exit();
        }
            
        $stm = $this->model("UserModel");
        $tmp = $stm->registerUser($_POST["first"], $_POST["last"],
                                $_POST["user"], $_POST["email"], 
                                $_POST["pass"], $_POST["address"],
                                $_POST["Phone"], $_POST["Gender"],
                                $_POST["bday"]);

        if ($tmp) {
            header("Location: ../Account/Login");
            exit();
        }

        $this->view("RegisterView", ["error" => "Đăng ký thất bại"]);
    }

    function Logout() {
        session_unset();
        session_destroy();

        header("Location: ../");
    }
}

?>
