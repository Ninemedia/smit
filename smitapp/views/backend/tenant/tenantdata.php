<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Inkubasi / Tenant</h2></div>
            <div class="body">
                <?php if( !empty($is_admin) ) : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab_tenant" data-toggle="tab">
                            <i class="material-icons">list</i> DATA TENANT
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_add" data-toggle="tab">
                            <i class="material-icons">list</i> TAMBAH TENANT
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab_tenant">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="inwall">Inwall</option>
        							<option value="outwall">Outwall</option>
        							<option value="graduate">Graduate</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="list_tenant" data-url="<?php echo base_url('tenant/tenantlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="listtenant_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="listtenant_all"></label></th>
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
            							<th class="width15">Pengguna</th>
            							<th class="width15">Judul Kegiatan</th>
                                        <th class="width10 text-center">Nama Tenant</th>
                                        <th class="width10 text-center">Posisi</th>
                                        <th class="width10 text-center">Status</th>
            							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option     = array(''=>'Pilih Tahun');
                                                $year_now   = date('Y');
                                                $year_arr   = smit_select_year(1900, $year_now);
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
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_event" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
                                        <td>
                                            <select name="search_postion" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<option value="<?php echo ACTIVE; ?>">INWALL</option>
            									<option value="<?php echo NONACTIVE; ?>">OUTWALL</option>
            									<option value="<?php echo GRADUATE; ?>">GRADUATE</option>
            								</select>
                                        </td>
                                        <td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<option value="<?php echo ACTIVE; ?>">AKTIF</option>
            									<option value="<?php echo NONACTIVE; ?>">TIDAK AKTIF</option>
            								</select>
                                        </td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_tenant_list">Search</button>
                                            </div>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_tenant_listreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="tab_add">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <?php
                                    $conditions     = ' WHERE %user_id% = '.$user->id.' AND %tenant_id% = 0';
                                    $order_by       = ' %year% DESC';
                                    if( !empty($is_admin) ){
                                        $conditions = ' WHERE %tenant_id% = 0 AND %user_id% = 1';
                                    }
    	                        	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions, $order_by);
                                ?>
                                <?php echo form_open_multipart( 'tenant/addtenant', array( 'id'=>'addtenant', 'role'=>'form' ) ); ?>
                                <div id="alert" class="alert display-hide"></div>

                                <p align="justify" class="bottom30"><strong>Informasi !</strong> Admin dapat memasukan Tenant Lama yang sudah terdaftar pada Pusat Inovasi LIPI. Pastikan telah memasukan data Usulan Kegiatan terlebih dahulu sesuai dengan usulan tenant yang akan di masukan. Terima kasih.</p>
                                <h4><p>Silahkan lengkapi isian data Tenant anda</p></h4>

                                <!--
                                <div class="form-group">
                                    <input name="tenant_data" type="radio" id="user_registered" class="radio-col-blue" value="user_registered" checked />
                                    <label for="user_registered">Pengguna Terdaftar</label>
                                    <input name="tenant_data" type="radio" id="tenant_old" class="radio-col-blue" value="tenant_old" />
                                    <label for="tenant_old">Tenant Lama</label>

                                    <div id="tenant_username_form" class="top15 display-hide">
                                        <label class="form-label">Username Pengguna Tenant <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_username','',array('class'=>'form-control tenant_username','placeholder'=>'Username Pengguna Tenant', 'required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                                <div class="form-group">
                                    <label class="form-label">Nama Pengguna Tenant <b style="color: red !important;">(*)</b></label>
                                    <p>Pastikan sudah ada nama pengguna sistem terlebih dahulu</p>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="tenant_user_id" id="tenant_user_id" data-url="<?php echo base_url('tenant/getevent'); ?>">
                                            <?php
                                                $conditions     = ' WHERE %type% = 3 OR %type% = 7';
                                            	$user_list      = $this->Model_User->get_all_user(0, 0, $conditions);

                                                if( !empty($user_list) ){
                                                    echo '<option value="">-- Pilih Nama Penguna --</option>';
                                                    foreach($user_list as $row){
                                                        echo '<option value="'.$row->id.'">'.$row->username.'</option>';
                                                    }
                                                }else{
                                                    echo '<option value="">-- Tidak Ada Pilihan --</option>';
                                                }
                	                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Usulan Kegiatan Inkubasi <b style="color: red !important;"></b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="tenant_event_id" id="tenant_event_id">
                                            <option value="">-- Pilih Usulan Kegiatan --</option>
                                            <?php
                                                /*
                                                $conditions     = ' WHERE %user_id% = '.$user->id.' AND %tenant_id% = 0';
                                                $order_by       = ' %year% DESC';
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %tenant_id% = 0 AND %user_id% = 1';
                                                }
                	                        	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions, $order_by);
                	                            if( !empty($incubation_list) ){
                	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
                	                                foreach($incubation_list as $row){
                                                        echo '<option value="'.$row->id.'">'.strtoupper($row->year).' - '.strtoupper($row->event_title).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                                                */
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name_contact">Nama Tenant <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_name','',array('class'=>'form-control tenant_name','placeholder'=>'Nama Tenant Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="email_contact">Email Tenant <b style="color: red !important;">(*)</b></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="material-icons">email</i></span>
                                                <div class="form-line">
                                                    <?php echo form_input('tenant_email','',array('class'=>'form-control tenant_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="name_contact">Tahun Berdiri <b style="color: red !important;">(*)</b></label>
                                            <div class="input-group">
                                                <?php
                                                    $option     = array(''=>'Pilih Tahun');
                                                    $curyear    = date("Y");
                                                    $year_arr   = smit_select_year(1900,$curyear);
                                                    //$extra = 'class="form-control def" id="tenant_year"';

                                                    if( !empty($year_arr) ){
                                                        foreach($year_arr as $val){
                                                            $option[$val] = $val;
                                                        }
                                                    }
                                                    echo form_dropdown('tenant_year', $option, '');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name_contact">Alamat Tenant <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_address','',array('class'=>'form-control company_address','placeholder'=>'Alamat Tenant Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <select class="form-control show-tick province" name="tenant_province" id="province-select" data-url="<?php echo base_url('selectprovince'); ?>">
            	                        	<?php
                                                $province = smit_provinces();
                                                echo '<option value="">-- Pilih Propinsi --</option>';
                                                if( !empty($province) ){
                                                    foreach($province as $p){
                                                        echo '<option value="'.$p->province_id.'">'.$p->province_name.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <select class="form-control show-tic province" name="tenant_regional" id="regional-select" disabled="disabled">
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">place</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_district','',array('class'=>'form-control tenant_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="telp_contact">Kontak</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_phone_contact','',array('class'=>'form-control tenant_phone_contact','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya) <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_legal','',array('class'=>'form-control tenant_legal','placeholder'=>'Nomor Legalitas Usaha Anda','required'=>'required')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian) <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                        <div class="form-line">
                                            <?php echo form_input('tenant_bussiness','',array('class'=>'form-control tenant_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telp_contact">Kemitraan Usaha yang Dimiliki <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Kemitraan Usaha yang Anda Miliki" id="tenant_mitra" name="tenant_mitra" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telp_contact">Deskripsi Singkat Tentang Tenant <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Tenant Anda" id="tenant_desc" name="tenant_desc" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Logo Tenant <b style="color: red !important;">(*)</b></label>
                                    <p align="justify">
                                        File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 200 x 200 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan yaitu JPEG/JPG?PNG.
                                    </p>
                                    <input id="avatar_selection_files" name="avatar_selection_files" class="form-control" type="file" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect" <?php echo ( !empty($member_other) && !$is_admin ? 'readonly="readonly"' : '' ); ?>>Simpan</button>
                                    <button class="btn btn-sm btn-danger waves-effect" id="btn_addtenant_reset" type="button">Bersihkan </button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php else : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab_tenant" data-toggle="tab">
                            <i class="material-icons">list</i> DATA TENANT
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#tab_add" data-toggle="tab">
                            <i class="material-icons">list</i> TAMBAH TENANT
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab_tenant">
                        <div class="table-container table-responsive">
                            <!--
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            -->
                            <table class="table table-striped table-bordered table-hover" id="list_tenant" data-url="<?php echo base_url('tenant/tenantlistdata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <!-- <th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th> -->
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
            							<th class="width20">Judul Kegiatan</th>
                                        <th class="width10 text-center">Nama Tenant</th>
                                        <th class="width10 text-center">Posisi</th>
                                        <th class="width10 text-center">Status</th>
            							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<!-- <td></td> -->
                                        <td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_now   = date('Y');
                                                $year_arr   = smit_select_year(1900, $year_now);
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
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_event" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
                                        <td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<option value="<?php echo ACTIVE; ?>">INWALL</option>
            									<option value="<?php echo NONACTIVE; ?>">OUTWALL</option>
            								</select>
                                        </td>
                                        <td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<option value="<?php echo ACTIVE; ?>">AKTIF</option>
            									<option value="<?php echo NONACTIVE; ?>">TIDAK AKTIF</option>
            								</select>
                                        </td>
            							<td style="text-align: center;">
                                            <div class="bottom5">
            								    <button class="btn bg-blue waves-effect filter-submit" id="btn_tenant_list">Search</button>
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
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="tab_add">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <?php
                                    $conditions     = ' WHERE %user_id% = '.$user->id.' AND %tenant_id% = 0';
                                    $order_by       = ' %year% DESC';
                                    if( !empty($is_admin) ){
                                        $conditions = ' WHERE %tenant_id% = 0 AND %user_id% = 1';
                                    }
    	                        	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions, $order_by);
                                ?>
                                <?php if( !empty($incubation_list) ) : ?>
                                <?php echo form_open_multipart( 'tenant/addtenant', array( 'id'=>'addtenantuser', 'role'=>'form' ) ); ?>
                                <div id="alert" class="alert display-hide"></div>
                                <h4><p>Silahkan lengkapi isian data Tenant anda</p></h4>
                                <div class="form-group">
                                    <label class="form-label">Usulan Kegiatan Inkubasi <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                        <select class="form-control show-tick" name="tenant_event_id" id="tenant_event_id">
                                            <?php
                                                $conditions     = ' WHERE %user_id% = '.$user->id.' AND %tenant_id% = 0';
                                                $order_by       = ' %year% DESC';
                                                if( !empty($is_admin) ){
                                                    $conditions = ' WHERE %tenant_id% = 0 AND %user_id% = 1';
                                                }
                	                        	$incubation_list    = $this->Model_Incubation->get_all_incubationdata(0, 0, $conditions, $order_by);
                	                            if( !empty($incubation_list) ){
                	                                echo '<option value="">-- Pilih Usulan Kegiatan --</option>';
                	                                foreach($incubation_list as $row){
                                                        echo '<option value="'.$row->id.'">'.strtoupper($row->year).' - '.strtoupper($row->event_title).'</option>';
                	                                }
                	                            }else{
                	                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                	                            }
                	                        ?>
                                        </select>
                                    </div>
                                </div>
                                <label for="name_contact">Nama Tenant <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('tenant_name','',array('class'=>'form-control tenant_name','placeholder'=>'Nama Tenant Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="email_contact">Email Tenant <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">email</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('tenant_email','',array('class'=>'form-control tenant_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="name_contact">Tahun Berdiri <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_arr = smit_select_year(1900,2030);
                                                //$extra = 'class="form-control def" id="tenant_year"';

                                                if( !empty($year_arr) ){
                                                    foreach($year_arr as $val){
                                                        $option[$val] = $val;
                                                    }
                                                }
                                                echo form_dropdown('tenant_year', $option, '');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <label for="name_contact">Alamat Tenant <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('tenant_address','',array('class'=>'form-control company_address','placeholder'=>'Alamat Tenant Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <select class="form-control show-tick province" name="tenant_province" id="province-select" data-url="<?php echo base_url('selectprovince'); ?>">
        	                        	<?php
                                            $province = smit_provinces();
                                            echo '<option value="">-- Pilih Propinsi --</option>';
                                            if( !empty($province) ){
                                                foreach($province as $p){
                                                    echo '<option value="'.$p->province_id.'">'.$p->province_name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <select class="form-control show-tic province" name="tenant_regional" id="regional-select" disabled="disabled">
                                        <option value="">-- Pilih Kota/Kabupaten --</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('tenant_district','',array('class'=>'form-control tenant_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                    </div>
                                </div>

                                <label for="telp_contact">Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('tenant_phone_contact','',array('class'=>'form-control tenant_phone_contact','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya) <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('tenant_legal','',array('class'=>'form-control tenant_legal','placeholder'=>'Nomor Legalitas Usaha Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian) <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('tenant_bussiness','',array('class'=>'form-control tenant_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Kemitraan Usaha yang Dimiliki <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Kegiatan Anda" id="tenant_mitra" name="tenant_mitra" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telp_contact">Deskripsi Singkat Tentang Tenant <b style="color: red !important;">(*)</b></label>
                                    <div class="input-group">
                                        <div class="form-line">
                                            <textarea cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Tenant Anda" id="tenant_desc" name="tenant_desc" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Logo Tenant <b style="color: red !important;">(*)</b></label>
                                    <p align="justify">
                                        File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 200 x 200 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan yaitu JPEG/JPG?PNG.
                                    </p>
                                    <input id="avatar_selection_files" name="avatar_selection_files" class="form-control" type="file" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect" <?php echo ( !empty($member_other) && !$is_admin ? 'readonly="readonly"' : '' ); ?>>Simpan</button>
                                    <button class="btn btn-sm btn-danger waves-effect" id="btn_addtenantuser_reset" type="button">Bersihkan </button>
                                </div>
                                <?php echo form_close(); ?>
                                <?php else : ?>
                                    <?php if( empty($is_admin) ) : ?>
                                    <div class="alert alert-info">
                                        <strong>Informasi!</strong> Untuk saat ini tidak ada usulan kegiatan. Terima Kasih.
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE TENANT MODAL -->
<div class="modal fade" id="save_addtenant" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Tenant Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan menambahkan data tenant anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_addtenant" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE TENANT MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE TENANT MODAL -->
<div class="modal fade" id="save_addtenantuser" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Tenant Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan menambahkan data tenant anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_addtenantuser" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE TENANT MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE LOGO TENANT MODAL -->
<div class="modal fade" id="save_logotenant" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Logo Tenant Anda</h4>
			</div>
			<div class="modal-body">
                <p>Apakah anda yakin akan memperbaharui logo tenant anda ?</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_logotenant" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE LOGO TENANT MODAL -->
