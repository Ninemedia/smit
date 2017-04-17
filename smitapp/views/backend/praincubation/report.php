<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Laporan Seleksi Pra Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <div class="table-container table-responsive">
                    <div class="table-actions-wrapper">                           
                        <a href="<?php echo base_url('prainkubasi/laporan/korfimall'); ?>" class="btn btn-sm btn-success praincubationreportconfirm">Konfirmasi Semua</a>     
            		</div>
                    <table class="table table-striped table-bordered table-hover" id="praincubationreport_list" data-url="<?php echo base_url('praincubation/praincubationrepordatatlist'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<th class="width15 text-center">Username</th>
    							<th class="width25">Nama</th>
                                <th class="width15 text-center">Judul Kegiatan</th>
                                <th class="width10 text-center">Status</th>
                                <th class="width10 text-center">Konfirmasi</th>
                                <th class="width10 text-center">Jenis File</th>
    							<th class="width15 text-center">Pemeriksa</th>
                                <th class="width15 text-center">Tanggal Daftar</th>
    							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    						</tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_username" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<?php
    			                        	$status = smit_incubation_selection_report_status();
    			                            if( !empty($status) ){
    			                                foreach($status as $key => $val){
    			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
    			                                }
    			                            }
    			                        ?>
    								</select>
                                </td>
                                <td>
                                    <select name="search_confirmed" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<option value="0">BELUM DIKONFIRMASI</option>
                                        <option value="1">DIKONFIRMASI</option>
    								</select>
                                </td>
                                <td>
                                    <select name="search_extension" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<option value="pdf">PDF</option>
    									<option value="doc">DOC</option>
    									<option value="docx">DOCX</option>
    									<option value="xls">XLS</option>
    									<option value="xlsx">XLSX</option>
    								</select>
                                </td>
    							<td><input type="text" class="form-control form-filter input-sm text-center text-lowercase" name="search_jury" /></td>
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
    							<td style="text-align: center;">
    								<button class="btn bg-blue waves-effect filter-submit bottom5-min bottom5" id="btn_praincubationreport_list">Search</button>
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
                <?php if($is_jury): ?>
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
                            <table class="table table-striped table-bordered table-hover" id="praincubationreport_list" data-url="<?php echo base_url('prainkubasi/laporan/step1'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
            							<th class="width25">Nama</th>
                                        <th class="width15 text-center">Judul Kegiatan</th>
            							<th class="width5 text-center">Nilai</th>
                                        <th class="width15 text-center">Tanggal Proses</th>
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
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="step_two">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('prainkubasi/laporan/step1'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
            							<th class="width25">Nama</th>
                                        <th class="width15 text-center">Judul Kegiatan</th>
            							<th class="width5 text-center">Nilai</th>
                                        <th class="width15 text-center">Tanggal Proses</th>
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
                        
                    </div>
                </div>
                
                <?php endif ?> 
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->