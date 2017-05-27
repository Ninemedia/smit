<!-- General Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_selection_praincubation">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_selection_praincubation" aria-expanded="true" aria-controls="collapse_selection_praincubation">
                    <i class="material-icons">format_align_justify</i> Seleksi Pra-Inkubasi
                </a>
            </h4>
        </div>
        <div id="collapse_selection_praincubation" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_selection_praincubation">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_frontend_praincubation"><?php echo get_option('be_frontend_praincubation'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-frontend-setting" type="button" data-type="praincubation" data-url="<?php echo base_url('backend/updatesettingfrontend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_selection_praincubation_note">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_selection_praincubation_note" aria-expanded="true" aria-controls="collapse_selection_praincubation_note">
                    <i class="material-icons">format_align_justify</i> Seleksi Pra-Inkubasi Catatan
                </a>
            </h4>
        </div>
        <div id="collapse_selection_praincubation_note" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_selection_praincubation_note">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_frontend_praincubation_note"><?php echo get_option('be_frontend_praincubation_note'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-frontend-setting" type="button" data-type="praincubation_note" data-url="<?php echo base_url('backend/updatesettingfrontend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_selection_incubation_note">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_selection_incubation_note" aria-expanded="true" aria-controls="collapse_selection_incubation_note">
                    <i class="material-icons">format_align_justify</i> Seleksi Inkubasi Catatan
                </a>
            </h4>
        </div>
        <div id="collapse_selection_incubation_note" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_selection_incubation_note">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_frontend_incubation_note"><?php echo get_option('be_frontend_incubation_note'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-frontend-setting" type="button" data-type="incubation_note" data-url="<?php echo base_url('backend/updatesettingfrontend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# General Setting -->