<?php
    $the_user       = !empty( $user_other ) && $user_other->type != ADMINISTRATOR ? $user_other : $user;
?>

<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pendaftaran Tenant</h2></div>
            <div class="body">
                <?php if( !empty($is_admin) ) : ?>
                    <div class="row clearfix">
                        <!--
                        <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo $avatar; ?>" alt="Logo Tenant" />
                                    <p class="text-muted text-center"></p>
                                    <?php echo form_open_multipart( 'tenant/logotenant', array( 'id'=>'logotenant', 'role'=>'form' ) ); ?>
                                    <input type="hidden" name="username" value="<?php echo $the_user->username; ?>" />
                                    <div class="form-group">
                                        <label>Logo Tenant</label>
                                        <input id="avatar_company" name="avatar_company" class="form-control" type="file" />
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block bg-blue waves-effect">Ganti Logo</button>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="col-md-12">
                            <?php echo form_open_multipart( 'tenant/addtenant', array( 'id'=>'addtenant', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>

                            <h4><p>Silahkan lengkapi isian data Tenant anda</p></h4>
                            <div class="form-group">
                                <label class="form-label">Usulan Kegiatan Inkubasi<b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                    <select class="form-control show-tick" name="reg_event" id="reg_event">
                                        <?php
                                            $conditions     = ' WHERE %user_id% = '.$user->id.'';
                                            if( !empty($is_admin) ){
                                                $conditions = '';
                                            }
            	                        	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions);
            	                            if( !empty($incubation_list) ){
            	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
            	                                foreach($incubation_list as $row){
                                                    echo '<option value="'.$row->id.'">'.strtoupper($row->event_title).'</option>';
            	                                }
            	                            }else{
            	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
            	                            }
            	                        ?>
                                    </select>
                                </div>
                            </div>
                            <label for="name_contact">Nama Tenant<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                <div class="form-line">
                                    <?php echo form_input('tenant_name','',array('class'=>'form-control tenant_name','placeholder'=>'Nama Tenant Anda','required'=>'required')); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="email_contact">Email Tenant<b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">email</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_email','',array('class'=>'form-control tenant_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="name_contact">Tahun Berdiri<b style="color: red !important;">(*)</b></label>
                                    <!--
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_year','',array('class'=>'form-control company_year','placeholder'=>'Tahun Berdiri Tenant Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                    -->
                                    <div class="input-group">
                                        <?php
                                            $option = array(''=>'Pilih Tahun');
                                            $year_arr = smit_select_year(1900,2030);
                                            //$extra = 'class="form-control def" id="tenant_year"';

                                            if( !empty($year_arr) ){
                                                foreach($year_arr as $val){
                                                    $option[$val] = $val;
                                                }
                                            }
                                            echo form_dropdown('tenant_year', $option, '');
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <label for="name_contact">Alamat Tenant<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">place</i></span>
                                <div class="form-line">
                                    <?php echo form_input('tenant_address','',array('class'=>'form-control company_address','placeholder'=>'Alamat Tenant Anda','required'=>'required')); ?>
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
                                                echo '<option value="'.$p->province_id.'">'.$p->province_name.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">place</i></span>
                                <select class="form-control show-tic province" name="tenant_regional" id="regional-select" disabled="disabled">
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">place</i></span>
                                <div class="form-line">
                                    <?php echo form_input('tenant_district','',array('class'=>'form-control tenant_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                </div>
                            </div>

                            <label for="telp_contact">Kontak</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                <div class="form-line">
                                    <?php echo form_input('tenant_phone_contact','',array('class'=>'form-control tenant_phone_contact','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                </div>
                            </div>
                            <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya)<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                <div class="form-line">
                                    <?php echo form_input('tenant_legal','',array('class'=>'form-control tenant_legal','placeholder'=>'Nomor Legalitas Usaha Anda','required'=>'required')); ?>
                                </div>
                            </div>
                            <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                <div class="form-line">
                                    <?php echo form_input('tenant_bussiness','',array('class'=>'form-control tenant_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                </div>
                            </div>
                            <label for="telp_contact">Kemitraan Usaha yang Dimiliki<b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <div class="form-line">
                                    <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Kegiatan Anda" id="tenant_mitra" name="tenant_mitra" required></textarea>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <strong>Perhatian!</strong>
                                File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                            </div>
                            <div class="form-group">
                                <label>Logo Tenant<b style="color: red !important;">(*)</b></label>
                                <input id="avatar_selection_files" name="avatar_selection_files" class="form-control" type="file" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary waves-effect" <?php echo ( !empty($member_other) && !$is_admin ? 'readonly="readonly"' : '' ); ?>>Simpan</button>
                                <button class="btn btn-sm btn-danger waves-effect" id="btn_addtenant_reset" type="button">Bersihkan </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                <?php else :  ?>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#business" data-toggle="tab">
                            <i class="material-icons">store_mall_directory</i> USAHA & PERUSAHAAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#team" data-toggle="tab">
                            <i class="material-icons">people</i> TIM
                        </a>
                    </li>
                    <!--
                    <li role="presentation">
                        <a href="#contact" data-toggle="tab">
                            <i class="material-icons">contacts</i> KONTAK
                        </a>
                    </li>
                    -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="business">
                        <?php if( empty($tenant) ): ?>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <p>Silahkan lengkapi isian data perusahaan anda</p>
                                    <div class="alert alert-info">
                                        <strong>Perhatian!</strong>
                                        File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Profile Image -->
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle" src="<?php echo $avatar; ?>" alt="Logo Tenant" />
                                            <p class="text-muted text-center"></p>
                                            <?php echo form_open_multipart( 'tenant/logotenant', array( 'id'=>'logotenant', 'role'=>'form' ) ); ?>
                                            <input type="hidden" name="username" value="<?php echo $the_user->username; ?>" />
                                            <div class="form-group">
                                                <label>Logo Tenant</label>
                                                <input id="avatar_company" name="avatar_company" class="form-control" type="file" />
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block bg-blue waves-effect">Ganti Logo</button>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <?php echo form_open( 'tenant/addtenant', array( 'id'=>'addtenant', 'role'=>'form', 'enctype'=>'multipart/form-data' ) ); ?>
                                    <div id="alert" class="alert display-hide"></div>

                                    <label for="name_contact">Nama Tenant</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_name','',array('class'=>'form-control tenant_name','placeholder'=>'Nama Tenant Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="email_contact">Email Tenant</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="material-icons">email</i></span>
                                                <div class="form-line">
                                                    <?php echo form_input('tenant_email','',array('class'=>'form-control tenant_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="name_contact">Tahun Berdiri</label>
                                            <!--
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                <div class="form-line">
                                                    <?php echo form_input('tenant_year','',array('class'=>'form-control company_year','placeholder'=>'Tahun Berdiri Tenant Anda','required'=>'required')); ?>
                                                </div>
                                            </div>
                                            -->
                                            <div class="input-group">
                                                <?php
                                                    $option = array(''=>'Pilih Tahun');
                                                    $year_arr = smit_select_year(1900,2030);
                                                    //$extra = 'class="form-control def" id="tenant_year"';

                                                    if( !empty($year_arr) ){
                                                        foreach($year_arr as $val){
                                                            $option[$val] = $val;
                                                        }
                                                    }
                                                    echo form_dropdown('tenant_year', $option, '');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="name_contact">Alamat Tenant</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_address','',array('class'=>'form-control company_address','placeholder'=>'Alamat Tenant Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <select class="form-control show-tick province" name="province" id="province-select" data-url="<?php echo base_url('selectprovince'); ?>">
            	                        	<?php
                                                $province = smit_provinces();
                                                echo '<option value="">-- Pilih Propinsi --</option>';
                                                if( !empty($province) ){
                                                    foreach($province as $p){
                                                        echo '<option value="'.$p->province_id.'">'.$p->province_name.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <select class="form-control show-tic province" name="province" id="regional-select" disabled="disabled">
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_district','',array('class'=>'form-control tenant_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                        </div>
                                    </div>

                                    <label for="telp_contact">Kontak</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_phone_contact','',array('class'=>'form-control tenant_phone_contact','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                        </div>
                                    </div>
                                    <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_legal','',array('class'=>'form-control tenant_legal','placeholder'=>'Legalitas Usaha Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                    <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_bussiness','',array('class'=>'form-control tenant_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                        </div>
                                    </div>
                                    <label for="telp_contact">Kemitraan Usaha yang Dimiliki</label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Kegiatan Anda" id="tenant_mitra" name="tenant_mitra" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary waves-effect" <?php echo ( !empty($member_other) && !$is_admin ? 'readonly="readonly"' : '' ); ?>>Simpan</button>
                                        <button class="btn btn-sm btn-danger waves-effect" type="button">
                                            <i class="material-icons">close</i> Bersihkan
                                        </button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>

                        <?php else : ?>
                            <?php if( $tenant->status != 0 ): ?>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <p>Silahkan lengkapi isian data perusahaan anda</p>
                                        <div class="alert alert-info">
                                            <strong>Perhatian!</strong>
                                            File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Profile Image -->
                                        <div class="box box-primary">
                                            <div class="box-body box-profile">
                                                <img class="profile-user-img img-responsive img-circle" src="<?php echo $avatar; ?>" alt="Logo Tenant" />
                                                <p class="text-muted text-center"></p>
                                                <?php echo form_open_multipart( 'tenant/logotenant', array( 'id'=>'logotenant', 'role'=>'form' ) ); ?>
                                                <input type="hidden" name="username" value="<?php echo $the_user->username; ?>" />
                                                <div class="form-group">
                                                    <label>Logo Tenant</label>
                                                    <input id="avatar_company" name="avatar_company" class="form-control" type="file" />
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block bg-blue waves-effect">Ganti Logo</button>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <?php echo form_open( 'tenant/addtenant', array( 'id'=>'addtenant', 'role'=>'form', 'enctype'=>'multipart/form-data' ) ); ?>
                                        <div id="alert" class="alert display-hide"></div>

                                        <label for="name_contact">Nama Tenant</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_name','',array('class'=>'form-control tenant_name','placeholder'=>'Nama Tenant Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <label for="email_contact">Email Tenant</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                                    <div class="form-line">
                                                        <?php echo form_input('tenant_email','',array('class'=>'form-control tenant_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="name_contact">Tahun Berdiri</label>
                                                <!--
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <?php echo form_input('tenant_year','',array('class'=>'form-control company_year','placeholder'=>'Tahun Berdiri Tenant Anda','required'=>'required')); ?>
                                                    </div>
                                                </div>
                                                -->
                                                <div class="input-group">
                                                    <?php
                                                        $option = array(''=>'Pilih Tahun');
                                                        $year_arr = smit_select_year(1900,2030);
                                                        //$extra = 'class="form-control def" id="tenant_year"';

                                                        if( !empty($year_arr) ){
                                                            foreach($year_arr as $val){
                                                                $option[$val] = $val;
                                                            }
                                                        }
                                                        echo form_dropdown('tenant_year', $option, '');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <label for="name_contact">Alamat Tenant</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_address','',array('class'=>'form-control company_address','placeholder'=>'Alamat Tenant Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <select class="form-control show-tick province" name="province" id="province-select" data-url="<?php echo base_url('selectprovince'); ?>">
                	                        	<?php
                                                    $province = smit_provinces();
                                                    echo '<option value="">-- Pilih Propinsi --</option>';
                                                    if( !empty($province) ){
                                                        foreach($province as $p){
                                                            echo '<option value="'.$p->province_id.'">'.$p->province_name.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <select class="form-control show-tic province" name="province" id="regional-select" disabled="disabled">
                                                <option value="">-- Pilih Kota/Kabupaten --</option>
                                            </select>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">place</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_district','',array('class'=>'form-control tenant_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                            </div>
                                        </div>

                                        <label for="telp_contact">Kontak</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_phone_contact','',array('class'=>'form-control tenant_phone_contact','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_legal','',array('class'=>'form-control tenant_legal','placeholder'=>'Legalitas Usaha Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_bussiness','',array('class'=>'form-control tenant_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="telp_contact">Kemitraan Usaha yang Dimiliki</label>
                                        <div class="form-group">
                                            <textarea class="form-control ckeditor" id="tenant_mitra" name="tenant_mitra" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary waves-effect" <?php echo ( !empty($member_other) && !$is_admin ? 'readonly="readonly"' : '' ); ?>>Simpan</button>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <strong>Perhatian!</strong>
                                            Pengajuan data tenant anda sedang di proses oleh administrator. Harap menunggu konfirmasi dari Administrator.
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="team">
                        <?php if( $tenant->status == 1 ) :?>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p>Silahkan lengkapi isian data perusahaan anda</p>
                                <div class="alert alert-info">
                                    <strong>Perhatian!</strong>
                                    File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else : ?>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <strong>Perhatian!</strong>
                                        Pengajuan data tenant anda sedang di proses oleh administrator. Harap menunggu konfirmasi dari Administrator.
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!--
                    <div role="tabpanel" class="tab-pane fade" id="contact">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p>Silahkan lengkapi isian data perusahaan anda</p>
                                <div class="alert alert-info">
                                    <strong>Perhatian!</strong>
                                    File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name_contact">Foto</label>
                            </div>
                            <div class="col-md-8">
                                <label for="name_contact">Nama Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Telp Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('phone_contact','',array('class'=>'form-control mobile-phone-number','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="email_contact">Email Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('email_contact','',array('class'=>'form-control','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE TENANT MODAL -->
<div class="modal fade" id="save_addtenant" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Tenant Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan menambahkan data tenant anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_addtenant" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE TENANT MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE LOGO TENANT MODAL -->
<div class="modal fade" id="save_logotenant" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Logo Tenant Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan memperbaharui logo tenant anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_logotenant" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE LOGO TENANT MODAL -->
