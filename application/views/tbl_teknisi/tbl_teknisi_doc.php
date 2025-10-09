<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_teknisi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Teknisi</th>
		<th>Alamat Teknisi</th>
		<th>Nohp Teknisi</th>
		<th>Email Teknisi</th>
		<th>Keterangan</th>
		
            </tr><?php
            foreach ($tbl_teknisi_data as $tbl_teknisi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_teknisi->nama_teknisi ?></td>
		      <td><?php echo $tbl_teknisi->alamat_teknisi ?></td>
		      <td><?php echo $tbl_teknisi->nohp_teknisi ?></td>
		      <td><?php echo $tbl_teknisi->email_teknisi ?></td>
		      <td><?php echo $tbl_teknisi->keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>