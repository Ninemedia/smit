<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Produk Pra-Inkubasi</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR PRODUK
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH PRODUK         
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <!-- Content -->    
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<?php if( !empty($is_admin) ) :?><option value="confirm">Aktif</option><?php endif; ?>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="product_list" data-url="<?php echo base_url('praincubation/productlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
  							            <th class="width5">No</th>
                                        <th class="width15 text-center">Nama Pengguna</th>
            							<th class="width15 text-center">Judul Kegiatan</th>
            							<th class="width15 text-center">Judul Produk</th>
            							<th class="width15 text-center">Gambar Produk</th>
            							<th class="width10 text-center">Status</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_name" /></td>
                                        <td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
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
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_product_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_product_listreset">Reset</button>
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
                    <div role="tabpanel" class="tab-pane fade in" id="add">
                        <?php echo form_open_multipart( 'praincubation/productadd', array( 'id'=>'productadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <?php if( !empty($praincubation_list) ) : ?>
                                <h4>Masukan Data Produk Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <label class="form-label">Usulan Kegiatan Pra-Inkubasi<b style="color: red !important;">(*)</b></label>
                                    <p>Usulan kegiatan yang sudah ada pendamping</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_event" id="reg_event">
                                            <?php
                                                $conditions     = ' WHERE %user_id% = '.$user->id.' AND %companion_id% > 0';
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
                                    <label class="form-label">Kategori Produk Pra-Inkubasi<b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">category</i></span>
                                        <select class="form-control show-tick" name="reg_category" id="reg_category">
                                            <?php
                                                $category_product   = smit_category_product();
                                                if( !empty($category_product) ){
                                                    echo '<option value="">-- Pilih Kategori Produk --</option>';
                                                    foreach($category_product as $row){
                                                        echo '<option value="'.$row->category_id.'">'.strtoupper($row->category_name).'</option>';
                                                    }
                                                }else{
                                                    echo '<option value="">-- Tidak Ada Pilihan --</option>';
                                                }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Judul Produk <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                        <div class="form-line">
                                            <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Produk" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Produk <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize ckeditor"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h4>Produk Pra-Inkubasi</h4>
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
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_productadd">Tambah Produk</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_productadd_reset">Bersihkan</button>

                                <?php else : ?>
                                    <div class="alert bg-blue">
                                        <strong>Perhatian!</strong>
                                        Maaf untuk saat ini anda tidak dapat menambahkan produk dikarenakan tidak ada usulan seleksi yang sudah di dampingi oleh pendamping. Terima Kasih.</strong>
                                    </div>
                                <?php endif; ?>
                            </section>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE PRODUCT MODAL -->
<div class="modal fade" id="save_productadd" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Produk</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Produk. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_productadd" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE PRODUCT MODAL -->
