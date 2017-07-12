<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.html">
                <img src="<?php echo BE_IMG_PATH . 'logo/favicon_backup.png'; ?>" />
               <!-- <?php echo strtoupper(COMPANY_NAME); ?> --> SISTEM INKUBASI TEKNOLOGI PUSAT INOVASI LIPI
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li>
                    <div class="user-helper-dropdown">
                        <div class="profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo $user->name; ?> <i class="material-icons">keyboard_arrow_down</i>
                        </div>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url('pengguna/profil'); ?>"><i class="material-icons">person</i>Profil</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo base_url('logout'); ?>"><i class="material-icons">input</i>Keluar</a></li>
                        </ul>
                    </div>
                </li>
                <!-- #END# Call Search -->
                
                <!-- Notification List -->
                <!-- Put Here -->
                <!-- #END# Notification List -->         
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->