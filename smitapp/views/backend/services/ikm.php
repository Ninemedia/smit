<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengukuran IKM</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
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
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_ikm" data-url="<?php echo base_url('layanan/komunikasibantuan/in'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
            							<th class="width20 text-center">Nama Pengirim</th>
            							<th class="width15 text-center">Judul Komunikasi</th>
            							<th class="width15 text-center">Deskripsi</th>
            							<th class="width15 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width13 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_email" /></td>
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
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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
                    <div role="tabpanel" class="tab-pane fade in" id="add">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
<div class="modal fade" id="save_cmm" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Komunikasi dan Bantuan</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Komunikasi dan Bantuan. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_cmm" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
