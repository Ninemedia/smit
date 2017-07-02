<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Laporan Seleksi Pra Inkubasi</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> DAFTAR LAPORAN PRA-INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">add_box</i> TAMBAH LAPORAN
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="list_praincubationreport" data-url="<?php echo base_url('prainkubasi/laporandata'); ?>">
                                <thead>
            						<tr role="row" class="heading bg-blue">
            							<th class="width5">No</th>
                                        <th class="width10 text-center">Tahun</th>
            							<th class="width15">Pengguna</th>
            							<th class="width15">Nama Peneliti Utama</th>
                                        <th class="width10 text-center">Satuan Kerja</th>
                                        <th class="width20 text-center">Judul Kegiatan</th>
                                        <th class="width5 text-center">1</th>
                                        <th class="width5 text-center">2</th>
                                        <th class="width5 text-center">3</th>
                                        <th class="width5 text-center">4</th>
                                        <th class="width5 text-center">5</th>
                                        <th class="width5 text-center">6</th>
                                        <th class="width5 text-center">7</th>
                                        <th class="width5 text-center">8</th>
                                        <th class="width5 text-center">9</th>
                                        <th class="width5 text-center">10</th>
                                        <th class="width10 text-center">Tanggal Usulan</th>
            							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
            						</tr>
                                    <tr role="row" class="filter display-hide table-filter">
            							<td></td>
                                        <td>
                                            <select name="search_year" class="form-control form-filter input-sm def">
                                            <?php
                                                $option = array(''=>'Pilih Tahun');
                                                $year_arr = smit_select_year(date('Y'),2030);
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
                                        <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_user" /></td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                        <td>
                                            <?php
                                            	$workunit_type = smit_workunit_type();
                                                $option = array('' => 'Pilih...');
                                                $extra = 'name="search_workunit" class="form-control show-tick"';

                                                if( !empty($workunit_type) ){
                                                    foreach($workunit_type as $val){
                                                        $option[$val->workunit_id] = $val->workunit_name;
                                                    }
                                                }
                                                echo form_dropdown('workunit_type',$option,'',$extra);
                                            ?>
                                        </td>
            							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
            								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
            								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
            							</td>
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
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        
                    </div>
                </div>
                <?php else : ?>
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="list_praincubationreport" data-url="<?php echo base_url('prainkubasi/laporandata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
                                <th class="width10 text-center">Tahun</th>
    							<th class="width15">Nama Peneliti Utama</th>
                                <th class="width10 text-center">Satuan Kerja</th>
                                <th class="width20 text-center">Judul Kegiatan</th>
                                <th class="width5 text-center">1</th>
                                <th class="width5 text-center">2</th>
                                <th class="width5 text-center">3</th>
                                <th class="width5 text-center">4</th>
                                <th class="width5 text-center">5</th>
                                <th class="width5 text-center">6</th>
                                <th class="width5 text-center">7</th>
                                <th class="width5 text-center">8</th>
                                <th class="width5 text-center">9</th>
                                <th class="width5 text-center">10</th>
                                <th class="width10 text-center">Tanggal Usulan</th>
    							<th class="width15 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    						</tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td>
                                    <select name="search_year" class="form-control form-filter input-sm def">
                                    <?php
                                        $option = array(''=>'Pilih Tahun');
                                        $year_arr = smit_select_year(date('Y'),2030);
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
                                <td>
                                    <?php
                                    	$workunit_type = smit_workunit_type();
                                        $option = array('' => 'Pilih...');
                                        $extra = 'name="search_workunit" class="form-control show-tick"';
    
                                        if( !empty($workunit_type) ){
                                            foreach($workunit_type as $val){
                                                $option[$val->workunit_id] = $val->workunit_name;
                                            }
                                        }
                                        echo form_dropdown('workunit_type',$option,'',$extra);
                                    ?>
                                </td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
    								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
    								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
    							</td>
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