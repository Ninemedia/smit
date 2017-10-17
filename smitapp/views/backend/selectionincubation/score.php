<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Penilaian Seleksi Inkubasi</h2></div>
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

                                <div class="table-container table-responsive table-praincubation-score">
                                    <div class="table-actions-wrapper">
                                        <!-- <a href="<?php echo base_url('seleksiinkubasi/konfirmasistep1'); ?>" class="btn btn-sm btn-success waves-effect incubationconfirmstep1"><i class="material-icons">done_all</i></a> -->
                                        <select class="table-group-action-input form-control input-inline input-small input-sm" disabled="disabled">
                							<option value="">Select...</option>
                							<!-- <option value="confirm">Proses Masuk Tahap 2</option> -->
                							<option value="graduate">Lulus</option>
                							<option value="notgraduate">Tidak Lulus</option>
                							<option value="delete">Hapus</option>
                						</select>
                						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-warning dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                Export
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="javascript:;" class="table-export-excel"> Export ke Excel </a></li>
                                                <!-- <li><a href="javascript:;" class="table-export-pdf"> Export ke PDF </a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiinkubasi/adminnilaidatastep1'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5 text-center"><input name="select_all" id="select_all_step1" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_step1"></label></th>
                    							<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
                    							<th class="width20">Nama Peneliti Utama</th>
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
                                                    <button class="btn bg-red waves-effect filter-cancel" id="btn_resetadmin_stepone">Reset</button>
                    							</td>
                    						</tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data Will Be Placed Here -->
                                        </tbody>
                                    </table>
                                </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <div class="table-container table-responsive">
                                <div class="table-actions-wrapper">
                                    <!--<a href="<?php echo base_url('seleksiinkubasi/konfirmasistep2'); ?>" class="btn btn-sm btn-success waves-effect incubationconfirmstep2"><i class="material-icons">done_all</i></a>
                        		     <button class="btn btn-grey waves-effect" type="button" disabled="disabled"><i class="material-icons">done_all</i> Konfirmasi Semua</button> -->
                                    <select class="table-group-action-input form-control input-inline input-small input-sm" disabled="disabled">
            							<option value="">Select...</option>
            							<!-- <option value="confirm">Konfirmasi Kelulusan</option> -->
                                        <option value="graduate">Lulus</option>
                                        <option value="notgraduate">Tidak Lulus</option>
                                        <!-- <option value="delete">Hapus</option> -->
            						</select>
            						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-warning dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                            Export
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="javascript:;" class="table-export-excel"> Export ke Excel </a></li>
                                            <!-- <li><a href="javascript:;" class="table-export-pdf"> Export ke PDF </a></li> -->
                                        </ul>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="admin_steptwo" data-url="<?php echo base_url('seleksiinkubasi/adminnilaidatastep2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5 text-center"><input name="select_all" id="select_all_step2" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_step2"></label></th>
                							<th class="width5">No</th>
                                            <th class="width10 text-center">Tahun</th>
                							<th class="width20">Nama Peneliti Utama</th>
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
                			                        	$status = smit_incubation_selection_status_steptwo();
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
                                                <button class="btn bg-red waves-effect filter-cancel" id="btn_resetadmin_steptwo">Reset</button>
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
                                    <p>Status penilaian akan berubah jika seluruh juri seleksi sudah menilai berkas proposal. Jika anda sudah melakukan penilaian maka keterangan akan bertanda ceklis.</p>
                                    <div class="table-container table-responsive table-praincubation-score">
                                    <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('seleksiinkubasi/jurinilaidatastep1'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
                    							<th class="width15">Nama Peneliti Utama</th>
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

                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <?php if( $active2 == 0 ) : ?>
                                <div class="alert alert-warning bottom0">Saat ini anda sedang tidak menjadi juri pada tahap 2. Terima kasih.</div>
                            <?php else : ?>
                                <p>Data tahap 2 akan muncul jika data proposal kegiatan pengusul sudah di konfirmasi oleh admin. Status penilaian akan berubah jika seluruh juri seleksi sudah menilai berkas proposal. Jika anda sudah melakukan penilaian maka keterangan akan bertanda ceklis.</p>

                                <div class="table-container table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('seleksiinkubasi/jurinilaidatastep2'); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                    							<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
                    							<th class="width15">Nama Peneliti Utama</th>
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
                    			                        	$status = smit_incubation_selection_status_steptwo();
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
                        <div role="tabpanel" class="tab-pane fade in active" id="step_one">

                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('incubation/pengusulscorelistdatastep1/'. $user->id.''); ?>">
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

                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <?php
                                $condition              = ' WHERE A.user_id = "'.$user->id.'" AND %statustwo% <> 0';
                                $data_selection         = $this->Model_Incubation->get_all_incubation(0, 0, $condition, '');
                                $data_selection         = $data_selection[0];
                            ?>
                            <?php if( empty($data_selection) || !$data_selection ) : ?>
                                <div class="alert alert-info bottom0">Maaf, untuk saat ini pengajuan Seleksi Inkubasi anda belum memasuki tahap 2</div>
                            <?php else :  ?>
                                <?php if($data_selection->status == 3 && $data_selection->statustwo <> 0) : ?>
                                <div class="table-container table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('incubation/pengusulscorelistdatastep2/'. $user->id.''); ?>">
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
                    			                        	$status = smit_incubation_selection_status_steptwo();
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
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
