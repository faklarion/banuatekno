<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA CUSTOMER</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Nama Customer <?php echo form_error('nama_customer') ?></td><td><input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Nama Customer" value="<?php echo $nama_customer; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Alamat Customer <?php echo form_error('alamat_customer') ?></td>
						<td> <textarea class="form-control" rows="3" name="alamat_customer" id="alamat_customer" placeholder="Alamat Customer"><?php echo $alamat_customer; ?></textarea></td>
					</tr>
	
					<tr>
						<td width='200'>No HP Customer <?php echo form_error('nohp_customer') ?></td><td><input type="text" class="form-control" name="nohp_customer" id="nohp_customer" placeholder="Nohp Customer" value="<?php echo $nohp_customer; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Email Customer <?php echo form_error('email_customer') ?></td><td><input type="text" class="form-control" name="email_customer" id="email_customer" placeholder="Email Customer" value="<?php echo $email_customer; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Keterangan <?php echo form_error('keterangan') ?></td>
						<td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_customer" value="<?php echo $id_customer; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_customer') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>