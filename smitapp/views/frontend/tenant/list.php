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
                    <li <?php echo ($active_page2 == 'daftar' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('tenant/daftartenant'); ?>">
                            <i class=""></i> <strong>Daftar Tenant</strong>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="gtco-content" class="gtco-section border-bottom animate-box">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 text-center gtco-heading">
				<h3>Daftar Tenant</h3>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header">
                    <h4>

                    </h4>
                </div>
                <div class="body">
                    <div class="table-container table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="list_tenant" data-url="<?php echo base_url('tenant/daftartenantdata'); ?>">
                            <thead>
                                <tr role="row" class="heading bg-blue">
                                    <th class="width5">No</th>
                                    <th class="width15">Pengguna</th>
                                    <th class="width20">Judul Usulan</th>
                                    <th class="width10 text-center">Nama Tenant</th>
                                    <th class="width10 text-center">Email</th>
                                    <th class="width10 text-center">Telp</th>
                                    <th class="width10 text-center">Actions<br /></th>
                                </tr>
                                <tr role="row" class="filter table-filter">
                                    <td></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_event" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_name_tenant" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_email" /></td>
                                    <td><input type="text" class="form-control form-filter input-sm text-uppercase" name="search_phone" /></td>
                                    <td style="text-align: center;">
                                        <button class="btn bg-blue waves-effect filter-submit bottom5-min" id="btn_tenant_list">Search</button>
                                        <button class="btn bg-red waves-effect filter-cancel">Reset</button>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data Will Be Placed Here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
