<!-- Format Registration Notification -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_registration_selection">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_registration" aria-expanded="true" aria-controls="collapse_notif_registration_selection">
                    <i class="material-icons">email</i> Format Email Notifikasi Pendaftaran Seleksi
                </a>
            </h4>
        </div>
        <div id="collapse_notif_registration_selection" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_notif_registration_selection">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_registration_selection"><?php echo get_option('be_notif_registration_selection'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-registration" type="button" data-type="registration_selection" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# Format Registration Notification -->