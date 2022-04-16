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
            <?= form_open('product/index')?>
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Nama Produk" name="cariproduk"
                        >
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombolproduk">Cari</button>
                    </div>
                </div>
            <?= form_close();?>
            <table class="table table-md table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barcode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Harga Jual (Rp)</th>
                        <th>Harga Beli (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        $nomor = 1 ;
                        foreach ($dataproduk as $row) :
                    ?>  
                    <tr>
                        <td><?= $nomor++;?></td>
                        <td><?= $row['idbarcode'];?></td>
                        <td><?= $row['pr_name'];?></td>
                        <td><?= $row['ctg_name'];?></td>
                        <td><?= $row['u_name'];?></td>
                        <td style="text-align: right;"><?= number_format($row['sell_prc'], 2,",",".")?></td>
                        <td style="text-align: right;"><?= number_format($row['purchase_prc'], 2,",",".")?></td>
                        <td style="text-align: right;"><?= number_format($row['readystock'], 0,",",".")?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="float-left">
                <?= $pager->links('product', 'product_pagination'); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection()?>