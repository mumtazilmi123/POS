<?= $this->extend('theme/layout') ?>

<?= $this->section('menu')?>

<li class="nav-item">
    <a href="<?= site_url('home')?>" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Home
        </p>
    </a>
</li>
<li class="nav-header">Menu Utama</li>
<li class="nav-item">
    <a href="<?= site_url('category/index')?>" class="nav-link">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Kategori
        </p>
    </a>
</li>
<?= $this->endSection()?>