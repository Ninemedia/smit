<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Produk</h2></div>
            <div class="body">
                <!-- Content -->
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="producr_list" data-url="<?php echo base_url('praincubation/productlistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
                                <th class="width15 text-center">Nama</th>
    							<th class="width15 text-center">Judul Usulan</th>
    							<th class="width15 text-center">Judul Product</th>
    							<th class="width20 text-center">Gambar Produk</th>
    							<th class="width10 text-center">Status</th>
                                <th class="width10 text-center">Tanggal Daftar</th>
    							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
					        </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_name" /></td>
                                <td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
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
    								<button class="btn bg-blue waves-effect filter-submit" id="btn_slider_list">Search</button>
                                    <button class="btn bg-red waves-effect filter-cancel" id="btn_slider_listreset">Reset</button>
    							</td>
    						</tr>
                        </thead>
                        <tbody>
                            <!-- Data Will Be Placed Here -->
                        </tbody>
                    </table>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->