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
                        <?php echo form_open_multipart( 'praincubation/praincubationadd', array( 'id'=>'praincubationadd', 'role'=>'form' ) ); ?>
                        <div id="alert" class="alert display-hide"></div>
                        <div class="form-group form-float">
                            <h4>Isian data Pengukuran IKM</h4>
                            <div class="form-group">
                                <label class="form-label">Apakah layanan sistem yang diberikan oleh Pusat Inovasi LIPI bidang Inkubasi Teknologi sudah sesuai dengan keinginan saudara? <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="irl-1" name="irl1" type="radio">
                                            <label for="irl-1">Sangat Stuju</label><br />
                                            <input id="irl-2" name="irl2" type="radio">
                                            <label for="irl-2">Setuju</label><br />
                                            <input id="irl-3" name="irl3" type="radio">
                                            <label for="irl-3">Tidak Setuju</label><br />
                                            <input id="irl-4" name="irl4" type="radio">
                                            <label for="irl-4">Sangat Tidak Setuju</label><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Apakah mekanisme penganggaran sistem yang diberikan oleh Pusat Inovasi LIPI bidang Inkubasi Teknologi sudah sesuai dengan proses penganggaran danpertanggungjawaban di dalam lembaga saudara ? <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="irl-1" name="irl1" type="radio">
                                            <label for="irl-1">Sangat Stuju</label><br />
                                            <input id="irl-2" name="irl2" type="radio">
                                            <label for="irl-2">Setuju</label><br />
                                            <input id="irl-3" name="irl3" type="radio">
                                            <label for="irl-3">Tidak Setuju</label><br />
                                            <input id="irl-4" name="irl4" type="radio">
                                            <label for="irl-4">Sangat Tidak Setuju</label><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Apakah proses curah pendapat (brainstorming) pada proses sistem yang diberikan oleh Pusat Inovasi LIPI bidang Inkubasi Teknologi sudah sesuai dengan keinginan saudara ? <b style="color: red !important;">(*)</b></label>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="irl-1" name="irl1" type="radio">
                                            <label for="irl-1">Sangat Stuju</label><br />
                                            <input id="irl-2" name="irl2" type="radio">
                                            <label for="irl-2">Setuju</label><br />
                                            <input id="irl-3" name="irl3" type="radio">
                                            <label for="irl-3">Tidak Setuju</label><br />
                                            <input id="irl-4" name="irl4" type="radio">
                                            <label for="irl-4">Sangat Tidak Setuju</label><br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-small btn-primary waves-effect" id="btn_praincubationadd">Submit</button>
                            <button type="button" class="btn btn-small btn-danger waves-effect" id="btn_praincubationadd_reset">Bersihkan</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>