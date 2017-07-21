<!-- BEGIN INFORMATION SUCCESS EDIT KATEGORI MODAL -->
<div class="modal fade" id="edit_ikmdata" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Ubah Daftar Pertanyaan IKM</h4>
			</div>
			<div class="modal-body">
                <?php echo form_open_multipart( 'backend/ikmdataedit', array( 'id'=>'ikmdataedit', 'role'=>'form' ) ); ?>
                <div id="alert" class="alert display-hide"></div>
                <div class="form-group form-float">
                    <div class="form-group">
                        <label class="form-label">Judul Pertanyaan <b style="color: red !important;">(*)</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                            <div class="form-line">
                                <input type="hidden" name="reg_uniquecode" id="reg_uniquecode" value="" />
                                <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Pertanyaan" required>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-danger waves-effect" id="btn_category_reset">Bersihkan</button> -->
                </div>
                <div class="form-group form-float">
                    <div class="form-group">
                        <label class="form-label">Pertanyaan <b style="color: red !important;">(*)</b></label>
                        <div class="input-group">
                            <div class="form-line">
                                <textarea name="reg_question" id="reg_question" cols="30" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_edit_ikmdata" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS EDIT KATEGORI MODAL -->

<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengukuran IKM</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list_score" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR NILAI IKM
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR IKM
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH IKM
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list_score">
                        <div class="panel-group" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_total">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapse_total" aria-expanded="true" aria-controls="collapse_total">
                                            <i class="material-icons">format_align_justify</i> Total Pengukuran IKM
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_total" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_total">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                <div class="table-container table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                    						<tr role="row" class="heading bg-blue">
                                                                <th class="width35 text-center">Total Score IKM</th>
                                                                <th class="width30 text-center">Mutu</th>
                                                                <th class="width35 text-center">Kinerja</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-size: 28px !important; "><strong><?php echo smit_center($ikm); ?></strong></td>
                                                                <td style="font-size: 28px !important; "><strong><?php echo smit_center($mutu); ?></strong></td>
                                                                <td style="font-size: 28px !important; "><strong><?php echo smit_center($kinerja); ?></strong></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="info-box bg-blue hover-expand-effect">
                                                    <div class="icon">
                                                        <i class="material-icons">done_all</i>
                                                    </div>
                                                    <div class="content">
                                                        <div class="text">Sangat Setuju</div>
                                                        <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($sangat_setuju); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="info-box bg-blue hover-expand-effect">
                                                    <div class="icon">
                                                        <i class="material-icons">done</i>
                                                    </div>
                                                    <div class="content">
                                                        <div class="text">Setuju</div>
                                                        <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($setuju); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="info-box bg-blue hover-expand-effect">
                                                    <div class="icon">
                                                        <i class="material-icons">clear</i>
                                                    </div>
                                                    <div class="content">
                                                        <div class="text">Tidak Setuju</div>
                                                        <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($tidak_setuju); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="info-box bg-blue hover-expand-effect">
                                                    <div class="icon">
                                                        <i class="material-icons">new_releases</i>
                                                    </div>
                                                    <div class="content">
                                                        <div class="text">Sangat Tdk Setuju</div>
                                                        <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo smit_center($sangat_tidak_setuju); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_detail">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapse_detail" aria-expanded="true" aria-controls="collapse_detail">
                                            <i class="material-icons">format_align_justify</i> Detail Pengukuran IKM
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_detail" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_detail">
                                    <div class="panel-body">
                                        <div class="table-container table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="list_ikmscore" data-url="<?php echo base_url('backend/ikmscorelistdata'); ?>">
                                                <thead>
                            						<tr role="row" class="heading bg-blue">
                                                        <th class="width5">No</th>
                            							<th class="width30 text-center">Pertanyaan</th>
                            							<th class="width20 text-center">Jawaban</th>
                                                        <th class="width5 text-center">Total</th>
                                                        <th class="width5 text-center">Nilai</th>
                                                        <th class="width5 text-center">Rata Nilai</th>
                                                        <th class="width5 text-center">Rata Penimbang</th>
                                                        <th class="width5 text-center">IKM</th>
                                                        <th class="width5 text-center">Mutu</th>
                                                        <th class="width5 text-center">Kinerja</th>
                            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
                       						        </tr>
                                                    <tr role="row" class="filter display-hide table-filter">
                            							<td></td>
                            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_question" /></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_total" /></td>
                            							<td style="text-align: center;">
                            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_ikm">Search</button>
                                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_list_ikmreset">Reset</button>
                            							</td>
                            						</tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data Will Be Placed Here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_data">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapse_data" aria-expanded="true" aria-controls="collapse_data">
                                            <i class="material-icons">format_align_justify</i> Data Pengukuran IKM
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_data" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_data">
                                    <div class="panel-body">
                                        <div class="table-container table-responsive">
                                            <div class="table-actions-wrapper">
                        						<span></span>
                        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
                        							<option value="">Select...</option>
                        							<option value="delete">Hapus</option>
                        						</select>
                        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
                        					</div>
                                            <table class="table table-striped table-bordered table-hover" id="list_ikmdata" data-url="<?php echo base_url('backend/ikmdatalistdata'); ?>">
                                                <thead>
                            						<tr role="row" class="heading bg-blue">
                                                        <th class="width5 text-center"><input name="select_all" id="ikmdata_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="ikmdata_all"></label></th>
                            							<th class="width5">No</th>
                            							<th class="width30 text-center">Email</th>
                            							<th class="width35 text-center">Kritik dan Saran</th>
                                                        <th class="width15 text-center">Tanggal</th>
                            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
                       						        </tr>
                                                    <tr role="row" class="filter display-hide table-filter">
                            							<td></td>
                                                        <td></td>
                            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_email" /></td>
                                                        <td></td>
                                                        <td>
                            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                            							</td>
                                                        <td style="text-align: center;">
                            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_ikmdata">Search</button>
                                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_list_ikmdatareset">Reset</button>
                            							</td>
                            						</tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data Will Be Placed Here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="list">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Aktif</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="list_ikm" data-url="<?php echo base_url('backend/ikmlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="ikm_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="ikm_all"></label></th>
            							<th class="width5">No</th>
            							<th class="width15 text-center">Judul Pertanyaan</th>
            							<th class="width40 text-center">Pertanyaan</th>
            							<th class="width15 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_totle" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_question" /></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
            			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
            			                                }
            			                            }
            			                        ?>
            								</select>
                                        </td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_ikm">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_list_ikmreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="add">
                        <?php echo form_open_multipart( 'backend/ikm_listadd', array( 'id'=>'ikmadd', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <div class="form-group form-float">
                                <h4>Pengaturan Pertanyaan IKM</h4>
                                <div class="form-group">
                                    <label class="form-label">Judul Pertanyaan <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                        <div class="form-line">
                                            <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Pertanyaan" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Pertanyaan <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea name="reg_question" id="reg_question" cols="30" rows="3" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_ikmadd">Tambah Pertanyaan</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_ikmadd_reset">Bersihkan</button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE IKM MODAL -->
<div class="modal fade" id="save_ikmadd" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Pertanyaan Index Kepuasan Masyarakat</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Index Kepuasan Masyarakat. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_ikmadd" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE IKM MODAL -->
