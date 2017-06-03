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
                        <a href="<?php echo base_url('#'); ?>">
                            <i class=""></i> Tentang Kami
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'profil' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tentangkami/profil'); ?>">
                            <i class=""></i> <strong>Profil</strong>
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
				<h3>Profil</h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header">
                    <h4>INKUBASI TEKNOLOGI PUSAT INOVASI LIPI</h4>
                </div>
                <div class="body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#history" data-toggle="tab">
                                <i class="material-icons">home</i> SEJARAH INKUBASI
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#structur" data-toggle="tab">
                                <i class="material-icons">people</i> STRUKTUR ORGANISASI
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#vision" data-toggle="tab">
                                <i class="material-icons">style</i> TUGAS
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#settings_with_icon_title" data-toggle="tab">
                                <i class="material-icons">view_comfy</i> FUNGSI
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="history">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" />
                            <br /><br />
                            <p align="justify">
                                <?php echo get_option('be_frontend_profil'); ?>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="vision">
                            <p align="justify">
                                <?php echo get_option('be_frontend_task'); ?>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="structur">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>file/structur_pusinov.jpg" alt="Struktur Pusat Ino" />
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                            <?php echo get_option('be_frontend_function'); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>