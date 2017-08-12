<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pesan Umum</h2></div>
            <div class="body">

                <p align="justify" class="bottom35">
                    <strong>Informasi ! </strong> Pesan ini hanya dapat di terima tanpa adanya timbal balik untuk dibalas. Dapat dipahami pesan masukan ini bisa menjadi acuan untuk meningkatkan sistem di kemudian hari. Terima Kasih.
                </p>
                <div id="alert" class="alert display-hide"></div>
                <div class="table-container table-responsive">
                    <div class="table-actions-wrapper">
						<span></span>
						<select class="table-group-action-input form-control input-inline input-small input-sm def" disabled="disabled">
							<option value="">Select...</option>
							<option value="confirm">Baca</option>
							<option value="delete">Hapus</option>
						</select>
						<button class="btn btn-sm btn-primary table-group-action-submit" disabled="disabled">Proses</button>
					</div>
                    <table class="table table-striped table-bordered table-hover" id="generalmessage_list" data-url="<?php echo base_url('backend/generalmessagelistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
                                <th class="width5 text-center"><input name="select_all" id="generalmessage_all" value="1" type="checkbox" class="select_all filled-in chk-col-orange" /><label for="generalmessage_all"></label></th>
    							<th class="width5">No</th>
    							<th class="width20 text-center">Nama Pengirim</th>
    							<th class="width20 text-center">Judul Pesan</th>
    							<th class="width15 text-center">Email</th>
    							<th class="width10 text-center">Status</th>
                                <!-- <th class="width10 text-center">Tanggal Daftar</th> -->
    							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
					        </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_email" /></td>
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
    								<button class="btn bg-blue waves-effect filter-submit" id="btn_list_message">Search</button>
                                    <button class="btn bg-red waves-effect filter-cancel" id="btn_list_messagereset">Reset</button>
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

<!-- BEGIN INFORMATION SUCCESS SAVE GENERAL MESSAGE MODAL -->
<div class="modal fade" id="save_generalmessage" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Pesan Umum</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pendaftaran Pesan Umum. Pastikan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-info waves-effect" id="do_save_generalmessage" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE GENERAL MESSAGE MODAL -->
