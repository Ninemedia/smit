<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('tenants/produk'); ?>" class="btn btn-sm btn-default waves-effect back pull-right">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2>Ubah Produk</h2>   
            </div>
            <div class="body">
                <?php echo form_open_multipart( 'tenant/producttenantedit', array( 'id'=>'producttenantedit', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <section id="">
                        <h4>Masukan Data Produk Tenant yang Akan Dirubah</h4>
                        <input type="hidden" name="reg_uniquecode" id="reg_uniquecode" class="form-control" value="<?php echo $productdata->uniquecode; ?>">
                            
                        <div class="form-group">
                            <label class="form-label">Nama Tenant<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                <input type="text" name="reg_event" id="reg_event" class="form-control" value="<?php echo strtoupper($productdata->name); ?>"  required disabled="TRUE">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori Produk Pra-Inkubasi<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">category</i></span>
                                <input type="text" name="reg_category" id="reg_category" class="form-control" value="<?php echo strtoupper($productdata->category_product); ?>"  required disabled="TRUE">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Judul Produk <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <input type="text" name="reg_title" id="reg_title" class="form-control" value="<?php echo $productdata->title; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi Produk <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <div class="form-line">
                                    <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize ckeditor"><?php echo $productdata->description; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <h4>Produk Pra-Inkubasi</h4>
                        <div class="details-img">
                            <img class="js-animating-object img-responsive" src="<?php echo $product_image; ?>" alt=""/>
                        </div><br />
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
                        <button type="submit" class="btn btn-primary waves-effect" id="btn_producttenantedit">Ubah Produk</button>
                        <button type="button" class="btn btn-danger waves-effect" id="btn_producttenantedit_reset">Bersihkan</button>
                    </section>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS EDIT PRODUCT MODAL -->
<div class="modal fade" id="save_producttenantedit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Produk</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pengubahan Produk. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_producttenantedit" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT PRODUCT MODAL -->
