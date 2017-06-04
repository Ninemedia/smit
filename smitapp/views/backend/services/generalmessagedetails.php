<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('layanan/pesanumum'); ?>" class="btn btn-sm btn-success waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($generalmessage_data->title); ?></h2>
                <p class="bottom0">Tanggal Publikasi : <?php echo date('d F Y H:i:s', strtotime($generalmessage_data->datecreated)); ?></p>    
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    Pengirim : <?php echo strtoupper($generalmessage_data->name); ?> <br />
                    Email : <?php echo $generalmessage_data->email; ?>  
                </p>
                <p align="justify">
                    <?php echo $generalmessage_data->description; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->