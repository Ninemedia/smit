<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
?>

<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="body pull-left">
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>">
                                <i class="icon-home"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('frontendberita'); ?>">
                                <i class=""></i> Berita
                            </a>
                        </li>
                        <li <?php echo ($active_page2 == 'detail' ? 'class="active"' : ''); ?>>
                            <i class=""></i> Detail Berita
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="news-title"><?php echo $news_data->title; ?></h4>
                <div class="details-img">
                    <img class="js-animating-object img-responsive media-object visible-lg visible-md visible-sm" src="<?php echo $news_image; ?>" alt="" />
                </div>
                <p class="news-date">
                    <i class="fa fa-calendar"></i> Publikasi : <?php echo date('d F Y H:i:s', strtotime($news_data->datecreated)); ?>
                </p>
                <div class="news-content">
                    <?php echo $news_data->desc; ?>
                </div>
                <div class="news-source">
                    Sumber : <?php echo $news_data->source; ?>
                </div>
                <div id="disqus_thread"></div>
                <script>
                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    
                    /*
                    var disqus_config = function () {
                        this.page.url = "<?php echo current_url(); ?>";  
                        this.page.identifier = "<?php echo $news_data->uniquecode; ?>"; 
                    };

                    (function() { 
                        var d = document, s = d.createElement('script');
                        s.src = 'https://inkubatordev-web-id.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                    */
                </script> 
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related">
                <h4 class="news-title">Berita Terkait</h4>
                <?php if( !empty($alldata) ) : ?>
                    <?php foreach($alldata AS $row){ ?>
                        <h5><a href="<?php echo base_url('layanan/frontendberita/detail/'.$row->uniquecode.''); ?>"><?php echo strtoupper($row->title); ?></a></h5>
                    <?php } ?>
                <?php else :  ?>
                    <div class="alert alert-info">Saat ini sedang tidak ada berita lain yang di publikasi. Terima Kasih.</div>
                <?php endif ?>
            </div>
		</div>
	</div>
</div>