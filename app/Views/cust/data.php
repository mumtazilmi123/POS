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
            <form method="POST" action="/cust/index">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Customers" name="caricust"
                        autofocus value="<?= $cari; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolcust">Cari</button>
                    </div>
                </div>
            </form>

            <table class="table table-md table-striped table-boredered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customers</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php 
                    $nomor = 1 + (($nohalaman - 1) * 6);
                    foreach ($datacust as $row) :
                    ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $row['cust_name']; ?></td>
                        <td><?= $row['cust_phone']; ?></td>
                        <td><?= $row['cust_address']; ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" title="Hapus Customer"
                                onclick="hapus('<?= $row['cust_id'] ?>','<?= $row['cust_name'] ?>', '<?= $row['cust_phone'] ?>','<?= $row['cust_address'] ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-info btn-sm" title="Edit Customer"
                                onclick="edit('<?= $row['cust_id'] ?>')">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="float-center">
                <?= $pager->links('cust', 'paging_data'); ?>
            </div>
        </div>


    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
function hapus(id, name) {
    Swal.fire({
        title: 'Hapus Customer',
        html: `Yakin hapus Customer <strong>${name}</strong> ini ?`,
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
                url: "<?= site_url('cust/hapus') ?>",
                data: {
                    idcust: id
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
        url: "<?= site_url('cust/editcust') ?>",
        data: {
            idcust: id
        },
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('.viewmodal').html(response.data).show();
                $('#modalformedit').on('shown.bs.modal', function(event) {
                    $('#namacust').focus();
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
            url: "<?= site_url('cust/addcust') ?>",
            dataType: "json",
            type: 'post',
            data: {
                aksi: 0
            },
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahcust').on('shown.bs.modal', function(event) {
                        $('#namacust').focus();
                    });
                    $('#modaltambahcust').modal('show');
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