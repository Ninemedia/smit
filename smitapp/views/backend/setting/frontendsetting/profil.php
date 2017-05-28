<!-- Profile Setting -->
<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_profile">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" href="#collapse_profile" aria-expanded="true" aria-controls="collapse_profile">
                    <i class="material-icons">format_align_justify</i> Sejarah Inkubator Teknologi
                </a>
            </h4>
        </div>
        <div id="collapse_profile" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_profile">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_frontend_profil"><?php echo get_option('be_frontend_profil'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-frontend-setting" type="button" data-type="profil" data-url="<?php echo base_url('backend/updatesettingfrontend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_task">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_task" aria-expanded="false" aria-controls="collapse_task">
                    <i class="material-icons">format_align_justify</i> Tugas
                </a>
            </h4>
        </div>
        <div id="collapse_task" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_task">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_frontend_task"><?php echo get_option('be_frontend_task'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-frontend-setting" type="button" data-type="task" data-url="<?php echo base_url('backend/updatesettingfrontend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
    <div class="panel panel-col-blue">
        <div class="panel-heading" role="tab" id="heading_function">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_function" aria-expanded="false" aria-controls="collapse_function">
                    <i class="material-icons">format_align_justify</i> Fungsi
                </a>
            </h4>
        </div>
        <div id="collapse_function" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_function">
            <div class="panel-body">
                <div class="form-group">
                    <textarea class="form-control ckeditor" id="be_frontend_function"><?php echo get_option('be_frontend_function'); ?></textarea>
                </div>
                <button class="btn btn-success waves-effect btn-frontend-setting" type="button" data-type="function" data-url="<?php echo base_url('backend/updatesettingfrontend'); ?>">Simpan Pengaturan</button>
            </div>
        </div>
    </div>
</div>
<!-- #END# Profile Setting -->