<!-- Content -->
<?php 
    $title          = '';
    $datecreated    = '';
    $no_announcement= '';
    $desc           = '';
    
    if( !empty($announ_data) ){
        $title          = $announ_data->title;
        $datecreated    = $announ_data->datecreated;
        $no_announcement= $announ_data->no_announcement;
        $desc           = $announ_data->desc;
    }
?>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('pengumuman'); ?>" class="btn btn-sm btn-default waves-effect back pull-right">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($title); ?></h2>
                <p class="bottom0">Tanggal Publikasi : <?php echo date('d F Y H:i:s', strtotime($datecreated)); ?></p>    
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    Pengumuman Nomor : <?php echo $no_announcement; ?>  <br />Tentang <strong><?php echo strtoupper($title); ?></strong> pada Pusat Inovasi LIPI Bidang Inkubasi dan Alih Teknologi.
                    <hr />
                </p>
                <p align="justify">
                    <strong>Isi Pengumuman : </strong><br />
                    <?php echo $desc; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->