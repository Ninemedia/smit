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
        $incss                  = smit_latest_incubation_setting();
        $phase1                 = 0;
        $phase2                 = 0;
        $phaseinc1              = 0;
        $phaseinc2              = 0;

        if( !empty($is_jury) ){
            if( !empty($lss) ){
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
            
            if( !empty($incss) ){
                $jury_phase1            = $incss->selection_juri_phase1;
                $jury_phase1            = explode(',', $jury_phase1);
                foreach($jury_phase1 AS $id){
                    if($id == $current_user->id){
                        $phaseinc1      = ACTIVE;
                    }
                }

                $jury_phase2            = $incss->selection_juri_phase2;
                $jury_phase2            = explode(',', $jury_phase2);
                foreach($jury_phase2 AS $id){
                    if($id == $current_user->id){
                        $phaseinc2      = ACTIVE;
                    }
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

        // IKM data Admin
        $sangat_setuju      = 0;
        $setuju             = 0;
        $tidak_setuju       = 0;
        $sangat_tidak_setuju= 0;
        $mutu               = ' - ';
        $kinerja            = ' - ';
        $ikm                = '';

        if( !empty($is_admin) ){
            $sangat_setuju  = $this->Model_Service->count_all_answer(0, SANGAT_SETUJU);
            $setuju         = $this->Model_Service->count_all_answer(0, SETUJU);
            $tidak_setuju   = $this->Model_Service->count_all_answer(0, TIDAK_SETUJU);
            $sangat_tidak_setuju    = $this->Model_Service->count_all_answer(0, SANGAT_TIDAK_SETUJU);

            $total_ikmlist  = $this->Model_Service->count_all_ikmlist();
            $penimbang      = $total_ikmlist > 0 ? number_format(1/$total_ikmlist, 3) : 0;
            $penimbang_full = ($penimbang * 100) * 100;

            $ikm            = smit_get_total_ikm();
            $ikm            = $total_ikmlist > 0 ? $ikm/$total_ikmlist : 0;
            $ikm            = floor($ikm);

            if($ikm <= floor($penimbang_full*45/100)){
                $mutu       = 'D';
                $kinerja    = 'Tidak Baik';
            }elseif($ikm > floor($penimbang_full*45/100) && $ikm <= floor($penimbang_full*65/100)){
                $mutu       = 'C';
                $kinerja    = 'Kurang Baik';
            }elseif($ikm > floor($penimbang_full*65/100) && $ikm <= floor($penimbang_full*85/100)){
                $mutu       = 'B';
                $kinerja    = 'Baik';
            }elseif($ikm > floor($penimbang_full*85/100) && $ikm <= $penimbang_full){
                $mutu       = 'A';
                $kinerja    = 'Sangat Baik';
            }
        }

        $data['title']          = TITLE . 'Beranda';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;

        //Data IKM
        $data['sangat_setuju']  = $sangat_setuju;
        $data['setuju']         = $setuju;
        $data['tidak_setuju']   = $tidak_setuju;
        $data['sangat_tidak_setuju']    = $sangat_tidak_setuju;
        $data['ikm']            = $ikm;
        $data['mutu']           = $mutu;
        $data['kinerja']        = $kinerja;

        $data['phase1']         = $phase1;
        $data['phase2']         = $phase2;
        $data['phaseinc1']      = $phaseinc1;
        $data['phaseinc2']      = $phaseinc2;
        $data['status_inc_1']   = $status_inc_1;
        $data['status_inc_2']   = $status_inc_2;
        $data['status_pra_1']   = $status_pra_1;
        $data['status_pra_2']   = $status_pra_2;
        $data['step_pra_2']     = $step_pra_2;
        $data['data_incubation']    = $data_incubation;
        $data['data_praincubation'] = $data_praincubation;
        $data['lss']            = $lss;
        $data['incss']          = $incss;
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

        // Dashboard Setting
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
            
        // Pra-Incubation Notif Setting
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
            
        // Incubation Notif Setting
        }elseif( $field == 'be_notif_incubation_confirm' ){
            update_option('be_notif_incubation_confirm', $value);
        }elseif( $field == 'be_notif_incubation_confirm2' ){
            update_option('be_notif_incubation_confirm2', $value);
        }elseif( $field == 'be_notif_incubation_not_success' ){
            update_option('be_notif_incubation_not_success', $value);
        }elseif( $field == 'be_notif_incubation_not_success2' ){
            update_option('be_notif_incubation_not_success2', $value);
        }elseif( $field == 'be_notif_incubation_success' ){
            update_option('be_notif_incubation_success', $value);
        }elseif( $field == 'be_notif_incubation_accepted' ){
            update_option('be_notif_incubation_accepted', $value);
            
        // Registration Notif Setting
        }elseif( $field == 'be_notif_registration_selection' ){
            update_option('be_notif_registration_selection', $value);
        }elseif( $field == 'be_notif_registration_pengusul' ){
            update_option('be_notif_registration_pengusul', $value);
        }elseif( $field == 'be_notif_registration_user' ){
            update_option('be_notif_registration_user', $value);
        }elseif( $field == 'be_notif_registration_juri' ){
            update_option('be_notif_registration_juri', $value);
        }elseif( $field == 'be_notif_registration_for_admin' ){
            update_option('be_notif_registration_for_admin', $value);
        }elseif( $field == 'be_notif_selection_for_admin' ){
            update_option('be_notif_selection_for_admin', $value);
            
        // Rated Notif Setting
        }elseif( $field == 'be_notif_rated_selection' ){
            update_option('be_notif_rated_selection', $value);
            
        // Forgot Password Notif Setting
        }elseif( $field == 'be_notif_forgot_password' ){
            update_option('be_notif_forgot_password', $value);
        
        // Contact Notif Setting
        }elseif( $field == 'be_notif_contact' ){
            update_option('be_notif_contact', $value);
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

    /**
	 * View Mail Template function.
	 */
    function viewmailtemplate()
    {
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Set POST field
        $content    = $this->input->post('content');
        $content    = smit_isset($content, '');
        // Get Opt Mail Content
        $mail       = get_option($content);
        if( !$mail ) $mail = '';

        // Return Mail Content
        if( $content == "be_notif_forgot_password" || $content == "be_notif_contact" ){
            $template   = smit_notification_template_clear($mail);
        }else{
            $template   = smit_notification_template($mail);
        }
        die( $template );
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
                    
                    // Set Log Data
                    smit_log( 'ANNOUNCEMENT_REG', 'SUCCESS', maybe_serialize(array('username'=>$current_user->username, 'url'=> smit_isset($upload_data['full_path'],''))) );

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran pengumuman baru berhasil!');
                    die(json_encode($data));
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

        //if( $column == 1 )      { $order_by .= '%no_announcement% ' . $sort; }
        if( $column == 1 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }

        $announcement_list  = $this->Model_Announcement->get_all_announcements($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($announcement_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($announcement_list as $row){
                // Button
                $btn_action = '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'"
                    class="announdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_announ_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';

                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips" data-placement="left" title="Download File"><i class="material-icons">file_download</i></a> ';
                }else{
                    $btn_files  = ' - ';
                }

                $records["aaData"][] = array(
                    smit_center('<input name="announcementlist[]" class="cblist filled-in chk-col-blue" id="cblist_announcement'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist_announcement'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    //$row->no_announcement,
                    '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'">' . $row->title . '</a>',
                    smit_center( $btn_files ),
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $announcementlist       = $_REQUEST['announcementlist'];

            $proses                 = $this->announcementdelete($sGroupActionName, $announcementlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Announcement Delete function.
	 */
    function announcementdelete($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            $announcementdelete     = $this->Model_Announcement->delete_announcement($uniquecode);
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar pengumuman data selesai di proses',
        );
        return $response;
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

        if( $column == 1 )              { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 2 )          { $order_by .= '%title% ' . $sort; }

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
                
                if( !empty($is_amin) ){
                    $records["aaData"][] = array(
                        smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                        <label for="cblist'.$row->id.'"></label>'),
                        smit_center($i),
                        $row->no_announcement,
                        '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'"><' . $row->title . '</a>',
                        smit_center( date('d F Y H:i:s', strtotime($row->datecreated) ) ),
                        smit_center($btn_action),
                    );    
                }else{
                    $records["aaData"][] = array(
                        smit_center($i),
                        smit_center( date('d F Y H:i:s', strtotime($row->datecreated) ) ),
                        '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'">' . $row->title . '</a>',
                        smit_center($btn_action),
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
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        if( !empty($s_workunit) )   { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit_name% LIKE "%%s%%"'); }
        if( !empty($s_status) )     { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if( $column == 2 )          { $order_by .= '%workunit_name% ' . $sort; }
        elseif( $column == 3 )      { $order_by .= '%status% ' . $sort; }
        
        $workunit_list      = $this->Model_Option->get_all_workunit($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($workunit_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($workunit_list as $row){
                $status     = "LIPI";
                if( $row->status == 0 ){
                    $status = "NON LIPI";
                }
                
                // Button
                $btn_action = '<a class="workunitedit btn btn-xs btn-warning waves-effect tooltips" data-placement="left" data-id="'.$row->workunit_id.'" data-name="'.$row->workunit_name.'" data-status="'.$row->status.'" title="Ubah"><i class="material-icons">edit</i></a>';
                $records["aaData"][] = array(
                    smit_center('<input name="workunitlist[]" class="cblist filled-in chk-col-blue" id="cblist_workunit'.$row->workunit_id.'" value="' . $row->workunit_id . '" type="checkbox"/>
                    <label for="cblist_workunit'.$row->workunit_id.'"></label>'),
                    smit_center($i),
                    $row->workunit_name,
                    smit_center($status),
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $workunitlist           = $_REQUEST['workunitlist'];

            $proses                 = $this->workunitdelete($sGroupActionName, $workunitlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }


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
        $workunit               = trim( smit_isset($workunit, "") );
        $status                 = $this->input->post('reg_status');
        $status                 = trim( smit_isset($status, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_workunit','Nama Satuan Kerja','required');
        $this->form_validation->set_rules('reg_status','Status Satuan Kerja','required');

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
            'workunit_slug' => smit_slug($workunit),
            'status'        => $status
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
	 * Workunit Edit
	 */
	public function workunitedit()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $workunit_id            = $this->input->post('reg_id_workunit_edit');
        $workunit               = $this->input->post('reg_workunit_edit');
        $workunit               = trim( smit_isset($workunit, "") );
        $status                 = $this->input->post('reg_status_edit');

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_id_workunit_edit','ID Satuan Kerja','required');
        $this->form_validation->set_rules('reg_workunit_edit','Nama Satuan Kerja','required');
        $this->form_validation->set_rules('reg_status_edit','Status Satuan Kerja','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah satuan kerja tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $workunit_data  = array(
            'workunit_name' => $workunit,
            'workunit_slug' => smit_slug($workunit),
            'status' => $status,
        );

        // -------------------------------------------------
        // Edit Workunit
        // -------------------------------------------------
        $trans_edit_workunit        = FALSE;
        if( $workunit_edit_id       = $this->Model_Option->update_workunit($workunit_id, $workunit_data) ){
            $trans_edit_workunit    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah satuan kerja tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_edit_workunit ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Ubah satuan kerja tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Ubah satuan kerja baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah satuan kerja tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * Workunit Delete function.
	 */
    function workunitdelete($action, $workunit_list){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        if ( !$workunit_list ){
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

        foreach($workunit_list AS $id){
            $workunitdata       = smit_get_workunitdata_by_id($id);
            if( !$workunitdata ){
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Data satuan kerja tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            if( $this->Model_Option->delete_workunit($workunitdata->workunit_id) ){
                // Set JSON data
                $data = array('msg' => 'success','message' => 'Data satuan kerja berhasil dihapus.');
            }else{
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Hapus data satuan kerja tidak berhasil dilakukan.');
            }
        }
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
                // Set JSON data
                $data = array('message' => 'error','data' => 'Tidak ada berkas panduan yang di unggah. Silahkan inputkan berkas panduan!');
                die(json_encode($data));
            }

            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/guide/' . $current_user->id;
            if( !file_exists($upload_path) ){
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
                // Set JSON data
                $data = array('message' => 'error','data' => $message);
                die(json_encode($data));
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
                    // Set JSON data
                    $data = array('message' => 'success','data' => 'Berkas panduan berhasil diupload');
                    die(json_encode($data));
                }
            }
        }

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

        $data['title']          = TITLE . 'Berkas Digital';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['post']           = $post;
        $data['main_content']   = 'guides';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Berkas Digital Detail list data function.
	 */
    public function guidesdetails($uniquecode)
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pengusul            = as_pengusul($current_user);

        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter detail berkas tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }

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

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
        ));

        $scripts_add            = '';

        // Custom
        $condition              = '';
        $guides_list            = '';
        if(!empty($uniquecode)){
            $guides_list        = $this->Model_Guide->get_all_guides('', '', ' WHERE %uniquecode% = "'.$uniquecode.'"', '');
            $guides_list        = $guides_list[0];
        }

        $data['title']          = TITLE . 'Detail Berkas Digital';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pengusul']    = $is_pengusul;
        $data['guides_list']    = $guides_list;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'guidesdetail';

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
        
        if( $column == 1 )              { $order_by .= '%description% ' . $sort; }
        elseif( $column == 2 )          { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 3 )          { $order_by .= '%title% ' . $sort; }

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

                // Button
                $btn_action = '<a href="'.base_url('berkas/digital/detail/'.$row->uniquecode).'"
                    class="announdetailset btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_announ_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';

                $records["aaData"][] = array(
                    smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                    <label for="cblist'.$row->id.'"></label>'),
                    smit_center($i),
                    smit_center( date('d F Y h:i:s', strtotime($row->datecreated)) ),
                    '<a href="'.base_url('berkas/digital/detail/'.$row->uniquecode).'">' . $row->title . '</a>',
                    $row->description,
                    smit_center( $btn_files ),
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
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
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

        if( !empty($s_no_news) )        { $condition .= str_replace('%s%', $s_no_news, ' AND %no_news% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_source) )         { $condition .= str_replace('%s%', $s_source, ' AND %source% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        //if( $column == 1 )      { $order_by .= '%no_news% ' . $sort; }
        elseif( $column == 1 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%source% ' . $sort; }

        $news_list          = $this->Model_News->get_all_news($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($news_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($news_list as $row){
                // Button
                $btn_action = '<a href="'.base_url('berita/detail/'.$row->uniquecode).'" class="newsdetail btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_news_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_edit   = '<a href="'.base_url('berita/edit/'.$row->uniquecode).'" class="newsedit btn btn-xs btn-warning waves-effect tooltips bottom5" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';

                $records["aaData"][] = array(
                    smit_center('<input name="newslist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    //$row->no_news,
                    '<a href="'.base_url('berita/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $row->source,
                    smit_center( $btn_action .' '. $btn_edit ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $newslist               = $_REQUEST['newslist'];

            $proses                 = $this->newsproses($sGroupActionName, $newslist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * News Proses function.
	 */
    function newsproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $newsdelete     = $this->Model_News->delete_news($uniquecode);
            }else{
                $data_update    = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_News->update_news($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data berita selesai di proses',
        );
        return $response;
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
        $time                   = date('H:i:s');

        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $source                 = $this->input->post('reg_source');
        $source                 = trim( smit_isset($source, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $date                   = $this->input->post('reg_date');
        $date                   = trim( smit_isset($date, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Berita','required');
        $this->form_validation->set_rules('reg_source','Sumber Berita','required');
        $this->form_validation->set_rules('reg_desc','Isi Berita','required');
        $this->form_validation->set_rules('reg_date','Tanggal Publikasi','required');

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
                    'status'        => ACTIVE,
                    'datecreated'   => $date .' '. $time,
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
                    'status'        => ACTIVE,
                    'datecreated'   => $date .' '. $time,
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

    /**
    * News edit function.
    */
    public function newseditdata( $uniquecode='' ){
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));

        $scripts_add        = '';
        $scripts_init       = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'UploadFiles.init();',
            'NewsValidation.init();',
        ));

        $newsdata           = '';
        if( !empty($uniquecode) ){
            $newsdata       = $this->Model_News->get_news_by_uniquecode($uniquecode);
        }

        $uploaded           = $newsdata->uploader;

        if($uploaded != 0){
            $file_name      = $newsdata->filename . '.' . $newsdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'news/'. $newsdata->uploader . '/' . $file_name;
            $news           = $file_url;
        }else{
            $news           = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Edit Berita';
        $data['news_data']      = $newsdata;
        $data['news_image']     = $news;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'news/newsedit';

        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
    * News edit function.
    */
    public function newsedit(){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $curdate                = date("Y-m-d H:i:s");
        $newsdata_update_image  = array();
        $current_file           = '';
        $image                  = '';
        
        $post_newsedit_id       = $this->input->post('newsedit_id');
        $post_newsedit_id       = trim( smit_isset($post_newsedit_id, 0) );
        $post_newsedit_title    = $this->input->post('newsedit_title');
        $post_newsedit_title    = trim( smit_isset($post_newsedit_title, '') );
        $post_newsedit_source   = $this->input->post('newsedit_source');
        $post_newsedit_source   = trim( smit_isset($post_newsedit_source, '') );
        $post_newsedit_desc     = $this->input->post('newsedit_desc');
        $post_newsedit_desc     = trim( smit_isset($post_newsedit_desc, '') );
        $post_newsedit_date     = $this->input->post('newsedit_date');
        $post_newsedit_date     = trim( smit_isset($post_newsedit_date, '') );

        $this->form_validation->set_rules('newsedit_title','Judul Berita','required');
        $this->form_validation->set_rules('newsedit_source','Sumber Berita','required');
        $this->form_validation->set_rules('newsedit_desc','Isi Berita','required|trim');
        $this->form_validation->set_rules('newsedit_date','Tanggal Publikasi','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'status'        => 'error',
                'message'       => 'Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!',
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // Check News Data First
            if( !$newsdata = $this->Model_News->get_news($post_newsedit_id) ){
                // Set JSON data and JSON encode data
                $data = array('status' => 'error','message' => 'Data berita tidak ditemukan atau belum terdaftar');
                die(json_encode($data));
            }

            // Check if update change image
            if( !empty($_FILES['newsedit_image']['name']) ){
                // -------------------------------------------------
                // Set Path and Upload Config
                // -------------------------------------------------
                $upload_path    = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/news/' . $current_user->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                
                $current_path   = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/news/' . $newsdata->uploader;
                $current_file   = $current_path . '/' . $newsdata->filename . '.' . $newsdata->extension;
                $current_thumb  = $current_path . '/' . $newsdata->thumbnail . '.' . $newsdata->extension;
                    
                $config = array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => "jpg|jpeg|png",
                    'overwrite'     => FALSE,
                    'max_size'      => "1024000", 
                );
                $this->upload->initialize($config);
                
                if( ! $this->upload->do_upload('newsedit_image') ){
                    // Set JSON data and JSON encode data
                    $data = array('status' => 'error','message' => $this->upload->display_errors());
                    die(json_encode($data));
                }

                $upload_data    = $this->upload->data();
                $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
                $thumbnail      = 'Thumbnail_' . $upload_data['raw_name'];
                $thumbfile      = $thumbnail . $upload_data['file_ext'];

                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(1140,400)->save($upload_path. '/' .$upload_file, TRUE);
                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$thumbfile, TRUE);
                $this->image_moo->clear();

                $newsdata_update_image = array(
                    'url'       => smit_isset($upload_data['full_path'],''),
                    'extension' => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'  => smit_isset($upload_data['raw_name'],''),
                    'thumbnail' => smit_isset($thumbnail,''),
                    'size'      => smit_isset($upload_data['file_size'],0),
                    'uploader'  => $current_user->id,
                );
                
                $image          = '<img class="js-animating-object img-responsive" src="'. BE_UPLOAD_PATH . 'news/' . $current_user->id . '/' . $upload_file .'" alt="Gambar Berita"/>';
            }
            
            // Set News Data Update
            $newsdata_update    = array(
                'title'         => $post_newsedit_title,
                'source'        => $post_newsedit_source,
                'desc'          => $post_newsedit_desc,
                'datecreated'   => $post_newsedit_date,
                'datemodified'  => $curdate,
            );
            
            if( !empty($newsdata_update_image) ) {
                $newsdata_update = array_merge($newsdata_update, $newsdata_update_image);
            }
            
            if( $this->Model_News->update_news($newsdata->uniquecode, $newsdata_update) ){
                if( !empty($current_file) ){
                    // Delete Previous File
                    if( file_exists($current_file) ){
                        unlink($current_file);
                        unlink($current_thumb);
                    }
                }
                
                // Set JSON data and JSON encode data
                $data = array('status' => 'success','message' => 'Data berita berhasil diperbaharui','image'=> $image );
                die(json_encode($data));
            }else{
                // Set JSON data and JSON encode data
                $data = array('status' => 'error','message' => 'Data berita tidak berhasil diperbaharui');
                die(json_encode($data));
            }
        }
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

        $title                  = $this->input->post('slider_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('slider_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        /*
        $this->form_validation->set_rules('reg_title','Judul Slider','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Slider','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran slider tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }
        */

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['slider_image']['name']) ){
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
            if( !empty($_FILES['slider_image']['name']) ){
                if( ! $this->upload->do_upload('slider_image') ){
                    $message = $this->upload->display_errors();

                    // Set JSON data
                    //$data = array('message' => 'error','data' => $this->upload->display_errors());
                    //die(json_encode($data));
                }

                $upload_data    = $this->upload->data();
                $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];

                $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
                $this->image_moo->clear();
                
                if( empty($title) || empty($description) ){
                    $slider_data        = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'user_id'       => $current_user->id,
                        'username'      => strtolower($current_user->username),
                        'name'          => $current_user->name,
                        'url'           => smit_isset($upload_data['full_path'],''),
                        'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                        'filename'      => smit_isset($upload_data['raw_name'],''),
                        'size'          => smit_isset($upload_data['file_size'],0),
                        'uploader'      => $current_user->id,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );    
                }else{
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
        $condition          = ' WHERE %status% <> 3';

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
                }
                elseif($row->status == ACTIVE)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    $btn_action     .= '
                    <a href="'.($row->user_id == 1 ? base_url('slider/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="slideredit btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah" '.($row->user_id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">edit</i></a>';
                }
                elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }
                elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                }
                
                $title      = $row->title; 
                if( empty($title) ){
                    $title  = 'TIDAK ADA JUDUL';
                }

                $uploaded           = $row->uploader;
                if($uploaded != 0){
                    $file_name      = $row->filename . '.' . $row->extension;
                    $file_url       = FE_IMG_PATH . 'slider/' . $file_name;
                    $slider         = $file_url;
                    $slider         = '<img class="js-animating-object img-responsive" src="'.$slider.'" alt="'.$title.'" />';
                }

                $records["aaData"][] = array(
                    smit_center('<input name="sliderlist[]" class="cblist filled-in chk-col-blue" id="cblist_slider'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist_slider'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    '<a href="'.base_url('slider/detail/'.$row->uniquecode).'">' . strtoupper($title) . '</a>',
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

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $sliderlist             = $_REQUEST['sliderlist'];

            $proses                 = $this->sliderconfirm($sGroupActionName, $sliderlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Slider confirm function.
	 */
    function sliderconfirm($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;

        foreach( $data as $key => $uniquecode ){
            $sliderdata         = $this->Model_Slider->get_all_slider(0,0, ' WHERE %uniquecode% = "'.$uniquecode.'"');
            $sliderdata         = $sliderdata[0];
            $id                 = $sliderdata->user_id;
            $userdata           = smit_get_userdata_by_id($id);
            if( !$userdata ){
                continue;
            }

            $userstatus         = $userdata->status;
            /*
            if( $action == 'confirm' && $userstatus == ACTIVE ){
                continue;
            }elseif( $action == 'banned' && $userstatus == DELETED ){
                continue;
            }
            */

            $data_update = array('status'=>$status,'datemodified'=>$curdate);
            $this->Model_Slider->update_slider($uniquecode, $data_update);
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data pengguna selesai di proses',
        );
        return $response;
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
    
    /**
    * Slider Edit function.
    */
    public function slideredit( $uniquecode='' ){
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
            'SliderValidation.init();',
        ));
        
        $sliderdata         = '';
        if( !empty($uniquecode) ){
            $sliderdata     = $this->Model_Slider->get_all_slider(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $sliderdata     = $sliderdata[0];
        }
        
        if($sliderdata){
            $file_name      = $sliderdata->filename . '.' . $sliderdata->extension;
            $file_url       = FE_IMG_PATH . 'slider/' . $file_name;
            $slider_image   = $file_url;
        }else{
            $slider_image   = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Pembayaran Detail';
        $data['sliderdata']     = $sliderdata;
        $data['slider_image']   = $slider_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'setting/frontendsetting/slideredit';

        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * Slider Edit Function
	 */
	public function sliderdataedit()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();
        
        $uniquecode             = $this->input->post('slider_uniquecode');
        $uniquecode             = trim( smit_isset($uniquecode, "") );
        $event_title            = $this->input->post('slider_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('slider_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        /*
        $this->form_validation->set_rules('slider_title','Judul Slider','required');
        $this->form_validation->set_rules('slider_desc','Deskripsi Slider','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah Slider baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }
        */

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['reg_thumbnail']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }
        */
        
        $sliderdata             = '';
        if( !empty($uniquecode) ){
            $sliderdata        = $this->Model_Slider->get_all_slider(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $sliderdata        = $sliderdata[0];
        }
        
        $file_name      = $sliderdata->filename . '.' . $sliderdata->extension;
        $file_url       = FE_IMG_PATH . 'slider/' . $file_name;
        $slider_image   = $file_url;

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();
        
        // Upload Files Process
        $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/frontend/images/slider/';
        if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
        
        $config = array(
            'upload_path'       => $upload_path,
            'allowed_types' => "jpg|jpeg|png",
            'overwrite'         => FALSE,
            'max_size'          => "2048000",
        );
        $this->load->library('MY_Upload', $config);
        
        $file_details       = '';
        if( !empty($_FILES['slider_image']['name']) ){
            //unlink($product_image);
            
            if( ! $this->my_upload->do_upload('slider_image') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_details    = $this->my_upload->data();
            $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1140,400)->save($upload_path. '/' .$upload_file, TRUE);
            $this->image_moo->clear();
            $file_details           = $upload_data_details;
        }
        
        if( !empty($file_details) ){
            $slider_data            = array(
                'title'             => $event_title,
                'desc'              => $description,
                'url'               => smit_isset($file_details['full_path'],''),
                'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                'filename'          => smit_isset($file_details['raw_name'],''),
                'size'              => smit_isset($file_details['file_size'],0),
                'datemodified'      => $curdate,
            );
        }else{
            $slider_data            = array(
                'title'             => $event_title,
                'desc'              => $description,
                'datemodified'      => $curdate,
            );
        }
        
        // -------------------------------------------------
        // Edit Slider Selection
        // -------------------------------------------------
        $trans_edit_slider      = FALSE;
        if( $slider_edit_id         = $this->Model_Slider->update_slider($uniquecode, $slider_data) ){
            $trans_edit_slider      = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah Slider tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_edit_slider ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Ubah tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Send Email Notification
                //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Ubah Slider baru berhasil!');
                die(json_encode($data));
                // Set Log Data
                smit_log( 'SLIDEREDIT_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data)) );
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah Slider tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
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
                $btn_action = '<a href="'.base_url('pesanumum/detail/'.$row->uniquecode).'" class="messagedetails btn btn-xs btn-primary waves-effect tooltips" id="btn_message_detail" data-placement="left" title="Baca"><i class="material-icons">zoom_in</i></a> ';

                if($row->status == UNREAD )   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                }
                elseif($row->status == READ)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                $records["aaData"][] = array(
                    smit_center('<input name="generalmessagelist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    strtoupper( $row->name ),
                    '<a href="'.base_url('pesanumum/detail/'.$row->uniquecode).'">' . word_limiter($row->title, 30) . '</a>',
                    $row->email,
                    smit_center( $status ),
                    //smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $generalmessagelist     = $_REQUEST['generalmessagelist'];

            $proses                 = $this->generalmessageprosess($sGroupActionName, $generalmessagelist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

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
            if( $is_admin ){
                if($generalmessagedata->status == UNREAD){
                    $update_data        = $this->Model_Service->update_message($uniquecode, array('status' => READ));
                }
            }
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
	 * Message Prosess function.
	 */
    function generalmessageprosess($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            $generalmessage_list  = $this->Model_Service->get_all_contact_message(1, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $generalmessage_list  = $generalmessage_list[0];
            if( !$generalmessage_list ){
                $response = array(
                    'status'    => 'ERROR',
                    'message'   => 'Data pesan ini tidak ada',
                );
                return $response;
            }

            if( $action == 'confirm' ){
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Service->update_message($uniquecode, $data_update);
            }elseif( $action == 'delete' ){
                $this->Model_Service->delete_message($generalmessage_list->id);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data pesan umum selesai di proses',
        );
        return $response;
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
        $is_pelaksana           = as_pelaksana($current_user);
        $is_pelaksana_tenant    = as_pelaksana_tenant($current_user);
        $is_pendamping          = as_pendamping($current_user);
        $is_tenant              = as_tenant($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $flashdata              = $this->session->flashdata('success');
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
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
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
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
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
            BE_JS_PATH . 'pages/forms/editors.js',
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
        $data['is_pelaksana']   = $is_pelaksana;
        $data['is_pendamping']  = $is_pendamping;
        $data['is_tenant']      = $is_tenant;
        $data['is_pelaksana_tenant']    = $is_pelaksana_tenant;
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
        $is_pelasana        = as_pelaksana($current_user);
        $is_pelaksana_tenant    = as_pelaksana_tenant($current_user);
        $is_pendamping      = as_pendamping($current_user);
        
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
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }

        if( $is_admin ){
            if($value == 'in'){
                $condition  = ' WHERE %id_userdata% > 1 AND %to_id% = 1 AND %information% = 0 ';
                $communication_list = $this->Model_Service->get_all_communication_in($limit, $offset, $condition, $order_by);
            }else{
                $condition  = ' WHERE %id_userdata% = 1 ';
                $communication_list = $this->Model_Service->get_all_communication_out($limit, $offset, $condition, $order_by);
            }
        }else{
            if($value == 'in'){
                $condition  = ' WHERE %to_id% = '.$current_user->id.' AND %id_userdata% <> '.$current_user->id.'';
                $communication_list = $this->Model_Service->get_all_communication_inuser($limit, $offset, $condition, $order_by);
            }else{
                $condition  = ' WHERE %id_userdata% = '.$current_user->id.' ';
                $communication_list = $this->Model_Service->get_all_communication_out($limit, $offset, $condition, $order_by);
            }
        }

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($communication_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status_message');

            $i = $offset + 1;
            foreach($communication_list as $row){
                // Button
                $btn_action = '';
                if($is_admin){
                    $btn_action = '';
                    if($row->status == READ) $btn_action = '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->communication_id).'" class="cmmdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_cmm_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                }elseif( $is_pendamping ){
                    $btn_action = '';
                    $btn_action = '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->uniquecode).'" class="cmmdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_cmm_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';    
                }else{
                    $btn_action = '';
                    $btn_action = '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->uniquecode).'" class="cmmdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_cmm_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';    
                }
                
                $name = '';
                if( $value == 'in' ){
                    if($is_admin) $name           = $row->name;
                    $desc           = $row->desc;
                    $datecreated    = $row->datecreated;
                }else{
                    $desc           = $row->desc;
                    $datecreated    = $row->datecreated;
                }
                
                if($row->status == UNREAD )   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    if( $value == 'in' ) $name       = '<strong style="color : red !important; ">'.$name.'</strong>';
                    $desc       = '<strong style="color : red !important; ">'.$desc.'</strong>';
                    $datecreated= '<strong style="color : red !important; ">'.date('d F Y H:i:s', strtotime($datecreated)).'</strong>';
                }elseif($row->status == READ)  {
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                }
                
                if( !empty($is_admin) ){
                    if( $value == 'in' ){
                        $records["aaData"][] = array(
                            smit_center('<input name="communicationlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                            <label for="cblist'.$row->uniquecode.'"></label>'),
                            smit_center($i),
                            strtoupper( $name ),
                            '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->communication_id).'">' . $desc . '</a>',
                            smit_center( $status ),
                            //smit_center( $datecreated ),
                            smit_center( $btn_action ),
                        );
                    }else{
                        $records["aaData"][] = array(
                            smit_center('<input name="communicationlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                            <label for="cblist'.$row->uniquecode.'"></label>'),
                            smit_center($i),
                            '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->communication_id).'">' . $desc . '</a>',
                            smit_center( $status ),
                            //smit_center( $datecreated ),
                            smit_center( $btn_action ),
                        );
                    }
                }elseif($is_pelasana || $is_pelaksana_tenant || $is_pendamping){
                    if( $value == 'in' ){
                        $fromdata   = smit_get_userdata_by_id($row->user_id);
                        $from_name  = $fromdata->name;
                        $records["aaData"][] = array(
                            smit_center('<input name="communicationlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                            <label for="cblist'.$row->uniquecode.'"></label>'),
                            smit_center($i),
                            strtoupper( $from_name ),
                            '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->uniquecode_data).'">' . $desc . '</a>',
                            smit_center( $status ),
                            smit_center( $datecreated ),
                            smit_center( $btn_action ),
                        );    
                    }else{
                        
                        $records["aaData"][] = array(
                            smit_center('<input name="communicationlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                            <label for="cblist'.$row->uniquecode.'"></label>'),
                            smit_center($i),
                            '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->communication_id).'">' . $desc . '</a>',
                            smit_center( $status ),
                            smit_center( $datecreated ),
                            smit_center( $btn_action ),
                        );    
                    }
                }else{
                    $records["aaData"][] = array(
                        smit_center('<input name="communicationlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                        <label for="cblist'.$row->uniquecode.'"></label>'),
                        smit_center($i),
                        '<a href="'.base_url('layanan/komunikasibantuan/detail/'.$row->communication_id).'">' . $title . '</a>',
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

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $communicationlist      = $_REQUEST['communicationlist'];

            if( $value == 'in'){

            }else{

            }
            $proses                 = $this->useraction($sGroupActionName, $communicationlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
    * Communication Details function.
    */
    public function communicationdetails( $id='' ){
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pendamping          = as_pendamping($current_user);

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
        if( !empty($id) ){
            
            if( $is_admin ){
                $communicationdata  = $this->Model_Service->get_all_communication(0, 0, ' WHERE %communication_id% = "'.$id.'"');
                $communicationdata  = $communicationdata[0];

                if($communicationdata->status == UNREAD){
                    $update_data        = $this->Model_Service->update_communication_data($communicationdata->uniquecode_data, array('status' => READ));
                }
            }else{
                $communicationdata  = $this->Model_Service->get_all_communication(0, 0, ' WHERE %uniquecode_data% LIKE "'.$id.'"');
                foreach($communicationdata AS $row){
                    if($row->status == UNREAD){
                        $update_data        = $this->Model_Service->update_communication_data($row->uniquecode_data, array('status' => READ));
                    }    
                }
                $communicationdata  = $communicationdata[0];
                
            }
        }

        $cmm_data               = $this->Model_Service->get_all_communication_data(0, 0, ' WHERE %communication_id% = '.$communicationdata->communication_id.'', ' %datecreated% ASC');

        $data['title']          = TITLE . 'Detail Komunikasi dan Bantuan';
        $data['communication_data']    = $communicationdata;
        $data['cmm_data']       = $cmm_data;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pendamping']  = $is_pendamping;
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
        
        if( !$is_admin ){
            $user_id            = $this->input->post('cmm_user_id');
            $user_id            = trim( smit_isset($user_id, "") );
            $to_id              = $user_id;    
        }
        

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
            $communication_id   = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'user_id'       => $current_user->id,
                'from_id'       => $current_user->id,
                'to_id'         => $to_id,
                'title'         => $title,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Communication
            // -------------------------------------------------
            $trans_save_communication       = FALSE;
            if( $communication_save_id      = $this->Model_Service->save_data_communication_id($communication_id) ){
                $trans_save_communication   = TRUE;
                if( !empty($communication_save_id) ){
                    $communication_user  = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'communication_id'  => $communication_save_id,
                        'user_id'       => $current_user->id,
                        'from_id'       => $current_user->id,
                        'to_id'         => $to_id,
                        'username'      => strtolower($current_user->username),
                        'name'          => $current_user->name,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    $communication_save_user    = $this->Model_Service->save_data_communication_user($communication_user);

                    if( !empty($communication_save_user) ){
                        $communication_data  = array(
                            'uniquecode'    => smit_generate_rand_string(10,'low'),
                            'communication_id' => $communication_save_id,
                            'user_id'       => $current_user->id,
                            'desc'          => $description,
                            'datecreated'   => $curdate,
                            'datemodified'  => $curdate,
                        );

                        $this->Model_Service->save_data_communication_data($communication_data);
                    }
                }
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

    /**
	 * Communication Replay
	 */
	public function communicationreply()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pendamping          = as_pendamping($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $to_id                  = $this->input->post('cmm_from_id');
        $to_id                  = trim( smit_isset($to_id, "") );
        $cmm_id                 = $this->input->post('cmm_id');
        $cmm_id                 = trim( smit_isset($cmm_id, "") );
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
            $communication_user  = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'communication_id'  => $cmm_id,
                'user_id'       => $current_user->id,
                'from_id'       => $current_user->id,
                'to_id'         => $to_id,
                'username'      => strtolower($current_user->username),
                'name'          => $current_user->name,
                'information'   => 1,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Communication
            // -------------------------------------------------
            $trans_save_communication       = FALSE;
            if( $communication_save_id      = $this->Model_Service->save_data_communication_user($communication_user) ){
                $trans_save_communication   = TRUE;
                if( !empty($communication_save_id) ){
                    $communication_data  = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'communication_id' => $cmm_id,
                        'user_id'       => $current_user->id,
                        'desc'          => $description,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );

                    $this->Model_Service->save_data_communication_data($communication_data);
                }
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

    // CATEGORY
    // ----------------------------------------------------------------------------------------------------------------------
    /**
	 * Category Add
	 */
	public function categoryadd()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_category','Nama Kategori','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran kategori tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $category_data  = array(
            'category_name' => strtoupper($category),
            'category_slug' => smit_slug($category)
        );

        // -------------------------------------------------
        // Save Category
        // -------------------------------------------------
        $trans_save_category        = FALSE;
        if( $category_save_id       = $this->Model_Option->save_data_category($category_data) ){
            $trans_save_category    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran kategori tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_category ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Pendaftaran kategori tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Pendaftaran kategori baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran kategori tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * Category list data function.
	 */
    function categorylistdata(){
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

        $s_category         = $this->input->post('search_category');
        $s_category         = smit_isset($s_category, '');

        if( !empty($s_category) )   { $condition .= str_replace('%s%', $s_category, ' AND %category_name% LIKE "%%s%%"'); }
        if( $column == 1 )          { $order_by .= '%category_name% ' . $sort; }
        $category_list      = $this->Model_Option->get_all_category($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($category_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($category_list as $row){
                // Button
                $btn_action = '<a class="categoryedit btn btn-xs btn-warning waves-effect tooltips" data-placement="left" data-id="'.$row->category_id.'" data-name="'.$row->category_name.'" title="Ubah"><i class="material-icons">edit</i></a>';
                $records["aaData"][] = array(
                    smit_center('<input name="categorylist[]" class="cblist filled-in chk-col-blue" id="cblist_category'.$row->category_id.'" value="' . $row->category_id . '" type="checkbox"/>
                    <label for="cblist_category'.$row->category_id.'"></label>'),
                    smit_center($i),
                    $row->category_name,
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $categorylist           = $_REQUEST['categorylist'];

            $proses                 = $this->categorydelete($sGroupActionName, $categorylist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Category Edit
	 */
	public function categoryedit()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $category_id            = $this->input->post('reg_id_category');
        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_id_category','ID Katgeori','required');
        $this->form_validation->set_rules('reg_category','Nama Kategori','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah kategori tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $category_data  = array(
            'category_name'     => $category,
        );

        // -------------------------------------------------
        // Edit Category
        // -------------------------------------------------
        $trans_edit_category        = FALSE;
        if( $category_edit_id       = $this->Model_Option->update_category($category_id, $category_data) ){
            $trans_edit_category    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah satuan kerja tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_edit_category ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Ubah kategori tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Ubah kategori baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah kategori tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * Category Delete function.
	 */
    function categorydelete($action, $categorylist){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        if ( !$categorylist ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'ID kategori harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Hapus kategori  hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };

        foreach($categorylist AS $id){
            $categorydata       = $this->Model_Option->get_categorydata($id);
            if( !$categorydata ){
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Data kategori tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            if( $this->Model_Option->delete_category($categorydata->category_id) ){
                // Set JSON data
                $data = array('msg' => 'success','message' => 'Data kategori berhasil dihapus.');
            }else{
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Hapus data kategori tidak berhasil dilakukan.');
            }
        }
        // JSON encode data
        die(json_encode($data));
    }

    // ----------------------------------------------------------------------------------------------------------------------
    // PENDAMPINGAN
    // ----------------------------------------------------------------------------------------------------------------------
    /**
	 * Notulensi Pra-Incubation function.
	 */
     public function accompanimentpraincubation()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);
        $is_pendampng           = as_pendamping($current_user);

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
            'NotesValidation.init();',
        ));

        $data['title']          = TITLE . 'Laporan Notulensi Pra-Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pendamping']  = $is_pendampng;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'accompaniment/praincubation';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Notes Pra-Inkubasi Add Function
	 */
	public function notespraincubationadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $companion_id           = $this->input->post('companion_id');
        $companion_id           = trim( smit_isset($companion_id, "") );

        if( empty($companion_id) ){
            $companion_id       = $current_user->id;
        }
        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Usulan Kegiatan','required');
        $this->form_validation->set_rules('reg_title','Judul Notulensi','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Notulensi','required');
        $this->form_validation->set_rules('companion_id','Nama Pendamping','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Notulensi Pra-Inkubasi baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Berkas notulensi yang di unggah. Silahkan inputkan Berkas notulensi!');
            die(json_encode($data));
        }

        $userdata       = $this->Model_User->get_user_by('id', $companion_id);
        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/accompaniment/praincubation/' . $userdata->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types'     => "doc|docx|pdf",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );

            $this->load->library('MY_Upload', $config);

            if( ! $this->my_upload->do_upload('reg_selection_files') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }

            $upload_data_files      = $this->my_upload->data();
            $file                   = $upload_data_files;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            $notes_data         = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'praincubation_id'  => $event,
                'user_id'       => $userdata->id,
                'username'      => strtolower($userdata->username),
                'name'          => strtoupper($userdata->name),
                'title'         => $title,
                'description'   => $description,
                'url'           => smit_isset($file['full_path'],''),
                'extension'     => substr(smit_isset($file['file_ext'],''),1),
                'filename'      => smit_isset($file['raw_name'],''),
                'size'          => smit_isset($file['file_size'],0),
                'status'        => $status,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Notes Pra-Incubation
            // -------------------------------------------------
            $trans_save_notes           = FALSE;
            if( $notes_save_id      = $this->Model_Praincubation->save_data_notes($notes_data) ){
                $trans_save_notes   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran notulensi pra-inkubasi tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_notes ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran notulensi pra-inkubasi tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran notulensi pra-inkubasi baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'NOTESPRA_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data_files)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran notulensi pra-inkubasi tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Notes list data function.
	 */
    function noteslistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        if( !$is_admin ){
            $condition      = ' WHERE %user_id% = '.$current_user->id.'';
        }

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
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $notes_list         = $this->Model_Praincubation->get_all_notes($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($notes_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('files_status');

            $i = $offset + 1;
            foreach($notes_list as $row){
                // Status
                /*
                $btn_action = '<a href="'.base_url('notulensiprainkubasi/detail/'.$row->uniquecode).'"
                    class="notespradetail btn btn-xs btn-primary waves-effect tooltips" id="btn_notespra_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('notulensiprainkubasi/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="notespraconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
                        <a href="'.($row->user_id == 1 ? base_url('notulensiprainkubasi/delete/'.$row->uniquecode) : 'javascript:;' ).'" class="notespradelete btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a>';
                
                */
                $btn_action = ' ';

                if( !$is_admin ){
                    if($row->status == NONACTIVE)   {
                        $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                }

                if( !empty($is_admin) ){
                    if($row->status == NONACTIVE)   {
                        $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }

                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                }
                elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }
                elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('unduh/notulensiprainkubasi/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips" data-placement="left" title="Download File"><i class="material-icons">file_download</i></a> ';
                }else{
                    $btn_files  = ' - ';
                }

                $records["aaData"][] = array(
                    smit_center('<input name="notespralist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    strtoupper($row->name),
                    '<a href="'.base_url('prainkubasi/daftar/detail/'.$row->uniquecode_praincubation).'">' . strtoupper($row->event_title) . '</a>',
                    '<a href="'.base_url('notulensiprainkubasi/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    smit_center( $btn_files ),
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $notespralist           = $_REQUEST['notespralist'];
            
            $proses                 = $this->notespraproses($sGroupActionName, $notespralist);
            $records["sStatus"]     = $proses['status']; 
            $records["sMessage"]    = $proses['message']; 
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }
    
    /**
	 * Notes Praincubation Proses function.
	 */
    function notespraproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $notesdelete    = $this->Model_Praincubation->delete_notes($uniquecode);
            }else{
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Praincubation->update_notes($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar laproan notulensi selesai di proses',
        );
        return $response;
    }

    /**
	 * Notes confirm function.
	 */
    function notesconfirm($action, $uniquecode){
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
            $data = array('msg' => 'error','message' => 'Konfirmasi Notulensi hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };

        $notesdata          = $this->Model_Praincubation->get_notes_by_uniquecode($uniquecode);
        if( !$notesdata ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data notulensi pra-inkubasi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }

        $curdate = date('Y-m-d H:i:s');
        if( $action=='active' )     { $status = ACTIVE; }
        elseif( $action=='banned' ) { $status = BANNED; }
        elseif( $action=='delete' ) { $status = DELETED; }

        if( $status == DELETED ){
            if( $this->Model_Praincubation->delete_notes($uniquecode) ){
                // Set JSON data
                $data = array('msg' => 'success','message' => 'Data notulensi pra-inkubasi berhasil dihapus.');
                // JSON encode data
                die(json_encode($data));
            }else{
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Data notulensi pra-inkubasi gagal dihapus.');
                // JSON encode data
                die(json_encode($data));
            }
        }else{
            $data_update = array('status'=>$status, 'datemodified'=>$curdate);
            if( $this->Model_Praincubation->update_notes($uniquecode, $data_update) ){
                // Set JSON data
                $data = array('msg' => 'success','message' => 'Konfirmasi data notulensi pra-inkubasi berhasil dilakukan.');
                // JSON encode data
                die(json_encode($data));
            }else{
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Konfirmasi data notulensi pra-inkubasi tidak berhasil dilakukan.');
                // JSON encode data
                die(json_encode($data));
            }
        }

    }

    /**
	 * Notes Download File function.
	 */
    function notespraincubationdownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }

        // Check Notes File Data
        $notesdata      = $this->Model_Praincubation->get_notes_by_uniquecode($uniquecode);
        if( !$notesdata || empty($notesdata) ){
            redirect( current_url() );
        }

        $file_name      = $notesdata->filename . '.' . $notesdata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/accompaniment/praincubation/' . $notesdata->user_id . '/' . $file_name;

        force_download($file_name, $file_url);
    }

    /**
	 * Notes Inkubasi / Tenant Add Function
	 */
	public function notesincubationadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $event                  = $this->input->post('reg_event');
        $event                  = trim( smit_isset($event, "") );
        $companion_id           = $this->input->post('companion_id');
        $companion_id           = trim( smit_isset($companion_id, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('companion_id','Nama Pendamping','required');
        $this->form_validation->set_rules('reg_event','Usulan Kegiatan','required');
        $this->form_validation->set_rules('reg_title','Judul Notulensi','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Notulensi','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Notulensi Inkubasi/Tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Berkas notulensi yang di unggah. Silahkan inputkan Berkas notulensi!');
            die(json_encode($data));
        }

        $userdata   = $this->Model_User->get_user_by('id', $companion_id);
        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/accompaniment/incubation/' . $userdata->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types'     => "doc|docx|pdf",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );

            $this->load->library('MY_Upload', $config);

            if( ! $this->my_upload->do_upload('reg_selection_files') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }

            $upload_data_files      = $this->my_upload->data();
            $file                   = $upload_data_files;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            $notes_data         = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'tenant_id'     => $event,
                'user_id'       => $userdata->id,
                'username'      => strtolower($userdata->username),
                'name'          => strtoupper($userdata->name),
                'title'         => $title,
                'description'   => $description,
                'url'           => smit_isset($file['full_path'],''),
                'extension'     => substr(smit_isset($file['file_ext'],''),1),
                'filename'      => smit_isset($file['raw_name'],''),
                'size'          => smit_isset($file['file_size'],0),
                'status'        => $status,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save Notes Incubation Selection
            // -------------------------------------------------
            $trans_save_notes           = FALSE;
            if( $notes_save_id      = $this->Model_Incubation->save_data_notes($notes_data) ){
                $trans_save_notes   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran product inkubasi/tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_notes ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran notulensi inkubasi/tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran notulensi inkubasi/tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'NOTESINC_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'upload_files'=> $upload_data_files)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran notulensi inkubasi/tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

	public function accompanimentincubation()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);
        $is_pendamping          = as_pendamping($current_user);


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
            'NotesValidation.init();',
        ));

        $data['title']          = TITLE . 'Laporan Notulensi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pendamping']  = $is_pendamping;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'accompaniment/incubation';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Notes list data function.
	 */
    function notesincubationlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        if( !$is_admin ){
            $condition      = ' WHERE %user_id% = '.$current_user->id.'';
        }

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
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $notes_list         = $this->Model_Incubation->get_all_notes($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($notes_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('files_status');

            $i = $offset + 1;
            foreach($notes_list as $row){
                // Status
                /*
                $btn_action = '<a href="'.base_url('notulensiprainkubasi/detail/'.$row->uniquecode).'"
                    class="notespradetail btn btn-xs btn-primary waves-effect tooltips" id="btn_notespra_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('notulensiprainkubasi/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="notespraconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
                        <a href="'.($row->user_id == 1 ? base_url('notulensiprainkubasi/delete/'.$row->uniquecode) : 'javascript:;' ).'" class="notespradelete btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Hapus" '.($current_user->id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                */
                $btn_action = ' ';
                

                if( !$is_admin ){
                    if($row->status == NONACTIVE)   {
                        $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                }

                if( !empty($is_admin) ){
                    if($row->status == NONACTIVE)   {
                        $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }

                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                }
                elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                }
                elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                }

                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('unduh/notulensiinkubasi/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Download File"><i class="material-icons">file_download</i></a> ';
                }else{
                    $btn_files  = ' - ';
                }

                $records["aaData"][] = array(
                    smit_center('<input name="noteinclist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    strtoupper($row->name),
                    '<a href="'.base_url('inkubasi/daftar/detail/'.$row->uniquecode_incubation).'">' . strtoupper($row->name_tenant) . '</a>',
                    '<a href="'.base_url('notulensiinkubasi/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    smit_center( $btn_files ),
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $noteinclist            = $_REQUEST['noteinclist'];
            
            $proses                 = $this->notesincproses($sGroupActionName, $noteinclist);
            $records["sStatus"]     = $proses['status']; 
            $records["sMessage"]    = $proses['message']; 
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }
    
    /**
	 * Notes Incubation Proses function.
	 */
    function notesincproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $notesdelete    = $this->Model_Incubation->delete_notes($uniquecode);
            }else{
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Incubation->update_notes($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar laproan notulensi selesai di proses',
        );
        return $response;
    }

    /**
	 * Notes Download File function.
	 */
    function notesincubationdownloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }

        // Check Notes File Data
        $notesdata      = $this->Model_Incubation->get_notes_by_uniquecode($uniquecode);
        if( !$notesdata || empty($notesdata) ){
            redirect( current_url() );
        }

        $file_name      = $notesdata->filename . '.' . $notesdata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/accompaniment/incubation/' . $notesdata->user_id . '/' . $file_name;

        force_download($file_name, $file_url);
    }

    // ----------------------------------------------------------------------------------------------------------------------
    // INFO GRAFIS
    // ----------------------------------------------------------------------------------------------------------------------
    /**
	 * Info Grafis User function.
	 */
	public function infografisuser()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Morris Chart CSS Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Moment JS Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            // Morrist Chart JS Plugin
            BE_PLUGIN_PATH . 'raphael/raphael.min.js',
            BE_PLUGIN_PATH . 'morrisjs/morris.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Charts.init();'
        ));

        $data['title']          = TITLE . 'Info Grafis Pengguna';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'infografis/user';

        $chart = array();
        $stats = '';
        if ( $stats = $this->Model_User->stats_monthly() ) {
            // Pivoting
			$pivot = array();
			foreach( $stats as $row ) {
                if ( $row->type == 2 )      { $type = 'pendamping'; }
                elseif ( $row->type == 3 )  { $type = 'tenant'; }
                elseif ( $row->type == 4 )  { $type = 'juri'; }
                elseif ( $row->type == 5 )  { $type = 'pengusul'; }
                elseif ( $row->type == 6 )  { $type = 'pelaksana'; }
                elseif ( $row->type == 7 )  { $type = 'pelaksana_tenant'; }

				if ( ! isset( $pivot[ $row->period ] ) )
					$pivot[ $row->period ] = array();

				if ( ! isset( $pivot[ $row->period ][ 'total' ] ) )
					$pivot[ $row->period ][ 'total' ] = 0;

				$pivot[ $row->period ][ 'period_name' ] = $row->period_name;
				$pivot[ $row->period ][ 'total' ] += $row->total;
				$pivot[ $row->period ][ $type ] = $row->total;
			}

            $chart['xkey']      = 'period';
            $chart['ykeys']     = array( 'pendamping', 'tenant', 'juri', 'pengusul', 'pelaksana', 'pelaksana_tenant' );
            $chart['labels']    = array( 'Pendamping', 'Tenant', 'Juri', 'Pengusul', 'Pelaksana', 'Pelaksana & Tenant' );

            foreach( $pivot as $period => $row ) {
                // chart
				$chart['data'][] = array(
                    'period'            => $period,
                    'pendamping'        => smit_isset( $row[ 'pendamping' ], 0 ),
                    'tenant'            => smit_isset( $row[ 'tenant' ], 0 ),
                    'juri'              => smit_isset( $row[ 'juri' ], 0 ),
                    'pengusul'          => smit_isset( $row[ 'pengusul' ], 0 ),
                    'pelaksana'         => smit_isset( $row[ 'pelaksana' ], 0 ),
                    'pelaksana_tenant'  => smit_isset( $row[ 'pelaksana_tenant' ], 0 ),
                    'total'             => $row['total']
				);
            }
        }

        $chart_year = array();
        $stats_yearly = '';
        if ( $stats_yearly = $this->Model_User->stats_yearly() ) {
            // Pivoting
			$pivot_yearly = array();
			foreach( $stats_yearly as $row ) {
                if ( $row->type == 2 )      { $type = 'pendamping'; }
                elseif ( $row->type == 3 )  { $type = 'tenant'; }
                elseif ( $row->type == 4 )  { $type = 'juri'; }
                elseif ( $row->type == 5 )  { $type = 'pengusul'; }
                elseif ( $row->type == 6 )  { $type = 'pelaksana'; }
                elseif ( $row->type == 7 )  { $type = 'pelaksana_tenant'; }

				if ( ! isset( $pivot_yearly[ $row->period ] ) )
					$pivot_yearly[ $row->period ] = array();

				if ( ! isset( $pivot_yearly[ $row->period ][ 'total' ] ) )
					$pivot_yearly[ $row->period ][ 'total' ] = 0;

				$pivot_yearly[ $row->period ][ 'total' ] += $row->total;
				$pivot_yearly[ $row->period ][ $type ] = $row->total;
			}

            $chart_year['xkey']      = 'period';
            $chart_year['ykeys']     = array( 'pendamping', 'tenant', 'juri', 'pengusul', 'pelaksana', 'pelaksana_tenant' );
            $chart_year['labels']    = array( 'Pendamping', 'Tenant', 'Juri', 'Pengusul', 'Pelaksana', 'Pelaksana & Tenant' );

            foreach( $pivot_yearly as $period => $row ) {
                // chart
				$chart_year['data'][] = array(
                    'period'            => $period,
                    'pendamping'        => smit_isset( $row[ 'pendamping' ], 0 ),
                    'tenant'            => smit_isset( $row[ 'tenant' ], 0 ),
                    'juri'              => smit_isset( $row[ 'juri' ], 0 ),
                    'pengusul'          => smit_isset( $row[ 'pengusul' ], 0 ),
                    'pelaksana'         => smit_isset( $row[ 'pelaksana' ], 0 ),
                    'pelaksana_tenant'  => smit_isset( $row[ 'pelaksana_tenant' ], 0 ),
                    'total'             => $row['total']
				);
            }
        }

        $data['chart']			= json_encode( $chart );
        $data['chart_year']	    = json_encode( $chart_year );
        $data['stats']	        = $stats;
        $data['stats_yearly']	= $stats_yearly;

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Info Grafis Praincubation function.
	 */
	public function infografispraincubation()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Morris Chart CSS Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            
            // Morrist Chart JS Plugin
            BE_PLUGIN_PATH . 'raphael/raphael.min.js',
            BE_PLUGIN_PATH . 'morrisjs/morris.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Charts.init();'
        ));

        $data['title']          = TITLE . 'Info Grafis Pra-Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'infografis/praincubation';

        $chart = array();
        $stats = '';
        if ( $stats = $this->Model_Praincubation->stats_yearly() ) {
            // Pivoting
			$pivot_yearly = array();
			foreach( $stats as $row ) {
                $category       = $row->category;

				if ( ! isset( $pivot_yearly[ $row->period ] ) )
					$pivot_yearly[ $row->period ] = array();

				if ( ! isset( $pivot_yearly[ $row->period ][ 'total' ] ) )
					$pivot_yearly[ $row->period ][ 'total' ] = 0;

				$pivot_yearly[ $row->period ][ 'total' ] += $row->total;
				$pivot_yearly[ $row->period ][ $category ] = $row->total;
			}
            
            $slug_arr           = smit_category_slug();
            $name_arr           = smit_category_name();

            $chart['xkey']      = 'period';
            $chart['ykeys']     = $slug_arr;
            $chart['labels']    = $name_arr;

            foreach( $pivot_yearly as $period => $row ) {
                $chart_arr              = array('period' => $period);
                foreach($slug_arr as $slug){
                    $chart_arr[$slug]   = smit_isset( $row[ $slug ], 0 );
                }
                $chart_arr['total']     = $row['total'];

                // chart
				$chart['data'][]        = $chart_arr;
            }
        }
        $data['chart']			= json_encode( $chart );
        $data['stats']			= $stats;

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Info Grafis Incubation function.
	 */
	public function infografisincubation()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Morris Chart CSS Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Morrist Chart JS Plugin
            BE_PLUGIN_PATH . 'raphael/raphael.min.js',
            BE_PLUGIN_PATH . 'morrisjs/morris.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Charts.init();'
        ));

        $data['title']          = TITLE . 'Info Grafis Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'infografis/incubation';
        
        $chart = array();
        $stats = '';
        if ( $stats = $this->Model_Incubation->stats_monthly() ) {
            // Pivoting
			$pivot = array();
			foreach( $stats as $row ) {
                $category       = $row->category;

				if ( ! isset( $pivot[ $row->period ] ) )
					$pivot[ $row->period ] = array();

				if ( ! isset( $pivot[ $row->period ][ 'total' ] ) )
					$pivot[ $row->period ][ 'total' ] = 0;

				$pivot[ $row->period ][ 'period_name' ] = $row->period_name;
				$pivot[ $row->period ][ 'total' ] += $row->total;
				$pivot[ $row->period ][ $category ] = $row->total;
			}

            $slug_arr           = smit_category_slug();
            $name_arr           = smit_category_name();

            $chart['xkey']      = 'period';
            $chart['ykeys']     = $slug_arr;
            $chart['labels']    = $name_arr;

            foreach( $pivot as $period => $row ) {
                $chart_arr              = array('period' => $period);
                foreach($slug_arr as $slug){
                    $chart_arr[$slug]   = smit_isset( $row[ $slug ], 0 );
                }
                $chart_arr['total']     = $row['total'];

                // chart
				$chart['data'][]        = $chart_arr;
            }
        }

        $chart_year = array();
        $stats_yearly = '';
        if ( $stats_yearly = $this->Model_Incubation->stats_yearly() ) {
            // Pivoting
			$pivot_yearly = array();
			foreach( $stats_yearly as $row ) {
                $category       = $row->category;

				if ( ! isset( $pivot_yearly[ $row->period ] ) )
					$pivot_yearly[ $row->period ] = array();

				if ( ! isset( $pivot_yearly[ $row->period ][ 'total' ] ) )
					$pivot_yearly[ $row->period ][ 'total' ] = 0;

				$pivot_yearly[ $row->period ][ 'total' ] += $row->total;
				$pivot_yearly[ $row->period ][ $category ] = $row->total;
			}

            $slug_arr           = smit_category_slug();
            $name_arr           = smit_category_name();

            $chart_year['xkey']      = 'period';
            $chart_year['ykeys']     = $slug_arr;
            $chart_year['labels']    = $name_arr;

            foreach( $pivot_yearly as $period => $row ) {
                $chart_arr              = array('period' => $period);
                foreach($slug_arr as $slug){
                    $chart_arr[$slug]   = smit_isset( $row[ $slug ], 0 );
                }
                $chart_arr['total']     = $row['total'];

                // chart
				$chart_year['data'][]        = $chart_arr;
            }
        }

        $data['chart']			= json_encode( $chart );
        $data['chart_year']	    = json_encode( $chart_year );
        $data['stats']	        = $stats;
        $data['stats_yearly']	= $stats_yearly;

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Info Grafis IKM function.
	 */
	public function infografisikm()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Morris Chart CSS Plugin
            BE_PLUGIN_PATH . 'morrisjs/morris.css',
        ));

        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Moment JS Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            // Morrist Chart JS Plugin
            BE_PLUGIN_PATH . 'raphael/raphael.min.js',
            BE_PLUGIN_PATH . 'morrisjs/morris.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
        ));

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Charts.init();'
        ));

        $data['title']          = TITLE . 'Info Grafis Pengguna';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'infografis/ikm';

        // Chart Yearly
        $chart = array();
        $sangat_setuju  = $this->Model_Service->count_all_answer(0, SANGAT_SETUJU);
        $setuju         = $this->Model_Service->count_all_answer(0, SETUJU);
        $tidak_setuju   = $this->Model_Service->count_all_answer(0, TIDAK_SETUJU);
        $sangat_tidak_setuju    = $this->Model_Service->count_all_answer(0, SANGAT_TIDAK_SETUJU);
        $total          = $this->Model_Service->count_all_answer();

        $dataset[]      = array(
            'sangat_setuju'         => $sangat_setuju,
            'setuju'                => $setuju,
            'tidak_setuju'          => $tidak_setuju,
            'sangat_tidak_setuju'   => $sangat_tidak_setuju,
            'total'                 => $total
        );
        
        $stats  = '';
        if ( $stats = $this->Model_Service->stats_yearly() ) {
            // Pivoting
			$pivot = array();

			foreach( $stats as $row ) {
                if ( $row->answer == 1 )      { $type = 'sangat_setuju'; }
                elseif ( $row->answer == 2 )  { $type = 'setuju'; }
                elseif ( $row->answer == 3 )  { $type = 'tidak_setuju'; }
                elseif ( $row->answer == 4 )  { $type = 'sangat_tidak_setuju'; }

				if ( ! isset( $pivot[ $row->period ] ) )
					$pivot[ $row->period ] = array();

				if ( ! isset( $pivot[ $row->period ][ 'total' ] ) )
					$pivot[ $row->period ][ 'total' ] = 0;

				//$pivot[ $row->period ][ 'period_name' ] = $row->period_name;
				$pivot[ $row->period ][ 'total' ] += $row->total;
				$pivot[ $row->period ][ $type ] = $row->total;
			}

            $chart['xkey']      = 'period';
            $chart['ykeys']     = array( 'sangat_setuju', 'setuju', 'tidak_setuju', 'sangat_tidak_setuju');
            $chart['labels']    = array( 'Sangat Setuju', 'Setuju', 'Tidak Setuju', 'Sangat Tidak Setuju');

            foreach( $pivot as $period => $row ) {

                // chart
				$chart['data'][] = array(
                    'period'                => $period,
                    'sangat_setuju'         => smit_isset( $row[ 'sangat_setuju' ], 0 ),
                    'setuju'                => smit_isset( $row[ 'setuju' ], 0 ),
                    'tidak_setuju'          => smit_isset( $row[ 'tidak_setuju' ], 0 ),
                    'sangat_tidak_setuju'   => smit_isset( $row[ 'sangat_tidak_setuju' ], 0 ),
                    'total'                 => $row['total']
				);
            }
        }
        $data['chart']			= json_encode( $chart );

        // Chart Per question
        $chart_question     = array();
        $stats_question     = '';
        if ( $stats = $this->Model_Service->stats_question() ) {
            // Pivoting
			$pivot      = array();
            $keys       = array();
            $labels     = array();
            $data_row   = array();
            $i          = 1;
			foreach( $stats as $row ) {
                if ( ! isset( $pivot[ $row['period'] ] ) )
					$pivot[ $row['period'] ] = array();

				if ( ! isset( $pivot[ $row['period'] ][ 'ikm' ] ) )
					$pivot[ $row['period'] ][ 'total_ikm' ] = 0;

                $data_row[]   = array(
                    'judul_'.$i => $row['title'],
                    'ikm_'.$i   => $row['ikm']
                );
                $pivot[ $row['period'] ]     = $data_row;

                $keys[]      = 'judul_'.$i;
                $labels[]    = $row['title'];
                $i++;
			}

            $chart_question['xkey']      = 'period';
            $chart_question['ykeys']     = $keys;
            $chart_question['labels']    = $labels;

            $i = 1;
            $j = 1;
            $dataset    = array();
            foreach( $pivot as $period => $row ) {

                $dataset['period']          = $period;
                foreach ($row as $value) {
                    $dataset['judul_'.$j]   = smit_isset( $value[ 'ikm_'.$j ], 0 );
                    $j++;
                }
                $chart_question['data'][] = $dataset;
            }
        }
        $data['chart_question']			= json_encode( $chart_question );
        $data['stats']			        = $stats;
        $data['stats_question']			= $stats_question;

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    // ----------------------------------------------------------------------------------------------------------------------
    // PENGUKURAN ikm
    // ----------------------------------------------------------------------------------------------------------------------
    /**
	 * IKM function.
	 */
	public function ikm()
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

        $sangat_setuju  = $this->Model_Service->count_all_answer(0, SANGAT_SETUJU);
        $setuju         = $this->Model_Service->count_all_answer(0, SETUJU);
        $tidak_setuju   = $this->Model_Service->count_all_answer(0, TIDAK_SETUJU);
        $sangat_tidak_setuju    = $this->Model_Service->count_all_answer(0, SANGAT_TIDAK_SETUJU);

        $total_ikmlist  = $this->Model_Service->count_all_ikmlist();
        $penimbang      = $total_ikmlist > 0 ? number_format(1/$total_ikmlist, 3) : 0;
        $penimbang_full = ($penimbang * 100) * 100;

        $ikm            = smit_get_total_ikm();
        $ikm            = $total_ikmlist > 0 ? $ikm/$total_ikmlist : 0;
        $ikm            = floor($ikm);

        $mutu           = ' - ';
        $kenerja        = ' - ';
        if($ikm <= floor($penimbang_full*45/100)){
            $mutu       = 'D';
            $kinerja    = 'Tidak Baik';
        }elseif($ikm > floor($penimbang_full*45/100) && $ikm <= floor($penimbang_full*65/100)){
            $mutu       = 'C';
            $kinerja    = 'Kurang Baik';
        }elseif($ikm > floor($penimbang_full*65/100) && $ikm <= floor($penimbang_full*85/100)){
            $mutu       = 'B';
            $kinerja    = 'Baik';
        }elseif($ikm > floor($penimbang_full*85/100) && $ikm <= $penimbang_full){
            $mutu       = 'A';
            $kinerja    = 'Sangat Baik';
        }

        $data['title']          = TITLE . 'Pengukuran IKM';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pengusul']    = $is_pengusul;
        $data['sangat_setuju']  = $sangat_setuju;
        $data['setuju']         = $setuju;
        $data['tidak_setuju']   = $tidak_setuju;
        $data['sangat_tidak_setuju']    = $sangat_tidak_setuju;
        $data['ikm']            = $ikm;
        $data['mutu']           = $mutu;
        $data['kinerja']        = $kinerja;

        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['message']        = $message;
        $data['flashdata']      = $flashdata;
        $data['post']           = $post;
        $data['main_content']   = 'services/ikm';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * IKM Add
	 */
	public function ikm_listadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $question               = $this->input->post('reg_question');
        $question               = trim( smit_isset($question, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_title','Judul Pertanyaan','required');
        $this->form_validation->set_rules('reg_question','Pertanyaan','required');
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            $ikm_data  = array(
                'uniquecode'    => smit_generate_rand_string(10,'low'),
                'title'         => $title,
                'question'      => $question,
                'status'        => ACTIVE,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate,
            );

            // -------------------------------------------------
            // Save IKM
            // -------------------------------------------------
            $trans_save_ikm        = FALSE;
            if( $ikm_save_id       = $this->Model_Service->save_data_ikm_list($ikm_data) ){
                $trans_save_ikm    = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_ikm ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran Pengukuran IKM tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran Pengukuran IKM baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'IKMLIST_REG', 'SUCCESS', maybe_serialize(array('username'=>$current_user->username, 'question'=> smit_isset($question,''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran Pengukuran IKM tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * IKM list data function.
	 */
    function ikmlistdata(){
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
        $s_question         = $this->input->post('search_question');
        $s_question         = smit_isset($s_question, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');


        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_question) )       { $condition .= str_replace('%s%', $s_question, ' AND %question% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%question% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $ikm_list           = $this->Model_Service->get_all_ikmlist($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($ikm_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($ikm_list as $row){
                $btn_edit           = '<a class="ikmdataedit btn btn-xs btn-warning waves-effect tooltips" data-placement="left" data-uniquecode="'.$row->uniquecode.'" data-title="'.$row->title.'" data-question="'.$row->question.'" title="Ubah"><i class="material-icons">edit</i></a>';

                // Status
                if($row->status == NONACTIVE)   { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACTIVE)  { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == BANNED)  { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == DELETED) { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $records["aaData"][] = array(
                    smit_center('<input name="ikmlist[]" class="cblist filled-in chk-col-blue" id="cblist_ikmlist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist_ikmlist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    $row->title,
                    $row->question,
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_edit ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $ikmlist                = $_REQUEST['ikmlist'];

            $proses                 = $this->ikmlistproses($sGroupActionName, $ikmlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * IKM List Proses function.
	 */
    function ikmlistproses($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            if( $action=='delete' ){
                $ikmlistdelete          = $this->Model_Service->delete_ikmlist($uniquecode);
            }else{
                $data_update = array('status'=>$status, 'datemodified'=>$curdate);
                $this->Model_Service->update_ikmlist($uniquecode, $data_update);
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar ikm selesai di proses',
        );
        return $response;
    }

    /**
	 * IKM Data list data function.
	 */
    function ikmdatalistdata(){
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

        $s_email            = $this->input->post('search_email');
        $s_email            = smit_isset($s_question, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_email) )          { $condition .= str_replace('%s%', $s_email, ' AND %$email% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%email% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%datecreated% ' . $sort; }

        $ikm_list           = $this->Model_Service->get_all_ikmdata($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($ikm_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($ikm_list as $row){
                $btn_edit       = '<a href="'.base_url('ikmlist/ubah/'.$row->uniquecode).'"
                    class="ikmedit btn btn-xs btn-warning waves-effect tooltips bottom5" id="btn_ikm_edit" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';

                $btn_action     = '<a href="'.base_url('ikmlist/hapus/'.$row->uniquecode).'"
                    class="ikm btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a> ';

                $records["aaData"][] = array(
                    smit_center('<input name="ikmdatalist[]" class="cblist filled-in chk-col-blue" id="cblist_ikmdatalist'.$row->uniquecode.'" value="' . $row->uniquecode . '" type="checkbox"/>
                    <label for="cblist_ikmdatalist'.$row->uniquecode.'"></label>'),
                    smit_center($i),
                    $row->email,
                    $row->comment,
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    '',
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $ikmdatalist            = $_REQUEST['ikmdatalist'];

            $proses                 = $this->ikmdatadelete($sGroupActionName, $ikmdatalist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * IKM Data Delete function.
	 */
    function ikmdatadelete($action, $data){
        $response = array();

        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        elseif( $action=='banned' ) { $actiontxt = 'Banned'; $status = BANNED; }
        elseif( $action=='delete' ) { $actiontxt = 'Hapus'; $status = DELETED; }

        $data = (object) $data;
        foreach( $data as $key => $uniquecode ){
            $ikmdata            = $this->Model_Service->get_all_ikmdata(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $ikmdata            = $ikmdata[0];
            $id                 = $ikmdata->id;

            if( !empty($ikmdata) ){
                $delete_ikm     = $this->Model_Service->delete_ikm('ikmdata', $id);
                if( !empty($delete_ikm) ){
                    $ikmdatadelete      = $this->Model_Service->delete_ikmdata($uniquecode);
                }
            }
        }

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data daftar ikm data selesai di proses',
        );
        return $response;
    }

    /**
	 * IKM Data Edit
	 */
	public function ikmdataedit()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $uniquecode             = $this->input->post('reg_uniquecode');
        $uniquecode             = trim( smit_isset($uniquecode, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $question               = $this->input->post('reg_question');
        $question               = trim( smit_isset($question, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_uniquecode','Uniquecode','required');
        $this->form_validation->set_rules('reg_title','Judul Pertanyaan','required');
        $this->form_validation->set_rules('reg_question','Pertanyaan','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah IKM Data tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $ikm_data  = array(
            'title'      => $title,
            'question'   => $question,
        );

        // -------------------------------------------------
        // Edit Companion
        // -------------------------------------------------
        $trans_edit_ikm        = FALSE;
        if( $ikm_edit_id       = $this->Model_Service->update_ikmdata($uniquecode, $ikm_data) ){
            $trans_edit_ikm    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah IKM Data tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_edit_ikm ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Ubah IKM Data tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Ubah IKM Data baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah IKM Data tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * IKM Score list data function.
	 */
    function ikmscorelistdata(){
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

        $s_question         = $this->input->post('search_question');
        $s_question         = smit_isset($s_question, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');


        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_question) )       { $condition .= str_replace('%s%', $s_question, ' AND %question% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%question% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }

        $ikmscore_list      = $this->Model_Service->get_all_ikmscorelist($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        $ikm_list           = $this->Model_Service->get_all_ikmlist($limit, $offset, $condition, $order_by);
        if( !empty($ikm_list) ){
            foreach($ikm_list AS $row){
                $sangat_setuju  = $this->Model_Service->count_all_answer($row->id, SANGAT_SETUJU);
                $setuju         = $this->Model_Service->count_all_answer($row->id, SETUJU);
                $tidak_setuju   = $this->Model_Service->count_all_answer($row->id, TIDAK_SETUJU);
                $sangat_tidak_setuju    = $this->Model_Service->count_all_answer($row->id, SANGAT_TIDAK_SETUJU);
                $total          = $this->Model_Service->count_all_answer($row->id);
    
                $dataset[]      = array(
                    'ikm_id'                => $row->id,
                    'question'              => $row->question,
                    'sangat_setuju'         => $sangat_setuju,
                    'setuju'                => $setuju,
                    'tidak_setuju'          => $tidak_setuju,
                    'sangat_tidak_setuju'   => $sangat_tidak_setuju,
                    'total'                 => $total
                );
            }    
        }
        

        if( !empty($dataset) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('ikm_status');
            $total_ikmlist  = $this->Model_Service->count_all_ikmlist();
            $penimbang      = number_format(1/$total_ikmlist, 3);

            $i = $offset + 1;
            foreach($dataset as $row){
                $score  = '<table class="table-container table-responsive">';
                $score  .= '<tr>';
                $score  .= '<th class="width15">'.strtoupper($cfg_status[SANGAT_SETUJU]).'</th>';
                $score  .= '<td class="width5 text-center">'.$row['sangat_setuju'].'</td>';

                $score  .= '</tr>';
                $score  .= '<tr>';
                $score  .= '<th class="width15">'.strtoupper($cfg_status[SETUJU]).'</th>';
                $score  .= '<td class="width5 text-center">'.$row['setuju'].'</td>';
                $score  .= '</tr>';

                $score  .= '<tr>';
                $score  .= '<th class="width15">'.strtoupper($cfg_status[TIDAK_SETUJU]).'</th>';
                $score  .= '<td class="width5 text-center">'.$row['tidak_setuju'].'</td>';
                $score  .= '</tr>';

                $score  .= '<tr>';
                $score  .= '<th class="width15">'.strtoupper($cfg_status[SANGAT_TIDAK_SETUJU]).'</th>';
                $score  .= '<td class="width5 text-center">'.$row['sangat_tidak_setuju'].'</td>';
                $score  .= '</tr>';
                $score  .= '</table>';

                $nilai          = $this->Model_Service->sum_all_answer($row['ikm_id']);
                $total_unsur    = $this->Model_Service->count_all_answer($row['ikm_id']);
                $nilai_rata     = number_format($nilai / $total_unsur, 1);
                $rata_penimbang = number_format($nilai_rata * $penimbang, 1);
                $ikm            = $nilai_rata * $rata_penimbang;
                $ikm            = floor($ikm);

                $mutu           = ' - ';
                $kenerja        = ' - ';
                $penimbang_full = ($penimbang * 100) * 100;
                if($ikm <= floor($penimbang_full*45/100)){
                    $mutu       = 'D';
                    $kinerja    = 'Tidak Baik';
                }elseif($ikm > floor($penimbang_full*45/100) && $ikm <= floor($penimbang_full*65/100)){
                    $mutu       = 'C';
                    $kinerja    = 'Kurang Baik';
                }elseif($ikm > floor($penimbang_full*65/100) && $ikm <= floor($penimbang_full*85/100)){
                    $mutu       = 'B';
                    $kinerja    = 'Baik';
                }elseif($ikm > floor($penimbang_full*85/100) && $ikm <= $penimbang_full){
                    $mutu       = 'A';
                    $kinerja    = 'Sangat Baik';
                }

                $records["aaData"][] = array(
                    smit_center($i),
                    $row['question'],
                    $score,
                    smit_center( $row['total'] ),
                    smit_center( $nilai ),
                    smit_center( number_format($nilai_rata, 1) ),
                    smit_center( number_format($rata_penimbang, 1) ),
                    smit_center( number_format($ikm) ),
                    smit_center( $mutu ),
                    smit_center( $kinerja ),
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

    // Category Produk
    // ----------------------------------------------------------------------------------------------------------------------
    /**
	 * Category Product Add
	 */
	public function categoryproductadd()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_category','Nama Kategori','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran kategori produk tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $category_data  = array(
            'category_name' => strtoupper($category),
            'category_slug' => smit_slug($category)
        );

        // -------------------------------------------------
        // Save Category
        // -------------------------------------------------
        $trans_save_category        = FALSE;
        if( $category_save_id       = $this->Model_Option->save_data_category_product($category_data) ){
            $trans_save_category    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran kategori produk tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_category ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Pendaftaran kategori produk tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Pendaftaran kategori produk baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran kategori produk tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * Category Product list data function.
	 */
    function categoryproductlistdata(){
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

        $s_category         = $this->input->post('search_category');
        $s_category         = smit_isset($s_category, '');

        if( !empty($s_category) )   { $condition .= str_replace('%s%', $s_category, ' AND %category_name% LIKE "%%s%%"'); }
        if( $column == 1 )          { $order_by .= '%category_name% ' . $sort; }
        $category_list      = $this->Model_Option->get_all_category_product($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($category_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($category_list as $row){
                // Button
                $btn_action = '<a class="categoryproductedit btn btn-xs btn-warning waves-effect tooltips" data-placement="left" data-id="'.$row->category_id.'" data-name="'.$row->category_name.'" title="Ubah"><i class="material-icons">edit</i></a>';
                $records["aaData"][] = array(
                    smit_center('<input name="categoryproductlist[]" class="cblist filled-in chk-col-blue" id="cblist_categoryproduct'.$row->category_id.'" value="' . $row->category_id . '" type="checkbox"/>
                    <label for="cblist_categoryproduct'.$row->category_id.'"></label>'),
                    smit_center($i),
                    $row->category_name,
                    smit_center( $btn_action ),
                );
                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $categoryproductlist    = $_REQUEST['categoryproductlist'];

            $proses                 = $this->categoryproductdelete($sGroupActionName, $categoryproductlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Category Product Edit
	 */
	public function categoryproductedit()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $category_id            = $this->input->post('reg_id_categoryproduct');
        $category               = $this->input->post('reg_categoryproduct');
        $category               = trim( smit_isset($category, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_id_categoryproduct','ID Kategori Produk','required');
        $this->form_validation->set_rules('reg_categoryproduct','Nama Kategori Produk','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah kategori produk tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $category_data  = array(
            'category_name'     => $category,
        );

        // -------------------------------------------------
        // Edit Category Product
        // -------------------------------------------------
        $trans_edit_category        = FALSE;
        if( $category_edit_id       = $this->Model_Option->update_categoryproduct($category_id, $category_data) ){
            $trans_edit_category    = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah kategori produk tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_edit_category ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => 'Ubah kategori produk tidak berhasil. Terjadi kesalahan data transaksi database.'
                ); die(json_encode($data));
            }else{
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();

                // Set JSON data
                $data       = array('message' => 'success', 'data' => 'Ubah kategori produk baru berhasil!');
                die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Ubah kategori produk tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    /**
	 * Category Product Delete function.
	 */
    function categoryproductdelete($action, $categoryproduct){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        if ( !$categoryproduct ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'ID kategori produk harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Hapus kategori produkhanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };

        foreach($categoryproduct AS $id){
            $categorydata       = $this->Model_Option->get_categoryproductdata($id);
            if( !$categorydata ){
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Data kategori produk tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            if( $this->Model_Option->delete_categoryproduct($categorydata->category_id) ){
                // Set JSON data
                $data = array('msg' => 'success','message' => 'Data kategori produk berhasil dihapus.');
            }else{
                // Set JSON data
                $data = array('msg' => 'error','message' => 'Hapus data kategori produk tidak berhasil dilakukan.');
            }
        }
        // JSON encode data
        die(json_encode($data));
    }

    // ----------------------------------------------------------------------------------------------------------------------

}

/* End of file backend.php */
/* Location: ./application/controllers/backend.php */
