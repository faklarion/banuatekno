<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PEMBELIAN SPAREPART</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Nama Sparepart <?php echo form_error('id_sparepart') ?></td>
						<td>
							<select class="form-control select2" name="id_sparepart" id="id_sparepart">
							<?php $sparepart_list = $this->Tbl_sparepart_model->get_all(); ?>
							<?php foreach ($sparepart_list as $s): ?>
								<option value="<?php echo $s->id_sparepart; ?>" <?php echo ($id_sparepart == $s->id_sparepart) ? 'selected' : ''; ?>>
								<?php echo $s->nama_sparepart; ?>
								</option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>
	
					<tr>
						<td width='200'>Harga Beli <?php echo form_error('harga') ?></td><td><input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Jumlah <?php echo form_error('jumlah') ?></td><td><input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Supplier <?php echo form_error('supplier') ?></td><td><input type="text" class="form-control" name="supplier" id="supplier" placeholder="Supplier" value="<?php echo $supplier; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tanggal Pembelian <?php echo form_error('tanggal_pembelian') ?></td>
						<td><input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian" placeholder="Tanggal Pembelian" value="<?php echo $tanggal_pembelian; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_pembelian" value="<?php echo $id_pembelian; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_pembelian') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>