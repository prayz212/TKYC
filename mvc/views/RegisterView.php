<?php 
    if (isset($data["error"])) {
        $error = $data["error"];
    }

    $error = "";

    $url = explode("/", filter_var(trim($_GET["url"], "/")));

    $action = $url[1];
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
    <title>Đăng ký</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <script src="<?= $root . "public/myscript.js" ?>"></script>

</head>
<body>
    <div class="container">
        <div class="container">
            <h3 class="text-center text-secondary mt-5 mb-1">Tạo tài khoản</h3>
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8 border my-3 p-4 rounded mx-3 bg-light">
                    <form method="post" action="../Account/Register" novalidate onsubmit="return checkRegister()" >
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input value="" name="last" required class="form-control" type="text" placeholder="Họ" id="lastname" onkeypress="clearError()">
                            </div>
                            <div class="form-group col-md-6">
                                <input value="" name="first" required class="form-control" type="text" placeholder="Tên" id="firstname" onkeypress="clearError()">
                            </div>
                        </div>
                        <div class="form-group">
                            <input value="" name="email" required class="form-control" type="email" placeholder="Email" id="email" onkeypress="clearError()">
                        </div>
                        <div class="form-group">
                            <input value="" name="user" required class="form-control" type="text" placeholder="Tên tài khoản" id="user" onkeypress="clearError()">
                        </div>
                        <div class="form-group">
                            <input  value="" name="pass" required class="form-control" type="password" placeholder="Mật khẩu" id="pass" onkeypress="clearError()">
                        </div>
                        <div class="form-group">
                            <input value="" name="pass-confirm" required class="form-control" type="password" placeholder="Xác nhận mật khẩu" id="pass2" onkeypress="clearError()">
                        </div>

                        <div class="form-group">
                            <input value="" name="address" required class="form-control" type="text" placeholder="Địa chỉ" id="address" onkeypress="clearError()">
                        </div>
                        <div class="form-group">
                            <input  value="" name="Phone" required class="form-control" type="text" placeholder="Số điện thoại" id="phone" onkeypress="clearError()">
                        </div>
                        <div class="form-group">
                            <input value="" name="Gender" required class="form-control" type="text" placeholder="Giới tính" id="gender" onkeypress="clearError()">
                        </div>
                        <div class="form-group">
                            <input type="date" id="birthday" name="bday" min="1000-01-01"
                                   max="3000-12-31" class="form-control" onchange="clearError()">
                        </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-success px-5 mt-3 mr-2 w-100">Đăng ký</button>
                        </div>

                        <div id="error_register"><?= $error ?></div>
                        <div class="form-group">
                            <p>Bạn đã có tài khoản? <a href="../Account/Login">Đăng nhập</a> ngay.</p>
                        </div>
                    </form>
    
                </div>
            </div>
    
        </div>
    </div>

</body>
</html>