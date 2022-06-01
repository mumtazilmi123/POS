<?= $this->extend('theme/menu') ?>

<?= $this->section('judul') ?>
Pengelolaan Data Produk
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-md btn-primary" onclick="window.location='<?= site_url('product/add')?>'">
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
            <?= form_open('product/index'); ?>
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Produk" name="cariproduk">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolproduk">Cari</button>
                    </div>
                </div>
            <?= form_close(); ?>
            <table class="table table-md tabel-bordered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Barcode</td>
                        <td>Nama Produk</td>
                        <td>Kategori</td>
                        <td>Satuan</td>
                        <td>Stok</td>
                        <td>Harga Beli</td>
                        <td>Harga Jual</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 1 + (($nohalaman - 1)*10);
                        foreach($dataproduk as $r):
                    ?>
                    <tr>
                        <td><?= $nomor++;?></td>
                        <td><?= $r['idbarcode'];?></td>
                        <td><?= $r['pr_name'];?></td>
                        <td><?= $r['pr_uid'];?></td>
                        <td><?= $r['pr_ctgid'];?></td>
                        <td style="text-align: right;"><?= number_format($r['readystock'],2, ",", ".");?></td>
                        <td style="text-align: right;"><?= number_format($r['harga_beli'], 2, "," , ".");?></td>
                        <td style="text-align: right;"><?= number_format($r['harga_jual'],2, ",", ".");?></td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="apus('<?= $r['idbarcode'] ?>','<?= $r['pr_name'] ?>', '<?= $r['pr_ctgid'] ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </tab>
        </div>
    </div>


<script>
    fuction hapus(id, name){
        Swal.fire({
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
                url: "<?= site_url('product/hapus') ?>",
                data: {
                    code:kode
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
    };
</script>
<?= $this->endSection()?>