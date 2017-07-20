<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('berita'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($news_data->title); ?></h2>
                <p class="bottom0">Tanggal Publikasi : <?php echo date('d F Y H:i:s', strtotime($news_data->datecreated)); ?></p>
            </div>
            <div class="body">
                <?php echo form_open_multipart( 'backend/newsedit', array( 'id'=>'newsedit', 'role'=>'form' ) ); ?>
                    <div id="alert" class="alert display-hide"></div>
                    <div class="form-group form-float">
                        <section id="">
                            <h4>Ubah Berita</h4>
                            <div class="form-group">
                                <label class="form-label">Judul Berita <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                    <div class="form-line">
                                        <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Berita" value="<?php echo strtoupper($news_data->title); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sumber Berita <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                    <div class="form-line">
                                        <input type="text" name="reg_source" id="reg_source" class="form-control" placeholder="Masukan Sumber Berita" value="<?php echo $news_data->source; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Isi Berita <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control ckeditor"><?php echo $news_data->desc; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <h4>Gambar Berita</h4>
                            <div class="details-img">
                                <img class="js-animating-object img-responsive" src="<?php echo $news_image; ?>" alt=""/>
                            </div><br />
                            <div class="form-group">
                                <p align="justify">
                                    <strong>Perhatian!</strong>
                                    File yang dapat di upload adalah dengan Ukuran 1140 x 400px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                                </p>
                                <div class="form-group">
                                    <label>Upload Foto Berita</label>
                                    <input id="newsedit_selection_files" name="newsedit_selection_files" class="form-control" type="file">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn_newsadd">Ubah Berita</button>
                            <button type="button" class="btn btn-danger waves-effect" id="btn_newsadd_reset">Bersihkan</button>
                        </section>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
