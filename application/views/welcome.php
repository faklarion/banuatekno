<div class="content-wrapper">
    <section class="content"> 
        <p class="text-center"><img src="<?php echo base_url() ?>assets/foto_profil/banua.png" class="user-image" alt="User Image"></p>
        
            <div class="row">
                <?php  
                    $this->db->from('tbl_transaksi');
                    $this->db->where('status', '1');
                    $totalProses = $this->db->count_all_results();
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Perbaikan Proses</span>
                        <span class="info-box-number"><?= $totalProses ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
                </div>

                <?php  
                    $this->db->from('tbl_transaksi');
                    $this->db->where('status', '2');
                    $totalSelesai = $this->db->count_all_results();
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Perbaikan Selesai</span>
                        <span class="info-box-number"><?= $totalSelesai ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
                </div>

                <?php  
                    $this->db->from('tbl_sparepart');
                    $totalSparepart = $this->db->count_all_results();
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-wrench"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Jumlah Sparepart</span>
                        <span class="info-box-number"><?= $totalSparepart ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
                </div>

                <?php  
                    $this->db->from('tbl_teknisi');
                    $totalTeknisi = $this->db->count_all_results();
                ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-user"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Jumlah Teknisi</span>
                        <span class="info-box-number"><?= $totalTeknisi ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <!-- /.info-box -->
                </div>
                
            </div>
        

    </section>
</div>
