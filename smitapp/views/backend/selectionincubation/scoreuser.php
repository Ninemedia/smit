<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Penilaian Seleksi Inkubasi Tahap 1</h2>
            </div>
            <div class="body">
                <?php if($is_jury): ?>

                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bottom20">
                            <a href="<?php echo base_url('seleksiinkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect pull-right back"><i class="material-icons">arrow_back</i> Kembali</a>
                        </div>
                    </div>
                    <div id="alert-display"></div>

                    <!-- Multiple Items To Be Open -->
                    <div class="panel-group" id="accordion_19" role="tablist" aria-multiselectable="true">
                        <h4 class="text-center"><?php echo strtoupper($data_selection->user_name); ?></h4>
                        <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />
                        <!-- FORMULIR PENGUSUL -->
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="formulir">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_formulir" aria-expanded="true" aria-controls="collapse_formulir">
                                        <i class="material-icons">view_list</i> FORMULIR PENGUSUL
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_formulir" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="formulir">
                                <div class="panel-body">
                                    <h2 class="card-inside-title text-uppercase">Identitas Pengusul</h2>
                                    <div class="form-group form-float">
                                        <label class="form-label">Nama Pengusul</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_event_title" id="reg_event_title" class="form-control" value="<?php echo $data_selection->user_name; ?>" disabled="" />
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="card-inside-title text-uppercase">Usulan Kegiatan Inkubasi</h2>
                                    <div class="form-group form-float">
                                        <label class="form-label">Judul Kegiatan</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_event_title" id="reg_event_title" class="form-control" value="<?php echo $data_selection->event_title; ?>" disabled="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Kategori Bidang</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_category" id="reg_category" class="form-control" value="<?php echo $data_selection->category; ?>" disabled="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="input-group">
                                            <label class="form-label">Deskripsi Kegiatan</label>
                                            <div class="form-line">
                                                <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize" disabled="" ><?php echo $data_selection->event_desc; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BERKAS DAN PROPOSAL KEGIATAN -->
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="berkas">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_berkas" aria-expanded="false" aria-controls="collapse_berkas">
                                        <i class="material-icons">folder_open</i> BERKAS DAN PROPOSAL KEGIATAN
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_berkas" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="berkas">
                                <div class="panel-body">
                                    <h2 class="card-inside-title text-uppercase">Berkas dan Proposal Kegiatan</h2>
                                    <?php
                                        if( !empty($data_selection_files) ){
                                            echo '<ul class="bottom=0">';
                                            foreach($data_selection_files as $file){
                                                echo '<li>'.strtoupper($file->filename).' <a href="'.base_url('inkubasi/unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                            }
                                            echo '</ul>';
                                        }else{
                                            echo '<strong>Tidak ada berkas panduan</strong>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- PENILAIAN -->
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="nilai">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_nilai" aria-expanded="false" aria-controls="collapse_nilai">
                                        <i class="material-icons">edit</i> PENILAIAN
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_nilai" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="nilai">
                                <div class="panel-body">
                                    <?php echo form_open_multipart( base_url('seleksiinkubasi/prosesnilai/1'), array( 'id'=>'selectionincubation_score_step1', 'role'=>'form' ) ); ?>
                                    <h2 class="card-inside-title text-uppercase">Penilaian Berkas</h2>
                                    <div class="table-container table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="jury_stepone">
                                            <tr class="bg-blue-grey">
                                                <th class="width5 text-center">No</th>
                    							<th class="width15 text-center">Kriteria Penilaian</th>
                    							<th class="width5 text-center">Bobot</th>
                                                <th class="width10 text-center">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">1</td>
                                                <td class="text-middle">Kelengkapan Dokumen</td>
                                                <td class="text-middle align-center">20</td>
                                                <td>
                                                    <div class="input-group bottom0">
                                                        <select class="form-control rate-step1 select-def" name="nilai_dokumen" id="nilai_dokumen" data-rate="20" data-plus="0">
                            	                        	<option value="" selected="selected">Beri Nilai..</option>
                                                            <option value="20">Ya</option>
                                                            <option value="0">Tidak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">2</td>
                                                <td class="text-middle">Kesesuaian Target dan Biaya</td>
                                                <td class="text-middle align-center">20</td>
                                                <td>
                                                    <div class="input-group bottom0">
                                                        <select class="form-control rate-step1 select-def" name="nilai_target" id="nilai_target" data-rate="20" data-plus="0">
                            	                        	<option value="" selected="selected">Beri Nilai..</option>
                                                            <option value="20">Ya</option>
                                                            <option value="0">Tidak</option>
                                                        </select>
                                                      </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">3</td>
                                                <td class="text-middle">Adanya Perlindungan KI</td>
                                                <td class="text-middle align-center">20</td>
                                                <td>
                                                    <div class="input-group bottom0">
                                                        <select class="form-control rate-step1 select-def" name="nilai_perlingungan" id="nilai_perlingungan" data-rate="20" data-plus="0">
                            	                        	<option value="" selected="selected">Beri Nilai..</option>
                                                            <option value="20">Ya</option>
                                                            <option value="0">Tidak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">4</td>
                                                <td class="text-middle">Penelitian Lanjutan</td>
                                                <td class="text-middle align-center">10</td>
                                                <td>
                                                    <div class="input-group bottom0">
                                                        <select class="form-control rate-step1 select-def" name="nilai_penelitian" id="nilai_penelitian" data-rate="10" data-plus="0">
                            	                        	<option value="" selected="selected">Beri Nilai..</option>
                                                            <option value="10">Ya</option>
                                                            <option value="0">Tidak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">5</td>
                                                <td class="text-middle">Marketable</td>
                                                <td class="text-middle align-center">30</td>
                                                <td>
                                                    <div class="input-group bottom0">
                                                        <select class="form-control rate-step1 select-def" name="nilai_market" id="nilai_market" data-rate="30" data-plus="0">
                            	                        	<option value="" selected="selected">Beri Nilai..</option>
                                                            <option value="30">Ya</option>
                                                            <option value="0">Tidak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle"></td>
                                                <td class="text-middle"><strong>Jumlah Nilai</strong></td>
                                                <td class="text-middle text-center">
                                                    <input class="text-center input-mini text-darken-1" name="nilai_total_tahap1" id="nilai_total_tahap1" value="0" readonly="readonly" />
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <h2 class="card-inside-title text-uppercase">Komentar Juri</h2>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea name="nilai_juri_comment" id="nilai_juri_comment" cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Kegiatan Anda" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="nilai_selection_id" value="<?php echo $data_selection->id; ?>" />
                                        <button class="btn btn-sm btn-primary waves-effect btn-rate-step1" type="submit">
                                            <i class="material-icons">done</i> Nilai
                                        </button>
                                        <button class="btn btn-sm btn-danger waves-effect btn-rate-step1-resetincubation" type="button">
                                            <i class="material-icons">close</i> Bersihkan
                                        </button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Multiple Items To Be Open -->

                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE MODAL -->
<div class="modal fade" id="save_scoreuserincubation" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Penilaian Pengusul</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan memproses penilaian pengusul ini? Pastikan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_scoreuser_incubation" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE MODAL -->
