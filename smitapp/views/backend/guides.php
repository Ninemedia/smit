<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <!-- Start List Guide Files -->
        <div class="card">
            <div class="header">
                <h2>Daftar Berkas Digital</h2>
            </div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR BERKAS DIGITAL
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH BERKAS DIGITAL
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="guide_list" data-url="<?php echo base_url('backend/guidelistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
   							            <th class="width5">No</th>
                                        <th class="width10 text-center">Tanggal</th>
                                        <th class="width20 text-center">Judul Berkas Digital</th>
            							<th class="width35 text-center">Deskripsi</th>
                                        <th class="width5 text-center">Berkas</th>
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_desc" /></td>
            							<td></td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_guide_list">Search</button>
                                            </div>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_guide_list_reset">Reset</button>
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
                        <?php echo form_open_multipart( 'backend/guides', array( 'id'=>'guide_files', 'role'=>'form' ) ); ?>
                            <div class="form-group">
                                <label class="control-label">Judul Berkas Digital <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php
                                        echo form_input(
                                            'guide_title',
                                            ( !empty($post) ? smit_isset($post['guide_title'],'') : '' ),
                                            array(
                                                'class'=>'form-control text-uppercase',
                                                'placeholder'=>'Masukan Judul Berkas Digital...',
                                                'required'=>'required'
                                            )
                                        );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Deskripsi Berkas Digital <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php
                                        echo form_textarea(
                                            array(
                                                'name'=>'guide_description',
                                                'class'=>'form-control no-resize',
                                                'rows'=>4,
                                                'placeholder'=>'Silahkan isi deskripsi dari berkas Berkas Digital dengan maksimal 400 huruf...'
                                            ),
                                            ( !empty($post) ? smit_isset($post['guide_description'],'') : '' )
                                        );
                                    ?>
                                </div>
                            </div>
                            <p align="justify">
                                <strong>Perhatian!</strong>
                                File yang dapat di upload adalah dengan Ukuran Maksimal 2 MB dan format File adalah <strong>doc/docx/pdf/xls/xlsx.</strong>
                            </p>
                            <div class="form-group">
                                <label>Berkas Berkas Digital <b style="color: red !important;">(*)</b></label>
                                <input id="guide_selection_files" name="guide_selection_files" class="form-control" type="file">
                            </div>
                            <button class="btn btn-sm bg-blue waves-effect" type="submit">Unggah Berkas</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="table-container table-responsive">
                    <div class="table-actions-wrapper">
						<span></span>
						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
							<option value="">Select...</option>
							<option value="confirm">Konfirmasi</option>
							<option value="banned">Banned</option>
							<option value="delete">Hapus</option>
						</select>
						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
					</div>
                    <table class="table table-striped table-bordered table-hover" id="guide_list" data-url="<?php echo base_url('backend/guidelistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
				                <th class="width5">No</th>
                                <th class="width10 text-center">Tanggal</th>
                                <th class="width20 text-center">Judul Berkas</th>
    							<th class="width35 text-center">Deskripsi</th>
                                <th class="width5 text-center">Berkas</th>
    							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
					        </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td></td>
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
                                <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td><input type="text" class="form-control form-filter input-sm" name="search_desc" /></td>
    							<td></td>
    							<td style="text-align: center;">
    								<button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_guide_list">Search</button>
                                    <button class="btn bg-red waves-effect filter-cancel">Reset</button>
    							</td>
    						</tr>
                        </thead>
                        <tbody>
                            <!-- Data Will Be Placed Here -->
                        </tbody>
                    </table>
                </div>
                <?php endif ?>
            </div>
        </div>
        <!-- End List Guide Files -->

    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE BERKAS DIGITAL MODAL -->
<div class="modal fade" id="save_guides" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Berkas Digital</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Berkas Digital. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_guides" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE BERKAS DIGITAL MODAL -->
