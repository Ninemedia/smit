<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <?php if($is_admin) : ?>
            <div class="header"><h2>Komunikasi dan Bantuan</h2></div>
            <?php else : ?>
            <div class="header"><h2>Diskusi</h2></div>
            <?php endif; ?>
            <div class="body">
                <?php if( !empty($is_admin) ) :?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list_in" data-toggle="tab">
                            <i class="material-icons">call_received</i> Komunikasi Masuk
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#list_out" data-toggle="tab">
                            <i class="material-icons">call_made</i> Bantuan Keluar
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list_in">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="communication_listin" data-url="<?php echo base_url('layanan/komunikasibantuan/in'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="select_all_listin" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_listin"></label></th>
            							<th class="width5">No</th>
            							<th class="width15 text-center">Nama Pengirim</th>
            							<th class="width20 text-center">Judul Komunikasi</th>
            							<th class="width10 text-center">Status</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
            			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
            			                                }
            			                            }
            			                        ?>
            								</select>
                                        </td>
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_communication_listin">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_communication_listinreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="list_out">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="communication_listout" data-url="<?php echo base_url('layanan/komunikasibantuan/out'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="select_all_listout" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_listout"></label></th>
            							<th class="width5">No</th>
            							<th class="width30 text-center">Isi Pesan</th>
            							<th class="width10 text-center">Status</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
            							<td></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
            			                                    echo '<option value="'.$key.'">'.strtoupper($val).'</option>';
            			                                }
            			                            }
            			                        ?>
            								</select>
                                        </td>
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
            							<td style="text-align: center;">
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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

                </div>
                <?php elseif( $is_pelaksana || $is_pelaksana_tenant || $is_pendamping || $is_tenant ) : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list_in" data-toggle="tab">
                            <i class="material-icons">call_received</i> Diskusi Masuk
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#list_out" data-toggle="tab">
                            <i class="material-icons">call_made</i> Diskusi Keluar
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> Buat Diskusi
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list_in">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="communication_listin" data-url="<?php echo base_url('layanan/komunikasibantuan/in'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all_listin" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_listin"></label></th>
            							<th class="width5">No</th>
                                        <th class="width15 text-center">Diskusi Dari</th>
            							<th class="width20 text-center">Isi Pesan</th>
            							<th class="width15 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
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
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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
                    <div role="tabpanel" class="tab-pane fade in" id="list_out">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="communication_listout" data-url="<?php echo base_url('layanan/komunikasibantuan/out'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="select_all_listout" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_listout"></label></th>
            							<th class="width5">No</th>
            							<th class="width20 text-center">Isi Pesan</th>
            							<th class="width10 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
            							<td></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm def">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
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
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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
                        <?php echo form_open_multipart( 'backend/communicationadd', array( 'id'=>'cmm_form', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <p align="justify">
                                <strong>Perhatian!</strong>
                                Pesan ini otomatis ditujukan untuk Administrator
                            </p>
                            
                            <div class="form-group">
                                <label class="form-label">Nama Pengguna<b style="color: red !important;">(*)</b></label>
                                <p>Pastikan sudah ada username / pengguna sistem terlebih dahulu</p>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                    <select class="form-control show-tick" name="cmm_user_id" id="cmm_user_id">
                                        <?php
                                            if( $is_pendamping ){
                                                $conditions     = ' WHERE %type% = 1 OR %type% = 6 OR %type% = 7 OR %type% = 3';    
                                            }else{
                                                $conditions     = ' WHERE %type% = 2 OR %type% = 1';    
                                            }
                                            
                                        	$user_list      = $this->Model_User->get_all_user(0, 0, $conditions, "%type%");
                                            if( !empty($user_list) ){
                                                echo '<option value="">-- Pilih Nama Penguna --</option>';
                                                    foreach($user_list as $row){
                                                        if( $row->type == 1 ){
                                                            $status = 'ADMINISTRATOR';
                                                        }elseif( $row->type == 2 ){
                                                            $status = 'PENDAMPING';
                                                        }elseif( $row->type == 3 ){
                                                            $status = 'TENANT';
                                                        }elseif( $row->type == 4 ){
                                                            $status = 'JURI';
                                                        }elseif( $row->type == 5 ){
                                                            $status = 'PENGUSUL';
                                                        }else{
                                                            $status = 'PELAKSANA';
                                                        }
                                                    echo '<option value="'.$row->id.'">'.strtoupper($row->name).' - ('.$status.')</option>';
                                                }
                                            }else{
                                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                                            }
            	                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Judul Diskusi <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php
                                        echo form_input(
                                            'cmm_title',
                                            ( !empty($post) ? smit_isset($post['cmm_title'],'') : '' ),
                                            array(
                                                'class'=>'form-control text-uppercase',
                                                'id'=>'cmm_title',
                                                'placeholder'=>'Masukan Judul Diskusi dan Bantuan...',
                                                'required'=>'required'
                                            )
                                        );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Deskripsi Diskusi <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php
                                        echo form_textarea(
                                            array(
                                                'name'=>'cmm_description',
                                                'class'=>'form-control no-resize',
                                                'id'=>'cmm_description',
                                                'rows'=>4,
                                                'placeholder'=>'Silahkan isi deskripsi dari diskusi dengan maksimal 400 huruf...'
                                            ),
                                            ( !empty($post) ? smit_isset($post['cmm_description'],'') : '' )
                                        );
                                    ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn_cmmadd">Tambah Diskusi</button>
                            <button type="button" class="btn btn-danger waves-effect" id="btn_cmmadd_reset">Bersihkan</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php else : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list_in" data-toggle="tab">
                            <i class="material-icons">call_received</i> Diskusi Masuk
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#list_out" data-toggle="tab">
                            <i class="material-icons">call_made</i> Diskusi Keluar
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> Buat Diskusi
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list_in">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="communication_listin" data-url="<?php echo base_url('layanan/komunikasibantuan/in'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all_listin" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_listin"></label></th>
            							<th class="width5">No</th>
            							<th class="width15 text-center">Judul Diskusi</th>
            							<th class="width25 text-center">Deskripsi</th>
            							<th class="width15 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_email" /></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
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
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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
                    <div role="tabpanel" class="tab-pane fade in" id="list_out">
                        <div class="table-container table-responsive">
                            <div class="table-actions-wrapper">
        						<span></span>
        						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
        							<option value="">Select...</option>
        							<option value="confirm">Konfirmasi</option>
        							<option value="banned">Banned</option>
        							<option value="delete">Hapus</option>
        						</select>
        						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
        					</div>
                            <table class="table table-striped table-bordered table-hover" id="communication_listout" data-url="<?php echo base_url('layanan/komunikasibantuan/out'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5 text-center"><input name="select_all" id="select_all_listout" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all_listout"></label></th>
            							<th class="width5">No</th>
            							<th class="width15 text-center">Judul Diskusi</th>
            							<th class="width25 text-center">Deskripsi</th>
            							<th class="width10 text-center">Status</th>
                                        <th class="width10 text-center">Tanggal Daftar</th>
            							<th class="width15 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
       						        </tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_email" /></td>
            							<td>
                                            <select name="search_status" class="form-control form-filter input-sm">
            									<option value="">Pilih...</option>
            									<?php
            			                        	$status = smit_user_status_message();
            			                            if( !empty($status) ){
            			                                foreach($status as $key => $val){
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
            								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_user">Search</button>
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
                        <?php echo form_open_multipart( 'backend/communicationadd', array( 'id'=>'cmm_form', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <p align="justify">
                                <strong>Perhatian!</strong>
                                Pesan ini otomatis ditujukan untuk Administrator
                            </p>
                            
                            <input type="hidden" id="cmm_user_id" name="cmm_user_id" value="<?php echo ADMINISTRATOR; ?>" />
                            <div class="form-group">
                                <label class="control-label">Judul Diskusi <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php
                                        echo form_input(
                                            'cmm_title',
                                            ( !empty($post) ? smit_isset($post['cmm_title'],'') : '' ),
                                            array(
                                                'class'=>'form-control text-uppercase',
                                                'id'=>'cmm_title',
                                                'placeholder'=>'Masukan Judul Diskusi dan Bantuan...',
                                                'required'=>'required'
                                            )
                                        );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Deskripsi Diskusi <b style="color: red !important;">(*)</b></label>
                                <div class="form-line">
                                    <?php
                                        echo form_textarea(
                                            array(
                                                'name'=>'cmm_description',
                                                'class'=>'form-control no-resize',
                                                'id'=>'cmm_description',
                                                'rows'=>4,
                                                'placeholder'=>'Silahkan isi deskripsi dari diskusi dengan maksimal 400 huruf...'
                                            ),
                                            ( !empty($post) ? smit_isset($post['cmm_description'],'') : '' )
                                        );
                                    ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn_cmmadd">Tambah Diskusi</button>
                            <button type="button" class="btn btn-danger waves-effect" id="btn_cmmadd_reset">Bersihkan</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
<div class="modal fade" id="save_cmm" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <?php if($is_admin) : ?>
				<h4 class="modal-title">Pendaftaran Komunikasi dan Bantuan</h4>
                <?php else : ?>
                <h4 class="modal-title">Pendaftaran Diskusi</h4>
                <?php endif; ?>
			</div>
			<div class="modal-body">
                <?php if($is_admin) : ?>
                <p>Anda Sedang Melakukan Pendaftaran Komunikasi dan Bantuan. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
                <?php else : ?>
                <p>Anda Sedang Melakukan Pendaftaran Diskusi. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
                <?php endif; ?>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_cmm" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
