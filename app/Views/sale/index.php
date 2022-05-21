<?= $this->extend('theme/menu') ?>

<?= $this->section('judul') ?>
<i class="fa fa-fw fa-table"></i> Menu Penjualan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Input</h3>
                <p>Kasir</p>
            </div>
            <div class="icon"><i class="fas fa-cash-register"></i>
            </div>
        <a href="<?= site_url('sale/input')?>" class="small-box-footer">Input Penjualan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Data</h3>
                <p>Penjualan</p>
            </div>
            <div class="icon"><i class="fa fa-bag"></i>
        </div>
        <a href="<?= site_url('sale/data')?>" class="small-box-footer">Input Penjualan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    


</div>

<?= $this->endSection() ?>