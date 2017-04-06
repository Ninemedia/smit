<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Penilaian Seleksi Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                
                <?php else: ?>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#step_one" data-toggle="tab">
                                <i class="material-icons">label</i> TAHAP 1
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#step_two" data-toggle="tab">
                                <i class="material-icons">label</i> TAHAP 2
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="step_one">
                            <div class="alert bg-blue">
                                Dibawah ini merupakan daftar seleksi Tahap 1 
                            </div>
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="jury_stepone" data-url="<?php echo base_url('praincubation/juryscorelistdata/1'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width15 text-center">Username</th>
                							<th class="width25">Nama</th>
                                            <th class="width15 text-center">Judul Kegiatan</th>
                                            <th class="width5 text-center">File</th>
                                            <th class="width10 text-center">Status</th>
                                            <th class="width15 text-center">Tanggal Daftar</th>
                							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
   						                </tr>
                                        <tr role="row" class="filter display-hide table-filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-center text-lowercase" name="search_username" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                            <td></td>
                                            <td>
                                                <select name="search_status" class="form-control form-filter input-sm">
                									<option value="">Pilih...</option>
                									<?php
                			                        	$status = smit_incubation_selection_status();
                			                            if( !empty($status) ){
                			                                foreach($status as $key => $val){
                                                                if($key==RATED || $key==ACCEPTED) continue;
                			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                			                                }
                			                            }
                			                        ?>
                								</select>
                                            </td>
                                            <td>
                								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                							</td>
                							<td style="text-align: center;">
                                                <div class="bottom5">
                								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                                </div>
                                                <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                							</td>
                						</tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Will Be Placed Here -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Score Incubation Details -->
                            <div class="card top30 bottom0 display-hide" id="scoredata_details">
                                <div class="header bg-cyan">
                                    <h2>Seleksi Inkubasi Tahap 1</h2>
                                    <ul class="header-dropdown m-r--0">
                                        <li class="dropdown">
                                            <a class="close-details" href="javascript:void(0);">
                                                <i class="material-icons">close</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12 bottom0">
                                            <!-- Profile Image -->
                                            <div class="box box-primary">
                                                <div class="box-body box-profile">
                                                    <img class="profile-user-img img-responsive img-circle" 
                                                    src="<?php echo BE_IMG_PATH . 'avatar/avatar1.png'; ?>" 
                                                    alt="User Profile Picture" />
                                                    <h3 class="profile-name text-center col-teal">Nama Pengguna</h3>
                                                    <h5 class="profile-username text-center"><i class="material-icons">person</i> Username Pengguna</h5>
                                                    <h5 class="profile-email text-center"><i class="material-icons">email</i> example@email.com</h5>
                                                    <h5 class="profile-phone text-center"><i class="material-icons">phone</i> +8123456789</h5>
                                                    <h3 class="selection-status text-center"></h3>
                                                </div>
                                            </div>
                                            <hr class="line-warning bottom20" />
                                            <div id="alert-display"></div>
                                        
                                            <h2 class="card-inside-title text-uppercase">Usulan Kegiatan Inkubasi</h2>
                                            <div class="form-group form-float">
                                                <label class="form-label">Judul Kegiatan</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_event_title" id="reg_event_title" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Nama Peneliti Utama</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_name" id="reg_name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Kategori Bidang</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_category" id="reg_category" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="input-group">
                                                    <label class="form-label">Deskripsi Kegiatan</label>
                                                    <div class="form-line">
                                                        <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize" disabled="" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Status for Examined -->
                                            <div class="status-examined display-hide">
                                                <div class="input-group">
                                                    <button class="btn btn-lg bg-green waves-effect btn-download-file" 
                                                    data-baseurl="<?php echo base_url('incubationscoreact/download'); ?>" type="button">
                                                        <i class="material-icons">file_download</i> Download Berkas
                                                    </button>
                                                    <button class="btn btn-lg btn-primary waves-effect btn-examine" 
                                                    data-baseurl="<?php echo base_url('incubationscoreact/examine'); ?>" type="button">
                                                        <i class="material-icons">autorenew</i> Periksa Seleksi
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Status for Called -->
                                            <div class="status-called display-hide">
                                                <div class="input-group">
                                                    <button class="btn btn-lg bg-green waves-effect btn-download-file" 
                                                    data-baseurl="<?php echo base_url('incubationscoreact/download'); ?>" type="button">
                                                        <i class="material-icons">file_download</i> Download Berkas
                                                    </button>
                                                    <button class="btn btn-lg btn-danger waves-effect btn-reject" 
                                                    data-baseurl="<?php echo base_url('incubationscoreact/reject'); ?>" type="button">
                                                        <i class="material-icons">close</i> Tolak
                                                    </button>
                                                    <button class="btn btn-lg btn-primary waves-effect btn-call" 
                                                    data-baseurl="<?php echo base_url('incubationscoreact/call'); ?>" type="button">
                                                        <i class="material-icons">phone</i> Panggil
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Score Incubation Details -->
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="step_two">
                            <div class="alert bg-blue">
                                Dibawah ini merupakan daftar seleksi Tahap 2 yang telah dilakukan penyaringan pada Tahap 1. 
                            </div>
                            <div class="table-container table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="jury_steptwo" data-url="<?php echo base_url('praincubation/juryscorelistdata/2'); ?>">
                                    <thead>
                						<tr role="row" class="heading bg-blue">
                							<th class="width5">No</th>
                							<th class="width15 text-center">Username</th>
                							<th class="width25">Nama</th>
                                            <th class="width15 text-center">Judul Kegiatan</th>
                                            <th class="width10 text-center">Status</th>
                							<th class="width5 text-center">Nilai</th>
                                            <th class="width15 text-center">Tanggal Daftar</th>
                							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
   						                </tr>
                                        <tr role="row" class="filter display-hide table-filter">
                							<td></td>
                							<td><input type="text" class="form-control form-filter input-sm text-center text-lowercase" name="search_username" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                            <td>
                                                <select name="search_status" class="form-control form-filter input-sm">
                									<option value="">Pilih...</option>
                									<?php
                			                        	$status = smit_user_status();
                			                            if( !empty($status) ){
                			                                foreach($status as $key => $val){
                			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
                			                                }
                			                            }
                			                        ?>
                								</select>
                                            </td>
                                            <td></td>
                                            <td>
                								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
                								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
                							</td>
                							<td style="text-align: center;">
                                                <div class="bottom5">
                								    <button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
                                                </div>
                                                <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                							</td>
                						</tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data Will Be Placed Here -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Score Incubation Details -->
                            <div class="card top30 bottom0 display-hide" id="scoredata_details2">
                                <div class="header bg-cyan">
                                    <h2>Seleksi Inkubasi Tahap 2</h2>
                                    <ul class="header-dropdown m-r--0">
                                        <li class="dropdown">
                                            <a class="close-details" href="javascript:void(0);">
                                                <i class="material-icons">close</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12 bottom0">
                                            <!-- Profile Image -->
                                            <div class="box box-primary">
                                                <div class="box-body box-profile">
                                                    <img class="profile-user-img img-responsive img-circle" 
                                                    src="<?php echo BE_IMG_PATH . 'avatar/avatar1.png'; ?>" 
                                                    alt="User Profile Picture" />
                                                    <h3 class="profile-name text-center col-teal">Nama Pengguna</h3>
                                                    <h5 class="profile-username text-center"><i class="material-icons">person</i> Username Pengguna</h5>
                                                    <h5 class="profile-email text-center"><i class="material-icons">email</i> example@email.com</h5>
                                                    <h5 class="profile-phone text-center"><i class="material-icons">phone</i> +8123456789</h5>
                                                    <h3 class="selection-status text-center"></h3>
                                                </div>
                                            </div>
                                            <hr class="line-warning bottom20" />
                                            <div id="alert-display"></div>

                                            <h2 class="card-inside-title text-uppercase">Usulan Kegiatan Inkubasi</h2>
                                            <div class="form-group form-float">
                                                <label class="form-label">Judul Kegiatan</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_event_title" id="reg_event_title2" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Nama Peneliti Utama</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_name" id="reg_name2" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Kategori Bidang</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="reg_category2" id="reg_category2" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="input-group">
                                                    <label class="form-label">Deskripsi Kegiatan</label>
                                                    <div class="form-line">
                                                        <textarea name="reg_desc2" id="reg_desc2" cols="30" rows="3" class="form-control no-resize" disabled="" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <h1 class="card-inside-title text-uppercase top25">FORMULIR EVALUASI TEKNOLOGI LIPI</h1>
                                            <div class="form-group form-float">
                                                <label class="form-label">Username</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="eval_username" id="eval_username" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Nama Pengusul</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="eval_name" id="eval_name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Satuan Kerja/PT/CV</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="eval_unit" id="eval_unit" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Judul Teknologi</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="eval_title" id="eval_title" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="body bg-blue top30 bottom30">
                                                <p align="center" class="bottom0"><strong>Perhatian</strong></p>
                                            </div>
                                            <table class="table table-striped table-bordered table-hover" id="jury_steptwo">
                                                <thead>
                            						<tr role="row" class="heading">
                            							<th class="width15 text-center text-middle">Klaster Kriteria</th>
                            							<th class="width15 text-center text-middle">Unsur/Kriteria</th>
                            							<th class="width40 text-center text-middle">Indikator</th>
                            							<th class="width15 text-center text-middle">Nilai Maks</th>
                                                        <th class="width15 text-center text-middle">Penilaian</th>
                            						</tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Data Will Be Placed Here -->
                                                    <!-- Pasar -->
                                                    <tr>
                                                        <td rowspan="5">Pasar<br />(Total 100%)</td>
                                                        <td>Deskripsi Kebutuhan Pengguna</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster1_a_indikator" id="klaster1_a_indikator" data-selector="klaster1_a" value="" /></td>
                                                        <td class="text-middle text-center">30<input type="hidden" name="klaster1_a_max" id="klaster1_a_max" value="30" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster1_a_rate" id="klaster1_a_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Deskripsi Sasaran Pengguna</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster1_b_indikator" id="klaster1_b_indikator" data-selector="klaster1_b" value="" /></td>
                                                        <td class="text-middle text-center">15<input type="hidden" name="klaster1_b_max" id="klaster1_b_max" value="15" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster1_b_rate" id="klaster1_b_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Besar Pasar</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster1_c_indikator" id="klaster1_c_indikator" data-selector="klaster1_c" value="" /></td>
                                                        <td class="text-middle text-center">20<input type="hidden" name="klaster1_c_max" id="klaster1_c_max" value="20" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster1_c_rate" id="klaster1_c_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rencana Pemasaran</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster1_d_indikator" id="klaster1_d_indikator" data-selector="klaster1_d" value="" /></td>
                                                        <td class="text-middle text-center">25<input type="hidden" name="klaster1_d_max" id="klaster1_d_max" value="25" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster1_d_rate" id="klaster1_d_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pertumbuhan Pasar</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster1_e_indikator" id="klaster1_e_indikator" data-selector="klaster1_e" value="" /></td>
                                                        <td class="text-middle text-center">10<input type="hidden" name="klaster1_e_max" id="klaster1_e_max" value="10" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster1_e_rate" id="klaster1_e_rate" value="0" /></td>
                                                    </tr>
                                                    
                                                    <!-- Produk/Jasa -->
                                                    <tr>
                                                        <td rowspan="5">Produk/Jasa<br />(Total 100%)</td>
                                                        <td>Deskripsi dan fungsi produk</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster2_a_indikator" id="klaster2_a_indikator" data-selector="klaster2_a" value="" /></td>
                                                        <td class="text-middle text-center">20<input type="hidden" name="klaster2_a_max" id="klaster2_a_max" value="20" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster2_a_rate" id="klaster2_a_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tingkat kesiapan</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster2_b_indikator" id="klaster2_b_indikator" data-selector="klaster2_b" value="" /></td>
                                                        <td class="text-middle text-center">10<input type="hidden" name="klaster2_b_max" id="klaster2_b_max" value="10" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster2_b_rate" id="klaster2_b_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Perlindungan HKI</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster2_c_indikator" id="klaster2_c_indikator" data-selector="klaster2_c" value="" /></td>
                                                        <td class="text-middle text-center">20<input type="hidden" name="klaster2_c_max" id="klaster2_c_max" value="20" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster2_c_rate" id="klaster2_c_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manfaat/kegunaan dibanding produk sejenis.</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster2_d_indikator" id="klaster2_d_indikator" data-selector="klaster2_d" value="" /></td>
                                                        <td class="text-middle text-center">30<input type="hidden" name="klaster2_d_max" id="klaster2_d_max" value="30" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster2_d_rate" id="klaster2_d_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Derajat inovasi teknologi/tingkat kebaruan </td>
                                                        <td><input type="text" class="slider-indikator" name="klaster2_e_indikator" id="klaster2_e_indikator" data-selector="klaster2_e" value="" /></td>
                                                        <td class="text-middle text-center">20<input type="hidden" name="klaster2_e_max" id="klaster2_e_max" value="20" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster2_e_rate" id="klaster2_e_rate" value="0" /></td>
                                                    </tr>
                                                    
                                                    <!-- Finansial -->
                                                    <tr>
                                                        <td rowspan="5">Finansial<br />(Total 100%)</td>
                                                        <td>Target skenario harga jual</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster3_a_indikator" id="klaster3_a_indikator" data-selector="klaster3_a" value="" /></td>
                                                        <td class="text-middle text-center">5<input type="hidden" name="klaster3_a_max" id="klaster3_a_max" value="5" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster3_a_rate" id="klaster3_a_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Target skenario harga jual</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster3_b_indikator" id="klaster3_b_indikator" data-selector="klaster3_b" value="" /></td>
                                                        <td class="text-middle text-center">10<input type="hidden" name="klaster3_b_max" id="klaster3_b_max" value="10" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster3_b_rate" id="klaster3_b_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Proyeksi potensi pendapatan dan imbal hasil investasi</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster3_c_indikator" id="klaster3_c_indikator" data-selector="klaster3_c" value="" /></td>
                                                        <td class="text-middle text-center">40<input type="hidden" name="klaster3_c_max" id="klaster3_c_max" value="40" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster3_c_rate" id="klaster3_c_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Besaran permintaan Investasi yang diperlukan</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster3_d_indikator" id="klaster3_d_indikator" data-selector="klaster3_d" value="" /></td>
                                                        <td class="text-middle text-center">15<input type="hidden" name="klaster3_d_max" id="klaster3_d_max" value="15" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster3_d_rate" id="klaster3_d_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kontribusi finansial mitra</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster3_e_indikator" id="klaster3_e_indikator" data-selector="klaster3_e" value="" /></td>
                                                        <td class="text-middle text-center">15<input type="hidden" name="klaster3_e_max" id="klaster3_e_max" value="15" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster3_e_rate" id="klaster3_e_rate" value="0" /></td>
                                                    </tr> 
                                                    
                                                    <!-- Kapasitas SDM dan Alih Teknologi -->
                                                    <tr>
                                                        <td rowspan="5">Kapasitas SDM dan Alih Teknologi<br />(Total 100%)</td>
                                                        <td>Mentor teknis/ peneliti/perekayasa</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster4_a_indikator" id="klaster4_a_indikator" data-selector="klaster4_a" value="" /></td>
                                                        <td class="text-middle text-center">15<input type="hidden" name="klaster4_a_max" id="klaster4_a_max" value="15" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster4_a_rate" id="klaster4_a_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mentor bisnis/ manajemen</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster4_b_indikator" id="klaster4_b_indikator" data-selector="klaster4_b" value="" /></td>
                                                        <td class="text-middle text-center">15<input type="hidden" name="klaster4_b_max" id="klaster4_b_max" value="15" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster4_b_rate" id="klaster4_b_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manajemen mitra</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster4_c_indikator" id="klaster4_c_indikator" data-selector="klaster4_c" value="" /></td>
                                                        <td class="text-middle text-center">35<input type="hidden" name="klaster4_c_max" id="klaster4_c_max" value="35" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster4_c_rate" id="klaster4_c_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Staff Mitra</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster4_d_indikator" id="klaster4_d_indikator" data-selector="klaster4_d" value="" /></td>
                                                        <td class="text-middle text-center">20<input type="hidden" name="klaster4_d_max" id="klaster4_d_max" value="20" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster4_d_rate" id="klaster4_d_rate" value="0" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Skema alih teknologi</td>
                                                        <td><input type="text" class="slider-indikator" name="klaster4_e_indikator" id="klaster4_e_indikator" data-selector="klaster4_e" value="" /></td>
                                                        <td class="text-middle text-center">15<input type="hidden" name="klaster4_e_max" id="klaster4_e_max" value="15" /></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini" name="klaster4_e_rate" id="klaster4_e_rate" value="0" /></td>
                                                    </tr>  
                                                    <tr class="bg-blue-grey">
                                                        <td colspan="4"><strong>TOTAL NILAI</strong></td>
                                                        <td class="text-middle text-center"><input class="text-center input-mini text-darken-1" name="total_rate" id="total_rate" value="0" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Score Incubation Details -->
                            
                            <!-- Score Incubation Nilai -->
                            <div class="card top30 bottom0 display-hide" id="scoredata_nilai">
                                <div class="header bg-cyan">
                                    <h2>Seleksi Inkubasi Tahap 1</h2>
                                    <ul class="header-dropdown m-r--0">
                                        <li class="dropdown">
                                            <a class="close-nilai" href="javascript:void(0);">
                                                <i class="material-icons">close</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Profile Image -->
                                            <h1 class="card-inside-title"><center>FORMULIR EVALUASI TEKNOLOGI LIPI</center></h1>
                                            <div class="form-group form-float">
                                                <label class="form-label">Username</label>
                                                <input type="hidden" name="reg_username" id="reg_username" />
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="reg_username" id="reg_username_data" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Nama Pengusul</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="name" id="name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Satuan Kerja/PT/CV</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="name" id="name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <label class="form-label">Judul Teknologi</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                                    <div class="form-line">
                                                        <input type="text" name="name" id="name" class="form-control" disabled="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body bg-teal">
                                                <p align="center" class="bottom0"><strong>Perhatian</strong><br />De</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <?php endif ?>  
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->