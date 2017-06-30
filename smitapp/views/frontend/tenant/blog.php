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
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<div class="gtco-blog animate-box">
						<a href="#"><img src="<?php echo FE_IMG_PATH; ?>img_1.jpg" alt="" /></a>
						<div class="blog-text">
							<h3><a href="#">45 Minimal Worksspace Rooms for Web Savvys</a></h3>
							<span class="posted_on">Sep. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary waves-effect">Learn More</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<div class="gtco-blog animate-box">
						<a href="#"><img src="<?php echo FE_IMG_PATH; ?>img_2.jpg" alt="" /></a>
						<div class="blog-text">
							<h3><a href="#">45 Minimal Worksspace Rooms for Web Savvys</a></h3>
							<span class="posted_on">Sep. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary waves-effect">Learn More</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<div class="gtco-blog animate-box">
						<a href="#"><img src="<?php echo FE_IMG_PATH; ?>img_3.jpg" alt="" /></a>
						<div class="blog-text">
							<h3><a href="#">45 Minimal Worksspace Rooms for Web Savvys</a></h3>
							<span class="posted_on">Sep. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary waves-effect">Learn More</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<div class="gtco-blog animate-box">
						<a href="#"><img src="<?php echo FE_IMG_PATH; ?>img_4.jpg" alt="" /></a>
						<div class="blog-text">
							<h3><a href="#">45 Minimal Worksspace Rooms for Web Savvys</a></h3>
							<span class="posted_on">Sep. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary waves-effect">Learn More</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<div class="gtco-blog animate-box">
						<a href="#"><img src="<?php echo FE_IMG_PATH; ?>img_5.jpg" alt="" /></a>
						<div class="blog-text">
							<h3><a href="#">45 Minimal Worksspace Rooms for Web Savvys</a></h3>
							<span class="posted_on">Sep. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary waves-effect">Learn More</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
					<div class="gtco-blog animate-box">
						<a href="#"><img src="<?php echo FE_IMG_PATH; ?>img_6.jpg" alt="" /></a>
						<div class="blog-text">
							<h3><a href="#">45 Minimal Worksspace Rooms for Web Savvys</a></h3>
							<span class="posted_on">Sep. 15th</span>
							<span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<a href="#" class="btn btn-primary waves-effect">Learn More</a>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-12">
                <div class="body">
                    <nav>
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="javascript:void(0);">
                                    <i class="material-icons">chevron_left</i>
                                </a>
                            </li>
                            <li class="active"><a href="javascript:void(0);">1</a></li>
                            <li><a href="javascript:void(0);" class="waves-effect">2</a></li>
                            <li><a href="javascript:void(0);" class="waves-effect">3</a></li>
                            <li><a href="javascript:void(0);" class="waves-effect">4</a></li>
                            <li><a href="javascript:void(0);" class="waves-effect">5</a></li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect">
                                    <i class="material-icons">chevron_right</i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

		</div>
	</div>
</div>
