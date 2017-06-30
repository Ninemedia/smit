<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Tambah Produk Pra-Inkubasi</h2></div>
            <div class="body">
                <?php echo form_open_multipart( 'praincubation/productadd', array( 'id'=>'productadd', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <section id="">
                        <h4>Masukan Data Produk Pra-Inkubasi</h4>
                        <div class="form-group">
                            <label class="form-label">Usulan Kegiatan Pra-Inkubasi<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                <select class="form-control show-tick" name="reg_event" id="reg_event">
                                    <?php
                                        $conditions     = ' WHERE %user_id% = '.$user->id.'';
                                        if( !empty($is_admin) ){
                                            $conditions = '';
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
                                    <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize"></textarea>
                                </div>
                            </div>
                        </div>
                        <h4>Produk Pra-Inkubasi</h4>
                        <div class="form-group">
                            <div class="alert bg-teal">
                                <strong>Perhatian!</strong>
                                File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                            </div>
                            <div class="form-group">
                                <label>Thumbnail Produk</label>
                                <input id="reg_thumbnail" name="reg_thumbnail" class="form-control" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="alert bg-teal">
                                <strong>Perhatian!</strong>
                                File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                            </div>
                            <div class="form-group">
                                <label>Detail Gambar Produk</label>
                                <input id="reg_details" name="reg_details" class="form-control" type="file">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect" id="btn_productadd">Tambah Produk</button>
                        <button type="button" class="btn btn-danger waves-effect" id="btn_productadd_reset">Bersihkan</button>
                    </section>
                </div>
                <?php echo form_close(); ?>
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
