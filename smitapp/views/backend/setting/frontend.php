<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Frontend</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#profil" data-toggle="tab">
                            <i class="material-icons">home</i> PROFIL
                        </a>
                    </li>
                    <!--
                    <li role="presentation">
                        <a href="#task" data-toggle="tab">
                            <i class="material-icons">style</i> TUGAS
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#function" data-toggle="tab">
                            <i class="material-icons">people</i> FUNGSI
                        </a>
                    </li>
                    -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="profil">
                        <?php $this->load->view(VIEW_BACK . 'setting/frontendsetting/profil'); ?>
                    </div>
                    <!--
                    <div role="tabpanel" class="tab-pane fade" id="task">
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="function">
                        
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->