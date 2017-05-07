<?php
    // Set menu array
    $menu_arr = array(
        array (
            'title'     => 'Beranda',
            'nav'       => 'beranda',
            'parent'    => false,
            'link'      => base_url('beranda'),
            'icon'      => 'home',
            'sub'       => false,
	    ),
        array (
            'title'     => 'Pengguna',
            'nav'       => 'pengguna',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'people',
            'sub'       => array(
                array (
                    'title'     => 'Daftar Pengguna',
                    'nav'       => 'pengguna/daftar',
                    'parent'    => 'pengguna',
                    'link'      => base_url('pengguna/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Tambah Pengguna',
                    'nav'       => 'pengguna/tambah',
                    'parent'    => 'pengguna',
                    'link'      => base_url('pengguna/tambah'),
                    'icon'      => 'person_add',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Data Perusahaan',
            'nav'       => 'company',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'location_city',
            'sub'       => array(
                array (
                    'title'     => 'Daftar Perusahaan',
                    'nav'       => 'company/list',
                    'parent'    => 'company',
                    'link'      => base_url('company/list'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Detail Perusahaan',
                    'nav'       => 'company/detail',
                    'parent'    => 'company',
                    'link'      => base_url('company/detail'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Pengaturan Perusahaan',
                    'nav'       => 'company/setting',
                    'parent'    => 'company',
                    'link'      => base_url('company/setting'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Pra Inkubasi',
            'nav'       => 'prainkubasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'wb_incandescent',
            'sub'       => array(
                array (
                    'title'     => 'Daftar Seleksi',
                    'nav'       => 'prainkubasi/daftar',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Pengaturan Seleksi',
                    'nav'       => 'prainkubasi/pengaturan',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/pengaturan'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Penilaian Seleksi',
                    'nav'       => 'prainkubasi/nilai',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/nilai'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Peringkat Penilaian',
                    'nav'       => 'prainkubasi/peringkat',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/peringkat'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Laporan Pra Inkubasi',
                    'nav'       => 'prainkubasi/laporan',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/laporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Riwayat Penilaian',
                    'nav'       => 'prainkubasi/riwayat',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/riwayat'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Inkubasi',
            'nav'       => 'inkubasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'wb_incandescent',
            'sub'       => array(
                array (
                    'title'     => 'Daftar Seleksi',
                    'nav'       => 'inkubasi/daftar',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Pengaturan Seleksi',
                    'nav'       => 'inkubasi/pengaturan',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/pengaturan'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Penilaian Seleksi',
                    'nav'       => 'inkubasi/nilai',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/nilai'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Laporan Inkubasi',
                    'nav'       => 'inkubasi/laporan',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/laporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Tenant',
            'nav'       => 'tenants',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'group_work',
            'sub'       => array(
    			array (
                    'title'     => 'Blog Tenant',
                    'nav'       => 'tenants/blogs',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/blogs'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Daftar Tenant',
                    'nav'       => 'tenants/daftar',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Pendaftaran Tenant',
                    'nav'       => 'tenants/pendaftaran',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pendaftaran'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Pendampingan',
                    'nav'       => 'tenants/pendampingan',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pendampingan'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Produk Tenant',
                    'nav'       => 'tenants/produk',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/produk'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Pembayaran',
                    'nav'       => 'tenants/pembayaran',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pembayaran'),
                    'icon'      => 'account_balance_wallet',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Laporan Tenant',
                    'nav'       => 'tenants/laporan',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/laporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Statistik',
            'nav'       => 'statistik',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'group_work',
            'sub'       => array(
    			array (
                    'title'     => 'Pengguna',
                    'nav'       => 'statistik/pengguna',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/blogs'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Pra Inkubasi',
                    'nav'       => 'statistik/prainkubasi',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/prainkubasi'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Inkubasi',
                    'nav'       => 'statistik/inkubasi',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/inkubasi'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Tenant',
                    'nav'       => 'statistik/tenant',
                    'parent'    => 'tenastatistiknts',
                    'link'      => base_url('statistik/tenant'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Publikasi',
            'nav'       => 'publikasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'web',
            'sub'       => array(
    			array (
                    'title'     => 'Daftar Publikasi',
                    'nav'       => 'publikasi/daftar',
                    'parent'    => 'statistik',
                    'link'      => base_url('publikasi/daftar'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Tambah Publikasi',
                    'nav'       => 'publikasi/tambah',
                    'parent'    => 'statistik',
                    'link'      => base_url('publikasi/tambah'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Panduan',
            'nav'       => 'panduan',
            'parent'    => 'false',
            'link'      => base_url('panduan/berkas'),
            'icon'      => 'insert_drive_file',
            'sub'       => false,
	    ),
        array (
            'title'     => 'Pengumuman',
            'nav'       => 'pengumuman',
            'parent'    => 'false',
            'link'      => base_url('pengumuman'),
            'icon'      => 'add_alert',
            'sub'       => false,
	    ),
        array (
            'title'     => 'Layanan',
            'nav'       => 'layanan',
            'parent'    => 'false',
            'link'      => base_url('layanan'),
            'icon'      => 'ring_volume',
            'sub'       => false,
	    ),
        array (
            'title'     => 'Pengaturan Umum',
            'nav'       => 'pengaturan',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'build',
            'sub'       => array(
                array (
                    'title'     => 'Pengaturan Frontend',
                    'nav'       => 'pengaturan/depan',
                    'parent'    => 'pengaturan',
                    'link'      => base_url('pengaturan/depan'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
    			array (
                    'title'     => 'Pengaturan Backend',
                    'nav'       => 'pengaturan/belakang',
                    'parent'    => 'pengaturan',
                    'link'      => base_url('pengaturan/belakang'),
                    'icon'      => 'build',
                    'sub'       => false,
                ),
            ),
	    ),
    ); 
    $menu_arr = json_decode(json_encode($menu_arr), FALSE);
    
    // Get user array
    $user_arr       = config_item('user_menu_access');
    $user_acc       = $user_arr[$user->type];
    $user_acc       = json_decode(json_encode($user_acc), FALSE);
    
    // Set Segment
    $active_page    = ( $this->uri->segment(1, 0) ? $this->uri->segment(1, 0) : '');
    $active_sub     = ( $this->uri->segment(2, 0) ? $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) : '');
    
    // Set Status
    if( $is_admin ){
        $status = 'Administrator';
    }else{
        if( $user->type == 2 ){
            $status = 'Pendamping';
        }elseif( $user->type == 3 ){
            $status = 'Tenant';
        }elseif( $user->type == 4 ){
            $status = 'Juri';
        }elseif( $user->type == 5 ){
            $status = 'Pengusul';
        }else{
            $status = 'Pelaksana';
        }
    }
    
    $uploaded       = $user->uploader;
    if($uploaded != 0){
        $file_name      = $user->filename . '.' . $user->extension;
        $file_url       = BE_AVA_PATH . $user->uploader . '/' . $file_name; 
        $avatar_side    = $file_url;
    }else{
        if($user->gender == GENDER_MALE){
            $avatar_side    = BE_IMG_PATH . 'avatar/avatar1.png';
        }else{
            $avatar_side    = BE_IMG_PATH . 'avatar/avatar3.png';
        }    
    }
?>

<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
    
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo $avatar_side; ?>" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user->name; ?></div>
                <div class="email"><?php echo $user->email; ?></div>
                <div class="email"><?php echo $status; ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo base_url('pengguna/profil'); ?>"><i class="material-icons">person</i>Profil</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="<?php echo base_url('logout'); ?>"><i class="material-icons">input</i>Keluar</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">NAVIGASI UTAMA</li>
                
                <?php foreach($menu_arr as $menu){ ?>
                    <?php if( in_array($menu->nav, $user_acc) ){ ?>
                    <li <?php echo ($active_page == $menu->nav ? 'class="active"' : ''); ?>>
                        <a href="<?php echo $menu->link; ?>" <?php echo !empty($menu->sub) ? 'class="menu-toggle"' : ''; ?>>
                            <i class="material-icons"><?php echo $menu->icon; ?></i>
                            <span><?php echo $menu->title; ?></span>
                        </a>
                        
                        <?php if( !empty($menu->sub) ){ ?>
                        <ul class="ml-menu">
                            <?php foreach($menu->sub as $sub){ ?>
                                <?php if( in_array($sub->nav, $user_acc) ){ ?>
                                    <li <?php echo ($active_sub == $sub->nav ? 'class="active"' : ''); ?>>
                                        <a href="<?php echo $sub->link; ?>"><?php echo $sub->title; ?></a>
                                    </li>
                                <?php } ?>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </li>
                    <?php } ?>  
                <?php } ?> 
            </ul>
        </div>
        <!-- #Menu -->
        
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2017 <a href="javascript:void(0);"><?php echo COMPANY_NAME; ?></a>.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>