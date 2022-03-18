<div class="modal fade" id="modaladdcategory" tabindex="-1" aria-labelledby="modaladdcategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaladdcategoryLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('category/saved', ['class' => 'saveform']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Kategori</label>
                    <input type="text" name="categoryname" id="categoryname" class="form-control form-control-sm"
                        required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary saveButton">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.saveform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function(e) {
                $('.saveButton').prop('disabled', true);
                $('.saveButton').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            success: function(response) {
                if(response.success){
                    alert(response.success);
                    window.location.reload()
                };
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    });
});
</script>