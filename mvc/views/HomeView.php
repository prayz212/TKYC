<?php

$root = "";

if (isset($_GET["url"])) {
    $url = explode("/", filter_var(trim($_GET["url"], "/")));
    $level = count($url);

    while ($level > 1) {
        $root = $root . "../";
        $level--;
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Home</title>
    <style>
        p.lead {
            padding-top: 20px;
            font-weight: 400;
            line-height: 40px;
        }
        h5 {
            padding-top: 20px; 
            line-height: 30px;
        } 
    </style> 
</head>
<body>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $root . "Home/Intro" ?>">Home</a>
                    </li>
                    <?php
                    if ($_SESSION["permission"] == 4) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $root . "Home/Order" ?>">Tạo đơn hàng</a>
                    </li>
                    <?php
                    }
                    if ($_SESSION["permission"] == 3) { ?>
                    <li>
                        <a class="nav-link" href="<?= $root . "Home/ProcessOrder" ?>">Xử lý đơn hàng</a>
                    </li>
                    <?php
                    }
                    if ($_SESSION["permission"] == 2) { ?>
                    <li>
                        <a class="nav-link" href="<?= $root . "Home/StockManagement" ?>">Quản lý kho</a>
                    </li>
                    <?php
                    }
                    if ($_SESSION["permission"] == 1) { ?>
                    <li>
                        <a class="nav-link" href="<?= $root . "Home/EmployerManagement" ?>">Quản lý tài khoản</a>
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

    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row py-4">
            <div class="col-lg-4 text-center mb-4">
                <img class="rounded-circle" src="<?= $root . "public/imgs/icon1.jpg" ?>" alt="Generic placeholder image" width="140" height="140">
                <h5>Top công ty giao <br> nhận hàng đầu VN</h5>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4 text-center mb-4">
                <img class="rounded-circle" src="<?= $root . "public/imgs/icon2.jpg" ?>" alt="Generic placeholder image" width="140" height="140">
                <h5>Giao hàng nhanh <br> Tỷ lệ hoàn hàng thấp</h5> 
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4 text-center mb-4">
                <img class="rounded-circle" src="<?= $root . "public/imgs/icon3.jpg" ?>" alt="Generic placeholder image" width="180" height="140">
                <h5>Mạng lưới phủ sóng <br> 100% 63 tỉnh thành</h5>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">
        <div class="row featurette py-5 px-1">
            <div class="col-md-6">
                <h2 class="featurette-heading"><span class="text-muted">| Câu chuyện GHN</span></h2>
                <p class="lead">Công ty giao nhận đầu tiên tại Việt Nam được thành lập năm 2012, với sứ mệnh phục vụ nhu cầu vận chuyển chuyên nghiệp của các đối tác Thương mại điện tử trên toàn quốc. GHN cam kết mang đến cho khách hàng những trải nghiệm dịch vụ giao nhận nhanh, an toàn, hiệu quả giúp người bán hàng bán được nhiều hơn, người mua hàng hài lòng hơn.</p>
            </div>
            <div class="col-md-6">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="<?= $root . "public/imgs/image4.jpg" ?>" data-holder-rendered="true" style="width: 500px; height: 500px;">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette py-5 px-1">
            <div class="col-md-6 order-md-2">
                <h2 class="featurette-heading"><span class="text-muted">| Thành tích nổi bật</span></h2>
                <p class="lead">
                    GHN luôn dành trọn tâm huyết để mang đến những dịch vụ giao nhận xuất sắc nhất. Niềm đam mê chất lượng đã giúp GHN đạt được những thành tích đáng kinh ngạc trong suốt 8 năm qua: <br>
                    - 10.000.000 đơn hàng được giao thành công mỗi tháng <br>
                    - Hơn 100.000 shop online và doanh nghiệp đã tin dùng <br>
                    - Đối tác chiến lược của Tiki, Shopee, Lazada, Sendo <br>
                    - Mạng lưới giao nhận phủ sóng 100% 63 tỉnh thành <br>
                    - Đạt tốc độ xử lý 500.000 đơn hàng/ ngày
                </p>
            </div>
            <div class="col-md-6 order-md-1">
                <img class="featurette-image img-fluid mx-auto" src="<?= $root . "public/imgs/image5.jpg" ?>" alt="500x500" data-holder-rendered="true" style="width: 1000px; height: 500px;">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette py-5 px-1">
            <div class="col-md-7">
                <h2 class="featurette-heading"><span class="text-muted">| Đối tác của GHN</span></h2>
                <p class="lead">
                    Hơn 100.000 khách hàng đã tin dùng dịch vụ, GHN mang đến chất lượng dịch vụ giao hàng tốt nhất cho khách hàng. <br>
                    Chúng tôi cam kết phục vụ một cách trung thực và có trách nhiệm đối với từng đơn hàng của khách hàng.
                </p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500" src="<?= $root . "public/imgs/image6.jpg" ?>" data-holder-rendered="true" style="width: 500px; height: 500px;">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->
        <footer class="container">
            <p>©Ton Duc Thang University.</p>
        </footer>

    </div>

    </div>


</body>
</html>