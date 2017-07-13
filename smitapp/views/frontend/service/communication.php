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
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class=""></i> Layanan
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'komunikasi' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('komunikasi'); ?>">
                            <i class=""></i> <strong>Komunikasi dan Bantuan</strong>
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
				<h3>Komunikasi dan Bantuan</h3>
			</div>
			<div class="col-md-12">
                <div id="disqus_thread"></div>
                <script>
                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

                    var disqus_config = function () {
                        this.page.url = "<?php echo current_url(); ?>";  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = "<?php echo 'communication'; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };

                    (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://inkubatordev-web-id.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script> 
            </div>
		</div>
	</div>
</div>