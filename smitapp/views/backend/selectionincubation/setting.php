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
                        <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="incubation_setting_list" data-url="<?php echo base_url('daftarseleksiinkubasi'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
        							<th class="width5 text-center">Tahun</th>
                                    <th class="width15 text-center">Juri Tahap 1</th>
                                    <th class="width15 text-center">Juri Tahap 2</th>
                                    <th class="width10 text-center">Status</th>
        							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    				            </tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        <?php $latest_selection_incubation_setting = smit_latest_incubation_setting(); ?>
                        <?php if( !empty($latest_selection_incubation_setting) ){ ?>
                            <div class="alert alert-warning bottom0">Pengaturan Inkubasi tidak dapat ditambahkan karena saat ini sedang dibuka Seleksi Inkubasi</div>
                        <?php }else{ ?>
                            <p>Pastikan anda telah menambahkan juri. Link menambahkan juri <a href="<?php echo base_url('pengguna/tambah'); ?>">Tambah Juri</a>. Dan pastikan data berkas digital telah terunggah sebelumnya pada menu <a href="<?php echo base_url('berkas/digital'); ?>">Berkas Digital</a> </p>
                            <hr />
                            <div id="alert" class="alert display-hide"></div>
                            <?php echo form_open_multipart( base_url('incubationselectionsetting'), array( 'id'=>'selection_incubation_wizard', 'role'=>'form' ) ); ?>
                                <h3>Berkas Panduan</h3>
                                <section>
                                    <div class="alert bg-grey">
                                        Silahkan pilih file yang akan ditampilah di halaman seleksi inkubasi. Bisa memilih lebih dari 1 file panduan.
                                    </div>
                                    <h2 class="card-inside-title">Tahun Publikasi</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_arr = smit_select_year(date('Y'),2030);
                                                $extra = 'class="form-control def" id="selection_year_publication" required';
                        
                                                if( !empty($year_arr) ){
                                                    foreach($year_arr as $val){
                                                        $option[$val] = $val;
                                                    }
                                                }                                        
                                                echo form_dropdown('selection_year_publication',$option,'',$extra);
                                            ?>
                                        </div>
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
                                    <h2 class="card-inside-title">Keterangan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php 
                                                echo form_textarea(
                                                    array(
                                                        'name'=>'selection_desc',
                                                        'class'=>'form-control no-resize selection_desc',
                                                        'rows'=>4,
                                                        'placeholder'=>'Silahkan isi deskripsi dari pengaturan...'
                                                    )
                                                ); 
                                            ?>
                                        </div>
                                    </div>
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
                                    <table class="selection-details-table">
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert bg-grey bottom0">Tahun dan Berkas Panduan</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width35"><strong>Tahun Publikasi</strong></td><td class="width5"> : </td>
                                            <td class="width60"><div class="selection_det_year_publication">-</div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-top"><strong>Berkas Panduan</strong></td><td class="text-top"> : </td>
                                            <td class="text-top"><div class="selection_det_selection_files">-</div></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert bg-grey bottom0">Penentuan Juri</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-top"><strong>Juri Tahap 1 Administrasi dan Subtansi</strong></td><td class="text-top"> : </td>
                                            <td class="text-top"><div class="selection_det_juri_phase1">-</div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-top"><strong>Juri Tahap 2 Presentasi dan Wawancara</strong></td><td class="text-top"> : </td>
                                            <td class="text-top"><div class="selection_det_juri_phase2">-</div></td>
                                        </tr>
                                    </table>
                                
                                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                    <label for="acceptTerms-2">Saya setuju dengan ketentuan pengaturan seleksi.</label>
                                </section>
                        <?php }?>    
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
				<h4 class="modal-title">Simpan Pengaturan Seleksi Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Apakah Anda sudah yakin dengan data Pengaturan Seleksi Inkubasi?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_selectionincubationsetting" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SELECTION MODAL -->