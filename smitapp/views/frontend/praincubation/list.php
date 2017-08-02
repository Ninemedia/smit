<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
?>

<div id="gtco-contentbreadcumb" class="animate-box">
	<div class="gtco-container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="body pull-left">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="icon-home"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('prainkubasi/daftarprainkubasi'); ?>">
                            <i class=""></i> Pra-Inkubasi
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'daftar' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('prainkubasi/daftarprainkubasi'); ?>">
                            <i class=""></i> <strong>Daftar Pra-Inkubasi</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 text-center gtco-heading">
				<h3>Daftar Pra-Inkubasi</h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header">
                    <h4>
                        
                    </h4>
                </div>
                <div class="body">
                    <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="list_praincubation" data-url="<?php echo base_url('prainkubasi/daftarprainkubasidata'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
                                    <th class="width5 text-center">Tahun</th>
        							<th class="width15">Nama Peneliti Utama</th>
                                    <th class="width15 text-center">Satuan Kerja</th>
                                    <th class="width20 text-center">Judul Kegiatan</th>
                                    <!-- <th class="width10 text-center">Tanggal Usulan</th> -->
        							<th class="width10 text-center">Actions<br /></th>
        						</tr>
                                <tr role="row" class="filter table-filter">
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
                </div>
            </div>
		</div>
	</div>
</div>

<!-- BEGIN INFORMATION SUCCESS DETAIL LIST MODAL -->
<div class="modal fade" id="detail_list" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <button class="btn btn-default waves-effect pull-right" type="button" data-dismiss="modal"><i class="material-icons">close</i></button>
				<h4 class="modal-title">Detail List Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <div class="table-container table-responsive">
                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DETAIL</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Tahun</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_year" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Nama Peneliti Utama</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_name" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Satuan Kerja</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_workunit" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Judul Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_title" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kategori</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_category" class="form-control" disabled="TRUE"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><textarea id="list_desc" class="form-control" disabled="TRUE"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            
            
                <!--
                <div class="form-group form-float">
                    <div class="form-group">
                        <label class="form-label">Nama Satuan Kerja <b style="color: red !important;">(*)</b></label>
                        <p id="list_name"></p>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                            <div class="form-line">
                                <input type="text" name="list_name" id="list_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                -->
            </div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS DETAIL LIST MODAL -->