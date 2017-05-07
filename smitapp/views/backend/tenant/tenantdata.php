<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Tenant</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="list_tenant" data-url="<?php echo base_url('tenant/tenantlistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<th class="width15">Pengguna</th>
                                <th class="width10 text-center">Nama Tenant</th>
                                <th class="width10 text-center">Email</th>
                                <th class="width10 text-center">Telp</th>
                                <th class="width5 text-center">Tahun Berdiri</th>
                                <th class="width10 text-center">Status</th>
    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    						</tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_email" /></td>
                                <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_phone" /></td>
                                <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_year" /></td>
                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<option value="<?php echo ACTIVE; ?>">AKTIF</option>
    									<option value="<?php echo NONACTIVE; ?>">TIDAK AKTIF</option>
    								</select>
                                </td>
    							<td style="text-align: center;">
                                    <div class="bottom5">
    								    <button class="btn bg-blue waves-effect filter-submit" id="btn_tenant_list">Search</button>
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
<!-- #END# Content -->