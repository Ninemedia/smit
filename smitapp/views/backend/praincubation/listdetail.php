<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Detail Seleksi Pra Inkubasi</h2></div>
            <div class="body">
                <h4><?php echo $praincubation->event_title; ?></h4>
                <div class="table-container table-responsive">
                    <div class="table-wrapper pull-right bottom25">                        
                        <a href="<?php echo base_url('prainkubasi/daftar'); ?>" class="btn btn-sm btn-success waves-effect back">Kembali</a>     
                    </div>
                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="2" style="width: 30%;"><strong></strong></td>
                                <td><strong>DESKRIPSI</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Nama Pengusul</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $praincubation->name; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Judul Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $praincubation->event_title; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $praincubation->event_desc; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kategori</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $praincubation->category; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Berkas Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php
                                        if( !empty($praincubation_files) ){
                                            echo '<ul class="bottom40">';
                                            foreach($praincubation_files as $file){
                                                echo '<li>'.$file->filename.' - <a href="'.base_url('prainkubasi/unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                            }
                                            echo '</ul>';
                                        }else{
                                            echo '<strong>Tidak ada berkas panduan</strong>';
                                        } 
                                    ?>
                                    
                                    
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Usulan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $praincubation->datecreated; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->