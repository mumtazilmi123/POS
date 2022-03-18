<?= $this->extend('theme/menu') ?>

<?= $this->section('judul') ?>
Pengelolaan Kategori
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-md btn-primary addButton">
                <i class="fas fa-plus-circle"></i> Tambah Kategori
            </button>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i> 
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="/category/index">
            <?= csrf_field();?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Kategori" aria-label="carikategori" aria-describedby="button-addon2">
                <button class="btn btn-info" type="submit" name="tombolkategori">Cari</button>
            </div>
        </form>
        <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 1 + (($pages - 1) * 5);
                        foreach($categorydata as $row):
                        
                    ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $row['ctg_name'];?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-md" onclick="delete('<?= $row['ctg_id']?>')">
                            <i class="fas fa-eraser"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
        </table>
        <div class="float-center">
            <?= $pager->links('category','pages_data')?>
        </div>
    </div>
</div>

<div class="viewmodal" style="display:none,"></div>

<script>
    $(document).ready(function () {
        $('.addButton').click(function(e){
            e.preventDefault

            $.ajax({
                url: "<?= site_url('category/addForm')?>",
                dataType: "json",
                success: function (response) {
                    if(response.data){
                        $('.viewmodal').html(response.data).show()
                        
                        $('#modaladdcategory').on('shown.bs.modal', function (event) {
                            $('categoryname').focus();
                        });

                        $('#modaladdcategory').modal('show');
                    }
                },
                error : function(xhr, thrownError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +thrownError);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>