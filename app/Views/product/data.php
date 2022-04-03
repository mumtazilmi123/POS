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
        
    </div>
</div>

<?= $this->endSection()?>