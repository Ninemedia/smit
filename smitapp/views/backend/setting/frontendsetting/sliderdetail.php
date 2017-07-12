<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('pengaturan/depan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($slider_data->title); ?></h2>
                <p class="bottom0">Tanggal Dibuat : <?php echo date('d F Y H:i:s', strtotime($slider_data->datecreated)); ?></p>    
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    <strong>Status : </strong> <?php echo $status; ?><hr />
                </p>
                <div class="details-img">
                    <img class="js-animating-object img-responsive" src="<?php echo $slider_image; ?>" alt="" />
                </div><br />
                <p align="justify">
                    <strong>Deskripsi : </strong>
                    <?php echo $slider_data->desc; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->