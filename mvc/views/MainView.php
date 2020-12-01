<?php

$url = explode("/", filter_var(trim($_GET["url"], "/")));

$action = $url[1];

switch ($action) {
    case "Intro":
        $active = "0";
        break;
    case "NewOrder":
        $active = "1";
        break;
    case "ProcessOrder":
        $active = "2";
        break;
    case "StockManagement":
        $active = "3";
        break;
    case "AccountManagement":
        $active = "4";
        break;
}

$level = count($url);
$root = "";

while ($level > 1) {
    $root = $root . "../";
    $level--;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?= $root . "public/style.css" ?>">
    <script src="<?= $root . "public/myscript.js" ?>"></script>

</head>

<body>
<div class="bg-light">
    <div class="header">
        <div class="navbar-part">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="#"><img src="<?= $root . "public/imgs/logo.png" ?>" alt="" width="60px" height="40px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <?php
                    if (isset($_SESSION["loggedIn"])) {
                        ?>

                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item <?= $active == 0 ? "active" : "" ?>">
                                <a class="nav-link" href="<?= $root . "Home/Intro" ?>">Home</a>
                            </li>
                            <?php
                            if ($_SESSION["permission"] == 4) { ?>
                                <li class="nav-item <?= $active == 1 ? "active" : "" ?>">
                                    <a class="nav-link" href="<?= $root . "Home/NewOrder" ?>">Tạo đơn hàng</a>
                                </li>
                                <?php
                            }
                            if ($_SESSION["permission"] == 3) { ?>
                                <li class="nav-item <?= $active == 2 ? "active" : "" ?>">
                                    <a class="nav-link" href="<?= $root . "Home/ProcessOrder" ?>">Xử lý đơn hàng</a>
                                </li>
                                <?php
                            }
                            if ($_SESSION["permission"] == 2) { ?>
                                <li class="nav-item <?= $active == 3 ? "active" : "" ?>">
                                    <a class="nav-link" href="<?= $root . "Home/StockManagement" ?>">Quản lý kho</a>
                                </li>
                                <?php
                            }
                            if ($_SESSION["permission"] == 1) { ?>
                                <li class="nav-item <?= $active == 4 ? "active" : "" ?>">
                                    <a class="nav-link" href="<?= $root . "Home/AccountManagement" ?>">Quản lý tài khoản</a>
                                </li>
                                <?php
                            }
                            ?>

                        </ul>

                        <?php
                    }

                    if (!isset($_SESSION["loggedIn"])) {
                        ?>
                        <div class="mt-2 mt-md-0 ml-auto">
                            <a href="<?= $root . "Account/Login" ?>" class="font-weight-bold text-light btn btn-outline-primary my-2 my-sm-0" role="button">Login</a>
                            <a href="<?= $root . "Account/Register" ?>" class="font-weight-bold text-light btn btn-outline-success my-2 my-sm-0 ml-3" role="button">Register</a>
                        </div>

                        <?php
                    } else { ?>

                        <div class="mt-2 mt-md-0 ml-auto">
                            <a href="<?= $root . "Account/Logout" ?>" class="font-weight-bold text-light btn btn-outline-primary my-2 my-sm-0" role="button">Logout</a>
                        </div>

                        <?php
                    }
                    ?>

                </div>
            </nav>
        </div>
    </div>

    <div class="carousel-part mb-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?= $root . "public/imgs/image1.jpg" ?>" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?= $root . "public/imgs/image2.jpg" ?>" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?= $root . "public/imgs/image3.jpg" ?>" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="py-5">
            <div class="row">
                <?php
                if ($active != 0) {
                    $user = $data["userInfo"]->fetch_assoc();
                    ?>
                    <!--Infor account-->
                    <div class="col-lg-3 col-md-12 shadow-lg p-3 mb-3 bg-info rounded h-100 text-white text-center">
                        <h5 class="text-center mb-3">THÔNG TIN TÀI KHOẢN</h5>
                        <div><img class="rounded-circle shadow p-1 my-3" src="<?= $root . "public/imgs/icon-user.jpg" ?>" width="80px" height="80px"></div>
                        <h5 class="mb-1"><?= $user["LastName"] . " " . $user["FirstName"] ?></h5>
                        <h6 class="mb-1"><?= "Email: " . $user["Email"] ?></h6>
                        <h6 class="mb-3"><?= "Số điện thoại: " . $user["Phone"] ?> </h6>
                    </div>
                    <?php
                }
                ?>

                <div class="col-lg-9 col-md-12 pr-0 pl-md-0 pl-lg-2 h-75">
                    <?php isset($data["ListOrderView"]) and $data["ListOrderView"] === "true" ? require_once "./mvc/views/pages/order.php" : ""?>
<!--                    --><?php //isset($data["DetailInvoiceView"]) and $data["DetailInvoiceView"] === "true" ? require_once "./mvc/views/pages/detail_invoice.php" : ""?>
<!--                    --><?php //isset($data["ManegementView"]) and $data["ManegementView"] === "true" ? require_once "./mvc/views/pages/manage.php" : ""?>
<!--                    --><?php //isset($data["DetailEmployerView"]) and $data["DetailEmployerView"] === "true" ? require_once "./mvc/views/pages/detail_employer.php" : ""?>
<!--                    --><?php //isset($data["StockInView"]) and $data["StockInView"] === "true" ? require_once "./mvc/views/pages/stock_in.php" : ""?>
<!--                    --><?php //isset($data["DetailStockInRequestView"]) and $data["DetailStockInRequestView"] === "true" ? require_once "./mvc/views/pages/detail_stock_in.php" : ""?>
<!--                    --><?php //isset($data["StockOutView"]) and $data["StockOutView"] === "true" ? require_once "./mvc/views/pages/stock_out.php" : ""?>
<!--                    --><?php //isset($data["DetailStockOutRequestView"]) and $data["DetailStockOutRequestView"] === "true" ? require_once "./mvc/views/pages/detail_stock_out.php" : ""?>
                </div>
<!--                --><?php
//                if ($active == 0) {
//                    require_once "./mvc/views/pages/intro.php";
//                }
//                ?>
            </div>
        </div>
    </div>
</body>

</html>

