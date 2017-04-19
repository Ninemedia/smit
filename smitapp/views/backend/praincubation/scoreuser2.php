<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Penilaian Seleksi Pra-Inkubasi Tahap 2</h2></div>
            <div class="body">
                <?php if($is_jury): ?>
                    <!-- Score Pra Incubation Details -->
                    <div class="body">
                        <div class="row">
                            <div class="col-md-12 bottom0">                      
                                <a href="<?php echo base_url('prainkubasi/nilai'); ?>" class="btn btn-sm btn-success waves-effect pull-right back"><i class="material-icons">arrow_back</i> Kembali</a>
                                <br /><br />
                            </div>
                            <div class="col-md-12 bottom0">
                                <div id="alert-display"></div>
                                <!-- Multiple Items To Be Open -->
                                <div class="panel-group" id="accordion_19" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-blue">
                                        <div class="panel-heading" role="tab" id="formulir">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapse_formulir" aria-expanded="true" aria-controls="collapse_formulir">
                                                    <i class="material-icons">view_list</i> FORMULIR EVALUASI TEKNOLOGI LIPI
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_formulir" class="panel-collapse collapse" role="tabpanel" aria-labelledby="formulir">
                                            <div class="panel-body">
                                                <h2 class="card-inside-title text-uppercase top25">FORMULIR EVALUASI TEKNOLOGI LIPI</h2>
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
                                                <?php $workunit_type = smit_workunit_type($data_selection->workunit); ?>
                                                <div class="form-group form-float">
                                                    <label class="form-label">Satuan Kerja/PT/CV</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                        <div class="form-line">
                                                            <input type="text" name="eval_unit" id="eval_unit" class="form-control" value="<?php echo strtoupper($workunit_type->workunit_name); ?>" disabled="" />
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
                                    <div class="panel panel-col-blue">
                                        <div class="panel-heading" role="tab" id="berkas">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_berkas" aria-expanded="false" aria-controls="collapse_berkas">
                                                    <i class="material-icons">folder_open</i> BERKAS DAN PROPOSAL KEGIATAN
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_berkas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="berkas">
                                            <div class="panel-body">
                                                <h2 class="card-inside-title text-uppercase">Berkas dan Proposal Kegiatan</h2>
                                                <?php
                                                    if( !empty($data_selection_files) ){
                                                        echo '<ul class="bottom40">';
                                                        foreach($data_selection_files as $file){
                                                            echo '<li>'.strtoupper($file->filename).' - <a href="'.base_url('prainkubasi/unduh//'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                                        }
                                                        echo '</ul>';
                                                    }else{
                                                        echo '<strong>Tidak ada berkas panduan</strong>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-col-blue">
                                        <div class="panel-heading" role="tab" id="nilai">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_nilai" aria-expanded="false" aria-controls="collapse_nilai">
                                                    <i class="material-icons">edit</i> Penilaian
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_nilai" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="nilai">
                                            <div class="panel-body">
                                                <?php echo form_open_multipart( base_url('prainkubasi/prosesnilai/1'), array( 'id'=>'selection_score_step1', 'role'=>'form' ) ); ?>
                                                <h2 class="card-inside-title text-uppercase">Penilaian Berkas</h2>
                                                <div class="table-container table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" id="jury_steptwo">
                                                        <thead>
                                                            <tr class="bg-blue-grey">
                                                                <td colspan="2"><strong>TOTAL NILAI</strong></td>
                                                                <td class="text-large text-center"><input class="text-center input-mini text-darken-1" name="total_rate" id="total_rate" value="0" /></td>
                                                            </tr>
                                    						<tr role="row" class="heading">
                                    							<th class="width15 text-center text-middle">Klaster Kriteria</th>
                                    							<th class="width15 text-center text-middle">Unsur/Kriteria</th>
                                    							<th class="width40 text-center text-middle">Indikator</th>
                                    						</tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Data Will Be Placed Here -->
                                                            
                                                            <!-- Pasar -->
                                                            <tr>
                                                                <td rowspan="5">Pasar<br />(Total 100%)</td>
                                                                <td>Deskripsi Kebutuhan Pengguna</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster1_a_indikator" id="klaster1_a_indikator" data-selector="klaster1_a" value="" />
                                                                    <input type="hidden" name="klaster1_a_max" id="klaster1_a_max" value="30" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster1_a_rate" id="klaster1_a_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Deskripsi Sasaran Pengguna</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster1_b_indikator" id="klaster1_b_indikator" data-selector="klaster1_b" value="" />
                                                                    <input type="hidden" name="klaster1_b_max" id="klaster1_b_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster1_b_rate" id="klaster1_b_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Besar Pasar</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster1_c_indikator" id="klaster1_c_indikator" data-selector="klaster1_c" value="" />
                                                                    <input type="hidden" name="klaster1_c_max" id="klaster1_c_max" value="20" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster1_c_rate" id="klaster1_c_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rencana Pemasaran</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster1_d_indikator" id="klaster1_d_indikator" data-selector="klaster1_d" value="" />
                                                                    <input type="hidden" name="klaster1_d_max" id="klaster1_d_max" value="25" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster1_d_rate" id="klaster1_d_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pertumbuhan Pasar</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster1_e_indikator" id="klaster1_e_indikator" data-selector="klaster1_e" value="" />
                                                                    <input type="hidden" name="klaster1_e_max" id="klaster1_e_max" value="10" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster1_e_rate" id="klaster1_e_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Produk/Jasa -->
                                                            <tr>
                                                                <td rowspan="5">Produk/Jasa<br />(Total 100%)</td>
                                                                <td>Deskripsi dan fungsi produk</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster2_a_indikator" id="klaster2_a_indikator" data-selector="klaster2_a" value="" />
                                                                    <input type="hidden" name="klaster2_a_max" id="klaster2_a_max" value="20" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster2_a_rate" id="klaster2_a_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tingkat kesiapan</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster2_b_indikator" id="klaster2_b_indikator" data-selector="klaster2_b" value="" />
                                                                    <input type="hidden" name="klaster2_b_max" id="klaster2_b_max" value="10" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster2_b_rate" id="klaster2_b_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Perlindungan HKI</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster2_c_indikator" id="klaster2_c_indikator" data-selector="klaster2_c" value="" />
                                                                    <input type="hidden" name="klaster2_c_max" id="klaster2_c_max" value="20" />    
                                                                    <input type="hidden" class="text-center input-mini" name="klaster2_c_rate" id="klaster2_c_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manfaat/kegunaan dibanding produk sejenis.</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster2_d_indikator" id="klaster2_d_indikator" data-selector="klaster2_d" value="" />
                                                                    <input type="hidden" name="klaster2_d_max" id="klaster2_d_max" value="30" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster2_d_rate" id="klaster2_d_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Derajat inovasi teknologi/tingkat kebaruan </td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster2_e_indikator" id="klaster2_e_indikator" data-selector="klaster2_e" value="" />
                                                                    <input type="hidden" name="klaster2_e_max" id="klaster2_e_max" value="20" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster2_e_rate" id="klaster2_e_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Finansial -->
                                                            <tr>
                                                                <td rowspan="5">Finansial<br />(Total 100%)</td>
                                                                <td>Target skenario harga jual</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster3_a_indikator" id="klaster3_a_indikator" data-selector="klaster3_a" value="" />
                                                                    <input type="hidden" name="klaster3_a_max" id="klaster3_a_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster3_a_rate" id="klaster3_a_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Target skenario harga jual</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster3_b_indikator" id="klaster3_b_indikator" data-selector="klaster3_b" value="" />
                                                                    <input type="hidden" name="klaster3_b_max" id="klaster3_b_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster3_b_rate" id="klaster3_b_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Proyeksi potensi pendapatan dan imbal hasil investasi</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster3_c_indikator" id="klaster3_c_indikator" data-selector="klaster3_c" value="" />
                                                                    <input type="hidden" name="klaster3_c_max" id="klaster3_c_max" value="40" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster3_c_rate" id="klaster3_c_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Besaran permintaan Investasi yang diperlukan</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster3_d_indikator" id="klaster3_d_indikator" data-selector="klaster3_d" value="" />
                                                                    <input type="hidden" name="klaster3_d_max" id="klaster3_d_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster3_d_rate" id="klaster3_d_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kontribusi finansial mitra</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster3_e_indikator" id="klaster3_e_indikator" data-selector="klaster3_e" value="" />
                                                                    <input type="hidden" name="klaster3_e_max" id="klaster3_e_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster3_e_rate" id="klaster3_e_rate" value="0" />
                                                                </td>
                                                            </tr> 
                                                            
                                                            <!-- Kapasitas SDM dan Alih Teknologi -->
                                                            <tr>
                                                                <td rowspan="5">Kapasitas SDM dan Alih Teknologi<br />(Total 100%)</td>
                                                                <td>Mentor teknis/ peneliti/perekayasa</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster4_a_indikator" id="klaster4_a_indikator" data-selector="klaster4_a" value="" />
                                                                    <input type="hidden" name="klaster4_a_max" id="klaster4_a_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster4_a_rate" id="klaster4_a_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mentor bisnis/ manajemen</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster4_b_indikator" id="klaster4_b_indikator" data-selector="klaster4_b" value="" />
                                                                    <input type="hidden" name="klaster4_b_max" id="klaster4_b_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster4_b_rate" id="klaster4_b_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manajemen mitra</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster4_c_indikator" id="klaster4_c_indikator" data-selector="klaster4_c" value="" />
                                                                    <input type="hidden" name="klaster4_c_max" id="klaster4_c_max" value="35" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster4_c_rate" id="klaster4_c_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Staff Mitra</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster4_d_indikator" id="klaster4_d_indikator" data-selector="klaster4_d" value="" />
                                                                    <input type="hidden" name="klaster4_d_max" id="klaster4_d_max" value="20" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster4_d_rate" id="klaster4_d_rate" value="0" />
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Skema alih teknologi</td>
                                                                <td>
                                                                    <input type="text" class="slider-indikator" name="klaster4_e_indikator" id="klaster4_e_indikator" data-selector="klaster4_e" value="" />
                                                                    <input type="hidden" name="klaster4_e_max" id="klaster4_e_max" value="15" />
                                                                    <input type="hidden" class="text-center input-mini" name="klaster4_e_rate" id="klaster4_e_rate" value="0" />
                                                                </td>
                                                            </tr>  
                                                            <tr class="bg-blue-grey">
                                                                <td colspan="2"><strong>TOTAL NILAI</strong></td>
                                                                <td class="text-middle text-center"><input class="text-center input-mini text-darken-1" name="total_rate" id="total_rate" value="0" /></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <h2 class="card-inside-title text-uppercase">Komentar Juri</h2>
                                                <div class="form-group">
                                                    <textarea class="form-control ckeditor" name="nilai_juri_comment"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="nilai_selection_id" value="<?php echo $data_selection->id; ?>" />
                                                    <button class="btn btn-sm btn-primary waves-effect btn-rate-step1" type="button">
                                                        <i class="material-icons">done</i> Nilai
                                                    </button>
                                                    <button class="btn btn-sm btn-danger waves-effect btn-rate-step1-reset" type="button">
                                                        <i class="material-icons">close</i> Bersihkan
                                                    </button>
                                                </div>
                                            <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #END# Multiple Items To Be Open -->
                            </div>
                    </div>
                    <!-- End Score Incubation Details -->
                    
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->