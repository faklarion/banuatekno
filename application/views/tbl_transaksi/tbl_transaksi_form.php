<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TRANSAKSI</h3>
			</div>

			<?php if($this->session->flashdata('message')) { ?>
				<div class="alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Perhatian !</strong> <?php echo $this->session->flashdata('message')?>
				</div>
			<?php } ?>
			
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
					<td>
						Pilih Jasa
					</td>
					<td>
						<table class="table table-bordered" id="tabeljasatransaksi">
							<thead>
							<tr>
								<th>No</th>
								<th>Nama Jasa</th>
								<th>Harga Jasa</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$jasa = $this->Tbl_jasa_model->get_all();
								$no = 1;
								foreach($jasa as $j) :
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $j->nama_jasa ?></td>
									<td><?php echo rupiah($j->harga_jasa) ?></td>
									<td>
										<a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?php echo $j->id_jasa ?>" role="button">
											Tambah
										</a>
									</td>
								</tr>
							<?php 
								endforeach; 
							?>
							</tbody>
						</table>
					</td>
					</tr>
					<tr>
						<td>Keranjang</td>
						<td>
							<?php $items = $this->cart->contents(); ?>
							<table id="datatables" class="table">
								<thead>
									<tr>
										<!-- <th>ID</th> -->
										<th>Nama</th>
										<th>QTY</th>
										<th>Harga</th>
										<th>Total</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($items as $items) : ?>
										<tr>
									<!-- <td><?php echo $items['id'] ?></td> -->
										<td><?php echo $items['name'] ?></td>
										<td><?php echo $items['qty'] ?> </td>
										<td><?php echo rupiah($items['price']) ?> </td>
										<td>
											<?php echo rupiah($items['subtotal']) ?>
										</td>
										<td>
											<a href="<?php echo site_url("Tbl_transaksi/hapus_cart/".$items['rowid']."") ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
										</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
								<tr>
									<td>
										<div class="p-3 mb-2 bg-success text-white">
											<h2> TOTAL : Rp <?php echo number_format($this->cart->total(), 0, ',', '.') ?></h2>
											<!-- <h6 id="biaya" name="biaya"> + Ongkir Rp 20.000</h6> -->
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width='200'>Nama Customer <?php echo form_error('id_customer') ?></td>
						<td>
							<select class="form-control select2" name="id_customer" id="id_customer">
							<?php $customer = $this->Tbl_customer_model->get_all(); ?>
							<?php foreach ($customer as $s): ?>
								<option value="<?php echo $s->id_customer; ?>" <?php echo ($id_customer == $s->id_customer) ? 'selected' : ''; ?>>
								<?php echo $s->nama_customer; ?>
								</option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>

					<tr>
						<td width='200'>Tipe/Jenis HP</td>
						<td>
							<input type="text" name="tipe_hp" class="form-control" required id="tipe_hp">
						</td>
					</tr>
	
					<tr>
						<td width='200'>Nama Teknisi <?php echo form_error('id_teknisi') ?></td>
						<td>
							<select class="form-control select2" name="id_teknisi" id="id_teknisi">
							<?php $teknisi = $this->Tbl_teknisi_model->get_all(); ?>
							<?php foreach ($teknisi as $s): ?>
								<option value="<?php echo $s->id_teknisi; ?>" <?php echo ($id_teknisi == $s->id_teknisi) ? 'selected' : ''; ?>>
								<?php echo $s->nama_teknisi; ?>
								</option>
							<?php endforeach; ?>
							</select>
						</td>
					</tr>
	
					<tr>
						<td width='200'>Tanggal Booking <?php echo form_error('tanggal_transaksi') ?></td>
						<td>
							<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo $tanggal_transaksi?>" class="form-control" required>
						</td>
					</tr>

					<tr>
						<td width='200'>Tanggal Selesai <?php echo form_error('tanggal_selesai') ?></td>
						<td>
							<input type="date" name="tanggal_selesai" id="tanggal_selesai" value="<?php echo $tanggal_selesai?>" class="form-control" required>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_transaksi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>

 <!-- Modal BELI-->
 <?php
 	$data = $this->Tbl_jasa_model->get_all();
    foreach ($data as $row) : ?>
      <div class="modal fade" id="exampleModalCenter<?php echo $row->id_jasa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Belanja</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- FORM -->
              <form class="form-validate" action="<?php echo site_url('tbl_transaksi/tambah_cart'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="hidden" name="id_jasa" class="form-control" value="<?php echo $row->id_jasa ?>">
                  <input type="text" name="nama_jasa" class="form-control" value="<?php echo $row->nama_jasa ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="date">Harga Jasa</label>
                  <input type="text" name="harga_jasa" class="form-control" value="<?php echo $row->harga_jasa ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="name">Qty</label>
                  <input type="number" name="qty" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php endforeach; ?>