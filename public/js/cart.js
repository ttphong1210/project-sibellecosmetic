
function addToCart(event){
  event.preventDefault();
  let addToCartUrl = $(this).data("url");
  var token = $("input[name='_token']").val(); 

  $.ajax({
    type: "GET",
    url: addToCartUrl,
    dataType: "json",
    data: {
        token: token,
    },
    success: function (response) {
        alert(response.message);
        $('#list-product-minicart').html(response.mini_cart);
    },
    error: function (xhr) {
      alert(response.error);
    },
});
}

function cartUpdate(event) {
  event.preventDefault();
  let cartUpdateUrl = $(this).data('url');
  let id = $(this).data('id');
  let qty = $(this).val();
  var token = $("input[name='_token']").val();

  $.ajax({
      type: 'GET',
      url: cartUpdateUrl,
      data: {
          rowId: id,
          qty: qty,
          _token: token
      },
      dataType: 'json',
      success: function(data) {
          if (data.code === 200) {
              alert(data.message);
              $('#cart-content').html(data.cart_component);
              $('#list-product-minicart').html(data.mini_cart);
              $('#header-shopping-cart').html( '<span> Giỏ hàng ( ' + data.count_item_cart + ' sản phẩm )</span>');
          }
      },
      error: function(error) {

      }
  })
}
$(function() {
  $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
  $(document).on('click', '.add-to-cart', addToCart);
  $(document).on('change keyup', '.cart-update', cartUpdate);
})