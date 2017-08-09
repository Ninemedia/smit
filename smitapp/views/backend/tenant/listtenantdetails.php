<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Detail Tenant</h2></div>
            <div class="body">
                <div class="table-container table-responsive">
                    <?php if( !empty($is_pendamping) ) : ?>                     
                    <a href="<?php echo base_url('tenants/pendampingan'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>
                    <?php else : ?>
                    <a href="<?php echo base_url('tenants/daftar'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a>
                    <?php endif; ?>          
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
                                <td><strong><?php echo strtoupper( $incubation->event_title ); ?></strong></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><p><?php echo $incubation->event_desc; ?></p></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kategori</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo strtoupper( $incubation->category ); ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tahun</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $incubation->year; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Usulan</th>
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