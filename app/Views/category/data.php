<?= $this->extend('theme/menu') ?>

<?= $this->section('judul') ?>
Pengelolaan Kategori
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-md btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Kategori
            </button>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i> 
        </div>
    </div>
    <div class="card-body">
        <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1;
                        foreach($categorydata as $row);
                    ?>
                    <tr>
                        <td><?= $nomor++;?></td>
                        <td><?= $row['ctg_name'];?></td>
                        <td>
            
                        </td>
                    </tr>
                </tbody>
        </table>
        <div class="float-center">
            <?php $pager->links()?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>