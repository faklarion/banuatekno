<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TEKNISI</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Nama Teknisi <?php echo form_error('nama_teknisi') ?></td><td><input type="text" class="form-control" name="nama_teknisi" id="nama_teknisi" placeholder="Nama Teknisi" value="<?php echo $nama_teknisi; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Alamat Teknisi <?php echo form_error('alamat_teknisi') ?></td>
						<td> <textarea class="form-control" rows="3" name="alamat_teknisi" id="alamat_teknisi" placeholder="Alamat Teknisi"><?php echo $alamat_teknisi; ?></textarea></td>
					</tr>
	
					<tr>
						<td width='200'>No hp Teknisi <?php echo form_error('nohp_teknisi') ?></td><td><input type="text" class="form-control" name="nohp_teknisi" id="nohp_teknisi" placeholder="Nohp Teknisi" value="<?php echo $nohp_teknisi; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Email Teknisi <?php echo form_error('email_teknisi') ?></td><td><input type="text" class="form-control" name="email_teknisi" id="email_teknisi" placeholder="Email Teknisi" value="<?php echo $email_teknisi; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Keterangan <?php echo form_error('keterangan') ?></td>
						<td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_teknisi" value="<?php echo $id_teknisi; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_teknisi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>