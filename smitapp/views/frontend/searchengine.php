<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(1, 0) ? $this->uri->segment(2, 0) : '');
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
                        <li <?php echo ($active_page == 'pencarian' ? 'class="active"' : ''); ?>>
                            <i class=""></i> Halaman Pencarian
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
        <div class="row animate-box">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs bottom30">
                    <li class="active"><a href="#berita" data-toggle="tab">BERITA</a></li>
                    <li><a href="#blog_tenant" data-toggle="tab">BLOG TENANT</a></li>
                    <li><a href="#pengumuman" data-toggle="tab">PENGUMUMAN</a></li>
                    <li><a href="#list_prainkubasi" data-toggle="tab">LIST PRAINKUBASI</a></li>
                    <li><a href="#prainkubasi_produk" data-toggle="tab">PRODUK PRAINKUBASI</a></li>
                    <li><a href="#list_tenant" data-toggle="tab">LIST TENANT</a></li>
                    <li><a href="#inkubasi_produk" data-toggle="tab">PRODUK TENANT</a></li>
                    <li><a href="#berkas_digital" data-toggle="tab">BERKAS DIGITAL</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4 class="news-title">PENCARIAN</h4>
                <?php echo form_open( base_url('pencarian'), array( 'id'=>'searching-form-result', 'role'=>'form' ) ); ?>
                    <div class="form-group">
                        <label class="control-label">Kata Kunci</label>
                        <div class="input-group">
                            <div class="form-line">
                                <?php 
                                    echo form_input(
                                        'search_key',
                                        ( !empty($post) ? smit_isset($post['search_key'],'') : '' ),
                                        array(
                                            'class'=>'form-control',
                                            'placeholder'=>'Kata Kunci...'
                                        )
                                    ); 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-md btn-primary waves-effect" type="submit">Cari</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">  
                <h4 class="news-title">HASIL PENCARIAN</h4>
                <div class="tab-content">
                    <!-- Berita Tab Content -->
                    <div class="tab-pane fade in active" id="berita">
                        <?php if( $s_news_data || !empty($s_news_data) ){ ?>
                            <div id="search_news_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_news_data as $news){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($news->search_desc,30); ?>
                                    <a href="<?php echo base_url('layanan/frontendberita/detail/'.$news->search_uid.''); ?>" class="media-heading-link"><?php echo $news->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('layanan/frontendberita/detail/'.$news->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END Berita Tab Content -->
                    
                    <!-- Blog Tenant Tab Content -->
                    <div class="tab-pane fade" id="blog_tenant">
                        <?php if( $s_blogtenant_data || !empty($s_blogtenant_data) ){ ?>
                            <div id="search_blogtenant_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_blogtenant_data as $blogtenant){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($blogtenant->search_desc,30); ?>
                                    <a href="<?php echo base_url('tenant/blogtenant/detail/'.$blogtenant->search_uid.''); ?>" class="media-heading-link"><?php echo $blogtenant->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('tenant/blogtenant/detail/'.$blogtenant->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END Blog Tenant Tab Content -->
                    
                    <!-- Pengumuman Tab Content -->
                    <div class="tab-pane fade" id="pengumuman">
                        <?php if( $s_announcement_data || !empty($s_announcement_data) ){ ?>
                            <div id="search_announcement_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_announcement_data as $announcement){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($announcement->search_desc,30); ?>
                                    <a href="<?php echo base_url('seleksi/pengumuman/'.$announcement->search_uid.''); ?>" class="media-heading-link"><?php echo $announcement->search_title; ?></a><br />
                                    Pengumuman Nomor : <?php echo $announcement->search_number; ?>  Tentang <?php echo strtoupper($announcement->search_title); ?> Pada Pusat Inovasi LIPI
                                    <a href="<?php echo base_url('seleksi/pengumuman/'.$announcement->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END Pengumuman Tab Content -->
                    
                    <!-- List Prainkubasi Tab Content -->
                    <div class="tab-pane fade" id="list_prainkubasi">
                        <?php if( $s_praincubationlist_data || !empty($s_praincubationlist_data) ){ ?>
                            <div id="search_praincubationlist_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_praincubationlist_data as $praincubationlist){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($praincubationlist->search_desc,30); ?>
                                    <a href="<?php echo base_url('tenant/blogtenant/detail/'.$praincubationlist->search_uid.''); ?>" class="media-heading-link"><?php echo $praincubationlist->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('tenant/blogtenant/detail/'.$praincubationlist->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END List Prainkubasi Tab Content -->
                    
                    <!-- Produk Prainkubasi Tab Content -->
                    <div class="tab-pane fade" id="prainkubasi_produk">
                        <?php if( $s_praincubationproduct_data || !empty($s_praincubationproduct_data) ){ ?>
                            <div id="search_praincubationproduct_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_praincubationproduct_data as $praincubationproduct){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($praincubationproduct->search_desc,30); ?>
                                    <a href="<?php echo base_url('prainkubasi/produkprainkubasi/detail/'.$praincubationproduct->search_uid.''); ?>" class="media-heading-link"><?php echo $praincubationproduct->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('prainkubasi/produkprainkubasi/detail/'.$praincubationproduct->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END Produk Prainkubasi Tab Content -->
                    
                    <!-- Produk Inkubasi Tab Content -->
                    <div class="tab-pane fade" id="inkubasi_produk">
                        <?php if( $s_incubationproduct_data || !empty($s_incubationproduct_data) ){ ?>
                            <div id="search_incubationproduct_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_incubationproduct_data as $sincubationproduct){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($sincubationproduct->search_desc,30); ?>
                                    <a href="<?php echo base_url('tenant/produktenant/detail/'.$sincubationproduct->search_uid.''); ?>" class="media-heading-link"><?php echo $sincubationproduct->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('tenant/produktenant/detail/'.$sincubationproduct->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END Produk Inkubasi Tab Content -->
                    
                    <!-- List Tenant Tab Content -->
                    <div class="tab-pane fade" id="list_tenant">
                        <?php if( $s_tenantlist_data || !empty($s_tenantlist_data) ){ ?>
                            <div id="search_tenantlist_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_tenantlist_data as $tenantlist){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($tenantlist->search_desc,30); ?>
                                    <a href="<?php echo base_url('tenant/produktenant/detail/'.$tenantlist->search_uid.''); ?>" class="media-heading-link"><?php echo $tenantlist->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('tenant/produktenant/detail/'.$tenantlist->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END List Tenant Tab Content -->
                    
                    <!-- Berkas Digital Tab Content -->
                    <div class="tab-pane fade" id="berkas_digital">
                        <?php if( $s_guides_data || !empty($s_guides_data) ){ ?>
                            <div id="search_guides_paginate" data-perpage="<?php echo LIMIT_DEFAULT; ?>">
                            <?php foreach($s_guides_data as $guides){ ?>
                                <div class="media">
                                    <?php $desc = word_limiter($guides->search_desc,30); ?>
                                    <a href="<?php echo base_url('tenant/produktenant/detail/'.$guides->search_uid.''); ?>" class="media-heading-link"><?php echo $guides->search_title; ?></a><br />
                                    <?php echo $desc; ?>
                                    <a href="<?php echo base_url('tenant/produktenant/detail/'.$guides->search_uid.''); ?>"><strong>Selengkapnya</strong></a>
                                </div>
                            <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <?php echo empty($search_key) ? 'Tidak ada kata kunci untuk pencarian' : 'Pencarian dengan kata kunci <strong>"'.$search_key.'"</strong> Tidak Ditemukan.'; ?>
                        <?php } ?>
                    </div>
                    <!-- END Berkas Digital Tab Content -->
                </div>
            </div>
        </div>
	</div>
</div>