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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                <div class="row">
                                <?php foreach($newsdata as $key => $news){ ?>
                                    <?php $desc = word_limiter($news->desc,30); ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                                    <a href="<?php echo base_url('frontendberita/detail/'.$news->uniquecode.''); ?>" class="media-heading-link"><?php echo $news->title; ?></a>
                                                    <div class="media-date"><i class="icon-calendar"></i> <?php echo date('d M Y', strtotime($news->datecreated)); ?></div>
                                                    <?php echo $desc; ?><br />
                                                    <a href="<?php echo base_url('frontendberita/detail/'.$news->uniquecode.''); ?>"><strong>Selengkapnya</strong></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                                <?php if($countnews > LIMIT_DEFAULT){ ?>
                                    <a href="<?php echo base_url('frontendberita'); ?>" class="btn btn-primary top25 pull-right">Berita Lainnya</a>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
                            <?php } ?>
                        </div>

                        <!-- Blog Tab Content -->
                        <div class="tab-pane fade" id="blog">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php
                                                $condition          = ' WHERE %status% = 1';
                                                if( !empty($category_id) ){
                                                    $condition      = ' WHERE %status% = 1 AND %category_id% = '.$category_id.'';
                                                }
                                                $blog_list          = $this->Model_Tenant->get_all_blogtenant(0, 0, $condition);
                                            ?>
                                            <?php if( !empty($blog_list) ) : ?>
                                            <?php
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
                                							<h4><a href="<?php echo base_url(); ?>"><?php echo word_limiter($row->title,2) ; ?></a></h4>
                                							<span class="posted_on"><?php echo date('d F Y', strtotime($row->datecreated)); ?></span>
                                							<p><?php echo word_limiter($row->description,25); ?></p>
                                							<a href="<?php echo base_url(); ?>" class="btn btn-primary waves-effect">Selengkapnya</a>
                                						</div>
                                					</div>
                                				</div>
                                			</div>
                                            <?php } ?>
                                            <?php else : ?>
                                                <div class="alert alert-info">Saat ini sedang tidak ada blog tenant yang di publikasi. Terima Kasih.</div>
                                            <?php endif; ?>
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
            <!--
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

            </div>
            -->
        </div>
	</div>
</div>

<div id="gtco-blog">
	<div class="gtco-container">
		<div class="row">
            <div class="col-md-12">
                <div class="gtco-widget">
        			<div class="owl-carousel owl-carousel-footer">
                        <?php if( !empty($tenantdata) ) : ?>
                        <?php
                            foreach($tenantdata AS $row){
                                $file_name      = $row->filename . '.' . $row->extension;
                                $file_url       = BE_UPLOAD_PATH . 'incubationtenant/'.$row->uploader.'/' . $file_name; 
                                $tenant         = $file_url;
                        ?>
                        <div class="item">
        					<img class="js-animating-object img-responsive" src="<?php echo $tenant; ?>" alt="" />
        				</div>
                        <?php } ?>
                        <?php else : ?>
                            <div class="item">
            					<img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>tenant/logo-tenant1.jpg" alt="" />
            				</div>
                        <?php endif; ?>
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
</div>
