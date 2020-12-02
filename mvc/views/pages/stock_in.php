<?php
$isShow = false;
if (isset($data["RequestList"]) and $data["RequestList"] != false) {
    $isShow = true;
    $listRequest = $data["RequestList"];
}

?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <h5 class="text-center my-3">DANH SÁCH YÊU CẦU NHẬP HÀNG</h5>
    <div class="d-flex flex-row-reverse">
        <a role="button" aria-pressed="true" class="mb-3" data-toggle="modal" data-target="#newStockInRequest">
            <button class="btn btn-primary">
                Tạo yêu cầu nhập hàng
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </button>
        </a>
    </div>
    <table class="table text-center table-hover">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Mã yêu cầu</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Kho</th>
            <th scope="col">Ngày yêu cầu</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php

        if ($isShow) {
            $number = 1;
            while ($res = $listRequest->fetch_assoc()) {
                $id = $res["IdRequest"];
                ?>
                <tr>
                    <th scope="row"><?= $number ?></th>
                    <td><?= $id ?></td>
                    <td><?= $res["Note"] ?></td>
                    <td><?= $res["Name"] ?></td>
                    <td><?= $res["Date"] ?></td>
                    <td><button type="button" id="<?= $id ?>"  class="stock_out btn btn-success">Xuất hàng</button></td>
                </tr>
                <?php
                $number++;
            }
        } else { ?>
            <td colspan="6">Chua co yeu cau</td>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tạo mới hoá đơn -->
<div class="modal fade" id="newStockInRequest" tabindex="-1" role="dialog" aria-labelledby="newStockInRequestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newStockInRequestLabel">Tạo yêu cầu nhập hàng mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $root . "Home/NewStockInRequest" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="request_id" id="request_id" type="text" class="form-control rounded w-100" placeholder="Nhập đơn hàng">
                        </div>
                    </div>
                    <div class="form-group">
                        <input name="note" type="text" class="form-control" id="class-room" placeholder="Nhập ghi chú">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="stock" class="w-100">
                            <option value="" selected disabled hidden>Chọn kho</option>
                            <option value="1">Kho A</option>
                            <option value="2">Kho B</option>
                            <option value="3">Kho C</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Tạo yêu cầu</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Xuất đơn hàng -->
<div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title my-2" id="deleteModalLabel">Xác nhận xóa</h3>
                <div>Bạn có chắc chắn muốn xóa nhân viên này?</div>
                <div>Việc này sẽ xóa vĩnh viễn không thể khôi phục.</div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                <a id="sure" type="button" class="btn btn-primary">Chắc chắn</a>
            </div>
        </div>
    </div>
</div>