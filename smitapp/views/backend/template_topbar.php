<?php
    $current_user = smit_get_current_user();
    $status         = $current_user->type;
    if($status == ADMINISTRATOR){
        $bg     = 'bg-blue';
    }elseif($status == PENGUSUL){
        $bg     = 'bg-red';
    }elseif($status == PENDAMPING){
        $bg     = 'bg-green';
    }elseif($status == JURI){
        $bg     = 'bg-orange';
    }elseif($status == TENANT){
        $bg     = 'bg-purple';
    }elseif($status == PELAKSANA){
        $bg     = 'bg-teal';
    }elseif($status == PELAKSANA_TENANT){
        $bg     = 'bg-deep-orange';
    }else{
        $bg     = 'bg-blue';
    }
?>

<!-- Top Bar -->
<nav class="navbar <?php echo $bg; ?>">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="<?php echo base_url('beranda'); ?>">
                <img src="<?php echo BE_IMG_PATH . 'logo/logo-image.jpg'; ?>" class="lipi" />
                <!-- <?php echo strtoupper(COMPANY_NAME); ?> --> SISTEM INKUBASI TEKNOLOGI PUSAT INOVASI LIPI
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- User Role -->
                <?php
                    $cfg_usertype   = config_item('user_type');
                    $current_roles  = $current_user->role;
                    $current_roles  = maybe_unserialize($current_roles);
                ?>
                <?php if( $current_user->id != 1 && !empty($current_roles)) : ?>
                <li>
                    <div class="user-helper-dropdown">
                        <div class="profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            TIPE PENGGUNA <i class="material-icons">keyboard_arrow_down</i>
                        </div>
                        <ul class="dropdown-menu pull-right">
                            <?php
                                $roles          = explode(',',$current_roles);
                                $roles_count    = count($roles);
                                $i=0;
                                foreach($roles as $key => $type){
                                    if( $type == ADMINISTRATOR )        { $roletxt = 'Administrator';; }
                                    elseif( $type == PENDAMPING )       { $roletxt = 'Pendamping';; }
                                    elseif( $type == TENANT )           { $roletxt = 'Tenant';; }
                                    elseif( $type == JURI )             { $roletxt = 'Juri';; }
                                    elseif( $type == PENGUSUL )         { $roletxt = 'Pengusul';; }
                                    elseif( $type == PELAKSANA )        { $roletxt = 'Pelaksana';; }
                                    elseif( $type == PELAKSANA_TENANT ) { $roletxt = 'Pelaksana &amp; Tenant';; }

                                    echo '<li><a class="btn-role" data-url="'.base_url('gantirole').'" data-role="'.$type.'" >'.$roletxt.'</a></li>';
                                    if($roles_count > 1 && $i != $roles_count){
                                        echo '<li role="seperator" class="divider"></li>';
                                    }
                                    $i++;
                                }
                            ?>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>
                <!-- #END# User Role -->
                <!-- User Menu -->
                <li>
                    <div class="user-helper-dropdown">
                        <div class="profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo $user->name; ?> <i class="material-icons">keyboard_arrow_down</i>
                        </div>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url(); ?>" target="_blank"><i class="material-icons">home</i>Halaman Depan</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo base_url('pengguna/profil'); ?>"><i class="material-icons">person</i>Profil</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo base_url('logout'); ?>"><i class="material-icons">input</i>Keluar</a></li>
                        </ul>
                    </div>
                </li>
                <!-- #END# User Menu -->

                <!-- Notification List -->
                <!-- Put Here -->
                <!-- #END# Notification List -->
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
