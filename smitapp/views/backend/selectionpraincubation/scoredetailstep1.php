<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Penilaian Seleksi Pra-Inkubasi Tahap 1</h2>
            </div>
            <div class="body">
                <?php if($is_admin): ?>
                    <div class="text-right bottom25">                        
                        <a href="<?php echo base_url('seleksiprainkubasi/nilai'); ?>" class="btn btn-sm btn-success waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>     
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />
                    
                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiprainkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="5" style="width25;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>  	
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
                                    $sum_score      = $this->Model_Praincubation->sum_all_score($data_selection->id);
                                    if(empty($sum_score)){
                                        $sum_score  = 0;
                                    }
                                    
                                    $count_all_jury = $this->Model_Praincubation->count_all_score($data_selection->id);
                                    if(empty($count_all_jury)){
                                        $count_all_jury = 0;
                                    }
                                    
                                    if(!empty($sum_score) && !empty($count_all_jury)){
                                        $average_score  = round( $sum_score / $count_all_jury );
                                    }else{
                                        $average_score  = 0;
                                    }
                                    
                                ?>
                                <tr>
                                    <td colspan="7" align="right">Jumlah Total Nilai</td>
                                    <td class="text-center"><strong><?php echo $sum_score; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="7" align="right">Nilai Rata-rata</td>
                                    <?php if($average_score >= KKM_STEP1 && $average_score <= MAX_SCORE) :?>
                                    <td class="text-center" style="color: green !important; font-size: 20px;"><strong><?php echo floor($average_score); ?></td>
                                    <?php else : ?>
                                    <td class="text-center" style="color: red !important; font-size: 20px;"><strong><?php echo floor($average_score); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </tfoot>
                        </table>
                        
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
                    </div>
                    
                <?php elseif($is_jury): ?>
                    <div class="text-right bottom25">                        
                        <a href="<?php echo base_url('seleksiprainkubasi/nilai'); ?>" class="btn btn-sm btn-success waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>     
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />
                    
                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiprainkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="5" style="width25;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>  	
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
                                    $sum_score      = $this->Model_Praincubation->sum_all_score($data_selection->id);
                                    if(empty($sum_score)){
                                        $sum_score  = 0;
                                    }
                                    
                                    $count_all_jury = $this->Model_Praincubation->count_all_score($data_selection->id);
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
                                    <ol>A = Nilai Dokumen</ol>
                                    <ol>B = Nilai Target</ol>
                                    <ol>C = Nilai Perlindungan</ol>
                                    <ol>D = Nilai Penelitian</ol>
                                    <ol>E = Nilai Market</ol>
                                </ul>
                            </p>
                        </div>
                    </div>
                
                <?php elseif($is_pengusul || $is_pelaksana): ?>    
                    <div class="text-right bottom25">                        
                        <a href="<?php echo base_url('seleksiprainkubasi/nilai'); ?>" class="btn btn-sm btn-success waves-effect back"><i class="material-icons">arrow_back</i> Kembali</a>     
                    </div>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->name); ?></h4>
                    <h4 class="text-center"><?php echo strtoupper($data_selection->event_title); ?></h4><br />
                    
                    <div class="table-container table-responsive table-praincubation-score">
                        <table class="table table-striped table-bordered table-hover" id="admin_stepone" data-url="<?php echo base_url('seleksiprainkubasi/nilai/detail/step1/'.$data_selection->id.''); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
                                    <td rowspan="2" class="text-center"><strong>NO.</strong></td></td>
                                    <td rowspan="2" class="text-center"><strong>PENILAI / JURI</strong></td>
                                    <td colspan="5" style="width25;" class="text-center"><strong>KRITERIA PENILAIAN</strong></td>
                                    <td rowspan="2" class="text-center"><strong>TOTAL NILAI</strong></td>  	
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
                                    $sum_score      = $this->Model_Praincubation->sum_all_score($data_selection->id);
                                    if(empty($sum_score)){
                                        $sum_score  = 0;
                                    }
                                    
                                    $count_all_jury = $this->Model_Praincubation->count_all_score($data_selection->id);
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
                                    <ol>A = Nilai Dokumen</ol>
                                    <ol>B = Nilai Target</ol>
                                    <ol>C = Nilai Perlindungan</ol>
                                    <ol>D = Nilai Penelitian</ol>
                                    <ol>E = Nilai Market</ol>
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