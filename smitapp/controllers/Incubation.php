<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Incubation Controller.
 * 
 * @class     Incubation
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class Incubation extends User_Controller {
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

        $data['title']          = TITLE . 'Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    // ---------------------------------------------------------------------------------------------
    // INCUBATION
    /**
	 * List Incubation function.
	 */
	public function incubationlist()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        if( !$is_admin ){
            redirect( base_url('dashboard') );
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
            'IncubationList.init();',
        ));
        
        $scripts_add            = '';

        $data['title']          = TITLE . 'Daftar Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation/list';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Incubation list data function.
	 */
    function incubationlistdatastep1( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = ' WHERE step = 1 '; 
        
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
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('inkubasi/daftar/detail/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                
                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('pengguna/profil/'.$row->id).'">' . strtoupper($row->name) . '</a>',
                    strtoupper($workunit_type->workunit_name),
                    strtoupper($row->event_title),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
                    smit_center( $status ),
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
	 * Incubation list data function.
	 */
    function incubationlistdatastep2( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = ' WHERE steptwo = 2 ';
        
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
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('inkubasi/daftar/detail/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';
                
                if($row->statustwo == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('pengguna/profil/'.$row->id).'">' . strtoupper($row->name) . '</a>',
                    strtoupper($workunit_type->workunit_name),
                    strtoupper($row->event_title),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
                    smit_center( $status ),
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
	 * Incubation Detail list data function.
	 */
    public function incubationdetails($uniquecode)
	{
        auth_redirect();
        
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
            'IncubationList.init();',
        ));
        
        $scripts_add                = '';
        
        // Custom
        $condition                  = '';
        $incubation_list            = '';
        if(!empty($uniquecode)){
            $incubation_list        = $this->Model_Incubation->get_all_incubation('', '', ' WHERE A.uniquecode = "'.$uniquecode.'"', '');
            $incubation_list        = $incubation_list[0];
            $user_id                = $incubation_list->user_id;
            $incubation_files       = $this->Model_Incubation->get_all_incubation_files('', '', ' WHERE user_id = '.$user_id.'', '');    
        }
        
        $data['title']          = TITLE . 'Detail Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['incubation']     = $incubation_list;
        $data['incubation_files']    = $incubation_files;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation/listdetail';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Files Download File function.
	 */
    function downloadfile($uniquecode){
        if ( !$uniquecode ){
            redirect( current_url() );
        }
        
        // Check Guide File Data
        $incubation_files       = $this->Model_Incubation->get_all_incubation_files('', '', ' WHERE uniquecode = "'.$uniquecode.'"', '');
        $incubation_files       = $incubation_files[0];
        if( !$incubation_files || empty($incubation_files) ){
            redirect( current_url() );
        }

        $file_name      = $incubation_files->filename . '.' . $incubation_files->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationselection/' . $incubation_files->uploader . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
    /**
	 * Incubation Confirm function.
	 */
    function incubationconfirm($uniquecode=''){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $curdate            = date('Y-m-d H:i:s');
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Inkubasi hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };
        
        // Check Data Incubation Selection
        $condition  = ' WHERE %status% = 0 AND %step% = 1';
        $condition .= !empty($uniquecode) ? ' AND %uniquecode% LIKE "'.$uniquecode.'"' : '';
        $order_by   = ' %id% ASC';
        $incseldata = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);
        
        if( !$incseldata || empty($incseldata) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Tidak ada data seleksi yang belum dikonfirmasi');
            // JSON encode data
            die(json_encode($data));
        }
        
        // Check Incubation Setting
        /*
        $incset     = smit_latest_incubation_setting();
        if( !$incset || empty($incset) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Tidak ada data pengaturan seleksi');
            // JSON encode data
            die(json_encode($data));
        }
        
        if( $incset->status == 0 ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Pengaturan seleksi sudah ditutup');
            // JSON encode data
            die(json_encode($data));
        }
        */

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();
        
        foreach($incseldata as $row){
            $incselupdatedata    = array(
                'status'        => 1,
                'datemodified'  => $curdate,
            );
            if( !$this->Model_Incubation->update_data_incubation($row->id, $incselupdatedata) ){
                continue;
            }
            $this->smit_email->send_email_selection_confirmation_step1($row);
        }
        
        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();
        // Set JSON data
        $data = array('msg' => 'success','message' => 'Semua data Seleksi Inkubasi sudah dikonfirmasi.');
        // JSON encode data
        die(json_encode($data));
    }
    
    // ---------------------------------------------------------------------------------------------
    // PENILAIAN JURI
    /**
	 * Jury Score list data function.
	 */
    function juryscorelistdata( $step='' ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = '';
        
        if( !empty($jury_id) && $step == 1 ){
            $condition          = ' WHERE step = '.$step.' AND A.status <> 0';    
        }elseif( !empty($jury_id) && $step == 2 ){
            $condition          = ' WHERE steptwo = '.$step.' AND A.status <> 0';
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
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
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        
        $incubation_list = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by); 
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                if( $row->step == 1 && $row->steptwo == 0){
                    $btn_score          = '';
                    if( $row->status == 1 ){
                        $btn_score      = '<a href="'.base_url('prainkubasi/nilai/'.$row->step.'/'.$row->uniquecode).'" 
                        class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Details"><i class="material-icons">zoom_in</i></a>';
                    }
                    
                    $btn_details    = '<a href="'.base_url('prainkubasi/nilai/'.$row->step.'/'.$row->uniquecode).'" 
                    class="scoresetdet btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Details"><i class="material-icons">zoom_in</i></a>';
                    
                    if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == REJECTED)    { $status = '<span class="label bg-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    
                    $score          = $row->score;
                }else{
                    $btn_score      = '<a href="'.base_url('prainkubasi/nilai2/'.$row->user_id.'/'.$row->uniquecode).'" 
                    class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                    $btn_details    = '<a href="'.base_url('prainkubasi/nilai2/'.$row->user_id.'/'.$row->uniquecode).'" 
                    class="scoresetdet btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                    
                    if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    
                    $score          = $row->scoretwo;
                }
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                        smit_center($i),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper( $workunit_type->workunit_name ),
                        strtoupper( $row->event_title ),
                        smit_center( $score ),
                        smit_center( date('d F Y', strtotime($row->datecreated)) ),
                        smit_center( $status ),
                        smit_center( $btn_score ),
                    );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    
    
    /**
	 * Incubation list data function.
	 */
    function incubationlistdata(){
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        $s_step             = $this->input->post('search_step');
        $s_step             = smit_isset($s_step, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_step) )           { $condition .= str_replace('%s%', $s_step, ' AND %step% = "%s%"'); }}
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%username% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%step% ' . $sort; }
        elseif( $column == 7 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('inact/details/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Details"><i class="material-icons">zoom_in</i></a> ';
                
                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == EXAMINED)    { $status = '<span class="label bg-brown">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CALLED)      { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                /*
                if($row->extension == 'pdf')        { $extension = '<span class="label label-danger">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'doc')    { $extension = '<span class="label label-primary">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'docx')   { $extension = '<span class="label label-primary">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'xls')    { $extension = '<span class="label label-success">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'xlsx')   { $extension = '<span class="label label-success">'.strtoupper($row->extension).'</span>'; }
                */

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('users/profile/'.$row->id).'">' . $row->username . '</a>',
                    strtoupper($row->name),
                    strtoupper($workunit_type->workunit_name),
                    '<a href="'.base_url('upload/incubationselection/'.$row->uniquecode).'">' . $row->event_title . '</a>',
                    smit_center( $status ),
                    smit_center( $row->step ),
                    smit_center( date('Y-m-d', strtotime($row->datecreated)) ),
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
	 * Incubation Report Confirm function.
	 */
    function incubationreportconfirm($uniquecode=''){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Laporan Inkubasi hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };
        
        // Check Data Incubation Selection
        $condition  = ' WHERE %status% = 1 AND %confirmed% = 0';
        $condition .= !empty($uniquecode) ? ' AND %uniquecode% LIKE "'.$uniquecode.'"' : '';
        $order_by   = ' %id% ASC';
        $incseldata = $this->Model_Incubation->get_all_incubation_report(0,0,$condition,$order_by);
        
        if( !$incseldata || empty($incseldata) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Tidak ada data laporan seleksi inkubasi yang belum dikonfirmasi');
            // JSON encode data
            die(json_encode($data));
        }
        
        // Check Incubation Setting
        $incset     = smit_latest_incubation_setting();
        if( !$incset || empty($incset) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Tidak ada data pengaturan seleksi');
            // JSON encode data
            die(json_encode($data));
        }
        
        if( $incset->status == 0 ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Pengaturan seleksi sudah ditutup');
            // JSON encode data
            die(json_encode($data));
        }
        
        $juriphase2data = $incset->selection_juri_phase2;
        if( empty($juriphase2data) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data juri tahap 2 tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }

        $curdate        = date('Y-m-d H:i:s');
        
        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();
        
        foreach($incseldata as $row){
            $incselrepupdatedata = array(
                'confirmed'     => 1,
                'datemodified'  => $curdate,
            );
            $this->Model_Incubation->update_data_incubation_report($row->id, $incselrepupdatedata);
        
            $incselupdatedata = array(
                'jury_id'       => $juriphase2data,
                'status'        => 1,
                'step'          => 2,
                'datemodified'  => $curdate,
            );
            $this->Model_Incubation->update_data_incubation($row->selection_id, $incselupdatedata);
        }
        
        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();
        // Set JSON data
        $data = array('msg' => 'success','message' => base_url('incubation/list'));
        // JSON encode data
        die(json_encode($data));
    }
    
    /**
	 * Incubation Action function.
	 */
    function incubationaction($action, $uniquecode){
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
            $data = array('msg' => 'error','message' => 'Parameter data Inkubasi harus dicantumkan');
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
    }
    
    /**
	 * Setting Incubation function.
	 */
	public function incubationsetting()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        if( !$is_admin ) redirect( base_url('dashboard') );
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Date Time Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Jquery Validate Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            // Jquery Step Plugin
            BE_PLUGIN_PATH . 'jquery-steps/jquery.steps.js',
            // Date Time Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/forms/form-wizard.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'Wizard.init();',
            'SelectGuide.init();',
            'IncubationSetting.init();',
        ));
        
        // Get All Guides Filed
        $guide_files            = $this->Model_Guide->get_all_guides();
        $juri_list              = $this->Model_User->get_all_user(0,0,' WHERE %type% = 4');
        
        $data['title']          = TITLE . 'Pengaturan Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['guide_files']    = $guide_files;
        $data['juri_list']      = $juri_list;
        $data['main_content']   = 'incubation/setting';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Score Incubation function.
	 */
	public function incubationscore()
	{
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);
        $is_pengusul            = as_pengusul($current_user);
        $is_pelaksana           = as_pelaksana($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Range Slider Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/css/ion.rangeSlider.css',
            BE_PLUGIN_PATH . 'ion-rangeslider/css/ion.rangeSlider.skinFlat.css',
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
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/js/ion.rangeSlider.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));
        
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'ScoreSetting.init();',
            'SliderIndikator.init()'
        ));
        $scripts_add            = '';
        
        $active                 = '';
        $lss                    = smit_latest_incubation_setting();
        if( !empty($lss) ){
            $jury_step1             = $lss->selection_juri_phase1;
            $jury_step1             = explode(",", $jury_step1);
            foreach($jury_step1 as $id){
                if($id == $current_user->id){
                    $active = 1;
                    break;
                }else{
                    $active = 0;
                }
            }
        }
        
        $data['title']          = TITLE . 'Penilaian Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['is_pengusul']    = $is_pengusul;
        $data['is_pelaksana']   = $is_pelaksana;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_init']   = $scripts_init;
        $data['scripts_add']    = $scripts_add;
        $data['lss']            = $lss;
        $data['active']         = $active;
        $data['main_content']   = 'incubation/score';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Score Jury Incubation function.
	 */
	public function adminscoreuser($step, $unique)
	{
        auth_redirect();
        
        if( !$step || !$unique ) redirect( base_url('inkubasi/nilai') );
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);
        $is_pengusul            = as_pengusul($current_user);
        $is_pelaksana           = as_pelaksana($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Range Slider Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/css/ion.rangeSlider.css',
            BE_PLUGIN_PATH . 'ion-rangeslider/css/ion.rangeSlider.skinFlat.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/js/ion.rangeSlider.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));
        
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'ScoreSetting.init();'
        ));
        $scripts_add            = '';

        // Get Pra-Incubation Selection Data
        if( $step == 1 ){
            $condition          = ' WHERE %uniquecode% = "'.$unique.'" AND %step% = '.$step.' AND %status% <> 0 ';    
        }else{
            $condition          = ' WHERE %uniquecode% = "'.$unique.'" AND %steptwo% = '.$step.' AND %statustwo% <> 0 ';    
        }
        
        $data_selection         = $this->Model_Incubation->get_all_incubation(0, 0, $condition, '');
        
        if( !$data_selection || empty($data_selection) ){
            redirect( base_url('inkubasi/nilai') );
        }
        $data_selection         = $data_selection[0];
            
        $condition              = ' WHERE %selection_id% = "'.$data_selection->id.'"'; 
        $data_selection_files   = $this->Model_Incubation->get_all_incubation_files(0, 0, $condition, '');
        if( !$data_selection_files || empty($data_selection_files) ){
            redirect( base_url('inkubasi/nilai') );
        }

        $data['title']                  = TITLE . 'Penilaian Seleksi Inkubasi';
        $data['user']                   = $current_user;
        $data['is_admin']               = $is_admin;
        $data['is_jury']                = $is_jury;
        $data['is_pengusul']            = $is_pengusul;
        $data['is_pelaksana']           = $is_pelaksana;
        $data['data_selection']         = $data_selection;
        $data['data_selection_files']   = $data_selection_files;
        $data['headstyles']             = $headstyles;
        $data['scripts']                = $loadscripts;
        $data['scripts_init']           = $scripts_init;
        $data['scripts_add']            = $scripts_add;
        
        if( $step == 1 ){
            $data['main_content']           = 'incubation/scoredetailstep1';    
        }else{
            $data['main_content']           = 'incubation/scoredetailstep2';    
        }
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Admin Score list data function.
	 */
    function adminscorelistdata( $step='' ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = '';
        
        if( !empty($is_admin) && $step == 1 ){
            $condition          = ' WHERE step = '.$step.' AND A.status <> 0';    
        }elseif( !empty($is_admin) && $step == 2 ){
            $condition          = ' WHERE steptwo = '.$step.' AND A.status <> 0';
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
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
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%username% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                if( $row->step == 1 && $row->steptwo == 2){
                    $btn_score      = '<a href="'.base_url('inkubasi/nilai2/'.$row->user_id.'/'.$row->uniquecode).'" 
                    class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai2/'.$row->user_id.'/'.$row->uniquecode).'" 
                    class="scoresetdet btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                    
                    if($row->statustwo == CONFIRMED)       { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                    elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                    elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                }elseif( $row->step == 1 ){
                    $btn_score          = '';
                    if( $row->status == 1 ){
                        $btn_score      = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'" 
                        class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Details"><i class="material-icons">zoom_in</i></a>';
                    }
                    
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'" 
                    class="scoresetdet btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Details"><i class="material-icons">zoom_in</i></a>';
                    
                    if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                    elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                }
                
                $sum_score      = $this->Model_Praincubation->sum_all_score($row->id);
                if(empty($sum_score)){
                    $sum_score  = 0;
                }
                
                $count_all_jury = $this->Model_Praincubation->count_all_score($row->id);
                if(empty($count_all_jury)){
                    $count_all_jury = 0;
                }
                
                if(!empty($sum_score) && !empty($count_all_jury)){
                    $avarage_score  = $sum_score / $count_all_jury;
                }else{
                    $avarage_score  = 0;
                }
                
                $records["aaData"][] = array(
                        smit_center($i),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        $row->event_title,
                        smit_center( floor($sum_score) ),
                        smit_center( floor($avarage_score) ),
                        smit_center( date('d F Y', strtotime($row->datecreated)) ),
                        smit_center( $status ),
                        smit_center($btn_score),
                    );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Admin Score list data function.
	 */
    function adminscorelistdatastep1( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE step = 1 AND A.status <> 0';
        
        $curdate            = date('Y-m-d H:i:s');
        $curdate            = strtotime($curdate);
        
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';
                $btn_details        = '';
                if( $row->status == RATED ){
                    $lss                    = smit_latest_praincubation_setting();
                    $selection_date_invitation_send   = strtotime($lss->selection_date_invitation_send);
                    $selection_date_interview_start   = strtotime($lss->selection_date_interview_start);
                    if( $curdate >= $selection_date_invitation_send && $curdate <= $selection_date_interview_start ){
                        $btn_score  = '<a href="'.base_url('inkubasi/konfirmasistep1/'.$row->uniquecode).'" 
                        class="btn_scorestep1 btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }else{
                        $btn_score  = '<a class="btn btn-xs btn-grey waves-effect tooltips" disabled="disabled" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'" 
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }elseif( $row->status == CONFIRMED || $row->status == REJECTED || $row->status == ACCEPTED ){
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'" 
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }
                
                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
               
                $sum_score      = $row->score;
                $avarage_score  = $row->avarage_score;
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                        smit_center($i),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper($workunit_type->workunit_name),
                        $row->event_title,
                        smit_center( floor($sum_score) ),
                        smit_center( floor($avarage_score) ),
                        smit_center( date('d F Y', strtotime($row->datecreated)) ),
                        smit_center( $status ),
                        smit_center( $btn_score. ' ' .$btn_details),
                    );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Admin Score list data function.
	 */
    function adminscorelistdatastep2( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE steptwo = 2 AND A.status <> 0';
        
        $curdate            = date('Y-m-d H:i:s');
        $curdate            = strtotime($curdate);
        
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';
                $btn_details        = '';
                if( $row->statustwo == RATED ){
                    $lss                                = smit_latest_praincubation_setting();
                    $selection_date_result              = strtotime($lss->selection_date_result);
                    $selection_date_proposal_start     =     strtotime($lss->selection_date_proposal_start);
                    if( $curdate >= $selection_date_result && $curdate <= $selection_date_proposal_start ){
                        $btn_score  = '<a href="'.base_url('inkubasi/konfirmasistep2/'.$row->uniquecode).'" 
                        class="btn_scorestep2 btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }else{
                        $btn_score  = '<a class="btn btn-xs btn-grey waves-effect tooltips" disabled="disabled" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->steptwo.'/'.$row->uniquecode).'" 
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }elseif( $row->statustwo == CONFIRMED || $row->statustwo == REJECTED || $row->statustwo == ACCEPTED ){
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->steptwo.'/'.$row->uniquecode).'" 
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }
                
                if($row->statustwo == CONFIRMED)       { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                
                $sum_score          = $row->scoretwo;
                $avarage_score      = $row->avarage_scoretwo;
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                        smit_center($i),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper($workunit_type->workunit_name),
                        $row->event_title,
                        smit_center( floor($sum_score) ),
                        smit_center( floor($avarage_score) ),
                        smit_center( date('d F Y', strtotime($row->datecreated)) ),
                        smit_center( $status ),
                        smit_center( $btn_score .' '. $btn_details),
                    );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Setting Incubation Save function.
	 */
	public function incubationsettingsave()
	{
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Check Auth Redirect
        $auth = auth_redirect( $this->input->is_ajax_request() );
        if( !$auth ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
          
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        if( !$is_admin ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        /*
        $post_selection_year_publication        = $this->input->post('selection_year_publication');
        $post_selection_date_publication        = $this->input->post('selection_date_publication');
        $post_selection_date_reg_start          = $this->input->post('selection_date_reg_start');
        $post_selection_date_reg_end            = $this->input->post('selection_date_reg_end');
        $post_selection_date_adm_start          = $this->input->post('selection_date_adm_start');
        $post_selection_date_adm_end            = $this->input->post('selection_date_adm_end');
        $post_selection_date_invitation_send    = $this->input->post('selection_date_invitation_send');
        $post_selection_date_interview_start    = $this->input->post('selection_date_interview_start');
        $post_selection_date_interview_end      = $this->input->post('selection_date_interview_end');
        $post_selection_date_result             = $this->input->post('selection_date_result');
        $post_selection_date_proposal_start     = $this->input->post('selection_date_proposal_start');
        $post_selection_date_proposal_end       = $this->input->post('selection_date_proposal_end');
        $post_selection_date_agreement          = $this->input->post('selection_date_agreement');
        $post_selection_imp_date_start          = $this->input->post('selection_imp_date_start');
        $post_selection_imp_date_end            = $this->input->post('selection_imp_date_end');
        $post_selection_desc                    = $this->input->post('selection_desc');
        */
        $post_selection_files                   = $this->input->post('selection_files');
        $post_selection_juri_phase1             = $this->input->post('selection_juri_phase1');
        $post_selection_juri_phase2             = $this->input->post('selection_juri_phase2');
        
        /*
        $this->form_validation->set_rules('selection_year_publication','Tahun Publikasi','required');
        $this->form_validation->set_rules('selection_date_publication','Tanggal Publikasi','required');
        $this->form_validation->set_rules('selection_date_reg_start','Tanggal Mulai Pendaftaran Online','required');
        $this->form_validation->set_rules('selection_date_reg_end','Tanggal Selesai Pendaftaran Online','required');
        $this->form_validation->set_rules('selection_date_adm_start','Tanggal Mulai Seleksi Administrasi &amp; Substansi Awal','required');
        $this->form_validation->set_rules('selection_date_adm_end','Tanggal Selesai Seleksi Administrasi &amp; Substansi Awal','required');
        $this->form_validation->set_rules('selection_date_invitation_send','Tanggal Undangan Presentasi Dikirim','required');
        $this->form_validation->set_rules('selection_date_interview_start','Tanggal Mulai Seleksi Presentasi &amp; Wawancara','required');
        $this->form_validation->set_rules('selection_date_interview_end','Tanggal Selesai Seleksi Presentasi &amp; Wawancara','required');
        $this->form_validation->set_rules('selection_date_result','Tanggal Pengumuman Hasil Seleksi','required');
        $this->form_validation->set_rules('selection_date_proposal_start','Tanggal Mulai Perbaikan Proposal &amp; Penelaahan Anggaran','required');
        $this->form_validation->set_rules('selection_date_proposal_end','Tanggal Selesai Perbaikan Proposal &amp; Penelaahan Anggaran','required');
        $this->form_validation->set_rules('selection_date_agreement','Tanggal Penetapan &amp; Penandatanganan Perjanjian','required');
        $this->form_validation->set_rules('selection_imp_date_start','Tanggal Mulai Pelaksanaan','required');
        $this->form_validation->set_rules('selection_imp_date_end','Tanggal Selesai Pelaksanaan','required');
        */
        $this->form_validation->set_rules('selection_files[]','Berkas Panduan','required');
        $this->form_validation->set_rules('selection_juri_phase1[]','Juri Tahap 1','required');
        $this->form_validation->set_rules('selection_juri_phase2[]','Juri Tahap 2','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir pengaturan!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            $curdate                    = date("Y-m-d H:i:s");
            $random                     = smit_generate_rand_string(10,'low');
            $post_selection_files       = implode(',',$post_selection_files);
            $post_selection_juri_phase1 = implode(',',$post_selection_juri_phase1);
            $post_selection_juri_phase2 = implode(',',$post_selection_juri_phase2);
            
            $settingdata                = array(
                'uniquecode'                        => $random,
                /*
                'selection_year_publication'        => smit_isset($post_selection_year_publication, ''),
                'selection_date_publication'        => smit_isset($post_selection_date_publication, ''),
                'selection_date_reg_start'          => smit_isset($post_selection_date_reg_start, ''),
                'selection_date_reg_end'            => smit_isset($post_selection_date_reg_end, ''),
                'selection_date_adm_start'          => smit_isset($post_selection_date_adm_start, ''),
                'selection_date_adm_end'            => smit_isset($post_selection_date_adm_end, ''),
                'selection_date_invitation_send'    => smit_isset($post_selection_date_invitation_send, ''),
                'selection_date_interview_start'    => smit_isset($post_selection_date_interview_start, ''),
                'selection_date_interview_end'      => smit_isset($post_selection_date_interview_end, ''),
                'selection_date_result'             => smit_isset($post_selection_date_result, ''),
                'selection_date_proposal_start'     => smit_isset($post_selection_date_proposal_start, ''),
                'selection_date_proposal_end'       => smit_isset($post_selection_date_proposal_end, ''),
                'selection_date_agreement'          => smit_isset($post_selection_date_agreement, ''),
                'selection_imp_date_start'          => smit_isset($post_selection_imp_date_start, ''),
                'selection_imp_date_end'            => smit_isset($post_selection_imp_date_end, ''),
                'selection_desc'                    => $post_selection_desc,
                */
                'selection_files'                   => $post_selection_files,
                'selection_juri_phase1'             => $post_selection_juri_phase1,
                'selection_juri_phase2'             => $post_selection_juri_phase2,
                'status'                            => 1,
                'datecreated'                       => $curdate,
                'datemodified'                      => $curdate,
            );
            
            if( $save_setting   = $this->Model_Incubation->save_data_incubation_selection_setting($settingdata) ){
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => smit_alert('Pengaturan Seleksi Inkubasi berhasil di simpan'),
                );
            }else{
                $data = array(
                    'message'   => 'error',
                    'data'      => smit_alert('Pengaturan Seleksi Inkubasi tidak berhasil di simpan'),
                ); 
            }
            
            // JSON encode data
            die(json_encode($data));
        }
	}
    
    /**
	 * Incubation setting list data function.
	 */
    function incubationsettinglistdata(){
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
        
        $s_date_pub_min         = $this->input->post('selection_date_publication_min');
        $s_date_pub_min         = smit_isset($s_date_pub_min, '');
        $s_date_pub_max         = $this->input->post('selection_date_publication_max');
        $s_date_pub_max         = smit_isset($s_date_pub_max, '');
        
        $s_date_reg_min         = $this->input->post('search_date_reg_min');
        $s_date_reg_min         = smit_isset($s_date_reg_min, '');
        $s_date_reg_max         = $this->input->post('search_date_reg_max');
        $s_date_reg_max         = smit_isset($s_date_reg_max, '');
        
        $s_desc                 = $this->input->post('search_desc');
        $s_desc                 = smit_isset($s_desc, '');
        $s_status               = $this->input->post('search_status');
        $s_status               = smit_isset($s_status, '');
        
        if ( !empty($s_date_pub_min) )  { $condition .= ' AND %date_publication% >= '.strtotime($s_date_pub_min).''; }
        if ( !empty($s_date_pub_max) )  { $condition .= ' AND %date_publication% <= '.strtotime($s_date_pub_max).''; }
        if ( !empty($s_date_reg_min) )  { $condition .= ' AND %date_reg_start% >= '.strtotime($s_date_reg_min).''; }
        if ( !empty($s_date_reg_max) )  { $condition .= ' AND %date_reg_start% <= '.strtotime($s_date_reg_max).''; }
        if ( !empty($s_desc) )          { $condition .= ' AND %desc% LIKE "%'.$s_desc.'%"'; }
        if ( !empty($s_status) )        { $condition .= ' AND %status% = '.$s_status.''; }
        
        if( $column == 1 )      { $order_by .= '%date_publication% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%date_reg_start% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%desc% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        
        $incubationset_list = $this->Model_Incubation->get_all_incubation_setting($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubationset_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            
            $i = $offset + 1;
            foreach($incubationset_list as $row){
                $btn_details    = '<a href="'.base_url('detilinkubasi/'.$row->uniquecode).'" 
                    class="praincubsetdet btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Details"><i class="material-icons">zoom_in</i></a> ';
                $btn_close      = ( $row->status == 1 ? 
                '<a href="'.base_url('tutupinkubasi/'.$row->uniquecode).'" class="praincubsetclose btn btn-xs btn-warning waves-effect tooltips" data-placement="top" title="Close"><i class="material-icons">clear</i></a>' : 
                '<a class="btn btn-xs btn-default waves-effect disabled"><i class="material-icons">clear</i></a>'  );
                
                if($row->status == 1)       { $status = '<span class="label label-success">OPEN</span>'; }
                elseif($row->status == 0)   { $status = '<span class="label label-danger">CLOSED</span>'; }
                
                $records["aaData"][] = array(
                    smit_center($i),
                    smit_center( date('d F Y', strtotime($row->selection_date_publication)) ),
                    smit_center( date('d F Y', strtotime($row->selection_date_reg_start)) . ' - ' . date('d F Y', strtotime($row->selection_date_reg_end)) ),
                    $row->selection_desc,
                    smit_center($status),
                    smit_center($btn_details . ' ' . $btn_close),
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
	 * Incubation setting details data function.
	 */
    function incubationsettingdetails($uniquecode){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Check Auth Redirect
        $auth = auth_redirect( $this->input->is_ajax_request() );
        if( !$auth ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
          
        $current_user   = smit_get_current_user();
        $is_admin       = as_administrator($current_user);
        $content        = '';
        
        if( !$is_admin ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }
        
        $incubationsetdata      = $this->Model_Incubation->get_incubation_setting_by('uniquecode',$uniquecode);
        if( !$incubationsetdata ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Data pengaturan seleksi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        unset($incubationsetdata->id);
        unset($incubationsetdata->uniquecode);
        unset($incubationsetdata->status);
        unset($incubationsetdata->datecreated);
        unset($incubationsetdata->datemodified);

        $incubationsetdata->selection_files  = explode(',', $incubationsetdata->selection_files);
        $incubationsetdata->selection_juri_phase1  = explode(',', $incubationsetdata->selection_juri_phase1);
        $incubationsetdata->selection_juri_phase2  = explode(',', $incubationsetdata->selection_juri_phase2);
        
        // Set JSON data
        $data = array('message' => 'success','data' => 'Data pengaturan seleksi ditemukan','details' => $incubationsetdata);
        // JSON encode data
        die(json_encode($data));
    }
    
    /**
	 * Incubation setting close data function.
	 */
    function incubationsettingclose($uniquecode){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Check Auth Redirect
        $auth = auth_redirect( $this->input->is_ajax_request() );
        if( !$auth ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
          
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        if( !$is_admin ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }
        
        $incubationsetdata      = $this->Model_Incubation->get_incubation_setting_by('uniquecode',$uniquecode);
        if( !$incubationsetdata ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Data pengaturan seleksi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        $incubationsetupdate    = array('status' => 0, 'datemodified' => date('Y-m-d H:i:s'));
        if( $this->Model_Incubation->update_data_incubation_setting($incubationsetdata->id, $incubationsetupdate) ){
            // Set JSON data
            $data = array('message' => 'success','data' => 'Data pengaturan seleksi berhasi di close');
        }else{
            // Set JSON data
            $data = array('message' => 'error','data' => 'Terjadi kesalahan data, pengaturan seleksi tidak berhasi di close');
        }
        // JSON encode data
        die(json_encode($data));
    }
    
    // ---------------------------------------------------------------------------------------------
    // PENGUSUL
    /**
	 * Pengusul Score Step 1 list data function.
	 */
    function pengusulscorelistdatastep1( $user_id=''){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        
        if( !empty($user_id)){
            $condition          = ' WHERE A.user_id ='.$user_id.' ';    
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
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/1/'.$row->uniquecode).'" 
                class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                
                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                
                $score          = $row->score;
                $avarage_score  = $row->avarage_score;
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                    smit_center($i),
                    strtoupper( $row->event_title ),
                    smit_center( floor($score) ),
                    smit_center( floor($avarage_score) ),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
                    smit_center( $status ),
                    smit_center( $btn_details ),
                );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Pengusul Score Step 2 list data function.
	 */
    function pengusulscorelistdatastep2( $user_id=''){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        
        if( !empty($user_id)){
            $condition          = ' WHERE A.user_id ='.$user_id.' ';    
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
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/2/'.$row->uniquecode).'" 
                class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                
                if($row->statustwo == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                
                $score          = $row->scoretwo;
                $avarage_score  = $row->avarage_scoretwo;
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                    smit_center($i),
                    strtoupper( $row->event_title ),
                    smit_center( floor($score) ),
                    smit_center( floor($avarage_score) ),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
                    smit_center( $status ),
                    smit_center( $btn_details ),
                );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Jury Score list data function.
	 */
    function juryscorelistdatastep1( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE step = 1 AND A.status <> 0';
        
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
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
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by); 
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';
                
                // Check Jury Rated Selection
                $rated = smit_check_juri_rated($current_user->id, $row->id, ONE);
                
                if( $row->status == 1 ){
                    if( empty($rated) ){
                        $btn_score      = '<a href="'.base_url('inkubasi/nilai/'.$row->step.'/'.$row->uniquecode).'" 
                        class="btn_score btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Nilai"><i class="material-icons">done</i></a>';
                    }
                }
                
                $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'" 
                class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Details"><i class="material-icons">zoom_in</i></a>';
                
                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                
                $score          = $row->score;
                $avarage_score  = $row->avarage_score;

                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                        smit_center($i),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper( $workunit_type->workunit_name ),
                        strtoupper( $row->event_title ),
                        smit_center( floor($score) ),
                        smit_center( floor($avarage_score) ),
                        smit_center( date('d F Y', strtotime($row->datecreated)) ),
                        smit_center( $status ),
                        smit_center( $btn_score .' '.$btn_details ),
                    );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Jury Score list data function.
	 */
    function juryscorelistdatastep2( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE steptwo = 2 AND A.status <> 0';
        
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
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
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); } 
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
        
        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by); 
        
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');
            
            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';
                $btn_details        = '';
                
                // Check Jury Rated Selection
                $rated = smit_check_juri_rated($current_user->id, $row->selection_id, TWO);

                if( $row->statustwo == CONFIRMED ){
                    if( empty($rated) ){
                        $btn_score      = '<a href="'.base_url('inkubasi/nilai/'.$row->user_id.'/'.$row->uniquecode).'" 
                        class="btn_score btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="2" title="Nilai"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/2/'.$row->uniquecode).'" 
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                }elseif( $row->statustwo == RATED || $row->statustwo == ACCEPTED || $row->statustwo == REJECTED ){
                    $btn_details    = '<a href="'.base_url('inkubasi/nilai/detail/2/'.$row->uniquecode).'" 
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                }
                
                if($row->statustwo == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                
                $score          = $row->scoretwo;
                $avarage_score  = $row->avarage_scoretwo;
                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);
                
                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                    strtoupper( $workunit_type->workunit_name ),
                    strtoupper( $row->event_title ),
                    smit_center( floor($score) ),
                    smit_center( floor($avarage_score) ),
                    smit_center( date('d F Y', strtotime($row->datecreated)) ),
                    smit_center( $status ),
                    smit_center( $btn_score .' '. $btn_details ),
                );  
                $i++;
            }   
        }
        
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }
    
    /**
	 * Score Jury Incubation function.
	 */
	public function juryscoreuser($step, $unique)
	{
        auth_redirect();
        
        if( !$step || !$unique ) redirect( base_url('inkubasi/nilai') );
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_jury                = as_juri($current_user);
        $is_pengusul            = as_pengusul($current_user);
        $is_pelaksana           = as_pelaksana($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Range Slider Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/css/ion.rangeSlider.css',
            BE_PLUGIN_PATH . 'ion-rangeslider/css/ion.rangeSlider.skinFlat.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // CKEditor Plugin
            BE_PLUGIN_PATH . 'ckeditor/ckeditor.js',
            
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/js/ion.rangeSlider.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
        ));
        
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'ScoreSetting.init();',
            'SliderIndikator.init()'
        ));
        $scripts_add            = '';

        // Get Pra-Incubation Selection Data
        $condition              = ' WHERE %uniquecode% = "'.$unique.'" AND %step% = 1 AND %status% <> 0';
        $data_selection         = $this->Model_Incubation->get_all_incubation(0, 0, $condition, '');
        if( !$data_selection || empty($data_selection) ){
            redirect( base_url('prainkubasi/nilai') );
        }
        $data_selection         = $data_selection[0];
        
        // Check Jury Rated Selection
        $rated = smit_check_juri_rated($current_user->id, $data_selection->id, $step);
        if( !empty($rated) ){
            redirect( base_url('inkubasi/nilai') );
        }
            
        $condition              = ' WHERE %selection_id% = "'.$data_selection->id.'"'; 
        $data_selection_files   = $this->Model_Incubation->get_all_incubation_files(0, 0, $condition, '');
        if( !$data_selection_files || empty($data_selection_files) ){
            redirect( base_url('inkubasi/nilai') );
        }

        $data['title']                  = TITLE . 'Penilaian Seleksi Inkubasi';
        $data['user']                   = $current_user;
        $data['is_admin']               = $is_admin;
        $data['is_jury']                = $is_jury;
        $data['is_pengusul']            = $is_pengusul;
        $data['is_pelaksana']           = $is_pelaksana;
        $data['data_selection']         = $data_selection;
        $data['data_selection_files']   = $data_selection_files;
        $data['headstyles']             = $headstyles;
        $data['scripts']                = $loadscripts;
        $data['scripts_init']           = $scripts_init;
        $data['scripts_add']            = $scripts_add;
        
        if( $step == 1){
            $data['main_content']           = 'incubation/scoreuser';    
        }else{
            $data['main_content']           = 'incubation/scoreuser2';
        }

        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Score Jury Incubation function.
	 */
	public function juryscoreuserprocess($step)
	{
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        // Check Auth Redirect
        $auth = auth_redirect( $this->input->is_ajax_request() );
        if( !$auth ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        if( !$step ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter tahap data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }
        
        $current_user   = smit_get_current_user();
        $is_jury        = as_juri($current_user);
        if( !$is_jury ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Proses penilaian hanya bisa dilakukan oleh Juri');
            // JSON encode data
            die(json_encode($data));
        }
        
        if( $step == 1 ){
            $selection_id   = $this->input->post('nilai_selection_id');
            $selection_id   = smit_isset($selection_id, '');
            $rate1          = $this->input->post('nilai_dokumen');
            $rate1          = smit_isset($rate1, '');
            $rate2          = $this->input->post('nilai_target');
            $rate2          = smit_isset($rate2, '');
            $rate3          = $this->input->post('nilai_perlingungan');
            $rate3          = smit_isset($rate3, '');
            $rate4          = $this->input->post('nilai_penelitian');
            $rate4          = smit_isset($rate4, '');
            $rate5          = $this->input->post('nilai_market');
            $rate5          = smit_isset($rate5, '');
            $rate_total     = $this->input->post('nilai_total_tahap1');
            $rate_total     = smit_isset($rate_total, '');
            $rate_comment   = $this->input->post('nilai_juri_comment');
            $rate_comment   = smit_isset($rate_comment, '');
            
            // Check Pra-Incubation Selection Data
            $data_selection     = $this->Model_Praincubation->get_praincubation($selection_id);
            if( !$data_selection || empty($data_selection) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            } 
            
            // Check Pra-Incubation Selection User Data
            $data_selection_user = smit_get_userdata_by_id($data_selection->user_id);
            if( !$data_selection_user || empty($data_selection_user) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data user seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            } 
            
            // Check this Pra-Incubation Selection Rate Process
            if( !empty($is_jury) ){
                $rate_process       = $this->Model_Praincubation->get_praincubation_rate_step1_files($current_user->id, $data_selection->id);
                
                if( $rate_process || !empty($rate_process) ){
                    // Set JSON data
                    $data = array('message' => 'error','data' => 'Penilaian data seleksi inkubasi ini sudah anda diproses');
                    // JSON encode data
                    die(json_encode($data));    
                } 
            }
            
            $curdate            = date("Y-m-d H:i:s");
            $random             = smit_generate_rand_string(10,'low');
            
            // Set Data Rate Step 1
            $rate_data_step1    = array(
                'uniquecode'    => $random,
                'selection_id'  => $selection_id,
                'jury_id'       => $current_user->id,
                'nilai_dokumen' => $rate1,
                'nilai_target'  => $rate2,
                'nilai_perlindungan'    => $rate3,
                'nilai_penelitian'      => $rate4,
                'nilai_market'          => $rate5,
                'rate_total'    => $rate_total,
                'comment'       => $rate_comment,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate
            ); 
            
            if( $this->Model_Incubation->save_data_incubation_selection_rate_step1($rate_data_step1) ){
                // History Step1
                $random_history     = smit_generate_rand_string(10,'low');
                $rate_history_step1 = array(
                    'uniquecode'    => $random_history,
                    'selection_id'  => $selection_id,
                    'jury_id'       => $current_user->id,
                    'name_jury'     => $current_user->name,
                    'user_id'       => $data_selection->user_id,
                    'username'      => $data_selection->username,
                    'name'          => $data_selection->name,
                    'event_title'   => $data_selection->event_title,
                    'step'          => 1,
                    'rate_total'    => $rate_total,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate
                );
                
                $history            = $this->Model_Incubation->save_data_incubation_history($rate_history_step1);
                
                // Set Data Rate Step 1
                $lss                    = smit_latest_praincubation_setting();
                $jury_step1             = $lss->selection_juri_phase1;
                $jury_step1             = explode(",", $jury_step1);
                
                $count              = 0;   
                foreach( $jury_step1 as $id){
                    $count++;
                }
                
                $i                  = 0;
                foreach( $jury_step1 as $id){
                    $check_all_score_member     = $this->Model_Incubation->get_incubation_rate_step1_files($id, $data_selection->id);
                    if( !empty($check_all_score_member) ){
                        $i++;
                        continue;
                    }
                }
                
                if( $i == $count ){
                    $status_step1   = array(
                        'status'    => RATED,
                    );
                    
                    if( $update_selection   = $this->Model_Incubation->update_data_incubation($data_selection->id, $status_step1) ){
                        $this->smit_email->send_email_rated_confirmation($data_selection_user->email);
                    }
                }

                // Set JSON data
                $data = array('message' => 'success','data' => 'Proses penilaian seleksi inkubasi ini berhasil');
            }else{
                // Set JSON data
                $data = array('message' => 'error','data' => 'Proses penilaian seleksi inkubasi ini tidak berhasil');
            }
            // JSON encode data
            die(json_encode($data));
        }else{
            $selection_id           = $this->input->post('nilai_selection_id');
            $selection_id           = smit_isset($selection_id, '');
            // Kriteria Pasar
            $klaster1_a_indikator   = $this->input->post('klaster1_a_indikator');
            $klaster1_a_indikator   = smit_isset($klaster1_a_indikator, '');
            $klaster1_b_indikator   = $this->input->post('klaster1_b_indikator');
            $klaster1_b_indikator   = smit_isset($klaster1_b_indikator, '');
            $klaster1_c_indikator   = $this->input->post('klaster1_c_indikator');
            $klaster1_c_indikator   = smit_isset($klaster1_c_indikator, '');
            $klaster1_d_indikator   = $this->input->post('klaster1_d_indikator');
            $klaster1_d_indikator   = smit_isset($klaster1_d_indikator, '');
            $klaster1_e_indikator   = $this->input->post('klaster1_e_indikator');
            $klaster1_e_indikator   = smit_isset($klaster1_e_indikator, '');
            // Kriteria Produk / Jasa
            $klaster2_a_indikator   = $this->input->post('klaster2_a_indikator');
            $klaster2_a_indikator   = smit_isset($klaster2_a_indikator, '');
            $klaster2_b_indikator   = $this->input->post('klaster2_b_indikator');
            $klaster2_b_indikator   = smit_isset($klaster2_b_indikator, '');
            $klaster2_c_indikator   = $this->input->post('klaster2_c_indikator');
            $klaster2_c_indikator   = smit_isset($klaster2_c_indikator, '');
            $klaster2_d_indikator   = $this->input->post('klaster2_d_indikator');
            $klaster2_d_indikator   = smit_isset($klaster2_d_indikator, '');
            $klaster2_e_indikator   = $this->input->post('klaster2_e_indikator');
            $klaster2_e_indikator   = smit_isset($klaster2_e_indikator, '');
            // Kriteria Financial
            $klaster3_a_indikator   = $this->input->post('klaster3_a_indikator');
            $klaster3_a_indikator   = smit_isset($klaster3_a_indikator, '');
            $klaster3_b_indikator   = $this->input->post('klaster3_b_indikator');
            $klaster3_b_indikator   = smit_isset($klaster3_b_indikator, '');
            $klaster3_c_indikator   = $this->input->post('klaster3_c_indikator');
            $klaster3_c_indikator   = smit_isset($klaster3_c_indikator, '');
            $klaster3_d_indikator   = $this->input->post('klaster3_d_indikator');
            $klaster3_d_indikator   = smit_isset($klaster3_d_indikator, '');
            $klaster3_e_indikator   = $this->input->post('klaster3_e_indikator');
            $klaster3_e_indikator   = smit_isset($klaster3_e_indikator, '');
            // Kriteria SDM dan Alih Teknologi
            $klaster4_a_indikator   = $this->input->post('klaster4_a_indikator');
            $klaster4_a_indikator   = smit_isset($klaster4_a_indikator, '');
            $klaster4_b_indikator   = $this->input->post('klaster4_b_indikator');
            $klaster4_b_indikator   = smit_isset($klaster4_b_indikator, '');
            $klaster4_c_indikator   = $this->input->post('klaster4_c_indikator');
            $klaster4_c_indikator   = smit_isset($klaster4_c_indikator, '');
            $klaster4_d_indikator   = $this->input->post('klaster4_d_indikator');
            $klaster4_d_indikator   = smit_isset($klaster4_d_indikator, '');
            $klaster4_e_indikator   = $this->input->post('klaster4_e_indikator');
            $klaster4_e_indikator   = smit_isset($klaster4_e_indikator, '');
            
            // Innovation Readiness Level
            $irl1           = $this->input->post('irl1');
            $irl1           = smit_isset($irl1, '');
            $irl2           = $this->input->post('irl2');
            $irl2           = smit_isset($irl2, '');
            $irl3           = $this->input->post('irl3');
            $irl3           = smit_isset($irl3, '');
            $irl4           = $this->input->post('irl4');
            $irl4           = smit_isset($irl4, '');
            $irl5           = $this->input->post('irl5');
            $irl5           = smit_isset($irl5, '');
            $irl6           = $this->input->post('irl6');
            $irl6           = smit_isset($irl6, '');
            $irl7           = $this->input->post('irl7');
            $irl7           = smit_isset($irl7, '');
            $irl8           = $this->input->post('irl8');
            $irl8           = smit_isset($irl8, '');
            $irl9           = $this->input->post('irl9');
            $irl9           = smit_isset($irl9, '');
            $irl10          = $this->input->post('irl10');
            $irl10          = smit_isset($irl10, '');
            
            $rate_total2    = $this->input->post('total_rate');
            $rate_total2    = smit_isset($rate_total2, '');
            $rate_comment2  = $this->input->post('nilai_juri_comment');
            $rate_comment2  = smit_isset($rate_comment2, '');
            
            // Check Pra-Incubation Selection Data
            $data_selection     = $this->Model_Incubation->get_incubation($selection_id);
            if( !$data_selection || empty($data_selection) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            } 
            
            // Check this Pra-Incubation Selection Rate Process
            if( !empty($is_jury) ){
                $rate_process       = $this->Model_Incubation->get_incubation_rate_step2_files($current_user->id, $data_selection->id);
                
                if( $rate_process || !empty($rate_process) ){
                    // Set JSON data
                    $data = array('message' => 'error','data' => 'Penilaian data seleksi inkubasi ini sudah anda diproses');
                    // JSON encode data
                    die(json_encode($data));    
                } 
            }
            
            $curdate            = date("Y-m-d H:i:s");
            $random             = smit_generate_rand_string(10,'low');
            
            // Set IRL
            $value_irl1     = 0;
            $value_irl2     = 0;
            $value_irl3     = 0;
            $value_irl4     = 0;
            $value_irl5     = 0;
            $value_irl6     = 0;
            $value_irl7     = 0;
            $value_irl8     = 0;
            $value_irl9     = 0;
            $value_irl10    = 0;
            $total_irl      = 0;
            
            if( $irl1 == 'on'){ $value_irl1 = 1; }
            if( $irl2 == 'on'){ $value_irl2 = 1; }
            if( $irl3 == 'on'){ $value_irl3 = 1; }
            if( $irl4 == 'on'){ $value_irl4 = 1; }
            if( $irl5 == 'on'){ $value_irl5 = 1; }
            if( $irl6 == 'on'){ $value_irl6 = 1; }
            if( $irl7 == 'on'){ $value_irl7 = 1; }
            if( $irl8 == 'on'){ $value_irl8 = 1; }
            if( $irl9 == 'on'){ $value_irl9 = 1; }
            if( $irl10 == 'on'){ $value_irl10 = 1; }
            
            $total_irl  = $value_irl1 + $value_irl2 + $value_irl3 + $value_irl4 + $value_irl5 + $value_irl6 + $value_irl7 + $value_irl8 + $value_irl9 + $value_irl10;

            // Set Data Rate Step 2
            $rate_data_step2    = array(
                'uniquecode'    => $random,
                'selection_id'  => $selection_id,
                'jury_id'       => $current_user->id,
                'klaster1_a'    => $klaster1_a_indikator,
                'klaster1_b'    => $klaster1_b_indikator,
                'klaster1_c'    => $klaster1_c_indikator,
                'klaster1_d'    => $klaster1_d_indikator,
                'klaster1_e'    => $klaster1_e_indikator,
                'klaster2_a'    => $klaster2_a_indikator,
                'klaster2_b'    => $klaster2_b_indikator,
                'klaster2_c'    => $klaster2_c_indikator,
                'klaster2_d'    => $klaster2_d_indikator,
                'klaster2_e'    => $klaster2_e_indikator,
                'klaster3_a'    => $klaster3_a_indikator,
                'klaster3_b'    => $klaster3_b_indikator,
                'klaster3_c'    => $klaster3_c_indikator,
                'klaster3_d'    => $klaster3_d_indikator,
                'klaster3_e'    => $klaster3_e_indikator,
                'klaster4_a'    => $klaster4_a_indikator,
                'klaster4_b'    => $klaster4_b_indikator,
                'klaster4_c'    => $klaster4_c_indikator,
                'klaster4_d'    => $klaster4_d_indikator,
                'klaster4_e'    => $klaster4_e_indikator,
                'rate_total'    => $rate_total2,
                'irl'           => $total_irl,
                'comment'       => $rate_comment2,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate
            );
            
            if( $this->Model_Incubation->save_data_incubation_selection_rate_step2($rate_data_step2) ){
                // History Step1
                $random_history     = smit_generate_rand_string(10,'low');
                $rate_history_step2 = array(
                    'uniquecode'    => $random_history,
                    'selection_id'  => $selection_id,
                    'jury_id'       => $current_user->id,
                    'name_jury'     => $current_user->name,
                    'user_id'       => $data_selection->user_id,
                    'username'      => $data_selection->username,
                    'name'          => $data_selection->name,
                    'event_title'   => $data_selection->event_title,
                    'step'          => 2,
                    'rate_total'    => $rate_total2,
                    'datecreated'   => $curdate,
                    'datemodified'  => $curdate
                );
                
                $history            = $this->Model_Incubation->save_data_praincubation_history($rate_history_step2);
                
                // Set Data Rate Step 1
                $lss                    = smit_latest_praincubation_setting();
                $jury_step2             = $lss->selection_juri_phase2;
                $jury_step2             = explode(",", $jury_step2);
                
                $count              = 0;   
                foreach( $jury_step2 as $id){
                    $count++;
                }
                
                $i                  = 0;
                foreach( $jury_step2 as $id){
                    $check_all_score_member     = $this->Model_Incubation->get_incubation_rate_step2_files($id, $data_selection->id);
                    if( !empty($check_all_score_member) ){
                        $i++;
                        continue;
                    }
                }
                
                if( $i == $count ){
                    $status_step2   = array(
                        'statustwo' => RATED,
                    );
                    
                    $update_selection   = $this->Model_Incubation->update_data_incubation($data_selection->id, $status_step2);
                }
                
                // Set JSON data
                $data = array('message' => 'success','data' => 'Proses penilaian seleksi inkubasi ini berhasil');
            }else{
                // Set JSON data
                $data = array('message' => 'error','data' => 'Proses penilaian seleksi inkubasi ini tidak berhasil');
            }
            // JSON encode data
            die(json_encode($data));
            
        }
    }
    
    /**
	 * Incubation Score Action function.
	 */
    function incubationscoreaction($action, $uniquecode){
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
            $data = array('msg' => 'error','message' => 'Parameter data Inkubasi harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };

        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_jury            = as_juri($current_user);
        $curdate            = date('Y-m-d H:i:s');
        $message            = '';
        
        // Check for Jury Access
        if( !$is_jury ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Hanya juri yang dapat melakukan pemeriksaan data seleksi');
            // JSON encode data
            die(json_encode($data));
        }
        
        // Check Selection Data
        $selectiondata      = $this->Model_Incubation->get_incubation_by_uniquecode($uniquecode);
        if( !$selectiondata || empty($selectiondata) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data seleksi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }

        switch($action){
            // CASE for Examine action
            case 'examine' :
                $selectiondataupdate = array('status' => EXAMINED, 'datemodified' => $curdate);
                if( $this->Model_Incubation->update_data_incubation($selectiondata->id, $selectiondataupdate) ){
                    // Set JSON data
                    $data = array('msg' => 'success','message' => 'Data seleksi sedang dalam proses pemeriksaan');
                }else{
                    // Set JSON data
                    $data = array('msg' => 'error','message' => 'Terjadi kesalahan update data seleksi');
                }
                // JSON encode data
                die(json_encode($data));
                break;
                
            // CASE for Call/Reject action
            case 'call' :
            case 'reject' :
                $selectiondataupdate = array('status' => $action=='call' ? CALLED : REJECTED, 'datemodified' => $curdate);
                if( $this->Model_Incubation->update_data_incubation($selectiondata->id, $selectiondataupdate) ){
                    // Set JSON data
                    $message = $action=='call' ? 'Data seleksi sedang dalam proses pemanggilan' : 'Data seleksi ditolak';
                    $data = array('msg' => 'success','message' => $message);
                    
                    if( !$this->Model_Incubation->get_incubation_report_by('selection_id',$selectiondata->id) ){
                        // Save Data Incubation Report
                        $selectionrptdata = $selectiondata;
                        $selectionrptdata->selection_id = $selectiondata->id;
                        $selectionrptdata->uniquecode   = smit_generate_rand_string(10,'low');
                        $selectionrptdata->status       = $action=='call' ? REPORT_CALLED : REPORT_REJECTED;
                        $selectionrptdata->datecreated  = $curdate;
                        $selectionrptdata->datemodified = $curdate;
                        
                        unset($selectionrptdata->id);
                        unset($selectionrptdata->step);
                        unset($selectionrptdata->user_name);
                        unset($selectionrptdata->email);
                        unset($selectionrptdata->phone);
                        $selectionrptdata = (array) $selectionrptdata;
                        $this->Model_Incubation->save_data_incubation_selection_report($selectionrptdata);
                    }
                }else{
                    // Set JSON data
                    $data = array('msg' => 'error','message' => 'Terjadi kesalahan update data seleksi');
                }
                // JSON encode data
                die(json_encode($data));
                break;
            case 'download' :
                // Set JSON data
                $data = array('msg' => 'success','message' => base_url('incubationdownloadfile/'.$uniquecode));
                // JSON encode data
                die(json_encode($data));
                break;
        }
    }
    
    /**
	 * Incubation Selection Download File function.
	 */
    function incubationdownloadfile($uniquecode){
        // Check Auth Redirect
        $auth = auth_redirect();
        if( !$auth ){
            die('Anda harus login terlebih dahulu untuk mendownload file ini');
        }
        
        if ( !$uniquecode ){
            die('Parameter data seleksi harus dicantumkan');
        }
        
        // Check Selection Data
        $selectiondata  = $this->Model_Incubation->get_incubation_by_uniquecode($uniquecode);
        if( !$selectiondata || empty($selectiondata) ){
            die('Data seleksi tidak ditemukan atau belum terdaftar');
        }
        
        $file_name      = $selectiondata->filename . '.' . $selectiondata->extension;
        $file_url       = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationselection/' . $selectiondata->user_id . '/' . $file_name;
        
        force_download($file_name, $file_url);
    }
    
    /**
	 * Jury Detail Incubation data function.
	 */
    function juryscoredatadetails($uniquecode){
        
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Check Auth Redirect
        $auth = auth_redirect( $this->input->is_ajax_request() );
        if( !$auth ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
          
        $current_user   = smit_get_current_user();
        $is_jury        = as_juri($current_user);
        $content        = '';
        
        if( !$is_jury ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        if( !$uniquecode ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }
        
        $scoresetdata      = $this->Model_Incubation->get_incubation_by_uniquecode($uniquecode);
        unset($scoresetdata->id);

        if( !$scoresetdata ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Data pengaturan seleksi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        // Set JSON data
        $data = array('message' => 'success','data' => 'Data pengaturan seleksi ditemukan','details' => $scoresetdata);
        // JSON encode data
        die(json_encode($data));
    }
    
    /**
	 * Jury Nilai Incubation data function.
	 */
    function juryscoredatanilai($id){
        
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        // Check Auth Redirect
        $auth = auth_redirect( $this->input->is_ajax_request() );
        if( !$auth ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
          
        $current_user   = smit_get_current_user();
        $is_jury        = as_juri($current_user);
        $content        = '';
        
        if( !$is_jury ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('dashboard'));
            // JSON encode data
            die(json_encode($data));
        }
        
        if( !$id ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Parameter data pengaturan seleksi tidak ditemukan');
            // JSON encode data
            die(json_encode($data));
        }
        
        $scoresetdata      = $this->Model_Incubation->get_incubation_by('id',$id);
        if( !$scoresetdata ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Data pengaturan seleksi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        // Set JSON data
        $data = array('message' => 'success','data' => 'Data pengaturan seleksi ditemukan','details' => $scoresetdata);
        // JSON encode data
        die(json_encode($data));
    }
    
    
    /**
	 * Report Incubation function.
	 */
	public function incubationreport()
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
            'IncubationList.init();',
        ));

        $data['title']          = TITLE . 'Laporan Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_jury']        = $is_jury;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation/report';
        
        $this->load->view(VIEW_BACK . 'template', $data);
	}
    
    /**
	 * Incubation Report list data function.
	 */
    function incubationrepordatatlist(){
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
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        $s_confirmed        = $this->input->post('search_confirmed');
        $s_confirmed        = smit_isset($s_confirmed, '');
        $s_jury             = $this->input->post('search_jury');
        $s_jury             = smit_isset($s_jury, '');
        $s_extension        = $this->input->post('search_extension');
        $s_extension        = smit_isset($s_extension, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_jury) )           { $condition .= str_replace('%s%', $s_jury, ' AND %jury% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        if( !empty($s_confirmed) )      { $condition .= str_replace('%s%', $s_confirmed, ' AND %confirmed% = %s%'); }
        if( !empty($s_extension) )      { $condition .= str_replace('%s%', $s_extension, ' AND %extension% LIKE "%%s%%"'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%username% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%confirmed% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%extension% ' . $sort; }
        elseif( $column == 7 )  { $order_by .= '%jury% ' . $sort; }
        elseif( $column == 8 )  { $order_by .= '%datecreated% ' . $sort; }
        
        $incubationreport_list  = $this->Model_Incubation->get_all_incubation_report($limit, $offset, $condition, $order_by);
        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($incubationreport_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_report_status');
            
            $i = $offset + 1;
            foreach($incubationreport_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('inact/details/'.$row->uniquecode).'" 
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Details">Details</a> ';
                
                if($row->status == REPORT_CALLED)       { $status = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REPORT_REJECTED) { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                
                if($row->confirmed == 0)            { $conf = '<span class="label label-default">BELUM DIKONFIRMASI</span>'; }
                elseif($row->confirmed == 1)        { $conf = '<span class="label label-primary">DIKONFIRMASI</span>'; }
                
                //Extension
                if($row->extension == 'pdf')        { $extension = '<span class="label label-danger">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'doc')    { $extension = '<span class="label label-primary">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'docx')   { $extension = '<span class="label label-primary">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'xls')    { $extension = '<span class="label label-success">'.strtoupper($row->extension).'</span>'; }
                elseif($row->extension == 'xlsx')   { $extension = '<span class="label label-success">'.strtoupper($row->extension).'</span>'; }

                $records["aaData"][] = array(
                    smit_center($i),
                    '<a href="'.base_url('users/profile/'.$row->id).'">' . $row->username . '</a>',
                    strtoupper($row->name),
                    '<a href="'.base_url('upload/incubationselection/'.$row->uniquecode).'">' . $row->event_title . '</a>',
                    smit_center( $status ),
                    smit_center( $conf ),
                    smit_center( $extension ),
                    $row->jury_id > 0 ? smit_center( strtoupper($row->jury_name) ) : smit_center(''),
                    smit_center( date('Y-m-d', strtotime($row->datecreated)) ),
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
    
    // ---------------------------------------------------------------------------------------------
}

/* End of file Incubation.php */
/* Location: ./application/controllers/incubation.php */