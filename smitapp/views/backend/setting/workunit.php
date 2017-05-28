<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Satuan Kerja</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR SATUAN KERJA
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH SATUAN KERJA
                        </a>
                    </li>
                </ul>
            
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="workunit_list" data-url="<?php echo base_url('backend/workunitlistdata'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5 text-center">No</th>
        							<th class="width50 text-center">Nama Satuan Kerja</th>
        							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
   						        </tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_workunit" /></td>
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit" id="btn_workunit_list">Search</button>
                                        <button class="btn bg-red waves-effect filter-cancel">Reset</button>
        							</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <?php echo form_open_multipart( 'backend/workunitadd', array( 'id'=>'workunitadd', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <div class="form-group form-float">
                                <section id="">
                                    <h4>Pengaturan Satuan Kerja</h4>
                                    <div class="form-group">
                                        <label class="form-label">Nama Satuan Kerja <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_workunit" id="reg_workunit" class="form-control" placeholder="Masukan Nama Satuan Kerja" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_add_workunit">Buat Satuan Kerja</button>
                                    <button type="button" class="btn btn-danger waves-effect" id="btn_workunit_reset">Bersihkan</button>
                                </section>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php endif ?> 
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE WORKUNIT MODAL -->
<div class="modal fade" id="save_workunit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Satuan Kerja</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Satuan Kerja. Pastinkan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_workunit" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE WORKUNIT MODAL -->

<!-- BEGIN INFORMATION SUCCESS EDIT WORKUNIT MODAL -->
<div class="modal fade" id="edit_workunit" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Satuan Kerja</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Satuan Kerja. Pastinkan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_edit_workunit" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT WORKUNIT MODAL -->