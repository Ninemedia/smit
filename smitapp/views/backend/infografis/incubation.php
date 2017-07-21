<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Info Grafis Inkubasi</h2></div>
            <div class="body">
            
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
                        <div id="chart-incubation-month" style="height: 300px;">
            				<span class="data hide"><?php echo $chart; ?></span>
            			</div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="yearly">
                        <div id="chart-incubation-year" style="height: 300px;">
            				<span class="data-year hide"><?php echo $chart_year; ?></span>
            			</div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->