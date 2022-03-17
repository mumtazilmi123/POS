<?= $this->extend('theme/layout') ?>

<?= $this->section('judul') ?>
<h3>Selamat Datang</h3>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> Selamat Datang !</h5>
    Ini Percobaan ya
</div>
<?= $this->endSection() ?>