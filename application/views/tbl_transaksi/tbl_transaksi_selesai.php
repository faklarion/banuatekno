<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA TRANSAKSI SERVICE</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
                <!-- <?php echo anchor(site_url('tbl_transaksi/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?> -->
                <table class="table table-bordered">
                    <tr>
                        <th>Laporan Transaksi Service</th>
                        <th>Laporan Performa Teknisi Service</th>
                    </tr>
                    <tr>
                        <td>
                            <form method="get" action="<?= site_url('tbl_transaksi/word_transaksi') ?>" target="_blank">
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
                        </td>
                        <td>
                            <form method="get" action="<?= site_url('tbl_transaksi/word_teknisi') ?>" target="_blank">
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
                        </td>
                    </tr>

                </table>
                
                
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
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabeltransaksi">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Jenis/Tipe HP</th>
                <th>Detail</th>
                <th>Nama Teknisi</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Tanggal Selesai</th>
                <th>Jenis Pembayaran</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($tbl_transaksi_data as $tbl_transaksi)
                    {
                ?>
                <tr>
                    <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_transaksi->nama_customer ?></td>
                    <td><?php echo $tbl_transaksi->tipe_hp ?></td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalDetail<?php echo $tbl_transaksi->id_transaksi ?>" role="button">
							Lihat Detail
						</a>
                    </td>
                    <td><?php echo $tbl_transaksi->nama_teknisi ?></td>
                    <td><?php echo tgl_indo($tbl_transaksi->tanggal_transaksi) ?></td>
                    <td><?php
                            if($tbl_transaksi->status == 1) {
                                echo 'Belum Selesai/Proses Booking';
                            } elseif($tbl_transaksi->status == 2) {
                                echo 'Selesai';
                            } elseif($tbl_transaksi->status == 3) {
                                echo 'Dibatalkan';
                            }
                        ?>
                    </td>
                    <td><?php echo tgl_indo($tbl_transaksi->tanggal_selesai); ?></td>
                    <td><?php echo $tbl_transaksi->jenis_pembayaran?></td>
                    <td style="text-align:center" width="200px">
                        <?php 
                        echo anchor(site_url('tbl_transaksi/read_transaksi/'.$tbl_transaksi->id_transaksi),'<i class="fa fa-print" aria-hidden="true"></i>','class="btn btn-danger btn-sm" target="_blank"'); 
                        echo '  '; 
                        //echo anchor(site_url('tbl_transaksi/update/'.$tbl_transaksi->id_transaksi),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        //echo '  '; 
                        if($tbl_transaksi->status == 1 ) {
                        echo '<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalSelesai'.$tbl_transaksi->id_transaksi.'" role="button">
							<i class="fa fa-check"></i>
						    </a>'; 
                        echo ' ';
                        echo anchor(site_url('tbl_transaksi/batal/'.$tbl_transaksi->id_transaksi),'<i class="fa fa-close" aria-hidden="true"></i>','class="btn btn-primary btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
                        }
                        echo ' ';
                        echo anchor(site_url('tbl_transaksi/delete/'.$tbl_transaksi->id_transaksi),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 

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
    foreach ($tbl_transaksi_data as $tbl_transaksi)
    {
?>
<div id="modalDetail<?php echo $tbl_transaksi->id_transaksi ?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
	<!-- konten modal-->
	<div class="modal-content">
		<!-- heading modal -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Detail Transaksi </h4>
		</div>
		<!-- body modal -->
		<div class="modal-body">
			<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jasa</th>
                        <th>Harga</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        $subtotal = 0; // <-- 1. INISIALISASI VARIABEL SUBTOTAL
                        $datadetail = $this->Tbl_transaksi_model->get_detail_by_id($tbl_transaksi->id_transaksi);
                        foreach ($datadetail as $dd) :
                            $total_item = $dd->qty * $dd->harga;
                
                            // Tambahkan total item ke subtotal
                            $subtotal += $total_item; // <-- 2. AKUMULASI TOTAL
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $dd->nama_jasa ?></td>
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

<!-- MODAL SELESAI -->
<?php
    foreach ($tbl_transaksi_data as $tbl_transaksi)
    {
?>
<div id="modalSelesai<?php echo $tbl_transaksi->id_transaksi ?>" class="modal fade" role="dialog">
   <div class="modal-dialog">
	<!-- konten modal-->
	<div class="modal-content">
		<!-- heading modal -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Selesaikan Booking Service </h4>
		</div>
		<!-- body modal -->
		<div class="modal-body">
			<form action="<?php echo site_url('tbl_transaksi/selesai'); ?>" method="post">
                <table class='table table-bordered'>
                    <tr>
                        <td>Jenis Pembayaran</td>
                        <td>
                            <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" required>
                                <option value="Cash">Cash</option>
                                <option value="QRIS/Transfer">QRIS/Transfer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
						<td></td>
						<td>	
                            <input type="hidden" name="id_transaksi" value="<?php echo $tbl_transaksi->id_transaksi; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Selesaikan</button> 
						</td>
					</tr>
                </table>
            </form>
        </div>
		<!-- footer modal -->
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		</div>
	</div>
   </div>
</div>
<?php } ?>
<!-- END MODAL SELESAI -->
