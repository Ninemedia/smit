<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Detail Inkubasi / Tenant</h2>
                <ul class="header-dropdown" style="top: 15px;">
                    <li>
                        <a class="btn btn-sm btn-default waves-effect back" href="<?php echo base_url('tenants/daftar'); ?>">
                            <i class="material-icons" style="font-size: 16px;">arrow_back</i> Kembali
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="row">
                    <!-- Profile -->
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#logo" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">face</i> LOGO
                                </a>
                            </li>
                            <li>
                                <a href="#info" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">account_box</i> INFORMASI TENANT
                                </a>
                            </li>
                            <li>
                                <a href="#team" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">people</i> INFORMASI TIM
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="logo">
                                <!-- Tenant Logo -->
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <div class="tenant-logo-wrapper"><img class="tenant-logo img-responsive img-circle" src="<?php echo $logo; ?>" alt="Logo Tenant" /></div>
                                        <h3 class="tenant-name text-center bottom35"><?php echo $tenantdata->name_tenant; ?></h3>
                                        <?php echo form_open_multipart( 'tenant/tenantlogo', array( 'id'=>'tenantlogo', 'role'=>'form' ) ); ?>
                                            <div class="form-group">
                                                <p align="justify">
                                                    <strong>Perhatian!</strong>
                                                    File yang dapat di upload adalah dengan Ukuran Maksimal 1 MB dan format File adalah <strong>jpg/jpeg/png.</strong>
                                                </p>
                                                <input type="hidden" name="tenant_id" value="<?php echo $tenantdata->id; ?>" />
                                                <div class="form-group">
                                                    <input id="tenant_logo_files" name="tenant_logo_files" class="form-control" type="file" />
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning btn-sm waves-effect">Ganti Logo</button>
                                            <!-- <button type="button" class="btn btn-danger btn-sm bg-red waves-effect btn-clear-logo-tenant">Bersihkan</button> -->
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="info">
                                <?php echo form_open_multipart( 'tenant/tenantlistdetailsedit', array( 'id'=>'tenantdetails', 'role'=>'form' ) ); ?>
                                    <h4><p>Berikut adalah detail data Tenant anda</p></h4>
                                    <input type="hidden" name="tenant_id" value="<?php echo $tenantdata->id; ?>" />
                                    <!-- Nama Tenant -->
                                    <div class="form-group">
                                        <label for="name_contact">Nama Tenant <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_name',$tenantdata->name_tenant,array('class'=>'form-control tenant_name','placeholder'=>'Nama Tenant Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Posisi Tenant -->
                                    <div class="form-group">
                                        <label for="name_contact">Posisi Tenant <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <?php
                                                $position   = $tenantdata->position == 1 ? 'INWALL' : 'OUTWALL'; 
                                            ?>
                                            <span class="input-group-addon"><i class="material-icons">compare_arrows</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_name',$position,array('class'=>'form-control tenant_name','placeholder'=>'Posisi Tenant Anda','disabled'=>'TRUE')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Email Tenant & Tahun Berdiri -->
                                    <div class="row bottom0">
                                        <div class="col-md-7 bottom0">
                                            <div class="form-group">
                                                <label for="email_contact">Email Tenant <b style="color: red !important;">(*)</b></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                                    <div class="form-line">
                                                        <?php echo form_input('tenant_email',$tenantdata->email,array('class'=>'form-control tenant_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 bottom0">
                                            <div class="form-group">
                                                <label for="name_contact">Tahun Berdiri<b style="color: red !important;">(*)</b></label>
                                                <div class="input-group">
                                                    <?php
                                                        $option = array(''=>'Pilih Tahun');
                                                        $year_arr = smit_select_year(1900,2030);

                                                        if( !empty($year_arr) ){
                                                            foreach($year_arr as $val){
                                                                $option[$val] = $val;
                                                            }
                                                        }
                                                        echo form_dropdown('tenant_year', $option, array($tenantdata->year));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Alamat Tenant -->
                                    <div class="form-group">
                                        <label for="name_contact">Alamat Tenant <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_address',$tenantdata->address,array('class'=>'form-control company_address','placeholder'=>'Alamat Tenant Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <select class="form-control show-tick province" name="tenant_province" id="province-select" data-url="<?php echo base_url('selectprovince'); ?>">
                	                        	<?php
                                                    $province = smit_provinces();
                                                    echo '<option value="">-- Pilih Propinsi --</option>';
                                                    if( !empty($province) ){
                                                        foreach($province as $p){
                                                            echo '<option value="'.$p->province_id.'" '.($tenantdata->province == $p->province_id ? 'selected' : '').'>'.$p->province_name.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <select class="form-control show-tic province" name="tenant_regional" id="regional-select" <?php echo ($tenantdata->city > 0 ? '' : 'disabled="disabled"'); ?>>
                                                <?php
                                                    $regional = smit_cities_by_provinces($tenantdata->province);
                                                    echo '<option value="">-- Pilih Kota/Kabupaten --</option>';
                                                    if( !empty($regional) ){
                                                        foreach($regional as $r){
                                                            echo '<option value="'.$r->regional_id.'" '.($tenantdata->city == $r->regional_id ? 'selected' : '').'>'.$r->regional_name.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_district',$tenantdata->district,array('class'=>'form-control tenant_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Kontak Tenant -->
                                    <div class="form-group">
                                        <label for="telp_contact">Kontak</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_phone_contact',$tenantdata->phone,array('class'=>'form-control tenant_phone_contact','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Legalitas Tenant -->
                                    <div class="form-group">
                                        <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya) <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_legal',$tenantdata->legal,array('class'=>'form-control tenant_legal','placeholder'=>'Nomor Legalitas Usaha Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Licensing Tenant -->
                                    <div class="form-group">
                                        <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian) <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_bussiness',$tenantdata->licensing,array('class'=>'form-control tenant_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Partnership Tenant -->
                                    <div class="form-group">
                                        <label for="telp_contact">Kemitraan Usaha yang Dimiliki<b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Kegiatan Anda" id="tenant_mitra" name="tenant_mitra" required><?php echo $tenantdata->partnerships; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Description Tenant -->
                                    <div class="form-group">
                                        <label for="telp_contact">Deskripsi Singkat Tenant Anda<b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Tenant Anda" id="tenant_desc" name="tenant_desc" required><?php echo $tenantdata->description; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-sm bg-blue waves-effect">Ubah Data</button>
                                <?php echo form_close(); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="team">
                                <div class="table-container table-responsive">
                                    <div class="table-actions-wrapper">
                						<span></span>
                						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
                							<option value="">Select...</option>
                							<option value="delete">Hapus</option>
                						</select>
                						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
                                        <a href="<?php echo base_url('tenants/tambahtim/'.$tenantdata->uniquecode); ?>" class="btn btn-sm btn-success" >Tambah Tim</a>
                					</div>
                                    <table class="table table-striped table-bordered table-hover" id="list_tenant_team" data-url="<?php echo base_url('tenant/tenantteamlistdata/'.$tenantdata->id); ?>">
                                        <thead>
                    						<tr role="row" class="heading bg-blue">
                                                <th class="width5 text-center"><input name="select_all" id="list_tenant_team_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="list_tenant_team_all"></label></th>
                    							<th class="width5">No</th>
                    							<th class="width15">Nama Anggota</th>
                    							<th class="width15">Posisi</th>
                                                <th class="width10 text-center">Foto</th>
                    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
                    						</tr>
                                            <tr role="row" class="filter display-hide table-filter">
                    							<td></td>
                                                <td></td>
                    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                                <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_position" /></td>
                                                <td></td>
                    							<td style="text-align: center;">
                                                    <div class="bottom5">
                    								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_tenant_team">Search</button>
                                                    </div>
                                                    <button class="btn bg-red waves-effect filter-cancel" id="btn_list_tenant_team_reset">Reset</button>
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
</div>
<!-- END Content -->

<!-- BEGIN TENANT TEAM EDIT MODAL -->
<div class="modal fade" id="tenant_team_edit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Anggota Tim Tenant</h4>
			</div>
			<div class="modal-body">
                <!-- ============================ -->
                <!-- ==== Tenant Team Avatar ==== -->
                <!-- ============================ -->
                <div class="tenant-team-ava-wrapper"><!-- Will be place by AJAX response --></div>
                <h3 class="tenant-name text-center bottom35"><!-- Will be place by AJAX response --></h3>
                <div id="alert" class="alert"></div>
                <?php echo form_open_multipart( 'tenant/tenantteamava', array( 'id'=>'tenantteamava', 'role'=>'form' ) ); ?>
                    <div class="form-group">
                        <p align="justify">
                            <strong>Perhatian!</strong>
                            File yang dapat di upload adalah dengan Ukuran Maksimal 1 MB dan format File adalah <strong>jpg/jpeg/png.</strong>
                        </p>
                        <input type="hidden" class="tenant_team_uniquecode" name="tenant_team_uniquecode" value="" />
                        <div class="form-group">
                            <input id="tenant_team_ava_files" name="tenant_team_ava_files" class="form-control" type="file" />
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning btn-sm bg-blue waves-effect">Ganti Avatar</button>
                        <!-- <button type="button" class="btn btn-danger btn-sm bg-red waves-effect btn-clear-tenant-team-ava">Bersihkan</button> -->
                    </div>
                <?php echo form_close(); ?>

                <!-- ============================ -->
                <!-- ===== Tenant Team Data ===== -->
                <!-- ============================ -->
                <?php echo form_open( 'tenant/tenantteamedit', array( 'id'=>'tenantteamedit', 'role'=>'form' ) ); ?>
                <input type="hidden" class="tenant_team_uniquecode_edit" name="tenant_team_uniquecode_edit" value="" />
                <div class="form-group">
                    <label class="form-label" for="team_name_edit">Nama *</label>
                    <div class="input-group">
                        <div class="form-line">
                            <!-- Value Will be place by AJAX response -->
                            <input type="text" class="form-control team_name_edit" name="team_name_edit" id="team_name_edit" value="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="team_position_edit">Jabatan/Posisi/Peran *</label>
                    <div class="input-group bottom0">
                        <div class="form-line">
                            <!-- Value Will be place by AJAX response -->
                            <input type="text" class="form-control team_position_edit" name="team_position_edit" id="team_position_edit" value="">
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect btn-edit-tenant-team">Ubah</button>
			</div>

		</div>
	</div>
</div>
<!-- END TENANT TEAM EDIT MODAL -->
