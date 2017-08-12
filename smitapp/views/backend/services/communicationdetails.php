<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('layanan/komunikasibantuan'); ?>" class="btn btn-sm btn-default waves-effect pull-right back"><i class="material-icons">arrow_back</i> Kembali</a>
                <h2><?php echo strtoupper($communication_data->title); ?></h2>
                <p class="bottom0">Tanggal Pesan : <?php echo date('d F Y H:i:s', strtotime($communication_data->datecreated)); ?></p>
            </div>
            <div class="body">
                <p align="justify" class="uppercase">
                    Pengirim : <strong><?php echo strtoupper($communication_data->name); ?></strong>
                </p><hr />
                <?php if( !empty($cmm_data) ) : ?>
                <?php
                    foreach ($cmm_data AS $row) {
                        if($row->user_id == $user->id){
                ?>
                    <p align="left" class="bottom50">
                        <strong>Anda, <?php echo date('d F Y H:i:s', strtotime($row->datecreated)); ?> : <br />
                        <?php echo $row->desc; ?>
                        </strong>
                    </p>
                    <?php }else{ ?>
                    <p align="right" class="bottom50">
                        <?php $userdata = $this->Model_User->get_user_by('id', $row->user_id); ?>
                        <strong><?php echo strtoupper( $userdata->name ); ?>, <?php echo date('d F Y H:i:s', strtotime($row->datecreated)); ?> : </strong><br />
                        <?php echo $row->desc; ?>
                    </p>
                <?php }} ?>
                <?php endif; ?>
                
                <?php if($is_admin || $is_pendamping) : ?>
                <a class="btn bg-blue waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample"> Balas Pesan </a>
                <div id="collapseExample" class="collapse" aria-expanded="true" style="">
                    <div class="well">
                        <div class="card">
                            <div class="body">
                                <?php echo form_open_multipart( 'backend/communicationreply', array( 'id'=>'cmmreply_form', 'role'=>'form' ) ); ?>
                                    <div id="alert" class="alert display-hide"></div>
                                    <input type="hidden" name="cmm_user_id" id="cmm_user_id" value="<?php echo strtoupper($user->id); ?>" />
                                    <input type="hidden" name="cmm_id" id="cmm_id" value="<?php echo strtoupper($communication_data->id); ?>" />
                                    <input type="hidden" name="cmm_from_id" id="cmm_from_id" value="<?php echo strtoupper($communication_data->from_id); ?>" />
                                    <input type="hidden" name="cmm_title" id="cmm_title" value="<?php echo strtoupper($communication_data->title); ?>" />
                                    <div class="form-group">
                                        <label class="control-label">Isi Balasan Komunikasi <b style="color: red !important;">(*)</b></label>
                                        <div class="form-line">
                                            <?php
                                                echo form_textarea(
                                                    array(
                                                        'name'=>'cmm_description',
                                                        'class'=>'form-control no-resize',
                                                        'id'=>'cmm_description',
                                                        'rows'=>4,
                                                        'placeholder'=>'Silahkan isi deskripsi dari komikasi dan bantuan dengan maksimal 400 huruf...'
                                                    ),
                                                    ( !empty($post) ? smit_isset($post['cmm_description'],'') : '' )
                                                );
                                            ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect" id="btn_cmmreply">Balas Komunikasi</button>
                                    <button type="button" class="btn btn-danger waves-effect" id="btn_cmmreply_reset">Bersihkan</button>
                                <?php echo form_close(); ?>
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

<!-- BEGIN INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
<div class="modal fade" id="save_cmmreply" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Balasan Komunikasi dan Bantuan</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Balas Komunikasi dan Bantuan. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_cmmreply" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE COMMUNICATION MODAL -->
