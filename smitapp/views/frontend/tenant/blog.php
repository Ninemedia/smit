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
                        <a href="<?php echo base_url('tenant/blogtenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'blog' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/blogtenant'); ?>">
                            <i class=""></i> <strong>Blog Tenant</strong>
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
				<h3>Blog Tenant</h3>
			</div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h4 class="news-title">Blog Tenant Terbaru</h4>
                <div class="panel-body" id="blogtenantlist">
                    <div class="row">
                        <?php
                            $condition          = ' WHERE %status% = 1';
                            if( !empty($category_id) ){
                                $condition      = ' WHERE %status% = 1 AND %category_id% = '.$category_id.'';
                            }
                            $blog_list          = $this->Model_Tenant->get_all_blogtenant(0, 0, $condition);
                        ?>
                        <?php if( !empty($blog_list) ) : ?>
                            
                            <?php if( !empty($blogdata) || !empty($blog_list) ) : ?>
                            <?php
                                if( !empty( $blog_list ) ){
                                    $blogdata   = $blog_list;
                                }
                                foreach($blogdata AS $row){
                                    $file_name      = $row->thumbnail_filename . '.' . $row->thumbnail_extension;
                                    $file_url       = BE_UPLOAD_PATH . 'tenantblog/'.$row->user_id.'/' . $file_name;
                                    $blog           = $file_url;
                            ?>
                			<div class="col-md-4 col-sm-12">
                				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
                					<div class="gtco-blog animate-box">
                						<a href="#"><img src="<?php echo $blog; ?>" alt="" /></a>
                						<div class="blog-text">
                							<h4><a href="<?php echo base_url('tenant/blogtenant/detail/'.$row->uniquecode.''); ?>"><?php echo word_limiter($row->title,2) ; ?></a></h4>
                							<span class="posted_on"><?php echo date('d F Y', strtotime($row->datecreated)); ?></span>
                							<p><?php echo word_limiter($row->description,25); ?></p>
                							<a href="<?php echo base_url('tenant/blogtenant/detail/'.$row->uniquecode.''); ?>" class="btn btn-primary waves-effect">Detail</a>
                						</div>
                					</div>
                				</div>
                			</div>
                            <?php } ?>
                            
                            <?php else : ?>
                                <div class="alert alert-info">Saat ini sedang tidak ada blog tenant yang di publikasi. Terima Kasih.</div>
                            <?php endif; ?>
                            
                        <?php else : ?>
                            <div class="alert alert-info">Saat ini sedang tidak ada blog tenant yang di publikasi. Terima Kasih. Silahkan Kembali ke <a href="<?php echo base_url('tenant/blogtenant'); ?>">Blog Tenant</a> lainnya.</div>
                        <?php endif; ?>
                        
                    </div>
                    <div class="text-center"><?php echo $this->ajax_pagination->create_links(); ?></div>
                </div>
            </div>
		</div>
	</div>
</div>
