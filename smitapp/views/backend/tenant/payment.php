<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pembayaran Tenant</h2></div>
            <div class="body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR PEMBAYARAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="payment_list" data-url="<?php echo base_url('newslistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
            							<th class="width15 text-center">No Berita</th>
            							<th class="width20 text-center">Judul Berita</th>
            							<th class="width20 text-center">Sumber Berita</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_no_news" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_source" /></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_payment_list">Search</button>
                                            </div>
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
                                    <h4>Pembayaran Tenant</h4>
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
                                        <label class="form-label">Judul Pembayaran <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Pembayaran" required>
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
                                    <h4>Gambar Bukti Pembayaran</h4>
                                    <div class="form-group">
                                        <p align="justify">
                                            <strong>Perhatian!</strong>
                                            File yang dapat di upload adalah dengan Ukuran 500 x 500px Maksimal 1024 KB dan format File adalah <strong>JPG/PNG.</strong>
                                        </p>
                                        <div class="form-group">
                                            <label>Upload Bukti Pembayaran</label>
                                            <input id="news_selection_files" name="news_selection_files" class="form-control" type="file">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_paymentadd">Tambah Pembayaran</button>
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
				<h4 class="modal-title">Pembayaran Tenant</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pembayaran Tenant. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_payment" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE PAYMENT MODAL -->
