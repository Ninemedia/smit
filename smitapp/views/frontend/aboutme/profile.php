<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
?>

<!--
<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body pull-right">
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
                    <li <?php echo ($active_page == 'profil' ? 'class="active"' : ''); ?>>
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
                        PUSAT INOVASI LIPI
                    </h4>
                </div>
                <div class="body">

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#history" data-toggle="tab">
                                <i class="material-icons">home</i> SEJARAH PUSINOV
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#vision" data-toggle="tab">
                                <i class="material-icons">style</i> VISI DAN MISI
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#structur" data-toggle="tab">
                                <i class="material-icons">people</i> STRUKTUR ORGANISASI
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#settings_with_icon_title" data-toggle="tab">
                                <i class="material-icons">view_comfy</i> INKUBASI DAN ALIH TEKNOLOGI
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="history">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" />
                            <br /><br />
                            <b>Mengenai Pusat Inovasi LIPI</b>
                            <p align="justify">
                                Pusat Inovasi LIPI, berdiri pada bulan Juni 2001, merupakan salah satu Pusat dari 22 Pusat Penelitian yang ada di LIPI. Disamping Pusat Penelitian juga terdapat Inspektorat, 5 Biro, dan 20 UPT yang lokasinya terdistribusi di berbagai daerah di tanah air. Pusat Inovasi berada didalam Kedeputian Bidang Jasa Ilmiah - LIPI.

Semenjak tanggal 13 Februari 2013, Pusat Inovasi LIPI berpindah kantor ke gedung baru yang berlokasi di komplek Cibinong Science Center-Botanical Garden (CSC-BG) di Cibinong, Jawa Barat. This facility equipt with several office rooms for tenants, workshop, function rooms, meeting rooms, and display room to accelerate LIPI's research utilization into business and applied widely to users. This facility known as Incubator LIPI.
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="vision">
                            <b>Visi dan Misi</b>
                            <p align="justify">
                                Pusat Inovasi mempunyai dua tugas pokok yaitu : <br />
                                <ul>
                                    <ol>
                                    Melakukan kajian, membangun dan mendukung kegiatan kerjasama yang dilakukan oleh berbagai pusat penelitian dan UPT LIPI dengan pihak di luar LIPI, terutama dengan industri, dalam upaya pemanfaatan hasil penelitian dan pengembangan LIPI.
                                    </ol>
                                    <ol>
                                    Menelaah kemungkinan perlindungan kekayaan intelektual hasil litbang LIPI serta melaksanakan proses untuk mendapatkan perlindungan tersebut.
                                    </o>
                                </ul>
                            </p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="structur">
                            <b>Struktur Organisasi</b>
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>file/structur_pusinov.jpg" alt="" />
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                            <b>Inkubasi dan Alih Teknologi</b>
                            <p>
                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                sadipscing mel.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
-->