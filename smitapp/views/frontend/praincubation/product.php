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
                    <li <?php echo ($active_page2 == 'produk' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('prainkubasi/produkprainkubasi'); ?>">
                            <i class=""></i> <strong>Produk Pra-Inkubasi</strong>
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
				<h3>Produk Pra-Inkubasi</h3>
			</div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <h4 class="news-title">Produk Terbaru</h4>
                <div class="panel-body">
                    <div class="product-box">
                        <div class="row">
                            <?php
                                $condition          = ' WHERE %status% = 1';
                                $product_list       = $this->Model_Praincubation->get_all_product(0, 0, $condition);
                                
                                foreach($product_list AS $row){
                                    $file_name      = $row->thumbnail_filename . '.' . $row->thumbnail_extension;
                                    $file_url       = BE_UPLOAD_PATH . 'praincubationproduct/'.$row->user_id.'/' . $file_name; 
                                    $product        = $file_url;
                            ?>
                            <div class="col-md-4 col-sm-12">
                                <div class="product-post triggerAnimation animated" data-animate="fadeInLeft">
                                    <img alt="Riset Unggulan" src="<?php echo $product; ?>" />
                                    <a href="<?php echo base_url(); ?>"><div class="product-title"><h3><?php echo word_limiter($row->title,2) ; ?></h3></div></a>
                                    <div class="product-overlay">
                                        <div class="product-content">
                                            <a href="<?php echo base_url(); ?>"><h3><?php echo $row->title; ?></h3></a>
                                            <p><?php echo word_limiter($row->description,30); ?></p>
                                            <a class="btn btn-primary" href="<?php echo base_url('prainkubasi/produkprainkubasi/detail/'.$row->uniquecode.''); ?>">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bottom30 news-related">
                <h4 class="news-title">Kategori Lainnya</h4>
                <?php if( !empty($allcategorydata) ) : ?>
                    <?php foreach($allcategorydata AS $row){ ?>
                        <h5><a href="<?php echo base_url('prainkubasi/produkprainkubasi/kategori/'.$row->category_id.''); ?>"><?php echo strtoupper($row->category_name); ?></a></h5>
                    <?php } ?>
                <?php else :  ?>
                    <div class="alert alert-info">Saat ini sedang tidak ada berita lain yang di publikasi. Terima Kasih.</div>
                <?php endif ?>
            </div>
		</div>
	</div>
</div>