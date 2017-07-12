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
                        <a href="<?php echo base_url('prainkubasi/produkprainkubasi'); ?>">
                            <i class=""></i> Pra-Inkubasi
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('prainkubasi/produkprainkubasi'); ?>">
                            <i class=""></i> Produk Pra-Inkubasi
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'produk' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('prainkubasi/produkprainkubasi'); ?>">
                            <i class=""></i> <strong>Detail Produk Pra-Inkubasi</strong>
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
				<h3>Detail Produk Pra-Inkubasi</h3>
			</div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="news-title"><?php echo $productdata->title; ?></h4>
                <div class="details-img">
                    <img class="js-animating-object img-responsive" src="<?php echo $product_image; ?>" alt="" />
                </div>
                <p class="news-date">
                    <i class="fa fa-calendar"></i> Publikasi : <?php echo date('d F Y H:i:s', strtotime($productdata->datecreated)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa fa-user"></i> Posting By : <?php echo $productdata->name; ?>
                </p>
                <div class="news-content">
                    <?php echo $productdata->description; ?>
                </div>
                <div class="news-source">
                    Sumber / Kegiatan : <?php echo strtoupper( $selectiondata->event_title ); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related">
                <h4 class="news-title">Judul Produk Lainnya</h4>
                <?php if( !empty($alldata) ) : ?>
                    <?php foreach($alldata AS $row){ ?>
                        <h5><a href="<?php echo base_url('prainkubasi/produkprainkubasi/detail/'.$row->uniquecode.''); ?>"><?php echo strtoupper($row->title); ?></a></h5>
                    <?php } ?>
                <?php else :  ?>
                    <div class="alert alert-info">Saat ini sedang tidak ada berita lain yang di publikasi. Terima Kasih.</div>
                <?php endif ?>
            </div>
            
		</div>
	</div>
</div>