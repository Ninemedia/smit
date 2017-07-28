<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Info Grafis Index Kepuasan Masyarakat</h2></div>
            <div class="body">
                <p align="justify">
                    Infografis mengenai jumlah pengukuran index kepuasan masyarakat
                </p>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#monthly" data-toggle="tab" class="tab_chart_ikm">
                            <i class="material-icons">donut_small</i> TAHUNAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#yearly" data-toggle="tab" class="tab_chart_ikm">
                            <i class="material-icons">donut_small</i> PER PERTANYAAN
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="monthly">
                        <?php if( !empty($stats) ) : ?>
                        <div id="chart-ikm" style="height: 300px;">
                            <span class="data hide"><?php echo $chart; ?></span>
                        </div>
                        <?php else : ?>
                            <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                        <?php endif; ?>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="yearly">
                        <?php if( !empty($stats_question) ) : ?>
                        <div id="chart-question" style="height: 300px;">
                            <span class="data-year hide"><?php echo $chart_question; ?></span>
                        </div>
                        <?php else : ?>
                            <div class="alert alert-info bottom0">Saat ini sedang tidak ada data chart. Silahkan update data terlebih dahulu.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
