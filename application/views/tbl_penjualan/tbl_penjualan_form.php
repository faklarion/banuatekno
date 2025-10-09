<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PENJUALAN SPAREPART</h3>
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
						Pilih Sparepart
					</td>
					<td>
					<table class="table table-bordered" id="tabeljasatransaksi">
							<thead>
							<tr>
								<th>No</th>
								<th>Nama Sparepart</th>
								<th>Stok</th>
								<th>Harga Jual</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$sparepart = $this->Tbl_sparepart_model->get_all();
								$no = 1;
								foreach($sparepart as $s) :
							?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $s->nama_sparepart ?></td>
									<td><?php echo $s->stok ?></td>
									<td><?php echo rupiah($s->harga_jual) ?></td>
									<td>
										<a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?php echo $s->id_sparepart ?>" role="button">
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
											<a href="<?php echo site_url("Tbl_penjualan/hapus_cart/".$items['rowid']."") ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
						<td width='200'>Jenis Pembayaran <?php echo form_error('jenis_pembayaran') ?></td>
						<td>
							<select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">
								<option value="Cash">Cash</option>
								<option value="QRIS/Transfer">QRIS/Transfer</option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_penjualan" value="<?php echo $id_penjualan; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_penjualan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>

 <!-- Modal BELI-->
<?php
 	$data = $this->Tbl_sparepart_model->get_all();
    foreach ($data as $row) : ?>
      <div class="modal fade" id="exampleModalCenter<?php echo $row->id_sparepart ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
              <form class="form-validate" action="<?php echo site_url('tbl_penjualan/tambah_cart'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="hidden" name="id_sparepart" class="form-control" value="<?php echo $row->id_sparepart ?>">
                  <input type="text" name="nama_sparepart" class="form-control" value="<?php echo $row->nama_sparepart ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="date">Harga Jual</label>
                  <input type="text" name="harga_jual" class="form-control" value="<?php echo $row->harga_jual ?>" readonly>
                </div>

				<div class="form-group">
                  <label for="date">Stok</label>
                  <input type="text" name="stok" class="form-control" value="<?php echo $row->stok ?>" readonly>
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