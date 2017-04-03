<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
?>

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
                        <a href="<?php echo base_url(); ?>">
                            Inkubasi
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('announcement'); ?>">
                            Pengumuman
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'contact' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('announcement'); ?>">
                            <i class=""></i> <strong>Details</strong>
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
			<div class="col-md-12">
                <div class="panel-body">
    				<h3><?php echo strtoupper($announ_data->title); ?></h3>
    				<p>Tanggal Publikasi : <?php echo $announ_data->datecreated; ?></p>
                    <hr />
                </div>
            </div>
			<div class="col-md-12">
                <div class="panel-body">
                    <p align="justify" class="uppercase">
                    Pengumuman Nomor : <?php echo $announ_data->no_announcement; ?>  Tentang <?php echo strtoupper($announ_data->title); ?> Pada Pusat Inovasi LIPI
                    </p>
                    <p align="justify">
                    <?php echo $announ_data->desc; ?>
                    </p>
                </div>
			    
            </div>
		</div>
	</div>
</div>