$(document).ready(function(){
    //Check Phần tìm kiếm
  $('#search-button').on('click', function(event) {
    event.preventDefault();
    let keyword = $('#search-input').val();
    if (keyword.trim() == '') {
      my_alert('Vui lòng nhập từ khóa tìm kiếm');
    } else {
      $('#search-form').submit();
    }
  });

   //Hiển thị hành ảnh previews
   $('#productImage').on('change', function() {
    var input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#previewImage')
          .attr('src', e.target.result)
          .show();
      };
      reader.readAsDataURL(input.files[0]);
    }
  });

  //Nut thay doi mat khau
  $('#change-password-btn').on('click', function() {
    $('#div-change-password').toggleClass('d-none');
    $('#div-change-password #password').val('');
    $('#div-change-password #new_password').val('');
    $('#div-change-password #re_new_password').val('');
  });


  // Hiển thị cây viết kế bên ô input ở phần thay đổi sản phẩm số lượng
  $('.input-change-quantity-in-cart').on('input', function() {
    if ($(this).val() != $(this).closest('input[name="old_quantity').val()) {
      $(this).siblings('.btn-change-quantity-in-cart').removeClass('d-none');
    }
  });
  
});