<!-- Modal thông báo -->
<div class="modal fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><b style="color: #182c47;">Thông báo!</b></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <p style="font-size: larger;"  id="confirmBody"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="button" style="background-color: #070c64" class="btn btn-secondary" id="confirmButton">Chấp nhận</button>
      </div>
    </div>
  </div>
</div>



<!--  -->






<!-- Thư viện jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Thư viện Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
function my_confirm(content, callback) {
  var modal = $('#confirmModal');
  var confirmButton = $('#confirmButton');

  $('#confirmBody').html(content);

  // Hiển thị modal
  modal.modal('show');

  // Xử lý sự kiện khi nút xác nhận được nhấn
  confirmButton.click(function() {
    // Gọi callback function nếu đã được cung cấp
    if (typeof callback === 'function') {
      callback();
    }
    // Đóng modal
    modal.modal('hide');
  });
}

</script>
