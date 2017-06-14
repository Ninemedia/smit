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
        $is_jury                = as_juri($current_user);
        
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
        
        $lss                    = smit_latest_praincubation_setting();
        $phase1                 = 0;
        $phase2                 = 0;
        
        if( !empty($is_jury) ){
            $jury_phase1            = $lss->selection_juri_phase1;
            $jury_phase1            = explode(',', $jury_phase1);
            foreach($jury_phase1 AS $id){
                if($id == $current_user->id){
                    $phase1         = ACTIVE;
                }
            }
            
            $jury_phase2            = $lss->selection_juri_phase2;
            $jury_phase2            = explode(',', $jury_phase2);
            foreach($jury_phase2 AS $id){
                if($id == $current_user->id){
                    $phase2         = ACTIVE;
                }
            }    
        }
        
        $status_inc_1           = '';
        $status_inc_2           = '';
        $status_pra_1           = '';
        $status_pra_2           = '';
        $step_inc_2             = 0;
        $step_pra_2             = 0;
        $data_incubation        = '';
        $data_praincubation     = '';
        if( as_pengusul($current_user) ){
            $data_incubation        = $this->Model_Incubation->get_all_incubation('', 0, ' WHERE user_id = '.$current_user->id.'');
            $data_praincubation     = $this->Model_Praincubation->get_all_praincubation('', 0, ' WHERE user_id = '.$current_user->id.'');
            
            if( !empty($data_incubation) ){
                $status_inc_1       = $data_incubation[0]->status;
                $status_inc_2       = $data_incubation[0]->statustwo;
                $step_inc_2         = $data_incubation[0]->steptwo;
            }
            
            if( !empty($data_praincubation) ){
                $status_pra_1       = $data_praincubation[0]->status;
                $status_pra_2       = $data_praincubation[0]->statustwo;
                $step_pra_2         = $data_praincubation[0]->steptwo;
            }
        }

        $data['title']          = TITLE . 'Beranda';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['phase1']         = $phase1;
        $data['phase2']         = $phase2;
        $data['status_inc_1']   = $status_inc_1;
        $data['status_inc_2']   = $status_inc_2;
        $data['status_pra_1']   = $status_pra_1;
        $data['status_pra_2']   = $status_pra_2;
        $data['step_pra_2']     = $step_pra_2;
        $data['data_incubation']    = $data_incubation;
        $data['data_praincubation'] = $data_praincubation;
        $data['lss']            = $lss;
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/forms/editors.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'SettingValidation.init();',
            'Setting.init();',
            'SliderValidation.init()',
        ));

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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/forms/editors.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'SettingValidation.init();',
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
                
        if( $field == 'be_dashboard_user' ){
            update_option('be_dashboard_user', $value);
        }elseif( $field == 'be_dashboard_juri' ){
            update_option('be_dashboard_juri', $value);
        }elseif( $field == 'be_dashboard_pendamping' ){
            update_option('be_dashboard_pendamping', $value);
        }elseif( $field == 'be_dashboard_tenant' ){
            update_option('be_dashboard_tenant', $value);
        }elseif( $field == 'be_dashboard_pelaksana' ){
            update_option('be_dashboard_pelaksana', $value);
        }elseif( $field == 'be_notif_praincubation_confirm' ){
            update_option('be_notif_praincubation_confirm', $value);
        }elseif( $field == 'be_notif_praincubation_confirm2' ){
            update_option('be_notif_praincubation_confirm2', $value);
        }elseif( $field == 'be_notif_praincubation_not_success' ){
            update_option('be_notif_praincubation_not_success', $value);
        }elseif( $field == 'be_notif_praincubation_not_success2' ){
            update_option('be_notif_praincubation_not_success2', $value);
        }elseif( $field == 'be_notif_praincubation_success' ){
            update_option('be_notif_praincubation_success', $value);
        }elseif( $field == 'be_notif_praincubation_accepted' ){
            update_option('be_notif_praincubation_accepted', $value);
        }elseif( $field == 'be_notif_incubation_not_success' ){
            update_option('be_notif_incubation_not_success', $value);
        }elseif( $field == 'be_notif_incubation_not_success2' ){
            update_option('be_notif_incubation_not_success2', $value);
        }elseif( $field == 'be_notif_incubation_success' ){
            update_option('be_notif_incubation_success', $value);
        }elseif( $field == 'be_notif_incubation_accepted' ){
            update_option('be_notif_incubation_accepted', $value);
        }elseif( $field == 'be_notif_registration_selection' ){
            update_option('be_notif_registration_selection', $value);
        }elseif( $field == 'be_notif_registration_user' ){
            update_option('be_notif_registration_user', $value);
        }elseif( $field == 'be_notif_registration_juri' ){
            update_option('be_notif_registration_juri', $value);
        }elseif( $field == 'be_notif_rated_selection' ){
            update_option('be_notif_rated_selection', $value);
        }
    }
    
    /**
	 * Update Setting Frontend function.
	 */
    function updatesettingfrontend()
    {
        $field  = $this->input->post('field');
        $field  = smit_isset($field, '');
        $value  = $this->input->post('value');
        $value  = smit_isset($value, '');
        
        if( $field == 'be_frontend_praincubation' ){
            update_option('be_frontend_praincubation', $value);
        }elseif( $field == 'be_frontend_incubation' ){
            update_option('be_frontend_incubation', $value);
        }elseif( $field == 'be_frontend_praincubation_note' ){
            update_option('be_frontend_praincubation_note', $value);
        }elseif( $field == 'be_frontend_incubation_note' ){
            update_option('be_frontend_incubation_note', $value);
        }elseif( $field == 'be_frontend_profil' ){
            update_option('be_frontend_profil', $value);
        }elseif( $field == 'be_frontend_task' ){
            update_option('be_frontend_task', $value);
        }elseif( $field == 'be_frontend_function' ){
            update_option('be_frontend_function', $value);
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            
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
        
        /*
        $agree                  = $this->input->post('reg_agree');
        $agree                  = trim( smit_isset($agree, "") );
        */
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Pengumuman','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi','required');
        //$this->form_validation->set_rules('reg_agree','Setuju Pada Ketentuan','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran pengumuman tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Agreement
        // -------------------------------------------------
        /*
        if( $agree != 'on' ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Anda harus menyetujui persyaratan formulir ini.'); 
            die(json_encode($data));
        }
        */
        
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
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
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
                $btn_action = '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'" 
                    class="announcementdetails btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                $records["aaData"][] = array(
                    smit_center($i),
                    $row->no_announcement,
                    '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'"><strong>' . strtoupper($row->title) . '</strong></a>',
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
    // WORK UNIT
    /**
	 * Detail Company function.
	 */
	public function workunit()
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            
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
            'SettingValidation.init();',
        ));

        $data['title']          = TITLE . 'Satuan Kerja';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'setting/workunit';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Workunit list data function.
	 */
    function workunitlistdata(){
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
        
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        
        if( !empty($s_workunit) )   { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit_name% LIKE "%%s%%"'); }
        if( $column == 1 )          { $order_by .= '%workunit_name% ' . $sort; }
        $workunit_list      = $this->Model_Option->get_all_workunit($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($workunit_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            
            $i = $offset + 1;
            foreach($workunit_list as $row){
                
                // Status
                $btn_action = '<a data-toggle="modal" data-target="#edit_workunit" class="inact btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
                <a href="'.($row->workunit_id>1 ? base_url('workunitconfirm/delete/'.$row->workunit_id) : 'javascript:;' ).'" class="workunitdelete btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus" '.($row->workunit_id==0 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                $records["aaData"][] = array(
                    smit_center($i),
                    $row->workunit_name,
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
	 * Workunit Add
	 */
	public function workunitadd()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $workunit               = $this->input->post('reg_workunit');
        $workunit                  = trim( smit_isset($workunit, "") );
        
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_workunit','Nama Satuan Kerja','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran satuan kerja tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();
         
        $workunit_data  = array(
            'workunit_name' => $workunit,
        ); 
                
        // -------------------------------------------------
        // Save Workunit 
        // -------------------------------------------------
        $trans_save_workunit        = FALSE;
        if( $workunit_save_id       = $this->Model_Option->save_data_workunit($workunit_data) ){
            $trans_save_workunit    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran satuan kerja tidak berhasil. Terjadi kesalahan data formulir anda'); 
            die(json_encode($data));
        }
                
        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_workunit ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Pendaftaran satuan kerja tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();
                
                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Pendaftaran satuan kerja baru berhasil!'); 
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran satuan kerja tidak berhasil. Terjadi kesalahan data.'); 
            die(json_encode($data)); 
        } 
	}
    
    /**
	 * Workunit Delete function.
	 */
    function workunitconfirm($action, $id){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };
        
        if ( !$id ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'ID satuan kerja harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };
        
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Hapus Satuan Kerja  hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };
        
        $workunitdata       = smit_get_workunitdata_by_id($id);
        if( !$workunitdata ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data satuan kerja tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        if( $this->Model_Option->delete_workunit($workunitdata->workunit_id) ){
            // Set JSON data
            $data = array('msg' => 'success','message' => 'data satuan kerja berhasil dihapus.');
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Hapus data satuan kerja tidak berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }
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
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/guide/' . $current_user->id;
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
                        redirect(base_url('panduan/berkas'));
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
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_desc) )           { $condition .= str_replace('%s%', $s_desc, ' AND %description% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%description% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $guides_list        = $this->Model_Guide->get_all_guides($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($guides_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            
            $i = $offset + 1;
            foreach($guides_list as $row){
                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('unduh/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Download File"><i class="material-icons">file_download</i></a> ';    
                }else{
                    $btn_files  = ' - ';
                }
                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('guidefiles/'.$row->id).'">' . $row->title . '</a>',
                    $row->description,
                    smit_center( $btn_files ),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
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
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/guide/' . $guidedata->uploader . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
    // ---------------------------------------------------------------------------------------------
    
    
    
    // ---------------------------------------------------------------------------------------------
    // NEWS
    /**
	 * List News function.
	 */
	public function news()
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            
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
            'NewsValidation.init();',
        ));

        $data['title']          = TITLE . 'Berita';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'news/news';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * News Add
	 */
	public function newsadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $source                 = $this->input->post('reg_source');
        $source                 = trim( smit_isset($source, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Berita','required');
        $this->form_validation->set_rules('reg_source','Sumber Berita','required');
        $this->form_validation->set_rules('reg_desc','Isi Berita','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran berita tidak berhasil. '.validation_errors().''); 
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
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/news/' . $current_user->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                
            $config = array(
                'upload_path'   => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'     => FALSE,
                'max_size'      => "2048000", 
            );
            $this->upload->initialize($config);

            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();
            
            if( !empty($_FILES['news_selection_files']['name']) ){
                if( ! $this->upload->do_upload('news_selection_files') ){
                    $message = $this->upload->display_errors();
                    
                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->upload->display_errors()); 
                    die(json_encode($data));
                }
                
                $upload_data    = $this->upload->data();
                $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
                $thumbnail      = 'Thumbnail_' . $upload_data['raw_name'];
                $thumbfile      = $thumbnail . $upload_data['file_ext'];
                
                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(1140,400)->save($upload_path. '/' .$upload_file, TRUE);
                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$thumbfile, TRUE);
                $this->image_moo->clear();
                 
                $news_data      = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'user_id'       => $current_user->id,
                    'username'      => strtolower($current_user->username),
                    'name'          => $current_user->name,
                    'no_news'       => smit_generate_no_news(1, 'charup'),
                    'title'         => $title,
                    'source'        => $source,
                    'desc'          => $description,
                    'url'           => smit_isset($upload_data['full_path'],''),
                    'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'      => smit_isset($upload_data['raw_name'],''),
                    'thumbnail'     => smit_isset($thumbnail,''),
                    'size'          => smit_isset($upload_data['file_size'],0),
                    'uploader'      => $current_user->id,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );
            }else{
                $news_data  = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'user_id'       => $current_user->id,
                    'username'      => strtolower($current_user->username),
                    'name'          => $current_user->name,
                    'no_news'       => smit_generate_no_news(1, 'charup'),
                    'title'         => $title,
                    'source'        => $source,
                    'desc'          => $description,
                    'uploader'      => $current_user->id,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );    
            }
                    
            // -------------------------------------------------
            // Save News 
            // -------------------------------------------------
            $trans_save_news        = FALSE;
            if( $news_save_id       = $this->Model_News->save_data_news($news_data) ){
                $trans_save_news    = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran berita tidak berhasil. Terjadi kesalahan data formulir anda'); 
                die(json_encode($data));
            }
                    
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_news ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran berita tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran berita baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'NEWS_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran berita tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
        }
	}
    
    /**
	 * News list data function.
	 */
    function newslistdata(){
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
        
        $s_no_news          = $this->input->post('search_no_news');
        $s_no_news          = smit_isset($s_no_news, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_source           = $this->input->post('search_source');
        $s_source           = smit_isset($s_source, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_no_news) )        { $condition .= str_replace('%s%', $s_no_news, ' AND %no_announcement% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_source) )         { $condition .= str_replace('%s%', $s_source, ' AND %source% LIKE "%%s%%"'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%no_news% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%source% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $news_list          = $this->Model_News->get_all_news($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($news_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');
            
            $i = $offset + 1;
            foreach($news_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('berita/detail/'.$row->uniquecode).'" 
                    class="newsdetailset btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_news_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>
                    <a href="'.base_url('berita/hapus/'.$row->uniquecode).'" 
                    class="news btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a> ';
                
                $records["aaData"][] = array(
                    smit_center($i),
                    $row->no_news,
                    '<a href="'.base_url('berita/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $row->source,
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
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
    * News Details function.
    */
    public function newsdetails( $uniquecode='' ){
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
        $newsdata               = '';
        
        if( !empty($uniquecode) ){
            $newsdata           = $this->Model_News->get_news_by_uniquecode($uniquecode);
        }
        
        $uploaded           = $newsdata->uploader;
        
        if($uploaded != 0){
            $file_name      = $newsdata->filename . '.' . $newsdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'news/'. $newsdata->uploader . '/' . $file_name; 
            $news           = $file_url;
        }else{
            $news           = BE_IMG_PATH . 'news/noimage.jpg';       
        }
        
        $data['title']          = TITLE . 'Detail Berita';
        $data['news_data']      = $newsdata;
        $data['news_image']     = $news;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'news/newsdetail';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    // ---------------------------------------------------------------------------------------------
    // SLIDER SETTING
    /**
	 * Slider Add
	 */
	public function slideradd()
	{
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
        
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Slider','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Slider','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran slider tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['slider_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada gambar slider yang di unggah. Silahkan inputkan gambar slider!'); 
            die(json_encode($data));
        }
        
        if( !empty( $_POST ) ){
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/frontend/images/slider';
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                
            $config = array(
                'upload_path'   => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'     => FALSE,
                'max_size'      => "2048000", 
            );
            $this->upload->initialize($config);

            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();
            if( !empty($_FILES['slider_selection_files']['name']) ){
                if( ! $this->upload->do_upload('slider_selection_files') ){
                    $message = $this->upload->display_errors();
                    
                    // Set JSON data
                    //$data = array('message' => 'error','data' => $this->upload->display_errors()); 
                    //die(json_encode($data));
                }
                
                $upload_data    = $this->upload->data();
                $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
                
                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
                $this->image_moo->clear();
                 
                $slider_data        = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'user_id'       => $current_user->id,
                    'username'      => strtolower($current_user->username),
                    'name'          => $current_user->name,
                    'title'         => $title,
                    'desc'          => $description,
                    'url'           => smit_isset($upload_data['full_path'],''),
                    'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'      => smit_isset($upload_data['raw_name'],''),
                    'size'          => smit_isset($upload_data['file_size'],0),
                    'uploader'      => $current_user->id,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );
            }
            
            // -------------------------------------------------
            // Save Slider 
            // -------------------------------------------------
            $trans_save_slider      = FALSE;
            if( $slider_save_id     = $this->Model_Slider->save_data_slider($slider_data) ){
                $trans_save_slider    = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran slider tidak berhasil. Terjadi kesalahan data formulir anda'); 
                die(json_encode($data));
            }
                    
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_slider ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran slider tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran slider baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'SLIDER_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran slider tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
        }
	}
    
    /**
	 * Slider list data function.
	 */
    function sliderlistdata(){
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
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $slider_list        = $this->Model_Slider->get_all_slider($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($slider_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');
            
            $i = $offset + 1;
            foreach($slider_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('slider/detail/'.$row->uniquecode).'" 
                    class="sliderdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_slider_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_action .= ' ';
                if($row->status == NONACTIVE)   { 
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     .= '<a href="'.base_url('sliderconfirm/active/'.$row->uniquecode).'" class="sliderconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == ACTIVE)  { 
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     .= '
                    <a href="'.($row->user_id == 1 ? base_url('sliderconfirm/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="sliderconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Ubah" '.($row->user_id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">edit</i></a> 
                    <a href="'.($row->user_id == 1 ? base_url('sliderconfirm/banned/'.$row->uniquecode) : 'javascript:;' ).'" class="sliderconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Banned" '.($row->user_id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">block</i></a> 
                    <a href="'.($row->user_id == 1 ? base_url('sliderconfirm/delete/'.$row->uniquecode) : 'javascript:;' ).'" class="sliderconfirm btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Hapus" '.($row->user_id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                }
                elseif($row->status == BANNED)  { 
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     .= '<a href="'.base_url('sliderconfirm/active/'.$row->uniquecode).'" class="sliderconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == DELETED) { 
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     .= '<a href="'.base_url('sliderconfirm/active/'.$row->uniquecode).'" class="sliderconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                
                $uploaded           = $row->uploader;
                if($uploaded != 0){
                    $file_name      = $row->filename . '.' . $row->extension;
                    $file_url       = FE_IMG_PATH . 'slider/' . $file_name; 
                    $slider         = $file_url;
                    $slider         = '<img class="js-animating-object img-responsive" src="'.$slider.'" alt="'.$row->title.'" />';
                }
                
                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('slider/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $slider,
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
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
	 * Slider confirm function.
	 */
    function sliderconfirm($action, $uniquecode){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };
        
        if ( !$uniquecode ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Uniquecode harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };
        
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Slider hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };
        
        $sliderdata         = $this->Model_Slider->get_slider_by_uniquecode($uniquecode);
        if( !$sliderdata ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data slider tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        $curdate = date('Y-m-d H:i:s');
        if( $action=='active' )     { $status = ACTIVE; }
        elseif( $action=='banned' ) { $status = BANNED; }
        elseif( $action=='delete' ) { $status = DELETED; }
        
        $data_update = array('status'=>$status, 'datemodified'=>$curdate);
        if( $this->Model_Slider->update_slider($uniquecode,$data_update) ){
            // Set JSON data
            $data = array('msg' => 'success','message' => 'Konfirmasi data slider berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data slider tidak berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    /**
    * Slider Details function.
    */
    public function sliderdetails( $uniquecode='' ){
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
        $sliderdata             = '';
        
        if( !empty($uniquecode) ){
            $sliderdata         = $this->Model_Slider->get_slider_by_uniquecode($uniquecode);
        }
        
        $uploaded           = $sliderdata->uploader;
        if($uploaded != 0){
            $file_name      = $sliderdata->filename . '.' . $sliderdata->extension;
            $file_url       = FE_IMG_PATH . 'slider/' . $file_name; 
            $slider         = $file_url;
        }
        
        $cfg_status     = config_item('user_status');
        if($sliderdata->status == NONACTIVE)   { 
            $status         = '<span class="label label-default">'.strtoupper($cfg_status[$sliderdata->status]).'</span>'; 
        }elseif($sliderdata->status == ACTIVE)  { 
            $status         = '<span class="label label-success">'.strtoupper($cfg_status[$sliderdata->status]).'</span>'; 
        }elseif($sliderdata->status == BANNED)  { 
            $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$sliderdata->status]).'</span>'; 
        }elseif($sliderdata->status == DELETED) { 
            $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$sliderdata->status]).'</span>'; 
        }
        
        $data['title']          = TITLE . 'Detail Slider';
        $data['slider_data']    = $sliderdata;
        $data['slider_image']   = $slider;
        $data['user']           = $current_user;
        $data['status']         = $status;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'setting/frontendsetting/sliderdetail';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    // ---------------------------------------------------------------------------------------------
    // SERVICE
    /**
	 * Contact Message function.
	 */
	public function generalmessage()
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            
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
        ));

        $data['title']          = TITLE . 'Pesan Umum';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'services/generalmessage';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * General Message list data function.
	 */
    function generalmessagelistdata(){
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
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_email            = $this->input->post('search_email');
        $s_email            = smit_isset($s_email, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_email) )          { $condition .= str_replace('%s%', $s_email, ' AND %email% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%email% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $generalmessage_list  = $this->Model_Service->get_all_contact_message($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($generalmessage_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status_message');
            
            $i = $offset + 1;
            foreach($generalmessage_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('pesanumum/detail/'.$row->uniquecode).'" 
                    class="announdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_announ_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                /*
                    <a href="'.base_url('pesanumum/hapus/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-danger waves-effect tooltips" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a>
                */
                if($row->status == UNREAD )   { 
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    //$btn_action     .= '<a href="'.base_url('generalmessageconfirm/active/'.$row->id).'" class="generalmessageconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == READ)  { 
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     .= '
                    <a href="'.($row->id>1 ? base_url('generalmessageconfirm/banned/'.$row->id) : 'javascript:;' ).'" class="generalmessageconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Banned" '.($row->id==1 ? 'disabled="disabled"' : '').'><i class="material-icons">block</i></a> 
                    <a href="'.($row->id>1 ? base_url('generalmessageconfirm/delete/'.$row->id) : 'javascript:;' ).'" class="generalmessageconfirm btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Deleted" '.($row->id==1 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                }
                /*
                elseif($row->status == BANNED)  { 
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == DELETED) { 
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                */

                $records["aaData"][] = array(
                    smit_center($i),
                    strtoupper( $row->name ),
                    '<a href="'.base_url('pesanumum/detail/'.$row->uniquecode).'">' . $row->title . '</a>',
                    $row->email,
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
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
    * General Message Details function.
    */
    public function generalmessagedetails( $uniquecode='' ){
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
        $generalmessagedata     = '';
        
        if( !empty($uniquecode) ){
            $generalmessagedata   = $this->Model_Service->get_contact_message_by_uniquecode($uniquecode);
        }
        
        $data['title']          = TITLE . 'Detail Pesan Umum';
        $data['generalmessage_data']    = $generalmessagedata;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'services/generalmessagedetails';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }

    /**
	 * Services function.
	 */
	public function services()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);
        $is_pengusul            = as_pengusul($current_user);
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
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
            'ServicesValidation.init();',
        ));

        $data['title']          = TITLE . 'Komunikasi dan Bantuan';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pengusul']    = $is_pengusul;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['message']        = $message;
        $data['flashdata']      = $flashdata;
        $data['post']           = $post;
        $data['main_content']   = 'services/communication';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * General Message list data function.
	 */
    function communicationdata( $value ){
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
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_desc             = $this->input->post('search_desc');
        $s_desc             = smit_isset($s_desc, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_desc) )           { $condition .= str_replace('%s%', $s_email, ' AND %desc% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%desc% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        
        if( $is_admin ){
            if($value == 'in'){
                $condition  = ' WHERE to_id = 1';
            }else{
                $condition  = ' WHERE from_id = 1';
            }
        }else{
            if($value == 'in'){
                $condition  = ' WHERE to_id = '.$current_user->id.'';
            }else{
                $condition  = ' WHERE from_id = '.$current_user->id.'';
            }
        }
        
        $communication_list = $this->Model_Service->get_all_communication($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($communication_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status_message');
            
            $i = $offset + 1;
            foreach($communication_list as $row){
                // Status
                
                if($row->status == UNREAD )   { 
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    if( !$is_admin && $value == 'out'){
                        $btn_action = '';
                    }else{
                        $btn_action     = '<a href="'.base_url('communicationconfirm/active/'.$row->id).'" class="communicationconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Balas"><i class="material-icons">reply</i></a> ';
                    } 
                }
                elseif($row->status == READ)  { 
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '
                    <a href="'.($row->id>1 ? base_url('communicationconfirm/banned/'.$row->id) : 'javascript:;' ).'" class="communicationconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Banned" '.($row->id==1 ? 'disabled="disabled"' : '').'><i class="material-icons">block</i></a> 
                    <a href="'.($row->id>1 ? base_url('communicationconfirm/delete/'.$row->id) : 'javascript:;' ).'" class="communicationconfirm btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Deleted" '.($row->id==1 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a> ';
                }
                /*
                elseif($row->status == BANNED)  { 
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == DELETED) { 
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                */
                $btn_action .= '<a href="'.base_url('komunikasibantuan/detail/'.$row->uniquecode).'" 
                    class="announdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_announ_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                /*
                    <a href="'.base_url('pesanumum/hapus/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-danger waves-effect tooltips" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a>
                */
                
                $name           = $row->name;
                $title          = $row->title;
                $desc           = $row->desc;
                $datecreated    = $row->datecreated;
                if( $row->status == UNREAD ){
                    $name       = '<strong style="color : red !important; ">'.$name.'</strong>'; 
                    $title      = '<strong style="color : red !important; ">'.$title.'</strong>'; 
                    $desc       = '<strong style="color : red !important; ">'.$desc.'</strong>'; 
                    $datecreated= '<strong style="color : red !important; ">'.date('d F Y H:i:s', strtotime($datecreated)).'</strong>'; 
                }
                
                if( !empty($is_admin) ){
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper( $name ),
                        '<a href="'.base_url('komunikasibantuan/detail/'.$row->uniquecode).'">' . $title . '</a>',
                        $desc,
                        smit_center( $status ),
                        smit_center( $datecreated ),
                        smit_center( $btn_action ),  
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center($i),
                        '<a href="'.base_url('komunikasibantuan/detail/'.$row->uniquecode).'">' . $title . '</a>',
                        $desc,
                        smit_center( $status ),
                        smit_center( $datecreated ),
                        smit_center( $btn_action ),   
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
    * Communication Details function.
    */
    public function communicationdetails( $uniquecode='' ){
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
            'ServicesValidation.init();',
        ));
        $communicationdata      = '';
        
        if( !empty($uniquecode) ){
            $communicationdata  = $this->Model_Service->get_communication_by_uniquecode($uniquecode);
            if( $is_admin ){
                if($communicationdata->status == UNREAD){
                    $update_data        = $this->Model_Service->update_communication($uniquecode, array('status' => READ));    
                }    
            }
        }
        
        $data['title']          = TITLE . 'Detail Komunikasi dan Bantuan';
        $data['communication_data']    = $communicationdata;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'services/communicationdetails';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * Communication Add
	 */
	public function communicationadd()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $to_id                  = 1; //Admin
        if( $is_admin ){
            $user_id            = $this->input->post('user_id');
            $user_id            = trim( smit_isset($user_id, "") );
            $to_id              = $user_id;    
        }
        
        $title                  = $this->input->post('cmm_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('cmm_description');
        $description            = trim( smit_isset($description, "") );
        
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('cmm_title','Judul Komunikasi dan Banruan','required');
        $this->form_validation->set_rules('cmm_description','Deskripsi Komunikasi dan Bantuan','required');
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran komunikasi dan bantuan tidak berhasil. '.validation_errors().''); 
            die(json_encode($data));
        }
        
        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();
            $communication_data  = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'user_id'       => $current_user->id,
                'from_id'       => $current_user->id,
                'to_id'         => $to_id,
                'username'      => strtolower($current_user->username),
                'name'          => $current_user->name,
                'title'         => $title,
                'desc'          => $description,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );  
                    
            // -------------------------------------------------
            // Save Communication 
            // -------------------------------------------------
            $trans_save_communication       = FALSE;
            if( $communication_save_id      = $this->Model_Service->save_data_communication($communication_data) ){
                $trans_save_communication   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran komunikasi dan bantuan tidak berhasil. Terjadi kesalahan data formulir anda'); 
                die(json_encode($data));
            }
                    
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_communication ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran komunikasi dan bantuan tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran komunikasi dan bantuan baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'COMMUNICATION_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'title'=> $title)) );
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
    
}

/* End of file backend.php */
/* Location: ./application/controllers/backend.php */