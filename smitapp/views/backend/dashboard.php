<?php 
    $time   = date('H');
    $hi     = '';
    $status = '';
	$name	= $user->name;
    
    if( $time > '00' && $time <= '09'  )        { $hi = 'Pagi'; }
    elseif( $time > '09' && $time <= '14'  )    { $hi = 'Siang'; }
    elseif( $time > '14' && $time <= '18'  )    { $hi = 'Sore'; }
    elseif( $time > '18' && $time <= '24'  )    { $hi = 'Malam'; }
    
    if( $is_admin ){
        $status = 'ADMINISTRATOR';
    }else{
        if( $user->type == 2 ){
            $status = 'PENDAMPING';
        }elseif( $user->type == 3 ){
            $status = 'TENANT';
        }elseif( $user->type == 4 ){
            $status = 'JURI';
        }elseif( $user->type == 5 ){
            $status = 'PENGUSUL';
        }else{
            $status = 'PELAKSANA';
        }
    }
    
    $step1      = ' - ';
    $step2      = ' - ';
    
    if( $is_jury ){
        if( $phase1 == ACTIVE ){
            $step1  = ' ANDA TERPILIH ';
        }
        
        if( $phase2 == ACTIVE ){
            $step2  = ' ANDA TERPILIH ';
        }
    }
    
    if( as_pengusul($user) ){
        $cfg_status     = config_item('incsel_status');
        if( !empty($data_incubation) ){
            if($status_inc_1 == NOTCONFIRMED)    { $status_inc_1 = '<span class="label label-default">'.strtoupper($cfg_status[$status_inc_1]).'</span>'; }
            elseif($status_inc_1 == CONFIRMED)   { $status_inc_1 = '<span class="label label-success">'.strtoupper($cfg_status[$status_inc_1]).'</span>'; }
            elseif($status_inc_1 == RATED)       { $status_inc_1 = '<span class="label bg-purple">'.strtoupper($cfg_status[$status_inc_1]).'</span>'; }
            elseif($status_inc_1 == ACCEPTED)    { $status_inc_1 = '<span class="label label-primary">'.strtoupper($cfg_status[$status_inc_1]).'</span>'; }
            elseif($status_inc_1 == REJECTED)    { $status_inc_1 = '<span class="label label-danger">'.strtoupper($cfg_status[$status_inc_1]).'</span>'; }
            
            if( !empty($step_inc_2) ){
                if($status_inc_2 == NOTCONFIRMED)    { $status_inc_2 = '<span class="label label-default">'.strtoupper($cfg_status[$status_inc_2]).'</span>'; }
                elseif($status_inc_2 == CONFIRMED)   { $status_inc_2 = '<span class="label label-success">'.strtoupper($cfg_status[$status_inc_2]).'</span>'; }
                elseif($status_inc_2 == RATED)       { $status_inc_2 = '<span class="label bg-purple">'.strtoupper($cfg_status[$status_inc_2]).'</span>'; }
                elseif($status_inc_2 == ACCEPTED)    { $status_inc_2 = '<span class="label label-primary">'.strtoupper($cfg_status[$status_inc_2]).'</span>'; }
                elseif($status_inc_2 == REJECTED)    { $status_inc_2 = '<span class="label label-danger">'.strtoupper($cfg_status[$status_inc_2]).'</span>'; }      
            }else{
                $status_inc_2 = '<center> - </center>';
            }
                
        }
        
        if( !empty($data_praincubation) ){
            if($status_pra_1 == NOTCONFIRMED)    { $status_pra_1 = '<span class="label label-default">'.strtoupper($cfg_status[$status_pra_1]).'</span>'; }
            elseif($status_pra_1 == CONFIRMED)   { $status_pra_1 = '<span class="label label-success">'.strtoupper($cfg_status[$status_pra_1]).'</span>'; }
            elseif($status_pra_1 == RATED)       { $status_pra_1 = '<span class="label bg-purple">'.strtoupper($cfg_status[$status_pra_1]).'</span>'; }
            elseif($status_pra_1 == ACCEPTED)    { $status_pra_1 = '<span class="label label-primary">'.strtoupper($cfg_status[$status_pra_1]).'</span>'; }
            elseif($status_pra_1 == REJECTED)    { $status_pra_1 = '<span class="label label-danger">'.strtoupper($cfg_status[$status_pra_1]).'</span>'; }
            
            if( !empty($step_pra_2) ){
                if($status_pra_2 == NOTCONFIRMED)    { $status_pra_2 = '<span class="label label-default">'.strtoupper($cfg_status[$status_pra_2]).'</span>'; }
                elseif($status_pra_2 == CONFIRMED)   { $status_pra_2 = '<span class="label label-success">'.strtoupper($cfg_status[$status_pra_2]).'</span>'; }
                elseif($status_pra_2 == RATED)       { $status_pra_2 = '<span class="label bg-purple">'.strtoupper($cfg_status[$status_pra_2]).'</span>'; }
                elseif($status_pra_2 == ACCEPTED)    { $status_pra_2 = '<span class="label label-primary">'.strtoupper($cfg_status[$status_pra_2]).'</span>'; }
                elseif($status_pra_2 == REJECTED)    { $status_pra_2 = '<span class="label label-danger">'.strtoupper($cfg_status[$status_pra_2]).'</span>'; } 
            }else{
                $status_pra_2 = '<center> - </center>';
            }     
        }
        
    }
?>

<!-- Widgets -->
<div class="row clearfix">
    <?php
        $count_all      = $this->Model_User->count_all();
        $count_all      = $count_all - 1;
        $user_newest    = $this->Model_User->get_user_newest();
    
        $countuser_score1       = 0;
        $countuser_score2       = 0;
        $count_all_selection    = 0;
        $user_list1             = $this->Model_Praincubation->count_all_scoreconfirm_step1(CONFIRMED, NOTCONFIRMED);
        $user_list2             = $this->Model_Praincubation->count_all_scoreconfirm_step2(CONFIRMED);
        if( !empty($lss) ){
            $count_all_selection    = $this->Model_Praincubation->count_all_selection($lss->id);    
        }
        
        if($user_list1 > 0){
            $countuser_score1   = $user_list1;
        }
        if($user_list2 > 0){
            $countuser_score1   = $user_list2;
        }
    ?>
    <?php if($is_admin): ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text"><strong>PENGGUNA BARU</strong></div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                <div class="text"><?php echo ( $user_newest->type == 1 ? '-' : $user_newest->name ); ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">info</i>
            </div>
            <div class="content">
                <div class="text"><strong>TOTAL PENGGUNA</strong></div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $count_all; ?> PENGGUNA</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Pengusul</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $count_all_selection; ?> ORANG</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Tahap 1</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $countuser_score1; ?> PENGUSUL</div>
            </div>
        </div>
    </div>
    <?php elseif( as_juri($user) ): ?>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Pengusul</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $count_all_selection; ?> ORANG</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Tahap 1</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $countuser_score1; ?> PENGUSUL</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Tahap 2</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $countuser_score2; ?> PENGUSUL</div>
            </div>
        </div>
    </div>
    <?php elseif( as_tenant($user)) :?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text"><strong>Nama Perusahaan</strong></div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                <div class="text"><a href="">Ubah</a></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">info</i>
            </div>
            <div class="content">
                <div class="text"><strong>TOTAL PENGGUNA</strong></div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $count_all; ?> PENGGUNA</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Pengusul</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $count_all_selection; ?> ORANG</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">Jumlah Tahap 1</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                <div class="text"><?php echo $countuser_score1; ?> PENGUSUL</div>
            </div>
        </div>
    </div>
    <?php elseif( as_pengusul($user) ): ?>
    
    <?php endif ?> 
</div>
<!-- #END# Widgets -->

<!-- Welcome Text -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Selamat <?php echo $hi . ' <strong>' . strtoupper($name) . '</strong>'; ?></h2></div>
            <div class="body bg-light-green">
                <p>Selamat datang di Sistem Informasi <a href="<?php echo base_url(); ?>"><strong><?php echo get_option('company_name'); ?></strong></a>. Status Anda saat ini sebagai <strong><?php echo $status; ?></strong></p>
                <p></p>
            </div>
            
            <?php if( $is_admin ): ?>
                <div class="body">
                    <div class="panel-group" role="tablist" aria-multiselectable="true">        
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="heading_total">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_total" aria-expanded="true" aria-controls="collapse_total">
                                        <i class="material-icons">format_align_justify</i> Total Pengukuran IKM
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_total" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_total">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                            <div class="table-container table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                						<tr role="row" class="heading bg-blue">
                                                            <th class="width35 text-center">Total Score IKM</th>
                                                            <th class="width30 text-center">Mutu</th>
                                                            <th class="width35 text-center">Kinerja</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-size: 28px !important; "><strong><?php echo smit_center($ikm); ?></strong></td>
                                                            <td style="font-size: 28px !important; "><strong><?php echo smit_center($mutu); ?></strong></td>
                                                            <td style="font-size: 28px !important; "><strong><?php echo smit_center($kinerja); ?></strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-blue hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons">done_all</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">Sangat Setuju</div>
                                                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($sangat_setuju); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-blue hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons">done</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">Setuju</div>
                                                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($setuju); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-blue hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons">clear</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">Tidak Setuju</div>
                                                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($tidak_setuju); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="info-box bg-blue hover-expand-effect">
                                                <div class="icon">
                                                    <i class="material-icons">new_releases</i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">Sangat Tdk Setuju</div>
                                                    <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($sangat_tidak_setuju); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            
            <?php if( as_pendamping($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_pendamping'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_pendamping'); ?><hr />
                        <div class="body bg-amber">
                            <p>Perbaharui segera profil pengguna anda di <a href="<?php echo base_url('pengguna/profil'); ?>"><strong>MENU PROFIL</strong></a>. Pastikan data profil yang anda masukan dan sesuai dengan identitas anda.</p>
                        </div>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>
            
            <?php if( as_juri($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_juri'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_juri'); ?><hr />
                        <div class="body bg-amber">
                            <p>Perbaharui segera profil pengguna anda di <a href="<?php echo base_url('pengguna/profil'); ?>"><strong>MENU PROFIL</strong></a>. Pastikan data profil yang anda masukan dan sesuai dengan identitas anda.</p>
                        </div>
                        <h4>Status Juri Anda :</h4>
                        
                        <div class="row clearfix">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="card">
                                    <?php if( !empty($lss) ) : ?>
                                    <div class="header bg-cyan">
                                        <h2>Seleksi Pra-Inkubasi<small>Tanggal Seleksi : <strong><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_adm_start)); ?></strong> - <strong><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_adm_end)); ?></strong></small></h2>
                                    </div>
                                    <div class="body">
                                        <?php if( $phase1 == ACTIVE ) : ?>
                                            Anda Terpilih Menjadi Juri <strong>Tahap 1</strong> Seleksi Pra-Inkubasi Tahun <?php echo $lss->selection_year_publication; ?></a>
                                        <?php else : ?><br />
                                            Maaf saat ini anda belum terpilih menjadi juri Seleksi Inkubasi Tahap 1 Tahun <?php echo $lss->selection_year_publication; ?>
                                        <?php endif ?><br />
                                        <?php if( $phase2 == ACTIVE ) : ?>
                                            Anda Terpilih Menjadi Juri <strong>Tahap 2</strong> Seleksi Pra-Inkubasi Tahun <?php echo $lss->selection_year_publication; ?></a>
                                        <?php else : ?><br />
                                            Maaf saat ini anda belum terpilih menjadi juri Seleksi Pra-Inkubasi Tahap 2 Tahun <?php echo $lss->selection_year_publication; ?>
                                        <?php endif ?><br /><br />
                                        
                                        <i style="color: red !important;">"Diharapkan kepada juri terpilih melakukan penilaian sesuai dengan tanggal yang telah ditentukan sesuai dengan seleksi yang di berikan."</i>
                                    </div>
                                    <?php else : ?>
                                        <div class="alert alert-warning bottom0">Tidak ada Seleksi Pra-Inkubasi yang dibuka saat ini</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="card">
                                    <?php if( !empty($lss) ) : ?>
                                    <div class="header bg-pink">
                                        <h2>Seleksi Inkubasi<small>&nbsp;</small></h2>
                                    </div>
                                    <div class="body">
                                        <?php if( $phase1 == ACTIVE ) : ?>
                                            Anda Terpilih Menjadi Juri <strong>Tahap 1</strong> Seleksi Inkubasi Tahun <?php echo $lss->selection_year_publication; ?></a>
                                        <?php else : ?><br />
                                            Maaf saat ini anda belum terpilih menjadi juri Seleksi Inkubasi Tahap 1 Tahun <?php echo $lss->selection_year_publication; ?>
                                        <?php endif ?><br />
                                        <?php if( $phase2 == ACTIVE ) : ?>
                                            Anda Terpilih Menjadi Juri <strong>Tahap 2</strong> Seleksi Inkubasi Tahun <?php echo $lss->selection_year_publication; ?></a>
                                        <?php else : ?><br />
                                            Maaf saat ini anda belum terpilih menjadi juri Seleksi Inkubasi Tahap 2 Tahun <?php echo $lss->selection_year_publication; ?>
                                        <?php endif ?><br /><br />
                                        
                                        <i style="color: red !important;">"Diharapkan kepada juri terpilih melakukan penilaian sesuai dengan tanggal yang telah ditentukan sesuai dengan seleksi yang di berikan."</i>
                                    </div>
                                    <?php else : ?>
                                        <div class="alert alert-warning bottom0">Tidak ada Seleksi Pra-Inkubasi yang dibuka saat ini</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>
            
            <?php if( as_tenant($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_tenant'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_tenant'); ?><hr />
                        <div class="body bg-amber">
                            <p>Perbaharui segera profil pengguna anda di <a href="<?php echo base_url('pengguna/profil'); ?>"><strong>MENU PROFIL</strong></a>. Pastikan data profil yang anda masukan dan sesuai dengan identitas anda.</p>
                        </div>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?> 
            
            <?php if( as_pengusul($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_user'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_user'); ?><hr />
                        <div class="body bg-amber">
                            <p>Perbaharui segera profil pengguna anda di <a href="<?php echo base_url('pengguna/profil'); ?>"><strong>MENU PROFIL</strong></a>. Pastikan data profil yang anda masukan dan sesuai dengan identitas anda.</p>
                        </div>
                        <h4>Status Pengajuan Seleksi Anda : </h4>
                        <div class="row clearfix">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="header bg-cyan">
                                        <h2>Seleksi Pra-Inkubasi<small>Tanggal Seleksi : <strong><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_adm_start)); ?></strong> - <strong><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_adm_end)); ?></strong></small></h2>
                                    </div>
                                    <div class="body">
                                        <?php if( !empty($data_praincubation) ) :?>
                                        <table class="table-container table-responsive">
                                            <thead>
                                                <tr row="row" class="heading bg-blue">
                                                    <th class="width5 center">Tahun</th> 
                                                    <th class="width20 center">Judul Usulan</th>
                                                    <th class="width10 center">Status 1</th>
                                                    <th class="width10 center">Status 2</th>
                                                </tr>
                                                <tr>
                                                    <td><center><?php echo $data_praincubation[0]->year; ?></center></td>
                                                    <td><?php echo $data_praincubation[0]->event_title; ?></td>
                                                    <td><?php echo $status_pra_1; ?></td>
                                                    <td><?php echo $status_pra_2; ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                        <?php else : ?>
                                             <strong>Maaf saat ini anda sedang tidak ada pengajuan seleksi.</strong>
                                        <?php endif ?><br />
                                        <i style="color: red !important;">"Diharapkan kepada juri terpilih melakukan penilaian sesuai dengan tanggal yang telah ditentukan sesuai dengan seleksi yang di berikan."</i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="header bg-pink">
                                        <h2>Seleksi Inkubasi<small>...</small></h2>
                                    </div>
                                    <div class="body">
                                        <?php if( !empty($data_incubation) ) :?>
                                        <div class="table-container table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr row="row" class="heading bg-blue">
                                                        <th class="width5 center">Tahun</th> 
                                                        <th class="width20 center">Judul Usulan</th>
                                                        <th class="width10 center">Status 1</th>
                                                        <th class="width10 center">Status 2</th>
                                                    </tr>
                                                    <tr>
                                                        <td><center><?php echo $data_incubation[0]->year; ?></center></td>
                                                        <td><?php echo $data_incubation[0]->event_title; ?></td>
                                                        <td><?php echo $status_inc_1; ?></td>
                                                        <td><?php echo $status_inc_2; ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php else : ?>
                                             <strong>Maaf saat ini anda sedang tidak ada pengajuan seleksi.</strong><br />
                                        <?php endif ?>
                                        
                                        <i style="color: red !important;">"Diharapkan kepada juri terpilih melakukan penilaian sesuai dengan tanggal yang telah ditentukan sesuai dengan seleksi yang di berikan."</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>
            
            <?php if( as_pelaksana($user) || as_pelaksana_tenant($user)): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_pelaksana'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_pelaksana'); ?>
                        <hr />
                        <div class="body bg-amber">
                            <p>Perbaharui segera profil pengguna anda di <a href="<?php echo base_url('pengguna/profil'); ?>"><strong>MENU PROFIL</strong></a>. Pastikan data profil yang anda masukan dan sesuai dengan identitas anda.</p>
                        </div>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>    
            
        </div>
    </div>
</div>
<!-- #END# Welcome Text -->

  