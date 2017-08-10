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
                        <div class="tab-pane fade in active" id="grid">
                            <?php if( $tenantdata || !empty($tenantdata) ){ ?>
                                <div class="row">
                                <?php foreach($tenantdata as $key => $tenant){ ?>
                                    <?php $desc     = word_limiter($tenant->name_tenant,30); ?>
                                    <?php
                                        $city   = $this->Model_Address->get_cities($tenant->city);
                                        $city   = $city->regional_name;
                                        $province   = $this->Model_Address->get_provinces($tenant->province);
                                        $province   = $province->province_name;
                                        
                                        $address        = $tenant->address;
                                        $address        .= ' '.$city;
                                        $address        .= ' '.$tenant->district;
                                        $address        .= ' PROVINSI '.$province;
                                    ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="media">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <div class="media-left">
                                                        <a href="javascript:void(0);">
                                                            <img class="js-animating-object img-responsive media-object"
                                                            src="<?php echo BE_UPLOAD_PATH . 'incubationtenant/'.$tenant->uploader.'/'.$tenant->filename.'.'.$tenant->extension; ?>" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <a href="<?php echo base_url('frontendberita/detail/'.$tenant->uniquecode.''); ?>" class="media-heading-link"><?php echo $tenant->name_tenant; ?></a>
                                                    <div class="media-date"><i class="icon-calendar"></i> <?php echo $tenant->year; ?></div>
                                                    <i class="icon-address"></i> <?php echo $tenant->address; ?><br />
                                                    <i class="icon-message"></i> <?php echo $tenant->email; ?><br />
                                                    <i class="icon-phone"></i> <?php echo $tenant->phone; ?><br />
                                                    <a class="listdetailtenant waves-effect tooltips" id="btn_list_detailtenant" data-id="<?php echo $tenant->id; ?>" data-name="<?php echo $tenant->name_tenant; ?>" data-address="<?php echo $address; ?>" data-email="<?php echo $tenant->email; ?>" data-phone="<?php echo $tenant->phone; ?>" data-year="<?php echo $tenant->year; ?>" data-legal="<?php echo $tenant->legal; ?>" data-licensing="<?php echo $tenant->licensing; ?>" data-partnerships="<?php echo $tenant->partnerships; ?>"><strong>Selengkapnya</strong></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                                <?php if($counttenant > LIMIT_DEFAULT){ ?>
                                    <a href="<?php echo base_url('tenant/daftartenant'); ?>" class="btn btn-primary top25 pull-right">Berita Lainnya</a>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada berita yang di publikasi. Terima Kasih.</div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade in" id="tabel">
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="list_tenant" data-url="<?php echo base_url('tenant/daftartenantdata'); ?>">
                                    <thead>
                                        <tr role="row" class="heading bg-blue">
                                            <th class="width5">No</th>
                                            <!-- <th class="width5 text-center">Tahun</th> -->
                                            <!-- <th class="width15">Pengguna</th> -->
                                            <th class="width15 text-center">Nama Tenant</th>
                                            <th class="width20">Alamat</th>
                                            <th class="width10 text-center">Email</th>
                                            <th class="width10 text-center">Telp</th>
                                            <th class="width10 text-center">Actions<br /></th>
                                        </tr>
                                        <tr role="row" class="filter table-filter">
                                            <td></td>
                                            <!--
                                            <td>
                                                <select name="search_year" class="form-control form-filter input-sm def">
                                                <?php
                                                    $option = array(''=>'Pilih Tahun');
                                                    $year_arr = smit_select_year(date('Y'),2030);
                                                    if( !empty($year_arr) ){
                                                        foreach($year_arr as $val){
                                                            $option[$val] = $val;
                                                        }
                                                    }
                                                    
                                                    if( !empty($option) ){
                                                        foreach($option as $val){
                                                            echo '<option value="'.$val.'">'.$val.'</option>';
                                                        }
                                                    }else{
                                                        echo '<option value="">Tahun Kosong</option>';
                                                    }
                                                ?>
                                                </select>
                                            </td>
                                            -->
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
                                            <!-- <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td> -->
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_address" /></td>
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_email" /></td>
                                            <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_phone" /></td>
                                            <td style="text-align: center;">
                                                <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_tenant_list">Search</button>
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

<!-- BEGIN INFORMATION SUCCESS DETAIL LIST MODAL -->
<div class="modal fade" id="detail_listtenant" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <button class="btn btn-default waves-effect pull-right" type="button" data-dismiss="modal"><i class="material-icons">close</i></button>
				<h4 class="modal-title">Detail List Tenant</h4>
			</div>
			<div class="modal-body">
                <div class="table-container table-responsive">
                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DETAIL</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Nama Tenant</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_name" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tahun Berdiri</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_year" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Alamat</th>
                                <td style="width: 1%;"> : </td>
                                <td><textarea id="list_address" class="form-control" disabled="TRUE"></textarea></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Email</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_email" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kontak</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_phone" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Bentuk Legalitas Usaha (PT/CV/Lainnya)</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_legal" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_licensing" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kemitraan Usaha yang Dimiliki</th>
                                <td style="width: 1%;"> : </td>
                                <td><textarea id="list_partnerships" class="form-control" disabled="TRUE"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS DETAIL LIST MODAL -->
