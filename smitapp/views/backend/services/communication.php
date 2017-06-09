<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Komunikasi dan Bantuan</h2></div>
            <div class="body">
                <?php if( !empty($is_jury) ) : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list_in" data-toggle="tab">
                            <i class="material-icons">call_received</i> Komunikasi Masuk
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#list_out" data-toggle="tab">
                            <i class="material-icons">call_made</i> Bantuan Keluar
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> Buat Komunikasi
                        </a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list_in">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table_list_in" data-url="">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width20 text-center">Judul Berkas Digital</th>
            							<th class="width35 text-center">Deskripsi</th>
                                        <th class="width5 text-center">File</th>
                                        <th class="width10 text-center">Tanggal</th>
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_desc" /></td>
            							<td></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_in_table">Search</button>
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
                    <div role="tabpanel" class="tab-pane fade in" id="list_out">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="table_list_out" data-url="">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width20 text-center">Judul Berkas Digital</th>
            							<th class="width35 text-center">Deskripsi</th>
                                        <th class="width5 text-center">File</th>
                                        <th class="width10 text-center">Tanggal</th>
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_desc" /></td>
            							<td></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_out_table">Search</button>
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
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <?php echo form_open_multipart( '', array( 'id'=>'cmm_form', 'role'=>'form' ) ); ?>
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
                            <div class="alert alert-info">
                                <strong>Perhatian!</strong>
                                Pesan ini otomatis ditujukan untuk Administrator
                            </div>
        
                            <div class="form-group">
                                <input type="hidden" name="cmm_id_user" id="cmm_id_user" value="<?php echo $user->id; ?>" />
                                <label class="control-label">Judul Komunikasi <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php 
                                        echo form_input(
                                            'cmm_title',
                                            ( !empty($post) ? smit_isset($post['cmm_title'],'') : '' ),
                                            array(
                                                'class'=>'form-control text-uppercase',
                                                'placeholder'=>'Masukan Judul Komunikasi dan Bantuan...',
                                                'required'=>'required'
                                            )
                                        ); 
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Deskripsi Komunikasi <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php 
                                        echo form_textarea(
                                            array(
                                                'name'=>'cmm_description',
                                                'class'=>'form-control no-resize',
                                                'rows'=>4,
                                                'placeholder'=>'Silahkan isi deskripsi dari komikasi dan bantuan dengan maksimal 400 huruf...'
                                            ),
                                            ( !empty($post) ? smit_isset($post['cmm_description'],'') : '' )
                                        ); 
                                    ?>
                                </div>
                            </div>
                            <button class="btn btn-sm bg-blue waves-effect" type="submit">Unggah Komunikasi</button>
                            <button class="btn btn-sm bg-red waves-effect" >Bersihkan</button>
                        <?php echo form_close(); ?>    
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
<div class="modal fade" id="save_cmm" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Komunikasi dan Bantuan</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Komunikasi dan Bantuan. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_cmm" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->