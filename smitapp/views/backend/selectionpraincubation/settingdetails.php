<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Details Pengaturan Seleksi Pra-Inkubasi</h2>
            </div>
            <div class="body">
            
                <?php echo form_open_multipart( base_url('detilprainkubasi/'.$pis_data->uniquecode), array( 'id'=>'details_selection_praincubation', 'role'=>'form' ) ); ?>
                <?php if( $this->session->flashdata('message') ){?>
                    <?php echo $this->session->flashdata('message'); ?>
                <?php }?>
                
                <h3 class="top0">Tanggal Seleksi</h3>
                <div class="alert bg-teal">Pengaturan Tanggal Tahap 1</div>   
                <h2 class="card-inside-title">Tahun Publikasi</h2>
                <div class="form-group">
                    <div class="form-line">
                        <?php
                            $option = array(''=>'Pilih Tahun');
                            $year_arr = smit_select_year(date('Y'),2030);
                            $extra = 'class="form-control def" id="selection_year_publication"';
                            $selected = array($pis_data->selection_year_publication);
    
                            if( !empty($year_arr) ){
                                foreach($year_arr as $val){
                                    $option[$val] = $val;
                                }
                            }                                        
                            echo form_dropdown('selection_year_publication',$option,$selected,$extra);
                        ?>
                    </div>
                </div>

                <h2 class="card-inside-title">Publikasi</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="selection_date_publication form-control" placeholder="Pilih tanggal..." 
                        name="selection_date_publication" value="<?php echo $pis_data->selection_date_publication; ?>" required>
                    </div>
                </div>

                <h2 class="card-inside-title">Pendaftaran Online</h2>
                <div class="row">
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_reg_start form-control" placeholder="Pilih tanggal mulai..." 
                                name="selection_date_reg_start" value="<?php echo $pis_data->selection_date_reg_start; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_reg_end form-control" placeholder="Pilih tanggal selesai..." 
                                name="selection_date_reg_end" value="<?php echo $pis_data->selection_date_reg_end; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="card-inside-title">Seleksi Administrasi &amp; Substansi Awal</h2>
                <div class="row">
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_adm_start form-control" placeholder="Pilih tanggal mulai..." 
                                name="selection_date_adm_start" value="<?php echo $pis_data->selection_date_adm_start; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_adm_end form-control" placeholder="Pilih tanggal selesai..." 
                                name="selection_date_adm_end" value="<?php echo $pis_data->selection_date_adm_end; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h2 class="card-inside-title">Undangan Presentasi Dikirim</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="selection_date_invitation_send form-control" placeholder="Pilih tanggal..." 
                        name="selection_date_invitation_send" value="<?php echo $pis_data->selection_date_invitation_send; ?>" required>
                    </div>
                </div>
                
                <div class="alert bg-teal">Pengaturan Tanggal Tahap 2</div>
                <h2 class="card-inside-title">Seleksi Presentasi &amp; Wawancara</h2>
                <div class="row">
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_interview_start form-control" placeholder="Pilih tanggal mulai..." 
                                name="selection_date_interview_start" value="<?php echo $pis_data->selection_date_interview_start; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_interview_end form-control" placeholder="Pilih tanggal selesai..." 
                                name="selection_date_interview_end" value="<?php echo $pis_data->selection_date_interview_end; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h2 class="card-inside-title">Pengumuman Hasil Seleksi</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="selection_date_result form-control" placeholder="Pilih tanggal..." 
                        name="selection_date_result" value="<?php echo $pis_data->selection_date_result; ?>" required>
                    </div>
                </div>
                
                <h2 class="card-inside-title">Perbaikan Proposal &amp; Penelaahan Anggaran</h2>
                <div class="row">
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_proposal_start form-control" placeholder="Pilih tanggal mulai..." 
                                name="selection_date_proposal_start" value="<?php echo $pis_data->selection_date_proposal_start; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_date_proposal_end form-control" placeholder="Pilih tanggal selesai..." 
                                name="selection_date_proposal_end" value="<?php echo $pis_data->selection_date_proposal_end; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h2 class="card-inside-title">Penetapan &amp; Penandatanganan Perjanjian</h2>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="selection_date_agreement form-control" placeholder="Pilih tanggal..." 
                        name="selection_date_agreement" value="<?php echo $pis_data->selection_date_agreement; ?>" required>
                    </div>
                </div>
                
                <h2 class="card-inside-title">Pelaksanaan Kegiatan</h2>
                <div class="row">
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_imp_date_start form-control" placeholder="Pilih tanggal mulai..." 
                                name="selection_imp_date_start" value="<?php echo $pis_data->selection_imp_date_start; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bottom0">
                        <div class="form-group bottom0">
                            <div class="form-line">
                                <input type="text" class="selection_imp_date_end form-control" placeholder="Pilih tanggal selesai..." 
                                name="selection_imp_date_end" value="<?php echo $pis_data->selection_imp_date_end; ?>" required>
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
                                    'placeholder'=>'Silahkan isi deskripsi dari pengaturan...',
                                    'value'=>$pis_data->selection_desc
                                )
                            ); 
                        ?>
                    </div>
                </div>
                
                <h3 class="top10">Berkas Panduan</h3>
                <div class="alert bg-teal">
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
                        echo form_dropdown('selection_files[]',$option,$pis_data->selection_files,$extra);
                    ?>
                </div>
                <!-- #END# Select Guide Files -->
                
                <h3 class="top10">Penentuan Juri</h3>
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
                        echo form_dropdown('selection_juri_phase1[]',$option,$pis_data->selection_juri_phase1,$extra);
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
                        echo form_dropdown('selection_juri_phase2[]',$option,$pis_data->selection_juri_phase2,$extra);
                    ?>
                </div>
                <!-- #END# Juri Tahap 2 -->
                
                <a href="<?php echo base_url('seleksiprainkubasi/pengaturan'); ?>" class="btn btn-sm btn-default waves-effect" type="button"><i class="material-icons">arrow_back</i> Kembali</a>
                <button class="btn btn-medium btn-warning waves-effect" type="submit"><i class="material-icons">edit</i> Ubah Pengaturan</button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE SELECTION DETAILS MODAL -->
<div class="modal fade" id="save_selectionpraincubationsettingdetails" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Update Pengaturan Pembukaan Seleksi Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Apakah Anda sudah yakin dengan data Pengaturan Pembukaan Seleksi Pra-nkubasi?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_selectionpraincubationsettingdetails" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SELECTION DETAILS MODAL -->