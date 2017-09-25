<!-- BEGIN INFORMATION SUCCESS SAVE WORKUNIT MODAL -->
<div class="modal fade" id="save_workunit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Satuan Kerja</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Satuan Kerja. Pastikan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_workunit" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE WORKUNIT MODAL -->

<!-- BEGIN INFORMATION SUCCESS EDIT WORKUNIT MODAL -->
<div class="modal fade" id="edit_workunit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Satuan Kerja</h4>
			</div>
			<div class="modal-body">
                <?php echo form_open_multipart( 'backend/workunitedit', array( 'id'=>'workunitedit', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <div class="form-group">
                        <label class="form-label">Nama Satuan Kerja <b style="color: red !important;">(*)</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                            <div class="form-line">
                                <input type="hidden" name="reg_id_workunit_edit" id="reg_id_workunit_edit" value="" />
                                <input type="text" name="reg_workunit_edit" id="reg_workunit_edit" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status <b style="color: red !important;">(*)</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                            <select class="form-control show-tick" name="reg_status_edit" id="reg_status_edit">
                                <option value="">-- Pilih Status --</option>
                                <?php
    	                        	$status = smit_workunit_status();
    	                            if( !empty($status) ){
    	                                foreach($status as $key => $val){
		                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
		                                }
    	                            }else{
    	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
    	                            }
    	                        ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_edit_workunit" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT WORKUNIT MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE KATEGORI MODAL -->
<div class="modal fade" id="save_category" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Kategori</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Kategori. Pastikan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_category" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE KATEGORI MODAL -->

<!-- BEGIN INFORMATION SUCCESS EDIT KATEGORI MODAL -->
<div class="modal fade" id="edit_category" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Kategori</h4>
			</div>
			<div class="modal-body">
                <?php echo form_open_multipart( 'backend/categoryedit', array( 'id'=>'categoryedit', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <div class="form-group">
                        <label class="form-label">Nama Kategori <b style="color: red !important;">(*)</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                            <div class="form-line">
                                <input type="hidden" name="reg_id_category" id="reg_id_category" value="" />
                                <input type="text" name="reg_category" id="reg_category" class="form-control" placeholder="Masukan Nama Kategori" required>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-danger waves-effect" id="btn_category_reset">Bersihkan</button> -->
                </div>
                <?php echo form_close(); ?>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_edit_category" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT KATEGORI MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE KATEGORI PRODUCT MODAL -->
<div class="modal fade" id="save_categoryproduct" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Kategori</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Kategori Produk. Pastikan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_categoryproduct" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE KATEGORI PRODUCT MODAL -->

<!-- BEGIN INFORMATION SUCCESS EDIT KATEGORI PRODUCT MODAL -->
<div class="modal fade" id="edit_categoryproduct" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Kategori Produk</h4>
			</div>
			<div class="modal-body">
                <?php echo form_open_multipart( 'backend/categoryproductedit', array( 'id'=>'categoryproductedit', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <div class="form-group">
                        <label class="form-label">Nama Kategori <b style="color: red !important;">(*)</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                            <div class="form-line">
                                <input type="hidden" name="reg_id_categoryproduct" id="reg_id_categoryproduct" value="" />
                                <input type="text" name="reg_categoryproduct" id="reg_categoryproduct" class="form-control" placeholder="Masukan Nama Kategori Produk" required>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-danger waves-effect" id="btn_category_reset">Bersihkan</button> -->
                </div>
                <?php echo form_close(); ?>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_edit_categoryproduct" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT KATEGORI PRODUCT MODAL -->

<!-- Workunit Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_workunit">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_workunit" aria-expanded="true" aria-controls="collapse_workunit">
                    <i class="material-icons">format_align_justify</i> Daftar Satuan Kerja
                </a>
            </h4>
        </div>
        <div id="collapse_workunit" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_workunit">
            <div class="panel-body">
                <!-- Content -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="body">
                                <?php if($is_admin): ?>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#list" data-toggle="tab">
                                            <i class="material-icons">list</i> DAFTAR SATUAN KERJA
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#add" data-toggle="tab">
                                            <i class="material-icons">add_box</i> TAMBAH SATUAN KERJA
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                                        <div id="alert" class="alert display-hide"></div>
                                        <div class="table-container table-responsive">
										<div class="table-actions-wrapper">
											<span></span>
											<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
												<option value="">Select...</option>
												<option value="delete">Hapus</option>
											</select>
											<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
										</div>
                                        <table class="table table-striped table-bordered table-hover" id="workunit_list" data-url="<?php echo base_url('backend/workunitlistdata'); ?>">
                                            <thead>
                        						<tr role="row" class="heading bg-blue">
													<th class="width5 text-center"><input name="select_all" id="workunit_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="workunit_all"></label></th>
					    							<th class="width5 text-center">No</th>
                        							<th class="width50 text-center">Nama Satuan Kerja</th>
                        							<th class="width25 text-center">Status</th>
                        							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
                   						        </tr>
                                                <tr role="row" class="filter display-hide table-filter">
                        							<td></td>
													<td></td>
                        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_workunit" /></td>
                                                    <td>
                                                        <select name="search_status" class="form-control form-filter input-sm def">
                        									<option value="">Pilih...</option>
                        									<?php
                        			                        	$status = smit_workunit_status();
                        			                            if( !empty($status) ){
                        			                                foreach($status as $key => $val){
                        			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                        			                                }
                        			                            }
                        			                        ?>
                        								</select>
                                                    </td>
                                                    <td style="text-align: center;">
                        								<button class="btn bg-blue waves-effect filter-submit" id="btn_workunit_list">Search</button>
                                                        <button class="btn bg-red waves-effect filter-cancel" id="btn_workunit_listreset">Reset</button>
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
                                        <?php echo form_open_multipart( 'backend/workunitadd', array( 'id'=>'workunitadd', 'role'=>'form' ) ); ?>
                                            <div class="form-group form-float">
                                                <section id="">
                                                    <h4>Pengaturan Satuan Kerja</h4>
                                                    <div class="form-group">
                                                        <label class="form-label">Nama Satuan Kerja <b style="color: red !important;">(*)</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                            <div class="form-line">
                                                                <input type="text" name="reg_workunit" id="reg_workunit" class="form-control" placeholder="Masukan Nama Satuan Kerja" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                                            <select class="form-control show-tick" name="reg_status" id="reg_status">
                                                                <option value="">-- Pilih Status --</option>
                                                                <?php
                                    	                        	$status = smit_workunit_status();
                                    	                            if( !empty($status) ){
                                    	                                foreach($status as $key => $val){
                            			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                            			                                }
                                    	                            }else{
                                    	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                                    	                            }
                                    	                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_add_workunit">Buat Satuan Kerja</button>
                                                    <button type="button" class="btn btn-danger waves-effect" id="btn_workunit_reset">Bersihkan</button>
                                                </section>
                                            </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </div>

    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_category">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_category" aria-expanded="true" aria-controls="collapse_category">
                    <i class="material-icons">format_align_justify</i> Daftar Kategori Kegiatan
                </a>
            </h4>
        </div>
        <div id="collapse_category" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_category">
            <div class="panel-body">
                <!-- Content -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="body">
                                <?php if($is_admin): ?>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#list_category" data-toggle="tab">
                                            <i class="material-icons">list</i> DAFTAR KATEGORI KEGIATAN
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#addcategory" data-toggle="tab">
                                            <i class="material-icons">add_box</i> TAMBAH
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="list_category">
                                        <div id="alert" class="alert display-hide"></div>
                                        <div class="table-container table-responsive">
										<div class="table-actions-wrapper">
											<span></span>
											<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
												<option value="">Select...</option>
												<option value="delete">Hapus</option>
											</select>
											<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
										</div>
                                        <table class="table table-striped table-bordered table-hover" id="category_list" data-url="<?php echo base_url('backend/categorylistdata'); ?>">
                                            <thead>
                        						<tr role="row" class="heading bg-blue">
													<th class="width5 text-center"><input name="select_all" id="category_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="category_all"></label></th>
					    							<th class="width5 text-center">No</th>
                        							<th class="width75 text-center">Nama Kategori</th>
                        							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
                   						        </tr>
                                                <tr role="row" class="filter display-hide table-filter">
                        							<td></td>
													<td></td>
                        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_category" /></td>
                        							<td style="text-align: center;">
                        								<button class="btn bg-blue waves-effect filter-submit" id="btn_category_list">Search</button>
                                                        <button class="btn bg-red waves-effect filter-cancel" id="btn_category_listreset">Reset</button>
                        							</td>
                        						</tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data Will Be Placed Here -->
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="addcategory">
                                        <?php echo form_open_multipart( 'backend/categoryadd', array( 'id'=>'categoryadd', 'role'=>'form' ) ); ?>
                                            <div id="alert" class="alert display-hide"></div>
                                            <div class="form-group form-float">
                                                <section id="">
                                                    <h4>Pengaturan Kategori</h4>
                                                    <div class="form-group">
                                                        <label class="form-label">Nama Kategori <b style="color: red !important;">(*)</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                            <div class="form-line">
                                                                <input type="text" name="reg_category" id="reg_category" class="form-control" placeholder="Masukan Nama Kategori" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_add_category">Buat Kategori</button>
                                                    <button type="button" class="btn btn-danger waves-effect" id="btn_category_reset">Bersihkan</button>
                                                </section>
                                            </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </div>

    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_category_product">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_category_product" aria-expanded="true" aria-controls="collapse_category_product">
                    <i class="material-icons">format_align_justify</i> Daftar Kategori Produk
                </a>
            </h4>
        </div>
        <div id="collapse_category_product" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_category_product">
            <div class="panel-body">
                <!-- Content -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="body">
                                <?php if($is_admin): ?>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#list_categoryproduct" data-toggle="tab">
                                            <i class="material-icons">list</i> DAFTAR KATEGORI PRODUK
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#addcategoryproduct" data-toggle="tab">
                                            <i class="material-icons">add_box</i> TAMBAH
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="list_categoryproduct">
                                        <div id="alert" class="alert display-hide"></div>
                                        <div class="table-container table-responsive">
										<div class="table-actions-wrapper">
											<span></span>
											<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
												<option value="">Select...</option>
												<option value="delete">Hapus</option>
											</select>
											<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
										</div>
                                        <table class="table table-striped table-bordered table-hover" id="category_productlist" data-url="<?php echo base_url('backend/categoryproductlistdata'); ?>">
                                            <thead>
                        						<tr role="row" class="heading bg-blue">
													<th class="width5 text-center"><input name="select_all" id="categoryproduct_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="categoryproduct_all"></label></th>
					    							<th class="width5 text-center">No</th>
                        							<th class="width75 text-center">Nama Kategori</th>
                        							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
                   						        </tr>
                                                <tr role="row" class="filter display-hide table-filter">
                        							<td></td>
													<td></td>
                        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_category" /></td>
                        							<td style="text-align: center;">
                        								<button class="btn bg-blue waves-effect filter-submit" id="btn_category_productlist">Search</button>
                                                        <button class="btn bg-red waves-effect filter-cancel" id="btn_category_productlistreset">Reset</button>
                        							</td>
                        						</tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data Will Be Placed Here -->
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="addcategoryproduct">
                                        <?php echo form_open_multipart( 'backend/categoryproductadd', array( 'id'=>'categoryproductadd', 'role'=>'form' ) ); ?>
                                            <div id="alert" class="alert display-hide"></div>
                                            <div class="form-group form-float">
                                                <section id="">
                                                    <h4>Pengaturan Kategori Produk</h4>
                                                    <div class="form-group">
                                                        <label class="form-label">Nama Kategori Produk<b style="color: red !important;">(*)</b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                            <div class="form-line">
                                                                <input type="text" name="reg_category" id="reg_category" class="form-control" placeholder="Masukan Nama Kategori Produk" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_add_categoryproduct">Buat Kategori</button>
                                                    <button type="button" class="btn btn-danger waves-effect" id="btn_category_productreset">Bersihkan</button>
                                                </section>
                                            </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Content -->
            </div>
        </div>
    </div>
</div>
<!-- #END# Workunit Setting -->
