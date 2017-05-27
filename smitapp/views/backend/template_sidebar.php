<?php
    $badgelist_user     = 0;
    if(!empty($is_admin)){
        $user_list          = $this->Model_User->count_user(NONACTIVE);
        if($user_list > 0){
            $badgelist_user = $user_list;
        }
    }
    
    // Set menu array
    $menu_arr = array(
        array (
            'title'     => 'Beranda',
            'nav'       => 'beranda',
            'parent'    => false,
            'link'      => base_url('beranda'),
            'icon'      => 'home',
            'badge'     => 0,
            'sub'       => false,
	    ),
        array (
            'title'     => 'Pengguna',
            'nav'       => 'pengguna',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'people',
            'badge'     => $badgelist_user,
            'sub'       => array(
    			array (
                    'title'     => 'Tambah Pengguna',
                    'nav'       => 'pengguna/tambah',
                    'parent'    => 'pengguna',
                    'link'      => base_url('pengguna/tambah'),
                    'icon'      => 'person_add',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Daftar Pengguna',
                    'nav'       => 'pengguna/daftar',
                    'parent'    => 'pengguna',
                    'link'      => base_url('pengguna/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => $badgelist_user,
                ),
            ),
	    ),
        array (
            'title'     => 'Data Perusahaan',
            'nav'       => 'company',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'location_city',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Daftar Perusahaan',
                    'nav'       => 'company/list',
                    'parent'    => 'company',
                    'link'      => base_url('company/list'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Detail Perusahaan',
                    'nav'       => 'company/detail',
                    'parent'    => 'company',
                    'link'      => base_url('company/detail'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Pengaturan Perusahaan',
                    'nav'       => 'company/setting',
                    'parent'    => 'company',
                    'link'      => base_url('company/setting'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Seleksi Pra-Inkubasi',
            'nav'       => 'seleksiprainkubasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'assignment',
            'badge'     => 0,
            'sub'       => array(
    			array (
                    'title'     => 'Pengaturan Seleksi',
                    'nav'       => 'seleksiprainkubasi/pengaturan',
                    'parent'    => 'seleksiprainkubasi',
                    'link'      => base_url('seleksiprainkubasi/pengaturan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Daftar Seleksi',
                    'nav'       => 'seleksiprainkubasi/daftar',
                    'parent'    => 'seleksiprainkubasi',
                    'link'      => base_url('seleksiprainkubasi/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Penilaian Seleksi',
                    'nav'       => 'seleksiprainkubasi/nilai',
                    'parent'    => 'seleksiprainkubasi',
                    'link'      => base_url('seleksiprainkubasi/nilai'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Peringkat Penilaian',
                    'nav'       => 'seleksiprainkubasi/peringkat',
                    'parent'    => 'seleksiprainkubasi',
                    'link'      => base_url('seleksiprainkubasi/peringkat'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Riwayat Penilaian',
                    'nav'       => 'seleksiprainkubasi/riwayat',
                    'parent'    => 'seleksiprainkubasi',
                    'link'      => base_url('seleksiprainkubasi/riwayat'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Pra-Inkubasi',
            'nav'       => 'prainkubasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'wb_incandescent',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Tambah Kegiatan',
                    'nav'       => 'prainkubasi/tambah',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/tambah'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Produk Pra-Inkubasi',
                    'nav'       => 'prainkubasi/produk',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/produk'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Daftar Pendampingan',
                    'nav'       => 'prainkubasi/pendampingan',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/pendampingan'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Laporan Pra-Inkubasi',
                    'nav'       => 'prainkubasi/laporan',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/laporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Seleksi Inkubasi',
            'nav'       => 'inkubasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'assignment',
            'badge'     => 0,
            'sub'       => array(
    			array (
                    'title'     => 'Pengaturan Seleksi',
                    'nav'       => 'inkubasi/pengaturan',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/pengaturan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Daftar Seleksi',
                    'nav'       => 'inkubasi/daftar',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Penilaian Seleksi',
                    'nav'       => 'inkubasi/nilai',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/nilai'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Peringkat Penilaian',
                    'nav'       => 'inkubasi/peringkat',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/peringkat'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Riwayat Penilaian',
                    'nav'       => 'inkubasi/riwayat',
                    'parent'    => 'inkubasi',
                    'link'      => base_url('inkubasi/riwayat'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Inkubasi / Tenant',
            'nav'       => 'tenants',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'wb_incandescent',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Tambah Tenant',
                    'nav'       => 'tenants/pendaftaran',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pendaftaran'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Daftar Tenant',
                    'nav'       => 'tenants/daftar',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Produk Tenant',
                    'nav'       => 'tenants/produk',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/produk'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Daftar Pendampingan',
                    'nav'       => 'tenants/pendampingan',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pendampingan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Blog Tenant',
                    'nav'       => 'tenants/blogs',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/blogs'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Pembayaran',
                    'nav'       => 'tenants/pembayaran',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pembayaran'),
                    'icon'      => 'account_balance_wallet',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Laporan Tenant',
                    'nav'       => 'tenants/laporan',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/laporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Pendampingan',
            'nav'       => 'pendamping',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'group_work',
            'badge'     => 0,
            'sub'       => array(
                /*
                array (
                    'title'     => 'Daftar Pendamping',
                    'nav'       => 'pendamping/daftar',
                    'parent'    => 'pendamping',
                    'link'      => base_url('pendamping/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                ),
                */
                array (
                    'title'     => 'Laporan Notulensi',
                    'nav'       => 'pendamping/laporan',
                    'parent'    => 'pendamping',
                    'link'      => base_url('pendamping/laporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Info Grafis',
            'nav'       => 'statistik',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => ' donut_small',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Seleksi Pra-Inkubasi',
                    'nav'       => 'statistik/prainkubasi',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/prainkubasi'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Seleksi Inkubasi',
                    'nav'       => 'statistik/inkubasi',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/inkubasi'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Kegiatan Pra-Inkubasi',
                    'nav'       => 'statistik/prainkubasi',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/prainkubasi'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Kegiatan Inkubasi/Tenant',
                    'nav'       => 'statistik/tenant',
                    'parent'    => 'tenastatistiknts',
                    'link'      => base_url('statistik/tenant'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Pengguna',  
                    'nav'       => 'statistik/pengguna',
                    'parent'    => 'statistik',
                    'link'      => base_url('statistik/blogs'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Berita',
            'nav'       => 'berita',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'web',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Tambah Berita',
                    'nav'       => 'berita/tambah',
                    'parent'    => 'statistik',
                    'link'      => base_url('berita/tambah'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Daftar Berita',
                    'nav'       => 'berita/daftar',
                    'parent'    => 'statistik',
                    'link'      => base_url('berita/daftar'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
	    ),
        array (
            'title'     => 'Panduan',
            'nav'       => 'panduan',
            'parent'    => 'false',
            'link'      => base_url('panduan/berkas'),
            'icon'      => 'insert_drive_file',
            'badge'     => 0,
            'sub'       => false,
	    ),
        array (
            'title'     => 'Pengumuman',
            'nav'       => 'pengumuman',
            'parent'    => 'false',
            'link'      => base_url('pengumuman'),
            'icon'      => 'add_alert',
            'badge'     => 0,
            'sub'       => false,
	    ),
        array (
            'title'     => 'Layanan',
            'nav'       => 'layanan',
            'parent'    => 'false',
            'link'      => base_url('layanan'),
            'icon'      => 'ring_volume',
            'badge'     => 0,
            'sub'       => false,
	    ),
        array (
            'title'     => 'Pengaturan Umum',
            'nav'       => 'pengaturan',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'build',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Pengaturan Frontend',
                    'nav'       => 'pengaturan/depan',
                    'parent'    => 'pengaturan',
                    'link'      => base_url('pengaturan/depan'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Pengaturan Backend',
                    'nav'       => 'pengaturan/belakang',
                    'parent'    => 'pengaturan',
                    'link'      => base_url('pengaturan/belakang'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
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
                            <?php if($menu->badge != 0) : ?>
                            <span class="badge bg-blue" style="color: white;"><?php echo $menu->badge?></span>
                            <?php endif ?>
                        </a>
                        
                        <?php if( !empty($menu->sub) ){ ?>
                        <ul class="ml-menu">
                            <?php foreach($menu->sub as $sub){ ?>
                                <?php if( in_array($sub->nav, $user_acc) ){ ?>
                                    <li <?php echo ($active_sub == $sub->nav ? 'class="active"' : ''); ?>>
                                        <a href="<?php echo $sub->link; ?>"><?php echo $sub->title; ?>
                                            <?php if($sub->badge != 0) : ?>
                                            <span class="badge bg-blue" style="color: white;"><?php echo $sub->badge?></span>
                                            <?php endif ?>
                                        </a>
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
        <!-- <span class="badge bg-red" style="color: white;">0</span> -->
        
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