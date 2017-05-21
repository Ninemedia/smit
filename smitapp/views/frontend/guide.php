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
                    <li <?php echo ($active_page == 'berkasdigital' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('berkasdigital'); ?>">
                            <i class=""></i> <strong>Berkas Digital</strong>
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
				<h3>Berkas Digital</h3>
			</div>
			<div class="col-md-12">
                <div class="panel-body">
                    <div class="table-container table-responsive bottom50">
                        <table class="table table-striped table-hover" id="guide_list" data-url="<?php echo base_url('frontend/guidelistdata'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
                                    <th class="width20 text-center">Judul Berkas</th>
        							<th class="width35 text-center">Deskripsi</th>
                                    <th class="width5 text-center">File</th>
                                    <th class="width10 text-center">Tanggal</th>
        							<th class="width10 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
    					        </tr>
                                <tr role="row" class="filter table-filter">
        							<td></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm" name="search_desc" /></td>
        							<td></td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
        							</td>
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_guide_list">Search</button>
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
            
            
                <!--
                <h3>2017</h3>
                <div class="panel-body">
                    <div class="row clearfix">
                        <div class="col-md-1">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>icon/pdf.png" alt="" />
                        </div>
                        <div class="col-md-11">
                            <strong>Formulir Pendaftaran Seleksi Inkubasi 2017</strong><br />
                            <i class="material-icons">folder</i> File Name : formulir_seleksi_inkubasi_2017_rev2.docx <br />
                            <i class="material-icons">speaker_notes</i> Deskripsi : Formulir seleksi Inkubasi teknologi LIPI 2017, revisi lembar pengesahan <br />
                            <i class="material-icons">file_download</i> Link : <a href="">Download Now</a>
                        </div>
                    </div><br />
                    <div class="row clearfix">
                        <div class="col-md-1">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>icon/doc.png" alt="" />
                        </div>
                        <div class="col-md-11">
                            <strong>Formulir Pendaftaran Seleksi Inkubasi 2017</strong><br />
                            <i class="material-icons">folder</i> File Name : formulir_seleksi_inkubasi_2017_rev2.docx <br />
                            <i class="material-icons">speaker_notes</i> Deskripsi : Formulir seleksi Inkubasi teknologi LIPI 2017, revisi lembar pengesahan <br />
                            <i class="material-icons">file_download</i> Link : <a href="">Download Now</a>
                        </div>
                    </div><br />
                    <div class="row clearfix">
                        <div class="col-md-1">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>icon/pdf.png" alt="" />
                        </div>
                        <div class="col-md-11">
                            <strong>Formulir Pendaftaran Seleksi Inkubasi 2017</strong><br />
                            <i class="material-icons">folder</i> File Name : formulir_seleksi_inkubasi_2017_rev2.docx <br />
                            <i class="material-icons">speaker_notes</i> Deskripsi : Formulir seleksi Inkubasi teknologi LIPI 2017, revisi lembar pengesahan <br />
                            <i class="material-icons">file_download</i> Link : <a href="">Download Now</a>
                        </div>
                    </div><br />
                    <div class="row clearfix">
                        <div class="col-md-1">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>icon/xls.png" alt="" />
                        </div>
                        <div class="col-md-11">
                            <strong>Formulir Pendaftaran Seleksi Inkubasi 2017</strong><br />
                            <i class="material-icons">folder</i> File Name : formulir_seleksi_inkubasi_2017_rev2.docx <br />
                            <i class="material-icons">speaker_notes</i> Deskripsi : Formulir seleksi Inkubasi teknologi LIPI 2017, revisi lembar pengesahan <br />
                            <i class="material-icons">file_download</i> Link : <a href="">Download Now</a>
                        </div>
                    </div><br />
                    <div class="row clearfix">
                        <div class="col-md-1">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>icon/pdf.png" alt="" />
                        </div>
                        <div class="col-md-11">
                            <strong>Formulir Pendaftaran Seleksi Inkubasi 2017</strong><br />
                            <i class="material-icons">folder</i> File Name : formulir_seleksi_inkubasi_2017_rev2.docx <br />
                            <i class="material-icons">speaker_notes</i> Deskripsi : Formulir seleksi Inkubasi teknologi LIPI 2017, revisi lembar pengesahan <br />
                            <i class="material-icons">file_download</i> Link : <a href="">Download Now</a>
                        </div>
                    </div><br />
                    <div class="row clearfix">
                        <div class="col-md-1">
                            <img class="js-animating-object img-responsive" src="<?php echo FE_IMG_PATH; ?>icon/pdf.png" alt="" />
                        </div>
                        <div class="col-md-11">
                            <strong>Formulir Pendaftaran Seleksi Inkubasi 2017</strong><br />
                            <i class="material-icons">folder</i> File Name : formulir_seleksi_inkubasi_2017_rev2.docx <br />
                            <i class="material-icons">speaker_notes</i> Deskripsi : Formulir seleksi Inkubasi teknologi LIPI 2017, revisi lembar pengesahan <br />
                            <i class="material-icons">file_download</i> Link : <a href="">Download Now</a>
                        </div>
                    </div>
                </div>
                -->
			    
            </div>
		</div>
	</div>
</div>