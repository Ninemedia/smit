<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
        <!-- Start List Guide Files -->
        <div class="card">
            <div class="header">
                <h2>Daftar Berkas Panduan</h2>
                <ul class="header-dropdown m-r-0">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons">info_outline</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <?php if($is_admin): ?>
                <div class="table-container table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="guide_list" data-url="<?php echo base_url('backend/guidelistdata'); ?>">
                        <thead>
    						<tr role="row" class="heading bg-blue">
    							<th class="width5">No</th>
                                <th class="width15 text-center">Judul Berkas</th>
    							<th class="width20 text-center">Deskripsi</th>
    							<th class="width20">Nama</th>
    							<th class="width10">Jenis File</th>
                                <th class="width10 text-center">Tanggal</th>
    							<th class="width20 text-center">Actions <button class="btn btn-xs btn-warning btn-floating table-search"><i class="material-icons">search</i></button></th>
					        </tr>
                            <tr role="row" class="filter display-hide table-filter">
    							<td></td>
                                <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_title" /></td>
                                <td><input type="text" class="form-control form-filter input-sm" name="search_desc" /></td>
    							<td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                <td>
                                    <select name="search_extension" class="form-control form-filter input-sm">
    									<option value="">Pilih...</option>
    									<option value="pdf">PDF</option>
    									<option value="doc">DOC</option>
    									<option value="docx">DOCX</option>
    									<option value="xls">XLS</option>
    									<option value="xlsx">XLSX</option>
    								</select>
                                </td>
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
                <?php else: ?>
                <?php endif ?> 
            </div>
        </div>
        <!-- End List Guide Files -->
        
        <?php if($is_admin): ?>
        <!-- Start Add Guide Files -->
        <div class="card">
            <div class="header"><h2>Tambah Berkas Panduan</h2></div>
            <div class="body">
                <?php echo form_open_multipart( '', array( 'id'=>'guide_files', 'role'=>'form' ) ); ?>
                    <div class="alert alert-info">
                        <strong>Perhatian!</strong>
                        File yang dapat di upload adalah dengan Ukuran Maksimal 2 MB dan format File adalah <strong>doc/docx/pdf/xls/xlsx.</strong>
                    </div>
                    
                    <div class="alert alert-danger error-validate <?php echo empty($message) ? 'display-hide' : ''; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="material-icons">close</i></button>
                        <?php if( !empty($message) ){ ?>
                            <?php echo $message; ?>
                        <?php }else{ ?>
                            Terjadi kesalahan, silahkan periksa kembali form dibawah!
                        <?php } ?>
            		</div>
                    
                    <div class="alert alert-success error-validate <?php echo empty($flashdata) ? 'display-hide' : ''; ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="material-icons">close</i></button>
                        <?php if( !empty($flashdata) ){ ?>
                            <?php echo $flashdata; ?>
                        <?php } ?>
            		</div>

                    <div class="form-group">
                        <label class="control-label">Judul Berkas</label>
                        <div class="form-line">
                            <?php 
                                echo form_input(
                                    'guide_title',
                                    ( !empty($post) ? smit_isset($post['guide_title'],'') : '' ),
                                    array(
                                        'class'=>'form-control text-uppercase',
                                        'placeholder'=>'Masukan Judul File...',
                                        'required'=>'required'
                                    )
                                ); 
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Deskripsi Berkas</label>
                        <div class="form-line">
                            <?php 
                                echo form_textarea(
                                    array(
                                        'name'=>'guide_description',
                                        'class'=>'form-control no-resize',
                                        'rows'=>4,
                                        'placeholder'=>'Silahkan isi deskripsi dari berkas panduan...'
                                    ),
                                    ( !empty($post) ? smit_isset($post['guide_description'],'') : '' )
                                ); 
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Berkas Panduan</label>
                        <input id="guide_selection_files" name="guide_selection_files" class="form-control" type="file">
                    </div>
                    <button class="btn btn-sm bg-blue waves-effect" type="submit">UPLOAD</button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <!-- End Add Guide Files -->
        <?php endif ?> 

    </div>
</div>
<!-- #END# Content -->