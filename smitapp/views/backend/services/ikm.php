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
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_ikmscore" data-url="<?php echo base_url('backend/ikmscorelistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
            							<th class="width50 text-center">Pertanyaan</th>
            							<th class="width20 text-center">Jawaban</th>
                                        <th class="width5 text-center">Total</th>
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_question" /></td>
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
                    <div role="tabpanel" class="tab-pane fade in" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_ikm" data-url="<?php echo base_url('backend/ikmlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
            							<th class="width55 text-center">Pertanyaan</th>
            							<th class="width15 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
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
                                    <label class="form-label">Pertanyaan <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea name="reg_question" id="reg_question" cols="30" rows="3" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_ikmadd">Tambah Pertanyaan</button>
                                    <button type="button" class="btn btn-danger waves-effect" id="btn_ikmadd_reset">Bersihkan</button>
                                </div>
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
