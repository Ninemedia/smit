<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Detail Seleksi Inkubasi</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <a href="<?php echo base_url('seleksiinkubasi/daftar'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>     
                    <h4><?php echo $incubation->event_title; ?></h4>
                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DESKRIPSI</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Nama Peneliti Utama</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $incubation->name; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Judul Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $incubation->event_title; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $incubation->event_desc; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kategori</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $incubation->category; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Berkas Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php
                                        if( !empty($incubation_files) ){
                                            echo '<ul class="bottom0" style="padding-left:10px;">';
                                            foreach($incubation_files as $file){
                                                echo '<li>'.$file->filename.' - <a href="'.base_url('inkubasi/unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                            }
                                            echo '</ul>';
                                        }else{
                                            echo '<strong>Tidak ada berkas panduan</strong>';
                                        } 
                                    ?>
                                    
                                    
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tahun</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $incubation->year; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Daftar</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo date('d F Y H:i:s', strtotime($incubation->datecreated)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->