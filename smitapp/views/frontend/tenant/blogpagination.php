<div class="row">
    <?php if( !empty($blogdata) ){ ?> 
        <?php
        foreach($blogdata AS $row){
            $file_name      = $row->thumbnail_filename . '.' . $row->thumbnail_extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantblog/'.$row->user_id.'/' . $file_name; 
            $blog           = $file_url;
            ?>
            <div class="col-md-4 col-sm-12">
        		<div class="feature-left">
        			<div class="gtco-blog">
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
    <?php }else{ ?>
        <div class="alert alert-info">Saat ini sedang tidak ada blog tenant yang di publikasi. Terima Kasih.</div>
    <?php } ?>
</div>
<div class="text-center"><?php echo $this->ajax_pagination->create_links(); ?></div>