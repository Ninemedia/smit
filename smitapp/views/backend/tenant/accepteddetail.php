<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Detail Inkubasi / Tenant</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <a href="<?php echo base_url('tenants/pendampingan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>
                    <h4><?php echo $tenant->event_title; ?></h4>
                    <table class="table table-striped table-hover" style="margin-bottom: 50px !important;">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DESKRIPSI</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Nama Tenant</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $tenant->name; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Judul Usulan Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php 
                                        $event_title    = $tenant->event_title;
                                        if( empty($event_title) ){
                                            $event_title= "<span style='color : red;'>Tidak Ada Data</span>";
                                        }
                                        echo $event_title; 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php
                                        $event_desc     = $tenant->event_desc;
                                        if( empty($event_desc) ){
                                            $event_desc = "<span style='color : red;'>Tidak Ada Data</span>";
                                        }
                                        echo $event_desc; 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kategori</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php 
                                        $category       = strtoupper($tenant->category);
                                        if( empty($category) ){
                                            $category   = "<span style='color : red;'>Tidak Ada Data</span>";
                                        }
                                        echo $category; 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Usulan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo date('d F Y H:i:s', strtotime($tenant->datecreated)); ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;" class="text-middle">Status</th>
                                <td style="width: 1%;" class="text-middle"> : </td>
                                <td><strong><h4 class="bottom5 top0"><span class="label label-primary">DITERIMA</span></h4></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <?php echo form_open_multipart( current_url(), array( 'id'=>'companion_assignment', 'role'=>'form' ) ); ?>
                    <?php if( $this->session->flashdata('message') ){?>
                        <?php echo $this->session->flashdata('message'); ?>
                    <?php }?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="bg-teal">
                                <td colspan="3" class="text-center"><strong>PENETAPAN PENDAMPING</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <p><strong>Informasi ! </strong>Jika Pendamping tidak ditemukan, silahkan admin memasukan atau menambahkan pendamping terlebih dahulu <a href="<?php echo base_url('pengguna/tambah'); ?>">disini</a></p>
                            <tr>
                                <th style="width: 30%;" class="text-middle">Pendamping</th>
                                <td style="width: 1%;" class="text-middle"> : </td>
                                <td>
                                    <?php
                                        $option = array(''=>'Pilih Pendamping');
                                        $companion_arr = smit_companion_list();
                                        $extra = 'class="form-control def" id="companion_id"';
                
                                        if( $companion_arr || !empty($companion_arr) ){
                                            foreach($companion_arr as $val){
                                                $option[$val->id] = $val->name;
                                            }
                                        }                                        
                                        echo form_dropdown('companion_id',$option,'',$extra);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;" class="text-middle"></th>
                                <td style="width: 1%;" class="text-middle"></td>
                                <td>
                                    <button class="btn btn-primary waves-effect" type="submit">Simpan</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->