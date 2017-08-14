<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('pengaturan/depan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2>Ubah Data Slider</h2>   
            </div>
            <div class="body">
                <?php echo form_open_multipart( 'backend/sliderdataedit', array( 'id'=>'sliderdataedit', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <section id="">
                        <h4>Masukan Data Slider yaran yang Akan Dirubah</h4>
                        <input type="hidden" name="slider_uniquecode" id="slider_uniquecode" class="form-control" value="<?php echo $sliderdata->uniquecode; ?>">
                        
                        <div class="form-group">
                            <label class="form-label">Judul Slider <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <input type="text" name="slider_title" id="slider_title" class="form-control" value="<?php echo $sliderdata->title; ?>" required>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="form-label">Deskripsi Slider <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <div class="form-line">
                                    <textarea name="slider_desc" id="slider_desc" cols="30" rows="3" class="form-control no-resize ckeditor"><?php echo $sliderdata->desc; ?></textarea>
                                </div>
                            </div>
                        </div>   
                        <h4>Gambar Slider</h4>
                        <div class="details-img">
                            <img class="js-animating-object img-responsive" src="<?php echo $slider_image; ?>" alt=""/>
                        </div><br />
                        <div class="form-group">
                            <p align="justify">
                                <strong>Perhatian!</strong>
                                File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                            </p>
                            <div class="form-group">
                                <label>Gambar Slider</label>
                                <input id="slider_image" name="slider_image" class="form-control" type="file">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning waves-effect" id="btn_sliderdataedit">Ubah Slider</button>
                        <!-- <button type="button" class="btn btn-danger waves-effect" id="btn_sliderdataedit_reset">Bersihkan</button> -->
                    </section>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS EDIT SLIDER MODAL -->
<div class="modal fade" id="save_sliderdataedit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Slider</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pengubahan Slider. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_sliderdataedit" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT SLIDER MODAL -->
