<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PEMBELIAN SPAREPART</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
                <?php echo anchor(site_url('tbl_pembelian/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                <form method="get" action="<?= site_url('tbl_pembelian/word') ?>" target="_blank">
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
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabelpembelian">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sparepart</th>
                    <th>Harga</th>
                    <th>Jumlah Beli</th>
                    <th>Total</th>
                    <th>Supplier</th>
                    <th>Tanggal Pembelian</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($tbl_pembelian_data as $tbl_pembelian)
                    {
                ?>
                <tr>
                    <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_pembelian->nama_sparepart ?></td>
                    <td><?php echo rupiah($tbl_pembelian->harga) ?></td>
                    <td><?php echo $tbl_pembelian->jumlah ?></td>
                    <td><?php echo rupiah($tbl_pembelian->harga * $tbl_pembelian->jumlah) ?></td>
                    <td><?php echo $tbl_pembelian->supplier ?></td>
                    <td><?php echo tgl_indo($tbl_pembelian->tanggal_pembelian) ?></td>
                    <td style="text-align:center" width="200px">
                        <?php 
                        //echo anchor(site_url('tbl_pembelian/read/'.$tbl_pembelian->id_pembelian),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        //echo '  '; 
                        echo anchor(site_url('tbl_pembelian/update/'.$tbl_pembelian->id_pembelian),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_pembelian/delete/'.$tbl_pembelian->id_pembelian),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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