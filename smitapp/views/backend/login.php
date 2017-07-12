<!DOCTYPE html>
<html>
    <!-- Head Section -->
    <head>
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <title><?php echo $title; ?></title>
        
        <!-- Favicon-->
        <link rel="icon" href="<?php echo BE_IMG_PATH . 'logo/favicon.ico'; ?>" type="image/x-icon" />
    
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />
    
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo BE_PLUGIN_PATH . 'bootstrap/css/bootstrap.css'; ?>" rel="stylesheet" />
        
        <!-- Additional/Plugins CSS -->
        <?php echo $headstyles; ?>
    
        <!-- Custom CSS -->
        <link href="<?php echo BE_CSS_PATH . 'style.css'; ?>" rel="stylesheet" />
    </head>
    <!-- End Head Section -->

    <!-- Body Section -->
    <body class="login-page">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
    
        <!-- Login Box -->
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);">
                    <img src="<?php echo BE_IMG_PATH . 'logo/logo.jpg'; ?>" />
                </a>
            </div>
            <div class="card">
                <div class="body">
                    <!-- BEGIN LOGIN FORM -->
                    <?php echo form_open( base_url('validate'), array( 'id'=>'login-form', 'role'=>'form' ) ); ?>
                        <div class="pull-right">
                            <a href="<?php echo base_url(); ?>" id="back-btn">Kembali</a>
                        </div>
                        <div class="msg">Login untuk memulai session Anda</div>
                        
                        <div class="alert alert-danger text-center display-hide error-validate">
                			<small><span>Silahkan masukkan Username dan Kata Sandi Anda</span></small>
                		</div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                            <div class="form-line">
                                <?php echo form_input('username','',array('class'=>'form-control','placeholder'=>'Username','required'=>'required','autofocus'=>'autofocus','autocomplete'=>'off')); ?>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">lock</i></span>
                            <div class="form-line">
                                <?php echo form_password('password','',array('class'=>'form-control','placeholder'=>'Kata Sandi','required'=>'required')); ?>
                            </div>
                        </div>
                        <div class="input-group smit-captcha-box" data-captcha="<?php echo ! empty( $login_failed ); ?>" style="display: none;">
                			<div class="g-recaptcha smit-captcha" data-smit-site-key="<?php echo config_item( 'captcha_site_key' ); ?>"></div>
                		</div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                                <!--
                                <?php echo form_checkbox(array('name'=>'rememberme','value'=>1,'class'=>'filled-in chk-col-blue','id'=>'rememberme')); ?>
                                <label for="rememberme">Ingat Saya</label>
                                -->
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-blue waves-effect" type="submit">MASUK</button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">
                            <div class="col-xs-6">
                                <a href="javascript:;" id="sign-up-btn">Pendaftaran Pengguna</a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="javascript:;" id="forgot-btn">Lupa Kata Sandi?</a>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    <!-- END LOGIN FORM -->
                    
                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    <?php echo form_open( base_url('lupapassword'), array( 'id'=>'forgot-password-form', 'role'=>'form', 'class'=>'display-hide' ) ); ?>
                        <div class="msg">
                            Masukkan alamat email Anda yang telah digunakan untuk registrasi. Kami akan mengirimkan email
                            berisikan username dan kata sandi baru Anda.
                        </div>
                        <div class="alert alert-danger text-center display-hide error-validate">
                			<small><span>Silahkan masukkan alamat Email Anda</span></small>
                		</div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">email</i></span>
                            <div class="form-line">
                                <?php echo form_input('email','',array('class'=>'form-control','placeholder'=>'Email','required'=>'required','autofocus'=>'autofocus','autocomplete'=>'off')); ?>
                            </div>
                        </div>
                        <button class="btn btn-block btn-lg bg-blue waves-effect" type="submit">RESET KATA SANDI SAYA</button>
                        <div class="row m-t-20 m-b--5 align-center">
                            <a href="javascript:;" id="login-btn">Login!</a>
                        </div>
                    <?php echo form_close(); ?>
                    <!-- END FORGOT PASSWORD FORM -->
                    
                    <!-- BEGIN SIGN UP FORM -->
                    <?php echo form_open( base_url('registration'), array( 'id'=>'sign-up-form', 'role'=>'form', 'class'=>'display-hide' ) ); ?>
                        <div class="msg">Pendaftaran Pengguna Baru</div>
                        <div class="alert alert-danger text-center display-hide error-validate">
                			<small><span>Ada kesalahan dalam pengisian formulir di bawah</span></small>
                		</div>
                        
                        <!-- Data Pengguna -->
                        <h2 class="card-inside-title">Data Akun</h2>
                        <input type="hidden" name="user_type" id="reg_member_password" class="form-control" value="<?php echo PENGUSUL; ?>" />
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                            <div class="form-line">
                                <?php echo form_input('username','',array('class'=>'form-control','placeholder'=>'Username','required'=>'required','autocomplete'=>'off')); ?>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">lock</i></span>
                            <div class="form-line">
                                <?php echo form_password('password','',array('id'=>'password','class'=>'form-control','placeholder'=>'Kata Sandi','required'=>'required','minlength'=>'6')); ?>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">lock</i></span>
                            <div class="form-line">
                                <?php echo form_password('password_confirm','',array('class'=>'form-control','placeholder'=>'Konfirmasi Kata Sandi','required'=>'required','minlength'=>'6')); ?>
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
                        <div class="input-group smit-captcha-box-signup">
                			<div class="g-recaptcha smit-captcha-signup" data-smit-site-key="<?php echo config_item( 'captcha_site_key' ); ?>"></div>
                		</div>
                  
                        <button class="btn btn-block btn-lg bg-blue waves-effect" type="submit">DAFTAR</button>
                        <div class="m-t-25 m-b--5 align-center">
                            <a href="javascript:;" id="login-reg-btn">Anda sudah mendaftar?</a>
                        </div>
                    <?php echo form_close(); ?>
                    <!-- END SIGN UP FORM -->
                </div>
            </div>
        </div>
        <!-- #END# Login Box -->

        <!-- Jquery Core Js -->
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'jquery/jquery.min.js'; ?>"></script>
    
        <!-- Bootstrap Core Js -->
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'bootstrap/js/bootstrap.js'; ?>"></script>
        
        <!-- Additional/Plugins JS -->
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'node-waves/waves.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'momentjs/moment.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'; ?>"></script>
    
        <!-- Custom Js -->
        <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>
        <script type="text/javascript" src="<?php echo BE_JS_PATH . 'admin.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_JS_PATH . 'pages/user/login.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo BE_JS_PATH . 'pages/user/sign-up.js'; ?>"></script>
        
        <!-- Init JavaScript -->
        <script type="text/javascript">
            jQuery(document).ready(function() {
                Login.init();
                SignUp.init();
            });
            
            function onloadCallback() {
    			Login.loadCaptcha();
                SignUp.loadCaptcha();
    		}
        </script>
    </body>
    <!-- End Body Section -->
</html>