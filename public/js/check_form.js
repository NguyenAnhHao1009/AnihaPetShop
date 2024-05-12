  //Kiểm tra form tạo sản phẩm
  $('form#create-product-form').submit(function(event) {
    event.preventDefault();
    const productName = $('#product_name').val().trim();
    const description = $('#description').val().trim();
    const productImage = $('#productImage').val().trim();
    const unit_price = $('#unit_price').val().trim();
    const stock_quantity = $('#stock_quantity').val().trim();

 
    
    if (productName === '') {
      my_alert('Vui lòng nhập tên sản phẩm.');
      return;
    }
    if (description.length < 20) {
      my_alert('Mô tả phải có ít nhất 20 từ.');
      return;
    }
    if (stock_quantity === '') {
      my_alert('Vui lòng nhập số lượng sản phẩm');
      return;
    }

    if (stock_quantity <=0 ) {
      my_alert('Số lượng sản phẩm không hợp lệ.');
      return;
    }

    if (unit_price === '') {
      my_alert('Vui lòng nhập giá tiền của sản phẩm.');
      return;
    }

    if (unit_price <= 0) {
      my_alert('Giá tiền không hợp lệ');
      return;
    }

   
    if (productImage === '') {
      my_alert('Vui lòng chọn hình ảnh.');
      return;
    }
    const imgFormat = /(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i;
    if (!imgFormat.exec(productImage)) {
      my_alert('Định dạng file này không được hỗ trợ, chỉ hổ trợ jpg, jpeg, png, gif, jfif');
      return;
    }
    $(this).off('submit').submit();
  });

  //Kiểm tra form sửa sản phẩm
  $('form#edit-product-form').submit(function(event) {
    event.preventDefault();
    const productName = $('#product_name').val().trim();
    const description = $('#description').val().trim();
    const productImage = $('#productImage').val().trim();
    const unit_price = $('#unit_price').val().trim();
    const stock_quantity = $('#stock_quantity').val().trim();


    if (productName === '') {
      my_alert('Vui lòng nhập tên sản phẩm.');
      return;
    }
    if (description.length < 20) {
      my_alert('Mô tả phải có ít nhất 20 từ.');
      return;
    }
    if (stock_quantity === '') {
      my_alert('Vui lòng nhập số lượng sản phẩm');
      return;
    }
    if (stock_quantity <0 ) {
      my_alert('Số lượng sản phẩm không hợp lệ.');
      return;
    }

    if (unit_price === '') {
      my_alert('Vui lòng nhập giá tiền của sản phẩm.');
      return;
    }

    if (unit_price <= 0) {
      my_alert('Giá tiền không hợp lệ');
      return;
    }

    $(this).off('submit').submit();
  });


  //Kiem tra form chinh sua thong tin ca nhan
  $('#user-info-form').submit(function(event) {

    event.preventDefault();
    const username = $('#user_name').val().trim();
    const email = $('#email').val().trim();
    const phone = $('#phone_number').val().trim();
    const address = $('#address').val().trim();
    

  
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^\d{10,11}$/;

    if (username === '') {
      my_alert('Vui lòng nhập tên người dùng.');
      return;
    }
    if (email === '') {
      my_alert('Vui lòng nhập email.');
      return;
    }
    if (phone === '') {
      my_alert('Vui lòng nhập số điện thoại.');
      return;
    }
    if (address === '') {
      my_alert('Vui lòng nhập địa chỉ.');
      return;
    }

    if (!emailRegex.test(email)) {
      my_alert('Email không hợp lệ. Vui lòng nhập email hợp lệ.');
      return;
    }
    if (!phoneRegex.test(phone)) {
      my_alert('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại hợp lệ.');
      return;
    }

  


    $(this).off('submit').submit();
  });