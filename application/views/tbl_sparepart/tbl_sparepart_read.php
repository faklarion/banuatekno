
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_SPAREPART</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Nama Sparepart</td>
				<td><?php echo $nama_sparepart; ?></td>
			</tr>
	
			<tr>
				<td>Stok</td>
				<td><?php echo $stok; ?></td>
			</tr>
	
			<tr>
				<td>Keterangan</td>
				<td><?php echo $keterangan; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_sparepart') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>