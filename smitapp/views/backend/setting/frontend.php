<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Frontend</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" data-toggle="tab">
                            <i class="material-icons">style</i> General
                        </a>
                    </li>
                    
                    <li role="presentation">
                        <a href="#home" data-toggle="tab">
                            <i class="material-icons">home</i> Beranda
                        </a>
                    </li>
                    
                    <li role="presentation">
                        <a href="#profil" data-toggle="tab">
                            <i class="material-icons">people</i> Profil
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="general">
                        <?php $this->load->view(VIEW_BACK . 'setting/frontendsetting/general'); ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="home">
                        <?php $this->load->view(VIEW_BACK . 'setting/frontendsetting/home'); ?>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profil">
                        <?php $this->load->view(VIEW_BACK . 'setting/frontendsetting/profil'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->