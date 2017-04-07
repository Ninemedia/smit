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
                                        <h5 class="profile-name text-center col-teal"><?php echo strtoupper($data_selection->user_name); ?></h5>
                                        <h5 class="profile-username text-center"><i class="material-icons">person</i> <?php echo strtolower($data_selection->username); ?></h5>
                                        <!--
                                        <h5 class="profile-email text-center"><i class="material-icons">email</i> <?php echo strtolower($data_selection->email); ?></h5>
                                        <h5 class="profile-phone text-center"><i class="material-icons">phone</i> <?php echo strtolower($data_selection->phone); ?></h5>
                                        -->
                                        <h3 class="selection-status text-center"></h3>
                                    </div>
                                </div>
                                <hr class="line-warning bottom20" />
                            </div>
                            <div class="col-md-9 bottom0">
                                
                                <div id="alert-display"></div>
                                <a href="<?php echo base_url('prainkubasi/nilai'); ?>" class="btn btn-sm btn-success incubationconfirm pull-right">Kembali</a> 
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