<!-- Welcome Text -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>DAFTAR PENGGUNA</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="user_list" data-url="<?php echo base_url('userlistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading">
    							<th class="width5">No</th>
    							<th class="width15 text-center">Username</th>
    							<th class="width20">Nama</th>
                                <th class="width15 text-center">Tipe</th>
                                <th class="width10 text-center">Status</th>
                                <th class="width15 text-center">Tanggal Daftar</th>
    							<th class="width20 text-center">Actions</th>
    						</tr>
                            <tr role="row" class="filter">
    							<td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-center text-lowercase" name="search_username" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                <td>
                                    <select name="search_type" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<?php
    			                        	$type = smit_user_type();
    			                            if( !empty($type) ){
    			                                foreach($type as $key => $val){
    			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
    			                                }
    			                            }
    			                        ?>
    								</select>
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
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
    							<td style="text-align: center;">
    								<button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_list_user">Search</button>
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
<!-- #END# Welcome Text -->