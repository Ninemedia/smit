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
            $penimbang      = number_format(1/$total_ikmlist, 3);
            $penimbang_full = ($penimbang * 100) * 100;

            $ikm            = smit_get_total_ikm();
            $ikm            = $ikm/$total_ikmlist;
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
                // Button
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
                    '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'">' . $row->title . '</a>',
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
                
                // Button
                $btn_action = '<a href="'.base_url('pengumuman/detail/'.$row->uniquecode).'"
                    class="announdetailset btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_announ_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>
                    <a href="'.base_url('pengumuman/hapus/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a> ';

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('guidefiles/'.$row->id).'">' . $row->title . '</a>',
                    $row->description,
                    smit_center( $btn_files ),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
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
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
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
                    'status'        => ACTIVE,
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
                    'status'        => ACTIVE,
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

        if( !empty($s_no_news) )        { $condition .= str_replace('%s%', $s_no_news, ' AND %no_news% LIKE "%%s%%"'); }
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
                // Button
                $btn_action = '<a href="'.base_url('berita/detail/'.$row->uniquecode).'" class="newsdetailset btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_news_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_delete = '<a href="'.base_url('berita/hapus/'.$row->uniquecode).'" class="news btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a>';

                $records["aaData"][] = array(
                    smit_center($i),
                    $row->no_news,
                    '<a href="'.base_url('berita/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $row->source,
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action .' '. $btn_delete ),
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

                // Status
                $btn_action = '<a data-toggle="modal" data-target="#edit_category" class="inact btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
                <a href="'.($row->category_id>1 ? base_url('categoryconfirm/delete/'.$row->category_id) : 'javascript:;' ).'" class="categorydelete btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus" '.($row->category_id==0 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                $records["aaData"][] = array(
                    smit_center($i),
                    $row->category_name,
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
            'NotesValidation.init();',
        ));

        $data['title']          = TITLE . 'Laporan Notulensi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
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
	public function notesadd()
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

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Usulan Kegiatan','required');
        $this->form_validation->set_rules('reg_title','Judul Notulensi','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Notulensi','required');

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
            $data = array('message' => 'error','data' => 'Berkas botulensi yang di unggah. Silahkan inputkan Berkas botulensi!');
            die(json_encode($data));
        }

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/accompaniment/' . $current_user->id;
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
                'user_id'       => $current_user->id,
                'username'      => strtolower($current_user->username),
                'name'          => strtoupper($current_user->name),
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
            // Save Notes Pra-Incubation Selection
            // -------------------------------------------------
            $trans_save_notes           = FALSE;
            if( $notes_save_id      = $this->Model_Praincubation->save_data_notes($notes_data) ){
                $trans_save_notes   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran product pra-inkubasi tidak berhasil. Terjadi kesalahan data formulir anda');
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
                $btn_action = '<a href="'.base_url('notulensi/detail/'.$row->uniquecode).'"
                    class="sliderdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_produk_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_action .= ' ';
                
                if( !$is_admin ){
                    if($row->status == NONACTIVE)   {
                        $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('notes/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';
                    }
                }
                
                if( !empty($is_admin) ){
                    if($row->status == NONACTIVE)   {
                        $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '<a href="'.base_url('produkconfirm/active/'.$row->uniquecode).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                    }
                    
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/banned/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Banned" '.($current_user->id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">block</i></a>
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/delete/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Hapus" '.($current_user->id > 1 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                    }
                }

                elseif($row->status == BANNED)  {
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>';
                    $btn_action     .= '<a href="'.base_url('produkconfirm/active/'.$row->uniquecode).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == DELETED) {
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>';
                    $btn_action     .= '<a href="'.base_url('produkconfirm/active/'.$row->uniquecode).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                
                if( !empty( $row->url ) ){
                    $btn_files  = '<a href="'.base_url('unduh/notulensiprainkubasi/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-default waves-effect tooltips bottom5" data-placement="left" title="Download File"><i class="material-icons">file_download</i></a> ';
                }else{
                    $btn_files  = ' - ';
                }

                $records["aaData"][] = array(
                    smit_center($i),
                    strtoupper($row->name),
                    '<a href="'.base_url('prainkubasi/daftar/detail/'.$row->uniquecode_praincubation).'">' . strtoupper($row->event_title) . '</a>',
                    '<a href="'.base_url('notulensi/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
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

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
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
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/accompaniment/' . $notesdata->user_id . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
	public function accompanimentincubation()
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);

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

        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
        ));

        $data['title']          = TITLE . 'Laporan Notulensi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'accompaniment/incubation';

        $this->load->view(VIEW_BACK . 'template', $data);
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
        if ( $stats = $this->Model_User->stats_yearly() ) {
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

				//$pivot[ $row->period ][ 'period_name' ] = $row->period_name;
				$pivot[ $row->period ][ 'total' ] += $row->total;
				$pivot[ $row->period ][ $type ] = $row->total;
			}

            $chart_year['xkey']      = 'period';
            $chart_year['ykeys']     = array( 'pendamping', 'tenant', 'juri', 'pengusul', 'pelaksana', 'pelaksana_tenant' );
            $chart_year['labels']    = array( 'Pendamping', 'Tenant', 'Juri', 'Pengusul', 'Pelaksana', 'Pelaksana & Tenant' );

            foreach( $pivot as $period => $row ) {
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

        $data['title']          = TITLE . 'Info Grafis Pra-Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'infografis/praincubation';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

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

        $data['title']          = TITLE . 'Info Grafis Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'infografis/incubation';

		// Log for dashboard
		if ( ! $this->session->userdata( 'log_dashboard' ) ) {
			$this->session->set_userdata( 'log_dashboard', true );
		}

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

        $sangat_setuju  = $this->Model_Service->count_all_answer(0, SANGAT_SETUJU);
        $setuju         = $this->Model_Service->count_all_answer(0, SETUJU);
        $tidak_setuju   = $this->Model_Service->count_all_answer(0, TIDAK_SETUJU);
        $sangat_tidak_setuju    = $this->Model_Service->count_all_answer(0, SANGAT_TIDAK_SETUJU);

        $total_ikmlist  = $this->Model_Service->count_all_ikmlist();
        $penimbang      = number_format(1/$total_ikmlist, 3);
        $penimbang_full = ($penimbang * 100) * 100;

        $ikm            = smit_get_total_ikm();
        $ikm            = $ikm/$total_ikmlist;
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
                $btn_edit       = '<a href="'.base_url('ikmlist/ubah/'.$row->uniquecode).'"
                    class="ikmedit btn btn-xs btn-warning waves-effect tooltips bottom5" id="btn_ikm_edit" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';

                $btn_action     = '<a href="'.base_url('ikmlist/hapus/'.$row->uniquecode).'"
                    class="ikm btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a> ';

                // Status
                if($row->status == NONACTIVE)   { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACTIVE)  { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == BANNED)  { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == DELETED) { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $records["aaData"][] = array(
                    smit_center($i),
                    $row->title,
                    $row->question,
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_edit . ' ' . $btn_action ),
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

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
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
    // ----------------------------------------------------------------------------------------------------------------------

}

/* End of file backend.php */
/* Location: ./application/controllers/backend.php */
