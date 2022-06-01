<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets')?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets')?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<script src="<?= base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="modalproduk" tabindex="-1" aria-labelledby="modalprodukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalprodukLabel">Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="keywordkode" id="keywordkode" value="<?= $keyword; ?>">
            <table id="dataproduk" class="table table-bordered table-striped dataTable dtr-inline" role="grid">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barcode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga Jual</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    var table =  $('#dataproduk').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?= site_url('sale/listDataProduk') ?>",
            "type": "POST"
            "data": {
                keywordkode : $('#keywordkode').val()
            }
        },
        "columnsDefs": [{
            "targets": [0],
            "orderable": false,
        }],
        }]
    });
    })
});

function pilihitem(kode, nama){
    $('#kodebarcode').val(kode);
    $('#namaproduk').val(nama);
    $('#modalproduk').modal('hide');
    $('#modalproduk').on('hidden.bs.modal', function (event) {
        $('#kodebarcode').focus();
    });
}

</script>