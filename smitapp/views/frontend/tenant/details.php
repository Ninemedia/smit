<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');

    $city           = $this->Model_Address->get_cities($tenantdata->city);
    $city           = $city->regional_name;
    $province       = $this->Model_Address->get_provinces($tenantdata->province);
    $province       = $province->province_name;

    $address        = $tenantdata->address;
    $address       .= ' '.$city;
    $address       .= ' '.$tenantdata->district;
    $address       .= ' PROVINSI '.$province;

    $position       = $tenantdata->position;
    if($position == 1){
        $position   = "INWALL";
    }elseif($position == 2){
        $position   = "OUTWALL";
    }elseif($position == 4){
        $position   = "GRADUATE";
    }else{
        $position   = "NO DATA";
    }
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
                        <a href="<?php echo base_url('tenant/daftartenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'detail' ? 'class="active"' : ''); ?>>
                        <i class=""></i> <strong>Detail Tenant</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <h4 class="news-title">DETAIL TENANT <?php echo strtoupper($tenantdata->name_tenant); ?></h4>
                <div class="tenant-detail-wrapper">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center bottom25">
                            <img class="tenant-detail-img" src="<?php echo BE_UPLOAD_PATH . 'incubationtenant/'.$tenantdata->uploader.'/'.$tenantdata->filename.'.'.$tenantdata->extension; ?>" />
                            <div class="tenant-detail-txt">
                                <p class="bottom10"><strong><?php echo $tenantdata->name_tenant; ?></strong></p>
                                <p class="bottom5"><div class="badge bg-blue"><strong><?php echo strtoupper($position); ?></strong></div></p>  
                                <p class="bottom5"><i class="icon-mail"></i> <small><?php echo $tenantdata->email; ?></small></p>
                                <p class="bottom5"><i class="icon-phone"></i> <small><?php echo substr($tenantdata->phone, 0, -4); ?>****</small></p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="input-group bottom0">
                                <label>Tahun Berdiri</label>
                                <p class="bottom15"><?php echo $tenantdata->year; ?></p>
                            </div>
                            <div class="input-group bottom0">
                                <label>Alamat</label>
                                <p class="bottom15"><?php echo $address; ?></p>
                            </div>
                            <div class="input-group bottom0">
                                <label>Bentuk Legalitas Usaha (PT/CV/Lainnya)</label>
                                <p class="bottom15"><?php echo $tenantdata->legal; ?></p>
                            </div>
                            <div class="input-group bottom0">
                                <label>Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)</label>
                                <p class="bottom15"><?php echo $tenantdata->licensing; ?></p>
                            </div>
                            <div class="input-group bottom0">
                                <label>Kemitraan Usaha yang Dimiliki</label>
                                <p class="bottom15"><?php echo $tenantdata->partnerships; ?></p>
                            </div>
                            <!--
                            <div class="input-group bottom0">
                                <label>Posisi</label>
                                <p class="bottom15"><?php echo ( $tenantdata->position == 1 ? 'INWALL' : 'OUTWALL' ); ?></p>
                            </div>
                            -->
                        </div>
                    </div>
                </div>

                <p class="news-date">TENTANG <?php echo strtoupper($tenantdata->name_tenant); ?></p>
                <div class="news-content bottom50">
                    <?php if( !empty($tenantdata->description) ) : ?>
                        <?php echo smit_isset( $tenantdata->description, '' ); ?>
                    <?php else : ?>
                        <strong>Tidak Ada</strong> Deskripsi Tenant
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
                <!--
                <h4 class="news-title">PRODUK TENANT <?php echo strtoupper($tenantdata->name_tenant); ?></h4>
                -->
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related">
                <h4 class="news-title">Tenant Lainnya</h4>
                <?php if( !empty($other_tenants) ) : ?>
                    <?php foreach($other_tenants AS $row){ ?>
                        <h5><a href="<?php echo base_url('tenant/detail/'.$row->uniquecode.''); ?>"><?php echo strtoupper($row->name_tenant); ?></a></h5>
                    <?php } ?>
                <?php else :  ?>
                    <div class="alert alert-info">Saat ini sedang tidak ada tenant lain yang terdaftar. Terima Kasih.</div>
                <?php endif ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom30 news-related">
                <h4 class="news-title">Blog Tenant <?php echo strtoupper($tenantdata->name_tenant); ?></h4>
                <?php if( !empty($blogtenants) ) : ?>
                    <?php foreach($blogtenants AS $row){ ?>
                        <h5><a href="<?php echo base_url('tenant/blogtenant/detail/'.$row->uniquecode.''); ?>"><?php echo strtoupper($row->title); ?></a></h5>
                    <?php } ?>
                <?php else :  ?>
                    <div class="alert alert-info">Saat ini sedang tidak ada blog tenant. Terima Kasih.</div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
