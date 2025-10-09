
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_TEKNISI</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Nama Teknisi</td>
				<td><?php echo $nama_teknisi; ?></td>
			</tr>
	
			<tr>
				<td>Alamat Teknisi</td>
				<td><?php echo $alamat_teknisi; ?></td>
			</tr>
	
			<tr>
				<td>Nohp Teknisi</td>
				<td><?php echo $nohp_teknisi; ?></td>
			</tr>
	
			<tr>
				<td>Email Teknisi</td>
				<td><?php echo $email_teknisi; ?></td>
			</tr>
	
			<tr>
				<td>Keterangan</td>
				<td><?php echo $keterangan; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_teknisi') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>