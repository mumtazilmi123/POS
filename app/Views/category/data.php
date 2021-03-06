<?= $this->extend('theme/menu') ?>

<?= $this->section('judul') ?>
Pengelolaan Kategori
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-md btn-primary tombolTambah">
                <i class="fa fa-plus-circle"> </i> Tambah Data
            </button>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action="/category/index">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Kategori" name="carikategori"
                        autofocus value="<?= $cari; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolkategori">Cari</button>
                    </div>
                </div>
            </form>

            <table class="table table-md table-striped table-boredered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Brand</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php 
                    $nomor = 1 + (($nohalaman - 1) * 6);
                    foreach ($datakategori as $row) :
                    ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $row['ctg_name']; ?></td>
                        <td><?= $row['ctg_brand'];?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" title="Hapus Kategori"
                                onclick="hapus('<?= $row['ctg_id'] ?>','<?= $row['ctg_name'] ?>', '<?= $row['ctg_brand'] ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-sm" title="Edit Kategori"
                                onclick="edit('<?= $row['ctg_id'] ?>')">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="float-center">
                <?= $pager->links('category', 'paging_data'); ?>
            </div>
        </div>


    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
function hapus(id, name) {
    Swal.fire({
        title: 'Hapus Kategori',
        html: `Yakin hapus kategori <strong>${name}</strong> ini ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus !',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?= site_url('category/hapus') ?>",
                data: {
                    idkategori: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        window.location.reload();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    })
}

function edit(id) {
    $.ajax({
        type: "post",
        url: "<?= site_url('category/formEdit') ?>",
        data: {
            idkategori: id
        },
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('.viewmodal').html(response.data).show();
                $('#modalformedit').on('shown.bs.modal', function(event) {
                    $('#namakategori').focus();
                });
                $('#modalformedit').modal('show');
            }
        },
        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}


$(document).ready(function() {
    $('.tombolTambah').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: "<?= site_url('category/formTambah') ?>",
            dataType: "json",
            type: 'post',
            data: {
                aksi: 0
            },
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahkategori').on('shown.bs.modal', function(event) {
                        $('#namakategori').focus();
                    });
                    $('#modaltambahkategori').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
});
</script>
<?= $this->endSection() ?>