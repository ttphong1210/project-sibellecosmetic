$(document).ready(function () {
    $('#dataInputSearch').on('keyup', function () {
        var inputQuery = $(this).val();

        $.ajax({
            url: "/admin/product/search",
            method: "GET",
            data: {
                inputQuery: inputQuery,
            },
            success: function (response){
                $('#productList').html(response);
            },
        });
    });

    $('.toggle-status').on('change', function(){
        var slider_id = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;
       
        $.ajax({
            url: "/admin/slider/update-status-slider",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                slider_id: slider_id,
                status: status,
            },
            success: function (response){
                alert(response.message);
            },
            error: function (jqXHR, textStatus, errorTh){
                alert("Cập nhật trạng thái thất bại.");
            },
        });
    });

    $(document).on('click', '.list-group-item', function (e) {
        e.preventDefault();
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');

        $('.tab-pane').removeClass('active-show');
        const target = $(this).attr('href');
        setTimeout(() => {
            $(target).addClass('active-show');
        }, 100);

    });

});