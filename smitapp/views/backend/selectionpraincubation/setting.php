<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Seleksi Pra-Inkubasi</h2></div>
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
                            <i class="material-icons">add_box</i> TAMBAH
                        </a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="selection">
                        <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="praincubation_setting_list" data-url="<?php echo base_url('daftarprainkubasi'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
        							<th class="width10 text-center">Tahun<br />Seleksi</th>
        							<th class="width15 text-center">Tanggal<br />Publikasi</th>
        							<th class="width25 text-center">Tanggal<br />Pendaftaran Online</th>
                                    <th class="width20 text-center">Keterangan</th>
                                    <th class="width10 text-center">Status</th>
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
        							<td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="selection_date_publication_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="selection_date_publication_max" placeholder="To" />
        							</td>
        							<td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_date_reg_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_date_reg_max" placeholder="To" />
        							</td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm" name="search_desc" placeholder="Cari..." />
        							</td>
                                    <td>
                                        <select name="search_status" class="form-control form-filter input-sm def">
    										<option value="">Select...</option>
    										<option value="1">OPEN</option>
    										<option value="0">CLOSED</option>
    									</select>
                                    </td>
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubation_setting_list">Search</button>
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
                        <?php $latest_selection_praincubation_setting = smit_latest_praincubation_setting(); ?>
                        <?php if( !empty($latest_selection_praincubation_setting) ){ ?>
                            <div class="alert alert-info bottom15">Pengaturan Pra-Inkubasi tidak dapat ditambahkan karena saat ini sedang dibuka Seleksi Pra-Inkubasi</div>
                            <p>Pastikan anda telah menambahkan juri. Link menambahkan juri <a href="<?php echo base_url('pengguna/tambah'); ?>">Tambah Juri</a>. Dan pastikan data berkas digital telah terunggah sebelumnya pada menu <a href="<?php echo base_url('berkas/digital'); ?>">Berkas Digital</a> </p>
                            <hr />
                        <?php }else{ ?>
                            <p>Pastikan anda telah menambahkan juri. Link menambahkan juri <a href="<?php echo base_url('pengguna/tambah'); ?>">Tambah Juri</a>. Dan pastikan data berkas digital telah terunggah sebelumnya pada menu <a href="<?php echo base_url('berkas/digital'); ?>">Berkas Digital</a> </p>
                            <hr />
                            <div id="alert" class="alert display-hide"></div>
                            <?php echo form_open_multipart( base_url('selectionsetting'), array( 'id'=>'selection_praincubation_wizard', 'role'=>'form' ) ); ?>
                                <h3>Tanggal Seleksi</h3>
                                <section>
                                    <div class="alert bg-teal">Pengaturan Tanggal Tahap 1</div>
                                    
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
    
                                    <h2 class="card-inside-title">Publikasi</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="selection_date_publication form-control" placeholder="Pilih tanggal..." name="selection_date_publication" required>
                                        </div>
                                    </div>
    
                                    <h2 class="card-inside-title">Pendaftaran Online</h2>
                                    <div class="row">
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_reg_start form-control" placeholder="Pilih tanggal mulai..." name="selection_date_reg_start" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_reg_end form-control" placeholder="Pilih tanggal selesai..." name="selection_date_reg_end" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h2 class="card-inside-title">Seleksi Administrasi &amp; Substansi Awal</h2>
                                    <div class="row">
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_adm_start form-control" placeholder="Pilih tanggal mulai..." name="selection_date_adm_start" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_adm_end form-control" placeholder="Pilih tanggal selesai..." name="selection_date_adm_end" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h2 class="card-inside-title">Undangan Presentasi Dikirim</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="selection_date_invitation_send form-control" placeholder="Pilih tanggal..." name="selection_date_invitation_send" required>
                                        </div>
                                    </div>
                                    
                                    <div class="alert bg-teal">Pengaturan Tanggal Tahap 2</div>
                                    <h2 class="card-inside-title">Seleksi Presentasi &amp; Wawancara</h2>
                                    <div class="row">
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_interview_start form-control" placeholder="Pilih tanggal mulai..." name="selection_date_interview_start" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_interview_end form-control" placeholder="Pilih tanggal selesai..." name="selection_date_interview_end" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h2 class="card-inside-title">Pengumuman Hasil Seleksi</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="selection_date_result form-control" placeholder="Pilih tanggal..." name="selection_date_result" required>
                                        </div>
                                    </div>
                                    
                                    <h2 class="card-inside-title">Perbaikan Proposal &amp; Penelaahan Anggaran</h2>
                                    <div class="row">
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_proposal_start form-control" placeholder="Pilih tanggal mulai..." name="selection_date_proposal_start" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_date_proposal_end form-control" placeholder="Pilih tanggal selesai..." name="selection_date_proposal_end" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h2 class="card-inside-title">Penetapan &amp; Penandatanganan Perjanjian</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="selection_date_agreement form-control" placeholder="Pilih tanggal..." name="selection_date_agreement" required>
                                        </div>
                                    </div>
                                    
                                    <h2 class="card-inside-title">Pelaksanaan Kegiatan</h2>
                                    <div class="row">
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_imp_date_start form-control" placeholder="Pilih tanggal mulai..." name="selection_imp_date_start" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bottom0">
                                            <div class="form-group bottom0">
                                                <div class="form-line">
                                                    <input type="text" class="selection_imp_date_end form-control" placeholder="Pilih tanggal selesai..." name="selection_imp_date_end" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
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
                                    <table class="selection-details-table">
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert bg-grey bottom0">Pengaturan Tanggal Tahap 1</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="width35"><strong>Tahun Publikasi</strong></td><td class="width5"> : </td>
                                            <td class="width60"><div class="selection_det_year_publication">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Publikasi</strong></td><td> : </td>
                                            <td><div class="selection_det_date_publication">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pendaftaran Online</strong></td><td> : </td>
                                            <td><div class="selection_det_reg">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Seleksi Administrasi &amp; Substansi Awal</strong></td><td> : </td>
                                            <td><div class="selection_det_adm">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Undangan Presentasi Dikirim</strong></td><td> : </td>
                                            <td><div class="selection_det_invitation_send">-</div></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert bg-grey bottom0">Pengaturan Tanggal Tahap 2</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Seleksi Presentasi &amp; Wawancara</strong></td><td> : </td>
                                            <td><div class="selection_det_interview">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pengumuman Hasil Seleksi</strong></td><td> : </td>
                                            <td><div class="selection_det_result">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Perbaikan Proposal &amp; Penelaahan Anggaran</strong></td><td> : </td>
                                            <td><div class="selection_det_proposal">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Penetapan &amp; Penandatanganan Perjanjian</strong></td><td> : </td>
                                            <td><div class="selection_det_date_agreement">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pelaksanaan Kegiatan</strong></td><td> : </td>
                                            <td><div class="selection_det_imp_date">-</div></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Keterangan</strong></td><td> : </td>
                                            <td><div class="selection_det_desc">-</div></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="alert bg-grey bottom0">Berkas Panduan</div>
                                            </td>
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
                            <?php echo form_close(); ?>   
                        <?php }?>       
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE SELECTION MODAL -->
<div class="modal fade" id="save_selectionpraincubationsetting" tabindex="-1" role="basic" aria-hidden="true">
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
				<button type="button" class="btn btn-info waves-effect" id="do_save_selectionpraincubationsetting" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SELECTION MODAL -->