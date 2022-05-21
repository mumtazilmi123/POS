<table class="table table-striped table-sm table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>Kode</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Hrg. Jual</th>
            <th>Sub Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 0;
        foreach($datadetail->getResultArray() as $r):
        ?>

            <tr> 
            <td><?= $nomor++;?></td>
            <td><?= $kode = $r['kode'];?></td>
            <td><?= $produk = $r['produk'];?></td>
            <td><?= $qty = $r['qty'];?></td>
            <td><?= $hrgjual = $r['hrgjual'];?></td>
            <td><?= $subtotal = $r['subtotal'];?></td>
            </tr>
            ?>
        
        ?>
    </tbody>
</table>