<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('berita'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($news_data->title); ?></h2>
                <p class="bottom0">Tanggal Publikasi : <?php echo date('d F Y H:i:s', strtotime($news_data->datecreated)); ?></p>    
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    Berita Nomor : <?php echo $news_data->no_news; ?>  Tentang <?php echo strtoupper($news_data->title); ?> Pada Pusat Inovasi LIPI
                </p>
                <div class="details-img">
                    <img class="js-animating-object img-responsive" src="<?php echo $news_image; ?>" alt=""/>
                </div><br />
                <p align="justify">
                    <?php echo $news_data->desc; ?><br />
                    Sumber : <?php echo $news_data->source; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->