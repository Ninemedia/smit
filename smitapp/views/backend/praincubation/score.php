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
                                        <a href="<?php echo base_url('prainkubasi/konfirmasistep1'); ?>" class="btn btn-sm btn-success waves-effect praincubationconfirmstep1"><i class="material-icons">done_all</i> Konfirmasi Semua</a>     
                            		<?php }else{ ?>
                                        <button class="btn btn-grey waves-effect" type="button" disabled="disabled"><i class="material-icons">done_all</i> Konfirmasi Semua</button>
                                    <?php } ?>    
                        		    </div>
                                    <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('prainkubasi/adminnilaidatastep1'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                    							<th class="width20">Nama</th>
                                                <th class="width15 text-center">Satuan Kerja</th>
                                                <th class="width20 text-center">Judul Kegiatan</th>
                    							<th class="width5 text-center">Total Nilai</th>
                    							<th class="width5 text-center">Rata Nilai</th>
                                                <th class="width10 text-center">Tanggal Daftar</th>
                                                <th class="width10 text-center">Status</th>
                    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
       						                </tr>
                                            <tr role="row" class="filter display-hide table-filter">
                    							<td></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                                <td>
                                                    <?php
                                                    	$workunit_type = smit_workunit_type();
                                                        $option = array('' => 'Pilih...');
                                                        $extra = 'name="search_workunit" class="form-control show-tick"';
                            
                                                        if( !empty($workunit_type) ){
                                                            foreach($workunit_type as $val){
                                                                $option[$val->workunit_id] = $val->workunit_name;
                                                            }
                                                        }
                                                        echo form_dropdown('workunit_type',$option,'',$extra);
                                                    ?>
                                                </td>
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
                    								    <button class="btn bg-blue waves-effect filter-submit" id="btn_admin_stepone">Search</button>
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
                                <div class="table-actions-wrapper">                           
                                <?php
                                    $selection_date_result          = strtotime($lss->selection_date_result);
                                    $selection_date_proposal_start  = strtotime($lss->selection_date_proposal_start);
                                    if( $curdate >= $selection_date_result && $curdate <= $selection_date_proposal_start ){
                                ?>                           
                                    <a href="<?php echo base_url('prainkubasi/konfirmasistep2'); ?>" class="btn btn-sm btn-success waves-effect praincubationconfirmstep1"><i class="material-icons">done_all</i> Konfirmasi Semua</a>     
                        		<?php }else{ ?>
                                    <button class="btn btn-grey waves-effect" type="button" disabled="disabled"><i class="material-icons">done_all</i> Konfirmasi Semua</button>
                                <?php } ?>    
                    		    </div>
                                <table class="table table-striped table-bordered table-hover" id="admin_steptwo" data-url="<?php echo base_url('prainkubasi/adminnilaidatastep2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width20">Nama</th>
                                            <th class="width15 text-center">Satuan Kerja</th>
                                            <th class="width20 text-center">Judul Kegiatan</th>
                							<th class="width5 text-center">Total Nilai</th>
                    						<th class="width5 text-center">Rata Nilai</th>
                                            <th class="width10 text-center">Tanggal Daftar</th>
                                            <th class="width10 text-center">Status</th>
                							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
   						                </tr>
                                        <tr role="row" class="filter display-hide table-filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                            <td>
                                                <?php
                                                	$workunit_type = smit_workunit_type();
                                                    $option = array('' => 'Pilih...');
                                                    $extra = 'name="search_workunit" class="form-control show-tick"';
                        
                                                    if( !empty($workunit_type) ){
                                                        foreach($workunit_type as $val){
                                                            $option[$val->workunit_id] = $val->workunit_name;
                                                        }
                                                    }
                                                    echo form_dropdown('workunit_type',$option,'',$extra);
                                                ?>
                                            </td>
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
                                    <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('prainkubasi/jurinilaidatastep1'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                    							<th class="width20">Nama</th>
                                                <th class="width15 text-center">Satuan Kerja</th>
                                                <th class="width20 text-center">Judul Kegiatan</th>
                    							<th class="width5 text-center">Nilai</th>
                    							<th class="width5 text-center">Rata Nilai</th>
                                                <th class="width5 text-center">Tanggal Daftar</th>
                                                <th class="width5 text-center">Status</th>
                    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
       						                </tr>
                                            <tr role="row" class="filter display-hide table-filter">
                    							<td></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                                <td>
                                                    <?php
                                                    	$workunit_type = smit_workunit_type();
                                                        $option = array('' => 'Pilih...');
                                                        $extra = 'name="search_workunit" class="form-control show-tick"';
                            
                                                        if( !empty($workunit_type) ){
                                                            foreach($workunit_type as $val){
                                                                $option[$val->workunit_id] = $val->workunit_name;
                                                            }
                                                        }
                                                        echo form_dropdown('workunit_type',$option,'',$extra);
                                                    ?>
                                                </td>
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
                                <div class="alert alert-info bottom0">Proses penilaian pada tahap 1 belum dibuka. Dibuka pada tanggal <?php echo $lss->selection_date_adm_start; ?> Terima Kasih</div>  
                            <?php endif; ?>
                        <?php endif; ?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('prainkubasi/jurinilaidatastep2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width20">Nama</th>
                                            <th class="width15 text-center">Satuan Kerja</th>
                                            <th class="width20 text-center">Judul Kegiatan</th>
                							<th class="width5 text-center">Nilai</th>
                    						<th class="width5 text-center">Rata Nilai</th>
                                            <th class="width5 text-center">Tanggal Daftar</th>
                                            <th class="width5 text-center">Status</th>
                							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
   						                </tr>
                                        <tr role="row" class="filter display-hide table-filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                            <td>
                                                <?php
                                                	$workunit_type = smit_workunit_type();
                                                    $option = array('' => 'Pilih...');
                                                    $extra = 'name="search_workunit" class="form-control show-tick"';
                        
                                                    if( !empty($workunit_type) ){
                                                        foreach($workunit_type as $val){
                                                            $option[$val->workunit_id] = $val->workunit_name;
                                                        }
                                                    }
                                                    echo form_dropdown('workunit_type',$option,'',$extra);
                                                ?>
                                            </td>
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
                            
                        </div>
                    </div>
                    
                <!-- <?php elseif($is_pelaksana): ?> -->
                
                <?php else: ?>
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('praincubation/pengusulscorelistdata/'. $user->id.''); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<th class="width15">Nama</th>
                                <th class="width20 text-center">Judul Kegiatan</th>
                                <th class="width10 text-center">Status</th>
                                <th class="width10 text-center">Tanggal Daftar</th>
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