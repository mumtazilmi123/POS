<?= $this->extend('theme/menu') ?>

<?= $this->section('judul') ?>
<h3><i class="fas fa-archive"></i> Form Tambah Produk</h3>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<script src="<?= base_url('assets/plugins/autoNumeric.js') ?>"></script>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <button type="button" class="btn btn-sm btn-outline-warning"
                onclick="window.location='<?= site_url('product/index') ?>'">
                <i class="fa fa-arrow-left"></i> Kembali
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
        <?= form_open_multipart('', ['class' => 'formsimpanproduk']) ?>
        <?= csrf_field(); ?>
        <div class="form-group row">
            <label for="barcode" class="col-sm-4 col-form-label"> Barcode</label>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="barcode" name="barcode" autofocus>
                <div class="invalid-feedback errorBarcode" style="display: none;"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="namaproduk" class="col-sm-4 col-form-label">Nama Produk</label>
            <div class="col-sm-5">
                <input type="text" class="form-control form-control-sm" id="namaproduk" name="namaproduk">
                <div class="invalid-feedback errorNamaProduk" style="display: none;"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="stok" class="col-sm-4 col-form-label">Stok Tersedia</label>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="stok" name="stok" value="0">
                <div class="invalid-feedback errorStok" style="display: none;"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
            <div class="col-sm-4">
                <select class="form-control form-control-sm" name="kategori" id="kategori"></select>
                <div class="invalid-feedback errorKategori" style="display: none;">
                </div>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-sm btn-primary tombolTambahKategori">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </div>
        <div class="form-group row">
            <label for="satuan" class="col-sm-4 col-form-label">Satuan</label>
            <div class="col-sm-4">
                <select class="form-control form-control-sm" name="satuan" id="satuan"></select>
                <div class="invalid-feedback errorSatuan" style="display: none;">
                </div>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-sm btn-primary tombolTambahSatuan">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </div>
        <div class="form-group row">
            <label for="hargabeli" class="col-sm-4 col-form-label">Harga Beli (Rp)</label>
            <div class="col-sm-4">
                <input style="text-align: right;" type="text" class="form-control form-control-sm" name="hargabeli"
                    id="hargabeli">
                <div class="invalid-feedback errorHargaBeli" style="display: none;">
                </div>
            </div>

        </div>
        <div class="form-group row">
            <label for="hargajual" class="col-sm-4 col-form-label">Harga Jual (Rp)</label>
            <div class="col-sm-4">
                <input style="text-align: right;" type="text" class="form-control form-control-sm" name="hargajual"
                    id="hargajual">
                <div class="invalid-feedback errorHargaJual" style="display: none;">
                </div>
            </div>
        </div>
        <!-- <div class="form-group row">
            <label for="uploadgambar" class="col-sm-4 col-form-label">Upload Gambar</label>
            <div class="col-sm-4">
                <input type="file" name="uploadgambar" id="uploadgambar" class="form-control form-control-md"
                    accept=".jpg,.jpeg,.png">
                <div class="invalid-feedback errorUpload" style="display: none;">
                </div>
            </div>
        </div> -->
        <div class="form-group row">
            <label for="uploadgambar" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-4">
                <button type="submit" class="btn btn-success tombolSimpanProduk">
                    Simpan
                </button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<div class="viewmodal" style="display:none;"></div>
<script>
function tampilKategori() {
    $.ajax({
        url: "<?= site_url('product/ambilDataKategori') ?>",
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('#kategori').html(response.data);
            }
        },
        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function tampilSatuan() {
    $.ajax({
        url: "<?= site_url('product/ambilDataSatuan') ?>",
        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('#satuan').html(response.data);
            }
        },
        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

$(document).ready(function(){
    tampilKategori();
    tampilSatuan();

    $('#hargabeli').autoNumeric('init', {
        aSep: ',',
        aDec: '.',
        mDec: '2'
    });
    $('#hargajual').autoNumeric('init', {
        aSep: ',',
        aDec: '.',
        mDec: '2'
    });
    $('#stok').autoNumeric('init', {
        aSep: ',',
        aDec: '.',
        mDec: '0'
    });

    $('.tombolTambahKategori').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('category/formTambah') ?>",
            dataType: "json",
            type: 'post',
            data: {
                aksi: 1
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
    $('.tombolTambahSatuan').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('units/add') ?>",
            dataType: "json",
            type: 'post',
            data: {
                aksi: 1
            },
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahsatuan').on('shown.bs.modal', function(event) {
                        $('#namasatuan').focus();
                    });
                    $('#modaltambahsatuan').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
    $('.tombolSimpanProduk').click(function(e) {
        e.preventDefault();
        let form = $('.formsimpan')[0];
        let data = new FormData(form);

        $.ajax({
            type: "post",
            url: "<?= site_url('product/simpandata') ?>",
            data: data,
            dataType: "json",
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('.tombolSimpanProduk').html('<i class="fa fa-spin fa-spinner"></i>');
                $('.tombolSimpanProduk').prop('disabled', true);
            },
            complete: function() {
                $('.tombolSimpanProduk').html('Simpan');
                $('.tombolSimpanProduk').prop('disabled', false);
            },
            success: function(response) {
                if (response.error) {
                    let dataError = response.error;
                    if (dataError.errorBarcode) {
                        $('.errorBarcode').html(dataError.errorBarcode).show();
                        $('#barcode').addClass('is-invalid');
                    } else {
                        $('.errorBarcode').fadeOut();
                        $('#barcode').removeClass('is-invalid');
                        $('#barcode').addClass('is-valid');
                    }

                    if (dataError.errorNamaProduk) {
                        $('.errorNamaProduk').html(dataError.errorNamaProduk).show();
                        $('#namaproduk').addClass('is-invalid');
                    } else {
                        $('.errorNamaProduk').fadeOut();
                        $('#namaproduk').removeClass('is-invalid');
                        $('#namaproduk').addClass('is-valid');
                    }

                    if (dataError.errorStok) {
                        $('.errorStok').html(dataError.errorStok).show();
                        $('#stok').addClass('is-invalid');
                    } else {
                        $('.errorStok').fadeOut();
                        $('#stok').removeClass('is-invalid');
                        $('#stok').addClass('is-valid');
                    }

                    if (dataError.errorKategori) {
                        $('.errorKategori').html(dataError.errorKategori).show();
                        $('#kategori').addClass('is-invalid');
                    } else {
                        $('.errorKategori').fadeOut();
                        $('#kategori').removeClass('is-invalid');
                        $('#kategori').addClass('is-valid');
                    }

                    if (dataError.errorSatuan) {
                        $('.errorSatuan').html(dataError.errorSatuan).show();
                        $('#satuan').addClass('is-invalid');
                    } else {
                        $('.errorSatuan').fadeOut();
                        $('#satuan').removeClass('is-invalid');
                        $('#satuan').addClass('is-valid');
                    }

                    if (dataError.errorHargaBeli) {
                        $('.errorHargaBeli').html(dataError.errorHargaBeli).show();
                        $('#hargabeli').addClass('is-invalid');
                    } else {
                        $('.errorHargaBeli').fadeOut();
                        $('#hargabeli').removeClass('is-invalid');
                        $('#hargabeli').addClass('is-valid');
                    }

                    if (dataError.errorHargaJual) {
                        $('.errorHargaJual').html(dataError.errorHargaJual).show();
                        $('#hargajual').addClass('is-invalid');
                    } else {
                        $('.errorHargaJual').fadeOut();
                        $('#hargajual').removeClass('is-invalid');
                        $('#hargajual').addClass('is-valid');
                    }

                    if (dataError.errorUpload) {
                        $('.errorUpload').html(dataError.errorUpload).show();
                        $('#uploadgambar').addClass('is-invalid');
                    }
                } else {
                    Swal.fire({
                        icon    : 'success',
                        title   : 'Berhasil',
                        html    : response.sukses,
                    });
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