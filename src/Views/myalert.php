<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content pb-3">
            <div class="modal-header">
                <h4 class="modal-title"><b style="color: #182c47;">Thông báo!</b></h4>
            </div>
            <div class="modal-body" style="font-size: larger;" id="modalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đã hiểu</button>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function my_alert(content) {
        $('#modalBody').html(content);
        $('#myModal').modal('show');
    }
</script>