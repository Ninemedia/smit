<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Detail Pra Inkubasi</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <?php if( !empty($is_pendamping) ) : ?>                     
                    <a href="<?php echo base_url('prainkubasi/pendampingan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>
                    <?php else : ?>
                    <a href="<?php echo base_url('prainkubasi/daftar'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>
                    <?php endif; ?>          
                    <h4><?php echo $praincubation->event_title; ?></h4>
                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DESKRIPSI</strong></td>
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
                                <td><strong><?php echo strtoupper( $praincubation->event_title ); ?></strong></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><p><?php echo $praincubation->event_desc; ?></p></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kategori</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo strtoupper( $praincubation->category ); ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Berkas Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php
                                        if( !empty($praincubation_files) ){
                                            echo '<ul class="bottom0" style="padding-left:10px;">';
                                            foreach($praincubation_files as $file){
                                                echo '<li>'.$file->filename.' - <a href="'.base_url('prainkubasi/unduh/'.$file->uniquecode).'" class="font-bold col-cyan">Unduh disini</a></li>';
                                            }
                                            echo '</ul>';
                                        }else{
                                            echo '<strong>Tidak ada berkas proposal yang di unggah oleh Pengusul ini</strong>';
                                        } 
                                    ?>
                                    
                                    
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tahun</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $praincubation->year; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Usulan</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo date('d F Y H:i:s', strtotime($praincubation->datecreated)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->