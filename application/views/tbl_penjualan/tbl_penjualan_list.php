<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PENJUALAN SPAREPART</h3>
                    </div>
        
    <div class="box-body">
        <div class='row'>
            <div class='col-md-9'>
                <div style="padding-bottom: 10px;">
                    <?php echo anchor(site_url('tbl_penjualan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                    <form method="get" action="<?= site_url('tbl_penjualan/word') ?>" target="_blank">
                        <div class="form-group mb-3">
                            <label for="tanggal_awal">Dari Tanggal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal_akhir">Sampai Tanggal</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">Tampilkan Laporan</button>
                        </div>
                    </form>                
                </div>
            </div>    
        </div>
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px" id='tabelpenjualan'>
            <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Detail Penjualan</th>
                <th>Jenis Pembayaran</th>
                <th>Tanggal Penjualan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($tbl_penjualan_data as $tbl_penjualan)
                {
            ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_penjualan->nama_customer ?></td>
            <td>
                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalDetail<?php echo $tbl_penjualan->id_penjualan ?>" role="button">
					Lihat Detail
				</a>
            </td>
			<td><?php echo $tbl_penjualan->jenis_pembayaran ?></td>
			<td><?php echo tgl_indo($tbl_penjualan->tanggal_penjualan) ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('tbl_penjualan/read/'.$tbl_penjualan->id_penjualan),'<i class="fa fa-print" aria-hidden="true"></i>','class="btn btn-danger btn-sm" target="_blank"'); 
				echo '  '; 
				//echo anchor(site_url('tbl_penjualan/update/'.$tbl_penjualan->id_penjualan),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
				echo anchor(site_url('tbl_penjualan/delete/'.$tbl_penjualan->id_penjualan),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		    </tr>
            <?php
                }
            ?>
            </tbody>
        </table>

        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

<!-- MODAL DETAIL -->
<?php
    foreach ($tbl_penjualan_data as $tbl_penjualan)
    {
?>
<div id="modalDetail<?php echo $tbl_penjualan->id_penjualan ?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
	<!-- konten modal-->
	<div class="modal-content">
		<!-- heading modal -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Detail Penjualan </h4>
		</div>
		<!-- body modal -->
		<div class="modal-body">
			<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sparepart</th>
                        <th>Harga</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        $subtotal = 0; // <-- 1. INISIALISASI VARIABEL SUBTOTAL
                        $datadetail = $this->Tbl_penjualan_model->get_detail_by_id($tbl_penjualan->id_penjualan);
                        foreach ($datadetail as $dd) :
                            $total_item = $dd->qty * $dd->harga;
                
                            // Tambahkan total item ke subtotal
                            $subtotal += $total_item; // <-- 2. AKUMULASI TOTAL
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $dd->nama_sparepart ?></td>
                        <td><?php echo rupiah($dd->harga) ?></td>
                        <td><?php echo $dd->qty ?></td>
                        <td><?php echo rupiah($dd->qty * $dd->harga) ?></td>
                    </tr>
                    <?php endforeach ?>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Subtotal</td>
                        <td style="font-weight: bold;"><?php echo rupiah($subtotal); ?></td>
                    </tr>
                </tbody>
            </table>
		</div>
		<!-- footer modal -->
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		</div>
	</div>
   </div>
</div>
<?php } ?>
<!-- END MODAL DETAIL -->