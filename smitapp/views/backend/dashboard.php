<?php 
    $time   = date('H');
    $hi     = '';
    $status = '';
	$name	= $user->name;
    
    if( $time > '00' && $time <= '09'  )        { $hi = 'Pagi'; }
    elseif( $time > '09' && $time <= '14'  )    { $hi = 'Siang'; }
    elseif( $time > '14' && $time <= '18'  )    { $hi = 'Sore'; }
    elseif( $time > '18' && $time <= '24'  )    { $hi = 'Malam'; }
    
    if( $is_admin ){
        $status = 'ADMINISTRATOR';
    }else{
        if( $user->type == 2 ){
            $status = 'PENDAMPING';
        }elseif( $user->type == 3 ){
            $status = 'TENANT';
        }elseif( $user->type == 4 ){
            $status = 'JURI';
        }elseif( $user->type == 5 ){
            $status = 'PENGUSUL';
        }else{
            $status = 'PELAKSANA';
        }
    }
?>

<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
                <div class="text">NEW TASKS</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">help</i>
            </div>
            <div class="content">
                <div class="text">NEW TICKETS</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">forum</i>
            </div>
            <div class="content">
                <div class="text">NEW COMMENTS</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">person_add</i>
            </div>
            <div class="content">
                <div class="text">NEW VISITORS</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->

<!-- Welcome Text -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header"><h2>Selamat <?php echo $hi . ' <strong>' . strtoupper($name) . '</strong>'; ?></h2></div>
            <div class="body bg-light-green">
                <p>Selamat datang di Sistem Informasi <a href="<?php echo base_url(); ?>"><strong><?php echo get_option('company_name'); ?></strong></a></p>
                <p>Status Anda saat ini <strong><?php echo $status; ?></strong></p>
            </div>
            
            <?php if( as_pendamping($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_pendamping'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_pendamping'); ?>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>
            
            <?php if( as_juri($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_juri'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_juri'); ?>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>
            
            <?php if( as_tenant($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_tenant'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_tenant'); ?>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?> 
            
            <?php if( as_pengusul($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_user'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_user'); ?>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>
            
            <?php if( as_pelaksana($user) ): ?>
                <!-- Content Dasboard-->
                <?php $dashboard_text = get_option('be_dashboard_pelaksana'); ?>
                <?php if( !empty( $dashboard_text ) ): ?>
                    <div class="body">
                        <?php echo get_option('be_dashboard_pelaksana'); ?>
                    </div>
                <?php endif ?>
            	<!-- End Content Dashboard-->
            <?php endif ?>    
            
        </div>
    </div>
</div>
<!-- #END# Welcome Text -->

  