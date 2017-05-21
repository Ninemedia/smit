<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_subpage = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
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
                        <a href="<?php echo base_url('seleksi/pengumuman'); ?>">
                            Seleksi
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('seleksi/pengumuman'); ?>">
                            Pengumuman
                        </a>
                    </li>
                    <li <?php echo ($active_subpage == 'pengumuman' ? 'class="active"' : ''); ?>>
                        <i class=""></i> <strong>Details</strong>
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
    				<p>Tanggal Publikasi : <?php echo date('d F Y H:i:s', strtotime($announ_data->datecreated)); ?>
                    </p>
                    <hr />
                    <p align="justify" class="uppercase">
                        Pengumuman Nomor : <?php echo $announ_data->no_announcement; ?>  Tentang <?php echo strtoupper($announ_data->title); ?> Pada Pusat Inovasi LIPI
                    </p>
                    <p>
                        <?php echo $announ_data->desc; ?>
                    </p>
                </div>
            </div>
		</div>
	</div>
</div>