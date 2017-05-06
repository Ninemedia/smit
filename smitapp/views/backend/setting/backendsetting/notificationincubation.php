<!-- Format Email Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_incubation_not_success">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_incubation_not_success" aria-expanded="true" aria-controls="collapse_notif_incubation_not_success">
                    <i class="material-icons">email</i> Format Email Tidak Lolos Tahap 1
                </a>
            </h4>
        </div>
        <div id="collapse_notif_incubation_not_success" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_notif_incubation_not_success">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_incubation_not_success"><?php echo get_option('be_notif_incubation_not_success'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-incubation-setting" type="button" data-type="not_success" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_incubation_not_success2">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_notif_incubation_not_success2" aria-expanded="true" aria-controls="collapse_notif_incubation_not_success2">
                    <i class="material-icons">email</i> Format Email Tidak Lolos Tahap 2
                </a>
            </h4>
        </div>
        <div id="collapse_notif_incubation_not_success2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_incubation_not_success2">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_incubation_not_success2"><?php echo get_option('be_notif_incubation_not_success2'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-incubation-setting" type="button" data-type="not_success" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_notif_incubation_success">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_notif_incubation_success" aria-expanded="false" aria-controls="collapse_notif_incubation_success">
                    <i class="material-icons">email</i> Format Email Lolos
                </a>
            </h4>
        </div>
        <div id="collapse_notif_incubation_success" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_notif_incubation_success">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_notif_incubation_success"><?php echo get_option('be_notif_incubation_success'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-notif-incubation-setting" type="button" data-type="success" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <!--
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_pendamping">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_pendamping" aria-expanded="false" aria-controls="collapse_pendamping">
                    <i class="material-icons">format_align_justify</i> Text Dashboard Pendamping
                </a>
            </h4>
        </div>
        <div id="collapse_pendamping" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_pendamping">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_dashboard_pendamping"><?php echo get_option('be_dashboard_pendamping'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-dashboard-setting" type="button" data-type="pendamping" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_tenant">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_tenant" aria-expanded="false" aria-controls="collapse_tenant">
                    <i class="material-icons">format_align_justify</i> Text Dashboard Tenant
                </a>
            </h4>
        </div>
        <div id="collapse_tenant" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_tenant">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_dashboard_tenant"><?php echo get_option('be_dashboard_tenant'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-dashboard-setting" type="button" data-type="tenant" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_pelaksana">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_pelaksana" aria-expanded="false" aria-controls="collapse_pelaksana">
                    <i class="material-icons">format_align_justify</i> Text Dashboard Pelaksana
                </a>
            </h4>
        </div>
        <div id="collapse_pelaksana" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_pelaksana">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_dashboard_pelaksana"><?php echo get_option('be_dashboard_pelaksana'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-dashboard-setting" type="button" data-type="pelaksana" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    -->
</div>
<!-- #END# Format Email Setting -->