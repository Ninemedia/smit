<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Penilaian Seleksi Pra-Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#step_one" data-toggle="tab">
                                <i class="material-icons">label</i> TAHAP 1
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#step_two" data-toggle="tab">
                                <i class="material-icons">label</i> TAHAP 2
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="step_one">
                            
                            <?php
                                $curdate    = date('Y-m-d H:i:s');
                                $curdate    = strtotime($curdate);
                                
                                $selection_date_adm_start   = strtotime($lss->selection_date_adm_start);
                                $selection_date_adm_end     = strtotime($lss->selection_date_adm_end);
                                if( $curdate >= $selection_date_adm_start && $curdate <= $selection_date_adm_end ) :
                            ?>      
                                <div class="table-container table-responsive table-praincubation-score">
                                    <div class="table-actions-wrapper">                           
                                    <?php
                                        $selection_date_invitation_send   = strtotime($lss->selection_date_invitation_send);
                                        $selection_date_interview_start   = strtotime($lss->selection_date_interview_start);
                                        if( $curdate >= $selection_date_invitation_send && $curdate <= $selection_date_interview_start ){
                                    ?>                           
                                        <a href="<?php echo base_url('prainkubasi/konfirmasi'); ?>" class="btn btn-sm btn-success waves-effect praincubationconfirm">Konfirmasi Semua</a>     
                            		<?php }else{ ?>
                                        <button class="btn btn-grey waves-effect" type="button" disabled="disabled">Konfirmasi Semua</button>
                                    <?php } ?>    
                        		</div>
                                    <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('prainkubasi/adminnilaidata/1'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                    							<th class="width25">Nama</th>
                                                <th class="width15 text-center">Judul Kegiatan</th>
                    							<th class="width5 text-center">Total Nilai</th>
                    							<th class="width5 text-center">Rata Nilai</th>
                                                <th class="width15 text-center">Tanggal Daftar</th>
                                                <th class="width10 text-center">Status</th>
                    							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
       						                </tr>
                                            <tr role="row" class="filter display-hide table-filter">
                    							<td></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_score" /></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_avarage_score" /></td>
                                                <td>
                    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                    							</td>
                                                <td>
                                                    <select name="search_status" class="form-control form-filter input-sm">
                    									<option value="">Pilih...</option>
                    									<?php
                    			                        	$status = smit_incubation_selection_status();
                    			                            if( !empty($status) ){
                    			                                foreach($status as $key => $val){
                                                                    if($key==RATED || $key==ACCEPTED) continue;
                    			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                    			                                }
                    			                            }
                    			                        ?>
                    								</select>
                                                </td>
                    							<td style="text-align: center;">
                                                    <div class="bottom5">
                    								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                                    </div>
                                                    <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                    							</td>
                    						</tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data Will Be Placed Here -->
                                        </tbody>
                                    </table>
                                </div>
                    		<?php else : ?>
                                <div class="alert alert-info bottom0">Proses penilaian pada tahap 1 belum dibuka. Dibuka pada tanggal <strong><?php echo $lss->selection_date_adm_start; ?></strong> Terima Kasih</div>  
                            <?php endif; ?>
                        </div>
                        
                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <?php
                                $selection_date_interview_start   = strtotime($lss->selection_date_interview_start);
                                $selection_date_interview_end     = strtotime($lss->selection_date_interview_end);
                                if( $curdate >= $selection_date_interview_start && $curdate <= $selection_date_interview_end ) :
                            ?>  
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="admin_steptwo" data-url="<?php echo base_url('prainkubasi/adminnilaidata/2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width25">Nama</th>
                                            <th class="width15 text-center">Judul Kegiatan</th>
                							<th class="width5 text-center">Total Nilai</th>
                    							<th class="width5 text-center">Rata Nilai</th>
                                            <th class="width15 text-center">Tanggal Daftar</th>
                                            <th class="width10 text-center">Status</th>
                							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
   						                </tr>
                                        <tr role="row" class="filter display-hide table-filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_score" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_avarage_score" /></td>
                                            <td>
                								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                							</td>
                                            <td>
                                                <select name="search_status" class="form-control form-filter input-sm">
                									<option value="">Pilih...</option>
                									<?php
                			                        	$status = smit_user_status();
                			                            if( !empty($status) ){
                			                                foreach($status as $key => $val){
                			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                			                                }
                			                            }
                			                        ?>
                								</select>
                                            </td>
                							<td style="text-align: center;">
                                                <div class="bottom5">
                								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                                </div>
                                                <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                							</td>
                						</tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Will Be Placed Here -->
                                    </tbody>
                                </table>
                            </div>
                            <?php else : ?>
                                <div class="alert alert-info bottom0">Proses penilaian pada tahap 2 belum dibuka. Dibuka pada tanggal <strong><?php echo $lss->selection_date_interview_start; ?></strong> Terima Kasih</div>  
                            <?php endif; ?>
                        </div>
                    </div>
                
                <?php elseif($is_jury): ?>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#step_one" data-toggle="tab">
                                <i class="material-icons">label</i> TAHAP 1
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#step_two" data-toggle="tab">
                                <i class="material-icons">label</i> TAHAP 2
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="step_one">
                            <?php if( $active == 0 ) : ?>
                                <div class="alert alert-warning bottom0">Saat ini anda sedang tidak menjadi juri pada tahap 1. Terima kasih.</div>
                            <?php else : ?>
                            
                                <?php
                                    $curdate    = date('Y-m-d H:i:s');
                                    $curdate    = strtotime($curdate);
                                    
                                    $selection_date_adm_start   = strtotime($lss->selection_date_adm_start);
                                    $selection_date_adm_end     = strtotime($lss->selection_date_adm_end);
                                    if( $curdate >= $selection_date_adm_start && $curdate <= $selection_date_adm_end ) :
                                ?>      
                                    <div class="table-container table-responsive table-praincubation-score">
                                        <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('prainkubasi/jurinilaidata/1'); ?>">
                                            <thead>
                        						<tr role="row" class="heading bg-blue">
                        							<th class="width5">No</th>
                        							<th class="width25">Nama</th>
                                                    <th class="width15 text-center">Judul Kegiatan</th>
                        							<th class="width5 text-center">Nilai</th>
                                                    <th class="width15 text-center">Tanggal Daftar</th>
                                                    <th class="width10 text-center">Status</th>
                        							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
           						                </tr>
                                                <tr role="row" class="filter display-hide table-filter">
                        							<td></td>
                        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_score" /></td>
                                                    <td>
                        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                        							</td>
                                                    <td>
                                                        <select name="search_status" class="form-control form-filter input-sm">
                        									<option value="">Pilih...</option>
                        									<?php
                        			                        	$status = smit_incubation_selection_status();
                        			                            if( !empty($status) ){
                        			                                foreach($status as $key => $val){
                                                                        if($key==RATED || $key==ACCEPTED) continue;
                        			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                        			                                }
                        			                            }
                        			                        ?>
                        								</select>
                                                    </td>
                        							<td style="text-align: center;">
                                                        <div class="bottom5">
                        								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                                        </div>
                                                        <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                        							</td>
                        						</tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data Will Be Placed Here -->
                                            </tbody>
                                        </table>
                                    </div>
                        		<?php else : ?>
                                    <div class="alert alert-info bottom0">Proses penilaian pada tahap 1 belum dibuka. Dibuka pada tanggal <?php echo $lss->selection_date_adm_start; ?> Terima Kasih</div>  
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('prainkubasi/jurinilaidata/2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width25">Nama</th>
                                            <th class="width15 text-center">Judul Kegiatan</th>
                							<th class="width5 text-center">Nilai</th>
                                            <th class="width15 text-center">Tanggal Daftar</th>
                                            <th class="width10 text-center">Status</th>
                							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
   						                </tr>
                                        <tr role="row" class="filter display-hide table-filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_score" /></td>
                                            <td>
                								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                							</td>
                                            <td>
                                                <select name="search_status" class="form-control form-filter input-sm">
                									<option value="">Pilih...</option>
                									<?php
                			                        	$status = smit_user_status();
                			                            if( !empty($status) ){
                			                                foreach($status as $key => $val){
                			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                			                                }
                			                            }
                			                        ?>
                								</select>
                                            </td>
                							<td style="text-align: center;">
                                                <div class="bottom5">
                								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                                </div>
                                                <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                							</td>
                						</tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Will Be Placed Here -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Score Pra Incubation Details -->
                            <div class="card top30 bottom0 display-hide" id="scoredata_details2">
                                <div class="header bg-cyan">
                                    <h2>Seleksi Inkubasi Tahap 2</h2>
                                    <ul class="header-dropdown m-r--0">
                                        <li class="dropdown">
                                            <a class="close-details" href="javascript:void(0);">
                                                <i class="material-icons">close</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-3 bottom0">
                                            <!-- Profile Image -->
                                            <div class="box box-primary">
                                                <div class="box-body box-profile">
                                                    <img class="profile-user-img img-responsive img-circle" 
                                                    src="<?php echo BE_IMG_PATH . 'avatar/avatar1.png'; ?>" 
                                                    alt="User Profile Picture" />
                                                    <h3 class="profile-name text-center col-teal">Nama Pengguna</h3>
                                                    <h5 class="profile-username text-center"><i class="material-icons">person</i> Username Pengguna</h5>
                                                    <h5 class="profile-email text-center"><i class="material-icons">email</i> example@email.com</h5>
                                                    <h5 class="profile-phone text-center"><i class="material-icons">phone</i> +8123456789</h5>
                                                    <h3 class="selection-status text-center"></h3>
                                                </div>
                                            </div>
                                            <hr class="line-warning bottom20" />
                                        </div>
                                        <div class="col-md-9 bottom0">
                                            <div id="alert-display"></div>
                                            <h2 class="card-inside-title text-uppercase">Berkas dan Proposal Kegiatan</h2>
                                            <?php
                                                if( !empty($data_selection) ){
                                                    echo '<ul class="bottom40">';
                                                    foreach($data_selection as $file){
                                                        echo '<li>'.strtoupper($file->filename).' - <a href="'.base_url('unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                                    }
                                                    echo '</ul>';
                                                }else{
                                                    echo '<strong>Tidak ada berkas panduan</strong>';
                                                }
                                            ?>
                                            <h2 class="card-inside-title text-uppercase top25">FORMULIR EVALUASI TEKNOLOGI LIPI</h2>
                                            <div class="form-group form-float">
                                                <label class="form-label">Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="eval_username" id="eval_username" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Nama Pengusul</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="eval_name" id="eval_name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Satuan Kerja/PT/CV</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="eval_unit" id="eval_unit" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Judul Teknologi</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="eval_title" id="eval_title" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--
                                            <div class="body bg-blue top30 bottom30">
                                                <p align="center" class="bottom0"><strong>Perhatian</strong></p>
                                            </div>
                                            -->
                                            <table class="table table-striped table-bordered table-hover" id="jury_steptwo">
                                                <thead>
                                                    <tr class="bg-blue-grey">
                                                        <td colspan="2"><strong>TOTAL NILAI</strong></td>
                                                        <td class="text-large text-center"><input class="text-center input-mini text-darken-1" name="total_rate" id="total_rate" value="0" /></td>
                                                    </tr>
                            						<tr role="row" class="heading">
                            							<th class="width15 text-center text-middle">Klaster Kriteria</th>
                            							<th class="width15 text-center text-middle">Unsur/Kriteria</th>
                            							<th class="width40 text-center text-middle">Indikator</th>
                            						</tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data Will Be Placed Here -->
                                                    
                                                    <!-- Pasar -->
                                                    <tr>
                                                        <td rowspan="5">Pasar<br />(Total 100%)</td>
                                                        <td>Deskripsi Kebutuhan Pengguna</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster1_a_indikator" id="klaster1_a_indikator" data-selector="klaster1_a" value="" />
                                                            <input type="hidden" name="klaster1_a_max" id="klaster1_a_max" value="30" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster1_a_rate" id="klaster1_a_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Deskripsi Sasaran Pengguna</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster1_b_indikator" id="klaster1_b_indikator" data-selector="klaster1_b" value="" />
                                                            <input type="hidden" name="klaster1_b_max" id="klaster1_b_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster1_b_rate" id="klaster1_b_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Besar Pasar</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster1_c_indikator" id="klaster1_c_indikator" data-selector="klaster1_c" value="" />
                                                            <input type="hidden" name="klaster1_c_max" id="klaster1_c_max" value="20" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster1_c_rate" id="klaster1_c_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rencana Pemasaran</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster1_d_indikator" id="klaster1_d_indikator" data-selector="klaster1_d" value="" />
                                                            <input type="hidden" name="klaster1_d_max" id="klaster1_d_max" value="25" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster1_d_rate" id="klaster1_d_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pertumbuhan Pasar</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster1_e_indikator" id="klaster1_e_indikator" data-selector="klaster1_e" value="" />
                                                            <input type="hidden" name="klaster1_e_max" id="klaster1_e_max" value="10" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster1_e_rate" id="klaster1_e_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    
                                                    <!-- Produk/Jasa -->
                                                    <tr>
                                                        <td rowspan="5">Produk/Jasa<br />(Total 100%)</td>
                                                        <td>Deskripsi dan fungsi produk</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster2_a_indikator" id="klaster2_a_indikator" data-selector="klaster2_a" value="" />
                                                            <input type="hidden" name="klaster2_a_max" id="klaster2_a_max" value="20" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster2_a_rate" id="klaster2_a_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tingkat kesiapan</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster2_b_indikator" id="klaster2_b_indikator" data-selector="klaster2_b" value="" />
                                                            <input type="hidden" name="klaster2_b_max" id="klaster2_b_max" value="10" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster2_b_rate" id="klaster2_b_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perlindungan HKI</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster2_c_indikator" id="klaster2_c_indikator" data-selector="klaster2_c" value="" />
                                                            <input type="hidden" name="klaster2_c_max" id="klaster2_c_max" value="20" />    
                                                            <input type="hidden" class="text-center input-mini" name="klaster2_c_rate" id="klaster2_c_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manfaat/kegunaan dibanding produk sejenis.</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster2_d_indikator" id="klaster2_d_indikator" data-selector="klaster2_d" value="" />
                                                            <input type="hidden" name="klaster2_d_max" id="klaster2_d_max" value="30" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster2_d_rate" id="klaster2_d_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Derajat inovasi teknologi/tingkat kebaruan </td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster2_e_indikator" id="klaster2_e_indikator" data-selector="klaster2_e" value="" />
                                                            <input type="hidden" name="klaster2_e_max" id="klaster2_e_max" value="20" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster2_e_rate" id="klaster2_e_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    
                                                    <!-- Finansial -->
                                                    <tr>
                                                        <td rowspan="5">Finansial<br />(Total 100%)</td>
                                                        <td>Target skenario harga jual</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster3_a_indikator" id="klaster3_a_indikator" data-selector="klaster3_a" value="" />
                                                            <input type="hidden" name="klaster3_a_max" id="klaster3_a_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster3_a_rate" id="klaster3_a_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Target skenario harga jual</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster3_b_indikator" id="klaster3_b_indikator" data-selector="klaster3_b" value="" />
                                                            <input type="hidden" name="klaster3_b_max" id="klaster3_b_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster3_b_rate" id="klaster3_b_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Proyeksi potensi pendapatan dan imbal hasil investasi</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster3_c_indikator" id="klaster3_c_indikator" data-selector="klaster3_c" value="" />
                                                            <input type="hidden" name="klaster3_c_max" id="klaster3_c_max" value="40" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster3_c_rate" id="klaster3_c_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Besaran permintaan Investasi yang diperlukan</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster3_d_indikator" id="klaster3_d_indikator" data-selector="klaster3_d" value="" />
                                                            <input type="hidden" name="klaster3_d_max" id="klaster3_d_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster3_d_rate" id="klaster3_d_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kontribusi finansial mitra</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster3_e_indikator" id="klaster3_e_indikator" data-selector="klaster3_e" value="" />
                                                            <input type="hidden" name="klaster3_e_max" id="klaster3_e_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster3_e_rate" id="klaster3_e_rate" value="0" />
                                                        </td>
                                                    </tr> 
                                                    
                                                    <!-- Kapasitas SDM dan Alih Teknologi -->
                                                    <tr>
                                                        <td rowspan="5">Kapasitas SDM dan Alih Teknologi<br />(Total 100%)</td>
                                                        <td>Mentor teknis/ peneliti/perekayasa</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster4_a_indikator" id="klaster4_a_indikator" data-selector="klaster4_a" value="" />
                                                            <input type="hidden" name="klaster4_a_max" id="klaster4_a_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster4_a_rate" id="klaster4_a_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mentor bisnis/ manajemen</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster4_b_indikator" id="klaster4_b_indikator" data-selector="klaster4_b" value="" />
                                                            <input type="hidden" name="klaster4_b_max" id="klaster4_b_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster4_b_rate" id="klaster4_b_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manajemen mitra</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster4_c_indikator" id="klaster4_c_indikator" data-selector="klaster4_c" value="" />
                                                            <input type="hidden" name="klaster4_c_max" id="klaster4_c_max" value="35" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster4_c_rate" id="klaster4_c_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Staff Mitra</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster4_d_indikator" id="klaster4_d_indikator" data-selector="klaster4_d" value="" />
                                                            <input type="hidden" name="klaster4_d_max" id="klaster4_d_max" value="20" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster4_d_rate" id="klaster4_d_rate" value="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Skema alih teknologi</td>
                                                        <td>
                                                            <input type="text" class="slider-indikator" name="klaster4_e_indikator" id="klaster4_e_indikator" data-selector="klaster4_e" value="" />
                                                            <input type="hidden" name="klaster4_e_max" id="klaster4_e_max" value="15" />
                                                            <input type="hidden" class="text-center input-mini" name="klaster4_e_rate" id="klaster4_e_rate" value="0" />
                                                        </td>
                                                    </tr>  
                                                    <tr class="bg-blue-grey">
                                                        <td colspan="2"><strong>TOTAL NILAI</strong></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini text-darken-1" name="total_rate" id="total_rate" value="0" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Score Incubation Details -->
                            
                            <!-- Score Incubation Nilai -->
                            <div class="card top30 bottom0 display-hide" id="scoredata_nilai">
                                <div class="header bg-cyan">
                                    <h2>Seleksi Inkubasi Tahap 1</h2>
                                    <ul class="header-dropdown m-r--0">
                                        <li class="dropdown">
                                            <a class="close-nilai" href="javascript:void(0);">
                                                <i class="material-icons">close</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Profile Image -->
                                            <h1 class="card-inside-title"><center>FORMULIR EVALUASI TEKNOLOGI LIPI</center></h1>
                                            <div class="form-group form-float">
                                                <label class="form-label">Username</label>
                                                <input type="hidden" name="reg_username" id="reg_username" />
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reg_username" id="reg_username_data" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Nama Pengusul</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="name" id="name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Satuan Kerja/PT/CV</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="name" id="name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Judul Teknologi</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="name" id="name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body bg-teal">
                                                <p align="center" class="bottom0"><strong>Perhatian</strong><br />De</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                <!-- <?php elseif($is_pelaksana): ?> -->
                
                <?php else: ?>
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('praincubation/pengusulscorelistdata/'. $user->id.''); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<th class="width25">Nama</th>
                                <th class="width15 text-center">Judul Kegiatan</th>
                                <th class="width10 text-center">Status</th>
                                <th class="width15 text-center">Tanggal Daftar</th>
    							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
			                </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<?php
    			                        	$status = smit_incubation_selection_status();
    			                            if( !empty($status) ){
    			                                foreach($status as $key => $val){
                                                    if($key==RATED || $key==ACCEPTED) continue;
    			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
    			                                }
    			                            }
    			                        ?>
    								</select>
                                </td>
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
    							<td style="text-align: center;">
                                    <div class="bottom5">
    								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                    </div>
                                    <button class="btn bg-red waves-effect filter-cancel">Reset</button>
    							</td>
    						</tr>
                        </thead>
                        <tbody>
                            <!-- Data Will Be Placed Here -->
                        </tbody>
                    </table>
                </div>
                
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->