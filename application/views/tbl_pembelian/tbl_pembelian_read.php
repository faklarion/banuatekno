
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_PEMBELIAN</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Id Sparepart</td>
				<td><?php echo $id_sparepart; ?></td>
			</tr>
	
			<tr>
				<td>Harga</td>
				<td><?php echo $harga; ?></td>
			</tr>
	
			<tr>
				<td>Jumlah</td>
				<td><?php echo $jumlah; ?></td>
			</tr>
	
			<tr>
				<td>Supplier</td>
				<td><?php echo $supplier; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal Pembelian</td>
				<td><?php echo $tanggal_pembelian; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_pembelian') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>