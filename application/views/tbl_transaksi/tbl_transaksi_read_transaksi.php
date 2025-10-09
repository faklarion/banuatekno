<!doctype html>
<html>
    <head>
        <title>NOTA <?= $status ?> SERVICE</title>
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
           <div class="container mt-4 mb-5 border p-4">
				<div class="report-header">
					<h3><strong>Banua Tekno</strong></h3>
					<p>Jl. Perintis Kemerdekaan No.19 A, Ps. Lama, Kec. Banjarmasin Tengah,</p>
					<p>Kota Banjarmasin, Kalimantan Selatan 70115</p>
					<hr>
					<h4><strong>NOTA <?= $status ?> SERVICE</strong></h4>
				</div>

				<table class="table table-borderless mt-4">
					<tr>
						<th>Nama Customer</th>
						<td>: <?php echo ($row->nama_customer); ?></td>
					</tr>
					<tr>
						<th>Nama Teknisi</th>
						<td>: <?php echo ($row->nama_teknisi); ?></td>
					</tr>
					<tr>
						<th>Status</th>
						<td>: 
							<?php
                            if($row->status == 1) {
                                echo 'Belum Selesai';
                            } elseif($row->status == 2) {
                                echo 'Selesai';
                            } elseif($row->status == 3) {
                                echo 'Dibatalkan';
                            }
                        ?>
						</td>
					</tr>
					<tr>
						<th>Tanggal Transaksi</th>
						<td>: <?php echo tgl_indo($row->tanggal_transaksi); ?></td>
					</tr>
					<tr>
						<th>Tanggal Selesai</th>
						<td>: 
							<?php
                                echo tgl_indo($row->tanggal_selesai);
                        	?>
						</td>
					</tr>
					<tr>
						<th>Jenis Pembayaran</th>
						<td>: <?php echo ($row->jenis_pembayaran); ?></td>
					</tr>
				</table>

				<div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama Jasa</th>
								<th class="text-center">Harga</th>
								<th class="text-center">QTY</th>
								<th class="text-center">Total</th>
							</tr>
							
						</thead>
						<tbody>
							<?php 
								$no = 1;
								$subtotal = 0; // <-- 1. INISIALISASI VARIABEL SUBTOTAL
								$datadetail = $this->Tbl_transaksi_model->get_detail_by_id($row->id_transaksi);
								foreach ($datadetail as $dd) :
									$total_item = $dd->qty * $dd->harga;
						
									// Tambahkan total item ke subtotal
									$subtotal += $total_item; // <-- 2. AKUMULASI TOTAL
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $dd->nama_jasa ?></td>
								<td><?php echo rupiah($dd->harga) ?></td>
								<td><?php echo $dd->qty ?></td>
								<td><?php echo rupiah($dd->qty * $dd->harga) ?></td>
							</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="4" style="text-align: right; font-weight: bold;">Subtotal</td>
								<td style="font-weight: bold;"><?php echo rupiah($subtotal); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="text-center mt-5 font-italic">
					<p>Terima kasih telah mempercayakan Banua Tekno.</p>
				</div>

			</div>
    </body>
</html>

<script>
    window.print();
</script>