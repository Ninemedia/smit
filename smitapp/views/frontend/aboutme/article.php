<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
?>

<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body pull-left">
                <ol class="breadcrumb p">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="icon-home"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('#'); ?>">
                            <i class=""></i> Tentang Kami
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'article' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tentangkami/article'); ?>">
                            <i class=""></i> <strong>Artikel</strong>
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
				<h3>Artikel</h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header">
                    <h4>
                        ARTIKEL TERBARU
                    </h4>
                </div>
                <div class="body">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="">
                                <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" /><br />
                            </div>
                            <div class="body">
                                <p align="justify">
                                    <h4 class="media-heading">Media heading</h4><hr /> 
                                    <i class="icon-bookmark"></i> 11 Feb 2017 <br /><hr />
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                    ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                    turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                    in faucibus.<br />
                                    <a href="">Selengkapnya</a><hr />
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" /><br />
                            </div>
                            <div class="body">
                                <p align="justify">
                                    <h4 class="media-heading">Media heading</h4><hr /> 
                                    <i class="icon-bookmark"></i> 11 Feb 2017 <br /><hr />
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                    ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                    turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                    in faucibus.<br />
                                    <a href="">Selengkapnya</a><hr />
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" /><br />
                            </div>
                            <div class="body">
                                <p align="justify">
                                    <h4 class="media-heading">Media heading</h4><hr /> 
                                    <i class="icon-bookmark"></i> 11 Feb 2017 <br /><hr />
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                    ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                                    turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                                    in faucibus.<br />
                                    <a href="">Selengkapnya</a><hr />
                                </p>
                            </div>
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