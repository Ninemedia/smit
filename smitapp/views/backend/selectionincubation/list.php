<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Seleksi Inkubasi</h2></div>
            <div class="body">
                <?php if( !empty($is_admin) ) : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="listselection" class="active">
                        <a href="#stepone" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR TAHAP 1
                        </a>
                    </li>
                    <li role="listselection">
                        <a href="#steptwo" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR TAHAP 2
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="stepone">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
                                <span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="delete">Hapus</option>
        							<!-- <option value="process">Proses Masuk Tahap 2</option> -->
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
                            <table class="table table-striped table-bordered table-hover" id="incubation_list" data-url="<?php echo base_url('seleksiinkubasi/daftardatastep1'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
            							<th class="width5">No</th>
                                        <th class="width5 text-center">Tahun</th>
            							<th class="width15">Nama Peneliti Utama</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
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
                                                $year_now   = date('Y')+1;
                                                $year_arr   = smit_select_year(1945,$year_now);
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
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
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
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_incubation_list">Search</button>
                                            </div>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_incubation_listreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="steptwo">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
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
                            <table class="table table-striped table-bordered table-hover" id="incubation_list2" data-url="<?php echo base_url('seleksiinkubasi/daftardatastep2'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width5 text-center">Tahun</th>
            							<th class="width15">Nama Peneliti Utama</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
                                        <th class="width10 text-center">Status</th>
            							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_now   = date('Y')+1;
                                                $year_arr   = smit_select_year(1945,$year_now);
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
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
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
            								<button class="btn bg-blue waves-effect filter-submit bottom5-min bottom5" id="btn_incubation_list">Search</button>
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

                <?php else : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="listselection" class="active">
                        <a href="#stepone" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR TAHAP 1
                        </a>
                    </li>
                    <li role="listselection">
                        <a href="#steptwo" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR TAHAP 2
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="stepone">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="incubation_list" data-url="<?php echo base_url('seleksiinkubasi/daftardatastep1'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
                                        <th class="width10 text-center">Status</th>
            							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_now   = date('Y')+1;
                                                $year_arr   = smit_select_year(1945,$year_now);
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
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_incubation_list">Search</button>
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

                    <div role="tabpanel" class="tab-pane fade" id="steptwo">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="incubation_list2" data-url="<?php echo base_url('seleksiinkubasi/daftardatastep2'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
                                        <th class="width10 text-center">Status</th>
            							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_now   = date('Y')+1;
                                                $year_arr   = smit_select_year(1945,$year_now);
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
            								<button class="btn bg-blue waves-effect filter-submit bottom5-min bottom5" id="btn_incubation_list">Search</button>
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
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
