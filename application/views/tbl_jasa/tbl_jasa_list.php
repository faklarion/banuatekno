<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA HARGA JASA</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
                <?php echo anchor(site_url('tbl_jasa/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
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
        <table class="table table-bordered" style="margin-bottom: 10px" id="tabeljasa">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jasa</th>
                    <th>Harga Jasa</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($tbl_jasa_data as $tbl_jasa)
                    {
                ?>
                <tr>
                    <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $tbl_jasa->nama_jasa ?></td>
                    <td><?php echo rupiah($tbl_jasa->harga_jasa) ?></td>
                    <td><?php echo $tbl_jasa->keterangan ?></td>
                    <td style="text-align:center" width="200px">
                        <?php 
                        //echo anchor(site_url('tbl_jasa/read/'.$tbl_jasa->id_jasa),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        //echo '  '; 
                        echo anchor(site_url('tbl_jasa/update/'.$tbl_jasa->id_jasa),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_jasa/delete/'.$tbl_jasa->id_jasa),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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