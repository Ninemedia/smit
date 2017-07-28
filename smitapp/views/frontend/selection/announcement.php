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
                        <a href="<?php echo base_url('seleksi/pengumuman'); ?>">
                            <i class=""></i> Seleksi
                        </a>
                    </li>
                    <li <?php echo ($active_page == 'announcement' ? 'class="active"' : ''); ?>>
                        <i class=""></i> <strong>Pengumuman</strong>
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
				<h3>Pengumuman</h3>
			</div>
			<div class="col-md-12">
                <div class="panel-body">
                    <div class="table-container table-responsive bottom50">
                        <table class="table table-striped table-bordered table-hover" id="announcement_list" data-url="<?php echo base_url('announcementlist'); ?>">
                            <thead>
        						<tr role="row" class="heading bg-blue">
        							<th class="width5">No</th>
        							<th class="width65 text-center">Judul Pengumuman</th>
                                    <th class="width20 text-center">Tanggal Publikasi</th>
                                    <th class="width10 text-center">Actions</th>
        						</tr>
                                <tr role="row" class="filter">
        							<td></td>
        							<td><input type="text" class="form-control form-filter input-sm text-lowercase" name="search_title" /></td>
                                    <td>
        								<input type="text" class="form-control form-filter input-sm date-picker text-center bottom5" readonly name="search_datecreated_min" placeholder="From" />
        								<input type="text" class="form-control form-filter input-sm date-picker text-center" readonly name="search_datecreated_max" placeholder="To" />
        							</td>
        							<td style="text-align: center;">
        								<button class="btn bg-blue waves-effect filter-submit bottom5-min bottom5" id="btn_announcement_list">Search</button>
                                        <button class="btn bg-red waves-effect filter-cancel">Reset</button>
        							</td>
        						</tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                        </table>
                    </div>
                    <!--
                    <h4>Pendaftaran</h4>
                    <p align="justify">
                        Pendaftaran dilakukan secara online pada form di bawah ini. Jadwal sebagai berikut. <br />
                        1. Pendaftaran online : 31 Oktober 2016 s/d 13 November 2016 <br />
                        2. Seleksi administrasi & Substansi awal : 14 s/d 15 November 2016 <br />
                        3. Undangan Prensentasi dikirim : 15 November 2016 <br />
                        4. Seleksi presentasi dan wawancara : 17 s/d 18 November 2016 <br />
                        5. Pengumuman hasil seleksi :  22 November 2016 <br />
                        6. Perbaikan proposal dan penelaahan anggaran : 23 s/d 25 November 2016 <br />
                        7. Penetapan & Penandatanganan Perjanjian : 7 Desember 2016 <br />
                        8. Pelaksanaan Kegiatan : 1 Februari 2017 s/d 30 November 2017
                    </p>
                    -->
                </div>
			    
            </div>
		</div>
	</div>
</div>