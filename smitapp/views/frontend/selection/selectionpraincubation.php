<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(1, 0) ? $this->uri->segment(2, 0) : '');
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
                    <li <?php echo ($active_page == 'seleksi' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('seleksi/prainkubasi'); ?>">
                            <i class=""></i> Seleksi
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'prainkubasi' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('seleksi/prainkubasi'); ?>">
                            <i class=""></i> <strong>Pendaftaran Seleksi Pra-Inkubasi</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
    if(!empty($lss->selection_year_publication)){
        $selection_year     = date('Y', strtotime($lss->selection_year_publication));    
    }
?>
<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 text-center gtco-heading">
				<h3>Mengenai Program Pra-Inkubasi</h3>
			</div>
			<div class="col-md-12">
                <div class="panel-body">
                    <p align="justify">
                        <?php echo get_option('be_frontend_praincubation'); ?>
                    </p>
                </div>
            </div>
		</div>
	</div>
</div>

<div id="gtco-content">
	<div class="gtco-container">
        <div class="row animate-box">
            <div class="col-md-12">
                <div class="card">
                    <?php if( !$lss || empty($lss) ){ ?>
                        <div class="header">
                            <h3 class="bottom0">SELEKSI BELUM DIBUKA</h3>
                        </div>
                        <div class="body">
                            <div class="body bg-teal">
                                <p align="center" class="bottom0"><strong>SELEKSI PRA INKUBASI UNTUK SEKARANG INI BELUM DIBUKA. <br />MOHON UNTUK MENUNGGU HINGGA PEMBUKAAN SELEKSI PRA INKUBASI SELANJUTNYA. TERIMA KASIH</strong></p>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="header">
                            <h3 class="bottom0">SELEKSI PRA-INKUBASI TAHUN <?php echo $selection_year; ?></h3>
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart( 'frontend/praincubationselection', array( 'id'=>'selectionpraincubation', 'role'=>'form' ) ); ?>
                                <div class="form-group form-float">
                                    
                                    <section id="account_selection">
                                        <div class="body bg-teal bottom30">
                                            <?php echo get_option('be_frontend_praincubation_note'); ?>
                                            Tanggal Penting : 
                                            <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample"> Lihat Lengkap </a>
                                            <div id="collapseExample" class="collapse" aria-expanded="true" style="">
                                                <div class="well">
                                                    <div class="card">
                                                        <div class="body">
                                                            <div class="body table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead class="bg bg-blue">
                                                                        <tr>
                                                                            <th><center>No</center></th>
                                                                            <th><center>Kegiatan</center></th>
                                                                            <th></th>
                                                                            <th><center>Tanggal Pelaksanaan</center></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td><strong>Publikasi</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_publication)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">2</th>
                                                                            <td><strong>Pendaftaran Online</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_reg_start)); ?> - <?php echo date('d F Y H:i:s', strtotime($lss->selection_date_reg_end)); ?></td>
                                                                        </tr>
                                                                         <tr>
                                                                            <th scope="row">3</th>
                                                                            <td><strong>Sleksi Administrasi & Subtansi Awal</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_adm_start)); ?> - <?php echo date('d F Y H:i:s', strtotime($lss->selection_date_adm_end)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">4</th>
                                                                            <td><strong>Undangan Presentasi Dikirim</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_invitation_send)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">5</th>
                                                                            <td><strong>Seleksi Presentasi & Wawancara</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_interview_start)); ?> - <?php echo date('d F Y H:i:s', strtotime($lss->selection_date_interview_end)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">6</th>
                                                                            <td><strong>Proposal & Anggaran</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_proposal_start)); ?> - <?php echo date('d F Y H:i:s', strtotime($lss->selection_date_proposal_end)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">7</th>
                                                                            <td><strong>Pengumuman Hasil Seleksi</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_date_agreement)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">8</th>
                                                                            <td><strong>Pelaksanaan Kegiatan</strong></td>
                                                                            <td><center>:</center></td>
                                                                            <td><?php echo date('d F Y H:i:s', strtotime($lss->selection_imp_date_start)); ?> - <?php echo date('d F Y H:i:s', strtotime($lss->selection_imp_date_end)); ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="alert" class="alert display-hide"></div>
                                        <h4 class="bottom10">Dokumen Panduan &amp; Proposal Seleksi Inkubasi</h4>
                                        <?php
                                            $guide_files_ids    = $lss->selection_files;
                                            $guide_files_ids    = explode(',',$guide_files_ids);
                                            $guide_files        = smit_get_selection_files($guide_files_ids);
                                            
                                            if( !empty($guide_files) ){
                                                echo '<ul class="bottom40">';
                                                foreach($guide_files as $file){
                                                    echo '<li>'.$file->title.' - <a href="'.base_url('unduhberkas/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                                }
                                                echo '</ul>';
                                            }else{
                                                echo '<strong>Tidak ada berkas panduan</strong>';
                                            }
                                        ?>
                                        
                                        <h4>Data Profil Pengguna</h4>
                                        <div class="input-group">
                                            <label class="form-label">Username Pengguna <b style="color: red !important;">(*)</b></label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="reg_username" id="reg_username" placeholder="Masukan username pengguna anda" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <label class="form-label">Kata Sandi Pengguna <b style="color: red !important;">(*)</b></label>
                                            <div class="form-line">
                                                <input type="password" class="form-control" name="reg_password" id="reg_password" placeholder="Masukan kata sandi pengguna anda" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" name="reg_year" id="reg_year" value="<?php echo $selection_year; ?>" >
                                        <button class="btn btn-block bg-blue waves-effect" id="check_username" type="button" data-selection="praincubation" data-url="<?php echo base_url('user/searchusername'); ?>"><strong>Cek Username</strong></button>
                                        <br />
                                        <center><a href="<?php echo base_url('signup'); ?>" id="sign-up-btn" class="center font-bold col-cyan">Pendaftaran Pengguna</a></center>
                                    </section>
                                    
                                    <section id="detail_selection" class="display-hide top30">
                                        <a href="<?php echo base_url('seleksi/prainkubasi');?>" class="pull-right">Kembali</a>
                                        <h4>Data Profil Pengguna</h4>
                                        <div id="username_info" class="top30"></div>
                                        <h4>Usulan Kegiatan Inkubasi</h4>
                                        <label class="form-label">Judul Kegiatan <b style="color: red !important;">(*)</b></label>
                                        <input type="hidden" class="form-control" name="reg_year" id="reg_year" value="<?php echo $selection_year; ?>" >
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">subject</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_event_title" id="reg_event_title" class="form-control" placeholder="Masukan Judul Kegiatan Anda" required>
                                            </div>
                                        </div>
                                        <label class="form-label">Deskripsi Kegiatan <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <textarea name="reg_desc" id="reg_desc" cols="30" rows="3" class="form-control no-resize" placeholder="Masukan Deskripsi Kegiatan Anda" required></textarea>
                                            </div>
                                        </div>
                                        <label class="form-label">Nama Peneliti Utama <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <input type="text" name="reg_name" id="reg_name" class="form-control" placeholder="Masukan Nama Peneliti Utama" required>
                                            </div>
                                        </div>
                                        <label class="form-label">Kategori Bidang <b style="color: red !important;">(*)</b></label>
                                        <div class="input-group">
                                            <?php $category = smit_category(); ?>
                                            <span class="input-group-addon"><i class="material-icons">assignment</i></span>
                                            <select class="form-control" name="reg_category" id="reg_category">
                                                <option value="">-- Pilih Kategori Bidang --</option>
                                                <?php if( !empty($category) ){ ?>
                                                    <?php foreach($category as $cat){ ?>
                                                        <option value="<?php echo $cat->category_slug; ?>"><?php echo $cat->category_name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="alert bg-teal">
                                            <strong>Perhatian!</strong>
                                            File yang dapat di upload adalah dengan Ukuran Maksimal 2 MB dan format File adalah <strong>doc/docx/pdf/xls/xlsx.</strong>
                                        </div>
                                        <div class="input-group">
                                            <label class="form-label">Upload Berkas Kegiatan (Docx/Doc/PDF) <b style="color: red !important;">(*)</b></label>
                                            <input id="selection_files" name="reg_selection_files" class="form-control" type="file" />
                                        </div>
                                        <div class="input-group">
                                            <label class="form-label">Upload Rencana Anggaran Kegiatan (Xlsx/Xls) <b style="color: red !important;">(*)</b></label>
                                            <input id="rab_selection_files" name="reg_selection_rab" class="form-control" type="file" />
                                        </div>
                                        
                                        <div class="input-group">
                                            <input class="filled-in" id="reg_agree" name="reg_agree" type="checkbox" />
                                            <label class="form-label reg_agree" for="reg_agree">Saya setuju dengan Syarat dan Ketentuan.</label>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary waves-effect">Ajukan Kegiatan</button>
                                        <button type="button" class="btn btn-danger waves-effect" id="btn_praincubation_reset">Bersihkan</button>
                                    </section>
                                </div>
                            <?php echo form_close(); ?>
                            
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>	
	</div>
</div>

<!-- BEGIN INFORMATION SUCCESS SAVE SELECTION PRA-INCUBATION MODAL -->
<div class="modal fade" id="save_selectionpraincubation" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Seleksi Pra-Inkubasi</h4>
			</div>
			<div class="modal-body">
                <p>Anda Sedang Mendaftarkan Seleksi Pra-Inkubasi. Pastinkan Data yang Anda masukan sudah benar!</p>
            </div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-primary waves-effect" id="do_save_selectionpraincubation" data-dismiss="modal">Lanjut</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SELECTION PRA-INCUBATION MODAL -->

<!-- BEGIN INFORMATION SUCCESS SAVE SELECTION PRA-INCUBATION MODAL -->
<div class="modal fade" id="save_selectionpraincubation_success" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Pendaftaran Seleksi Pra-Inkubasi Berhasil</h4>
			</div>
			<div class="modal-body">
                <p>
                    Pendaftaran seleksi pra-inkubasi baru berhasil!<br />
                    Data seleksi Anda akan segera di proses<br />
                    Silahkan <strong><a href="<?php echo base_url('login'); ?>">LOGIN</a></strong> untuk melihat data seleksi Anda!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<!-- END INFORMATION SUCCESS SAVE SELECTION PRA-INCUBATION MODAL -->