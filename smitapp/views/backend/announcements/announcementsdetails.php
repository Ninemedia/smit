<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('pengumuman'); ?>" class="btn btn-sm btn-success waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($announ_data->title); ?></h2>
                <p class="bottom0">Tanggal Publikasi : <?php echo $announ_data->datecreated; ?></p>    
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    Pengumuman Nomor : <?php echo $announ_data->no_announcement; ?>  Tentang <?php echo strtoupper($announ_data->title); ?> Pada Pusat Inovasi LIPI
                </p>
                <p align="justify">
                    <?php echo $announ_data->desc; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->