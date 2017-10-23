<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <a href="<?php echo base_url('monitoring_dokumen'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom20">
                    <i class="material-icons">arrow_back</i> Kembali
                </a>
                <h2>Detail Dokumen Tenant</h2>
            </div>
            <div class="body">
                <div class="table-container table-responsive">
                    <!-- <a href="<?php echo base_url('tenants/pembayaran'); ?>" class="btn btn-sm btn-default waves-effect back pull-right bottom25"><i class="material-icons">arrow_back</i> Kembali</a> -->

                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DESKRIPSI</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 30%;">Nomor Dokumen</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo $paymentdata->invoice; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Judul Dokumen</th>
                                <td style="width: 1%;"> : </td>
                                <td><strong><?php echo strtoupper( $paymentdata->title ); ?></strong></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Nama Tenant</th>
                                <td style="width: 1%;"> : </td>
                                <td><strong><?php echo strtoupper( $paymentdata->name ); ?></strong></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Deskripsi Kegiatan</th>
                                <td style="width: 1%;"> : </td>
                                <td><p><?php echo $paymentdata->desc; ?></p></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tanggal Dokumen</th>
                                <td style="width: 1%;"> : </td>
                                <td><?php echo date('d F Y H:i:s', strtotime($paymentdata->datecreated)); ?></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Berkas Dokumen</th>
                                <td style="width: 1%;"> : </td>
                                <td>
                                    <div class="details-img">
                                        <img class="js-animating-object img-responsive" src="<?php echo $payment_image; ?>" alt=""/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
