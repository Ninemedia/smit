<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tambah Tim Tenant
                    <small>Silahkan lengkapi isian informasi tim tenant Anda</small>
                </h2>
                <ul class="header-dropdown m-r-0">
                    <li>
                        <a class="btn btn-sm btn-default waves-effect back" href="<?php echo base_url('tenants/daftar'); ?>">
                            <i class="material-icons" style="font-size: 16px;">arrow_back</i> Kembali
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body body-team">
                <p class="text-justify bottom20">
                    <strong>Perhatian!</strong>
                    File yang dapat di upload adalah dengan Ukuran Maksimal 1 MB dan format File adalah
                    <strong>jpg/jpeg/png.</strong>
                </p>
                
                <?php echo form_open_multipart( current_url(), array( 'id'=>'addteamtenant', 'role'=>'form' ) ); ?>
                <input type="hidden" name="team_count" value="1" />
                <div class="addteam_container">
                    <div class="card">
                        <div class="header header-team bg-cyan">
                            <h5>Data Tim Tenant</h5>
                        </div>
                        <div class="body">
                            <div class="row bottom0">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom0-lg" >
                                    <div class="input-group">
                                        <input name="team_image_1" id="team_image_1" class="form-control team_image" type="file" />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom0" >
                                    <div class="input-group">
                                        <label class="form-label">Name *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control team_name" name="team_name_1" id="team_name_1">
                                        </div>
                                    </div>
                                    <div class="input-group bottom0">
                                        <label class="form-label">Jabatan/Posisi/Peran *</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control team_position" name="team_position_1" id="team_position_1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-block btn-lg bg-green waves-effect addteam-more" type="button">Tambah Tim</button>
                <button class="btn btn-block btn-lg bg-blue waves-effect" type="submit">Proses</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- END Content -->