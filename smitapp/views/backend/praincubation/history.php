<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Laporan Seleksi Pra Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <div class="table-container table-responsive table-praincubation-history">
                    <table class="table table-striped table-bordered table-hover" id="praincubationhistory_list" data-url="<?php echo base_url('prainkubasi/riwayatdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<th class="width15">Juri</th>
    							<th class="width15">Nama Pengusul</th>
                                <th class="width20 text-center">Judul Kegiatan</th>
                                <th class="width5 text-center">Step</th>
    							<th class="width5 text-center">Nilai</th>
                                <th class="width10 text-center">Tanggal Proses</th>
    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
			                </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_jury" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td>
                                    <select name="search_step" class="form-control form-filter input-sm def">
										<option value="">Select...</option>
										<option value="1">STEP 1</option>
										<option value="2">SETP 2</option>
									</select>
                                </td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_score" /></td>
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
                <?php if($is_jury): ?>
                    <div class="table-container table-responsive table-praincubation-history">
                        <table class="table table-striped table-bordered table-hover" id="praincubationhistory_list" data-url="<?php echo base_url('prainkubasi/riwayatdata/'.$user->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
        							<th class="width20">Nama</th>
                                    <th class="width25 text-center">Judul Kegiatan</th>
                                    <th class="width5 text-center">Step</th>
        							<th class="width5 text-center">Nilai</th>
                                    <th class="width10 text-center">Tanggal Proses</th>
        							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
				                </tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                    <td>
                                        <select name="search_step" class="form-control form-filter input-sm def">
    										<option value="">Select...</option>
    										<option value="1">STEP 1</option>
    										<option value="2">SETP 2</option>
    									</select>
                                    </td>
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_score" /></td>
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