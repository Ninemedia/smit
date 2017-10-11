<?php
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
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
                    <li <?php echo ($active_page == 'infografis' ? 'class="active"' : ''); ?>>
                        <a href="<?php echo base_url('infografis'); ?>">
                            <i class=""></i> <strong>Info Grafis</strong>
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
				<h3>Info Grafis</h3>
			</div>
			<div class="col-md-12">
                <div class="panel-body">
                    <div class="panel-group" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="heading_detail">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_incubation" aria-expanded="true" aria-controls="collapse_incubation">
                                        <i class="material-icons">format_align_justify</i> Detail Data
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_detail" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_detail">
                                <div class="panel-body">
                                    <p align="justify">
                                        Infografis mengenai kegiatan seleksi
                                    </p>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#detail" data-toggle="tab" class="tab_chart_detail">
                                                <i class="material-icons">donut_small</i> DETAIL
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#instantion" data-toggle="tab" class="tab_chart_instantion">
                                                <i class="material-icons">donut_small</i> INSTANSI PENDAFTAR
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#category" data-toggle="tab" class="tab_chart_category">
                                                <i class="material-icons">donut_small</i> KATEGORI USULAN
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#bidang" data-toggle="tab" class="tab_chart_bidang">
                                                <i class="material-icons">donut_small</i> BIDANG USULAN
                                            </a>
                                        </li>
                                    </ul>
                    
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="detail">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                    <div class="table-container table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                        						<tr role="row" class="heading bg-blue">
                                                                    <th class="width50 text-center">Tahun Seleksi</th>
                                                                    <th class="width50 text-center">Pendaftar Seleksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size: 24px !important; "><strong></strong></td>
                                                                    <td style="font-size: 24px !important; "><strong></strong></td>
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
                                                                    <th class="width25 text-center">Proposal Dikirim</th>
                                                                    <th class="width25 text-center">Proposal Lolos Tahap 2</th>
                                                                    <th class="width25 text-center">Proposal Dipanggil</th>
                                                                    <th class="width25 text-center">Proposal Dibiayai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size: 24px !important; "><strong></strong></td>
                                                                    <td style="font-size: 24px !important; "><strong></strong></td>
                                                                    <td style="font-size: 24px !important; "><strong></strong></td>
                                                                    <td style="font-size: 24px !important; "><strong></strong></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                
                                                <hr />
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="instantion">
                                            <?php if( !empty($stats_incubation_monthly) ) : ?>
                                            <div id="chart-incubation-monthly" style="height: 300px;">
                                				<span class="data-incubation-monthly hide"><?php echo $chart_incubation_monthly; ?></span>
                                			</div>
                                            <?php else : ?>
                                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                                            <?php endif; ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="category">
                                            <?php if( !empty($stats_incubation_monthly) ) : ?>
                                            <div id="chart-incubation-monthly" style="height: 300px;">
                                				<span class="data-incubation-monthly hide"><?php echo $chart_incubation_monthly; ?></span>
                                			</div>
                                            <?php else : ?>
                                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                                            <?php endif; ?>
                                        </div>
                    
                                        <div role="tabpanel" class="tab-pane fade" id="bidang">
                                            <?php if( !empty($stats_incubation_yearly) ) : ?>
                                            <div id="chart-incubation-yearly" style="height: 300px;">
                                				<span class="data-incubation-yearly hide"><?php echo $chart_incubation_yearly; ?></span>
                                			</div>
                                            <?php else : ?>
                                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="heading_praincubation">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_praincubation" aria-expanded="true" aria-controls="collapse_praincubation">
                                        <i class="material-icons">format_align_justify</i> Pra-Inkubasi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_praincubation" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_praincubation">
                                <div class="panel-body">
                                    <p align="justify">
                                        Infografis mengenai jumlah kegiatan Pra-Inkubasi per-tahun sesuai dengan kategori
                                    </p>
                                    <?php if( !empty($stats_praincubation) ) : ?>
                                    <div id="chart-praincubation-yearly" style="height: 300px;">
                        				<span class="data-praincubation-yearly hide"><?php echo $chart_praincubation; ?></span>
                        			</div>
                                    <?php else : ?>
                                        <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="heading_incubation">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_incubation" aria-expanded="true" aria-controls="collapse_incubation">
                                        <i class="material-icons">format_align_justify</i> Inkubasi / Tenant
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_incubation" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_incubation">
                                <div class="panel-body">
                                    <p align="justify">
                                        Infografis mengenai kegiatan inkubasi per-bulan dan per-tahun
                                    </p>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#monthly" data-toggle="tab" class="tab_chart_incubation">
                                                <i class="material-icons">donut_small</i> BULANAN
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#yearly" data-toggle="tab" class="tab_chart_incubation">
                                                <i class="material-icons">donut_small</i> TAHUNAN
                                            </a>
                                        </li>
                                    </ul>
                    
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="monthly">
                                            <?php if( !empty($stats_incubation_monthly) ) : ?>
                                            <div id="chart-incubation-monthly" style="height: 300px;">
                                				<span class="data-incubation-monthly hide"><?php echo $chart_incubation_monthly; ?></span>
                                			</div>
                                            <?php else : ?>
                                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                                            <?php endif; ?>
                                        </div>
                    
                                        <div role="tabpanel" class="tab-pane fade" id="yearly">
                                            <?php if( !empty($stats_incubation_yearly) ) : ?>
                                            <div id="chart-incubation-yearly" style="height: 300px;">
                                				<span class="data-incubation-yearly hide"><?php echo $chart_incubation_yearly; ?></span>
                                			</div>
                                            <?php else : ?>
                                                <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="panel panel-col-blue">
                            <div class="panel-heading" role="tab" id="heading_ikm">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_ikm" aria-expanded="true" aria-controls="collapse_ikm">
                                        <i class="material-icons">format_align_justify</i> Index Kepuasan Masyarakat
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_ikm" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_ikm">
                                <div class="panel-body">

                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
