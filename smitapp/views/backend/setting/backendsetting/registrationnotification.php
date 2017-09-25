<!-- Format Notification -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <!-- Registration User Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_user">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_user" aria-expanded="true" aria-controls="collapse_notif_registration_user">
                    <i class="material-icons">email</i> Format Email Notifikasi Konfirmasi Pendaftaran Anggota
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_user" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_notif_registration_user">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_user"><?php echo get_option('be_notif_registration_user'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_user" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_registration_user">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Registration Pengusul Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_pengusul">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_pengusul" aria-expanded="true" aria-controls="collapse_notif_registration_pengusul">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran Pengusul
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_pengusul" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_registration_pengusul">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_pengusul"><?php echo get_option('be_notif_registration_pengusul'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_pengusul" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_registration_pengusul">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Registration Juri Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_juri">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_juri" aria-expanded="true" aria-controls="collapse_notif_registration_juri">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran dari Administrator
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_juri" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_registration_juri">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_juri"><?php echo get_option('be_notif_registration_juri'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_juri" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_registration_juri">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Registration for Admin Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_for_admin">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_for_admin" aria-expanded="true" aria-controls="collapse_notif_registration_for_admin">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran untuk Administrator
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_for_admin" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_registration_for_admin">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_for_admin"><?php echo get_option('be_notif_registration_for_admin'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_for_admin" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_registration_for_admin">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Notification selection for Admin  -->
    <!--
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_selection_for_admin">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_selection_for_admin" aria-expanded="true" aria-controls="collapse_notif_selection_for_admin">
                    <i class="material-icons">email</i> Format Email Notifikasi Seleksi untuk Administrator
                </a>
            </h4>
        </div>
        <div id="collapse_notif_selection_for_admin" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_selection_for_admin">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_selection_for_admin"><?php echo get_option('be_notif_selection_for_admin'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="selection_for_admin" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_selection_for_admin">Lihat Surat</button>
            </div>
        </div>
    </div>
    -->

    <!-- Registration Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_selection">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_selection" aria-expanded="true" aria-controls="collapse_notif_registration_selection">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran Seleksi
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_selection" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_registration_selection">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_selection"><?php echo get_option('be_notif_registration_selection'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_selection" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_registration_selection">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Rated Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_rated_selection">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_rated_selection" aria-expanded="true" aria-controls="collapse_notif_rated_selection">
                    <i class="material-icons">email</i> Format Email Notifikasi Penilaian Seleksi
                </a>
            </h4>
        </div>
        <div id="collapse_notif_rated_selection" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_rated_selection">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_rated_selection"><?php echo get_option('be_notif_rated_selection'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="rated_selection" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_rated_selection">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Contact to Admin -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_contact">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_contact" aria-expanded="true" aria-controls="collapse_notif_contact">
                    <i class="material-icons">email</i> Format Email Kontak untuk Administrator
                </a>
            </h4>
        </div>
        <div id="collapse_notif_contact" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_contact">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_contact"><?php echo get_option('be_notif_contact'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="contact" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_contact">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Forgot Password -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_forgot_password">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_forgot_password" aria-expanded="true" aria-controls="collapse_notif_forgot_password">
                    <i class="material-icons">email</i> Format Email Lupa Password
                </a>
            </h4>
        </div>
        <div id="collapse_notif_forgot_password" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_forgot_password">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_forgot_password"><?php echo get_option('be_notif_forgot_password'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="forgot_password" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_forgot_password">Lihat Surat</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# Format Notification -->