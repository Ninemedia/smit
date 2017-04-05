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
                    <li>
                        <a href="<?php echo base_url('#'); ?>">
                            <i class=""></i> Tentang Kami
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'layanan' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tentangkami/layanan'); ?>">
                            <i class=""></i> <strong>Layanan</strong>
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
				<h3>Layanan</h3>
			</div>
			<div class="col-md-12">
                <div class="panel-body">
                    <h4>Incubator Bisnis</h4>
                    <p align="justify">
                        Layanan Inkubator Bisnis merupakan layanan yang dikembangkan seiring dengan diresmikannya Gedung Inovasi LIPI yang memiliki fasilitas ruang tenant dan inkubator di dalamnya. Sebelumnya, kegiatan Inkubasi dari Penelitian Unggulan di LIPI difasiltasi di masing-masing satuan kerja yang tersebar di seluruh Indonesia. Dengan Proses fasilitasi kegiatan tersebut dikelompokkan ke dalam kategori : <br />
                        1. Proses pengembangan produk skala terbatas / prototipe <br />
                        2. Proses pengembangan produk skala pra-inkubasi <br />
                        3. Proses pengembangan produk skala inkubasi
                    </p>
                </div>
                <div class="panel-body">
                    <h4>Kajian Unggul</h4>
                    <p align="justify">
                        Di Pusat Inovasi LIPI kami memiliki kompetensi untuk menerapkan penelitian unggul di LIPI untuk diterapkan di berbagai daerah di Indonesia. Dengan kemampuan analisis teknologi, analisis pasar dan analisis manfaat mampu dikolaborasikan untuk mengembangkan Sistem Inovasi Daerah (SIDA) yang berkelanjutan.
                    </p>
                </div>
			    
            </div>
		</div>
	</div>
</div>