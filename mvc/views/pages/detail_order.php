<?php
$order = $data["OrderInfo"]->fetch_assoc();
?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <H5 class="text-center my-3">CHI TIẾT ĐƠN HÀNG</H5>

    <?php
    $id_order = $order["IdDonHang"];
    $isEmployer = false;

    if ($_SESSION["permission"] == 4) {
        $url = $root . 'Home/UpdateOrder/' . $id_order;
        $isEmployer = false;
    } else if ($_SESSION["permission"] == 3) {
        $url = $root . 'Home/UpdateProcessOrder/' . $id_order;
        $isEmployer = true;
    }

    ?>

    <form class="p-2" method="post" action="<?= $url ?>">
        <div class="form-group row">
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">Mã đơn hàng</span>
                </div>
                <input type="text" class="form-control" readonly value="<?= $order["IdDonHang"] ?>">
            </div>

            <div class="input-group mb-3 col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">Ngày tạo</span>
                </div>
                <input type="text" class="form-control" readonly value="<?= $order["OrderTime"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-7">
                <div class="input-group-append">
                    <span class="input-group-text">Họ tên người nhận</span>
                </div>
                <input name="fullname" type="text" class="form-control" value="<?= $order["FullnameReceiver"] ?>">
            </div>

            <div class="input-group mb-3 col-md-5">
                <div class="input-group-append">
                    <span class="input-group-text">Số điện thoại</span>
                </div>
                <input name="phone" type="text" class="form-control" value="<?= $order["PhoneReceiver"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-8">
                <div class="input-group-append">
                    <span class="input-group-text">Địa chỉ người nhận</span>
                </div>
                <input name="address" type="text" class="form-control" value="<?= $order["AddressReceiver"] ?>">
            </div>

            <div class="input-group mb-3 col-md-4">
                <div class="input-group-append">
                    <span class="input-group-text">Thu hộ</span>
                </div>
                <input name="collect" type="text" class="form-control" value="<?= $order["Collect"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-4">
                <div class="input-group-append">
                    <span class="input-group-text">Trọng lượng (Kg)</span>
                </div>
                <input name="weight" type="text" class="form-control" value="<?= $order["Weight"] ?>">
            </div>

            <div class="input-group mb-3 col-md-4">
                <div class="input-group-append">
                    <span class="input-group-text">Chi phí</span>
                </div>
                <input <?= $isEmployer ? 'name="cost"' : "" ?> value="<?= $order["Cost"] ?>" type="text" class="form-control" <?= $isEmployer ? "" : "readonly" ?> value="<?= $order["Cost"] ?>">
            </div>

            <div class="input-group mb-3 col-md-4">
                <div class="input-group-append">
                    <span class="input-group-text">Trạng thái</span>
                </div>
                <input <?= $isEmployer ? 'name="status"' : "" ?> type="text" class="form-control" <?= $isEmployer ? "" : "readonly" ?> value="<?= $order["Status"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">Ngày lấy</span>
                </div>
                <input <?= $isEmployer ? 'name="picktime"' : "" ?> type="text" class="form-control" <?= $isEmployer ? "" : "readonly" ?> value="<?= $order["PickTime"] ?>">
            </div>

            <div class="input-group mb-3 col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">Ngày giao</span>
                </div>
                <input <?= $isEmployer ? 'name="deliverytime"' : "" ?> type="text" class="form-control" <?= $isEmployer ? "" : "readonly" ?> value="<?= $order["DeliveryTime"] ?>">
            </div>
        </div>

        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary mx-3">Lưu thay đổi</button>
            <?php if (!$isEmployer) { ?>
            <button id="<?= $order["IdDonHang"] ?>" data-toggle="modal" type="button" class="delete_order btn btn-danger ml-3">Xóa hoá đơn</button>
            <?php
            } ?>

            <button type="button" class="btn btn-secondary" onclick="window.location='<?= $root . "Home/" . ($isEmployer ? "ProcessOrder" : "Order") ?>';">Hủy bỏ</button>
        </div>

    </form>
</div>

<!-- Xóa hóa đơn -->
<div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="deleteOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title my-2" id="deleteModalLabel">Xác nhận xóa</h3>
                <div>Bạn có chắc chắn muốn xóa đơn hàng này?</div>
                <div>Việc này sẽ xóa vĩnh viễn không thể khôi phục.</div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                <a id="sure" type="button" class="btn btn-primary">Chắc chắn</a>
            </div>
        </div>
    </div>
</div>