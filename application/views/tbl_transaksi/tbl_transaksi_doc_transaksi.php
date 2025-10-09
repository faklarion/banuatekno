<!doctype html>
<html>
    <head>
        <title>LAPORAN TRANSAKSI SERVICE</title>
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
            <h4><strong>LAPORAN TRANSAKSI SERVICE</strong></h4>
            <p><?= $periode ?></p>
        </div>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Customer</th>
                <th class="text-center">Jenis/Tipe HP</th>
                <th class="text-center">Detail</th>
                <th class="text-center">Nama Teknisi</th>
                <th class="text-center">Tanggal Transaksi</th>
                <th class="text-center">Status</th>
                <th class="text-center">Tanggal Selesai</th>
                <th class="text-center">Jenis Pembayaran</th>
            </tr>
            <?php
            foreach ($tbl_transaksi_data as $tbl_transaksi)
            {
                ?>
                <tr>
		            <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_transaksi->nama_customer ?></td>
                    <td><?php echo $tbl_transaksi->tipe_hp ?></td>
                    <td>
                        <?php 
                            $no = 1;
                            $subtotal = 0; // <-- 1. INISIALISASI VARIABEL SUBTOTAL
                            $datadetail = $this->Tbl_transaksi_model->get_detail_by_id($tbl_transaksi->id_transaksi);
                            foreach ($datadetail as $dd) :
                                $total_item = $dd->qty * $dd->harga;
                    
                                // Tambahkan total item ke subtotal
                                $subtotal += $total_item; // <-- 2. AKUMULASI TOTAL
                        ?>
                        - <?php echo $dd->nama_jasa ?> ( <?php echo rupiah($dd->harga) ?> )<br>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo $tbl_transaksi->nama_teknisi ?></td>
                    <td><?php echo tgl_indo($tbl_transaksi->tanggal_transaksi) ?></td>
                    <td><?php
                            if($tbl_transaksi->status == 1) {
                                echo 'Belum Selesai/Proses Booking';
                            } elseif($tbl_transaksi->status == 2) {
                                echo 'Selesai';
                            } elseif($tbl_transaksi->status == 3) {
                                echo 'Dibatalkan';
                            }
                        ?>
                    </td>
                    <td><?php echo tgl_indo($tbl_transaksi->tanggal_selesai); ?></td>
                    <td><?php echo $tbl_transaksi->jenis_pembayaran?></td>
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