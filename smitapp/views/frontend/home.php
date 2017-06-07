<!-- Main Slider - Banner Zoom In/Out -->
<div id="gtco-sliders" class="animate-box">
    <div id="main-slider-banner-zoom-inout">
        <!-- LOADER -->
        <div class="myloader"></div>
        
        <!-- CONTENT -->
        <ul class="bannerscollection_zoominout_list">
            <?php
                if(!empty($sliderdata)){
                    $i  = 1;
                    foreach($sliderdata AS $row){
                        $uploaded           = $row->uploader;
                        if($uploaded != 0){
                            $file_name      = $row->filename . '.' . $row->extension;
                            $file_url       = FE_IMG_PATH . 'slider/' . $file_name; 
                            $slider         = $file_url;
                        }
                        ?>
                            <li data-horizontalPosition="center" data-verticalPosition="top" data-initialZoom="1" data-finalZoom="0.85" data-text-id="#bannerscollection_zoominout_sliderText<?php echo $i; ?>">
                                <img src="<?php echo $slider; ?>" alt="" width="1346" height="400" />
                            </li>
                        <?php
                        $i++;
                    }
                }else{
                    ?>
                    <li data-horizontalPosition="center" data-verticalPosition="top" data-initialZoom="1" data-finalZoom="0.85" data-text-id="#bannerscollection_zoominout_sliderText1">
                        <img src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" width="1346" height="400" />
                    </li>
                    <?php
                }
            ?>
        </ul>
        
        <?php
            if(!empty($sliderdata)){
                $j  = 1;
                foreach($sliderdata AS $row){
                    ?>
                    <!-- TEXTS -->
                    <div id="bannerscollection_zoominout_sliderText<?php echo $j; ?>" class="bannerscollection_zoominout_texts">
                        <div class="bannerscollection_zoominout_text_line textElement_opportuneFullWidth" data-initial-left="350" data-initial-top="50" data-final-left="50" data-final-top="50" data-duration="0.5" data-fade-start="0" data-delay="0.5">
                            <a class="sliderutamacss" href="<?php echo base_url(); ?>">
                                <?php echo $row->title; ?>
                            </a>
                            <p class="main-slide-line-height">
                                <?php echo $row->desc; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    $j++;
                }
            }
        ?>
    </div>
</div>
<!-- #END Main Slider - Banner Zoom In/Out -->

<div id="gtco-content">
	<div class="gtco-container">
		<div class="row animate-box">
        
            <!-- News -->
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#berita" data-toggle="tab">
                                <i class="material-icons">home</i> BERITA
                            </a>
                        </li>
                        <li>
                            <a href="#blog" data-toggle="tab">
                                <i class="material-icons">people</i> BLOG TENANT
                            </a>
                        </li>
                        <li>
                            <a href="#pengumuman" data-toggle="tab">
                                <i class="material-icons">style</i> PENGUMUMAN
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Berita Tab Content -->
                        <div class="tab-pane fade in active" id="berita">
                            <?php if( $newsdata || !empty($newsdata) ){ ?>
                                <?php foreach($newsdata as $key => $news){ ?>
                                    <?php $desc = word_limiter($news->desc,30); ?>
                                    <div class="media">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="media-left">
                                                    <a href="javascript:void(0);">
                                                        <img class="js-animating-object img-responsive media-object visible-lg visible-md visible-sm" 
                                                        src="<?php echo BE_UPLOAD_PATH . 'news/'.$news->uploader.'/'.$news->thumbnail.'.'.$news->extension; ?>" />
                                                        <img class="js-animating-object img-responsive media-object visible-xs" 
                                                        src="<?php echo BE_UPLOAD_PATH . 'news/'.$news->uploader.'/'.$news->filename.'.'.$news->extension; ?>" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <a href="<?php echo base_url(); ?>" class="media-heading-link"><?php echo $news->title; ?></a>
                                                <div class="media-date"><i class="icon-calendar"></i> <?php echo date('d M Y', strtotime($news->datecreated)); ?></div>
                                                <?php echo $desc; ?><br />
                                                <a href="<?php echo base_url('frontendberita/detail/'.$news->uniquecode.''); ?>"><strong>Selengkapnya</strong></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
                            <?php } ?>
                            
                            
                            <!--
                            <div class="media row">
                                <div class="col-md-3 ">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="js-animating-object img-responsive media-object" src="<?php echo FE_IMG_PATH; ?>img_1.jpg" width="250" height="250" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <div class="media-body">
                                        <h4 class="media-heading">Media heading</h4> 
                                        <i class="icon-bookmark"></i> 11 Feb 2017 <br />
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                        ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                        in faucibus.<br />
                                        <a href="">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="media row">
                                <div class="col-md-3">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="js-animating-object img-responsive media-object" src="<?php echo FE_IMG_PATH; ?>img_2.jpg" width="250" height="250" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="media-body">
                                        <h4 class="media-heading">Media heading</h4> 
                                        <i class="icon-bookmark"></i> 11 Feb 2017 <br />
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                        ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                        in faucibus.<br />
                                        <a href="">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="media row">
                                <div class="col-md-3">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="js-animating-object img-responsive media-object" src="<?php echo FE_IMG_PATH; ?>img_3.jpg" width="250" height="250" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="media-body">
                                        <h4 class="media-heading">Media heading</h4> 
                                        <i class="icon-bookmark"></i> 11 Feb 2017 <br />
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                        ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                        in faucibus.<br />
                                        <a href="">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="media row">
                                <div class="col-md-3">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="js-animating-object img-responsive media-object" src="<?php echo FE_IMG_PATH; ?>img_4.jpg" width="250" height="250" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="media-body">
                                        <h4 class="media-heading">Media heading</h4> 
                                        <i class="icon-bookmark"></i> 11 Feb 2017 <br />
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                        ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                        turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                        in faucibus.<br />
                                        <a href="">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>
                        
                        <!-- Blog Tab Content -->
                        <div class="tab-pane fade" id="blog">
                            <div class="row">
                    			<div class="col-md-6">
                    				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
                    					<div class="gtco-blog animate-box">
                    						<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_1.jpg" alt="" /></a>
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
                    			<div class="col-md-6">
                    				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
                    					<div class="gtco-blog animate-box">
                    						<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_2.jpg" alt="" /></a>
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
                    			<div class="col-md-6">
                    				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
                    					<div class="gtco-blog animate-box">
                    						<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_3.jpg" alt="" /></a>
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
                    			<div class="col-md-6">
                    				<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
                    					<div class="gtco-blog animate-box">
                    						<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_4.jpg" alt="" /></a>
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
                    		</div>
                        </div>
                        
                        <!-- Pengumuman Tab Content -->
                        <div class="tab-pane fade" id="pengumuman">
                            <div class="table-container table-responsive bottom50">
                                <table class="table table-striped table-hover" id="announcement_list" data-url="<?php echo base_url('announcementlist'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width65 text-center">Judul Pengumuman</th>
                                            <th class="width20 text-center">Tanggal Publikasi</th>
                                            <th class="width10 text-center">Actions</th>
                						</tr>
                                        <tr role="row" class="filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
                                            <td>
                								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                							</td>
                							<td style="text-align: center;">
                								<button class="btn bg-blue waves-effect filter-submit bottom5-min bottom5" id="btn_announcement_list">Search</button>
                                                <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                							</td>
                						</tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Will Be Placed Here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Produk -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                
            </div>
        </div>
	</div>
</div>

<!--
<div id="gtco-products">
	<div class="gtco-container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
				<h3>Tentang Kami</h3>
				<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
			</div>
		</div>
		<div class="row row-bottom-padded-md">
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="fh5co-blog animate-box">
					<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_1.jpg" alt=""></a>
					<div class="blog-text">
						<div class="prod-title">
							<h3><a href="#">Profil</a></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<p><a href="#">Learn More...</a></p>
						</div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="fh5co-blog animate-box">
					<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_2.jpg" alt=""></a>
					<div class="blog-text">
						<div class="prod-title">
							<h3><a href="#">Fasilitas</a></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<p><a href="#">Learn More...</a></p>
						</div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="fh5co-blog animate-box">
					<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_3.jpg" alt=""></a>
					<div class="blog-text">
						<div class="prod-title">
							<h3><a href="#">Kegiatan</a></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<p><a href="#">Learn More...</a></p>
						</div>
					</div> 
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="fh5co-blog animate-box">
					<a href="#"><img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>img_4.jpg" alt=""></a>
					<div class="blog-text">
						<div class="prod-title">
							<h3><a href="#">Layanan</a></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
							<p><a href="#">Learn More...</a></p>
						</div>
					</div> 
				</div>
			</div>
			<div class="clearfix visible-md-block"></div>
		</div>
	</div>
</div>
-->


<div id="gtco-blog">
	<div class="gtco-container">
		<div class="row">
            <div class="gtco-widget">
    			<div class="owl-carousel owl-carousel-footer">
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
                    <div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
                    <div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    				<div class="item">
    					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
    				</div>
    			</div>
			</div>  	
		</div>
	</div>
</div>