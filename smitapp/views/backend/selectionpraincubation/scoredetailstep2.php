<!-- BEGIN INFORMATION SUCCESS DETAIL COMMENT MODAL -->
<div class="modal fade" id="pradetail_comment2" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Detail Komentar Step 2</h4>
			</div>
			<div class="modal-body">
                <div class="form-group form-float">
                    <?php echo form_open_multipart( '', array( 'id'=>'pradetail_commentstep2', 'role'=>'form' ) ); ?>
                    <div class="form-group">
                        <label for="telp_contact">Isi Komentar</b></label>
                        <div class="input-group">
                            <div class="form-line">
                                <textarea cols="30" rows="3" class="form-control no-resize" id="commentbody" readonly="TRUE"></textarea>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS DETAIL COMMENT MODAL -->

<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Penilaian Seleksi Pra-Inkubasi Tahap 2</h2>
            </div>
            <div class="body">
                <?php if($is_admin): ?>
                    <div class="pull-right bottom25">
                        <a href="<?php echo base_url('seleksiprainkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />

                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="adminscore_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/nilai/detail/step2/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>KRITERIA PASAR (25%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>PRODUK / JASA (40%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>FINANSIAL (15%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>KAPASITAS SDM (10%)</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL</strong></td>
                                    <td rowspan="2" class="text-center"><strong>IRL</strong></td>
                                    <td rowspan="2" class="text-center"><strong>Lihat Komentar</strong></td>
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    // Total
                                    $sum_score2     = $this->Model_Praincubation->sum_all_score2($data_selection->id);
                                    if(empty($sum_score2)){
                                        $sum_score2  = 0;
                                    }

                                    $count_all_jury2= $this->Model_Praincubation->count_all_score2($data_selection->id);
                                    if(empty($count_all_jury2)){
                                        $count_all_jury2 = 0;
                                    }

                                    if(!empty($sum_score2) && !empty($count_all_jury2)){
                                        $avarage_score  = $sum_score2 / $count_all_jury2;
                                    }else{
                                        $avarage_score  = 0;
                                    }

                                    // IRL
                                    $sum_irl        = $this->Model_Praincubation->sum_all_irl($data_selection->id);
                                    if(empty($sum_irl)){
                                        $sum_irl  = 0;
                                    }

                                    if(!empty($sum_irl) && !empty($count_all_jury2)){
                                        $avarage_irl    = $sum_irl / $count_all_jury2;
                                    }else{
                                        $avarage_irl  = 0;
                                    }

                                ?>
                                <tr>
                                    <td colspan="26" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score2; ?></strong></td>
                                    <td class="text-center"><strong><?php echo $sum_irl; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="26" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP2 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php endif; ?>
                                    <td class="text-center" style="font-size: 20px;"><strong><?php echo floor($avarage_irl); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <!--
                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = Nilai Dokumen</ol>
                                    <ol>B = Nilai Target</ol>
                                    <ol>C = Nilai Perlindungan</ol>
                                    <ol>D = Nilai Penelitian</ol>
                                    <ol>E = Nilai Market</ol>
                                </ul>
                            </p>
                        </div>
                        -->
                    </div>

                <?php elseif($is_jury): ?>
                    <div class="pull-right bottom25">
                        <a href="<?php echo base_url('seleksiprainkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />

                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="adminscore_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/nilai/detail/step2/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>KRITERIA PASAR (25%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>PRODUK / JASA (40%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>FINANSIAL (15%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>KAPASITAS SDM (10%)</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL</strong></td>
                                    <td rowspan="2" class="text-center"><strong>IRL</strong></td>
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    // Total
                                    $sum_score2     = $this->Model_Praincubation->sum_all_score2($data_selection->id);
                                    if(empty($sum_score2)){
                                        $sum_score2  = 0;
                                    }

                                    $count_all_jury2= $this->Model_Praincubation->count_all_score2($data_selection->id);
                                    if(empty($count_all_jury2)){
                                        $count_all_jury2 = 0;
                                    }

                                    if(!empty($sum_score2) && !empty($count_all_jury2)){
                                        $avarage_score  = $sum_score2 / $count_all_jury2;
                                    }else{
                                        $avarage_score  = 0;
                                    }

                                    // IRL
                                    $sum_irl        = $this->Model_Praincubation->sum_all_irl($data_selection->id);
                                    if(empty($sum_irl)){
                                        $sum_irl  = 0;
                                    }

                                    if(!empty($sum_irl) && !empty($count_all_jury2)){
                                        $avarage_irl    = $sum_irl / $count_all_jury2;
                                    }else{
                                        $avarage_irl  = 0;
                                    }

                                ?>
                                <tr>
                                    <td colspan="26" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score2; ?></strong></td>
                                    <td class="text-center"><strong><?php echo $sum_irl; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="26" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP2 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php endif; ?>
                                    <td class="text-center" style="font-size: 20px;"><strong><?php echo floor($avarage_irl); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <!--
                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = Nilai Dokumen</ol>
                                    <ol>B = Nilai Target</ol>
                                    <ol>C = Nilai Perlindungan</ol>
                                    <ol>D = Nilai Penelitian</ol>
                                    <ol>E = Nilai Market</ol>
                                </ul>
                            </p>
                        </div>
                        -->
                    </div>
                <?php else : ?>
                    <div class="pull-right bottom25">
                        <a href="<?php echo base_url('seleksiprainkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>     
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />

                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="adminscore_steptwo" data-url="<?php echo base_url('seleksiprainkubasi/nilai/detail/step2/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>KRITERIA PASAR (25%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>PRODUK / JASA (40%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>FINANSIAL (15%)</strong></td>
                                    <td colspan="6" style="width25;" class="text-center"><strong>KAPASITAS SDM (10%)</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL</strong></td>
                                    <td rowspan="2" class="text-center"><strong>IRL</strong></td>
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
                                    <td class="text-center">SUM</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    // Total
                                    $sum_score2     = $this->Model_Praincubation->sum_all_score2($data_selection->id);
                                    if(empty($sum_score2)){
                                        $sum_score2  = 0;
                                    }

                                    $count_all_jury2= $this->Model_Praincubation->count_all_score2($data_selection->id);
                                    if(empty($count_all_jury2)){
                                        $count_all_jury2 = 0;
                                    }

                                    if(!empty($sum_score2) && !empty($count_all_jury2)){
                                        $avarage_score  = $sum_score2 / $count_all_jury2;
                                    }else{
                                        $avarage_score  = 0;
                                    }

                                    // IRL
                                    $sum_irl        = $this->Model_Praincubation->sum_all_irl($data_selection->id);
                                    if(empty($sum_irl)){
                                        $sum_irl  = 0;
                                    }

                                    if(!empty($sum_irl) && !empty($count_all_jury2)){
                                        $avarage_irl    = $sum_irl / $count_all_jury2;
                                    }else{
                                        $avarage_irl  = 0;
                                    }

                                ?>
                                <tr>
                                    <td colspan="26" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score2; ?></strong></td>
                                    <td class="text-center"><strong><?php echo $sum_irl; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="26" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP2 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php endif; ?>
                                    <td class="text-center" style="font-size: 20px;"><strong><?php echo floor($avarage_irl); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <!--
                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = Nilai Dokumen</ol>
                                    <ol>B = Nilai Target</ol>
                                    <ol>C = Nilai Perlindungan</ol>
                                    <ol>D = Nilai Penelitian</ol>
                                    <ol>E = Nilai Market</ol>
                                </ul>
                            </p>
                        </div>
                        -->
                    </div>

                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
