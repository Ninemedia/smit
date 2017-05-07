<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Tenant Controller.
 * 
 * @class     Tenant
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Tenant extends User_Controller {
    /**
	 * Constructor.
	 */
    function __construct()
    {       
        parent::__construct();
    }
    
    /**
	 * Index function.
	 */
	public function index()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    // ---------------------------------------------------------------------------------------------
    // TENANT
    /**
	 * Blog Tenant function.
	 */
	public function tenantblogs()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Blog Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/blogs';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * List Selection Tenant function.
	 */
	public function tenantlist()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Daftar Seleksi Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/list';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Data Tenant function.
	 */
	public function tenantdata()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Daftar Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/tenantdata';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Score Tenant function.
	 */
	public function tenantscore()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Penilaian Seleksi Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/score';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Accompaniment Tenant function.
	 */
	public function tenantaccompaniment()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Pendampingan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/accompaniment';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Product Tenant function.
	 */
	public function tenantproduct()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Produk Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/product';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Payment Tenant function.
	 */
	public function tenantpayment()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Pembayaran Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/payment';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Report Tenant function.
	 */
	public function tenantreport()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Laporan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/report';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Tenant Add function.
	 */
	public function tenantadd()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/forms/editors.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Tenant.init();',
            'UploadFiles.init();',
            'TenantValidation.init();',
        ));
        
        $uploaded       = $current_user->uploader;
        if($uploaded != 0){
            $file_name      = $current_user->filename . '.' . $current_user->extension;
            $file_url       = BE_AVA_PATH . $current_user->uploader . '/' . $file_name; 
            $avatar         = $file_url;
        }else{
            $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
        }

        $data['title']          = TITLE . 'Pengaturan Data Perusahaan';
        $data['user']           = $current_user;
        $data['avatar']         = $avatar;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/signuptenant';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Add Tenant function.
	 */
    function addtenant()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pelaksana           = as_pelaksana($current_user);
        $id_user                = $current_user->id;
        
        $post_tenant_name       = $this->input->post('tenant_name');
        $post_tenant_email      = $this->input->post('tenant_email');
        $post_tenant_year       = $this->input->post('tenant_year');
        $post_tenant_address    = $this->input->post('tenant_address');
        $post_tenant_province   = $this->input->post('province');
        //$post_tenant_city       = $this->input->post('regional');
        $post_tenant_district   = $this->input->post('tenant_district');
        $post_tenant_phone      = $this->input->post('tenant_phone_contact');
        $post_tenant_legal      = $this->input->post('tenant_legal');
        $post_tenant_bussiness  = $this->input->post('tenant_bussiness');
        $post_tenant_mitra      = $this->input->post('tenant_mitra');
        
        $this->form_validation->set_rules('tenant_name','Nama Tenant','required');
        $this->form_validation->set_rules('tenant_email','Email Tenant','required');
        $this->form_validation->set_rules('tenant_year','Tahun Berdiri Tenatn','required');
        $this->form_validation->set_rules('tenant_address','Alamat','required');
        $this->form_validation->set_rules('province','Provinsi','required');
        //$this->form_validation->set_rules('regional','Kota/Kabupaten','required');
        $this->form_validation->set_rules('tenant_district','Kecamatan/Kelurahan','required');
        $this->form_validation->set_rules('tenant_phone_contact','Telp/HP','required');
        $this->form_validation->set_rules('tenant_legal','Legal','required');
        $this->form_validation->set_rules('tenant_bussiness','NPWP','required');
        $this->form_validation->set_rules('tenant_mitra','Mitra Usaha','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            $curdate            = date("Y-m-d H:i:s");
            
            $tenantdata         = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'user_id'       => trim(smit_isset($id_user, '')),
                'username'      => strtolower( trim(smit_isset($current_user->username, '')) ),
                'name'          => strtoupper( trim(smit_isset($current_user->name, '')) ),
                'name_tenant'   => strtoupper( trim(smit_isset($post_tenant_name, '')) ),
                'email'         => trim(smit_isset($post_tenant_email, '')),
                'phone'         => trim(smit_isset($post_tenant_phone, '')),
                'year'          => smit_isset($post_tenant_year, ''),
                'address'       => strtoupper( trim(smit_isset($post_tenant_address, '')) ),
                'province'      => smit_isset($post_tenant_province, ''),
                //'city'          => smit_isset($post_tenant_city, ''),
                'district'      => strtoupper( trim(smit_isset($post_tenant_district, '')) ),
                'legal'         => trim(smit_isset($post_tenant_legal, '')),
                'licensing'     => trim(smit_isset($post_tenant_bussiness, '')),
                'partnerships'  => smit_isset($post_tenant_mitra, ''),
                'status'        => NONACTIVE,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );
            
            if( $save_tenant    = $this->Model_Tenant->save_data_tenant($tenantdata) ){
                // Set Message
                $msg            = ( $id_user != $current_user->id ? 'Data profil <strong>'. $username .'</strong> sudah tersimpan.' : 'Data profil Anda sudah tersimpan.' );
                
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => smit_alert('Validasi formulir Anda berhasil! '.$msg.''),
                    'name'      => ( !empty($id_user) ? '' : smit_isset($post_tenant_name, '') ),
                );
            }else{
                // Set JSON data
                $data['success']    = false;
                $data['msg']        = 'error';
                $data['message']    = '<strong>Validasi formulir Anda tidak berhasil! Silahkan periksa kembali data formulir Anda!';  
            }
            
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    /**
	 * Logo Tenant Setting Info Update function.
	 */
    function logotenant()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pelaksana           = as_pelaksana($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $post_user_username     = $this->input->post('username');
        $username               = smit_isset($post_user_username, '');
        
        $this->form_validation->set_rules('username','Username anda','required');
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // -------------------------------------------------
            // Check File
            // -------------------------------------------------
            if( empty($_FILES['avatar_company']['name']) ){
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => smit_alert('Tidak ada berkas avatar yang di unggah. Silahkan inputkan berkas avatar!'),
                );
                die(json_encode($data));
            }
            
            if( !empty( $_POST ) ){
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/images/tenant/' . $current_user->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                    
                $config = array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => "jpg|jpeg|png",
                    'overwrite'     => FALSE,
                    'max_size'      => "1024000", 
                );
                $this->upload->initialize($config);
                
                // -------------------------------------------------
                // Begin Transaction
                // -------------------------------------------------
                $this->db->trans_begin();
                
                if( !empty($_FILES['avatar_company']['name']) ){
                    if( ! $this->upload->do_upload('avatar_company') ){
                        $message = $this->upload->display_errors();
                        // Set JSON data
                        $data = array('message' => 'error','data' => $this->upload->display_errors()); 
                        die(json_encode($data));
                    }
                    $upload_data    = $this->upload->data();
                    $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
                    $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$upload_file, TRUE);
                    $this->image_moo->clear();
                    
                    $logotenant_data  = array(
                        'url'           => smit_isset($upload_data['full_path'],''),
                        'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                        'filename'      => smit_isset($upload_data['raw_name'],''),
                        'size'          => smit_isset($upload_data['file_size'],0),
                        'uploader'      => $current_user->id,
                        'datemodified'  => $curdate,
                    );  
                }
            }
            
            // -------------------------------------------------
            // Save Tenant 
            // -------------------------------------------------
            $trans_save_Tenant  = FALSE;
            if( $save_tenant    = $this->Model_Tenant->update_data($current_user->id, $logotenant_data) ){
                $trans_save_Tenant  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Perbaharui logo tenant tidak berhasil. Terjadi kesalahan berkas anda'); 
                die(json_encode($data));
            }
            
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_Tenant ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Perbaharui logo tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Perbaharui logo tenant baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'ACCOUNT_UPDATE', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Perbaharui logo tenant tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
            
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    
    
    // ---------------------------------------------------------------------------------------------
}

/* End of file tenant.php */
/* Location: ./application/controllers/tenant.php */