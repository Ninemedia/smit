<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pendampingan Tenant</h2></div>
            <div class="body">
            <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="accompaniment">
                    <li role="accompaniment" class="active">
                        <a href="#listaccompaniment" id="listaccompaniment_tab" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR PENDAMPINGAN
                        </a>
                    </li>
                    <li role="accompaniment">
                        <a href="#companionassignment" id="companionassignment_tab" data-toggle="tab">
                            <i class="material-icons">add_box</i> PENETAPAN PENDAMPING
                        </a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Tab Content List Accompaniment -->
                    <div role="tabpanel" class="tab-pane fade in active" id="listaccompaniment">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tenantaccompaniment_list" data-url="<?php echo base_url('tenants/daftarpendampingan'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center">No</th>
            							<th class="width20">Nama Tenant</th>
                                        <th class="width15 text-center">Pelaksana</th>
                                        <th class="width15 text-center">Peneliti Utama</th>
                                        <th class="width15 text-center">Pendamping</th>
            							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_tenant_name" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_companion_name" /></td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_accompaniment_list">Search</button>
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
                    
                    <!-- Tab Content Add Accompaniment -->
                    <div role="tabpanel" class="tab-pane fade" id="companionassignment">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tenantacceptedselection_list" data-url="<?php echo base_url('tenant/tenantacceptedlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center">No</th>
            							<th class="width15 text-center">Nama Tenant</th>
            							<th class="width15">Judul Kegiatan</th>
                                        <th class="width15 text-center">Pelaksana</th>
                                        <th class="width15 text-center">Peneliti Utama</th>
            							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user_name" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_acceptedselection_list">Search</button>
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
            <?php else : ?>
                <div class="table-container table-responsive">
                    <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="tenantaccompaniment_list" data-url="<?php echo base_url('tenants/daftarpendampingan'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5 text-center">No</th>
        							<th class="width20">Nama Tenant</th>
                                    <th class="width15 text-center">Pelaksana</th>
                                    <th class="width15 text-center">Peneliti Utama</th>
                                    <th class="width15 text-center">Pendamping</th>
        							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
        						</tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_tenant_name" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_companion_name" /></td>
        							<td style="text-align: center;">
                                        <div class="bottom5">
        								    <button class="btn bg-blue waves-effect filter-submit" id="btn_accompaniment_list">Search</button>
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
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->