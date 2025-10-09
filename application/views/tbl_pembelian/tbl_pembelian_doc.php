<!doctype html>
<html>
    <head>
        <title>LAPORAN PEMBELIAN SPAREPART</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td {
                border:1px solid black !important; 
                padding: 5px 10px;
            }
            .report-header {
                text-align: center;
                margin-bottom: 30px;
            }
            .report-header h3, .report-header p {
                margin: 0;
                line-height: 1.5;
            }
            hr {
                border: 1px solid black;
                margin: 10px 0 20px;
            }
        </style>
    </head>
    <body>
        <div class="report-header">
            <h3><strong>Banua Tekno</strong></h3>
            <p>Jl. Perintis Kemerdekaan No.19 A, Ps. Lama, Kec. Banjarmasin Tengah,</p>
            <p>Kota Banjarmasin, Kalimantan Selatan 70115</p>
            <hr>
            <h4><strong>LAPORAN PEMBELIAN SPAREPART</strong></h4>
            <p><?= $periode ?></p>
        </div>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Sparepart</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah Beli</th>
                <th class="text-center">Total</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Tanggal Pembelian</th>
            </tr><?php
            foreach ($tbl_pembelian_data as $tbl_pembelian)
            {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $tbl_pembelian->nama_sparepart ?></td>
                    <td><?php echo rupiah($tbl_pembelian->harga) ?></td>
                    <td><?php echo $tbl_pembelian->jumlah ?></td>
                    <td><?php echo rupiah($tbl_pembelian->harga * $tbl_pembelian->jumlah) ?></td>
                    <td><?php echo $tbl_pembelian->supplier ?></td>
                    <td><?php echo tgl_indo($tbl_pembelian->tanggal_pembelian) ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>

<script>
    window.print();
</script>