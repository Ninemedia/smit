<!-- BEGIN INFORMATION SUCCESS DETAIL COMMENT MODAL -->
<div class="modal fade" id="incdetail_comment1" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Detail Komentar Step 1</h4>
			</div>
			<div class="modal-body">
                <div class="form-group form-float">
                    <?php echo form_open_multipart( '', array( 'id'=>'incdetail_commentstep1', 'role'=>'form' ) ); ?>
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
                <h2>Penilaian Seleksi Inkubasi Tahap 1</h2>
            </div>
            <div class="body">
                <?php if($is_admin): ?>
                    <div class="text-right bottom25">
                        <a href="<?php echo base_url('seleksiinkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />

                    <div class="table-container table-responsive table-incubation-score">
                        <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiinkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="5" style="width35;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>
                                    <td rowspan="2" class="text-center"><strong>Lihat Komentar</strong></td>
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    $sum_score      = $this->Model_Incubation->sum_all_score($data_selection->id);
                                    if(empty($sum_score)){
                                        $sum_score  = 0;
                                    }

                                    $count_all_jury = $this->Model_Incubation->count_all_score($data_selection->id);
                                    if(empty($count_all_jury)){
                                        $count_all_jury = 0;
                                    }

                                    if(!empty($sum_score) && !empty($count_all_jury)){
                                        $avarage_score  = $sum_score / $count_all_jury;
                                    }else{
                                        $avarage_score  = 0;
                                    }

                                ?>
                                <tr>
                                    <td colspan="7" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP1 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = <?php echo DEFINE_A; ?></ol>
                                    <ol>B = <?php echo DEFINE_B; ?></ol>
                                    <ol>C = <?php echo DEFINE_C; ?></ol>
                                    <ol>D = <?php echo DEFINE_D; ?></ol>
                                    <ol>E = <?php echo DEFINE_E; ?></ol>
                                </ul>
                            </p>
                        </div>
                    </div>

                <?php elseif($is_jury): ?>
                    <div class="text-right bottom25">
                        <a href="<?php echo base_url('seleksiinkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />

                    <div class="table-container table-responsive table-incubation-score">
                        <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiinkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="5" style="width25;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>
                                    <td rowspan="2" class="text-center"><strong>Lihat Komentar</strong></td>
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    $sum_score      = $this->Model_Incubation->sum_all_score($data_selection->id);
                                    if(empty($sum_score)){
                                        $sum_score  = 0;
                                    }

                                    $count_all_jury = $this->Model_Incubation->count_all_score($data_selection->id);
                                    if(empty($count_all_jury)){
                                        $count_all_jury = 0;
                                    }

                                    if(!empty($sum_score) && !empty($count_all_jury)){
                                        $avarage_score  = $sum_score / $count_all_jury;
                                    }else{
                                        $avarage_score  = 0;
                                    }

                                ?>
                                <tr>
                                    <td colspan="7" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP1 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = <?php echo DEFINE_A; ?></ol>
                                    <ol>B = <?php echo DEFINE_B; ?></ol>
                                    <ol>C = <?php echo DEFINE_C; ?></ol>
                                    <ol>D = <?php echo DEFINE_D; ?></ol>
                                    <ol>E = <?php echo DEFINE_E; ?></ol>
                                </ul>
                            </p>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="text-right bottom25">
                        <a href="<?php echo base_url('seleksiinkubasi/nilai'); ?>" class="btn btn-sm btn-default waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />

                    <div class="table-container table-responsive table-incubation-score">
                        <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiinkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI</strong></td>
                                    <td colspan="5" style="width25;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>
                                    <td rowspan="2" class="text-center"><strong>Lihat Komentar</strong></td>
                                </tr>
                                <tr role="row" class="heading bg-blue">
        							<td class="text-center">A</td>
                                    <td class="text-center">B</td>
                                    <td class="text-center">C</td>
                                    <td class="text-center">D</td>
                                    <td class="text-center">E</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                            <tfoot>
                                <?php
                                    $sum_score      = $this->Model_Incubation->sum_all_score($data_selection->id);
                                    if(empty($sum_score)){
                                        $sum_score  = 0;
                                    }

                                    $count_all_jury = $this->Model_Incubation->count_all_score($data_selection->id);
                                    if(empty($count_all_jury)){
                                        $count_all_jury = 0;
                                    }

                                    if(!empty($sum_score) && !empty($count_all_jury)){
                                        $avarage_score  = $sum_score / $count_all_jury;
                                    }else{
                                        $avarage_score  = 0;
                                    }

                                ?>
                                <tr>
                                    <td colspan="7" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right">Nilai Rata-rata</td>
                                    <?php if($avarage_score >= KKM_STEP1 && $avarage_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($avarage_score); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="alert bg-grey bottom0">
                            <p>
                                Keterangan Kriteria:
                                <ul>
                                    <ol>A = <?php echo DEFINE_A; ?></ol>
                                    <ol>B = <?php echo DEFINE_B; ?></ol>
                                    <ol>C = <?php echo DEFINE_C; ?></ol>
                                    <ol>D = <?php echo DEFINE_D; ?></ol>
                                    <ol>E = <?php echo DEFINE_E; ?></ol>
                                </ul>
                            </p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
