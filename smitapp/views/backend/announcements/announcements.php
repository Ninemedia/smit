<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengumuman</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR PENGUMUMAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH PENGUMUMAN
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
    							<option value="delete">Hapus</option>
    						</select>
    						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
    					</div>
                        <table class="table table-striped table-bordered table-hover" id="announcement_list" data-url="<?php echo base_url('backend/announcementlistdata'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="guide_list select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
   							        <th class="width5">No</th>
        							<!-- <th class="width15 text-center">No Pengumuman</th> -->
                                    <th class="width15 text-center">Tanggal Daftar</th>
        							<th class="width35 text-center">Judul Pengumuman</th>
        							<th class="width5 text-center">Berkas</th>
        							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
   						        </tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
                                    <td></td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
        							</td>
        							<!-- <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_no_announcement" /></td> -->
        							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
        							<td></td>
                                    
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_announcement">Search</button>
                                        <button class="btn bg-red waves-effect filter-cancel" id="btn_list_announcementreset">Reset</button>
        							</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                        </table>
                        </div>

                        <!-- Announcement Details -->
                        <div class="card top30 bottom0 display-hide" id="announcement_details">
                            <div class="header bg-cyan">
                                <h2>Seleksi Inkubasi Tahap 1</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo form_open_multipart( 'backend/announcementadd', array( 'id'=>'announcementdetails', 'role'=>'form' ) ); ?>
                                            <div id="alert" class="alert display-hide"></div>

                                            <h4>Pengaturan Pengumuman</h4>
                                            <div class="form-group">
                                                <label class="form-label">Judul Pengumuman <b style="color: red !important;">(*)</b></label>
                                                <input name="reg_uniquecode" id="reg_uniquecode" type="hidden" />
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_title" id="reg_title" class="form-control text-uppercase" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nomor Pengumuman </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">dialpad</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_no_announcement" id="reg_no_announcement" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Deskripsi <b style="color: red !important;">(*)</b></label>
                                                <div class="input-group">
                                                    <div class="form-line">
                                                        <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control ckeditor" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">URL </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">language</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_url" id="reg_url" class="form-control" placeholder="Tidak ada file" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <p align="justify">
                                                    <strong>Perhatian!</strong>
                                                    File yang dapat di upload adalah dengan Ukuran Maksimal 2 MB dan format File adalah <strong>doc/docx/pdf/xls/xlsx.</strong>
                                                </p>
                                                <div class="form-group">
                                                    <label>Upload Berkas</label>
                                                    <input id="edit_selection_files" name="edit_selection_files" class="form-control" type="file">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning waves-effect">Perbaharui Pengumuman</button>
                                            <button type="button" class="btn btn-danger waves-effect" id="btn_editannouncement_reset">Bersihkan</button>

                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <?php echo form_open_multipart( 'backend/announcementadd', array( 'id'=>'announcementadd', 'role'=>'form' ) ); ?>
                            <div class="form-group form-float">
                                <section id="">
                                    <h4>Pengaturan Pengumuman</h4>
                                    <div class="form-group">
                                        <label class="form-label">Judul Pengumuman <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Pengumuman" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Deskripsi <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control ckeditor" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p align="justify">
                                            <strong>Perhatian!</strong>
                                            File yang dapat di upload adalah dengan Ukuran Maksimal 2 MB dan format File adalah <strong>doc/docx/pdf/xls/xlsx.</strong>
                                        </p>
                                        <div class="form-group">
                                            <label>Upload Berkas</label>
                                            <input id="selection_files" name="selection_files" class="form-control" type="file">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="filled-in" id="reg_agree" name="reg_agree" type="checkbox">
                                            <label class="form-label reg_agree" for="reg_agree">Saya setuju dengan Syarat dan Ketentuan.</label>
                                        </div>
                                    </div>
                                    -->
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_add_announcement">Buat Pengumuman</button>
                                    <button type="button" class="btn btn-danger waves-effect" id="btn_addannouncement_reset">Bersihkan</button>
                                </section>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

                <?php else: ?>
                <div class="table-container table-responsive bottom50">
                    <table class="table table-striped table-bordered table-hover" id="announcementuser_list" data-url="<?php echo base_url('announcementslist'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
    							<!-- <th class="width20 text-center">No Pengumuman</th> -->
                                <th class="width15 text-center">Tanggal Publikasi</th>
    							<th class="width65 text-center">Judul Pengumuman</th>
                                <th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
					        </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
    							<!-- <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_no_announcement" /></td> -->
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
    							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
    							<td style="text-align: center;">
    								<button class="btn bg-blue waves-effect filter-submit bottom5-min bottom5" id="btn_announcement_list">Search</button>
                                    <button class="btn bg-red waves-effect filter-cancel" id="btn_announcement_listreset">Reset</button>
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

<!-- BEGIN INFORMATION SUCCESS SAVE ANNOUNCEMENT MODAL -->
<div class="modal fade" id="save_announcement" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Pengumuman</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Pengumuman. Pastinkan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_announcement" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE ANNOUNCEMENT MODAL -->
