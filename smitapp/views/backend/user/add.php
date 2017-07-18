<!-- Welcome Text -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>PENDAFTARAN PENGGUNA BARU</h2></div>
            <div class="body">
                <!-- BEGIN SIGN UP FORM -->
                <?php echo form_open( base_url('registration'), array( 'id'=>'sign-up-form', 'role'=>'form' ) ); ?>
                    <div class="alert alert-danger text-center display-hide error-validate">
            			<small><span>Ada kesalahan dalam pengisian formulir di bawah</span></small>
            		</div>
                    <!-- Data Pengguna -->
                    <h2 class="card-inside-title">Data Pengguna</h2>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                        <select class="form-control show-tick" name="user_type">
                            <?php
	                        	$user_type = smit_user_type();
	                            if( !empty($user_type) ){
	                                echo '<option value="">-- Pilih Tipe Pengguna --</option>';
	                                foreach($user_type as $key => $val){
                                        if( $key != PENGUSUL && $key != TENANT )
	                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
	                                }
	                            }else{
	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
	                            }
	                        ?>
                        </select>
                    </div>
                    <input type="hidden" name="password" value="<?php echo PASSWORD_GLOBAL; ?>" />
                    <input type="hidden" name="password_confirm" value="<?php echo PASSWORD_GLOBAL; ?>" />
                    <input type="hidden" name="access" value="admin" />
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                        <div class="form-line">
                            <?php echo form_input('username','',array('class'=>'form-control','placeholder'=>'Username','required'=>'required','autocomplete'=>'off')); ?>
                        </div>
                    </div>
                    <!-- Data Pribadi -->
                    <h2 class="card-inside-title top35">Data Pribadi</h2>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                        <div class="form-line">
                            <?php echo form_input('name','',array('class'=>'form-control','placeholder'=>'Nama','required'=>'required')); ?>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">wc</i></span>
                        <?php
                            $option = array(
                                '' => '-- Pilih Jenis Kelamin --',
                                'male' => 'PRIA',
                                'female' => 'WANITA'
                            );
                            $extra = 'class="form-control show-tick"';
                            echo form_dropdown('gender',$option,'',$extra);
                        ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">assignment_ind</i></span>
                        <?php
                        	$workunit_type = smit_workunit_type();
                            $option = array('' => '-- Pilih Satuan Kerja --');
                            $extra = 'class="form-control show-tick"';

                            if( !empty($workunit_type) ){
                                foreach($workunit_type as $val){
                                    $option[$val->workunit_id] = $val->workunit_name;
                                }
                            }
                            echo form_dropdown('workunit_type',$option,'',$extra);
                        ?>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">email</i></span>
                        <div class="form-line">
                            <?php echo form_input('email','',array('class'=>'form-control','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">phone</i></span>
                        <div class="form-line">
                            <?php echo form_input('phone','',array('class'=>'form-control mobile-phone-number','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                        </div>
                    </div>
                    <div class="input-group">
            			<div class="g-recaptcha smit-captcha-signup-admin" data-smit-site-key="<?php echo config_item( 'captcha_site_key' ); ?>"></div>
            		</div>

                    <button class="btn btn-lg btn-primary waves-effect" type="submit">Tambah Pengguna</button>
                    <button class="btn btn-lg btn-danger waves-effect" id="btn-reset-useradd" type="button">Bersihkan</button>
                <?php echo form_close(); ?>
                <!-- END SIGN UP FORM -->
            </div>
        </div>
    </div>
</div>
<!-- #END# Welcome Text -->
