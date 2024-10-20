
$(document).ready(function () {
    $('input[type="radio"]').click(function() {
        if ($(this).attr("value") == "credit_card") { // Cập nhật giá trị so khớp
            $('#textbox').show();
        } else {
            $('#textbox').hide();
        }
    });
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $("#checkoutForm").on("submit", function (e) {
        e.preventDefault(); // Ngăn chặn form submit theo cách thông thường
        var formData = $(this).serialize(); // Lấy toàn bộ dữ liệu form

        // Hiển thị loader bao phủ toàn bộ trang và làm mờ form
        $("#loader-overlay").show();
        $("#checkoutForm").addClass("loader");

        $.ajax({
            url: "/checkout",
            method: "POST",
            data: formData,
            beforeSend: function () {
                // Xóa tất cả các thông báo lỗi cũ trước khi gửi form
                $(".invalid-feedback").remove();
                $(".is-invalid").removeClass("is-invalid");
            },
            success: function (response) {
                 // Ẩn loader khi xử lý thành công
                 $("#loader-overlay").hide();
                 $("#checkoutForm").removeClass("loader");

                if (response.status === "success") {
                    alert(response.message);
                    setTimeout(function(){
                        window.location.href = '/complete';
                    }, 2000);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.error;
                    $("#loader-overlay").hide();
                    $("#checkoutForm").removeClass("loader");
                    $.each(errors, function (key, value) {
                        var input = $('[name="' + key + '"]');
                        input.addClass("is-invalid");
                        input.after(
                            '<div class="invalid-feedback">' +
                                value[0] +
                                "</div>"
                        );
                    });
                } else {
                    alert("Có lỗi xảy ra: " + xhr.responseJSON.message);
                }
            },
        });
    });
});
