<!-- General Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_user">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_user" aria-expanded="true" aria-controls="collapse_user">
                    <i class="material-icons">format_align_justify</i> Text Dashboard Pengusul
                </a>
            </h4>
        </div>
        <div id="collapse_user" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_user">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_dashboard_user"><?php echo get_option('be_dashboard_user'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-dashboard-setting" type="button" data-type="user" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_juri">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_juri" aria-expanded="false" aria-controls="collapse_juri">
                    <i class="material-icons">format_align_justify</i> Text Dashboard Juri
                </a>
            </h4>
        </div>
        <div id="collapse_juri" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_juri">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_dashboard_juri"><?php echo get_option('be_dashboard_juri'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-dashboard-setting" type="button" data-type="juri" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
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
</div>
<!-- #END# General Setting -->