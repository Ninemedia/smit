<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
?>

<!DOCTYPE HTML>
<html>
	<!-- Load Template Header -->
    <?php $this->load->view(VIEW_FRONT . 'template_header'); ?>
	<body>
		
    	<div class="gtco-loader"></div>
    	
    	<div id="page">
        	<nav class="gtco-nav" role="navigation">
                <div class="gtco-navbar">
                    <div class="gtco-container">
            			<div class="row">
            				<div class="col-sm-12 col-xs-12">
            					<div id="gtco-logo"><a href=<?php echo base_url(); ?>""><img src="<?php echo FE_IMG_PATH; ?>logo/logo-lipi.png" alt="" /> SISTEM INFORMASI MONITORING INKUBASI TEKNOLOGI</a></div>
            				</div>
            			</div>
                        <div class="row" id="menu-header">
                            <div class="col-sm-12 col-xs-12 text-center menu-2">
            					<ul>
            						<li><a <?php echo ($active_page == '' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url(); ?>">Beranda</a></li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'profil' || $active_page2 == 'event' || $active_page2 == 'layanan' || $active_page2 == 'artikel' ? 'class="currentactive"' : ''); ?> href="#">Tentang Kami</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'profil' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tentangkami/profil'); ?>">Profil</a></li>
            								<li><a <?php echo ($active_page2 == 'layanan' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tentangkami/layanan'); ?>">Layanan</a></li>
            								<li><a <?php echo ($active_page2 == 'artikel' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tentangkami/artikel'); ?>">Artikel</a></li>
            								<!-- <li><a <?php echo ($active_page2 == 'event' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tentangkami/event'); ?>">Kegiatan</a></li> -->
            							</ul>
            						</li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'prainkubasi' || $active_page2 == 'inkubasi' ? 'class="currentactive"' : ''); ?> href="#">Inkubasi</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'prainkubasi' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('seleksi/prainkubasi'); ?>">Pendaftaran Pra Seleksi</a></li>
            								<li><a <?php echo ($active_page2 == 'inkubasi' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('seleksi/inkubasi'); ?>">Pendaftaran Inkubasi</a></li>
            							</ul>
            						</li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'daftar' || $active_page2 == 'produk' || $active_page2 == 'fasilitas' || $active_page2 == 'blog' || $active_page2 == 'kategori' ? 'class="currentactive"' : ''); ?> href="#">Tenant</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'daftar' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/daftar'); ?>">Daftar Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'produk' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/produk'); ?>">Produk Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'fasilitas' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/fasilitas'); ?>">Fasilitas Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'blog' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/blog'); ?>">Blog Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'kategori' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/kategori'); ?>">Kategori Blog Tenant</a></li>
            							</ul>
            						</li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'panduan' || $active_page2 == 'pengumuman' ? 'class="currentactive"' : ''); ?> href="#">Informasi</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'panduan' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('informasi/panduan'); ?>">Panduan</a></li>
            								<li><a <?php echo ($active_page2 == 'pengumuman' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('informasi/pengumuman'); ?>">Pengumuman</a></li>
            							</ul>
            						</li>
            						<li><a <?php echo ($active_page == 'statistik' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('statistik'); ?>">Statistik</a></li>
            						<li><a <?php echo ($active_page == 'kontak' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('kontak'); ?>">Kontak</a></li>
            						<li><a <?php echo ($active_page == 'login' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('login'); ?>">Masuk</a></li>
            					</ul>
            				</div>
                        </div>
            			
            		</div>    
                </div>
        		
        	</nav>
            <!-- End Header -->
    
            <!-- Content -->
            <?php $this->load->view(VIEW_FRONT . $main_content); ?>
            <!-- End Content -->
            
            <!-- Load Template Header -->
            <?php $this->load->view(VIEW_FRONT . 'template_footer'); ?>
    	</div>
    
    	<div class="gototop js-top">
    		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    	</div>
    
    <!-- Load Template Header -->
    <?php $this->load->view(VIEW_FRONT . 'template_footer_javascript'); ?>    
    
	

	</body>
</html>

