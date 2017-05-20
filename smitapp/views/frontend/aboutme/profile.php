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
                    <h4>
                        INKUBATOR TEKNOLOGI PUSAT INOVASI LIPI
                    </h4>
                </div>
                <div class="body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#history" data-toggle="tab">
                                <i class="material-icons">home</i> SEJARAH INKUBATOR
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
                            <b>Mengenai Pusat Inovasi LIPI</b>
                            <p align="justify">
                                <?php echo get_option('be_dashboard_profile'); ?>
                                Pusat Inovasi LIPI, berdiri pada bulan Juni 2001, merupakan salah satu Pusat dari 22 Pusat Penelitian yang ada di LIPI. Disamping Pusat Penelitian juga terdapat Inspektorat, 5 Biro, dan 20 UPT yang lokasinya terdistribusi di berbagai daerah di tanah air. Pusat Inovasi berada didalam Kedeputian Bidang Jasa Ilmiah - LIPI.

Semenjak tanggal 13 Februari 2013, Pusat Inovasi LIPI berpindah kantor ke gedung baru yang berlokasi di komplek Cibinong Science Center-Botanical Garden (CSC-BG) di Cibinong, Jawa Barat. This facility equipt with several office rooms for tenants, workshop, function rooms, meeting rooms, and display room to accelerate LIPI's research utilization into business and applied widely to users. This facility known as Incubator LIPI.
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="vision">
                            <b>Tugas Inkubator Teknologi</b>
                            <p align="justify">
                                <?php echo get_option('be_dashboard_task'); ?>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="structur">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>file/structur_pusinov.jpg" alt="Struktur Pusat Ino" />
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                            <b>Fungsi Inkubator Teknologi</b>
                            <?php echo get_option('be_dashboard_function'); ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>