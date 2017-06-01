<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Berita</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR BERITA
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH BERITA
                        </a>
                    </li>
                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="news_list" data-url="<?php echo base_url('backend/announcementlistdata'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
        							<th class="width15 text-center">No Berita</th>
        							<th class="width35 text-center">Judul Berita</th>
        							<th class="width5 text-center">File</th>
                                    <th class="width15 text-center">Tanggal Daftar</th>
        							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
   						        </tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
        							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_no_announcement" /></td>
        							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
        							<td></td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
        							</td>
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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
                        <?php echo form_open_multipart( 'backend/announcementadd', array( 'id'=>'announcementadd', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <div class="form-group form-float">
                                <section id="">
                                    <h4>Pengaturan Berita</h4>
                                    <div class="form-group">
                                        <label class="form-label">Judul Berita <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Berita" required>
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
                                        <div class="alert bg-teal">
                                            <strong>Perhatian!</strong>
                                            File yang dapat di upload adalah dengan Ukuran Maksimal 2 MB dan format File adalah <strong>doc/docx/pdf/xls/xlsx.</strong>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Berkas</label>
                                            <input id="selection_files" name="selection_files" class="form-control" type="file">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_add_announcement">Tambah Berita</button>
                                    <button type="button" class="btn btn-danger waves-effect" id="btn_addannouncement_reset">Bersihkan</button>
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

<!-- BEGIN INFORMATION SUCCESS SAVE NEWS MODAL -->
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
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_announcement" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE NEWS MODAL -->