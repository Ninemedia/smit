<!-- Content -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Pengaturan Frontend</h2></div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#history" data-toggle="tab">
                            <i class="material-icons">home</i> GENERAL
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#vision" data-toggle="tab">
                            <i class="material-icons">style</i> EMAIL PENDAFTARAN
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#structur" data-toggle="tab">
                            <i class="material-icons">people</i> FORMAT EMAIL & NOTIFIKASI
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#settings_with_icon_title" data-toggle="tab">
                            <i class="material-icons">view_comfy</i> INKUBASI DAN ALIH TEKNOLOGI
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="history">
                        <!-- Multiple Items To Be Open -->
                        <div class="panel-group" id="accordion_19" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_user">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapse_user" aria-expanded="true" aria-controls="collapse_user">
                                            <i class="material-icons">format_align_justify</i> Text Dashboard Pengguna / Pengusul
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_user" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_user">
                                    <form class="horizontal-form" action="#" novalidate="novalidate">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <textarea class="form-control ckeditor" id="be_dashboard_user"><?php echo get_option('be_dashboard_user'); ?></textarea>
                                            </div>
                                            <button class="btn btn-success waves-effect" id="btn_be_dashboard_user" type="button" data-url="<?php echo base_url('backend/updatesettingbackend'); ?>">Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_juri">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_juri" aria-expanded="false" aria-controls="collapse_juri">
                                            <i class="material-icons">format_align_justify</i> Text Dashboard Juri
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_juri" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_juri">
                                    <form class="horizontal-form" action="#" novalidate="novalidate">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <textarea class="form-control ckeditor" id="be_dashboard_juri"><?php echo get_option('be_dashboard_juri'); ?></textarea>
                                            </div>
                                            <button class="btn btn-success waves-effect" type="button">Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_pendamping">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_pendamping" aria-expanded="false" aria-controls="collapse_pendamping">
                                            <i class="material-icons">format_align_justify</i> Text Dashboard Pendamping
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_pendamping" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_pendamping">
                                    <form class="horizontal-form" action="#" novalidate="novalidate">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <textarea class="form-control ckeditor" id="be_dashboard_pendamping"><?php echo get_option('be_dashboard_pendamping'); ?></textarea>
                                            </div>
                                            <button class="btn btn-success waves-effect" type="button">Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_tenant">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_tenant" aria-expanded="false" aria-controls="collapse_tenant">
                                            <i class="material-icons">format_align_justify</i> Text Dashboard Tenant
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_tenant" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_tenant">
                                    <form class="horizontal-form" action="#" novalidate="novalidate">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <textarea class="form-control ckeditor" id="be_dashboard_tenant"><?php echo get_option('be_dashboard_tenant'); ?></textarea>
                                            </div>
                                            <button class="btn btn-success waves-effect" type="button">Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="heading_pelaksana">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse_pelaksana" aria-expanded="false" aria-controls="collapse_pelaksana">
                                            <i class="material-icons">format_align_justify</i> Text Dashboard Pelaksana
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_pelaksana" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_pelaksana">
                                    <form class="horizontal-form" action="#" novalidate="novalidate">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <textarea class="form-control ckeditor" id="be_dashboard_pelasana"><?php echo get_option('be_dashboard_pelaksana'); ?></textarea>
                                            </div>
                                            <button class="btn btn-success waves-effect" type="button">Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- #END# Multiple Items To Be Open -->
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="vision">
                        <!-- Multiple Items To Be Open -->
                        <div class="panel-group" id="accordion_19" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="headingOne_19">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                            <i class="material-icons">perm_contact_calendar</i> Collapsible Group
                                            Item #1
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                        raw denim aesthetic synth nesciunt you probably haven't heard of them
                                        accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="headingTwo_19">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseTwo_19" aria-expanded="false" aria-controls="collapseTwo_19">
                                            <i class="material-icons">cloud_download</i> Collapsible Group Item
                                            #2
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo_19" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_19">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                        raw denim aesthetic synth nesciunt you probably haven't heard of them
                                        accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="headingThree_19">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
                                            <i class="material-icons">contact_phone</i> Collapsible Group Item
                                            #3
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_19" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_19">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                        raw denim aesthetic synth nesciunt you probably haven't heard of them
                                        accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-col-blue">
                                <div class="panel-heading" role="tab" id="headingFour_19">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapseFour_19" aria-expanded="false" aria-controls="collapseFour_19">
                                            <i class="material-icons">folder_shared</i> Collapsible Group Item
                                            #4
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour_19" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour_19">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                                        non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                        helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                        Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                                        raw denim aesthetic synth nesciunt you probably haven't heard of them
                                        accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- #END# Multiple Items To Be Open -->
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="structur">
                        <b>Struktur Organisasi</b>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                        <b>Inkubasi dan Alih Teknologi</b>
                        <p>
                            Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                            Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                            pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                            sadipscing mel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Content -->