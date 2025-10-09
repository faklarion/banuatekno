<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA HARGA JASA</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Nama Jasa <?php echo form_error('nama_jasa') ?></td><td><input type="text" class="form-control" name="nama_jasa" id="nama_jasa" placeholder="Nama Jasa" value="<?php echo $nama_jasa; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Harga Jasa <?php echo form_error('harga_jasa') ?></td><td><input type="number" class="form-control" name="harga_jasa" id="harga_jasa" placeholder="Harga Jasa" value="<?php echo $harga_jasa; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Keterangan <?php echo form_error('keterangan') ?></td>
						<td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_jasa" value="<?php echo $id_jasa; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_jasa') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>