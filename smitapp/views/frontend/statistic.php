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
                            <div class="panel-heading" role="tab" id="heading_praincubation">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse_praincubation" aria-expanded="true" aria-controls="collapse_praincubation">
                                        <i class="material-icons">format_align_justify</i> Pra-Inkubasi
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_praincubation" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_praincubation">
                                <div class="panel-body">

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

                                </div>
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
