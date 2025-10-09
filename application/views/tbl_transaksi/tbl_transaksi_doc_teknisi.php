<!doctype html>
<html>
    <head>
        <title>LAPORAN PERFORMA TEKNISI SERVICE</title>
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
            <h4><strong>LAPORAN PERFORMA TEKNISI SERVICE</strong></h4>
            <p><?= $periode ?></p>
        </div>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Teknisi</th>
                <th class="text-center">Service Diselesaikan</th>
            </tr><?php
            foreach ($tbl_teknisi_data as $tbl_teknisi)
            {
                ?>
                <tr>
		            <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_teknisi->nama_teknisi ?></td>
                    <td>
                        <?php 
                            $total = $this->Tbl_transaksi_model->get_performa_teknisi($tbl_teknisi->id_teknisi, $awal, $akhir);
                            if ($total === null) {
                                echo "0 Service";
                            } else {
                                echo ''.$total.' Service';
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>

<script>
    window.print()
</script>