<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA SPAREPART</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Nama Sparepart <?php echo form_error('nama_sparepart') ?></td><td><input type="text" class="form-control" name="nama_sparepart" id="nama_sparepart" placeholder="Nama Sparepart" value="<?php echo $nama_sparepart; ?>" /></td>
					</tr>

					<tr>
						<td width='200'>Harga Jual Sparepart <?php echo form_error('harga_jual') ?></td><td><input type="number" class="form-control" name="harga_jual" id="harga_jual" placeholder="Harga Jual Sparepart" value="<?php echo $harga_jual; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Keterangan <?php echo form_error('keterangan') ?></td>
						<td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_sparepart" value="<?php echo $id_sparepart; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_sparepart') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>