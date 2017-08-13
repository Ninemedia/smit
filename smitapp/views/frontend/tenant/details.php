<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_page2   = ( $this->uri->segment(2, 0) ? $this->uri->segment(2, 0) : '');
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
                        <a href="<?php echo base_url('tenant/daftartenant'); ?>">
                            <i class=""></i> Tenant
                        </a>
                    </li>
                    <li <?php echo ($active_page2 == 'detail' ? 'class="active"' : ''); ?>>
                        <i class=""></i> <strong>Detail Tenant</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-container table-responsive">
                    <table class="table table-striped table-hover" id="">
                        <thead>
                            <tr class="bg-blue-grey">
                                <td colspan="3" class="text-center"><strong>DETAIL</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <img class="tenant-detail-img" src="<?php echo BE_UPLOAD_PATH . 'incubationtenant/'.$tenantdata->uploader.'/'.$tenantdata->filename.'.'.$tenantdata->extension; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Nama Tenant</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_name" class="form-control" readonly="readonly" value="<?php echo $tenantdata->name; ?>"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Tahun Berdiri</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_year" class="form-control" readonly="readonly" value="<?php echo $tenantdata->year; ?>"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Alamat</th>
                                <td style="width: 1%;"> : </td>
                                <td><textarea id="list_address" class="form-control" readonly="readonly"><?php echo $tenantdata->address; ?></textarea></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Email</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_email" class="form-control" readonly="readonly" value="<?php echo $tenantdata->email; ?>"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kontak</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_phone" class="form-control" readonly="readonly" value="<?php echo $tenantdata->phone; ?>"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Bentuk Legalitas Usaha (PT/CV/Lainnya)</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_legal" class="form-control" readonly="readonly" value="<?php echo $tenantdata->legal; ?>"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Perizinan Usaha yang Dimiliki (SIUP/NPWP/Akte Notaris Pendirian)</th>
                                <td style="width: 1%;"> : </td>
                                <td><input type="text" id="list_licensing" class="form-control" readonly="readonly" value="<?php echo $tenantdata->licensing; ?>"></td>
                            </tr>
                            <tr>
                                <th style="width: 30%;">Kemitraan Usaha yang Dimiliki</th>
                                <td style="width: 1%;"> : </td>
                                <td><textarea id="list_partnerships" class="form-control" readonly="readonly"><?php echo $tenantdata->partnerships; ?></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>