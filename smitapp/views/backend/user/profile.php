<?php 
    $the_user       = !empty( $user_other ) && $user_other->type != ADMINISTRATOR ? $user_other : $user; 
    $status         = $the_user->type;
    if($status == ADMINISTRATOR){
        $status     = 'ADMINISTRATOR';
    }elseif($status == PENGUSUL){
        $status     = 'PENGUSUL';
    }elseif($status == PENDAMPING){
        $status     = 'PENDAMPING';
    }elseif($status == JURI){
        $status     = 'JURI';
    }elseif($status == TENANT){
        $status     = 'TENANT';
    }else{
        $status     = 'PELAKSANA';
    }
    
    $access         = $is_admin || ($the_user->id == $user->id) ? TRUE : FALSE;
?>  

<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Profil <?php echo ( $the_user->id == $user->id ? 'Anda' : 'Anggota '.strtoupper($the_user->name) )?></h2></div>
            <div class="body">
                <div class="row">
                    <!-- Profile -->
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#account" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">home</i> AKUN
                                </a>
                            </li>
                            <li>
                                <a href="#info" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">account_box</i> INFORMASI PRIBADI
                                </a>
                            </li>
                            <li>
                                <a href="#job" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">account_balance</i> INFORMASI PEKERJAAN
                                </a>
                            </li>
                            <?php if($access){ ?>
                            <li>
                                <a href="#change_password" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">style</i> UBAH KATA SANDI
                                </a>
                            </li>
                            <li>
                                <a href="#user_role" class="tab-profile" data-toggle="tab">
                                    <i class="material-icons">view_list</i> UBAH TIPE PENGGUNA
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
    
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="account">
                                <!-- Profile Image -->
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $avatar; ?>" alt="Avatar Pengguna" />
                                        <h3 class="profile-username text-center" id="profile_username"><?php echo $the_user->name; ?></h3>
                                        <p class="text-muted text-center"><?php echo $status; ?></p>
                                        
                                        <?php if( $access ){ ?>
                                            <?php echo form_open_multipart( 'user/accountsetting', array( 'id'=>'accountsetting', 'role'=>'form' ) ); ?>
                                                <div class="form-group">
                                                    <p align="justify">
                                                        <strong>Perhatian!</strong>
                                                        File yang dapat di upload adalah dengan Ukuran Maksimal 1 MB dan format File adalah <strong>jpg/jpeg/png.</strong>
                                                    </p>
                                                    <input type="hidden" name="username" value="<?php echo $the_user->username; ?>" />
                                                    <div class="form-group">
                                                        <label>Unggah Avatar</label>
                                                        <input id="ava_selection_files" name="ava_selection_files" class="form-control" type="file" />
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-warning btn-sm waves-effect">Ganti Avatar</button>
                                            <?php echo form_close(); ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade in" id="info">
                                <?php echo form_open( 'user/personalinfo', array( 'id'=>'personal', 'role'=>'form', 'enctype'=>'multipart/form-data' ) ); ?>
                                    <div class="alert alert-danger text-center display-hide error-validate">
                            			<small><span>Ada kesalahan dalam pengisian formulir di bawah</span></small>
                            		</div>
                                    <div class="input-group">
                                        <label class="form-label">Username Pengguna</label>
                                        <div class="form-line">
                                            <?php if( !empty($user_other) && $user_other->type != ADMINISTRATOR ): ?>
                                            <input type="hidden" name="user_id" value="<?php echo $user_other->id; ?>" />
                                            <?php endif ?>
                                            <input type="hidden" name="up_username" placeholder="Username" value="<?php echo $the_user->username; ?>" />
                                            <input type="text" class="form-control" id="up_username" disabled="" value="<?php echo $the_user->username; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Name *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_name" id="up_name" value="<?php echo strtoupper($the_user->name); ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Email *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_email" id="up_email" value="<?php echo $the_user->email; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Telp/HP *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_phone" id="up_phone" value="<?php echo $the_user->phone; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Alamat *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_address" id="up_address" value="<?php echo $the_user->address; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <?php
                                            $user_province      = $the_user->province;
                                            $province           = smit_provinces();
                                        ?>
                                        <label class="form-label">Provinsi *</label>
                                        <select class="form-control show-tick" name="up_province" id="province-select" 
                                        <?php echo ( !empty($user_other) && !$is_admin ? 'readonly="readonly"' : '' ); ?> 
                                        data-url="<?php echo base_url('selectprovince'); ?>">
            	                        	<?php
                                                echo '<option value="">-- Pilih Propinsi --</option>';
                                                if( !empty($province) ){
                                                    foreach($province as $p){
                                                        echo '<option value="'.$p->province_id.'" '.( $user_province == $p->province_id ? 'selected="selected"' : '' ).'>'.$p->province_name.'</option>';
                                                    }
                                                }
                                            ?>  
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <?php
                                            $user_city          = $the_user->city;
                                            $cities             = smit_cities_by_provinces($user_province);
                                        ?>
                                        <label class="form-label">Kota/Kabupaten *</label>
                                        <select class="form-control show-tick" name="up_regional" id="regional-select" 
                                        <?php echo ( empty($user_city) ? 'disabled="disabled"' : '' ); ?>>
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                            <?php 
                                                if( !empty($user_city) ){
                                                    foreach($cities as $c){
                                                        echo '<option value="'.$c->regional_id.'" '.( $user_city == $c->regional_id ? 'selected="selected"' : '' ).'>'.$c->regional_name.'</option>';
                                                    }
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Kecamatan/Kelurahan *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_district" id="up_district" value="<?php echo $the_user->district; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <?php
                                            $user_gender        = $the_user->gender;
                                        ?>
                                        <label class="form-label">Jenis Kelamin *</label>
                                        <select class="form-control show-tick" name="up_gender">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="<?php echo GENDER_MALE; ?>" <?php echo $user_gender == GENDER_MALE ? 'selected="selected"' : '' ?>>PRIA</option>
                                            <option value="<?php echo GENDER_FEMALE; ?>" <?php echo $user_gender == GENDER_FEMALE ? 'selected="selected"' : '' ?>>WANITA</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Tempat Lahir *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_birthplace" id="up_birthplace" value="<?php echo $the_user->birthplace; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Tanggal Lahir *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" name="up_birthdate" id="up_birthdate" value="<?php echo $the_user->birthdate == "0000-00-00" ? '' : $the_user->birthdate; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <?php
                                            $user_religion       = $the_user->religion;
        		                        ?>
                                        <label class="form-label">Agama *</label>
                                        <select class="form-control show-tick" name="up_religion">
                                            <option value="">-- Pilih Agama --</option>
                                            <option value="1" <?php echo $user_religion == 1 ? 'selected="selected"' : '' ?>>ISLAM</option>
                                            <option value="2" <?php echo $user_religion == 2 ? 'selected="selected"' : '' ?>>KRISTEN PROTESTAN</option>
                                            <option value="3" <?php echo $user_religion == 3 ? 'selected="selected"' : '' ?>>KRISTEN KATOLIK</option>
                                            <option value="4" <?php echo $user_religion == 4 ? 'selected="selected"' : '' ?>>HIDNU</option>
                                            <option value="5" <?php echo $user_religion == 5 ? 'selected="selected"' : '' ?>>BUDHA</option>
                                            <option value="6" <?php echo $user_religion == 6 ? 'selected="selected"' : '' ?>>KONGHUCHU</option>
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <?php
                                            $user_marital       = $the_user->marital_status;
                                        ?>
                                        <label class="form-label">Status Pernikahan *</label>
                                        <select class="form-control show-tick" name="up_marital_status" id="up_marital_status">
                                            <option value="">-- Pilih Status Pernikahan --</option>
                                            <option value="0" <?php echo $user_marital == 0 ? 'selected="selected"' : '' ?>>BELUM MENIKAH</option>
                                            <option value="1" <?php echo $user_marital == 1 ? 'selected="selected"' : '' ?>>MENIKAH</option>
                                        </select>
                                    </div>
                                    <?php if($access){ ?>
                                    <button type="submit" class="btn btn-warning waves-effect">Perbaharui</button>
                                    <?php } ?>
                                <?php echo form_close(); ?>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="job">
                                <?php echo form_open( 'user/jobinfo', array( 'id'=>'jobupdate', 'role'=>'form', 'enctype'=>'multipart/form-data' ) ); ?>
                                    <div class="alert alert-danger text-center display-hide error-validate">
                            			<small><span>Ada kesalahan dalam pengisian formulir di bawah</span></small>
                            		</div>
                                    <?php if( !empty($user_other) && $user_other->type != ADMINISTRATOR ): ?>
                                    <input type="hidden" name="user_id" value="<?php echo $user_other->id; ?>" />
                                    <?php endif ?>
                                    <input type="hidden" name="up_username" placeholder="Username" value="<?php echo $the_user->username; ?>" />
                                    <div class="input-group">
                                        <label class="form-label">Nomor Induk Pegawai *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_nip" id="up_nip" value="<?php echo $the_user->nip == 0 ? '' : $the_user->nip; ?>" maxlength="18" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label">Jabatan *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="up_position" id="up_position" value="<?php echo $the_user->position; ?>" required>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label class="form-label"> Satuan Kerja *</label>
                                        <?php
            	                        	$workunit_type = smit_workunit_type();
                                            $option = array('' => '-- Pilih Satuan Kerja --');
                                            $extra = 'class="form-control show-tick" id="workunit_type"';
                                            $selected = array();
            
            	                            if( !empty($workunit_type) ){
            	                                foreach($workunit_type as $val){
                                                    $option[$val->workunit_id] = $val->workunit_name;
                                                    if( $the_user->workunit == $val->workunit_id ) $selected[] = $val->workunit_id;
            	                                }
            	                            }
                                            echo form_dropdown('workunit_type',$option,$selected,$extra);
            	                        ?>
                                    </div>
                                    <?php if($access){ ?>
                                    <button type="submit" class="btn btn-warning waves-effect">Perbaharui</button>
                                    <?php } ?>
                                <?php echo form_close(); ?>
                            </div>
                            
                            <?php if($access){ ?>
                            <div role="tabpanel" class="tab-pane fade" id="change_password">
                                <?php if( !empty($user_other) ){ ?>
                                    <?php if( $is_admin ){ ?>
                                        <?php echo form_open( base_url('user/changepassword'), array( 'id'=>'changepassword', 'role'=>'form' ) ); ?>
                                            <div class="alert alert-danger text-center display-hide error-validate">
                                    			<small><span>Ada kesalahan dalam pengisian formulir di bawah</span></small>
                                    		</div>
                                            
                                            <input type="hidden" name="id_user_other" value="<?php echo $user_other->id; ?>" />
                                            <input type="hidden" name="username_other" value="<?php echo $user_other->username; ?>" />
                                            
                                            <div class="callout callout-info">
                                                <h4 class="block">Reset password anggota</h4>
                                                <p>Password <strong><?php echo $user_other->username; ?></strong> akan di atur ulang ke password global. </p>
                                                <p>
                                                    <a class="btn btn-success no-decoration" data-toggle="modal" href="#reset_pass"> Reset Password </a>
                                                </p>
                                            </div>
                                        <?php echo form_close(); ?>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php echo form_open( base_url('user/changepassword'), array( 'id'=>'changepassword', 'role'=>'form' ) ); ?>
                                        <div class="alert alert-danger text-center display-hide error-validate">
                                			<small><span>Ada kesalahan dalam pengisian formulir di bawah</span></small>
                                		</div>
            	                        <div class="form-group">
                                            <label class="form-label">Kata Sandi Lama Anda *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                                <div class="form-line">
                                                    <?php echo form_password('cur_pass','',array('id'=>'cur_pass','class'=>'form-control','placeholder'=>'Kata Sandi Lama Anda')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Kata Sandi Baru Anda *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                                <div class="form-line">
                                                    <?php echo form_password('new_pass','',array('id'=>'new_pass','class'=>'form-control','placeholder'=>'Kata Sandi Baru Anda')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Ulangi Kata Sandi Anda *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="material-icons">lock</i></span>
                                                <div class="form-line">
                                                    <?php echo form_password('cnew_pass','',array('class'=>'form-control','placeholder'=>'Ulangi Kata Sandi Baru Anda')); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning waves-effect">Perbaharui</button>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="user_role">
                                <?php if( $the_user->id == $user->id ){ ?>
                                <div class="alert bg-teal">
                                    Silahkan klik salah satu role dibawah ini untuk login sebagai role yang dipilih!<br />
                                    <h4 class="top15 bottom5"><strong>Perhatian!</strong></h4>
                                    Role yang dipilih akan menjadi default role ketika Anda login.
                                </div>
                                <?php } ?>
                                
                                <label class="form-label">Tipe <?php echo ( !empty($user_other) ? 'Pengguna '.strtoupper($user_other->name) : 'Anda' ); ?> saat ini adalah : </label>
                                <div class="input-group">
                                    <div class="form-line">
                                    <?php
                                        $cfg_usertype   = config_item('user_type');
                                        $current_roles  = $the_user->role;
                                        $current_roles  = maybe_unserialize($current_roles);
                                        if( !empty($current_roles) ){
                                            $roles      = explode(',',$current_roles);
                                            foreach($roles as $key => $type){
                                                if( $type == ADMINISTRATOR )        { $roletxt = 'Administrator'; $bg = 'bg-blue'; }
                                                elseif( $type == PENDAMPING )       { $roletxt = 'Pendamping'; $bg = 'bg-green'; }
                                                elseif( $type == TENANT )           { $roletxt = 'Tenant'; $bg = 'bg-purple'; }
                                                elseif( $type == JURI )             { $roletxt = 'Juri'; $bg = 'bg-orange'; }
                                                elseif( $type == PENGUSUL )         { $roletxt = 'Pengusul'; $bg = 'bg-red'; }
                                                elseif( $type == PELAKSANA )        { $roletxt = 'Pelaksana'; $bg = 'bg-teal'; }
                                                elseif( $type == PELAKSANA_TENANT ) { $roletxt = 'Pelaksana &amp; Tenant'; $bg = 'bg-deep-orange'; }
                                                
                                                echo '<button class="btn '.$bg.' btn-role waves-effect top10 bottom20" type="button" data-role="'.$type.'" 
                                                '.( $the_user->id != $user->id ? 'disabled="disabled"' : "" ).' data-url="'.base_url('gantirole').'">'.$roletxt.'</button> ';
                                            }
                                        }else{
                                            echo '<div class="alert alert-warning top10">'.( !empty($user_other) ? 'Pengguna '.strtoupper($user_other->name) : 'Anda' ).' tidak memiliki role</div>';
                                        }
                                    ?>
                                    </div>
                                </div>

                                <?php if( $user->type == ADMINISTRATOR ){ ?>
                                    <?php echo form_open_multipart( 'pengguna/profil', array( 'id'=>'userrolesetting', 'role'=>'form' ) ); ?>
                                        <label class="form-label">Ubah Role <?php echo ( !empty($user_other) ? 'Pengguna '.strtoupper($user_other->name) : 'Anda' ); ?></label>
                                        <input type="hidden" name="user_role_id" value="<?php echo $the_user->id; ?>" />
                                        <select id="user_role_select" name="user_role_select[]" class="ms" multiple="multiple">
                                            <?php
                                                if( !empty($current_roles) ){
                                                    $roles = explode(',',$current_roles);
                                                }
                                            
                                                foreach($cfg_usertype as $key => $usertype){
                                                    echo '<option value="'.$key.'" '.( in_array($key,$roles) ? 'selected="selected"' : '' ).'>'.$usertype.'</option>';
                                                }
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-warning btn-sm waves-effect top30">Ubah Tipe Pengguna</button>
                                    <?php echo form_close(); ?>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->


<!-- BEGIN INFORMATION SUCCESS SAVE ACCOUNT MODAL -->
<div class="modal fade" id="save_account" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Perbaharui Data Akun Anda</h4>
			</div>
			<div class="modal-body">
                <p>Berhasil memperbaharui data akun anda</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_account" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE ACCOUNT MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE PROFILE MODAL -->
<div class="modal fade" id="save_profile" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Perbaharui Data Profil <?php echo ( !empty($user_other) ? 'Anggota '.$user_other->name : 'Anda' ); ?></h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan memperbaharui data profil <?php echo ( !empty($user_other) ? 'Anggota '.$user_other->name : 'Anda' ); ?> ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_profile" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE PROFILE MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE JOB MODAL -->
<div class="modal fade" id="save_job" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Perbaharui Data Job Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan memperbaharui data pekerjaan anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_job" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE JOB MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE CHANGEPASSWORD MODAL -->
<div class="modal fade" id="save_changepassword" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Perbaharui Kata Sandi Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan memperbaharui kata sandi anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_changepassword">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE CHANGEPASSWORD MODAL -->

<!-- BEGIN INFORMATION RESET PASSWORD MODAL -->
<div class="modal fade" id="reset_pass" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Reset Kata Sandi Anggota</h4>
			</div>
			<div class="modal-body">
                Anda yakin akan mengatur ulang password untuk anggota <strong><?php echo smit_isset($user_other->username,''); ?></strong>?
            </div>
			<div class="modal-footer">
				<button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_reset_pass">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION RESET PASSWORD MODAL -->
