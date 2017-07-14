<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
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
                        <a href="<?php echo base_url(); ?>">
                            <i class=""></i> Layanan
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'ikm' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('ikm'); ?>">
                            <i class=""></i> <strong>Pengukuran IKM</strong>
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
				<h3>Pengukuran IKM</h3>
			</div>
			<div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="bottom0">SURVEI PENGGUNAAN SISTEM INKUBASI TEKNOLOGI PUSAT INOVASI LIPI</h3>
                    </div>
                    <div class="body">
                        <?php echo form_open_multipart( 'frontend/ikmadddata', array( 'id'=>'ikmadddata', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <h4>Isian data Pengukuran IKM</h4>
                            <div class="form-group">
                                <label class="form-label">Email Anda <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                    <div class="form-line">
                                        <input type="text" name="ikm_email" id="ikm_email" class="form-control" placeholder="Masukan Email Anda" required>
                                    </div>
                                </div>
                            </div>
                            <?php if( !empty($ikm_list) ) : ?>
                            <?php
                                $i  = 1;
                                foreach($ikm_list AS $row){
                            ?>
                            <div class="form-group">
                                <input type="hidden" name="ikm_id_<?php echo $i; ?>" id="ikm_id" value="<?php echo $row->id; ?>" />
                                <input type="hidden" name="ikm_uniquecode_<?php echo $i; ?>" id="ikm_uniquecode" value="<?php echo $row->uniquecode; ?>" />
                                <label class="form-label"><?php echo $i; ?>. <?php echo $row->question; ?>? <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="sangat_setuju_<?php echo $i; ?>" name="answer_<?php echo $i; ?>" value="<?php echo SANGAT_SETUJU; ?>" type="radio">
                                            <label for="sangat_setuju_<?php echo $i; ?>">Sangat Setuju</label><br />
                                            <input id="setuju_<?php echo $i; ?>" name="answer_<?php echo $i; ?>" value="<?php echo SETUJU; ?>" type="radio">
                                            <label for="setuju_<?php echo $i; ?>">Setuju</label><br />
                                            <input id="tidak_setuju_<?php echo $i; ?>" name="answer_<?php echo $i; ?>" value="<?php echo TIDAK_SETUJU; ?>" type="radio">
                                            <label for="tidak_setuju_<?php echo $i; ?>">Tidak Setuju</label><br />
                                            <input id="sangat_tidaksetuju_<?php echo $i; ?>" name="answer_<?php echo $i; ?>" value="<?php echo SANGAT_TIDAK_SETUJU; ?>" type="radio">
                                            <label for="sangat_tidaksetuju_<?php echo $i; ?>">Sangat Tidak Setuju</label><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; } ?>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="form-label">Kritik dan Saran <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="form-line">
                                        <textarea name="ikm_comment" id="ikm_comment" cols="30" rows="3" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-small btn-primary waves-effect" id="btn_ikmadddata">Submit</button>
                                <button type="button" class="btn btn-small btn-danger waves-effect" id="btn_ikmadddata_reset">Bersihkan</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<!-- BEGIN INFORMATION SUCCESS SAVE IKM MODAL -->
<div class="modal fade" id="save_ikmadddata" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pengukuran IKM</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pengukuran Index Kepuasan Masyarakat. Pastikan Data yang Anda masukan sudah benar! Terima Kasih</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_ikmadddata" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE NEWS MODAL -->
