<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
?>

<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body pull-left">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="icon-home"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('tenant/produktenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'produk' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/produktenant'); ?>">
                            <i class=""></i> <strong>Produk Inkubasi / Tenant</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 text-center gtco-heading">
				<h3>Produk Inkubasi / Tenant</h3>
			</div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="news-title">Inkubasi / Tenant</h4>
                <?php if( $newsdata || !empty($newsdata) ){ ?>
                <div class="row">
                <?php foreach($newsdata as $key => $news){ ?>
                    <?php $desc = word_limiter($news->desc,30); ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                    <a href="<?php echo base_url('frontendberita/detail/'.$news->uniquecode.''); ?>" class="media-heading-link"><?php echo $news->title; ?></a>
                                    <div class="media-date"><i class="icon-calendar"></i> <?php echo date('d M Y', strtotime($news->datecreated)); ?></div>
                                    <?php echo $desc; ?><br />
                                    <a href="<?php echo base_url('frontendberita/detail/'.$news->uniquecode.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php if($countnews > LIMIT_DEFAULT){ ?>
                    <a href="<?php echo base_url('frontendberita'); ?>" class="btn btn-primary top25 pull-right">Berita Lainnya</a>
                <?php } ?>
            <?php }else{ ?>
                <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
            <?php } ?>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related">
                <h4 class="news-title">Produk Tenant Lainnya</h4>
            </div>
 
		</div>
	</div>
</div>