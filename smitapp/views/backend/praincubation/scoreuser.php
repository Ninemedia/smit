<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Penilaian Seleksi Pra-Inkubasi Tahap 1</h2>
            </div>
            <div class="body">
                <?php if($is_admin): ?>
                    <div class="pull-right bottom25">                        
                        <a href="<?php echo base_url('prainkubasi/nilai'); ?>" class="btn btn-sm btn-success waves-effect back">Kembali</a>     
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />
                    
                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="adminscore_stepone" data-url="<?php echo base_url('prainkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="5" style="width25;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>  	
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    $sum_score      = $this->Model_Praincubation->sum_all_score($data_selection->id);
                                    $count_all_jury = $this->Model_Praincubation->count_all_score($data_selection->id);
                                    $avarage_score  = $sum_score / $count_all_jury;
                                ?>
                                <tr>
                                    <td colspan="7" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP1 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo $avarage_score; ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo $avarage_score; ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = Nilai Dokumen</ol>
                                    <ol>B = Nilai Target</ol>
                                    <ol>C = Nilai Perlindungan</ol>
                                    <ol>D = Nilai Penelitian</ol>
                                    <ol>E = Nilai Market</ol>
                                </ul>
                            </p>
                        </div>
                    </div>
                <?php elseif($is_jury): ?>
                    <!-- Score Pra Incubation Details -->
                    <div class="body">
                        
                        
                        <div class="row">
                            <div class="col-md-12 bottom0">                      
                                <a href="<?php echo base_url('prainkubasi/nilai'); ?>" class="btn btn-sm btn-success waves-effect back">Kembali</a>
                                <hr />
                            </div>
                            
                            <div class="col-md-12 bottom0">
                                <div id="alert-display"></div>
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
                                
                                <h2 class="card-inside-title text-uppercase">Berkas dan Proposal Kegiatan</h2>
                                <?php
                                    if( !empty($data_selection_files) ){
                                        echo '<ul class="bottom40">';
                                        foreach($data_selection_files as $file){
                                            echo '<li>'.strtoupper($file->filename).' - <a href="'.base_url('unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                        }
                                        echo '</ul>';
                                    }else{
                                        echo '<strong>Tidak ada berkas panduan</strong>';
                                    }
                                ?>
                                
                                <?php echo form_open_multipart( base_url('prainkubasi/prosesnilai/1'), array( 'id'=>'selection_score_step1', 'role'=>'form' ) ); ?>
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
                                                    <select class="form-control rate-step1" name="nilai_dokumen" data-rate="20"> 
                        	                        	<option value="">Beri Nilai..</option>
                                                        <option value="20">Lengkap</option>
                                                        <option value="0">Tidak Lengkap</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">2</td>
                                                <td class="text-middle">Kesesuaian Target dan Biaya</td>
                                                <td class="text-middle align-center">20</td>
                                                <td>
                                                    <select class="form-control rate-step1" name="nilai_target" data-rate="20">
                        	                        	<option value="">Beri Nilai..</option>
                                                        <option value="20">Lengkap</option>
                                                        <option value="0">Tidak Lengkap</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">3</td>
                                                <td class="text-middle">Adanya Perlindungan KI</td>
                                                <td class="text-middle align-center">20</td>
                                                <td>
                                                    <select class="form-control rate-step1" name="nilai_perlingungan" data-rate="20">
                        	                        	<option value="">Beri Nilai..</option>
                                                        <option value="20">Lengkap</option>
                                                        <option value="0">Tidak Lengkap</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">4</td>
                                                <td class="text-middle">Penelitian Lanjutan</td>
                                                <td class="text-middle align-center">10</td>
                                                <td>
                                                    <select class="form-control rate-step1" name="nilai_penelitian" data-rate="10">
                        	                        	<option value="">Beri Nilai..</option>
                                                        <option value="10">Lengkap</option>
                                                        <option value="0">Tidak Lengkap</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle text-center">5</td>
                                                <td class="text-middle">Marketable</td>
                                                <td class="text-middle align-center">30</td>
                                                <td>
                                                    <select class="form-control rate-step1" name="nilai_market" data-rate="30">
                        	                        	<option value="">Beri Nilai..</option>
                                                        <option value="30">Lengkap</option>
                                                        <option value="0">Tidak Lengkap</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-middle"></td>
                                                <td class="text-middle"><strong>Jumlah Nilai</strong></td>
                                                <td class="text-middle text-center"><input class="text-center input-mini text-darken-1" name="nilai_total_tahap1" id="nilai_total_tahap1" value="0" /></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </table>
                                </div>
                                <h2 class="card-inside-title text-uppercase">Komentar Juri</h2>
                                <div class="form-group">
                                    <textarea class="form-control ckeditor" name="nilai_juri_comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="nilai_selection_id" value="<?php echo $data_selection->id; ?>" />
                                    <button class="btn btn-lg btn-primary waves-effect btn-rate-step1" type="button">
                                        <i class="material-icons">phone</i> Selesai
                                    </button>
                                    <button class="btn btn-lg btn-danger waves-effect btn-rate-step1-reset" type="button">
                                        <i class="material-icons">close</i> Bersihkan
                                    </button>
                                </div>
                            <?php echo form_close(); ?> 
                        </div>
                    </div>
                    <!-- End Score Incubation Details -->
                    
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->