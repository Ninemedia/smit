<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Laporan Notulensi Pendampingan</h2></div>
            <div class="body">
                <?php if($is_admin): ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> PRA-INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">list</i> INKUBASI / TENANT
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        
                    </div>
                </div>
                <?php else : ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#list" data-toggle="tab">
                            <i class="material-icons">list</i> PRA-INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add" data-toggle="tab">
                            <i class="material-icons">list</i> INKUBASI / TENANT
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="list">
                        
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="add">
                        
                    </div>
                </div>
                <?php endif ?> 
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->