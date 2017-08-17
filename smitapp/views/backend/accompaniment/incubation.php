<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Notulensi Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> NOTULENSI INKUBASI
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
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="list_notesincubation" data-url="<?php echo base_url('backend/notesincubationlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="guide_list select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
   							            <th class="width5">No</th>
                                        <th class="width15 text-center">Nama</th>
            							<th class="width20 text-center">Nama Tenant</th>
            							<th class="width20 text-center">Judul Notulensi</th>
            							<th class="width5 text-center">Berkas</th>
            							<th class="width10 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal</th>
            							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_name" /></td>
                                        <td></td>
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
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_notesinc_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_notesinc_listreset">Reset</button>
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
                        <?php echo form_open_multipart( 'backend/notesincubationadd', array( 'id'=>'notesincubationadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <h4>Masukan Data Notulensi Inkubasi / Tenant</h4>
                                <div class="form-group">
                                    <label class="form-label">Nama Tenant<b style="color: red !important;">(*)</b></label>
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
                                    <label class="form-label">Nama Pendamping<b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <?php
                                            $option = array(''=>'Pilih Pendamping');
                                            $companion_arr = smit_companion_list();
                                            $extra = 'class="form-control show-tick" id="companion_id"';

                                            if( $companion_arr || !empty($companion_arr) ){
                                                foreach($companion_arr as $val){
                                                    $option[$val->id] = $val->name;
                                                }
                                            }
                                            echo form_dropdown('companion_id',$option,'',$extra);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Judul Notulensi <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                        <div class="form-line">
                                            <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Notulensi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Notulensi <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h4>Berkas Notulensi Inkubasi / Tenant</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Upload Proposal Notulensi</label>
                                        <p>
                                            File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                        </p>
                                        <input id="reg_selection_files" name="reg_selection_files" class="form-control" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_noteincubationadd">Tambah Notulensi</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_noteincubationadd_reset">Bersihkan</button>
                            </section>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php else : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> NOTULENSI INKUBASI
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
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="list_notesincubation" data-url="<?php echo base_url('backend/notesincubationlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="guide_list select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
   							            <th class="width5">No</th>
            							<th class="width20 text-center">Nama</th>
            							<th class="width15 text-center">Nama Tenant</th>
            							<th class="width20 text-center">Judul Notulensi</th>
            							<th class="width5 text-center">Berkas</th>
            							<th class="width10 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal</th>
            							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
        					        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_name" /></td>
                                        <td></td>
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
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_notesinc_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_notesinc_listreset">Reset</button>
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
                        <?php echo form_open_multipart( 'backend/notesincubationadd', array( 'id'=>'notesincubationadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <h4>Masukan Data Notulensi Inkubasi / Tenant</h4>
                                <div class="form-group">
                                    <label class="form-label">Nama Tenant<b style="color: red !important;">(*)</b></label>
                                    <p>Tenant yang sudah ada pendamping</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_event" id="reg_event">
                                            <?php
                                                $conditions     = ' WHERE %user_id% = '.$user->id.' AND %companion_id% > 0';
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %companion_id% > 0';
                                                }
                                                
                                                if( !empty($is_pendamping) ){
                                                    $conditions     = ' WHERE %companion_id% = '.$user->id.'';
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
                                <input type="hidden" name="companion_id" id="companion_id" class="form-control" value="<?php echo $user->id; ?>" required>
                                <div class="form-group">
                                    <label class="form-label">Judul Notulensi <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                        <div class="form-line">
                                            <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Notulensi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Deskripsi Notulensi <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h4>Berkas Notulensi Inkubasi / Tenant</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Upload Proposal Notulensi</label>
                                        <p>
                                            File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                        </p>
                                        <input id="reg_selection_files" name="reg_selection_files" class="form-control" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_noteincubationadd">Tambah Notulensi</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_noteincubationadd_reset">Bersihkan</button>
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

<!-- BEGIN INFORMATION SUCCESS SAVE NOTES MODAL -->
<div class="modal fade" id="save_noteincubationadd" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Notulensi Inkubasi / Tenant</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Notulensi Inkubasi / Tenant. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_noteincubationadd" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE NOTES MODAL -->
