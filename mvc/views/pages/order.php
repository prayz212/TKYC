<?php
$isShow = false;
if (isset($data["ListOrder"]) and $data["ListOrder"] != false) {
    $isShow = true;
    $listOrder = $data["ListOrder"];
}

?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <H5 class="text-center my-3">DANH SÁCH ĐƠN HÀNG</H5>
    <?php
    if ($_SESSION["permission"] == 4) {
    ?>

    <div class="d-flex flex-row-reverse">
        <a role="button" aria-pressed="true" class="mb-3" data-toggle="modal" data-target="#createOrder">
            <button class="btn btn-primary">
                Tạo đơn hàng
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </button>

        </a>
    </div>

    <?php
    }
    ?>

    <table class="table text-center table-hover">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Mã đơn hàng</th>
            <th scope="col">Khối lượng</th>
            <th scope="col">Chi phí</th>
            <th scope="col">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if ($isShow) {
            $number = 1;
            while ($row = $listOrder->fetch_assoc()) {
                $id = $row["IdDonHang"];
                ?>
        <tr id="<?= $id ?>" class="table-row-order">
            <th scope="row"><?= $number ?></th>
            <td><?= $id ?></td>
            <td><?= $row["Weight"] ?></td>
            <td><?= $row["Cost"] ?></td>
            <td><?= $row["Status"] ?></td>
        </tr>
        <?php
                $number++;
            }
        } else { ?>
            <td colspan="5">Chua co don hàng</td>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tạo mới đơn hàng -->
<div class="modal fade" id="createOrder" tabindex="-1" role="dialog" aria-labelledby="createOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOrderLabel">Thêm nhân viên mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $root . "Home/NewOrder" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="fullname" type="text" class="form-control" placeholder="Nhập họ tên người nhận">
                    </div>
                    <div class="form-group">
                        <input name="phone" type="text" class="form-control" id="class-room" placeholder="Nhập số điện thoại người nhận">
                    </div>
                    <div class="form-group">
                        <input name="address" type="text" class="form-control" id="class-room" placeholder="Nhập địa chỉ người nhận">
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3 col-md-6">
                            <div class="input-group-append">
                                <span class="input-group-text">Trọng lượng</span>
                            </div>
                            <input name="weight" type="number" class="form-control" placeholder="">
                        </div>

                        <div class="input-group mb-3 col-md-6">
                            <div class="input-group-append">
                                <span class="input-group-text">Thu hộ</span>
                            </div>
                            <input name="collect" type="number" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Thêm đơn hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>
