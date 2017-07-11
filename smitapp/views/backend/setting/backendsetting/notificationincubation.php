<!-- Format Email Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <!-- Email Konfirmasi Tidak Lolos Tahap 1 -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_incubation_not_success">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_incubation_not_success" aria-expanded="true" aria-controls="collapse_notif_incubation_not_success">
                    <i class="material-icons">email</i> Format Surat Tidak Lolos Tahap 1
                </a>
            </h4>
        </div>
        <div id="collapse_notif_incubation_not_success" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_notif_incubation_not_success">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_incubation_not_success"><?php echo get_option('be_notif_incubation_not_success'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-incubation-setting" type="button" data-type="not_success" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_incubation_not_success">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Email Konfirmasi Tidak Lolos Tahap 2 -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_incubation_not_success2">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_incubation_not_success2" aria-expanded="true" aria-controls="collapse_notif_incubation_not_success2">
                    <i class="material-icons">email</i> Format Surat Tidak Lolos Tahap 2
                </a>
            </h4>
        </div>
        <div id="collapse_notif_incubation_not_success2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_incubation_not_success2">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_incubation_not_success2"><?php echo get_option('be_notif_incubation_not_success2'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-incubation-setting" type="button" data-type="not_success" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_incubation_not_success2">Lihat Surat</button>
            </div>
        </div>
    </div>
    
    <!-- Email Konfirmasi Lolos Seleksi -->
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_incubation_success">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_notif_incubation_success" aria-expanded="false" aria-controls="collapse_notif_incubation_success">
                    <i class="material-icons">email</i> Format Surat Lolos
                </a>
            </h4>
        </div>
        <div id="collapse_notif_incubation_success" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_incubation_success">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_incubation_success"><?php echo get_option('be_notif_incubation_success'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-incubation-setting" type="button" data-type="success" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                <button class="btn btn-info waves-effect btn-view-mail" type="button" data-content="be_notif_incubation_success">Lihat Surat</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# Format Email Setting -->