<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('tenants/laporan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2>Laporan Tenant</h2>
            </div>
            <div class="body">
                <div class="table-container table-responsive">
                    <div class="table-actions-wrapper">
						<span></span>
						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
							<option value="">Select...</option>
							<option value="confirm">Terima</option>
							<option value="delete">Hapus</option>
						</select>
						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
					</div>
                    <table class="table table-striped table-bordered table-hover" id="list_praincubationreport" data-url="<?php echo base_url('tenants/laporandata/detail/'.$id.''); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5 text-center"><input name="select_all" id="select_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="select_all"></label></th>
                                <th class="width5">No</th>
                                <th class="width20 text-center">Nama Tenant</th>
                                <th class="width5 text-center">Berkas</th>
                                <th class="width5 text-center">Bulan</th>
                                <th class="width10 text-center">Status</th>
                                <th class="width10 text-center">Tanggal</th>
    							<th class="width10 text-center">Actions<br /><button class="btn btn-xs btn-warning table-search"><i class="material-icons">search</i></button></th>
    						</tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <select name="search_status" class="form-control form-filter input-sm def">
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
        </div>
    </div>
</div>
<!-- #END# Content -->

<!-- BEGIN INFORMATION SUCCESS SAVE REPORT PRAINCUBATION MODAL -->
<div class="modal fade" id="save_reportpraincubationadd" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Laporan Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Pendaftaran Laporan Pra-Inkubasi. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_reportpraincubationadd" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE REPORT PRAINCUBATION MODAL -->
