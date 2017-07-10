<!-- Format Notification -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <!-- Registration User Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_user">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_user" aria-expanded="true" aria-controls="collapse_notif_registration_user">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran Anggota
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_user" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_notif_registration_user">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_user"><?php echo get_option('be_notif_registration_user'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_user" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect" type="button" data-toggle="modal" data-target="#view_notif_registration_user">Lihat Surat</button>
            </div>
        </div>
        <!-- Modal View -->
        <div class="modal fade" id="view_notif_registration_user" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Format Email Notifikasi Pendaftaran Anggota</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo smit_notification_template(get_option('be_notif_registration_user')); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link bg-light-blue waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration Juri Confirm -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_juri">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration_juri" aria-expanded="true" aria-controls="collapse_notif_registration_juri">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran Juri
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_juri" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_registration_juri">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_juri"><?php echo get_option('be_notif_registration_juri'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_juri" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-notif-praincubation-setting" type="button" data-type="confirm" data-url="<?php echo base_url(''); ?>">Lihat Surat</button>
            </div>
        </div>
    </div>

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
                <button class="btn btn-info waves-effect btn-notif-praincubation-setting" type="button" data-type="confirm" data-url="<?php echo base_url(''); ?>">Lihat Surat</button>
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
                <button class="btn btn-info waves-effect btn-notif-praincubation-setting" type="button" data-type="confirm" data-url="<?php echo base_url(''); ?>">Lihat Surat</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# Format Notification -->