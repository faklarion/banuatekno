
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_CUSTOMER</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Nama Customer</td>
				<td><?php echo $nama_customer; ?></td>
			</tr>
	
			<tr>
				<td>Alamat Customer</td>
				<td><?php echo $alamat_customer; ?></td>
			</tr>
	
			<tr>
				<td>Nohp Customer</td>
				<td><?php echo $nohp_customer; ?></td>
			</tr>
	
			<tr>
				<td>Email Customer</td>
				<td><?php echo $email_customer; ?></td>
			</tr>
	
			<tr>
				<td>Keterangan</td>
				<td><?php echo $keterangan; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_customer') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>