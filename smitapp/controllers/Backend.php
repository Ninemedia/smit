<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Backend Controller.
 * 
 * @class     Backend
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Backend extends User_Controller {
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

        $data['title']          = TITLE . 'Beranda';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'dashboard';
        
		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    // ---------------------------------------------------------------------------------------------
    // SETTING
    /**
	 * Setting Frontend function.
	 */
	function settingfrontend()
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
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            BE_JS_PATH . 'setting.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/forms/editors.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';

        $data['title']          = TITLE . 'Pengaturan Frontend';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'setting/frontend';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * Setting Backend function.
	 */
	function settingbackend()
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            BE_JS_PATH . 'custom.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/forms/editors.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Setting.init();',
        ));

        $data['title']          = TITLE . 'Pengaturan Backend';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'setting/backend';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * Update Setting Backend function.
	 */
    function updatesettingbackend()
    {
        $field  = $this->input->post('field');
        $field  = smit_isset($field, '');
        $value  = $this->input->post('value');
        $value  = smit_isset($value, '');
        
        echo '<pre>';
        print_r($_POST);
        die();
        
        if( $field == 'be_dashboard_user' ){
            update_option('be_dashboard_user', $value);
        }elseif( $field == 'be_dashboard_juri' ){
            update_option('be_dashboard_juri', $value);
        }
    }
    
    // ---------------------------------------------------------------------------------------------
    // COMPANY
    /**
	 * List Company function.
	 */
	public function listcompany()
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
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));
        
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();'
        ));
        $scripts_add            = '';

        $data['title']          = TITLE . 'Daftar Perusahaan';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'company/list';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Detail Company function.
	 */
	public function detailcompany()
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

        $data['title']          = TITLE . 'Data Perusahaan';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'company/detail';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Setting Company function.
	 */
	public function settingcompany()
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
            BE_JS_PATH . 'pages/forms/editors.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/user/sign-up.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'Company.init();',
        ));

        $data['title']          = TITLE . 'Pengaturan Data Perusahaan';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'company/setting';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    // ---------------------------------------------------------------------------------------------
    // ANNOUNCEMENTS
    /**
	 * Detail Company function.
	 */
	public function announcements()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
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
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'AnnouncementValidation.init();',
            'AnnouncementSetting.init()',
        ));

        $data['title']          = TITLE . 'Pengumuman';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'announcements/announcements';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Announcement Add
	 */
	public function announcementadd()
	{
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $agree                  = $this->input->post('reg_agree');
        $agree                  = trim( smit_isset($agree, "") );
        
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Pengumuman','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi','required');
        $this->form_validation->set_rules('reg_agree','Setuju Pada Ketentuan','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran pengguna baru tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Agreement
        // -------------------------------------------------
        if( $agree != 'on' ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Anda harus menyetujui persyaratan formulir ini.'); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas panduan yang di unggah. Silahkan inputkan berkas panduan!'); 
            die(json_encode($data));
        }
        */
        
        if( !empty( $_POST ) ){
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/announcement/' . $current_user->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                
            $config = array(
                'upload_path'   => $upload_path,
                'allowed_types' => "doc|docx|pdf|xls|xlsx",
                'overwrite'     => FALSE,
                'max_size'      => "2048000", 
            );
            $this->upload->initialize($config);
                
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();
     
            if( !empty($_FILES['selection_files']['name']) ){
                if( ! $this->upload->do_upload('selection_files') ){
                    $message = $this->upload->display_errors();
                    
                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->upload->display_errors()); 
                    die(json_encode($data));
                }
                $upload_data    = $this->upload->data();
                $announcement_data  = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'user_id'       => $current_user->id,
                    'username'      => strtolower($current_user->username),
                    'name'          => $current_user->name,
                    'no_announcement'   => smit_generate_no_announcement(1, 'charup'),
                    'title'         => $title,
                    'url'           => smit_isset($upload_data['full_path'],''),
                    'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'      => smit_isset($upload_data['raw_name'],''),
                    'size'          => smit_isset($upload_data['file_size'],0),
                    'uploader'      => $current_user->id,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );        
            }else{
                $announcement_data  = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'user_id'       => $current_user->id,
                    'username'      => strtolower($current_user->username),
                    'name'          => $current_user->name,
                    'no_announcement'   => smit_generate_no_announcement(1, 'charup'),
                    'title'         => $title,
                    'desc'          => $description,
                    'uploader'      => $current_user->id,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );    
            }
                    
            // -------------------------------------------------
            // Save Announcement 
            // -------------------------------------------------
            $trans_save_announcement      = FALSE;
            if( $announcement_save_id   = $this->Model_Announcement->save_data_announcement($announcement_data) ){
                $trans_save_announcement  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran pengumuman tidak berhasil. Terjadi kesalahan data formulir anda'); 
                die(json_encode($data));
            }
                    
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_announcement ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran pengumuman tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran pengumuman baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'ANNOUNCEMENT_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran pengumuman tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
        }
	}
    
    /**
	 * Announcement list data function.
	 */
    function announcementlistdata(){
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
        
        $s_no_announcement  = $this->input->post('search_no_announcement');
        $s_no_announcement  = smit_isset($s_no_announcement, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_no_announcement) ){ $condition .= str_replace('%s%', $s_no_announcement, ' AND %no_announcement% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%no_announcement% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $announcement_list  = $this->Model_Announcement->get_all_announcements($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($announcement_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');
            
            $i = $offset + 1;
            foreach($announcement_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'" 
                    class="announdetailset btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_announ_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>
                    <a href="'.base_url('pengumuman/hapus/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a> ';
                
                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Download File"><i class="material-icons">file_download</i></a> ';    
                }else{
                    $btn_files  = ' - ';
                }

                $records["aaData"][] = array(
                    smit_center($i),
                    $row->no_announcement,
                    '<a href="'.base_url('upload/pengumuman/'.$row->uniquecode).'">' . $row->title . '</a>',
                    smit_center( $btn_files ),
                    smit_center( date('Y-m-d', strtotime($row->datecreated)) ),
                    smit_center( $btn_action ),
                );
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
	 * Announcement List Data function.
	 */
    function announcementuserlistdata(){
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
        
        $s_no_announcement  = $this->input->post('search_no_announcement');
        $s_no_announcement  = smit_isset($s_no_announcement, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_no_announcement) ){ $condition .= str_replace('%s%', $s_no_announcement, ' AND %no_announcment% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%datecreated% ' . $sort; }
        
        if( !empty($condition) ){
            $condition      = substr($condition, 4);
            $condition      = ' WHERE' . $condition;
        }
        
        $announcement_list  = $this->Model_Announcement->get_all_announcements($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($announcement_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $i = $offset + 1;
            foreach($announcement_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('pengumuman/'.$row->uniquecode).'" 
                    class="announcementdetails btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                $records["aaData"][] = array(
                    smit_center($i),
                    $row->no_announcement,
                    '<a href="'.base_url('pengumuman/'.$row->uniquecode).'"><strong>' . strtoupper($row->title) . '</strong></a>',
                    smit_center( $row->datecreated ),
                    smit_center($btn_action),
                );
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
    * Announcement Details function.
    */
    public function announcementdetails( $uniquecode='' ){
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));
        
        $scripts_add            = '';
        $scripts_init           = '';
        $announcementdata       = '';
        
        if( !empty($uniquecode) ){
            $announcementdata   = $this->Model_Announcement->get_announcement_by_uniquecode($uniquecode);
        }
        
        $data['title']          = TITLE . 'Detail Pengumuman';
        $data['announ_data']    = $announcementdata;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'announcements/announcementsdetails';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * Announcement Detail Incubation data function.
	 */
    function announcementdatadetails($id){
        
        // This is for AJAX request
    	//if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Check Auth Redirect
        //$auth = auth_redirect( $this->input->is_ajax_request() );
        //if( !$auth ){
            // Set JSON data
            //$data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            //die(json_encode($data));
        //}
          
        $current_user   = smit_get_current_user();
        $is_admin       = as_administrator($current_user);
        $content        = '';
        
        if( !$is_admin ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        if( !$id ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan pengumuman tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }
        
        $announcementdata   = $this->Model_Announcement->get_announcement_by_uniquecode($id);
        if( !$announcementdata ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Data pengaturan pengumuman tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        // Set JSON data
        $data = array('message' => 'success','data' => 'Data pengaturan pengumuman ditemukan','details' => $announcementdata);
        // JSON encode data
        die(json_encode($data));
    }
    
    // ---------------------------------------------------------------------------------------------
    
    
    // ---------------------------------------------------------------------------------------------
    // Guides Files
    // ---------------------------------------------------------------------------------------------
    
    /**
	 * Guides Files
	 */
	public function guides()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        if( !empty( $_POST ) ){
            $post = $_POST;
            if( empty($_FILES['guide_selection_files']['name']) ){
                $message = 'Tidak ada berkas panduan yang di unggah. Silahkan inputkan berkas panduan!';
            }else{
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/' . $current_user->id;
                if( !file_exists($upload_path) ) 
                {
                    mkdir($upload_path, 0777, TRUE);
                }
                
                $config = array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => "doc|docx|pdf|xls|xlsx",
                    'overwrite'     => FALSE,
                    'max_size'      => "2048000", 
                );
                $this->upload->initialize($config);
                
                if( ! $this->upload->do_upload('guide_selection_files') ){
                    $message = $this->upload->display_errors();
                }else{
                    $upload_data    = $this->upload->data();
                    $random         = smit_generate_rand_string(10,'low');
                    $guide_data     = array(
                        'uniquecode'    => $random,
                        'title'         => strtoupper( smit_isset($_POST['guide_title'],'') ),
                        'url'           => smit_isset($upload_data['full_path'],''),
                        'description'   => smit_isset($_POST['guide_description'],''),
                        'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                        'name'          => smit_isset($upload_data['raw_name'],''),
                        'size'          => smit_isset($upload_data['file_size'],0),
                        'uploader'      => $current_user->id,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    if( $this->Model_Guide->save_data_guide($guide_data) ){
                        $this->session->set_flashdata('success','Berkas panduan berhasil diupload');
                        redirect(base_url('guidefiles'));
                    }
                }
            }
        }
        
        $flashdata              = $this->session->flashdata('success');        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
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
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
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
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'Guides.init();',
            'GuidesValidation.init();',
        ));

        $data['title']          = TITLE . 'Berkas Panduan';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['message']        = $message;
        $data['flashdata']      = $flashdata;
        $data['post']           = $post;
        $data['main_content']   = 'guides';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Guides list data function.
	 */
    function guidelistdata(){
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
        
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_desc             = $this->input->post('search_desc');
        $s_desc             = smit_isset($s_desc, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_extension        = $this->input->post('search_extension');
        $s_extension        = smit_isset($s_extension, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_desc) )           { $condition .= str_replace('%s%', $s_desc, ' AND %description% = %s%'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_extension) )      { $condition .= str_replace('%s%', $s_extension, ' AND %extension% LIKE "%%s%%"'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%description% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%extension% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $guides_list        = $this->Model_Guide->get_all_guides($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($guides_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            
            $i = $offset + 1;
            foreach($guides_list as $row){
                if($row->extension == 'pdf')             { $extension = '<span class="label label-danger">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'doc')         { $extension = '<span class="label label-primary">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'docx')        { $extension = '<span class="label label-primary">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'xls')         { $extension = '<span class="label label-success">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'xlsx')        { $extension = '<span class="label label-success">'.strtoupper($row->extension).'</span>'; }
                
                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('guidefiles/'.$row->id).'">' . $row->title . '</a>',
                    $row->description,
                    '<a href="'.base_url('guidefiles/'.$row->id).'">' . $row->name . '</a>',
                    smit_center( $extension ),
                    smit_center( date('Y-m-d', strtotime($row->datecreated)) ),
                    '',
                );
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
	 * Guides Download File function.
	 */
    function guidesdownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }
        
        // Check Guide File Data
        $guidedata  = $this->Model_Guide->get_guide_by('uniquecode',$uniquecode);
        if( !$guidedata || empty($guidedata) ){
            redirect( current_url() );
        }

        $file_name      = $guidedata->name . '.' . $guidedata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationselection/' . $guidedata->uploader . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
    // ---------------------------------------------------------------------------------------------
    
    // ---------------------------------------------------------------------------------------------
    // SERVICES
    /**
	 * Services function.
	 */
	public function services()
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

        $data['title']          = TITLE . 'Data Perusahaan';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'services/service';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    // ---------------------------------------------------------------------------------------------
}

/* End of file backend.php */
/* Location: ./application/controllers/backend.php */