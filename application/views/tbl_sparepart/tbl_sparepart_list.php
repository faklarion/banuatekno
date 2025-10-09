<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SPAREPART</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
                <?php echo anchor(site_url('tbl_sparepart/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		        <?php echo anchor(site_url('tbl_sparepart/word'), '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cetak Laporan', 'class="btn btn-primary btn-sm" target="_blank"'); ?> 
            </div>
            </div>
            
            </div>
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered" style="margin-bottom: 10px" id="tabelsparepart">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Sparepart</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
                foreach ($tbl_sparepart_data as $tbl_sparepart)
                {
            ?>
            <tr>
                <td width="10px"><?php echo ++$start ?></td>
                <td><?php echo $tbl_sparepart->nama_sparepart ?></td>
                <td><?php echo $tbl_sparepart->stok ?></td>
                <td><?php echo rupiah($tbl_sparepart->harga_jual) ?></td>
                <td><?php echo $tbl_sparepart->keterangan ?></td>
                <td style="text-align:center" width="200px">
                    <?php 
                    //echo anchor(site_url('tbl_sparepart/read/'.$tbl_sparepart->id_sparepart),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                    //echo '  '; 
                    echo anchor(site_url('tbl_sparepart/update/'.$tbl_sparepart->id_sparepart),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                    echo '  '; 
                    echo anchor(site_url('tbl_sparepart/delete/'.$tbl_sparepart->id_sparepart),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
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