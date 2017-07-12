<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Penilaian Peringkat</h2></div>
            <div class="body">
                <?php if($is_admin || $is_jury): ?>
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
                                    <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiprainkubasi/peringkatstep1'); ?>">
                                        <thead>
                                			<tr role="row" class="heading bg-blue">
                                  				<th class="width5">No</th>
                                                <th class="width10 text-center">Tahun</th>
                                  				<th class="width20">Nama</th>
                                                <th class="width15 text-center">Satuan Kerja</th>
                                                <th class="width20 text-center">Judul Kegiatan</th>
                                  				<th class="width5 text-center">Total Nilai</th>
                                  				<th class="width5 text-center">Rata Nilai</th>
                                                <th class="width10 text-center">Tanggal Usulan</th>
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
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="admin_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/peringkatstep2'); ?>">
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
                        </div>
                    </div>
                
                <?php else :  ?>
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
                                                                    <td style="font-size: 28px !important; "><strong></strong></td>
                                                                    <td style="font-size: 28px !important; "><strong></strong></td>
                                                                    <td style="font-size: 28px !important; "><strong></strong></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-col-blue">
                                    <div class="panel-heading" role="tab" id="heading_detail">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapse_detail" aria-expanded="true" aria-controls="collapse_detail">
                                                <i class="material-icons">format_align_justify</i> Detail Pengukuran IKM
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse_detail" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_detail">
                                        <div class="panel-body">
                                            <div class="table-container table-responsive table-praincubation-score">
                                                <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiprainkubasi/peringkatstep1'); ?>">
                                                    <thead>
                                            			<tr role="row" class="heading bg-blue">
                                              				<th class="width5">No</th>
                                                            <th class="width10 text-center">Tahun</th>
                                              				<th class="width20">Nama</th>
                                                            <th class="width15 text-center">Satuan Kerja</th>
                                                            <th class="width20 text-center">Judul Kegiatan</th>
                                              				<th class="width5 text-center">Total Nilai</th>
                                              				<th class="width5 text-center">Rata Nilai</th>
                                                            <th class="width10 text-center">Tanggal Usulan</th>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="admin_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/peringkatstep2'); ?>">
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
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
