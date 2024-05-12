$(document).ready(function () {
  let confirmed_edit_user = false;
  $("#btn-edit-user").on("click", function (event) {
    event.preventDefault();
    let form = $(this).closest("form");
    my_confirm("Xác nhận thay đổi thông tin tài khoản!", function () {
      confirmed_edit_user = true;
      form.submit();
    });
    return confirmed_edit_user;
  });

  let confirmed_remove_product_from_cart = false;
  $(".btn-remove-product-from-cart").on("click", function (event) {
    event.preventDefault();
    let form = $(this).closest("form");
    my_confirm("Xác nhận xóa sản phẩm ra khỏi giỏ hàng", function () {
      confirmed_remove_product_from_cart = true;
      form.submit();
    });
    return confirmed_remove_product_from_cart;
  });

  let confirmed_user_cancel_order = false;
  $('.btn-user-cancel-order').on("click", function(event){
    event.preventDefault();
    let form = $(this).closest("form");
    my_confirm("Xác nhận <b>hủy</b> đơn hàng!", function () {
      confirmed_user_cancel_order = true;
      form.submit();
    });
    return confirmed_user_cancel_order;
  });

  let confirmed_user_submit_cart = false;
  $('.btn-user-submit-cart').on("click", function(event){
    event.preventDefault();
    let form = $('#send-cart-form');
    let order_phone = $('#order_phone').val();
    let order_address = $('#order_address').val();

    const phoneRegex = /^\d{10,11}$/;

    if(order_address === '' || order_address === ''){
      my_alert('Vui lòng điền đầy đủ thông tin');
      return false;
    }
    if(!phoneRegex.test(order_phone)){
      my_alert('Vui lòng điền số điện thoại hợp lệ');
      return false;
    }
    confirmed_user_submit_cart = true;
    form.submit();
    return confirmed_user_submit_cart;
  })

  let confirmed_admin_accept_order = false;
  $('.btn-admin-accept-order').on("click", function(event){
    event.preventDefault();
    let form = $(this).closest("form");
    my_confirm("Xác nhận duyệt đơn hàng!", function () {
      confirmed_admin_accept_order = true;
      form.submit();
    });
    return confirmed_admin_accept_order;
  });

  let confirmed_admin_remove_order = false;
  $('.btn-admin-remove-order').on("click", function(event){
    event.preventDefault();
    let form = $(this).closest("form");
    my_confirm("Xác nhận <b>xóa vĩnh viễn</b> đơn hàng!", function () {
      confirmed_admin_remove_order = true;
      form.submit();
    });
    return confirmed_admin_remove_order;
  })

  let confirmed_admin_remove_product = false;
  $('.btn-admin-remove-product').on("click", function(event){
    event.preventDefault();
    let form = $(this).closest("form");
    my_confirm("Xác nhận <b>xóa sản phẩm</b> !", function () {
      confirmed_admin_remove_product = true;
      form.submit();
    });
    return confirmed_admin_remove_product;
  })
});
