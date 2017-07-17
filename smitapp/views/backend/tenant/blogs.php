<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Blog Tenant</h2></div>
            <div class="body">
            <?php if($is_admin): ?>    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR BLOG
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH BLOG
                        </a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="blogtenant_list" data-url="<?php echo base_url('tenant/blogtenantlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width15 text-center">Nama Tenant</th>
            							<th class="width15 text-center">Judul Blog</th>
            							<th class="width15 text-center">Judul Product</th>
            							<th class="width20 text-center">Gambar Produk</th>
            							<th class="width10 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
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
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_blogtenant_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_blogtenant_listreset">Reset</button>
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
                        <?php echo form_open_multipart( 'tenant/addblogtenant', array( 'id'=>'addblogtenant', 'role'=>'form' ) ); ?>
                            <div class="alert alert-danger error-validate <?php echo empty($message) ? 'display-hide' : ''; ?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="material-icons">close</i></button>
                                <?php if( !empty($message) ){ ?>
                                    <?php echo $message; ?>
                                <?php }else{ ?>
                                    Terjadi kesalahan, silahkan periksa kembali form dibawah!
                                <?php } ?>
                    		</div>
                            
                            <div class="alert alert-success error-validate <?php echo empty($flashdata) ? 'display-hide' : ''; ?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="material-icons">close</i></button>
                                <?php if( !empty($flashdata) ){ ?>
                                    <?php echo $flashdata; ?>
                                <?php } ?>
                    		</div>
                            
                            <div class="form-group">
                                <label class="form-label">Produk Tenant Terkait <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                    <select class="form-control show-tick" name="reg_product" id="reg_product">
                                        <?php
                                            $conditions     = ' WHERE %user_id% = '.$user->id.' AND %companion_id% > 0';
                                            if( !empty($is_admin) ){
                                                $conditions = ' WHERE %companion_id% > 0';
                                            }
            	                        	$tenant_list    = $this->Model_Tenant->get_all_product(0, 0, $conditions);
            	                            if( !empty($tenant_list) ){
            	                                echo '<option value="">-- Pilih Produk Tenant --</option>';
            	                                foreach($tenant_list as $row){
                                                    echo '<option value="'.$row->id.'">'.strtoupper($row->title).'</option>';
            	                                }
            	                            }else{
            	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
            	                            }
            	                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Judul Blog Tenant <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                    <div class="form-line">
                                        <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Blog Tenant" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Deskripsi Blog Tenant <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize ckeditor"></textarea>
                                    </div>
                                </div>
                            </div>
                            <h4>Gambar Blog Tenant</h4>
                            <div class="form-group">
                                <p align="justify">
                                    <strong>Perhatian!</strong>
                                    File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                                </p>
                                <div class="form-group">
                                    <label>Thumbnail Produk</label>
                                    <input id="reg_thumbnail" name="reg_thumbnail" class="form-control" type="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <p align="justify">
                                    <strong>Perhatian!</strong>
                                    File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                                </p>
                                <div class="form-group">
                                    <label>Detail Gambar Produk</label>
                                    <input id="reg_details" name="reg_details" class="form-control" type="file">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn_addtenantblog">Tambah Blog</button>
                            <button type="button" class="btn btn-danger waves-effect" id="btn_addtenantblog_reset">Bersihkan</button>
                        <?php echo form_close(); ?>    
                    </div>
                </div>
            <?php else: ?>
            
            
            <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE PRODUCT MODAL -->
<div class="modal fade" id="save_addtenantblog" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Blog Tenant</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Blog Tenant. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_addtenantblog" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE PRODUCT MODAL -->