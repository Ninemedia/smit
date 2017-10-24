<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Daftar Pra-Inkubasi</h2></div>
            <div class="body">
                <?php if( $is_admin ) : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR PRA-INKUBASI
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH PRA-INKUBASI
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_praincubation" data-url="<?php echo base_url('prainkubasi/daftardata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width5">No</th>
                                        <th class="width5 text-center">Tahun</th>
            							<!-- <th class="width15">Pengguna</th> -->
            							<th class="width15">Nama Peneliti Utama</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
            							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_now   = date('Y')+1;
                                                $year_arr   = smit_select_year(1945,$year_now);
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
                                        <!-- <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td> -->
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                        <td>
                                            <?php
                                            	$workunit_type = smit_workunit_type();
                                                $option = array('' => 'Pilih...');
                                                $extra = 'name="search_workunit" class="form-control def"';

                                                if( !empty($workunit_type) ){
                                                    foreach($workunit_type as $val){
                                                        $option[$val->workunit_id] = $val->workunit_name;
                                                    }
                                                }
                                                echo form_dropdown('workunit_type',$option,'',$extra);
                                            ?>
                                        </td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <!--
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
                                        -->
            							<td style="text-align: center;">
                                            <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubation_list">Search</button>
                                            <button class="btn bg-red waves-effect filter-cancel" id="btn_praincubation_listreset">Reset</button>
            							</td>
            						</tr>
                                </thead>
                                <tbody>
                                    <!-- Data Will Be Placed Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in" id="add">
                        <?php echo form_open_multipart( 'praincubation/praincubationadd', array( 'id'=>'praincubationadd', 'role'=>'form' ) ); ?>
                            <div id="alert" class="alert display-hide"></div>
                            <h4>Masukan Data Pra-Inkubasi</h4>
                            
                            <div class="form-group">
                                <label class="form-label">Tahun <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">date_range</i></span>
                                    <select class="form-control show-tick" name="reg_year" id="reg_year">
                                    <?php
                                        $option = array(''=>'-- Pilih Tahun --');
                                        $year_now   = date('Y')+1;
                                        $year_arr   = smit_select_year(1945,$year_now);
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
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Pengguna<b style="color: red !important;">(*)</b></label>
                                <p>Pastikan sudah ada username / pengguna sistem terlebih dahulu</p>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                    <select class="form-control show-tick" name="reg_user_id" id="reg_user_id">
                                        <?php
                                            $conditions     = ' WHERE %type% = 6 OR %type% = 7 OR %type% = 5';
                                        	$user_list      = $this->Model_User->get_all_user(0, 0, $conditions);
                                         
                                            
                                            if( !empty($user_list) ){
                                                echo '<option value="">-- Pilih Nama Penguna --</option>';
                                                foreach($user_list as $row){
                                                    if( $row->type == 2 ){
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
                                                    
                                                    echo '<option value="'.$row->id.'">'.strtoupper($row->name).' - '. $status.'</option>';
                                                }
                                            }else{
                                                echo '<option value="">-- Tidak Ada Pilihan --</option>';
                                            }
            	                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Peneliti Utama <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <input type="text" name="reg_name" id="reg_name" class="form-control" placeholder="Masukan Nama Peneliti Utama" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kategori Kegiatan <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                    <select class="form-control show-tick" name="reg_category" id="reg_category">
                                    	<?php
                                    		$category     = smit_category();
                                    		if( !empty($category) ){
                                    			echo '<option value="">-- Pilih Kategori Bidang --</option>';
                                    			foreach($category as $row){
                                    				echo '<option value="'.$row->category_id.'">'.strtoupper($row->category_name).'</option>';
                                    			}
                                    		}else{
                                    			echo '<option value="">-- Tidak Ada Pilihan --</option>';
                                    		}
                                    	?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Judul Kegiatan <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                    <div class="form-line">
                                        <input type="text" name="reg_title" id="reg_title" class="form-control" placeholder="Masukan Judul Kegiatan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Deskripsi Kegiatan <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <h4>Berkas Kegiatan Pra-Inkubasi</h4>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Upload Proposal Kegiatan</label>
                                    <p>
                                        File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>DOCX/DOC/PDF.</strong>
                                    </p>
                                    <input id="reg_selection_files" name="reg_selection_files" class="form-control" type="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Upload Rencana Anggaran Biaya</label>
                                    <p>
                                        File yang dapat di upload Maksimal 2048 KB dan format File adalah <strong>XLXS/XLX.</strong>
                                    </p>
                                    <input id="reg_selection_rab" name="reg_selection_rab" class="form-control" type="file">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect" id="btn_praincubationadd">Tambah Pra-Inkubasi</button>
                            <button type="button" class="btn btn-danger waves-effect" id="btn_praincubationadd_reset">Bersihkan</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php else :  ?>
                    <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="list_praincubation" data-url="<?php echo base_url('prainkubasi/daftardata'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
                                    <th class="width10 text-center">Tahun</th>
        							<!-- <th class="width15">Pengguna</th> -->
        							<th class="width15">Nama Peneliti Utama</th>
                                    <th class="width10 text-center">Satuan Kerja</th>
                                    <th class="width20 text-center">Judul Kegiatan</th>
                                    <!-- <th class="width10 text-center">Tanggal Usulan</th> -->
        							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
        						</tr>
                                <tr role="row" class="filter display-hide table-filter">
        							<td></td>
                                    <td>
                                        <select name="search_year" class="form-control form-filter input-sm def">
                                        <?php
                                            $option = array(''=>'Pilih Tahun');
                                            $year_now   = date('Y')+1;
                                            $year_arr   = smit_select_year(1945,$year_now);
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
                                    <!-- <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td> -->
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                    <td>
                                        <?php
                                        	$workunit_type = smit_workunit_type();
                                            $option = array('' => 'Pilih...');
                                            $extra = 'name="search_workunit" class="form-control show-tick def"';

                                            if( !empty($workunit_type) ){
                                                foreach($workunit_type as $val){
                                                    $option[$val->workunit_id] = $val->workunit_name;
                                                }
                                            }
                                            echo form_dropdown('workunit_type',$option,'',$extra);
                                        ?>
                                    </td>
        							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                    <!--
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
        							</td>
                                    -->
        							<td style="text-align: center;">
                                        <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_praincubation_list">Search</button>
                                        <button class="btn bg-red waves-effect filter-cancel">Reset</button>
        							</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE INCUBATION MODAL -->
<div class="modal fade" id="save_praincubationadd" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Pra-Inkubasi. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_praincubationadd" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE INCUBATION MODAL -->
