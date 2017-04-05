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
                    <li <?php echo ($active_page == 'profile' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('profile'); ?>">
                            <i class=""></i> Tentang Kami
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'event' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('event'); ?>">
                            <i class=""></i> <strong>Kegiatan</strong>
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
				<h3>Kegiatan</h3>
			</div>
			<div class="col-md-12">
                <div class="panel-body">
                    <p align="justify"></p>
                </div>
			    
            </div>
		</div>
	</div>
</div>