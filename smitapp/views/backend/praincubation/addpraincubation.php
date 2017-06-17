<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Tambah Pra-Inkubasi</h2></div>
            <div class="body">
                <?php echo form_open_multipart( 'backend/newsadd', array( 'id'=>'newsadd', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <section id="">
                        <h4>Masukan Data Pra-Inkubasi</h4>
                        <div class="form-group">
                            <label class="form-label">Tahun <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Berita" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Peneliti Utama <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <input type="text" name="reg_source" id="reg_source" class="form-control" placeholder="Masukan Sumber Berita" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori Kegiatan <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <input type="text" name="reg_source" id="reg_source" class="form-control" placeholder="Masukan Sumber Berita" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Judul Kegiatan <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <input type="text" name="reg_source" id="reg_source" class="form-control" placeholder="Masukan Sumber Berita" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Kegiatan <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <div class="form-line">
                                    <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize" disabled="" ></textarea>
                                </div>
                            </div>
                        </div> 
                        <h4>Berkas Kegiatan Pra-Inkubasi</h4>
                        <div class="form-group">
                            <div class="alert bg-teal">
                                <strong>Perhatian!</strong>
                                File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                            </div>
                            <div class="form-group">
                                <label>Upload Proposal Kegiatan</label>
                                <input id="news_selection_files" name="news_selection_files" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>Upload Rencana Anggaran Biaya</label>
                                <input id="news_selection_files" name="news_selection_files" class="form-control" type="file">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect" id="btn_newsadd">Tambah Berita</button>
                        <button type="button" class="btn btn-danger waves-effect" id="btn_newsadd_reset">Bersihkan</button>
                    </section>
                </div>
            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE NEWS MODAL -->
<div class="modal fade" id="save_news" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Berita</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Berita. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_news" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE NEWS MODAL -->