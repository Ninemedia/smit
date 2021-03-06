<h4 class="news-title">DAFTAR BERITA</h4>
<?php if( !empty($newsdata) ){ ?> 
    <div class="media-wrapper">
        <div class="media-loader"></div>
        <?php foreach($newsdata as $key => $news){ ?>
            <?php $desc = word_limiter($news->desc,30); ?>
            <div class="media">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="media-left">
                            <a href="javascript:void(0);">
                                <img class="js-animating-object img-responsive media-object visible-lg visible-md visible-sm" 
                                src="<?php echo BE_UPLOAD_PATH . 'news/'.$news->uploader.'/'.$news->thumbnail.'.'.$news->extension; ?>" />
                                <img class="js-animating-object img-responsive media-object visible-xs" 
                                src="<?php echo BE_UPLOAD_PATH . 'news/'.$news->uploader.'/'.$news->filename.'.'.$news->extension; ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <a href="<?php echo base_url('layanan/frontendberita/detail/'.$news->uniquecode.''); ?>" class="media-heading-link"><?php echo $news->title; ?></a>
                        <div class="media-date"><i class="icon-calendar"></i> <?php echo date('d M Y', strtotime($news->datecreated)); ?></div>
                        <?php echo $desc; ?><br />
                        <a href="<?php echo base_url('layanan/frontendberita/detail/'.$news->uniquecode.''); ?>"><strong>Selengkapnya</strong></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php }else{ ?>
    <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
<?php } ?>
<?php echo $this->ajax_pagination->create_links(); ?>