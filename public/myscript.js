$(document).ready(function() {
    $(".delete_order").click(function () {
        let id = $(this).attr('id');
        console.log(id);

        $('#deleteOrder').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Home/DeleteOrder/" + id);
        });
    });

    $(".delete_employer").click(function () {
        let id = $(this).attr('id');

        $('#deleteEmployer').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Home/DeleteEmployer/" + id);
        });
    });

    $(".stock_out").click(function () {
        let id = $(this).attr('id');

        $('#export').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../Home/StockOut/" + id);
        })
    })

    $(".delete_request_stock_in").click(function () {
        let id = $(this).attr('id');

        $('#deleteRequest').modal('show');

        $('#sure').on('click', function () {
            window.location.replace("../../Home/DeleteRequest/" + id);
        });
    });

    $('.table-row-order').click(function () {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailOrder/" + id)
    });

    $('.table-row-employer').click(function () {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailEmployer/" + id)
    });

    $('.table-row-stock-in').click(function () {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailStockInRequest/" + id)
    });

    if ($(".change-permission-alert").length) {
        setTimeout(function () {
            $('.change-permission-alert').hide();
        }, 5000);
    }
})

function clearError() {
    document.getElementById("error_register").innerHTML = "";
}

function checkRegister() {
    let usernameBox = document.getElementById('user');
    let passwordBox = document.getElementById('pass');
    let repasswordBox = document.getElementById('pass2');
    let firstnameBox = document.getElementById('firstname');
    let lastnameBox = document.getElementById('lastname');
    let emailBox = document.getElementById('email');
    let phoneBox = document.getElementById('phone');
    let birthdayBox = document.getElementById('birthday');
    let genderBox = document.getElementById("gender");
    let addressBox = document.getElementById("address");
    let error = document.getElementById("error_register");

    let username = usernameBox.value.trim();
    let password = passwordBox.value;
    let repassword = repasswordBox.value;
    let firstname = firstnameBox.value.trim();
    let lastname = lastnameBox.value.trim();
    let email = emailBox.value.trim();
    let phone = phoneBox.value;
    let birthday = birthdayBox.value;
    let gender = genderBox.value;
    let address = addressBox.value;

    error.style.color = "red";
    if (lastname.length === 0) {
        error.innerHTML = "Họ người dùng bỏ trống";
        lastnameBox.focus();
    }
    else if (firstname.length === 0) {
        error.innerHTML = "Tên người dùng bỏ trống";
        firstnameBox.focus();

    } else if (email.length === 0) {
        error.innerHTML = "Email người dùng bỏ trống";
        emailBox.focus();

    } else if (username.length === 0) {
        error.innerHTML = "Tên tài khoản người dùng bỏ trống";
        usernameBox.focus();

    } else if (username.length < 6 || username.length > 15) {
        error.innerHTML = "Tên tài khoản nên có từ 6 tới 15 ký tự";
        usernameBox.focus();
    }
    else if (password.length === 0) {
        error.innerHTML = "Mật khẩu người dùng bỏ trống";
        passwordBox.focus();

    } else if (password.length < 6 || password.length > 15) {
        error.innerHTML = "Mật khẩu nên có từ 6 tới 15 ký tự";
        passwordBox.focus();

    } else if (repassword !== password) {
        error.innerHTML = "Mật khẩu không trùng khớp";
        repasswordBox.focus();

    }
    else if (address.length === 0) {
        error.innerHTML = "Địa chỉ người dùng bỏ trống";
        addressBox.focus();
    }
    else if (phone.length === 0) {
        error.innerHTML = "Số điện thoại người dùng bỏ trống";
        phoneBox.focus();

    }
    else if (gender.length === 0 ) {
        error.innerHTML = "Giới tính người dùng bỏ trống";
        genderBox.focus();

    } else if (birthday === "") {
        error.innerHTML = "Ngày sinh người dùng bỏ trống";
        birthdayBox.focus();

    } else {
        return true;
    }
    return false;
}