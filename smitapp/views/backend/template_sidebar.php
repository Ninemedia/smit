<?php
    $is_jury                = as_juri($user);
    $is_pengusul            = as_pengusul($user);
    $is_pelaksana           = as_pelaksana($user);
    $is_pendamping          = as_pendamping($user);
    $is_tenant              = as_tenant($user);

    // List User
    $badgelist_user     = 0;
    if(!empty($is_admin)){
        $user_list          = $this->Model_User->count_user(NONACTIVE);
        if($user_list > 0){
            $badgelist_user = $user_list;
        }
    }
    // -------------------------------------------------------------------------------------------------------------

    // Pendampingan
    // Pendampingan -> Notulensi
    $total_accompaniment_badge_pra    = 0;
    $total_accompaniment_badge_inc    = 0;
    if(!empty($is_admin)){
        $acompaniment_list_pra  = $this->Model_Praincubation->count_notes(UNREAD);
        if($acompaniment_list_pra > 0){
            $total_accompaniment_badge_pra = $acompaniment_list_pra;
        }

        $acompaniment_list_inc  = $this->Model_Incubation->count_notes(UNREAD);
        if($acompaniment_list_inc > 0){
            $total_accompaniment_badge_inc = $acompaniment_list_inc;
        }
    }else{
        $acompaniment_list_inc  = $this->Model_Incubation->count_notes(UNREAD);
        if($acompaniment_list_inc > 0){
            $total_accompaniment_badge_inc = $acompaniment_list_inc;
        }
    }
    // -------------------------------------------------------------------------------------------------------------

    // Layanan
    // Layanan -> Pesan Umum
    $total_service_badge    = 0;
    $badge_generalmessage   = 0;
    if(!empty($is_admin)){
        $generalmessage_list     = $this->Model_Service->count_generalmessage(UNREAD);
        if($generalmessage_list > 0){
            $badge_generalmessage = $generalmessage_list;
        }
    }
    // Layanan -> Komunikasi dan Bantuan
    $badge_communication    = 0;
    if(!empty($user)){
        if($is_admin){
            $communication_list     = $this->Model_Service->count_communicationin(UNREAD);
        }else{
            $communication_list     = $this->Model_Service->count_communicationin(UNREAD, $user->id);
        }

        if($communication_list > 0){
            $badge_communication = $communication_list;
        }
    }
    $total_service_badge    = $badge_generalmessage + $badge_communication;
    // -------------------------------------------------------------------------------------------------------------

    // Seleksi Pra-Inkubasi -> Penilaian Seleksi
    $badge_score_total      = 0;
    $badge_score1           = 0;
    $status                 = CONFIRMED;
    if(!empty($is_pengusul)){
        $status             = NOTCONFIRMED;
    }

    if(!empty($is_admin) || !empty($is_jury) || !empty($is_pengusul)){
        $score_list1        = $this->Model_Praincubation->count_all_scoreconfirm_step1($status, NOTCONFIRMED);
        if($score_list1 > 0){
            $badge_score1   = $score_list1;
        }
    }
    $badge_score2           = 0;
    if(!empty($is_admin) || !empty($is_jury) || !empty($is_pengusul)){
        $score_list2        = $this->Model_Praincubation->count_all_scoreconfirm_step2(CONFIRMED);
        if($score_list2 > 0){
            $badge_score2   = $score_list2;
        }
    }
    $badge_score_total      = $badge_score1 + $badge_score2;
    // Seleksi Pra-Inkubasi -> Daftar Seleksi
    $badge_list_praincubation   = 0;
    if(!empty($is_admin)){
        $list_praincubation = $this->Model_Praincubation->count_all_list(NOTCONFIRMED);
        if($list_praincubation > 0){
            $badge_list_praincubation   = $list_praincubation;
        }
    }

    $total_selection_praincubation  = $badge_score_total + $badge_list_praincubation;

    // -------------------------------------------------------------------------------------------------------------
    // Seleksi Inkubasi -> Penilaian Seleksi
    $badge_score_total_inc  = 0;
    $badge_score_inc1       = 0;
    $status_inc             = CONFIRMED;
    if(!empty($is_pengusul)){
        $status_inc         = NOTCONFIRMED;
    }

    if(!empty($is_admin) || !empty($is_jury) || !empty($is_pengusul)){
        $score_list_inc1        = $this->Model_Incubation->count_all_scoreconfirm_step1($status_inc, NOTCONFIRMED);
        if($score_list_inc1 > 0){
            $badge_score_inc1   = $score_list_inc1;
        }
    }
    $badge_score_inc2       = 0;
    if(!empty($is_admin) || !empty($is_jury) || !empty($is_pengusul)){
        $score_list_inc2    = $this->Model_Incubation->count_all_scoreconfirm_step2(CONFIRMED);
        if($score_list_inc2 > 0){
            $badge_score_inc2   = $score_list_inc2;
        }
    }
    $badge_score_total_inc      = $badge_score_inc1 + $badge_score_inc2;
    // Seleksi Pra-Inkubasi -> Daftar Seleksi
    $badge_list_incubation      = 0;
    if(!empty($is_admin)){
        $list_incubation    = $this->Model_Incubation->count_all_list(NOTCONFIRMED);
        if($list_incubation > 0){
            $badge_list_incubation   = $list_incubation;
        }
    }

    $total_selection_incubation  = $badge_score_total_inc + $badge_list_incubation;
    // -------------------------------------------------------------------------------------------------------------

    if(!empty($is_admin)){
        $title_daftar   = 'Daftar Hasil Pra-Inkubasi';
        $title_daftar_inkubasi   = 'Daftar Hasil Inkubasi';
    }else{ $title_daftar   = 'Daftar Kegiatan'; $title_daftar_inkubasi   = 'Daftar Kegiatan'; }

    // -------------------------------------------------------------------------------------------------------------
    // Pengumuman
    $badge_announcement     = 0;
    //if(!empty($is_admin)){
        $announcement_list  = $this->Model_Announcement->get_all_announcements();
        $badge_announcement = count($announcement_list);
    //}

    // -------------------------------------------------------------------------------------------------------------

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
                array (
                    'title'     => 'Info Pengguna',
                    'nav'       => 'pengguna/info',
                    'parent'    => 'pengguna',
                    'link'      => base_url('pengguna/info'),
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
            'badge'     => $total_selection_praincubation,
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
                    'badge'     => $badge_list_praincubation,
                ),
    			array (
                    'title'     => 'Penilaian Seleksi',
                    'nav'       => 'seleksiprainkubasi/nilai',
                    'parent'    => 'seleksiprainkubasi',
                    'link'      => base_url('seleksiprainkubasi/nilai'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => $badge_score_total,
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
                    'title'     => $title_daftar,
                    'nav'       => 'prainkubasi/daftar',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/daftar'),
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
                    'title'     => 'Tambah Produk',
                    'nav'       => 'prainkubasi/tambahproduk',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/tambahproduk'),
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
                    'title'     => 'Tambah Laporan',
                    'nav'       => 'prainkubasi/tambahlaporan',
                    'parent'    => 'prainkubasi',
                    'link'      => base_url('prainkubasi/tambahlaporan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Action Plan Pra-Inkubasi',
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
            'nav'       => 'seleksiinkubasi',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'assignment',
            'badge'     => $total_selection_incubation,
            'sub'       => array(
    			array (
                    'title'     => 'Pengaturan Seleksi',
                    'nav'       => 'seleksiinkubasi/pengaturan',
                    'parent'    => 'seleksiinkubasi',
                    'link'      => base_url('seleksiinkubasi/pengaturan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Daftar Seleksi',
                    'nav'       => 'seleksiinkubasi/daftar',
                    'parent'    => 'seleksiinkubasi',
                    'link'      => base_url('seleksiinkubasi/daftar'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => $badge_list_incubation,
                ),
    			array (
                    'title'     => 'Penilaian Seleksi',
                    'nav'       => 'seleksiinkubasi/nilai',
                    'parent'    => 'seleksiinkubasi',
                    'link'      => base_url('seleksiinkubasi/nilai'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => $badge_score_total_inc,
                ),
    			array (
                    'title'     => 'Peringkat Penilaian',
                    'nav'       => 'seleksiinkubasi/peringkat',
                    'parent'    => 'seleksiinkubasi',
                    'link'      => base_url('seleksiinkubasi/peringkat'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Riwayat Penilaian',
                    'nav'       => 'seleksiinkubasi/riwayat',
                    'parent'    => 'seleksiinkubasi',
                    'link'      => base_url('seleksiinkubasi/riwayat'),
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
                    'title'     => $title_daftar_inkubasi,
                    'nav'       => 'tenants/daftarinkubasi',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/daftarinkubasi'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
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
                    'title'     => 'Daftar Pendampingan',
                    'nav'       => 'tenants/pendampingan',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pendampingan'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Tambah Produk',
                    'nav'       => 'tenants/tambahproduk',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/tambahproduk'),
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
                    'title'     => 'Blog Tenant',
                    'nav'       => 'tenants/blogs',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/blogs'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                /*
    			array (
                    'title'     => 'Dokumen Tenant',
                    'nav'       => 'tenants/pembayaran',
                    'parent'    => 'tenants',
                    'link'      => base_url('tenants/pembayaran'),
                    'icon'      => 'account_balance_wallet',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                */
    			array (
                    'title'     => 'Action Plan Tenant',
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
            'title'     => 'Monitoring Dokumen',
            'nav'       => 'monitoring_dokumen',
            'parent'    => 'false',
            'link'      => base_url('monitoring_dokumen'),
            'icon'      => 'folder',
            'badge'     => 0,
            'sub'       => false,
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
                    'title'     => 'Tambah Pendamping',
                    'nav'       => 'pendamping/tambah',
                    'parent'    => 'pendamping',
                    'link'      => base_url('pendamping/tambah'),
                    'icon'      => 'view_list',
                    'badge'     => 0,
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Notulensi Pra-Inkubasi',
                    'nav'       => 'pendamping/notulensiprainkubasi',
                    'parent'    => 'pendamping',
                    'link'      => base_url('pendamping/notulensiprainkubasi'),
                    'icon'      => 'view_list',
                    'badge'     => $total_accompaniment_badge_pra,
                    'sub'       => false,
                ),
                array (
                    'title'     => 'Notulensi Inkubasi',
                    'nav'       => 'pendamping/notulensiinkubasi',
                    'parent'    => 'pendamping',
                    'link'      => base_url('pendamping/notulensiinkubasi'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => $total_accompaniment_badge_inc,
                    'sub'       => false,
                ),
            ),
	    ),
        array (
            'title'     => 'Info Grafis',
            'nav'       => 'infografis',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => ' donut_small',
            'badge'     => 0,
            'sub'       => array(
                array (
                    'title'     => 'Pengguna',
                    'nav'       => 'infografis/pengguna',
                    'parent'    => 'infografis',
                    'link'      => base_url('infografis/pengguna'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
                array (
                    'title'     => 'Pra-Inkubasi',
                    'nav'       => 'infografis/prainkubasi',
                    'parent'    => 'infografis',
                    'link'      => base_url('infografis/prainkubasi'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Inkubasi / Tenant',
                    'nav'       => 'infografis/inkubasi',
                    'parent'    => 'infografis',
                    'link'      => base_url('infografis/inkubasi'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
    			array (
                    'title'     => 'Pengukuran IKM',
                    'nav'       => 'infografis/ikm',
                    'parent'    => 'infografis',
                    'link'      => base_url('infografis/ikm'),
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
            'link'      => base_url('berita'),
            'icon'      => 'web',
            'badge'     => 0,
            'sub'       => false,
	    ),
        array (
            'title'     => 'Berkas Digital',
            'nav'       => 'berkas',
            'parent'    => 'false',
            'link'      => base_url('berkas/digital'),
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
            'badge'     => $badge_announcement,
            'sub'       => false,
	    ),
        /*
        array (
            'title'     => 'Layanan',
            'nav'       => 'layanan',
            'parent'    => 'false',
            'link'      => base_url('layanan'),
            'icon'      => 'ring_volume',
            'badge'     => 0,
            'sub'       => false,
	    ),
        */
        array (
            'title'     => 'Diskusi',
            'nav'       => 'diskusi',
            'parent'    => 'false',
            'link'      => base_url('diskusi'),
            'icon'      => 'chat',
            'badge'     => 0,
            'sub'       => false,
            'badge'     => $badge_communication,
	    ),
        array (
            'title'     => 'Layanan',
            'nav'       => 'layanan',
            'parent'    => 'false',
            'link'      => 'javascript:;',
            'icon'      => 'ring_volume',
            'badge'     => $total_service_badge,
            'sub'       => array(
    			array (
                    'title'     => 'Pesan Umum',
                    'nav'       => 'layanan/pesanumum',
                    'parent'    => 'layanan',
                    'link'      => base_url('layanan/pesanumum'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => $badge_generalmessage,
                ),
                array (
                    'title'     => 'Komunikasi & Bantuan',
                    'nav'       => 'layanan/komunikasi',
                    'parent'    => 'layanan',
                    'link'      => base_url('layanan/komunikasibantuan'),
                    'icon'      => 'view_list',
                    'sub'       => false,
                    'badge'     => $badge_communication,
                ),
    			array (
                    'title'     => 'Pengukuran IKM',
                    'nav'       => 'layanan/pengukuranikm',
                    'parent'    => 'layanan',
                    'link'      => base_url('layanan/pengukuranikm'),
                    'icon'      => 'build',
                    'sub'       => false,
                    'badge'     => 0,
                ),
            ),
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
    			array (
                    'title'     => 'Pengaturan Satuan Kerja',
                    'nav'       => 'pengaturan/satuankerja',
                    'parent'    => 'pengaturan',
                    'link'      => base_url('pengaturan/satuankerja'),
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
        if( !file_exists($avatar_side) ){
            if($user->gender == GENDER_MALE){
                $avatar_side    = BE_IMG_PATH . 'avatar/avatar1.png';
            }else{
                $avatar_side    = BE_IMG_PATH . 'avatar/avatar3.png';
            }
        }
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
                <div class="name"><a href="<?php echo base_url('pengguna/profil'); ?>" style="color: white !important;"><?php echo word_limiter($user->name, 15); ?></a></div>
                <div class="email"><?php echo $user->email; ?></div>
                <div class="email"><?php echo $status; ?></div>
                <!--
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo base_url('pengguna/profil'); ?>"><i class="material-icons">person</i>Profil</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="<?php echo base_url('logout'); ?>"><i class="material-icons">input</i>Keluar</a></li>
                    </ul>
                </div>
                -->
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
                            <span class="badge bg-red" style="color: white;"><?php echo $menu->badge?></span>
                            <?php endif ?>
                        </a>

                        <?php if( !empty($menu->sub) ){ ?>
                        <ul class="ml-menu">
                            <?php foreach($menu->sub as $sub){ ?>
                                <?php if( in_array($sub->nav, $user_acc) ){ ?>
                                    <li <?php echo ($active_sub == $sub->nav ? 'class="active"' : ''); ?>>
                                        <a href="<?php echo $sub->link; ?>"><?php echo $sub->title; ?>
                                            <?php if($sub->badge != 0) : ?>
                                            <span class="badge bg-red" style="color: white;"><?php echo $sub->badge?></span>
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
