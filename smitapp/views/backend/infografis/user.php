<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Info Grafis Pengguna</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#year" data-toggle="tab">
                            <i class="material-icons">donut_small</i> BULANAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#month" data-toggle="tab">
                            <i class="material-icons">donut_small</i> TAHUNAN
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="year">
                        <div id="chart-user" style="height: 300px;">
            				<span class="data hide"><?php echo $chart; ?></span>
            			</div>
                    </div><s></s>

                    <div role="tabpanel" class="tab-pane fade" id="month">
                        <div id="chart-user" style="height: 300px;">
            				<span class="data hide"><?php echo $chart; ?></span>
            			</div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->
