<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Data Perusahaan</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#business" data-toggle="tab">
                            <i class="material-icons">store_mall_directory</i> USAHA & PERUSAHAAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#team" data-toggle="tab">
                            <i class="material-icons">people</i> TIM
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#contact" data-toggle="tab">
                            <i class="material-icons">contacts</i> KONTAK
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="business">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p>Silahkan lengkapi isian data perusahaan anda</p>
                                <div class="alert alert-info">
                                    <strong>Perhatian!</strong>
                                    File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php echo form_open_multipart( '', array( 'id'=>'guide_files', 'role'=>'form' ) ); ?>
                                <label for="name_contact">Foto</label>
                                <div class="form-group">
                                    <label>Berkas Panduan</label>
                                    <input id="avatar_company" name="avatar_company" class="form-control" type="file" />
                                </div>
                                <button class="btn btn-block btn-lg bg-blue waves-effect" type="submit">UPLOAD</button>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="col-md-8">
                                <?php echo form_open( 'backend/addcompany', array( 'id'=>'addcompany', 'role'=>'form', 'enctype'=>'multipart/form-data' ) ); ?>
                                <label for="name_contact">Nama Perusahaan</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_name','',array('class'=>'form-control company_name','placeholder'=>'Nama Perusahaan Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="name_contact">Tahun Berdiri</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_year','',array('class'=>'form-control company_year','placeholder'=>'Tahun Berdiri Perusahaan Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="name_contact">Alamat Perusahaan</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_address','',array('class'=>'form-control company_address','placeholder'=>'Alamat','required'=>'required')); ?>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <select class="form-control show-tick" name="province" id="province-select" data-url="<?php echo base_url('selectprovince'); ?>">
        	                        	<?php
                                            $province = smit_provinces();
                                            echo '<option value="">-- Pilih Propinsi --</option>';
                                            if( !empty($province) ){
                                                foreach($province as $p){
                                                    echo '<option value="'.$p->province_id.'">'.$p->province_name.'</option>';
                                                }
                                            }
                                        ?>  
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <select class="form-control show-tick" name="regional" id="regional-select" disabled="disabled">
                                        <option value="">-- Pilih Kota/Kabupaten --</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">place</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_district','',array('class'=>'form-control company_district','placeholder'=>'Kecamatan/Kelurahan')); ?>
                                    </div>
                                </div>
                                
                                <label for="email_contact">Email Perusahaan</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_email','',array('class'=>'form-control company_email','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Telp Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_phone_contact','',array('class'=>'form-control mobile-phone-number','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="name_contact">Bentuk Legalitas Usaha (PT/CV/Lainnya)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_legal','',array('class'=>'form-control company_legal','placeholder'=>'Legalitas Usaha Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('company_bussiness','',array('class'=>'form-control company_bussiness','placeholder'=>'SIUP/NPWP/Akte Notaris Pendirian','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Kemitraan Usaha yang Dimiliki</label>
                                <div class="form-group">
                                    <textarea class="form-control ckeditor" id="company_mitra" name="company_mitra" ></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="team">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p>Silahkan lengkapi isian data perusahaan anda</p>
                                <div class="alert alert-info">
                                    <strong>Perhatian!</strong>
                                    File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="name_contact">Foto Tim</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="name_contact">Nama Anggota</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                        <label for="name_contact">Jabatan/Posisi/Peran</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="material-icons">person</i></span>
                                            <div class="form-line">
                                                <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="contact">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <p>Silahkan lengkapi isian data perusahaan anda</p>
                                <div class="alert alert-info">
                                    <strong>Perhatian!</strong>
                                    File gambar/foto yang anda unggah harus berdimensi lebih kecil dari 3000 x 3000 pixel. Ukuran dan format file juga harus memenuhi masing-masing batasan.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="name_contact">Foto</label>
                            </div>
                            <div class="col-md-8">
                                <label for="name_contact">Nama Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('name_contact','',array('class'=>'form-control name-contact','placeholder'=>'Nama Kontak Anda','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="telp_contact">Telp Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('phone_contact','',array('class'=>'form-control mobile-phone-number','placeholder'=>'No. HP/Telepon','required'=>'required')); ?>
                                    </div>
                                </div>
                                <label for="email_contact">Email Kontak</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                    <div class="form-line">
                                        <?php echo form_input('email_contact','',array('class'=>'form-control','placeholder'=>'Email','required'=>'required','autocomplete'=>'off')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->