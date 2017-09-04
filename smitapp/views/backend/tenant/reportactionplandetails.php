<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('tenants/laporan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2>Tambah bukti Berkas</h2>
            </div>
            <div class="body">
                <?php echo form_open_multipart( 'tenant/reportactionplanaddfiles', array( 'id'=>'reportactionplanaddfiles', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <h4>Bukti Berkas Action Plan</h4>
                    <input name="tenant_id" id="tenant_id" type="hidden" value="<?php echo $id; ?>"></input>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Upload Action Plan</label>
                            <p>
                                File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                            </p>
                            <input id="reg_actionplan_files" name="reg_actionplan_files" class="form-control" type="file">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect" id="btn_reportactionplanaddfiles">Tambah Action Plan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE REPORT ACTION PLAN MODAL -->
<div class="modal fade" id="save_reportactionplanaddfiles" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Bukti Berkas Action Plan</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Pendaftaran Bukti Berkas Action Plan. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_reportactionplanaddfiles" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE REPORT ACTION PLAN MODAL -->
