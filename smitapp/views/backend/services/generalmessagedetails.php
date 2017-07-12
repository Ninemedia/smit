<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('layanan/pesanumum'); ?>" class="btn btn-sm btn-default waves-effect pull-right back"><i class="material-icons">arrow_back</i> Kembali</a>
                <h2><?php echo strtoupper($generalmessage_data->title); ?></h2>
                <p class="bottom0">Tanggal Pesan : <?php echo date('d F Y H:i:s', strtotime($generalmessage_data->datecreated)); ?></p>    
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    <strong>Pengirim : </strong><br />
                    <?php echo strtoupper($generalmessage_data->name); ?> (<?php echo $generalmessage_data->email; ?>)  
                </p>
                <p align="justify">
                    <strong>Isi Pesan : </strong><br />
                    <?php echo $generalmessage_data->description; ?>
                </p><hr />
                <p align="center" class="top30">
                    <strong>Informasi !</strong>
                    Pesan ini dirahasiakan oleh perusahaan dan hanya di miliki perusahaan. Pesan ini tidak di sebarluaskan. Terima Kasih.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->