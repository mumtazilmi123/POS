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
    <a href="<?= site_url('cust/index')?>" class="nav-link">
        <i class="nav-icon far fa-user"></i>
        <p>
            Customer
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('supplier/index')?>" class="nav-link">
        <i class="nav-icon fas fa-truck"></i>
        <p>
            Supplier
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('category/index')?>" class="nav-link">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>
            Kategori
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('units/index')?>" class="nav-link">
        <i class="nav-icon fas fa-list"></i>
        <p>
            Satuan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('product/index')?>" class="nav-link">
        <i class="nav-icon fas fa-archive"></i>
        <p>
            Produk
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= site_url('/index')?>" class="nav-link">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>
            Pembayaran
        </p>
    </a>
</li>
<?= $this->endSection()?>