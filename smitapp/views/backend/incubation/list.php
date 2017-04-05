<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Seleksi Inkubasi</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <div class="table-actions-wrapper">                           
                        <a href="<?php echo base_url('incubationconfirm'); ?>" class="btn btn-sm btn-success incubationconfirm">Konfirmasi Semua</a>     
            		</div>
                    <table class="table table-striped table-bordered table-hover" id="incubation_list" data-url="<?php echo base_url('incubation/incubationlistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<th class="width15 text-center">Username</th>
    							<th class="width25">Nama</th>
                                <th class="width10 text-center">Satuan Kerja</th>
                                <th class="width15 text-center">Judul Kegiatan</th>
                                <th class="width10 text-center">Status</th>
    							<th class="width10 text-center">Tahap</th>
                                <th class="width15 text-center">Tanggal Daftar</th>
    							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    						</tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_username" /></td>
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
                                <td>
                                    <select name="search_step" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<option value="<?php echo ONE; ?>">Tahap 1</option>
    									<option value="<?php echo TWO; ?>">Tahap 2</option>
    								</select>
                                </td>
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
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
    </div>
</div>
<!-- #END# Content -->