<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Detail Berkas Digital</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <a href="<?php echo base_url('berkas/digital'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>

                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DESKRIPSI</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Judul Berkas</th>
                                <td style="width: 1%;"> : </td>
                                <td><strong><?php echo strtoupper( $guides_list->title ); ?></strong></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><p><?php echo $guides_list->description; ?></p></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Berkas Digital</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <?php echo $guides_list->name; ?>.<?php echo $guides_list->extension; ?> - <a href="<?php echo base_url('unduh/'.$guides_list->uniquecode); ?>" class="font-bold col-cyan">Unduh disini</a>

                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Dibuat</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo date('d F Y H:i:s', strtotime($guides_list->datecreated)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
