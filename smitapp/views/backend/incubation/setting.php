<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Seleksi Inkubasi</h2></div>
            <div class="body">
            
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#selection" data-toggle="tab" id="selection_list_tab">
                            <i class="material-icons">assignment_returned</i> SELEKSI KEGIATAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab" id="selection_add_tab">
                            <i class="material-icons">add_box</i> TAMBAH SELEKSI 
                        </a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="selection">
                        <table class="table table-striped table-bordered table-hover" id="incubation_setting_list" data-url="<?php echo base_url('incubationsetlist'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
        							<th class="width15 text-center">Tanggal<br />Mulai Seleksi</th>
        							<th class="width15 text-center">Tanggal<br />Selesai Seleksi</th>
                                    <th class="width15 text-center">Tanggal<br />Mulai Pelaksanaan</th>
                                    <th class="width15 text-center">Tanggal<br />Selesai Pelaksanaan</th>
                                    <th class="width15 text-center">Status</th>
        							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
        						</tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
        							<td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_date_start_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_date_start_max" placeholder="To" />
        							</td>
        							<td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_date_end_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_date_end_max" placeholder="To" />
        							</td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_impdate_start_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_impdate_start_max" placeholder="To" />
        							</td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_impdate_end_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_impdate_end_max" placeholder="To" />
        							</td>
                                    <td>
                                        <select name="search_status" class="form-control form-filter input-sm def">
    										<option value="">Select...</option>
    										<option value="1">OPEN</option>
    										<option value="0">CLOSED</option>
    									</select>
                                    </td>
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_incubation_setting_list">Search</button>
                                        <button class="btn bg-red waves-effect filter-cancel">Reset</button>
        							</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                        </table>
                        
                        <!-- Incubation Details -->
                        <div class="card top30 bottom0 display-hide" id="incubation_details">
                            <div class="header bg-cyan">
                                <h2>Pengaturan Seleksi Inkubasi</h2>
                                <ul class="header-dropdown m-r--0">
                                    <li class="dropdown">
                                        <a class="close-details" href="javascript:void(0);">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">

                                <h2 class="card-inside-title">Tanggal Mulai Seleksi</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_det_date_start form-control" placeholder="Pilih tanggal..." name="selection_det_date_start" required>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tanggal Selesai Seleksi</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_det_date_end form-control" placeholder="Pilih tanggal..." name="selection_det_date_end" required>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tanggal Mulai Pelaksanaan</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_det_imp_date_start form-control" placeholder="Pilih tanggal..." name="selection_det_imp_date_start" required>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tanggal Selesai Pelaksanaan</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_det_imp_date_end form-control" placeholder="Pilih tanggal..." name="selection_det_imp_date_end" required>
                                    </div>
                                </div>

                                <!-- Select Guide Files -->
                                <div class="alert bg-grey">
                                    Silahkan pilih file yang akan ditampilah di halaman seleksi inkubasi. Bisa memilih lebih dari 1 file panduan.
                                </div>
                                <div class="form-group multi_select">
                                    <?php
                                        $option = array();
                                        $extra = 'class="form-control def" id="selection_det_files" multiple="multiple" size="5"';
                
                                        if( !empty($guide_files) ){
                                            foreach($guide_files as $val){
                                                $option[$val->id] = $val->title . ' ('.$val->size.')';
                                            }
                                        }                                        
                                        echo form_dropdown('selection_det_files[]',$option,'',$extra);
                                    ?>
                                </div>
                                
                                <!-- Juri Phase 1 -->
                                <div class="alert bg-grey">
                                    Silahkan pilih juri tahap 1. Bisa memilih lebih dari 1 juri.
                                </div>
                                <h2 class="card-inside-title">Juri Tahap 1 Administrasi dan Subtansi</h2>
                                <div class="form-group multi_select">
                                    <?php
                                        $option = array();
                                        $extra = 'class="form-control def" id="selection_det_juri_phase1" multiple="multiple" size="5"';
                
                                        if( !empty($juri_list) ){
                                            foreach($juri_list as $val){
                                                $option[$val->id] = $val->name . ' ('.$val->username.')';
                                            }
                                        }                                        
                                        echo form_dropdown('selection_det_juri_phase1[]',$option,'',$extra);
                                    ?>
                                </div>
                                
                                <!-- Juri Phase 2 -->
                                <div class="alert bg-grey">
                                    Silahkan pilih juri tahap 2. Bisa memilih lebih dari 1 juri.
                                </div>
                                <h2 class="card-inside-title">Juri Tahap 2 Presentasi dan Wawancara</h2>
                                <div class="form-group multi_select">
                                    <?php
                                        $option = array();
                                        $extra = 'class="form-control def" id="selection_det_juri_phase2" multiple="multiple" size="5"';
                
                                        if( !empty($juri_list) ){
                                            foreach($juri_list as $val){
                                                $option[$val->id] = $val->name . ' ('.$val->username.')';
                                            }
                                        }                                        
                                        echo form_dropdown('selection_det_juri_phase2[]',$option,'',$extra);
                                    ?>
                                </div>
                                <button class="btn btn-warning m-t-15 waves-effect close-details" type="button">Tutup</button>
                                <button class="btn btn-primary m-t-15 waves-effect" type="button">Update Pengaturan</button>
                                
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <div id="alert" class="alert display-hide"></div>
                        <?php echo form_open_multipart( base_url('selectionsetting'), array( 'id'=>'selection_incubation_wizard', 'role'=>'form' ) ); ?>
                            <h3>Tanggal Seleksi</h3>
                            <section>
                                <h2 class="card-inside-title">Tanggal Mulai Seleksi</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_date_start form-control" placeholder="Pilih tanggal..." name="selection_date_start" required>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tanggal Selesai Seleksi</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_date_end form-control" placeholder="Pilih tanggal..." name="selection_date_end" required>
                                    </div>
                                </div>
                            </section>
                            
                            <h3>Jadwal Pelaksanaan</h3>
                            <section>
                                <h2 class="card-inside-title">Tanggal Mulai Pelaksanaan</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_imp_date_start form-control" placeholder="Pilih tanggal..." name="selection_imp_date_start" required>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tanggal Selesai Pelaksanaan</h2>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" class="selection_imp_date_end form-control" placeholder="Pilih tanggal..." name="selection_imp_date_end" required>
                                    </div>
                                </div>
                            </section>
                            
                            <h3>Berkas Panduan</h3>
                            <section>
                                <div class="alert bg-grey">
                                    Silahkan pilih file yang akan ditampilah di halaman seleksi inkubasi. Bisa memilih lebih dari 1 file panduan.
                                </div>
                                <!-- Select Guide Files -->
                                <div class="form-group multi_select">
                                    <?php
                                        $option = array();
                                        $extra = 'class="form-control def" id="selection_files" multiple="multiple" size="5"';
                
                                        if( !empty($guide_files) ){
                                            foreach($guide_files as $val){
                                                $option[$val->id] = $val->title . ' ('.$val->size.')';
                                            }
                                        }                                        
                                        echo form_dropdown('selection_files[]',$option,'',$extra);
                                    ?>
                                </div>
                                <!-- #END# Select Guide Files -->
                            </section>
        
                            <h3>Penentuan Juri</h3>
                            <section>
                                <div class="alert bg-grey">
                                    Silahkan pilih juri tahap 1. Bisa memilih lebih dari 1 juri.
                                </div>
                                <!-- Juri Phase 1 -->
                                <h2 class="card-inside-title">Juri Tahap 1 Administrasi dan Subtansi</h2>
                                <!-- Select Juri Phase 1 -->
                                <div class="form-group multi_select">
                                    <?php
                                        $option = array();
                                        $extra = 'class="form-control def" id="selection_juri_phase1" multiple="multiple" size="5"';
                
                                        if( !empty($juri_list) ){
                                            foreach($juri_list as $val){
                                                $option[$val->id] = $val->name . ' ('.$val->username.')';
                                            }
                                        }                                        
                                        echo form_dropdown('selection_juri_phase1[]',$option,'',$extra);
                                    ?>
                                </div>
                                <!-- #END# Juri Tahap 1 -->
                                
                                <div class="alert bg-grey">
                                    Silahkan pilih juri tahap 2. Bisa memilih lebih dari 1 juri.
                                </div>
                                <!-- Juri Phase 2 -->
                                <h2 class="card-inside-title">Juri Tahap 2 Presentasi dan Wawancara</h2>
                                <!-- Select Juri Phase 2 -->
                                <div class="form-group multi_select">
                                    <?php
                                        $option = array();
                                        $extra = 'class="form-control def" id="selection_juri_phase2" multiple="multiple" size="5"';
                
                                        if( !empty($juri_list) ){
                                            foreach($juri_list as $val){
                                                $option[$val->id] = $val->name . ' ('.$val->username.')';
                                            }
                                        }                                        
                                        echo form_dropdown('selection_juri_phase2[]',$option,'',$extra);
                                    ?>
                                </div>
                                <!-- #END# Juri Tahap 2 -->
                            </section>
        
                            <h3>Informasi Detail</h3>
                            <section>
                                <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                <label for="acceptTerms-2">Saya setuju dengan ketentuan pengaturan seleksi.</label>
                            </section>
                        <?php echo form_close(); ?>          
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE SELECTION MODAL -->
<div class="modal fade" id="save_selectionincubationsetting" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Simpan Pengaturan Pembukaan Seleksi Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Apakah Anda sudah yakin dengan data Pengaturan Pembukaan Seleksi Inkubasi?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_selectionincubationsetting" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SELECTION MODAL -->