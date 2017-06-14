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
                        <?php
                            $curdate    = date('Y-m-d H:i:s');
                            $curdate    = strtotime($curdate);
                            
                            $selection_date_adm_start   = !empty($lss) ? strtotime($lss->selection_date_adm_start) : date('Y-m-d H:i:s');
                            $selection_date_adm_end     = !empty($lss) ? strtotime($lss->selection_date_adm_end) : date('Y-m-d H:i:s');
                        ?>   
                        
                        <div role="tabpanel" class="tab-pane fade in active" id="step_one">
                            <?php if( $curdate >= $selection_date_adm_start && $curdate <= $selection_date_adm_end ): ?> 
                                <div class="table-container table-responsive table-praincubation-score">
                                    <div class="table-actions-wrapper">                           
                                    <?php
                                        $selection_date_invitation_send   = !empty($lss) ? strtotime($lss->selection_date_invitation_send) : date('Y-m-d H:i:s');
                                        $selection_date_interview_start   = !empty($lss) ? strtotime($lss->selection_date_interview_start) : date('Y-m-d H:i:s');
                                    ?>   
                                    <?php // if( $curdate >= $selection_date_invitation_send && $curdate <= $selection_date_interview_start ){ ?>                        
                                        <a href="<?php echo base_url('seleksiprainkubasi/konfirmasistep1'); ?>" class="btn btn-sm btn-success waves-effect praincubationconfirmstep1"><i class="material-icons">done_all</i></a>     
                                    <?php // } ?>    
                        		    </div>
                                    <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiprainkubasi/adminnilaidatastep1'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
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
                                                <td>
                                                    <select name="search_year" class="form-control form-filter input-sm def">
                                                    <?php
                                                        $option = array(''=>'Pilih Tahun');
                                                        $year_arr = smit_select_year(date('Y'),2030);
                                                        if( !empty($year_arr) ){
                                                            foreach($year_arr as $val){
                                                                $option[$val] = $val;
                                                            }
                                                        }
                                                        
                                                        if( !empty($option) ){
                                                            foreach($option as $val){
                                                                echo '<option value="'.$val.'">'.$val.'</option>';
                                                            }
                                                        }else{
                                                            echo '<option value="">Tahun Kosong</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                </td>
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
                                <div class="alert alert-info bottom0">Proses penilaian pada tahap 1 belum dibuka. Terima Kasih</div>  
                            <?php endif; ?>
                        </div>
                        
                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <?php
                                $selection_date_interview_start   = !empty($lss) ? strtotime($lss->selection_date_interview_start) : date('Y-m-d H:i:s');
                                $selection_date_interview_end     = !empty($lss) ? strtotime($lss->selection_date_interview_end) : date('Y-m-d H:i:s');
                            ?>  
                            <?php //if( $curdate >= $selection_date_interview_start && $curdate <= $selection_date_interview_end ) : ?>
                            <div class="table-container table-responsive">
                                <div class="table-actions-wrapper">                           
                                <?php
                                    $selection_date_result          = !empty($lss) ? strtotime($lss->selection_date_result) : date('Y-m-d H:i:s');
                                    $selection_date_proposal_start  = !empty($lss) ? strtotime($lss->selection_date_proposal_start) : date('Y-m-d H:i:s');
                                ?> 
                                <?php //if( $curdate >= $selection_date_result && $curdate <= $selection_date_proposal_start ){ ?>                          
                                    <a href="<?php echo base_url('seleksiprainkubasi/konfirmasistep2'); ?>" class="btn btn-sm btn-success waves-effect praincubationconfirmstep2"><i class="material-icons">done_all</i></a>     
                                <?php //} ?>    
                    		    </div>
                                <table class="table table-striped table-bordered table-hover" id="admin_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/adminnilaidatastep2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                                            <th class="width10 text-center">Tahun</th>
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
                                            <td>
                                                <select name="search_year" class="form-control form-filter input-sm def">
                                                <?php
                                                    $option = array(''=>'Pilih Tahun');
                                                    $year_arr = smit_select_year(date('Y'),2030);
                                                    if( !empty($year_arr) ){
                                                        foreach($year_arr as $val){
                                                            $option[$val] = $val;
                                                        }
                                                    }
                                                    
                                                    if( !empty($option) ){
                                                        foreach($option as $val){
                                                            echo '<option value="'.$val.'">'.$val.'</option>';
                                                        }
                                                    }else{
                                                        echo '<option value="">Tahun Kosong</option>';
                                                    }
                                                ?>
                                                </select>
                                            </td>
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
                								    <button class="btn bg-blue waves-effect filter-submit" id="btn_admin_steptwo">Search</button>
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
                            <?php //else : ?>
                                <!--<div class="alert alert-info bottom0">Proses penilaian pada tahap 2 belum dibuka. Terima Kasih</div>-->
                            <?php //endif; ?>
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
                                    
                                    $selection_date_adm_start   = !empty($lss) ? strtotime($lss->selection_date_adm_start) : date('Y-m-d H:i:s');
                                    $selection_date_adm_end     = !empty($lss) ? strtotime($lss->selection_date_adm_end) : date('Y-m-d H:i:s');
                                ?> 
                                
                                <?php if( $curdate >= $selection_date_adm_start && $curdate <= $selection_date_adm_end ) : ?>     
                                    <div class="table-container table-responsive table-praincubation-score">
                                        <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('seleksiprainkubasi/jurinilaidatastep1'); ?>">
                                            <thead>
                        						<tr role="row" class="heading bg-blue">
                        							<th class="width5">No</th>
                                                    <th class="width10 text-center">Tahun</th>
                        							<th class="width15">Nama Pengusul</th>
                                                    <th class="width15 text-center">Satuan Kerja</th>
                                                    <th class="width20 text-center">Judul Kegiatan</th>
                        							<th class="width5 text-center">Nilai</th>
                        							<th class="width5 text-center">Rata Nilai</th>
                                                    <th class="width10 text-center">Tanggal Daftar</th>
                                                    <th class="width5 text-center">Status</th>
                                                    <th class="width5 text-center">Ket</th>
                        							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
           						                </tr>
                                                <tr role="row" class="filter display-hide table-filter">
                        							<td></td>
                                                    <td>
                                                        <select name="search_year" class="form-control form-filter input-sm def">
                                                        <?php
                                                            $option = array(''=>'Pilih Tahun');
                                                            $year_arr = smit_select_year(date('Y'),2030);
                                                            if( !empty($year_arr) ){
                                                                foreach($year_arr as $val){
                                                                    $option[$val] = $val;
                                                                }
                                                            }
                                                            
                                                            if( !empty($option) ){
                                                                foreach($option as $val){
                                                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                                                }
                                                            }else{
                                                                echo '<option value="">Tahun Kosong</option>';
                                                            }
                                                        ?>
                                                        </select>
                                                    </td>
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
                                                    <td></td>
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
                            <?php if( $active == 0 ) : ?>
                                <div class="alert alert-warning bottom0">Saat ini anda sedang tidak menjadi juri pada tahap 2. Terima kasih.</div>
                            <?php else : ?>
                                <div class="table-container table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/jurinilaidatastep2'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
                    							<th class="width15">Nama Pengusul</th>
                                                <th class="width15 text-center">Satuan Kerja</th>
                                                <th class="width20 text-center">Judul Kegiatan</th>
                    							<th class="width5 text-center">Nilai</th>
                        						<th class="width5 text-center">Rata Nilai</th>
                                                <th class="width10 text-center">Tanggal Daftar</th>
                                                <th class="width5 text-center">Status</th>
                                                <th class="width5 text-center">Ket</th>
                    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
       						                </tr>
                                            <tr role="row" class="filter display-hide table-filter">
                    							<td></td>
                                                <td>
                                                    <select name="search_year" class="form-control form-filter input-sm def">
                                                    <?php
                                                        $option = array(''=>'Pilih Tahun');
                                                        $year_arr = smit_select_year(date('Y'),2030);
                                                        if( !empty($year_arr) ){
                                                            foreach($year_arr as $val){
                                                                $option[$val] = $val;
                                                            }
                                                        }
                                                        
                                                        if( !empty($option) ){
                                                            foreach($option as $val){
                                                                echo '<option value="'.$val.'">'.$val.'</option>';
                                                            }
                                                        }else{
                                                            echo '<option value="">Tahun Kosong</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                </td>
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
                                                <td></td>
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
                            <?php endif; ?>
                        </div>
                    </div>
                    
                <?php elseif($is_pelaksana): ?>
                
                <?php else: ?>
                
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
                        <?php
                            $curdate    = date('Y-m-d H:i:s');
                            $curdate    = strtotime($curdate);
                            
                            $selection_date_adm_start   = !empty($lss) ? strtotime($lss->selection_date_adm_start) : $curdate;
                            $selection_date_adm_end     = !empty($lss) ? strtotime($lss->selection_date_adm_end) : $curdate;
                            
                            $selection_date_int_start   = !empty($lss) ? strtotime($lss->selection_date_interview_start) : $curdate;
                            $selection_date_int_end     = !empty($lss) ? strtotime($lss->selection_date_interview_end) : $curdate;
                        ?> 
                    
                        <div role="tabpanel" class="tab-pane fade in active" id="step_one"> 
                            <?php if( $curdate >= $selection_date_adm_start && $curdate <= $selection_date_adm_end ) : ?>  
                                <div class="table-container table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('praincubation/pengusulscorelistdatastep1/'. $user->id.''); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
                                                <th class="width30 text-center">Judul Kegiatan</th>
                    							<th class="width5 text-center">Nilai</th>
                        						<th class="width5 text-center">Rata Nilai</th>
                                                <th class="width10 text-center">Tanggal Daftar</th>
                                                <th class="width5 text-center">Status</th>
                    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
                			                </tr>
                                            <tr role="row" class="filter display-hide table-filter">
                    							<td></td>
                                                <td>
                                                    <select name="search_year" class="form-control form-filter input-sm def">
                                                    <?php
                                                        $option = array(''=>'Pilih Tahun');
                                                        $year_arr = smit_select_year(date('Y'),2030);
                                                        if( !empty($year_arr) ){
                                                            foreach($year_arr as $val){
                                                                $option[$val] = $val;
                                                            }
                                                        }
                                                        
                                                        if( !empty($option) ){
                                                            foreach($option as $val){
                                                                echo '<option value="'.$val.'">'.$val.'</option>';
                                                            }
                                                        }else{
                                                            echo '<option value="">Tahun Kosong</option>';
                                                        }
                                                    ?>
                                                    </select>
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
                                <?php if( $curdate < strtotime($lss->selection_date_adm_start) ){?>
                                    <div class="alert alert-info bottom0">Proses penilaian pada tahap 1 belum dibuka. Dibuka pada tanggal <?php echo $lss->selection_date_adm_start; ?> Terima Kasih</div> 
                                <?php }else{ ?>
                                    <div class="alert alert-info bottom0">Proses penilaian tahap 1 sudah selesai. Terima Kasih</div> 
                                <?php }?>
                            <?php endif; ?>
                        </div>
    
                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <?php //if( $curdate >= $selection_date_int_start && $curdate <= $selection_date_int_end ) : ?> 
                                <?php 
                                    $condition              = ' WHERE A.user_id = "'.$user->id.'" AND %status% <> 0';
                                    $data_selection         = $this->Model_Praincubation->get_all_praincubation(0, 0, $condition, '');
                                    $data_selection         = $data_selection[0];
                                ?>
                                <?php if( empty($data_selection) || !$data_selection ){ ?>
                                    <div class="alert alert-danger bottom0">Maaf, Anda belum mengajukan seleksi Pra-Inkubasi</div>
                                <?php }else{ ?>
                                    <?php if($data_selection->status == 3 && $data_selection->statustwo <> 0) : ?>
                                        <div class="table-container table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('praincubation/pengusulscorelistdatastep2/'. $user->id.''); ?>">
                                                <thead>
                            						<tr role="row" class="heading bg-blue">
                            							<th class="width5">No</th>
                                                        <th class="width10 text-center">Tahun</th>
                                                        <th class="width20 text-center">Judul Kegiatan</th>
                            							<th class="width5 text-center">Nilai</th>
                                						<th class="width5 text-center">Rata Nilai</th>
                                                        <th class="width5 text-center">Tanggal Daftar</th>
                                                        <th class="width5 text-center">Status</th>
                            							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
                					                </tr>
                                                    <tr role="row" class="filter display-hide table-filter">
                            							<td></td>
                                                        <td>
                                                            <select name="search_year" class="form-control form-filter input-sm def">
                                                            <?php
                                                                $option = array(''=>'Pilih Tahun');
                                                                $year_arr = smit_select_year(date('Y'),2030);
                                                                if( !empty($year_arr) ){
                                                                    foreach($year_arr as $val){
                                                                        $option[$val] = $val;
                                                                    }
                                                                }
                                                                
                                                                if( !empty($option) ){
                                                                    foreach($option as $val){
                                                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                                                    }
                                                                }else{
                                                                    echo '<option value="">Tahun Kosong</option>';
                                                                }
                                                            ?>
                                                            </select>
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
                                        <div class="alert alert-danger bottom0">Maaf anda tidak lulus pada tahap 1. Terima Kasih</div>  
                                    <?php endif; ?>
                                <?php } ?>
                            <?php //else: ?>
                                <?php //if( $curdate < strtotime($lss->selection_date_interview_start) ){?>
                                    <!-- <div class="alert alert-info bottom0">Proses seleksi presentasi &amp; wawancara belum dibuka. Dibuka pada tanggal <?php echo $lss->selection_date_interview_start; ?> Terima Kasih</div> 
                                <?php //}else{ ?>
                                    <div class="alert alert-info bottom0">Proses seleksi presentasi &amp; wawancara sudah selesai. Terima Kasih</div> -->
                                <?php //}?>  
                            <?php //endif ?>
                        </div>
                    </div>
                    
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->