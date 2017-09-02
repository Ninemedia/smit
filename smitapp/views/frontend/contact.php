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
                    <li <?php echo ($active_page == 'contact' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('contact'); ?>">
                            <i class=""></i> <strong>Kontak</strong>
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
				<h3>Kontak</h3>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6">  
                <div class="panel-body">
                    <?php echo form_open_multipart( 'frontend/contactadd', array( 'id'=>'contactadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <h4>Kirim pesan kepada kami : </h4>
                        <div class="form-group">
                            <label class="control-label">Nama Anda <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <?php 
                                        echo form_input(
                                            'contact_name',
                                            ( !empty($post) ? smit_isset($post['contact_name'],'') : '' ),
                                            array(
                                                'class'=>'form-control text-uppercase',
                                                'placeholder'=>'Masukan Nama Anda...',
                                                'required'=>'required'
                                            )
                                        ); 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">email</i></span>
                                <div class="form-line">
                                    <?php 
                                        echo form_input(
                                            'contact_email',
                                            ( !empty($post) ? smit_isset($post['contact_email'],'') : '' ),
                                            array(
                                                'class'=>'form-control',
                                                'placeholder'=>'Masukan Email Anda...',
                                                'required'=>'required'
                                            )
                                        ); 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Judul Pesan <b style="color: red !important;">(*)</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                <div class="form-line">
                                    <?php 
                                        echo form_input(
                                            'contact_title',
                                            ( !empty($post) ? smit_isset($post['contact_title'],'') : '' ),
                                            array(
                                                'class'=>'form-control text-uppercase',
                                                'placeholder'=>'Masukan Judul Pesan...',
                                                'required'=>'required'
                                            )
                                        ); 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pesan <b style="color: red !important;">(*)</b></label>
                            <div class="form-line">
                                <?php 
                                    echo form_textarea(
                                        array(
                                            'name'=>'contact_desc',
                                            'class'=>'form-control no-resize',
                                            'rows'=>4,
                                            'placeholder'=>'Masukan Pesan Anda...'
                                        ),
                                        ( !empty($post) ? smit_isset($post['contact_desc'],'') : '' )
                                    ); 
                                ?>
                            </div>
                        </div>
                        <div class="form-group smit-captcha-box-contact">
                			<div class="g-recaptcha smit-captcha-contact" data-smit-site-key="<?php echo config_item( 'captcha_site_key' ); ?>"></div>
                		</div>
                        <button class="btn btn-md btn-primary waves-effect" type="submit">Kirim Pesan</button>
                        <button class="btn btn-md btn-danger waves-effect" id="btn_contactadd_reset">Bersihkan</button>
                    <?php echo form_close(); ?>         
                </div>
            </div>
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="panel-body">
                    <h4>Hubungi Kami : </h4>
                    <p align="justify">
                        <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>slider/slider1.jpg" alt="" /><hr />
                        Pusat Inovasi LIPI<br />
                        Bidang Inkubasi dan Alih Teknologi<br />
                        Jalan Raya Jakarta - Bogor KM. 47 Cibinong<br /><br />
                        <i class="icon-phone"></i> Phone : (+62) 21-8791-7216<br />
                        <i class="icon-phone"></i> Fax : (+62) 21-8791-7221<br />
                        <i class="icon-mail2"></i> Mail : intek.pusinov@mail.lipi.go.id
                    </p>
                </div>
            </div>
		</div>
	</div>
</div>

<!-- BEGIN INFORMATION SUCCESS SAVE CONTACT MODAL -->
<div class="modal fade" id="save_contact" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Mengirim Pesan</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Melakukan Pengiriman Pesan Kepada Pihak Pusat Inovasi LIPI Bidang Inkubasi dan Alih Teknolgi. 
                Pastikan Data yang Anda masukan sudah benar! Terima Kasih.</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn danger waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_contact" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE CONTACT MODAL -->