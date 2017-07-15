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
                        <a href="<?php echo base_url('tenant/produktenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'produk' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/produktenant'); ?>">
                            <i class=""></i> <strong>Produk Inkubasi / Tenant</strong>
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
				<h3>Produk Inkubasi / Tenant</h3>
			</div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="news-title">Inkubasi / Tenant</h4>
                <?php if( $productdata || !empty($productdata) ){ ?>
                <div class="row">
                <?php foreach($productdata as $key => $tenant){ ?>
                    <?php $desc = word_limiter($tenant->description,30); ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="js-animating-object img-responsive media-object visible-lg visible-md visible-sm"
                                            src="<?php echo BE_UPLOAD_PATH . 'tenantproduct/'.$tenant->user_id.'/'.$tenant->thumbnail_filename.'.'.$tenant->thumbnail_extension; ?>" />
                                            <img class="js-animating-object img-responsive media-object visible-xs"
                                            src="<?php echo BE_UPLOAD_PATH . 'tenantproduct/'.$tenant->user_id.'/'.$tenant->thumbnail_filename.'.'.$tenant->thumbnail_extension; ?>" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <a href="<?php echo base_url('producttenant/detail/'.$tenant->uniquecode.''); ?>" class="media-heading-link"><?php echo $tenant->title; ?></a>
                                    <div class="media-date"><i class="icon-calendar"></i> <?php echo date('d M Y', strtotime($tenant->datecreated)); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="icon-user"></i> <?php echo strtoupper($tenant->name); ?> 
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="icon-file"></i> <?php echo strtoupper($tenant->category_product); ?></div>
                                    <?php echo $desc; ?><br />
                                    <a href="<?php echo base_url('producttenant/detail/'.$tenant->uniquecode.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <?php if($countproduct > LIMIT_DEFAULT){ ?>
                    <a href="<?php echo base_url('producttenant'); ?>" class="btn btn-primary top25 pull-right">Judul Tenant Lainnya</a>
                <?php } ?>
            <?php }else{ ?>
                <div class="alert alert-info bottom0">Saat ini sedang tidak ada produk tenant yang di publikasi. Terima Kasih.</div>
            <?php } ?>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom30 news-related">
                        <h4 class="news-title">Produk Tenant Lainnya</h4>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom30 news-related">
                        <h4 class="news-title">Kategori Produk Tenant</h4>
                        <?php if( !empty($allcategorydata) ) : ?>
                            <?php foreach($allcategorydata AS $row){ ?>
                                <h5><a href="<?php echo base_url('prainkubasi/produkprainkubasi/kategori/'.$row->category_id.''); ?>"><?php echo strtoupper($row->category_name); ?></a></h5>
                            <?php } ?>
                        <?php else :  ?>
                            <div class="alert alert-info">Saat ini sedang tidak ada kategori produk yang di publikasi. Terima Kasih.</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
 
		</div>
	</div>
</div>