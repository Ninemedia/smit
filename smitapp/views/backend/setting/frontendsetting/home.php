<!-- Home Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_slider">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_slider" aria-expanded="true" aria-controls="collapse_slider">
                    <i class="material-icons">format_align_justify</i> Slider Beranda
                </a>
            </h4>
        </div>
        <div id="collapse_slider" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_slider">
            <div class="panel-body">
                <!-- Content -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#list" data-toggle="tab">
                                            <i class="material-icons">list</i> DAFTAR SLIDER
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#add" data-toggle="tab">
                                            <i class="material-icons">add_box</i> TAMBAH SLIDER
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                                        <div class="table-container table-responsive">
                                        <div class="table-actions-wrapper">
                    						<span></span>
                    						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
                    							<option value="">Select...</option>
                    							<option value="confirm">Aktif</option>
                    							<option value="banned">Banned</option>
                    							<option value="delete">Hapus</option>
                    						</select>
                    						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
                    					</div>
                                        <table class="table table-striped table-bordered table-hover" id="slider_list" data-url="<?php echo base_url('backend/sliderlistdata'); ?>">
                                            <thead>
                        						<tr role="row" class="heading bg-blue">
                                                    <th class="width5 text-center"><input name="select_all" id="slider_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="slider_all"></label></th>
                        							<th class="width5">No</th>
                        							<th class="width25 text-center">Judul Slider</th>
                        							<th class="width30 text-center">Gambar Slider</th>
                        							<th class="width10 text-center">Status</th>
                                                    <th class="width15 text-center">Tanggal Daftar</th>
                        							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
                   						        </tr>
                                                <tr role="row" class="filter display-hide table-filter">
                        							<td></td>
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
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="add">
                                        <?php echo form_open_multipart( 'backend/slideradd', array( 'id'=>'slideradd', 'role'=>'form' ) ); ?>
                                            <div id="alert" class="alert display-hide"></div>
                                            <div class="form-group form-float">
                                                <section id="">
                                                    <h4>Pengaturan Slider</h4>
                                                    <div class="form-group">
                                                        <label class="form-label">Judul Slider <b style="color: red !important;"></b></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                            <div class="form-line">
                                                                <input type="text" name="slider_title" id="slider_title" class="form-control" placeholder="Masukan Judul Slider">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Deskripsi <b style="color: red !important;"></b></label>
                                                        <div class="input-group">
                                                            <div class="form-line">
                                                                <textarea name="slider_desc" id="slider_desc" cols="30" rows="3" class="form-control ckeditor"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <p align="justify">
                                                            <strong>Perhatian!</strong>
                                                            Gambar yang dapat di upload adalah dengan Ukuran Maksimal 1024 KB dan format Gambar adalah <strong>jpg/jpeg/png.</strong>
                                                        </p>
                                                        <div class="form-group">
                                                            <label>Upload Slider</label>
                                                            <input id="slider_image" name="slider_image" class="form-control" type="file">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_slideradd">Tambah Slider</button>
                                                    <button type="button" class="btn btn-danger waves-effect" id="btn_slideradd_reset">Bersihkan</button>
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
            </div>
        </div>
    </div>
</div>
<!-- #END# Home Setting -->

<!-- BEGIN INFORMATION SUCCESS SAVE SLIDER MODAL -->
<div class="modal fade" id="save_slider" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Slider</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Slider. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_slider" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SLIDER MODAL -->
