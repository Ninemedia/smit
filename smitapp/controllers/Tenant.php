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
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
        ));

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
        $is_pelaksana           = as_pelaksana($current_user);

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
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
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

        $tenant         = '';

        if( !empty($is_admin) ){
            $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
        }else{
            $tenant         = $this->Model_Tenant->get_tenantdata($current_user->id);
            if( !empty($tenant) ){
                $uploaded       = $tenant->uploader;
                if($uploaded != 0){
                    $file_name      = $tenant->filename . '.' . $tenant->extension;
                    $file_url       = BE_IMG_PATH . 'tenant/' . $tenant->uploader . '/' . $file_name;
                    $avatar         = $file_url;
                }else{
                    $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
                }
            }else{
                $avatar     = BE_IMG_PATH . 'tenant/avatar1.png';
            }
        }

        $data['title']          = TITLE . 'Pengaturan Data Perusahaan';
        $data['user']           = $current_user;
        $data['avatar']         = $avatar;
        $data['tenant']         = $tenant;
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
        $curdate                = date("Y-m-d H:i:s");

        $post_selection_id      = $this->input->post('reg_event');
        $post_tenant_name       = $this->input->post('tenant_name');
        $post_tenant_email      = $this->input->post('tenant_email');
        $post_tenant_year       = $this->input->post('tenant_year');
        $post_tenant_address    = $this->input->post('tenant_address');
        $post_tenant_province   = $this->input->post('tenant_province');
        $post_tenant_city       = $this->input->post('tenant_regional');
        $post_tenant_district   = $this->input->post('tenant_district');
        $post_tenant_phone      = $this->input->post('tenant_phone_contact');
        $post_tenant_legal      = $this->input->post('tenant_legal');
        $post_tenant_bussiness  = $this->input->post('tenant_bussiness');
        $post_tenant_mitra      = $this->input->post('tenant_mitra');

        $this->form_validation->set_rules('tenant_name','Nama Tenant','required');
        $this->form_validation->set_rules('tenant_email','Email Tenant','required');
        $this->form_validation->set_rules('tenant_year','Tahun Berdiri Tenatn','required');
        $this->form_validation->set_rules('tenant_address','Alamat','required');
        $this->form_validation->set_rules('tenant_province','Provinsi','required');
        $this->form_validation->set_rules('tenant_regional','Kota/Kabupaten','required');
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
            // -------------------------------------------------
            // Check File
            // -------------------------------------------------
            if( empty($_FILES['avatar_selection_files']['name']) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Tidak ada logo tenant yang di unggah. Silahkan inputkan logo tenant dengan format gambar!');
                die(json_encode($data));
            }

            if( !empty($_POST) ){
                // -------------------------------------------------
                // Begin Transaction
                // -------------------------------------------------
                $this->db->trans_begin();

                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationtenant/' . $current_user->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types' => "jpg|jpeg|png",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );
                $this->load->library('MY_Upload', $config);

                if( ! $this->my_upload->do_upload('avatar_selection_files') ){
                    $message = $this->my_upload->display_errors();

                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }
                $upload_data_avatar     = $this->my_upload->data();
                $upload_avatar          = $upload_data_avatar['raw_name'] . $upload_data_avatar['file_ext'];
                $this->image_moo->load($upload_path . '/' .$upload_data_avatar['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$upload_avatar, TRUE);
                $this->image_moo->clear();
                $file_avatar            = $upload_data_avatar;

                if( !empty($post_selection_id) ){
                    $condition          = " WHERE %id% = ".$post_selection_id."";
                    $data_selection     = $this->Model_Incubation->get_all_incubationdata(0, 0, $condition);
                    $data_selection     = $data_selection[0];
                }

                $tenantdata         = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'selection_id'  => trim(smit_isset($post_selection_id, '')),
                    'user_id'       => trim(smit_isset($data_selection->user_id, '')),
                    'username'      => strtolower( trim(smit_isset($data_selection->username, '')) ),
                    'name'          => strtoupper( trim(smit_isset($data_selection->name, '')) ),
                    'name_tenant'   => strtoupper( trim(smit_isset($post_tenant_name, '')) ),
                    'email'         => trim(smit_isset($post_tenant_email, '')),
                    'phone'         => trim(smit_isset($post_tenant_phone, '')),
                    'year'          => smit_isset($post_tenant_year, ''),
                    'address'       => strtoupper( trim(smit_isset($post_tenant_address, '')) ),
                    'province'      => smit_isset($post_tenant_province, ''),
                    'city'          => smit_isset($post_tenant_city, ''),
                    'district'      => strtoupper( trim(smit_isset($post_tenant_district, '')) ),
                    'legal'         => trim(smit_isset($post_tenant_legal, '')),
                    'licensing'     => trim(smit_isset($post_tenant_bussiness, '')),
                    'partnerships'  => smit_isset($post_tenant_mitra, ''),
                    'url'           => smit_isset($file_avatar['full_path'],''),
                    'extension'     => substr(smit_isset($file_avatar['file_ext'],''),1),
                    'filename'      => smit_isset($file_avatar['raw_name'],''),
                    'size'          => smit_isset($file_avatar['file_size'],0),
                    'uploader'      => trim(smit_isset($id_user, '')),
                    'status'        => NONACTIVE,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );

                // -------------------------------------------------
                // Save Tenant Selection
                // -------------------------------------------------
                $trans_save_tenant       = FALSE;
                if( $save_tenant    = $this->Model_Tenant->save_data_tenant($tenantdata) ){
                    $trans_save_tenant   = TRUE;
                }else{
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array('message' => 'error','data' => 'Pendaftaran tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                    die(json_encode($data));
                }

                // -------------------------------------------------
                // Commit or Rollback Transaction
                // -------------------------------------------------
                if( $trans_save_tenant ){
                    if ($this->db->trans_status() === FALSE){
                        // Rollback Transaction
                        $this->db->trans_rollback();
                        // Set JSON data
                        $data = array(
                            'message'       => 'error',
                            'data'          => 'Pendaftaran tidak berhasil. Terjadi kesalahan data transaksi database.'
                        ); die(json_encode($data));
                    }else{
                        // Commit Transaction
                        $this->db->trans_commit();
                        // Complete Transaction
                        $this->db->trans_complete();

                        // Send Email Notification
                        //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                        // Set JSON data
                        $data       = array('message' => 'success', 'data' => 'Pendaftaran tenant baru berhasil!');
                        die(json_encode($data));
                        // Set Log Data
                        smit_log( 'TENANT_REG', 'SUCCESS', maybe_serialize(array('username'=>$current_user->username, 'upload_files'=> $upload_data_avatar)) );
                    }
                }else{
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array('message' => 'error','data' => 'Pendaftaran tenant tidak berhasil. Terjadi kesalahan data.');
                    die(json_encode($data));
                }
            }
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
            if( $save_tenant    = $this->Model_Tenant->update_data_tenant($current_user->id, $logotenant_data) ){

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

    /**
	 * Tenant list data function.
	 */
    function tenantlistdata( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';

        $order_by           = '';
        $iTotalRecords      = 0;

        $iDisplayLength     = intval($_REQUEST['iDisplayLength']);
        $iDisplayStart      = intval($_REQUEST['iDisplayStart']);

        $sAction            = smit_isset($_REQUEST['sAction'],'');
        $sEcho              = intval($_REQUEST['sEcho']);
        $sort               = $_REQUEST['sSortDir_0'];
        $column             = intval($_REQUEST['iSortCol_0']);

        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_event            = $this->input->post('search_event');
        $s_event            = smit_isset($s_year, '');
        $s_name_tenant      = $this->input->post('search_name_tenant');
        $s_name_tenant      = smit_isset($$s_name_tenant, '');
        $s_email            = $this->input->post('search_email');
        $s_email            = smit_isset($s_email, '');
        $s_phone            = $this->input->post('search_phone');
        $s_phone            = smit_isset($s_phone, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_name_tenant) )    { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_email) )          { $condition .= str_replace('%s%', $s_email, ' AND %email% LIKE "%%s%%"'); }
        if( !empty($s_phone) )          { $condition .= str_replace('%s%', $s_phone, ' AND %phone% LIKE "%%s%%"'); }
        if( !empty($s_event) )           { $condition .= str_replace('%s%', $s_year, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $is_admin ){
            if( $column == 1 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name_teannt% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%email% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%phone% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 7 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 1 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name_teannt% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%email% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%phone% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }
        }
        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($tenant_list as $row){
                // Status
                $btn_confirm    = '';
                if( $row->status == NONACTIVE ){
                    $btn_confirm    = '<a href="'.base_url('tenants/konfirmasi/active/'.$row->user_id).'"
                        class="tenantconfirm btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" id="tenantconfirm" title="Konfirmasi"><i class="material-icons">done</i></a> ';
                }

                $btn_team       = '<a href="'.base_url('tenants/daftar/tim/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-defaukt waves-effect tooltips bottom5" data-placement="left" title="Tambah Tim"><i class="material-icons">group</i></a> ';

                $btn_action     = '<a href="'.base_url('tenants/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                if($row->status == ACTIVE)          { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == NONACTIVE)   { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == BANNED)      { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == DELETED)     { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                if( $is_admin ){
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        '<a href="'.base_url('pengguna/profil/'.$row->id).'">' . strtoupper( $row->name ) . '</a>',
                        strtoupper( $row->event_title ),
                        '<strong>'.strtoupper( $row->name_tenant ).'</strong>',
                        $row->email,
                        smit_center( $row->phone ),
                        smit_center( $status ),
                        smit_center( $btn_confirm . ' '. $btn_action . ' ' . $btn_team ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        strtoupper( $row->event_title ),
                        '<strong>'.strtoupper( $row->name_tenant ).'</strong>',
                        $row->email,
                        smit_center( $row->phone ),
                        smit_center( $status ),
                        smit_center( $btn_confirm . ' '. $btn_action . ' ' . $btn_team ),
                    );
                }
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Tenant confirm function.
	 */
    function tenantconfirm($action, $id){
        // This is for AJAX request
    	//if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        if ( !$id ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'ID Pengguna harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Pengguna hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };

        $userdata           = smit_get_userdata_by_id($id);
        if( !$userdata ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data pengguna tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }

        $curdate = date('Y-m-d H:i:s');
        if( $action=='active' )     { $status = ACTIVE; }
        elseif( $action=='banned' ) { $status = BANNED; }
        elseif( $action=='delete' ) { $status = DELETED; }

        $data_update = array('status'=>$status,'datemodified'=>$curdate);
        if( $this->Model_Tenant->update_data_tenant($id,$data_update) ){
            // Set JSON data
            $data = array('msg' => 'success','message' => 'Konfirmasi data pengguna berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data pengguna tidak berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }
    }



    // ---------------------------------------------------------------------------------------------
}

/* End of file tenant.php */
/* Location: ./application/controllers/tenant.php */
