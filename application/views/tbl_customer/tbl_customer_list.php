<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA CUSTOMER</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('tbl_customer/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		    <!-- <?php echo anchor(site_url('tbl_customer/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?>-->
        </div>
            </div>
            <div class='col-md-3'>
            
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
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabelcustomer">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Alamat Customer</th>
                <th>No HP Customer</th>
                <th>Email Customer</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tbl_customer_data as $tbl_customer)
            {
                ?>
                <tr>
                    <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_customer->nama_customer ?></td>
                    <td><?php echo $tbl_customer->alamat_customer ?></td>
                    <td><?php echo $tbl_customer->nohp_customer ?></td>
                    <td><?php echo $tbl_customer->email_customer ?></td>
                    <td><?php echo $tbl_customer->keterangan ?></td>
                    <td style="text-align:center" width="200px">
				<?php 
				//echo anchor(site_url('tbl_customer/read/'.$tbl_customer->id_customer),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
				echo anchor(site_url('tbl_customer/update/'.$tbl_customer->id_customer),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				echo '  '; 
				echo anchor(site_url('tbl_customer/delete/'.$tbl_customer->id_customer),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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