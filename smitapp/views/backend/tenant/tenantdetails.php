<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Detail Tenant</h2>
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
                                    <i class="material-icons">face</i> AKUN
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
                                <!-- Profile Image -->
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $logo; ?>" alt="Logo Tenant" />
                                        <h3 class="profile-username text-center"><?php echo $tenantdata->name; ?></h3>
                                        <?php echo form_open_multipart( 'tenant/tenantlogo', array( 'id'=>'tenantlogo', 'role'=>'form' ) ); ?>
                                            <div class="form-group">
                                                <p align="justify">
                                                    <strong>Perhatian!</strong>
                                                    File yang dapat di upload adalah dengan Ukuran Maksimal 1 MB dan format File adalah <strong>jpg/jpeg/png.</strong>
                                                </p>
                                                <input type="hidden" name="tenant_username" value="<?php echo $tenantdata->username; ?>" />
                                                <div class="form-group">
                                                    <label>Unggah Logo</label>
                                                    <input id="tenant_logo_files" name="tenant_logo_files" class="form-control" type="file" />
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm bg-blue waves-effect">Ganti Logo</button>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="info">
                                <?php echo form_open_multipart( 'tenant/tenantdetailedit', array( 'id'=>'tenantdetails', 'role'=>'form' ) ); ?>
                                    <h4><p>Berikut adalah detail data Tenant anda</p></h4>
                                    <!-- Usulan Kegiatan -->
                                    <div class="form-group">
                                        <label class="form-label">Usulan Kegiatan Inkubasi <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                            <select class="form-control show-tick" name="tenant_reg_event" id="tenant_reg_event">
                                                <?php
                                                    $conditions     = ' WHERE %user_id% = '.$user->id.'';
                                                    if( !empty($is_admin) ){
                                                        $conditions = '';
                                                    }
                    	                        	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions);
                    	                            if( !empty($incubation_list) ){
                    	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
                    	                                foreach($incubation_list as $row){
                                                            echo '<option value="'.$row->id.'" '.( $row->id == $tenantdata->incubation_id ? 'selected' : '').'>'.strtoupper($row->event_title).'</option>';
                    	                                }
                    	                            }else{
                    	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                    	                            }
                    	                        ?>
                                            </select>
                                        </div>
                                    </div>
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
                                <?php echo form_close(); ?>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="team">
                            
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</div>
<!-- END Content -->