<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA TEKNISI</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('tbl_teknisi/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		    <!-- <?php echo anchor(site_url('tbl_teknisi/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?> -->
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
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabelteknisi">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Teknisi</th>
                    <th>Alamat Teknisi</th>
                    <th>No hp Teknisi</th>
                    <th>Email Teknisi</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($tbl_teknisi_data as $tbl_teknisi)
                    {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_teknisi->nama_teknisi ?></td>
			<td><?php echo $tbl_teknisi->alamat_teknisi ?></td>
			<td><?php echo $tbl_teknisi->nohp_teknisi ?></td>
			<td><?php echo $tbl_teknisi->email_teknisi ?></td>
			<td><?php echo $tbl_teknisi->keterangan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				//echo anchor(site_url('tbl_teknisi/read/'.$tbl_teknisi->id_teknisi),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
				echo anchor(site_url('tbl_teknisi/update/'.$tbl_teknisi->id_teknisi),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('tbl_teknisi/delete/'.$tbl_teknisi->id_teknisi),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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