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
            <div id="gtco-navbarheader">
                <div class="gtco-container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        				    <div id="gtco-socialnav">
                                <ul class="gtco-social-icons">
            						<li><a href="https://www.twitter.com"><i class="icon-twitter"></i></a></li>
            						<li><a href="https://www.facebook.com"><i class="icon-facebook"></i></a></li>
            						<li><a href="#"><i class="icon-instagram"></i></a></li>
                                    <li><a href="#"><i class="icon-linkedin"></i></a></li>
            						<li><a href="http://pusinov.lipi.go.id"><i class="icon-dribbble"></i></a></li>
            					</ul>
                            </div>	
        				</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <ul class="gtco-login-button">
                                <li><a href="<?php echo base_url('login'); ?>" class="login">Masuk</a></li>
       					        <li><a href="<?php echo base_url('signup'); ?>" class="register">Daftar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        	<nav class="gtco-nav" role="navigation">
                <div class="gtco-navbar">
                    <div class="gtco-container">
            			<div class="row">
            				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            					<div id="gtco-logo">
                                    <a href="<?php echo base_url(); ?>"><img src="<?php echo FE_IMG_PATH; ?>logo/logo.png" alt="" /></a>
                                </div>
            				</div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="input-group gtco-search">
                                    <div class="form-line">
                                        <input type="text" name="search_key" id="search_key" class="form-control" placeholder="KATA KUNCI">
                                    </div>
                                    <span class="input-group-addon">
                                        <button class="btn waves-effect" type="button">
                                            <i class="material-icons">search</i>
                                        </button>
                                    </span>
                                </div>
                            </div>
            			</div>
                        <div class="row" id="menu-header">
                            <div class="col-sm-12 col-xs-12 text-center menu-2">
            					<ul>
            						<li><a <?php echo ($active_page == '' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url(); ?>">Beranda</a></li>
                                    <li><a <?php echo ($active_page == 'profil' ? 'class="currentactive"' : 'profil'); ?> href="<?php echo base_url('profil'); ?>">Profil</a></li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'pengumuman' || $active_page2 == 'prainkubasi' || $active_page2 == 'inkubasi' ? 'class="currentactive"' : ''); ?> href="#">Seleksi</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'pengumuman' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('seleksi/pengumuman'); ?>">Pengumuman</a></li>
            								<li><a <?php echo ($active_page2 == 'prainkubasi' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('seleksi/prainkubasi'); ?>">Pendaftaran Pra Inkubasi</a></li>
            								<li><a <?php echo ($active_page2 == 'inkubasi' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('seleksi/inkubasi'); ?>">Pendaftaran Inkubasi</a></li>
            							</ul>
            						</li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'daftarprainkubasi' || $active_page2 == 'produkprainkubasi' ? 'class="currentactive"' : ''); ?> href="#">Pra-Inkubasi</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'daftarprainkubasi' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('prainkubasi/daftarprainkubasi'); ?>">Daftar Pra-Inkubasi</a></li>
            								<li><a <?php echo ($active_page2 == 'produkprainkubasi' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('prainkubasi/produkprainkubasi'); ?>">Produk Pra-Inkubasi</a></li>
            							</ul>
            						</li>
                                    <li class="has-dropdown">
            							<a <?php echo ($active_page2 == 'daftartenant' || $active_page2 == 'produktenant' || $active_page2 == 'fasilitastenant' || $active_page2 == 'blogtenant' || $active_page2 == 'kategoritenant' ? 'class="currentactive"' : ''); ?> href="#">Inkubasi/Tenant</a>
            							<ul class="dropdown">
            								<li><a <?php echo ($active_page2 == 'daftartenant' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/daftartenant'); ?>">Daftar Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'produktenant' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/produktenant'); ?>">Produk Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'blogtenant' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/blogtenant'); ?>">Blog Tenant</a></li>
            								<li><a <?php echo ($active_page2 == 'fasilitastenant' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('tenant/fasilitastenant'); ?>">Fasilitas Tenant</a></li>
                                        </ul>
            						</li>
                                    <li><a <?php echo ($active_page == 'infografis' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('infografis'); ?>">Info Grafis</a></li>
            						<li><a <?php echo ($active_page == 'berkasdigital' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('berkasdigital'); ?>">Berkas Digital</a></li>
            						<li><a <?php echo ($active_page == 'kontak' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('kontak'); ?>">Kontak</a></li>
                                    <!--
            						<li><a <?php echo ($active_page == 'login' ? 'class="currentactive"' : ''); ?> href="<?php echo base_url('login'); ?>">Masuk</a></li>
            					    -->
                                </ul>
            				</div>
                        </div>
            			
            		</div>    
                </div>
        	</nav>
            <div class="separator"></div>
            <div id="mobile-nav"></div>
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

