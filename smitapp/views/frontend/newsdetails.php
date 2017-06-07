<?php
    //$active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    //$active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
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
                        <a href="<?php echo base_url(''); ?>">
                            <i class=""></i> Berita
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(''); ?>">
                            <i class=""></i> <strong>Detail Berita</strong>
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
				<h3>Detail Berita</h3>
			</div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h4>Berita Terkait</h4>
                    <hr />
                    <?php if( !empty($alldata) ) : ?>
                        <?php
                            foreach($alldata AS $row){
                        ?>
                            <h4><a href="<?php echo base_url('frontendberita/detail/'.$row->uniquecode.''); ?>"><?php echo strtoupper($row->title); ?></a></h4>
                        <?php    
                            }
                        ?>
                    <?php else :  ?>
                        <br /><br />
                        <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita lain yang di publikasi. Terima Kasih.</div>
                    <?php endif ?>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="body">
                        <h4><?php echo strtoupper($news_data->title); ?></h4>
                        <hr />
                        <p align="right">
                            Publikasi : <?php echo date('d F Y H:i:s', strtotime($news_data->datecreated)); ?>
                        </p>
                        <div class="details-img">
                            <img class="js-animating-object img-responsive" src="<?php echo $news_image; ?>" alt="" style="border: solid 2px #009688 !important;" />
                        </div><br />
                        <p align="justify">
                            <?php echo $news_data->desc; ?><br />
                            Sumber : <?php echo $news_data->source; ?>
                            <hr />
                        </p>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>