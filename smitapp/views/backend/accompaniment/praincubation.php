<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Notulensi Pra-Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> NOTULENSI PRA-INKUBASI
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
                            <table class="table table-striped table-bordered table-hover" id="list_notulensipraincubation" data-url="<?php echo base_url(); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
            							<th class="width15">Pengguna</th>
            							<th class="width15">Nama Peneliti Utama</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <th class="width10 text-center">Tanggal Usulan</th>
            							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_arr = smit_select_year(date('Y'),2030);
                                                if( !empty($year_arr) ){
                                                    foreach($year_arr as $val){
                                                        $option[$val] = $val;
                                                    }
                                                }

                                                if( !empty($option) ){
                                                    foreach($option as $val){
                                                        echo '<option value="'.$val.'">'.$val.'</option>';
                                                    }
                                                }else{
                                                    echo '<option value="">Tahun Kosong</option>';
                                                }
                                            ?>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                        <td>
                                            <?php
                                            	$workunit_type = smit_workunit_type();
                                                $option = array('' => 'Pilih...');
                                                $extra = 'name="search_workunit" class="form-control show-tick"';

                                                if( !empty($workunit_type) ){
                                                    foreach($workunit_type as $val){
                                                        $option[$val->workunit_id] = $val->workunit_name;
                                                    }
                                                }
                                                echo form_dropdown('workunit_type',$option,'',$extra);
                                            ?>
                                        </td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
            							<td style="text-align: center;">
                                            <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubation_list">Search</button>
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
                        <?php echo form_open_multipart( 'backend/notesadd', array( 'id'=>'notesadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <section id="">
                                <h4>Masukan Data Notulensi Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <label class="form-label">Usulan Kegiatan Pra-Inkubasi<b style="color: red !important;">(*)</b></label>
                                    <p>Usulan kegiatan yang sudah ada pendamping</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="reg_event" id="reg_event">
                                            <?php
                                                $conditions     = ' WHERE %user_id% = '.$user->id.' AND %companion_id% > 0';
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %companion_id% > 0';
                                                }
                	                        	$praincubation_list    = $this->Model_Praincubation->get_all_praincubationdata(0, 0, $conditions);
                	                            if( !empty($praincubation_list) ){
                	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
                	                                foreach($praincubation_list as $row){
                                                        echo '<option value="'.$row->id.'">'.strtoupper($row->event_title).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
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
                                <h4>Berkas Notulensi Pra-Inkubasi</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Upload Proposal Notulensi</label>
                                        <p>
                                            File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                        </p>
                                        <input id="reg_selection_files" name="reg_selection_files" class="form-control" type="file">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect" id="btn_notesadd">Tambah Pra-Inkubasi</button>
                                <button type="button" class="btn btn-danger waves-effect" id="btn_notesadd_reset">Bersihkan</button>
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
                            <i class="material-icons">list</i> NOTULENSI PRA-INKUBASI
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
                        
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        
                    </div>
                </div>
                <?php endif ?> 
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE NOTES MODAL -->
<div class="modal fade" id="save_notes" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Notulensi Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Notulensi Pra-Inkubasi. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_notes" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE NOTES MODAL -->