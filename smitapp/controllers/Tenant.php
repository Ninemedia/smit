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
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',

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
            'TenantValidation.init();',
        ));

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
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
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
            'Tenant.init();',
            'UploadFiles.init();',
            'TenantValidation.init();',
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
        $is_pendamping          = as_pendamping($current_user);

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
            'TableAjax.init();',
        ));

        $scripts_add            = '';

        $data['title']          = TITLE . 'Pendampingan Tenant';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pendamping']  = $is_pendamping;
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
	 * Pra Incubation Accompaniment list data function.
	 */
    function accompanimentlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_pendamping      = as_pendamping($current_user);

        $condition          = ' WHERE %companion_id% > 0 ';
        if( !$is_admin ){
            if( !empty($is_pendamping) ){
                $condition          = ' WHERE %companion_id% = '.$current_user->id.'';
            }else{
                $condition      = ' WHERE %user_id% = '.$current_user->id.'';
            }
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

        $s_tenant_name      = $this->input->post('search_tenant_name');
        $s_tenant_name      = smit_isset($s_tenant_name, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_companion_name   = $this->input->post('search_companion_name');
        $s_companion_name   = smit_isset($s_companion_name, '');

        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_tenant_name) )    { $condition .= str_replace('%s%', $s_tenant_name, ' AND %tenant_name% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_companion_name) ) { $condition .= str_replace('%s%', $s_companion_name, ' AND %companion_name% = %s%'); }

        if( $is_admin ){
            if( $column == 1 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%tenant_name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%companion_name% ' . $sort; }
        }else{
            if( $column == 1 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%tenant_name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
        }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($tenant_list as $row){

                $companiondata      = $this->Model_User->get_userdata($row->companion_id);
                if( !empty($companiondata) ){
                    $companion_name = '<a href="'.base_url('pengguna/profil/'.$row->companion_id).'">' . strtoupper($companiondata->name) . '</a>';
                }else{ $companion_name = "<center style='color : red !important; '><strong>BELUM ADA PENDAMPING</strong></center>"; }

                // Button
                $btn_detail         = '<a href="'.base_url('prainkubasi/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                if( !empty($is_admin) ){
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name_tenant),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->user_name) . '</a>',
                        strtoupper($row->name),
                        strtoupper($companion_name),
                        smit_center( $btn_detail ),
                    );
                }elseif( !empty($is_pendamping) ){
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name_tenant),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->user_name) . '</a>',
                        strtoupper($row->name),
                        smit_center( $btn_detail ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name_tenant),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->user_name) . '</a>',
                        strtoupper($row->name),
                        strtoupper($companion_name),
                        smit_center( $btn_detail ),
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
	 * Product Tenant function.
	 */
	public function tenantproduct()
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
            'ProductValidation.init();',
        ));

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
            'PaymentValidation.init();',
        ));

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
	 * Payment Add
	 */
	public function paymentadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');

        $tenant_id              = $this->input->post('reg_event');
        $tenant_id              = trim( smit_isset($tenant_id, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Nama Tenant','required');
        $this->form_validation->set_rules('reg_title','Judul Pembayaran','required');
        $this->form_validation->set_rules('reg_desc','Keterangan','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pembayaran tenant tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['news_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada bukti pembayaran yang di unggah. Silahkan inputkan bukti pembayaran!');
            die(json_encode($data));
        }

        $tenantdata     = $this->Model_Tenant->get_all_tenant(0, 0, ' WHERE %id% = '.$tenant_id.'');
        $tenantdata     = $tenantdata[0];

        if( !empty( $_POST ) ){
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantpayment/' . $tenantdata->user_id;
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

                //$this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(500,500)->save($upload_path. '/' .$upload_file, TRUE);
                //$this->image_moo->clear();

                $status         = NONACTIVE;
                if( $is_admin ){
                    $status     = ACTIVE;
                }

                $payment_data       = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'invoice'       => smit_generate_invoice(1, 'num'),
                    'tenant_id'     => $tenant_id,
                    'user_id'       => $tenantdata->user_id,
                    'username'      => strtolower($tenantdata->username),
                    'name'          => $tenantdata->name,
                    'title'         => $title,
                    'desc'          => $description,
                    'url'           => smit_isset($upload_data['full_path'],''),
                    'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                    'filename'      => smit_isset($upload_data['raw_name'],''),
                    'size'          => smit_isset($upload_data['file_size'],0),
                    'uploader'      => $tenantdata->id,
                    'status'        => $status,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );
            }

            // -------------------------------------------------
            // Save Payment
            // -------------------------------------------------
            $trans_save_payment        = FALSE;
            if( $payment_save_id       = $this->Model_Incubation->save_data_payment($payment_data) ){
                $trans_save_payment    = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pembayaran tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $payment_data ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pembayaran tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pembayaran tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PAYEMENT_REG', 'SUCCESS', maybe_serialize(array('username'=>$tenantdata->username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pembayaran tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Tenant Payment list data function.
	 */
    function paymentlistdata(){
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

        $s_invoice          = $this->input->post('search_invoice');
        $s_invoice          = smit_isset($s_invoice, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_invoice) )        { $condition .= str_replace('%s%', $s_invoice, ' AND %invoice% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%invoice% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $payment_list       = $this->Model_Incubation->get_all_payment($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($payment_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($payment_list as $row){
                // Button
                $btn_action = '<a href="'.base_url('pembayaran/detail/'.$row->uniquecode).'" class="newsdetail btn btn-xs btn-primary waves-effect tooltips bottom5" id="btn_news_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                $btn_edit   = '<a href="'.base_url('pembayaran/edit/'.$row->uniquecode).'" class="newsedit btn btn-xs btn-warning waves-effect tooltips bottom5" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';
                $btn_delete = '<a href="'.base_url('pembayaran/hapus/'.$row->uniquecode).'" class="newsdelete btn btn-xs btn-danger waves-effect tooltips bottom5" data-placement="left" title="Hapus"><i class="material-icons">clear</i></a>';

                $file_name      = $row->filename . '.' . $row->extension;
                $file_url       = BE_UPLOAD_PATH . 'tenantpayment/'.$row->user_id.'/' . $file_name;
                $image          = $file_url;
                $image          = '<img class="js-animating-object img-responsive" src="'.$image.'" alt="'.$row->title.'" />';

                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    if( !empty($is_admin) ){
                        $btn_action     .= '<a href="'.base_url('pembayaranconfirm/active/'.$row->uniquecode).'" class="pembayaranconfirm btn btn-xs btn-success tooltips waves-effect bottom5" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                    }
                }
                if( !$is_admin ){
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                }
                if( !empty($is_admin) ){
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                    }
                }

                $records["aaData"][] = array(
                    smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                    <label for="cblist'.$row->id.'"></label>'),
                    smit_center($i),
                    $row->invoice,
                    '<a href="'.base_url('pembayaran/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $image,
                    smit_center( $status ),
                    smit_center( date('d F Y H:i:s', strtotime($row->datecreated)) ),
                    smit_center( $btn_action .' '. $btn_edit .' '. $btn_delete ),
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

        if( !empty($is_admin) ){
            $post_username          = $this->input->post('tenant_username');
        }

        $post_selection_id      = $this->input->post('tenant_event_id');
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

        if( !empty($is_admin) ){
            $this->form_validation->set_rules('tenant_username','Username Tenant','required');
        }

        $this->form_validation->set_rules('tenant_event_id','Usulan Kegiatan','required');
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

                // Check Selection Data
                if( !empty($post_selection_id) ){
                    $condition          = " WHERE %id% = ".$post_selection_id."";
                    $data_selection     = $this->Model_Incubation->get_all_incubationdata(0, 0, $condition);
                    $data_selection     = $data_selection[0];
                }

                if( !empty($is_admin) ){
                    // -------------------------------------------------
                    // Check Username
                    // -------------------------------------------------
                    $check_username     = smit_check_username($post_username);
                    if( $check_username == 'invalid' ){
                        // Set JSON data
                        $data = array(
                            'message'   => 'error',
                            'data'      => array(
                                'field' => '',
                                'msg'   => 'Username tidak sesuai dengan kriteria.',
                            )
                        ); die(json_encode($data));
                    }elseif( $check_username == 'notavailable' ){
                        // Set JSON data
                        $data = array(
                            'message'   => 'error',
                            'data'      => array(
                                'field' => '',
                                'msg'   => 'Username ini sudah terdaftar. Silahkan masukkan username lain.',
                            )
                        ); die(json_encode($data));
                    }

                    $datetime               = date( 'Y-m-d H:i:s' );
            		$username				= strtolower( $post_username );
                    $password_global        = get_option('global_password');
                    $phone                  = str_replace(' ','',$post_tenant_phone);
                    $data_user              = array(
                        'username'          => $username,
                        'password'          => $password_global,
                        'name'              => strtoupper($post_tenant_name),
                        'email'             => $post_tenant_email,
                        'type'              => TENANT,
                        'type_basic'        => TENANT,
                        'role'              => TENANT,
                        'phone'             => $phone,
                        'status'            => 1,
                        'datecreated'       => $datetime,
                        'datemodified'      => $datetime,
                    );

                    $user_save_id           = $this->Model_User->save_data($data_user);
                    $tenantdata1             = array(
                        'user_id'       => trim(smit_isset($user_save_id, '')),
                        'username'      => strtolower( trim(smit_isset($username, '')) ),
                        'name'          => strtoupper( trim(smit_isset($post_tenant_name, '')) ),
                    );

                    $update_incubation  = $this->Model_Incubation->update_data_incubationdata($data_selection->id, $tenantdata1);
                }else{
                    $tenantdata1             = array(
                        'user_id'       => trim(smit_isset($data_selection->user_id, '')),
                        'username'      => strtolower( trim(smit_isset($data_selection->username, '')) ),
                        'name'          => strtoupper( trim(smit_isset($data_selection->name, '')) ),
                    );

                    if($data_selection->user_id != 1){ // Tidak Admin
                        $dataUser       = smit_get_userdata_by_id($data_selection->user_id);
                        $current_roles  = $dataUser->role;

                        if( empty($current_roles) ){
                            // Set JSON data
                            $data = array('status' => 'error','message' => 'Terjadi kesalahan, Anda tidak memiliki role untuk dipilih!');
                            die(json_encode($data));
                        }

                        $current_roles      = explode(',', $current_roles);
                        if( !in_array(TENANT, $current_roles) ){
                            $curdate            = date('Y-m-d H:i:s');
                            $arrTenant[]        = TENANT;
                            $arrData            = array_merge($current_roles, $arrTenant);
                            $role               = implode(',', $arrData);

                            $data_update        = array('role' => $role, 'datemodified' => $curdate);
                            $update_data        = $this->Model_User->update_data($data_selection->user_id, $data_update);
                        }
                    }
                }

                $tenantdata2         = array(
                    'uniquecode'    => smit_generate_rand_string(10,'low'),
                    'selection_id'  => trim(smit_isset($data_selection->selection_id, '')),
                    'incubation_id' => trim(smit_isset($post_selection_id, '')),
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
                    'status'        => $is_admin ? 1 : 0,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate,
                );

                $tenantdata         = array_merge($tenantdata1, $tenantdata2);

                // -------------------------------------------------
                // Save Tenant Selection
                // -------------------------------------------------
                $trans_save_tenant       = FALSE;
                if( $save_tenant    = $this->Model_Tenant->save_data_tenant($tenantdata) ){
                    $trans_save_tenant   = TRUE;

                    $update_data_incubation = array(
                        'tenant_id'  => $save_tenant,
                    );

                    $this->Model_Incubation->update_data_incubationdata($post_selection_id, $update_data_incubation);
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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_name_tenant) )    { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_email) )          { $condition .= str_replace('%s%', $s_email, ' AND %email% LIKE "%%s%%"'); }
        if( !empty($s_phone) )          { $condition .= str_replace('%s%', $s_phone, ' AND %phone% LIKE "%%s%%"'); }
        if( !empty($s_event) )           { $condition .= str_replace('%s%', $s_year, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $is_admin ){
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%name_tenant% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%email% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%phone% ' . $sort; }
            elseif( $column == 7 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 8 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name_tenant% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%email% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%phone% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 7 )  { $order_by .= '%datecreated% ' . $sort; }
        }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($tenant_list as $row){
                // Button & Status
                $btn_confirm    = '';
                if( !empty($is_admin) ){
                    if( $row->status == NONACTIVE ){
                        $btn_confirm    = '<a href="'.base_url('tenants/konfirmasi/active/'.$row->user_id).'"
                            class="tenantconfirm btn btn-xs btn-success waves-effect tooltips bottom5" data-placement="left" id="tenantconfirm" title="Konfirmasi"><i class="material-icons">done</i></a> ';
                    }
                }

                $btn_team       = '';
                if( $row->status != NONACTIVE ){
                    $btn_team       = '<a href="'.base_url('tenants/daftar/tim/'.$row->uniquecode).'"
                        class="inact btn btn-xs btn-defaukt waves-effect tooltips bottom5" data-placement="left" title="Tambah Tim"><i class="material-icons">group</i></a> ';
                }
                $btn_action     = '<a href="'.base_url('tenants/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                if($row->status == ACTIVE)          { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == NONACTIVE)   { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == BANNED)      { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == DELETED)     { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                if( $is_admin ){
                    $records["aaData"][] = array(
                        smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                        <label for="cblist'.$row->id.'"></label>'),
                        smit_center( $i ),
                        smit_center( $row->year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper( $row->name ) . '</a>',
                        strtoupper( $row->event_title ),
                        '<strong>'.strtoupper( $row->name_tenant ).'</strong>',
                        $row->email,
                        smit_center( $row->phone ),
                        smit_center( $status ),
                        smit_center( $btn_confirm . ' '. $btn_action . ' ' . $btn_team ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                        <label for="cblist'.$row->id.'"></label>'),
                        smit_center( $i ),
                        smit_center( $row->year ),
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

    /**
	 * Tenant Accepted list data function.
	 */
    function tenantacceptedlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        $condition          = ' WHERE %status% = '.ACTIVE.'';

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

        $s_name_tenant      = $this->input->post('search_name_tenant');
        $s_name_tenant      = smit_isset($s_name_tenant, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_user_name        = $this->input->post('search_user_name');
        $s_user_name        = smit_isset($s_user_name, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');

        if( !empty($s_name_tenant) )    { $condition .= str_replace('%s%', $s_name_tenant, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_user_name) )      { $condition .= str_replace('%s%', $s_user_name, ' AND %user_name% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }

        if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
        elseif( $column == 2)  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 3)  { $order_by .= '%user_name% ' . $sort; }
        elseif( $column == 4)  { $order_by .= '%name% ' . $sort; }

        $tenant_list        = $this->Model_Tenant->get_all_tenant($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();

        if( !empty($tenant_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($tenant_list as $row){
                // Add Companion Button
                $btn_add    = '';
                if($row->companion_id == 0){
                    $btn_add = '<a href="'.base_url('tenants/pendampingan/detail/'.$row->uniquecode).'"
                    class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" title="Tetapkan"><i class="material-icons">account_box</i></a>';
                }

                $records["aaData"][] = array(
                    smit_center($i),
                    strtoupper($row->name_tenant),
                    strtoupper($row->event_title),
                    '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->username) . '</a>',
                    strtoupper($row->user_name),
                    smit_center($btn_add),
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
	 * Tenant Detail list data function.
	 */
    public function companionassignment($uniquecode)
	{
        auth_redirect();

        $curdate                = date('Y-m-d H:i:s');
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        if( !$is_admin ){
            redirect( base_url('dashboard') );
        }

        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
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
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'PraIncubationList.init();',
        ));

        $scripts_add            = '';

        // Custom
        $condition              = '';
        $tenant_list            = '';

        if(!empty($uniquecode)){
            $tenant_list        = $this->Model_Tenant->get_all_tenant('', '', ' WHERE A.uniquecode = "'.$uniquecode.'"', '');
            $tenant_list        = $tenant_list[0];
            $tenant_id          = $tenant_list->id;
        }

        if( !empty($_POST) ){
            $companion_id           = $this->input->post('companion_id');
            $companion_id           = smit_isset($companion_id, '');

            if( empty($companion_id) ){
                $this->session->set_flashdata('message','<div id="alert" class="alert alert-danger">'.smit_alert('Silahkan pilih pendamping!').'</div>');
            }else{
                // Check Companion Data
                $comppanion_data        = smit_get_userdata_by_id($companion_id);
                if( !$comppanion_data || empty($comppanion_data) ){
                    $this->session->set_flashdata('message','<div id="alert" class="alert alert-danger">'.smit_alert('Data pendamping tidak ditemukan atau belum terdaftar').'</div>');
                }else{
                    $tenant_update_data     = array(
                        'companion_id'      => $companion_id,
                        'datemodified'      => $curdate
                    );

                    if( $this->Model_Incubation->update_data_incubationdata($tenant_list->incubation_id, $tenant_update_data) ){
                        redirect( base_url('tenants/pendampingan') );
                    }

                }
            }
        }

        $data['title']              = TITLE . 'Detail Tenant Diterima';
        $data['user']               = $current_user;
        $data['is_admin']           = $is_admin;
        $data['tenant']             = $tenant_list;
        $data['headstyles']         = $headstyles;
        $data['scripts']            = $loadscripts;
        $data['scripts_add']        = $scripts_add;
        $data['scripts_init']       = $scripts_init;
        $data['main_content']       = 'tenant/accepteddetail';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Product Tenant Add Function
	 */
	public function producttenantadd()
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
        $event_title            = $this->input->post('reg_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );
        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_event','Kategori Bidang','required');
        $this->form_validation->set_rules('reg_title','Judul Produk','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi produk','required');
        $this->form_validation->set_rules('reg_category','Kategori Produk','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran produk tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_thumbnail']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }

        $tenant_id      = $event;
        $tenantdata     = $this->Model_Tenant->get_all_tenant(0,0, ' WHERE %id% = '.$tenant_id.'');
        $tenantdata     = $tenantdata[0];
        $userdata       = smit_get_userdata_by_id($tenantdata->user_id);

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantproduct/' . $userdata->id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            if( ! $this->my_upload->do_upload('reg_thumbnail') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_thumbnail  = $this->my_upload->data();
            $upload_thumbnail       = $upload_data_thumbnail['raw_name'] . $upload_data_thumbnail['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_thumbnail['file_name'])->resize_crop(800,600)->save($upload_path. '/' .$upload_thumbnail, TRUE);
            $this->image_moo->clear();

            if( ! $this->my_upload->do_upload('reg_details') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_details    = $this->my_upload->data();
            $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
            $this->image_moo->clear();

            $file_thumbnail         = $upload_data_thumbnail;
            $file_details           = $upload_data_details;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            // Get Category ID
            $categorydata           = $this->Model_Option->get_categoryproductdata($category);
            if( ! $categorydata ){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data kategori tidak ditemukan atau belum terdaftar');
                die(json_encode($data));
            }

            $product_data           = array(
                'uniquecode'        => smit_generate_rand_string(10,'low'),
                'tenant_id'         => $tenant_id,
                'user_id'           => $userdata->id,
                'username'          => strtolower($userdata->username),
                'name'              => strtoupper($userdata->name),
                'title'             => $event_title,
                'description'       => $description,
                'category_id'       => $categorydata->category_id,
                'category_product'  => strtoupper( $categorydata->category_name ),
                'url'               => smit_isset($file_details['full_path'],''),
                'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                'filename'          => smit_isset($file_details['raw_name'],''),
                'size'              => smit_isset($file_details['file_size'],0),
                'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                'status'            => $status,
                'datecreated'       => $curdate,
                'datemodified'      => $curdate,
            );

            // -------------------------------------------------
            // Save Tenant Product Selection
            // -------------------------------------------------
            $trans_save_product       = FALSE;
            if( $product_save_id      = $this->Model_Tenant->save_data_product($product_data) ){
                $trans_save_product   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran product tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_product ){
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
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran product tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'PRODUCTTENANT_REG', 'SUCCESS', maybe_serialize(array('username'=>$userdata->username)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran product tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Product Tenant list data function.
	 */
    function producttenantlistdata(){
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

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $product_list       = $this->Model_Tenant->get_all_product($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($product_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($product_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'"
                    class="sliderdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_produk_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_action .= ' ';
                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    if( !empty($is_admin) ){
                        $btn_action     .= '<a href="'.base_url('produkconfirm/active/'.$row->uniquecode).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                    }
                }
                if( !$is_admin ){
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';
                    }
                }
                if( !empty($is_admin) ){
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
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

                $file_name      = $row->filename . '.' . $row->extension;
                $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'.$row->user_id.'/' . $file_name;
                $product        = $file_url;
                $product        = '<img class="js-animating-object img-responsive" src="'.$product.'" alt="'.$row->title.'" />';

                $records["aaData"][] = array(
                    smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                    <label for="cblist'.$row->id.'"></label>'),
                    smit_center($i),
                    strtoupper($row->name),
                    strtoupper($row->event_title),
                    '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    $product,
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
    * Product Details function.
    */
    public function productdetails( $uniquecode='' ){
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
            $productdata        = $this->Model_Tenant->get_all_product(0, 0, ' WHERE %uniquecode% LIKE "'.$uniquecode.'"');
            $productdata        = $productdata[0];
        }

        if($productdata){
            $file_name      = $productdata->filename . '.' . $productdata->extension;
            $file_url       = BE_UPLOAD_PATH . 'tenantproduct/'. $productdata->user_id . '/' . $file_name;
            $product_image  = $file_url;
        }else{
            $product_image  = BE_IMG_PATH . 'news/noimage.jpg';
        }

        $data['title']          = TITLE . 'Produk Detail';
        $data['productdata']    = $productdata;
        $data['product_image']  = $product_image;
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'tenant/productdetail';

        $this->load->view(VIEW_BACK . 'template', $data);
    }


    // ---------------------------------------------------------------------------------------------
    // BLOG TENANT
    /**
	 * Blog Tenant Add Function
	 */
	public function addblogtenant()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $product_id             = $this->input->post('reg_product');
        $product_id             = trim( smit_isset($product_id, "") );
        $title                  = $this->input->post('reg_title');
        $title                  = trim( smit_isset($title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_product','Usulan','required');
        $this->form_validation->set_rules('reg_title','Judul Blog','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Blog','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran blog tenant baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        if( empty($_FILES['reg_thumbnail']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada thumbnail yang di unggah. Silahkan inputkan thumbnail gambar!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_details']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada details gambar yang di unggah. Silahkan inputkan details gambar kegiatan!');
            die(json_encode($data));
        }

        $tenantdata     = $this->Model_Tenant->get_all_tenant(0,0, ' WHERE %product_id% = '.$product_id.'');
        $tenantdata     = $tenantdata[0];

        if( !empty( $_POST ) ){
            // -------------------------------------------------
            // Begin Transaction
            // -------------------------------------------------
            $this->db->trans_begin();

            // Upload Files Process
            $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/tenantblog/' . $tenantdata->user_id;
            if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

            $config = array(
                'upload_path'       => $upload_path,
                'allowed_types' => "jpg|jpeg|png",
                'overwrite'         => FALSE,
                'max_size'          => "2048000",
            );
            $this->load->library('MY_Upload', $config);

            if( ! $this->my_upload->do_upload('reg_thumbnail') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_thumbnail  = $this->my_upload->data();
            $upload_thumbnail       = $upload_data_thumbnail['raw_name'] . $upload_data_thumbnail['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_thumbnail['file_name'])->resize_crop(800,600)->save($upload_path. '/' .$upload_thumbnail, TRUE);
            $this->image_moo->clear();

            if( ! $this->my_upload->do_upload('reg_details') ){
                $message = $this->my_upload->display_errors();

                // Set JSON data
                $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                die(json_encode($data));
            }
            $upload_data_details    = $this->my_upload->data();
            $upload_file            = $upload_data_details['raw_name'] . $upload_data_details['file_ext'];
            $this->image_moo->load($upload_path . '/' .$upload_data_details['file_name'])->resize_crop(1346,400)->save($upload_path. '/' .$upload_file, TRUE);
            $this->image_moo->clear();

            $file_thumbnail         = $upload_data_thumbnail;
            $file_details           = $upload_data_details;

            $status     = NONACTIVE;
            if( !empty($is_admin) ){
                $status = ACTIVE;
            }

            $blog_data              = array(
                'uniquecode'        => smit_generate_rand_string(10,'low'),
                'product_id'        => $product_id,
                'user_id'           => $tenantdata->user_id,
                'username'          => strtolower($tenantdata->username),
                'name'              => strtoupper($tenantdata->name),
                'title'             => $title,
                'description'       => $description,
                'url'               => smit_isset($file_details['full_path'],''),
                'extension'         => substr(smit_isset($file_details['file_ext'],''),1),
                'filename'          => smit_isset($file_details['raw_name'],''),
                'size'              => smit_isset($file_details['file_size'],0),
                'thumbnail_url'           => smit_isset($file_thumbnail['full_path'],''),
                'thumbnail_extension'     => substr(smit_isset($file_thumbnail['file_ext'],''),1),
                'thumbnail_filename'      => smit_isset($file_thumbnail['raw_name'],''),
                'thumbnail_size'          => smit_isset($file_thumbnail['file_size'],0),
                'status'            => $status,
                'datecreated'       => $curdate,
                'datemodified'      => $curdate,
            );

            // -------------------------------------------------
            // Save Tenant Blog
            // -------------------------------------------------
            $trans_save_blog_tenant       = FALSE;
            if( $blog_save_id               = $this->Model_Tenant->save_data_blogtenant($blog_data) ){
                $trans_save_blog_tenant   = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran blog tenant tidak berhasil. Terjadi kesalahan data formulir anda');
                die(json_encode($data));
            }

            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_blog_tenant ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Pendaftaran blog tenant tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();

                    // Send Email Notification
                    //$this->smit_email->send_email_registration_selection($userdata->email, $event_title);

                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Pendaftaran blog tenant baru berhasil!');
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'BLOGTENANT_REG', 'SUCCESS', maybe_serialize(array('username'=>$tenantdata->username)) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Pendaftaran blog tenant tidak berhasil. Terjadi kesalahan data.');
                die(json_encode($data));
            }
        }
	}

    /**
	 * Blog Tenant list data function.
	 */
    function blogtenantlistdata(){
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

        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name_tenant% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )  { $order_by .= '%name_tenant% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }

        $blog_list          = $this->Model_Tenant->get_all_blogtenant($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($blog_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('user_status');

            $i = $offset + 1;
            foreach($blog_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'"
                    class="sliderdetailset btn btn-xs btn-primary waves-effect tooltips" id="btn_produk_detail" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a>';
                $btn_action .= ' ';
                if($row->status == NONACTIVE)   {
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>';
                    if( !empty($is_admin) ){
                        $btn_action     .= '<a href="'.base_url('produkconfirm/active/'.$row->uniquecode).'" class="produkconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                    }
                }
                if( !$is_admin ){
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>';
                    }
                }
                if( !empty($is_admin) ){
                    if($row->status == ACTIVE)  {
                        $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>';
                        $btn_action     .= '
                        <a href="'.($row->user_id == 1 ? base_url('produkconfirm/edit/'.$row->uniquecode) : 'javascript:;' ).'" class="produkconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Ubah"><i class="material-icons">edit</i></a>
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

                $file_name      = $row->filename . '.' . $row->extension;
                $file_url       = BE_UPLOAD_PATH . 'tenantblog/'.$row->user_id.'/' . $file_name;
                $image          = $file_url;
                $image          = '<img class="js-animating-object img-responsive" src="'.$image.'" alt="'.$row->title.'" />';

                $records["aaData"][] = array(
                    smit_center('<input name="userlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="' . $row->id . '" type="checkbox"/>
                    <label for="cblist'.$row->id.'"></label>'),
                    smit_center($i),
                    strtoupper($row->name),
                    '<a href="'.base_url('tenants/produk/detail/'.$row->uniquecode).'">' . strtoupper($row->title) . '</a>',
                    strtoupper($row->product_title),
                    $image,
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

    // ---------------------------------------------------------------------------------------------
}

/* End of file tenant.php */
/* Location: ./application/controllers/tenant.php */
