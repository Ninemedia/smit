<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(1, 0) ? $this->uri->segment(2, 0) : '');
?>

<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="body pull-left">
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                <i class="icon-home"></i> Beranda
                            </a>
                        </li>
                        <li <?php echo ($active_page == 'frontendberita' ? 'class="active"' : ''); ?>>
                            <i class=""></i> Berita
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
        <div class="row animate-box">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" id="newslist">
                <h4 class="news-title">DAFTAR BERITA</h4>
                
                <?php if( $newsdata || !empty($newsdata) ){ ?>
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
                    <?php echo $this->ajax_pagination->create_links(); ?>
                <?php }else{ ?>
                    <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related" >
                <h4 class="news-title">Link Terkait</h4>
                <h5><a href="<?php echo base_url('tenant/blogtenant'); ?>">BLOG TENANT</a></h5>  
                <h5><a href="<?php echo base_url('seleksi/pengumuman'); ?>">PENGUMUMAN</a></h5>  
            </div>
        </div>
	</div>
</div>