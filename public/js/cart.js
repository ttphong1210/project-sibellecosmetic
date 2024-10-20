$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(document).on("click", ".add-to-cart", function (event) {
        event.preventDefault();
        let addToCartUrl = $(this).data("url");
        var qty = $(this).data['input=name"quantity"'];
        var token = $("input[name='_token']").val();

        $.ajax({
            type: "GET",
            url: addToCartUrl,
            dataType: "json",
            data: {
                qty: qty,
                token: token,
            },
            success: function (response) {
                alert(response.message);
                $("#list-product-minicart").html(response.mini_cart);
            },
            error: function (xhr, status, error) {
                alert(response.error);
            },
        });
    });
    $(document).on("click", ".btn-delete", function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        var deleteCartUrl = $(this).data("url");
        var token = $("input[name='_token']").val();
        if (confirm("Bạn có chắc chắn xoá không ?")) {
            $.ajax({
                type: "POST",
                url: deleteCartUrl,
                data: {
                    id: id,
                    _token: token,
                    _method: "DELETE",
                },
                success: function (response) {
                    if(response.code === 200){
                        alert(response.message);
                        $("#list-product-minicart").html(response.mini_cart);
                        $("#cart-content").html(response.cart_component);
                        $("#header-shopping-cart").html(
                            "<span> Giỏ hàng ( " +
                            response.count_item_cart + " sản phẩm )</span>"
                        );
                    }
                },
                error: function (xhr, status, error) {
                    alert(response.error);
                },
            });
        }
    });

    $(document).ready(function () {
        $(document).on("click", ".plus-btn", function () {
            var rowId = $(this).data("id");
            var cartUpdateUrl = $(this).data("url");
            var inputElement = $("#number-quantity-" + rowId);
            var currentQty = parseInt(inputElement.val(), 10);
            var newQty = currentQty + 1;
            cartUpdate(rowId, newQty, cartUpdateUrl);
        });
        $(document).on("click", ".minus-btn", function () {
            var rowId = $(this).data("id");
            var cartUpdateUrl = $(this).data("url");
            var inputElement = $("#number-quantity-" + rowId);
            var currentQty = parseInt(inputElement.val(), 10);
            var newQty = currentQty > 1 ? currentQty - 1 : 1;
            cartUpdate(rowId, newQty, cartUpdateUrl);
        });
        function cartUpdate(rowId, newQty, cartUpdateUrl) {
            var token = $("input[name='_token']").val();
            $.ajax({
                method: "GET",
                url: cartUpdateUrl,
                data: {
                    rowId: rowId,
                    qty: newQty,
                    _token: token,
                },
                dataType: "json",
                success: function (data) {
                    if (data.code === 200) {
                        alert(data.message);
                        $("#number-quantity-" + rowId).val(newQty);
                        $("#cart-content").html(data.cart_component);
                        $("#list-product-minicart").html(data.mini_cart);
                        $("#header-shopping-cart").html(
                            "<span> Giỏ hàng ( " +
                                data.count_item_cart +
                                " sản phẩm )</span>"
                        );
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Cập nhật giỏ hàng thất bại:", error);
                },
            });
        }
    });
});
