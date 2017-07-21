<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('tenants/blogs'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2><?php echo strtoupper($tenantdata->title); ?></h2>
                <p class="bottom0">Tanggal Publikasi : <?php echo date('d F Y H:i:s', strtotime($tenantdata->datecreated)); ?></p>    
            </div>
            <div class="body">
                <div class="details-img">
                    <img class="js-animating-object img-responsive" src="<?php echo $tenant_image; ?>" alt=""/>
                </div><br />
                <p align="justify" class="uppercase">
                    <strong>Posting By : </strong> <?php echo strtoupper($tenantdata->name); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>Kategori : </strong> <?php echo strtoupper($tenantdata->category_product); ?>
                </p>
                <p align="justify">
                    <strong>Deskripsi : </strong><br />
                    <?php echo $tenantdata->description; ?><br /><hr />
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->