<!-- Content -->
<?php
    $user_newest    = $this->Model_User->get_user_newest();
    $count_all      = $this->Model_User->count_all();
    $count_all      = $count_all - 1;
    $non            = $this->Model_User->count_user(NONACTIVE);
    $active         = $this->Model_User->count_all_user(ACTIVE);
    $active         = $active -1;
    $banned         = $this->Model_User->count_all_user(BANNED);
    $deleted        = $this->Model_User->count_all_user(DELETED);
    
    if($non < 0 || $active < 0 || $banned < 0 || $deleted < 0){
        $non        = 0;
        $active     = 0;
        $banned     = 0;
        $deleted    = 0;
    }
    
    $pengusul       = $this->Model_User->count_all('all', PENGUSUL);
    $pelaksana      = $this->Model_User->count_all('all', PELAKSANA);
    $tenant         = $this->Model_User->count_all('all', TENANT);
    $pelaksanatenant= $this->Model_User->count_all('all', PELAKSANA_TENANT);
    $juri           = $this->Model_User->count_all('all', JURI);
    $pendamping     = $this->Model_User->count_all('all', PENDAMPING);
?>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Info Pengguna</h2></div>
            <div class="body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width50 text-center">Pengguna Terbaru</th>
                                        <th class="width50 text-center">Total Pengguna</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 24px !important; "><strong><?php echo ( $user_newest->type == 1 ? '-' : smit_center($user_newest->name) ); ?></strong></td>
                                        <td style="font-size: 24px !important; "><strong><?php echo smit_center($count_all); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width25 text-center">Pengguna Tidak Aktif</th>
                                        <th class="width25 text-center">Pengguna Aktif</th>
                                        <th class="width25 text-center">Pengguna Banned</th>
                                        <th class="width25 text-center">Pengguna Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($non); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($active); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($banned); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($deleted); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="table-container table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
            						<tr role="row" class="heading bg-blue">
                                        <th class="width15 text-center">Pengusul</th>
                                        <th class="width15 text-center">Pelaksana</th>
                                        <th class="width15 text-center">Tenant</th>
                                        <th class="width15 text-center">Pelaksana & Tenant</th>
                                        <th class="width15 text-center">Pendamping</th>
                                        <th class="width15 text-center">Juri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($pengusul); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($pelaksana); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($tenant); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($pelaksanatenant); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($pendamping); ?></strong></td>
                                        <td style="font-size: 28px !important; "><strong><?php echo smit_center($juri); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
