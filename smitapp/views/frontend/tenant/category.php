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
                        <a href="<?php echo base_url('tenant/ketegoritenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'ketegori' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/ketegoritenant'); ?>">
                            <i class=""></i> <strong>Kategori Blog Tenant</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
				<h3>Kategori Blog Tenant</h3>
				<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
			</div>
		</div>
		<div class="row row-bottom-padded-md">
			<div class="col-md-6 animate-box">
                <div id="fh5co-car">
                    <div class="car">
    					<div class="one-4">
    						<h3><a href="<?php echo base_url('categoryblog'); ?>" style="color: #FFF !important;">Inkubasi</a></h3>
    						<p style="color: #FFF !important;" align="justify">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
    					</div>
    					<div class="one-1" style="background-image: url(<?php echo FE_IMG_PATH; ?>img_1.jpg);"></div>
    				</div>
                </div>
			</div>
            <div class="col-md-6 animate-box">
                <div id="fh5co-car">
                    <div class="car">
    					<div class="one-4">
    						<h3><a href="<?php echo base_url('categoryblog'); ?>" style="color: #FFF !important;">STP</a></h3>
    						<p style="color: #FFF !important;" align="justify">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
    					</div>
    					<div class="one-1" style="background-image: url(<?php echo FE_IMG_PATH; ?>img_3.jpg);"></div>
    				</div>
                </div>
			</div>
            <div class="col-md-6 animate-box">
                <div id="fh5co-car">
                    <div class="car">
    					<div class="one-4">
    						<h3><a href="<?php echo base_url('categoryblog'); ?>" style="color: #FFF !important;">Tenant</a></h3>
    						<p style="color: #FFF !important;" align="justify">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
    					</div>
    					<div class="one-1" style="background-image: url(<?php echo FE_IMG_PATH; ?>img_4.jpg);"></div>
    				</div>
                </div>
			</div>
            <div class="col-md-6 animate-box">
                <div id="fh5co-car">
                    <div class="car">
    					<div class="one-4">
    						<h3><a href="<?php echo base_url('categoryblog'); ?>" style="color: #FFF !important;">Global</a></h3>
    						<p style="color: #FFF !important;" align="justify">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
    					</div>
    					<div class="one-1" style="background-image: url(<?php echo FE_IMG_PATH; ?>img_6.jpg);"></div>
    				</div>
                </div>
			</div>
            <div class="col-md-6 animate-box">
                <div id="fh5co-car">
                    <div class="car">
    					<div class="one-4">
    						<h3><a href="<?php echo base_url('categoryblog'); ?>" style="color: #FFF !important;">Inkubasi Teknologi</a></h3>
    						<p style="color: #FFF !important;" align="justify">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
    					</div>
    					<div class="one-1" style="background-image: url(<?php echo FE_IMG_PATH; ?>img_5.jpg);"></div>
    				</div>
                </div>
			</div>
            <div class="col-md-6 animate-box">
                <div id="fh5co-car">
                    <div class="car">
    					<div class="one-4">
    						<h3><a href="<?php echo base_url('categoryblog'); ?>" style="color: #FFF !important;">Alih Teknologi</a></h3>
    						<p style="color: #FFF !important;" align="justify">Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
    					</div>
    					<div class="one-1" style="background-image: url(<?php echo FE_IMG_PATH; ?>img_2.jpg);"></div>
    				</div>
                </div>
			</div>
            
		</div>
	</div>
</div>