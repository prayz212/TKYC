$(document).ready(function(){
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
    //
    // $(".delete_request_stock_in").click(function () {
    //     let id = $(this).attr('id');
    //
    //     $('#deleteRequest').modal('show');
    //
    //     $('#sure').on('click', function () {
    //         window.location.replace("../../Home/DeleteRequest/" + id);
    //     });
    // });

    $('.table-row-order').click(function() {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailOrder/" + id)
    });

    $('.table-row-employer').click(function() {
        let id = $(this).attr('id');
        window.location.replace("../Home/DetailEmployer/" + id)
    });
    //
    // $('.table-row-stock-in').click(function() {
    //     let id = $(this).attr('id');
    //     window.location.replace("../Home/DetailStockInRequest/" + id)
    // });



    if ($(".change-permission-alert").length) {
        setTimeout(function () { $('.change-permission-alert').hide(); }, 5000);
    }
});
