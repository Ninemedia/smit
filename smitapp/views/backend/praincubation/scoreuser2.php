<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Penilaian Seleksi Pra-Inkubasi Tahap 1</h2></div>
            <div class="body">
                <?php if($is_jury): ?>
                    <div class="alert bg-blue">
                        Dibawah ini merupakan daftar seleksi Tahap 1 
                    </div>
                    <!-- Score Pra Incubation Details -->
                    <div class="body">
                        <div class="row">
                            <div class="col-md-3 bottom0">
                                <!-- Profile Image -->
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        <img class="profile-user-img img-responsive img-circle" 
                                        src="<?php echo BE_IMG_PATH . 'avatar/avatar1.png'; ?>" 
                                        alt="User Profile Picture" />
                                        <h3 class="profile-name text-center col-teal"><?php echo strtoupper($data_user->name); ?></h3>
                                        <h5 class="profile-username text-center"><i class="material-icons">person</i> <?php echo strtolower($data_user->username); ?></h5>
                                        <!--
                                        <h5 class="profile-email text-center"><i class="material-icons">email</i> <?php echo strtolower($data_user->email); ?></h5>
                                        <h5 class="profile-phone text-center"><i class="material-icons">phone</i> <?php echo strtolower($data_user->phone); ?></h5>
                                        -->
                                        <h3 class="selection-status text-center"></h3>
                                    </div>
                                </div>
                                <hr class="line-warning bottom20" />
                            </div>
                            <div class="col-md-9 bottom0">
                                
                                <div id="alert-display"></div>
                                <a href="<?php echo base_url('prainkubasi/nilai'); ?>" class="btn btn-sm btn-success incubationconfirm pull-right">Kembali</a> 
                                <h2 class="card-inside-title text-uppercase">Berkas dan Proposal Kegiatan</h2>
                                <?php
                                    if( !empty($data_selection) ){
                                        echo '<ul class="bottom40">';
                                        foreach($data_selection as $file){
                                            echo '<li>'.strtoupper($file->filename).' - <a href="'.base_url('unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                        }
                                        echo '</ul>';
                                    }else{
                                        echo '<strong>Tidak ada berkas panduan</strong>';
                                    }
                                ?>
                                <h2 class="card-inside-title text-uppercase top25">FORMULIR EVALUASI TEKNOLOGI LIPI</h2>
                                <div class="form-group form-float">
                                <div class="form-group form-float">
                                    <label class="form-label">Satuan Kerja/PT/CV</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <input type="text" name="eval_unit" id="eval_unit" class="form-control" value="<?php echo $data_user->workunit; ?>" disabled="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <label class="form-label">Judul Teknologi</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <input type="text" name="eval_title" id="eval_title" class="form-control" value="<?php echo $data_user->event_title; ?>" disabled="" />
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="body bg-blue top30 bottom30">
                                    <p align="center" class="bottom0"><strong>Perhatian</strong></p>
                                </div>
                                -->
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
                    </div>
                    <!-- End Score Incubation Details -->
                    
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->