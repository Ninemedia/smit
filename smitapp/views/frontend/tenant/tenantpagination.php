<?php if( $tenantdata || !empty($tenantdata) ){ ?>
    <div class="row">
    <?php foreach($tenantdata as $tenant){ ?>
        <?php $name = character_limiter($tenant->name_tenant,30); ?>
        <?php
            $city           = $this->Model_Address->get_cities($tenant->city);
            $city           = $city->regional_name;
            $province       = $this->Model_Address->get_provinces($tenant->province);
            $province       = $province->province_name;
            
            $address        = $tenant->address;
            $address       .= ' '.$city;
            $address       .= ' '.$tenant->district;
            $address       .= ' PROVINSI '.$province;
        ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bottom30">
            <div class="media">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="media-left">
                            <a href="<?php echo base_url('tenant/detail/'.$tenant->slug.''); ?>">
                                <img class="js-animating-object img-responsive media-object"
                                src="<?php echo BE_UPLOAD_PATH . 'incubationtenant/'.$tenant->uploader.'/'.$tenant->filename.'.'.$tenant->extension; ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <a href="<?php echo base_url('tenant/detail/'.$tenant->slug.''); ?>" class="media-heading-link"><?php echo $name; ?></a>
                        <div class="media-date"><i class="icon-calendar"></i> <?php echo $tenant->year; ?></div>
                        <i class="icon-address"></i> <?php echo $address; ?><br />
                        <i class="icon-message"></i> <?php echo $tenant->email; ?><br />
                        <i class="icon-phone"></i> <?php echo $tenant->phone; ?><br />
                        <a href="<?php echo base_url('tenant/detail/'.$tenant->slug.''); ?>" class="listdetailtenant waves-effect"><strong>Selengkapnya</strong></a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
<?php }else{ ?>
    <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
<?php } ?>
<div class="text-center"><?php echo $this->ajax_pagination->create_links(); ?></div>