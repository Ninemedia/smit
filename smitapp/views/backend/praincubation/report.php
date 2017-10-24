<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Action Plan Pra Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR LAPORAN PRA-INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH LAPORAN
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_praincubationreport" data-url="<?php echo base_url('prainkubasi/laporandata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
            							<th class="width15">Pengguna</th>
            							<th class="width15">Nama Peneliti Utama</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <th class="width10 text-center">Total Lap</th>
                                        <th class="width10 text-center">Tanggal</th>
            							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
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
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                        <td>
                                            <?php
                                            	$workunit_type = smit_workunit_type();
                                                $option = array('' => 'Pilih...');
                                                $extra = 'name="search_workunit" class="form-control def"';

                                                if( !empty($workunit_type) ){
                                                    foreach($workunit_type as $val){
                                                        $option[$val->workunit_id] = $val->workunit_name;
                                                    }
                                                }
                                                echo form_dropdown('workunit_type',$option,'',$extra);
                                            ?>
                                        </td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubationreport_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_praincubationreport_listreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <?php echo form_open_multipart( 'praincubation/reportpraincubationadd', array( 'id'=>'reportpraincubationadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <h4>Masukan Data Notulensi Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <label class="form-label">Usulan Kegiatan Pra-Inkubasi <b style="color: red !important;">(*)</b></label>
                                    <p>Usulan kegiatan yang sudah ada pendamping</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_event" id="reg_event">
                                            <?php
                                                $conditions     = ' WHERE %companion_id% = '.$user->id.'';
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %companion_id% > 0';
                                                }
                	                        	$praincubation_list    = $this->Model_Praincubation->get_all_praincubationdata(0, 0, $conditions);
                	                            if( !empty($praincubation_list) ){
                	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
                	                                foreach($praincubation_list as $row){
                                                        echo '<option value="'.$row->id.'">'.strtoupper($row->event_title).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bulan Ke <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_month" id="reg_month">
                                            <?php
                                                $cfg_month      = config_item('month_report');
                	                            if( !empty($cfg_month) ){
                	                                echo '<option value="">-- Pilih Bulan --</option>';
                	                                foreach($cfg_month as $key => $value){
                                                        echo '<option value="'.$key.'">'.strtoupper($value).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <h4>Berkas Laporan Pelaksana Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Upload Laporan</label>
                                        <p>
                                            File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                        </p>
                                        <input id="reg_selection_files" name="reg_selection_files" class="form-control" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_reportpraincubationadd">Tambah Laporan</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_reportpraincubationadd_reset">Bersihkan</button>
                            </section>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php elseif( $is_pendamping ) :  ?>
                <div class="table-container table-responsive">
                    <div class="table-actions-wrapper">
						<span></span>
						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
							<option value="">Select...</option>
							<option value="confirm">Terima</option>
						</select>
						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
					</div>
                    <table class="table table-striped table-bordered table-hover" id="list_praincubationreport" data-url="<?php echo base_url('prainkubasi/laporandatauser'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
                                <th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
    							<th class="width5">No</th>
                                <th class="width5 text-center">Tahun</th>
    							<!-- <th class="width15">Pengguna</th> -->
    							<th class="width15">Nama Peneliti Utama</th>
                                <th class="width10 text-center">Satuan Kerja</th>
                                <th class="width30 text-center">Judul Kegiatan</th>
                                <th class="width5 text-center">Berkas</th>
                                <th class="width5 text-center">Bulan</th>
    							<th class="width10 text-center">Status</th>
                                <th class="width10 text-center">Tanggal</th>
    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    						</tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td></td>
                                <td>
                                    <select name="search_year" class="form-control form-filter input-sm">
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
                                <!-- <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td> -->
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                <td>
                                    <?php
                                    	$workunit_type = smit_workunit_type();
                                        $option = array('' => 'Pilih...');
                                        $extra = 'name="search_workunit" class="form-control def"';

                                        if( !empty($workunit_type) ){
                                            foreach($workunit_type as $val){
                                                $option[$val->workunit_id] = $val->workunit_name;
                                            }
                                        }
                                        echo form_dropdown('workunit_type',$option,'',$extra);
                                    ?>
                                </td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td></td>
                                <td></td>
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
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
    							<td style="text-align: center;">
                                    <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubation_list">Search</button>
                                    <button class="btn bg-red waves-effect filter-cancel" id="btn_praincubation_listreset">Reset</button>
    							</td>
    						</tr>
                        </thead>
                        <tbody>
                            <!-- Data Will Be Placed Here -->
                        </tbody>
                    </table>
                </div>
                <?php else : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#actionplan_list" data-toggle="tab">
                            <i class="material-icons">list</i> ACTION PLAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add_actionplan" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH ACTION PLAN
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="actionplan_list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_actionplantenantreport" data-url="<?php echo base_url('tenants/laporanactionplandata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
                                        <th class="width10 text-center">Bulan</th>
            							<th class="width15">Nama Tenant</th>
            							<th class="width20">Nama Action Plan</th>
                                        <th class="width10 text-center">Bukti Berkas</th>
                                        <th class="width10 text-center">Tanggal</th>
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
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_actionplantenantreport_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_actionplantenantreport_listreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="add_actionplan">
                        <?php echo form_open_multipart( 'tenant/reportactionplanadd', array( 'id'=>'reportactionplanadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <h4>Masukan Data Action Plan</h4>
                                <div class="form-group">
                                    <label class="form-label">Tenant <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_event" id="reg_event">
                                            <?php
                                                $conditions     = ' WHERE %user_id% = '.$user->id.'';
                                                if( !empty($is_pendamping) ){
                                                    $conditions     = ' WHERE %companion_id% = '.$user->id.'';
                                                }
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %companion_id% > 0';
                                                }
                	                        	$tenant_list    = $this->Model_Tenant->get_all_tenant(0, 0, $conditions);
                	                            if( !empty($tenant_list) ){
                	                                echo '<option value="">-- Pilih Nama Tenant --</option>';
                	                                foreach($tenant_list as $row){
                                                        echo '<option value="'.$row->id.'">'.strtoupper($row->name_tenant).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tahun <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_year" id="reg_year">
                                            <?php
                                                $year       = date("Y");
                                                $year_arr   = smit_select_year(1900,$year);
                	                            if( !empty($year_arr) ){
                	                                echo '<option value="">-- Pilih Tahun --</option>';
                	                                foreach($year_arr as $key => $value){
                                                        echo '<option value="'.$value.'">'.strtoupper($value).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bulan <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_month" id="reg_month">
                                            <?php
                                                $cfg_month      = config_item('month_report_incubation');
                	                            if( !empty($cfg_month) ){
                	                                echo '<option value="">-- Pilih Bulan --</option>';
                	                                foreach($cfg_month as $key => $value){
                                                        echo '<option value="'.$key.'">'.strtoupper($value).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email_contact">Nama Action Plan <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('reg_name_actionplan','',array('class'=>'form-control reg_name_actionplan','placeholder'=>'Nama Action Plan','required'=>'required','autocomplete'=>'off')); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <h4>Berkas Laporan Pelaksana Inkubasi/Tenant</h4> -->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Upload Action Plan</label>
                                        <p>
                                            File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                        </p>
                                        <input id="reg_actionplan_files" name="reg_actionplan_files" class="form-control" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_reportactionplanadd">Tambah Action Plan</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_reportactionplanadd_reset">Bersihkan</button>
                            </section>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <!--
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR LAPORAN PRA-INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH LAPORAN
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="list_praincubationreport" data-url="<?php echo base_url('prainkubasi/laporandatauser'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
    							         <th class="width5">No</th>
                                        <th class="width5 text-center">Tahun</th>
                                        <th class="width30 text-center">Judul Kegiatan</th>
                                        <th class="width5 text-center">Berkas</th>
                                        <th class="width5 text-center">Bulan</th>
                                        <th class="width10 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal</th>
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
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
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
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubation_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_praincubation_listreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>-->
                                    <!-- Data Will Be Placed Here --><!--
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <?php echo form_open_multipart( 'praincubation/reportpraincubationadd', array( 'id'=>'reportpraincubationadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <h4>Masukan Data Notulensi Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <label class="form-label">Usulan Kegiatan Pra-Inkubasi <b style="color: red !important;">(*)</b></label>
                                    <p>Usulan kegiatan yang sudah ada pendamping</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_event" id="reg_event">
                                            <?php
                                                $conditions     = ' WHERE %user_id% = '.$user->id.'';
                                                if( !empty($is_pendamping) ){
                                                    $conditions     = ' WHERE %companion_id% = '.$user->id.'';
                                                }
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %companion_id% > 0';
                                                }
                	                        	$praincubation_list    = $this->Model_Praincubation->get_all_praincubationdata(0, 0, $conditions);
                	                            if( !empty($praincubation_list) ){
                	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
                	                                foreach($praincubation_list as $row){
                                                        echo '<option value="'.$row->id.'">'.strtoupper($row->event_title).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Bulan Ke <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_month" id="reg_month">
                                            <?php
                                                $cfg_month      = config_item('month_report');
                	                            if( !empty($cfg_month) ){
                	                                echo '<option value="">-- Pilih Bulan --</option>';
                                                    if( !empty($is_admin) ){
                                                        foreach($cfg_month as $key => $value){
                                                            echo '<option value="'.$key.'">'.strtoupper($value).'</option>';
                    	                                }
                                                    }else{
                                                        foreach($cfg_month as $key => $value){
                                                            //$reportpra_list     = $this->Model_Praincubation->get_all_reportpraincubation(0, 0, ' WHERE %user_id% = '.$user->id.' AND %month% = '.$key.'');
                                                            //$reportpra_list     = $reportpra_list[0];

                                                            //if($reportpra_list->month != $key)
                                                            echo '<option value="'.$key.'">'.strtoupper($value).'</option>';
                    	                                }
                                                    }

                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <h4>Berkas Laporan Pelaksana Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Upload Laporan</label>
                                        <p>
                                            File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                        </p>
                                        <input id="reg_selection_files" name="reg_selection_files" class="form-control" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_reportpraincubationadd">Tambah Laporan</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_reportpraincubationadd_reset">Bersihkan</button>
                            </section>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE REPORT PRAINCUBATION MODAL -->
<div class="modal fade" id="save_reportpraincubationadd" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Laporan Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Pendaftaran Laporan Pra-Inkubasi. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_reportpraincubationadd" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE REPORT PRAINCUBATION MODAL -->
