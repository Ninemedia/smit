<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
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
                    <li <?php echo ($active_page == 'gallery' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('gallery'); ?>">
                            <i class=""></i> <strong>Galeri</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container fluid">
		<div class="row">
			<div class="col-md-12 text-center gtco-heading">
				<h3>Galeri Kegiatan</h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header">
                    <h4>
                        KEGIATAN INKUBASI DAN TENANT
                    </h4>
                </div>
                <div class="body">
                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/1.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-1.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/2.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-2.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/3.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-3.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/4.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-4.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/5.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-5.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/6.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-6.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/7.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-7.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/8.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-8.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/9.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-9.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/10.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-10.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/11.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-11.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/12.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-12.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/13.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-13.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/14.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-14.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/15.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-15.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/16.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-16.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/17.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-17.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/18.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-18.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/19.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-19.jpg" />
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?php echo FE_IMG_PATH; ?>image-gallery/20.jpg" data-sub-html="Demo Description">
                                <img class="img-responsive thumbnail" src="<?php echo FE_IMG_PATH; ?>image-gallery/thumb/thumb-20.jpg" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>