<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Monitoring Dokumen</h2></div>
            <div class="body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR DOKUMEN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH DOKUMEN
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
        							<?php if( !empty($is_admin) ) : ?><option value="confirm">Terima</option><?php endif; ?>
        							<?php if( !empty($is_admin) ) : ?><option value="banned">Banned</option><?php endif; ?>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="payment_list" data-url="<?php echo base_url('tenant/paymentlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
            							<th class="width5">No</th>
                                        <th class="width10 text-center">No. Dokumen</th>
            							<th class="width25 text-center">Judul Dokumen</th>
            							<th class="width10 text-center">File Dokumen</th>
            							<th class="width10 text-center">Status</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_invoice" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
                                        <td></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
            			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
            			                                }
            			                            }
            			                        ?>
            								</select>
                                        </td>
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_payment_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_payment_listreset">Reset</button>
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
                        <?php echo form_open_multipart( 'tenant/paymentadd', array( 'id'=>'paymentadd', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <div class="form-group form-float">
                                <section id="">
                                    <h4>Dokumen Tenant</h4>
                                    <div class="form-group">
                                        <label class="form-label">Nama Tenant <b style="color: red !important;">(*)</b></label>
                                        <p>Tenant yang sudah ada pendamping</p>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                            <select class="form-control show-tick" name="reg_event" id="reg_event">
                                                <?php
                                                    $conditions     = ' WHERE %user_id% = '.$user->id.' AND %companion_id% > 0';
                                                    if( !empty($is_admin) ){
                                                        $conditions = ' WHERE %companion_id% > 0';
                                                    }
                    	                        	$tenant_list    = $this->Model_Tenant->get_all_tenant(0, 0, $conditions);
                    	                            if( !empty($tenant_list) ){
                    	                                echo '<option value="">-- Pilih Nama Tenant --</option>';
                    	                                foreach($tenant_list as $row){
                                                            echo '<option value="'.$row->id.'">'.strtoupper($row->name_tenant).'</option>';
                    	                                }
                    	                            }else{
                    	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                    	                            }
                    	                        ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Judul Dokumen <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Dokumen" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Keterangan <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control" placeholder="Masukan Bukti Pembayaran"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h4>Berkas Dokumen</h4>
                                    <div class="form-group">
                                        <p align="justify">
                                            <strong>Perhatian!</strong>
                                            File yang dapat di upload adalah dengan UkuranMaksimal 1024 KB dan format File adalah <strong>JPG/PNG/DOC/DOCX/PDF/XLS/XLSX.</strong>
                                        </p>
                                        <div class="form-group">
                                            <label>Upload Berkas Dokumen</label>
                                            <input id="news_selection_files" name="news_selection_files" class="form-control" type="file">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_paymentadd">Tambah Dokumen</button>
                                    <button type="button" class="btn btn-danger waves-effect" id="btn_paymentadd_reset">Bersihkan</button>
                                </section>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE PAYMENT MODAL -->
<div class="modal fade" id="save_payment" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Dokumen Tenant</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Upload Dokumen Tenant. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_payment" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE PAYMENT MODAL -->
