<!-- Modal View -->
<div id="modal-view-url" data-url="<?php echo base_url('lihatsurat'); ?>"></div>
<div class="modal fade" id="view_mail_template" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-default waves-effect pull-right" data-dismiss="modal"><i class="material-icons">close</i></button>
                <h4 class="modal-title">Format Email Notifikasi Pendaftaran Anggota</h4>
            </div>
            <div class="modal-body" id="view-mail-content">
                <!-- Content will be placed here -->
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Backend</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#general" data-toggle="tab">
                            <i class="material-icons">home</i> GENERAL
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#registration_email" data-toggle="tab">
                            <i class="material-icons">style</i> SURAT KONFIRMASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#notification_praincubation" data-toggle="tab">
                            <i class="material-icons">people</i> PRA-INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#notification_incubation" data-toggle="tab">
                            <i class="material-icons">people</i> INKUBASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#other" data-toggle="tab">
                            <i class="material-icons">cast_connected</i> LAINNYA
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="general">
                        <?php $this->load->view(VIEW_BACK . 'setting/backendsetting/general'); ?>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="registration_email">
                        <?php $this->load->view(VIEW_BACK . 'setting/backendsetting/registrationnotification'); ?>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="notification_praincubation">
                        <?php $this->load->view(VIEW_BACK . 'setting/backendsetting/notificationpraincubation'); ?>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="notification_incubation">
                        <?php $this->load->view(VIEW_BACK . 'setting/backendsetting/notificationincubation'); ?>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="other">
                        <?php $this->load->view(VIEW_BACK . 'setting/backendsetting/other'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->