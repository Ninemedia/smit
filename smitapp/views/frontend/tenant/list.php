<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
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
                    <li <?php echo ($active_page2 == 'daftar' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/daftartenant'); ?>">
                            <i class=""></i> <strong>Daftar Tenant</strong>
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
				<h3>Daftar Tenant</h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header">
                    <h4>

                    </h4>
                </div>
                <div class="body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#grid" data-toggle="tab">
                                <i class="material-icons">widgets</i> GRID
                            </a>
                        </li>
                        <li>
                            <a href="#tabel" data-toggle="tab">
                                <i class="material-icons">view_list</i> TABEL
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active tenantgrid" id="grid">
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
                        </div>
                        
                        <div class="tab-pane fade in" id="tabel">
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="list_tenant" data-url="<?php echo base_url('tenant/daftartenantdata'); ?>">
                                    <thead>
                                        <tr role="row" class="heading bg-blue">
                                            <th class="width5">No</th>
                                            <th class="width15 text-center">Nama Tenant</th>
                                            <th class="width20">Alamat</th>
                                            <!--
                                            <th class="width10 text-center">Email</th>
                                            <th class="width10 text-center">Telp</th>
                                            -->
                                            <th class="width10 text-center">Actions<br /></th>
                                        </tr>
                                        <tr role="row" class="filter table-filter">
                                            <td></td>
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_address" /></td>
                                            <!--
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_email" /></td>
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_phone" /></td>
                                            -->
                                            <td style="text-align: center;">
                                                <button class="btn bg-blue waves-effect filter-submit" id="btn_tenant_list">Search</button>
                                                <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Will Be Placed Here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
		</div>
	</div>
</div>