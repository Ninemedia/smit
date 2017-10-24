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
        $data['main_content']   = 'selectionincubation/list';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Incubation list data function.
	 */
    function incubationlistdatastep1( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = ' WHERE %step% = 1 AND %view% = 1';

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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');
        $s_year             = ( $s_year == 'Pilih Tahun' ? '' : $s_year );

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year_setting% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $is_admin ){
            if( $column == 2 )      { $order_by .= '%year_setting% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 7 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 2 )      { $order_by .= '%year_setting% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }
        }

        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('seleksiinkubasi/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $year           = $row->year_setting;
                $name           = strtoupper($row->user_name);
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $row->status == NOTCONFIRMED ){
                    $workunit   = '<strong style="color : red !important; ">'.$workunit.'</strong>';
                    $year       = '<strong style="color : red !important; ">'.$year.'</strong>';
                    $name       = '<strong style="color : red !important; ">'.$name.'</strong>';
                    $event      = '<strong style="color : red !important; ">'.$event.'</strong>';
                    $datecreated= '<strong style="color : red !important; ">'.$datecreated.'</strong>';
                }

                if( !empty($is_admin) ){
                    $records["aaData"][] = array(
                        smit_center('<input name="selectionlist[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="'.$row->id.'" type="checkbox" '.( $row->status > 0 ? 'disabled="disabled"' : '' ).'/>
                        <label for="cblist'.$row->id.'"></label>'),
                        smit_center( $i ),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        //smit_center( $datecreated ),
                        smit_center( $status ),
                        smit_center( $btn_action ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        smit_center( $datecreated ),
                        smit_center( $status ),
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
            $selectionlist          = $_REQUEST['selectionlist'];

            $proses                 = $this->incubationconfirm_all($sGroupActionName, $selectionlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
            $data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
            if( !empty($data_list) ){
                $export                     = $this->smit_excel->exportSelectionStep1( $data_list );
                $records["sStatus"]         = "EXPORTED";
                $records["sMessage"]        = $export;
            }else{
                $records["sStatus"]         = "ERROR";
                $records["sMessage"]        = 'Tidak ada data Seleksi Inkubasi untuk di export';
            }
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
            $data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
            if( !empty($data_list) ){
                $export                     = $this->smit_excel->exportSelectionStep1( $data_list, true );
                $records["sStatus"]         = "EXPORTED";
                $records["sMessage"]        = $export;
            }else{
                $records["sStatus"]         = "ERROR";
                $records["sMessage"]        = 'Tidak ada data Seleksi Inkubasi untuk di export';
            }
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Incubation Confirm All function.
	 */
    function incubationconfirm_all($action, $data){
        $response = array();

        // Check Action
        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        // Check Data
        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        // Check Admin Priviledges
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        // Check Incubation Setting
        $incset         = smit_latest_incubation_setting();
        if( !$incset || empty($incset) ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data pengaturan seleksi',
            );
            return $response;
        }

        if( $incset->status == 0 ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Pengaturan seleksi sudah ditutup',
            );
            return $response;
        }

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )    { $actiontxt = 'Konfirmasi'; $status = ACTIVE; }
        //if( $action=='process' )    { $actiontxt = 'Proses Nilai'; $status = ACTIVE; }
        if( $action=='delete' )     { $actiontxt = 'Hapus'; $status = DELETED; }
        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $data = (object) $data;
        foreach( $data as $key => $id ){
            // Check Data Incubation Selection

            $condition  = ' WHERE %id% = '.$id.' AND %status% = 0 AND %step% = 1';
            $order_by   = ' %id% ASC';
            $incseldata  = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);
            if( !$incseldata || empty($incseldata) ){
                continue;
            }
            $incseldata  = $incseldata[0];

            if( $status ==  DELETED){
                $incselupdatedata   = array(
                    'view'          => DELETED,
                    'datemodified'  => $curdate,
                );
            }else{
                $incselupdatedata   = array(
                    'status'        => $status,
                    'datemodified'  => $curdate,
                );
            }

            if( !$this->Model_Incubation->update_data_incubation($incseldata->id, $incselupdatedata) ){
                continue;
            }

            if( $status != DELETED ){
                $this->smit_email->send_email_selection_confirmation_step1($incseldata);
            }

            /*
            if($action=='confirm'){
                $condition  = ' WHERE %id% = '.$id.' AND %status% = 0 AND %step% = 1';
                $order_by   = ' %id% ASC';
                $incseldata  = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);
                if( !$incseldata || empty($incseldata) ){
                    continue;
                }
                $incseldata  = $incseldata[0];

                $incselupdatedata   = array(
                    'status'        => $status,
                    'datemodified'  => $curdate,
                );

                if( !$this->Model_Incubation->update_data_incubation($incseldata->id, $incselupdatedata) ){
                    continue;
                }
                $this->smit_email->send_email_selection_confirmation_step1($incseldata);
            }else{
                $incset     = smit_latest_incubation_setting();
                $condition  = ' WHERE %id% = '.$id.' AND %status% = 2 AND %step% = 1';
                $order_by   = ' %id% ASC';
                $incseldata  = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);
                if( !$incseldata || empty($incseldata) ){
                    continue;
                }
                $incseldata  = $incseldata[0];

                $sum_score      = $this->Model_Incubation->sum_all_score($id);
                if(empty($sum_score)){
                    $sum_score  = 0;
                }

                $count_all_jury = $this->Model_Incubation->count_all_score($id);
                if(empty($count_all_jury)){
                    $count_all_jury = 0;
                }

                if(!empty($sum_score) && !empty($count_all_jury)){
                    $avarage_score  = $sum_score / $count_all_jury;
                }else{
                    $avarage_score  = 0;
                }

                if( $avarage_score < KKM_STEP1 ){
                    $status         = REJECTED;
                }else{
                    $status         = ACCEPTED;
                }

                $incselupdatedata    = array(
                    'score'         => $sum_score,
                    'average_score' => $avarage_score,
                    'status'        => $status,
                    'statustwo'     => 1,
                    'steptwo'       => 2,
                    'datemodified'  => $curdate,
                );

                if( !$this->Model_Incubation->update_data_incubation($id, $incselupdatedata) ){
                    continue;
                }else{
                    if( $avarage_score < KKM_STEP1 ){
                        $this->smit_email->send_email_selection_not_success_step1($incset, $incseldata);
                    }else{
                        $this->smit_email->send_email_selection_confirmation_step2($incseldata);
                        $this->smit_email->send_email_selection_success($incset, $incseldata);
                    }
                }
            }

            */
        }

        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data seleksi selesai di proses',
        );
        return $response;
    }

    /**
	 * Incubation list data function.
	 */
    function incubationlistdatastep2( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = ' WHERE %steptwo% = 2 AND %view% = 1';

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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year_setting% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( !empty($is_admin) ){
            if( $column == 1 )      { $order_by .= '%year_setting% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 6 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 1 )      { $order_by .= '%year_setting% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        }

        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status_steptwo');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                // Status
                $btn_action = '<a href="'.base_url('seleksiinkubasi/daftar/detail/'.$row->uniquecode).'"
                    class="inact btn btn-xs btn-primary waves-effect tooltips bottom5" data-placement="left" title="Detail"><i class="material-icons">zoom_in</i></a> ';

                if($row->statustwo == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }

                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $year           = $row->year_setting;
                $name           = strtoupper($row->user_name);
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $row->status == NOTCONFIRMED ){
                    $workunit   = '<strong style="color : red !important; ">'.$workunit.'</strong>';
                    $year       = '<strong style="color : red !important; ">'.$year.'</strong>';
                    $name       = '<strong style="color : red !important; ">'.$name.'</strong>';
                    $event      = '<strong style="color : red !important; ">'.$event.'</strong>';
                    $datecreated= '<strong style="color : red !important; ">'.$datecreated.'</strong>';
                }

                if( !empty($is_admin) ){
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        //smit_center( $datecreated ),
                        smit_center( $status ),
                        smit_center( $btn_action ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        smit_center( $datecreated ),
                        smit_center( $status ),
                        smit_center( $btn_action ),
                    );
                }

                $i++;
            }
        }

        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;

        if(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
            $data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
            if( !empty($data_list) ){
                $export                     = $this->smit_excel->exportSelectionStep2( $data_list );
                $records["sStatus"]         = "EXPORTED";
                $records["sMessage"]        = $export;
            }else{
                $records["sStatus"]         = "ERROR";
                $records["sMessage"]        = 'Tidak ada data Seleksi Inkubasi untuk di export';
            }
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
            $data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
            if( !empty($data_list) ){
                $export                     = $this->smit_excel->exportSelectionStep2( $data_list, true );
                $records["sStatus"]         = "EXPORTED";
                $records["sMessage"]        = $export;
            }else{
                $records["sStatus"]         = "ERROR";
                $records["sMessage"]        = 'Tidak ada data Seleksi Inkubasi untuk di export';
            }
        }

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
        $data['main_content']   = 'selectionincubation/listdetail';

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

        if( file_exists( $file_url ) ){
            force_download($file_name, $file_url);
        }else{
            redirect( base_url('beranda') );
        }
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
        $data['main_content']   = 'selectionincubation/setting';

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
            // Range Slider Plugin
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

        $active                 = 0;
        $active2                = 0;
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

            $jury_step2             = $lss->selection_juri_phase2;
            $jury_step2             = explode(",", $jury_step2);
            foreach($jury_step2 as $id){
                if($id == $current_user->id){
                    $active2 = 1;
                    break;
                }else{
                    $active2 = 0;
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
        $data['active2']        = $active2;
        $data['main_content']   = 'selectionincubation/score';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Score Jury Incubation function.
	 */
	public function adminscoreuser($step, $unique)
	{
        auth_redirect();

        if( !$step || !$unique ) redirect( base_url('seleksiinkubasi/nilai') );

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
            // Range Slider Plugin
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
        if( $is_pengusul ){
            if( $step == 1 ){
                $condition          = ' WHERE %uniquecode% = "'.$unique.'" AND %step% = '.$step.' ';
            }else{
                $condition          = ' WHERE %uniquecode% = "'.$unique.'" AND %steptwo% = '.$step.' ';
            }
        }else{
            if( $step == 1 ){
                $condition          = ' WHERE %uniquecode% = "'.$unique.'" AND %step% = '.$step.' AND %status% <> 0 ';
            }else{
                $condition          = ' WHERE %uniquecode% = "'.$unique.'" AND %steptwo% = '.$step.' AND %statustwo% <> 0 ';
            }
        }

        $data_selection         = $this->Model_Incubation->get_all_incubation(0, 0, $condition, '');
        if( !$data_selection || empty($data_selection) ){
            redirect( base_url('seleksiinkubasi/nilai') );
        }
        $data_selection         = $data_selection[0];

        $condition              = ' WHERE %selection_id% = "'.$data_selection->id.'"';
        $data_selection_files   = $this->Model_Incubation->get_all_incubation_files(0, 0, $condition, '');
        if( !$data_selection_files || empty($data_selection_files) ){
            redirect( base_url('seleksiinkubasi/nilai') );
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
            $data['main_content']       = 'selectionincubation/scoredetailstep1';
        }else{
            $data['main_content']       = 'selectionincubation/scoredetailstep2';
        }

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Incubation Confirm Score Step 1 function.
	 */
    function incubationconfirmstep1($uniquecode=''){
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

        // Check Data Pra Incubation Selection
        $condition  = ' WHERE %status% = 2 AND %step% = 1';
        $condition .= !empty($uniquecode) ? ' AND %uniquecode% LIKE "'.$uniquecode.'"' : '';
        $order_by   = ' %id% ASC';
        $incseldata = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);

        if( !$incseldata || empty($incseldata) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Tidak ada data seleksi step 1 yang belum dinilai oleh juri');
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

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        foreach($incseldata as $row){
            $sum_score      = $this->Model_Incubation->sum_all_score($row->id);
            if(empty($sum_score)){
                $sum_score  = 0;
            }

            $count_all_jury = $this->Model_Incubation->count_all_score($row->id);
            if(empty($count_all_jury)){
                $count_all_jury = 0;
            }

            if(!empty($sum_score) && !empty($count_all_jury)){
                $avarage_score  = $sum_score / $count_all_jury;
            }else{
                $avarage_score  = 0;
            }

            if( $avarage_score < KKM_STEP1 ){
                $status         = REJECTED;
            }else{
                $status         = ACCEPTED;
            }

            $incselupdatedata    = array(
                'score'         => $sum_score,
                'average_score' => $avarage_score,
                'status'        => $status,
                'statustwo'     => 1,
                'steptwo'       => 2,
                'datemodified'  => $curdate,
            );

            if( !$this->Model_Incubation->update_data_incubation($row->id, $incselupdatedata) ){
                continue;
            }else{
                if( $avarage_score < KKM_STEP1 ){
                    $this->smit_email->send_email_selection_not_success_step1($incset, $row);
                }else{
                    $this->smit_email->send_email_selection_confirmation_step2($row);
                    $this->smit_email->send_email_selection_success($incset, $row);
                }
            }
        }

        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();
        // Set JSON data
        $data = array('msg' => 'success','message' => 'Semua data Seleksi Inkubasi Step 1 sudah dikonfirmasi.');
        // JSON encode data
        die(json_encode($data));
    }

    /**
	 * Incubation Confirm Score Step 2 function.
	 */
    function incubationconfirmstep2($uniquecode=''){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');

        $curdate            = date('Y-m-d H:i:s');
        $desc               = '';
        $user_desc          = array();
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Inkubasi hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };

        // Check Data Pra Incubation Selection
        $condition  = ' WHERE %statustwo% = 2 AND %steptwo% = 2';
        $condition .= !empty($uniquecode) ? ' AND %uniquecode% LIKE "'.$uniquecode.'"' : '';
        $order_by   = ' %id% ASC';
        $incseldata = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);

        if( !$incseldata || empty($incseldata) ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Tidak ada data seleksi step 2 yang belum dikonfirmasi');
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

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $desc .= 'Pengumuman Hasil Seleksi Pra-Inkubasi Tahap 2<br />Berikut Daftar Pengusul<br />';
        foreach($incseldata as $row){

            // Total
            $sum_score2     = $this->Model_Incubation->sum_all_score2($row->id);
            if(empty($sum_score2)){
                $sum_score2  = 0;
            }

            $count_all_jury2= $this->Model_Incubation->count_all_score2($row->id);
            if(empty($count_all_jury2)){
                $count_all_jury2 = 0;
            }

            if(!empty($sum_score2) && !empty($count_all_jury2)){
                $average_score  = $sum_score2 / $count_all_jury2;
            }else{
                $average_score  = 0;
            }

            if( $average_score < KKM_STEP2 ){
                $status         = REJECTED;
            }else{
                $status         = ACCEPTED;
            }

            $incselupdatedata    = array(
                'scoretwo'          => $sum_score2,
                'average_scoretwo'  => $average_score,
                'statustwo'         => $status,
                'datemodified'      => $curdate,
            );

            if( !$this->Model_Incubation->update_data_incubation($row->id, $incselupdatedata) ){
                continue;
            }else{
                if( $average_score < KKM_STEP2 ){
                    // Send Email Notification Not Success Step 2s
                    $this->smit_email->send_email_selection_not_success_step2($incset, $row);
                }else{
                    // Update Status User
                    $status_user        = array(
                        'type'          => TENANT,
                        'datemodified'  => $curdate
                    );

                    // Check Status User
                    $user           = $this->Model_User->get_userdata($row->user_id);
                    if($user->type == PELAKSANA || $user->type == TENANT){
                        // Update Status User
                        $status_user        = array(
                            'type'          => PELAKSANA_TENANT,
                            'datemodified'  => $curdate
                        );
                    }

                    $update_status_user = $this->Model_User->update_data($row->user_id, $status_user);

                    // Send Email Notification Selection Accepted
                    $this->smit_email->send_email_selection_accepted($incset, $row);
                }

                // Set User Rejected
                $user_desc[]        = array(
                    'name'          => $row->user_name,
                    'title'         => $row->event_title,
                    'status'        => $status
                );
            }
        }

        $desc .= '<div class="table-container table-responsive">';
            $desc .= '<table class="table table-striped table-hover">';
                $desc .= '
                <thead>
                    <tr role="row" class="heading bg-blue">
                        <th class="width5">No</th>
                        <th class="width25">Nama Pengusul</th>
                        <th class="width55">Judul Seleksi</th>
                        <th class="width15 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>';

                if( !empty($user_desc) ){
                    $i=1;
                    foreach($user_desc as $user){
                        $desc .= '
                        <tr>
                            <td class="width5">'.$i.'</td>
                            <td class="width25">'.$user['name'].'</td>
                            <td class="width55">'.$user['title'].'</td>
                            <td class="width15 text-center"><strong>'. ( $user['status'] == ACCEPTED ? 'DITERIMA' : 'DITOLAK' ).'</strong></td>
                        </tr>';
                        $i++;
                    }
                }else{
                    $desc .= '<tr><td colspan="4" class="text-center"><strong>Tidak Ada Data Seleksi Inkubasi</strong></tr>';
                }

                $desc .= '</tbody>';
            $desc .= '</table>';
        $desc .= '</div>';

        // Save Announcement
        $announcement_data  = array(
            'uniquecode'    => smit_generate_rand_string(10,'low'),
            'user_id'       => $current_user->id,
            'username'      => strtolower($current_user->username),
            'name'          => $current_user->name,
            'no_announcement'   => smit_generate_no_announcement(1, 'charup'),
            'title'         => 'Pengumuman Hasil Seleksi Inkubasi Tahap 2',
            'desc'          => $desc,
            'uploader'      => $current_user->id,
            'status'        => 1,
            'datecreated'   => $curdate,
            'datemodified'  => $curdate,
        );
        $announcement_save_id = $this->Model_Announcement->save_data_announcement($announcement_data);

        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();
        // Set JSON data
        $data = array('msg' => 'success','message' => 'Semua data Seleksi Inkubasi Step 2 sudah dikonfirmasi.');
        // JSON encode data
        die(json_encode($data));
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
        $condition          = ' WHERE step = 1 AND %status% <> 0 AND %status% <> 5';

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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }

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
                    if( /* $curdate >= $selection_date_invitation_send && */ $curdate <= $selection_date_interview_start ){
                        $btn_score  = '<a href="'.base_url('seleksiinkubasi/konfirmasistep1/'.$row->uniquecode).'"
                        class="btn_scorestep1 btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }else{
                        //$btn_score  = '<a class="btn btn-xs btn-grey waves-effect tooltips" disabled="disabled" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">check</i></a>';
                }elseif( $row->status == CONFIRMED || $row->status == REJECTED || $row->status == ACCEPTED ){
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">check</i></a>';
                }

                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $sum_score      = $row->score;
                $average_score  = $row->average_score;
                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $name           = strtoupper($row->name);
                $year           = $row->year;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $average_score < KKM_STEP1 ){
                    $average_score      = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                }

                if( $row->status == CONFIRMED ){
                    /*
                    $workunit   = '<strong style="color : red !important; ">'.$workunit.'</strong>';
                    $name       = '<strong style="color : red !important; ">'.$name.'</strong>';
                    $year       = '<strong style="color : red !important; ">'.$year.'</strong>';
                    $event      = '<strong style="color : red !important; ">'.$event.'</strong>';
                    $datecreated= '<strong style="color : red !important; ">'.$datecreated.'</strong>';
                    */
                    $sum_score  = '<strong style="color : red !important; ">'.floor($sum_score).'</strong>';
                    $average_score  = '<strong style="color : red !important; ">'.$average_score.'</strong>';
                }

                $records["aaData"][] = array(
                        smit_center('<input name="selectionliststep1[]" class="cblist filled-in chk-col-blue" id="cblist'.$row->id.'" value="'.$row->id.'" type="checkbox" '.( $sum_score > 0 && $row->status != 2 ? 'disabled="disabled"' : '' ).'/>
                        <label for="cblist'.$row->id.'"></label>'),
                        smit_center($i),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        $event,
                        smit_center( $sum_score ),
                        smit_center( $average_score ),
                        smit_center( $datecreated ),
                        smit_center( $status ),
                        smit_center( $btn_score. ' ' .$btn_details),
                    );
                $i++;
            }
        }

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $selectionlist          = $_REQUEST['selectionliststep1'];

            $proses                 = $this->incubationconfirmstep1_all($sGroupActionName, $selectionlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
        	$data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportScoreStep1( $data_list );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Penilaian Inkubasi untuk di export';
        	}
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
        	$data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportScoreStep1( $data_list, true );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Penilaian Inkubasi untuk di export';
        	}
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Incubation Confirm Score Step 1 All function.
	 */
    function incubationconfirmstep1_all($action, $data){
        $response = array();

        // Check Action
        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        // Check Data
        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        // Check Admin Priviledges
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        // Check Incubation Setting
        $incset         = smit_latest_incubation_setting();
        if( !$incset || empty($incset) ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data pengaturan seleksi',
            );
            return $response;
        }

        if( $incset->status == 0 ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Pengaturan seleksi sudah ditutup',
            );
            return $response;
        }

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )        { $actiontxt = 'Konfirmasi';    $status = ACTIVE; }
        if( $action=='graduate' )       { $actiontxt = 'Lulus';         $status = ACCEPTED; }
        if( $action=='notgraduate' )    { $actiontxt = 'Tidak Lulus';   $status = REJECTED; }
        if( $action=='delete' )         { $actiontxt = 'Hapus';         $status = DELETED_SELECTION; }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $data = (object) $data;
        foreach( $data as $key => $id ){
            // Check Data Pra Incubation Selection
            $condition  = ' WHERE %id% = '.$id.' AND %step% = 1';
            $order_by   = ' %id% ASC';
            $incseldata  = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);
            if( !$incseldata || empty($incseldata) ){
                continue;
            }
            $incseldata  = $incseldata[0];

            $sum_score      = $this->Model_Incubation->sum_all_score($incseldata->id);
            if(empty($sum_score)){
                $sum_score  = 0;
            }

            $count_all_jury = $this->Model_Incubation->count_all_score($incseldata->id);
            if(empty($count_all_jury)){
                $count_all_jury = 0;
            }

            if(!empty($sum_score) && !empty($count_all_jury)){
                $average_score  = round( $sum_score / $count_all_jury );
            }else{
                $average_score  = 0;
            }

            if($action=='graduate' || $action=='confirm'){
                $status         = ACCEPTED;
                $incselupdatedata    = array(
                    'score'         => $sum_score,
                    'average_score' => $average_score,
                    'status'        => $status,
                    'statustwo'     => 1,
                    'steptwo'       => 2,
                    'datemodified'  => $curdate,
                );
            }elseif($action=='notgraduate'){
                $status         = REJECTED;
                $incselupdatedata    = array(
                    'score'         => $sum_score,
                    'average_score' => $average_score,
                    'status'        => $status,
                    'datemodified'  => $curdate,
                );
            }elseif($action=='delete'){
                $status         = DELETED_SELECTION;
                $incselupdatedata    = array(
                    'status'        => $status,
                    'datemodified'  => $curdate,
                );
            }

            /*
            if( $average_score < KKM_STEP1 ){
                $status         = REJECTED;
            }else{
                $status         = ACCEPTED;
            }
            */

            if( !$this->Model_Incubation->update_data_incubation($incseldata->id, $incselupdatedata) ){
                continue;
            }else{
                //if( $average_score < KKM_STEP1 ){
                if( $action=='notgraduate' ){
                    $this->smit_email->send_email_selection_not_success_step1($incset, $incseldata);
                }elseif( $action=='graduate' ){
                    $this->smit_email->send_email_selection_confirmation_step2($incseldata);
                    $this->smit_email->send_email_selection_success($incset, $incseldata);
                }
            }
        }

        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();
        if( $action=='delete' ){
            $response = array(
                'status'    => 'OK',
                'message'   => 'Data Seleksi Berhasil Di '.strtoupper($actiontxt).'.',
            );
        }else{
            $response = array(
                'status'    => 'OK',
                'message'   => 'Proses '.strtoupper($actiontxt).' data Seleksi Inkubasi tahap 1 selesai di proses',
            );
        }

        return $response;
    }

    /**
	 * Admin Score list data function.
	 */
    function adminscorelistdatastep2( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE %steptwo% <> 0';

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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');
        $s_year             = ( $s_year == 'Pilih Tahun' ? '' : $s_year );

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }

        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status_steptwo');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';
                $btn_details        = '';
                if( $row->statustwo == RATED ){
                    $lss                                = smit_latest_incubation_setting();
                    $selection_date_result              = strtotime($lss->selection_date_result);
                    $selection_date_proposal_start      = strtotime($lss->selection_date_proposal_start);
                    if( $curdate >= $selection_date_result && $curdate <= $selection_date_proposal_start ){
                        $btn_score  = '<a href="'.base_url('seleksiinkubasi/konfirmasistep2/'.$row->uniquecode).'"
                        class="btn_scorestep2 btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }else{
                        //$btn_score  = '<a class="btn btn-xs btn-grey waves-effect tooltips" disabled="disabled" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->steptwo.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">check</i></a>';
                }elseif( $row->statustwo == CONFIRMED || $row->statustwo == REJECTED || $row->statustwo == ACCEPTED ){
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->steptwo.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">check</i></a>';
                }

                if($row->statustwo == CONFIRMED)       { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }

                $sum_score          = $row->scoretwo;
                $average_score      = $row->average_scoretwo;
                //Workunit
                $workunit_type      = smit_workunit_type($row->workunit);

                $records["aaData"][] = array(
                        smit_center('<input name="selectionliststep2[]" class="cblist filled-in chk-col-blue" id="cblist2'.$row->id.'" value="'.$row->id.'" type="checkbox" '.( $row->statustwo != 2 ? 'disabled="disabled"' : '' ).'/>
                        <label for="cblist2'.$row->id.'"></label>'),
                        smit_center($i),
                        smit_center($row->year),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . strtoupper($row->name) . '</a>',
                        strtoupper($workunit_type->workunit_name),
                        $row->event_title,
                        smit_center( floor($sum_score) ),
                        smit_center( floor($average_score) ),
                        smit_center( date('d F Y', strtotime($row->datecreated)) ),
                        smit_center( $status ),
                        smit_center( $btn_details),
                    );
                $i++;
            }
        }

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if (isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "group_action") {
            $sGroupActionName       = $_REQUEST['sGroupActionName'];
            $selectionlist          = $_REQUEST['selectionliststep2'];

            $proses                 = $this->incubationconfirmstep2_all($sGroupActionName, $selectionlist);
            $records["sStatus"]     = $proses['status'];
            $records["sMessage"]    = $proses['message'];
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
        	$data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportScoreStep2( $data_list );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Penilaian Inkubasi untuk di export';
        	}
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
        	$data_list                      = $this->Model_Incubation->get_all_incubation(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportScoreStep2( $data_list, true );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Penilaian Inkubasi untuk di export';
        	}
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Incubation Confirm Score Step 2 All function.
	 */
    function incubationconfirmstep2_all($action, $data){
        $response   = array();
        $desc       = 'Pengumuman Hasil Seleksi Inkubasi Tahap 2<br />Berikut Daftar Pengusul<br />';
        $user_desc  = array();

        // Check Action
        if ( !$action ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Silahkan pilih proses',
            );
            return $response;
        };

        // Check Data
        if ( !$data ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data terpilih untuk di proses',
            );
            return $response;
        };

        // Check Admin Priviledges
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Hanya Administrator yang dapat melakukan proses ini',
            );
            return $response;
        };

        // Check Incubation Setting
        $incset     = smit_latest_incubation_setting();
        if( !$incset || empty($incset) ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Tidak ada data pengaturan seleksi',
            );
            return $response;
        }

        if( $incset->status == 0 ){
            $response = array(
                'status'    => 'ERROR',
                'message'   => 'Pengaturan seleksi sudah ditutup',
            );
            return $response;
        }

        $curdate = date('Y-m-d H:i:s');
        if( $action=='confirm' )        { $actiontxt = 'Konfirmasi';    $status = ACTIVE; }
        if( $action=='graduate' )       { $actiontxt = 'Lulus';         $status = ACCEPTED; }
        if( $action=='notgraduate' )    { $actiontxt = 'Tidak Lulus';   $status = REJECTED; }
        if( $action=='delete' )         { $actiontxt = 'Hapus';         $status = DELETED_SELECTION; }

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        $data = (object) $data;
        foreach( $data as $key => $id ){
            // Check Data Pra Incubation Selection
            $condition  = ' WHERE %id% = '.$id.' AND %statustwo% = 2 AND %steptwo% = 2';
            $order_by   = ' %id% ASC';
            $incseldata  = $this->Model_Incubation->get_all_incubation(0,0,$condition,$order_by);
            if( !$incseldata || empty($incseldata) ){
                continue;
            }
            $incseldata  = $incseldata[0];

            // Total
            $sum_score2     = $this->Model_Incubation->sum_all_score2($incseldata->id);
            if(empty($sum_score2)){
                $sum_score2  = 0;
            }

            $count_all_jury2= $this->Model_Incubation->count_all_score2($incseldata->id);
            if(empty($count_all_jury2)){
                $count_all_jury2 = 0;
            }

            if(!empty($sum_score2) && !empty($count_all_jury2)){
                $average_score  = round( $sum_score2 / $count_all_jury2 );
            }else{
                $average_score  = 0;
            }

            if($action=='graduate' || $action=='confirm'){
                $status         = ACCEPTED;
                $incselupdatedata    = array(
                    'scoretwo'          => $sum_score2,
                    'average_scoretwo'  => $average_score,
                    'statustwo'         => $status,
                    'datemodified'      => $curdate,
                );
            }elseif($action=='notgraduate'){
                $status         = REJECTED;
                $incselupdatedata    = array(
                    'scoretwo'          => $sum_score2,
                    'average_scoretwo'  => $average_score,
                    'statustwo'         => $status,
                    'datemodified'      => $curdate,
                );
            }elseif($action=='delete'){
                $status         = DELETED_SELECTION;
                $incselupdatedata    = array(
                    'statustwo'         => $status,
                    'datemodified'      => $curdate,
                );
            }

            /*
            if( $average_score < KKM_STEP2 ){
                $status         = REJECTED;
            }else{
                $status         = ACCEPTED;
            }
            */

            if( !$this->Model_Incubation->update_data_incubation($incseldata->id, $incselupdatedata) ){
                continue;
            }else{
                //if( $average_score < KKM_STEP2 ){
                if( $action=='notgraduate' ){
                    // Send Email Notification Not Success Step 2s
                    $this->smit_email->send_email_selection_not_success_step2($incset, $incseldata);
                }elseif( $action=='graduate' ){
                    // Update Status User
                    $status_user        = array(
                        'type'          => TENANT,
                        'role'          => TENANT,
                        'datemodified'  => $curdate
                    );
                    $update_status_user = $this->Model_User->update_data($incseldata->user_id, $status_user);

                    // Send Email Notification Selection Accepted
                    $this->smit_email->send_email_selection_accepted($incset, $incseldata);
                }

                // Set User Rejected
                $user_desc[]        = array(
                    'name'          => $incseldata->user_name,
                    'title'         => $incseldata->event_title,
                    'status'        => $status
                );
            }
        }

        if( $action=='graduate' ){
            $desc .= '<div class="table-container table-responsive">';
                $desc .= '<table class="table table-striped table-hover">';
                    $desc .= '
                    <thead>
                        <tr role="row" class="heading bg-blue">
                            <th class="width5">No</th>
                            <th class="width25">Nama Pengusul</th>
                            <th class="width55">Judul Seleksi</th>
                            <th class="width15 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>';

                    if( !empty($user_desc) ){
                        $i=1;
                        foreach($user_desc as $user){
                            $desc .= '
                            <tr>
                                <td class="width5">'.$i.'</td>
                                <td class="width25">'.$user['name'].'</td>
                                <td class="width55">'.$user['title'].'</td>
                                <td class="width15 text-center"><strong>'. ( $user['status'] == ACCEPTED ? 'DITERIMA' : 'DITOLAK' ).'</strong></td>
                            </tr>';
                            $i++;
                        }
                    }else{
                        $desc .= '<tr><td colspan="4" class="text-center"><strong>Tidak Ada Data Seleksi Inkubasi</strong></tr>';
                    }

                    $desc .= '</tbody>';
                $desc .= '</table>';
            $desc .= '</div>';

            // Save Announcement
            $announcement_data      = array(
                'uniquecode'        => smit_generate_rand_string(10,'low'),
                'user_id'           => $current_user->id,
                'username'          => strtolower($current_user->username),
                'name'              => $current_user->name,
                'no_announcement'   => smit_generate_no_announcement(1, 'charup'),
                'title'             => 'Pengumuman Hasil Seleksi Inkubasi Tahap 2',
                'desc'              => $desc,
                'uploader'          => $current_user->id,
                'status'            => 1,
                'datecreated'       => $curdate,
                'datemodified'      => $curdate,
            );
            $announcement_save_id = $this->Model_Announcement->save_data_announcement($announcement_data);
        }

        // Commit Transaction
        $this->db->trans_commit();
        // Complete Transaction
        $this->db->trans_complete();

        $response = array(
            'status'    => 'OK',
            'message'   => 'Proses '.strtoupper($actiontxt).' data Seleksi Inkubasi tahap 2 selesai di proses',
        );
        return $response;
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

        $post_selection_year_publication        = $this->input->post('selection_year_publication');
        /*
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
        */
        $post_selection_desc                    = $this->input->post('selection_desc');
        $post_selection_files                   = $this->input->post('selection_files');
        $post_selection_juri_phase1             = $this->input->post('selection_juri_phase1');
        $post_selection_juri_phase2             = $this->input->post('selection_juri_phase2');

        $this->form_validation->set_rules('selection_year_publication','Tahun Publikasi','required');
        /*
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
                'selection_year_publication'        => smit_isset($post_selection_year_publication, ''),
                /*
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
                */
                'selection_desc'                    => $post_selection_desc,
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
        elseif( $column == 2 )  { $order_by .= '%status% ' . $sort; }

        $incubationset_list = $this->Model_Incubation->get_all_incubation_setting($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        $juri_step1         = array();
        $juri_step2         = array();

        if( !empty($incubationset_list) ){
            $iTotalRecords  = smit_get_last_found_rows();

            $i = $offset + 1;
            foreach($incubationset_list as $row){
                $btn_details    = '<a href="'.base_url('detilseleksiinkubasi/'.$row->uniquecode).'"
                    class="praincubsetdet btn btn-xs btn-primary waves-effect tooltips" data-placement="left" title="Details"><i class="material-icons">zoom_in</i></a> ';
                $btn_close      = ( $row->status == 1 ?
                '<a href="'.base_url('tutupseleksiinkubasi/'.$row->uniquecode).'" class="incubsetclose btn btn-xs btn-danger waves-effect tooltips" data-placement="top" title="Close"><i class="material-icons">clear</i></a>' :
                '<a class="btn btn-xs btn-default waves-effect disabled"><i class="material-icons">clear</i></a>'  );

                if($row->status == 1)       { $status = '<span class="label label-success">OPEN</span>'; }
                elseif($row->status == 0)   { $status = '<span class="label label-danger">CLOSED</span>'; }

                $selection_step1    = $row->selection_juri_phase1;
                $selection_step1    = explode(",", $selection_step1);
                $selection_step2    = $row->selection_juri_phase2;
                $selection_step2    = explode(",", $selection_step2);

                foreach($selection_step1 AS $id){
                    $userdata       = $this->Model_User->get_user_by('id', $id);
                    $juri_step1[]   = $userdata->name;
                }

                foreach($selection_step2 AS $id){
                    $userdata       = $this->Model_User->get_user_by('id', $id);
                    $juri_step2[]   = $userdata->name;
                }

                $records["aaData"][] = array(
                    smit_center($i),
                    smit_center( date('Y', strtotime($row->selection_year_publication)) ),
                    $juri_step1,
                    $juri_step2,
                    //smit_center( date('d F Y', strtotime($row->selection_date_publication)) ),
                    //smit_center( date('d F Y', strtotime($row->selection_date_reg_start)) . ' - ' . date('d F Y', strtotime($row->selection_date_reg_end)) ),
                    //$row->selection_desc,
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

        // Get Incubation Setting Data
        $incubationsetdata      = $this->Model_Incubation->get_incubation_setting_by('uniquecode',$uniquecode);
        if( !$incubationsetdata ) base_url('seleksiinkubasi/pengaturan');

        $incubationsetdata->selection_files         = explode(',', $incubationsetdata->selection_files);
        $incubationsetdata->selection_juri_phase1   = explode(',', $incubationsetdata->selection_juri_phase1);
        $incubationsetdata->selection_juri_phase2   = explode(',', $incubationsetdata->selection_juri_phase2);

        if( !empty($_POST) ){
            // This is for AJAX request
        	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
            // Check Auth Redirect
            $auth = auth_redirect( $this->input->is_ajax_request() );
            if( !$auth ){
                // Set JSON data
                $data = array('data' => base_url('dashboard'));
                // JSON encode data
                die(json_encode($data));
            }

            $post_selection_year_publication        = $this->input->post('selection_year_publication');
            $post_selection_desc                    = $this->input->post('selection_desc');
            $post_selection_files                   = $this->input->post('selection_files');
            $post_selection_juri_phase1             = $this->input->post('selection_juri_phase1');
            $post_selection_juri_phase2             = $this->input->post('selection_juri_phase2');

            $this->form_validation->set_rules('selection_year_publication','Tahun Publikasi','required');
            $this->form_validation->set_rules('selection_files[]','Berkas Panduan','required');
            $this->form_validation->set_rules('selection_juri_phase1[]','Juri Tahap 1','required');
            $this->form_validation->set_rules('selection_juri_phase2[]','Juri Tahap 2','required');

            $this->form_validation->set_message('required', '%s harus di isi');
            $this->form_validation->set_error_delimiters('', '');

            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('message','<div id="alert" class="alert alert-danger">'.smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir pengaturan!').'</div>');
                // Set JSON data
                $data = array('data' => base_url('detilseleksiinkubasi/'.$uniquecode));
                // JSON encode data
                die(json_encode($data));
            }else{
                $curdate                    = date("Y-m-d H:i:s");
                $post_selection_files       = implode(',',$post_selection_files);
                $post_selection_juri_phase1 = implode(',',$post_selection_juri_phase1);
                $post_selection_juri_phase2 = implode(',',$post_selection_juri_phase2);

                $settingdata                = array(
                    'selection_year_publication'        => smit_isset($post_selection_year_publication, ''),
                    'selection_desc'                    => $post_selection_desc,
                    'selection_files'                   => $post_selection_files,
                    'selection_juri_phase1'             => $post_selection_juri_phase1,
                    'selection_juri_phase2'             => $post_selection_juri_phase2,
                    'datemodified'                      => $curdate,
                );

                if( $update_setting = $this->Model_Incubation->update_data_incubation_setting($incubationsetdata->id, $settingdata) ){
                    $this->session->set_flashdata('message','<div id="alert" class="alert alert-success">'.smit_alert('Pengaturan Seleksi Inkubasi berhasil di update').'</div>');
                }else{
                    $this->session->set_flashdata('message','<div id="alert" class="alert alert-danger">'.smit_alert('Pengaturan Seleksi Inkubasi tidak berhasil di update').'</div>');
                }
                // Set JSON data
                $data = array('data' => base_url('detilseleksiinkubasi/'.$uniquecode));
                // JSON encode data
                die(json_encode($data));
            }
        }

        // Get All Guides Filed
        $guide_files            = $this->Model_Guide->get_all_guides();
        $juri_list              = $this->Model_User->get_all_user(0,0,' WHERE %type% = 4 AND %status% = 1');

        $data['title']          = TITLE . 'Details Pengaturan Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['guide_files']    = $guide_files;
        $data['juri_list']      = $juri_list;
        $data['pis_data']       = $incubationsetdata;
        $data['main_content']   = 'selectionincubation/settingdetails';

        $this->load->view(VIEW_BACK . 'template', $data);
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

        $incubationsetdata   = $this->Model_Incubation->get_incubation_setting_by('uniquecode',$uniquecode);
        if( !$incubationsetdata ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Data pengaturan seleksi tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }

        $incubationsetupdate    = array('status' => 0, 'datemodified' => date('Y-m-d H:i:s'));
        if( $this->Model_Incubation->update_data_incubation_setting($incubationsetdata->id, $incubationsetupdate) ){
            // Set JSON data
            $data = array('message' => 'redirect','data' => base_url('seleksiinkubasi/pengaturan'));
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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
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
                $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/1/'.$row->uniquecode).'"
                class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';

                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $score          = $row->score;
                $average_score  = $row->average_score;
                $year           = $row->year;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $row->status == NOTCONFIRMED ){
                    $score          = '<strong style="color : red !important; ">'.floor($score).'</strong>';
                    $average_score  = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                    $year           = '<strong style="color : red !important; ">'.$year.'</strong>';
                    $event          = '<strong style="color : red !important; ">'.$event.'</strong>';
                    $datecreated    = '<strong style="color : red !important; ">'.$datecreated.'</strong>';
                }

                if( $average_score < KKM_STEP1 || $average_score < KKM_STEP2 ){
                    $average_score  = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                }

                $records["aaData"][] = array(
                    smit_center( $i ),
                    smit_center( $year ),
                    strtoupper( $event ),
                    smit_center( $score ),
                    smit_center( $average_score ),
                    smit_center( $datecreated ),
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
            $cfg_status     = config_item('incsel_status_steptwo');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/2/'.$row->uniquecode).'"
                class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';

                if($row->statustwo == CONFIRMED)        { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }

                //Workunit
                $workunit_type = smit_workunit_type($row->workunit);

                $score          = $row->scoretwo;
                $average_score  = $row->average_scoretwo;
                $year           = $row->year;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $row->statustwo == NOTCONFIRMED ){
                    $score          = '<strong style="color : red !important; ">'.floor($score).'</strong>';
                    $average_score  = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                    $year           = '<strong style="color : red !important; ">'.$year.'</strong>';
                    $event          = '<strong style="color : red !important; ">'.$event.'</strong>';
                    $datecreated    = '<strong style="color : red !important; ">'.$datecreated.'</strong>';
                }

                if( $average_score < KKM_STEP1 || $average_score < KKM_STEP2 ){
                    $average_score  = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                }

                $records["aaData"][] = array(
                    smit_center( $i ),
                    smit_center( $year ),
                    strtoupper( $event ),
                    smit_center( $score ),
                    smit_center( $average_score ),
                    smit_center( $datecreated ),
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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 6 )  { $order_by .= '%status% ' . $sort; }

        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        $lss                = smit_latest_incubation_setting();

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';

                // Check Jury Rated Selection
                $rated              = smit_check_juri_rated_incubation($current_user->id, $row->id, ONE, $lss->id);

                if( $row->status == 1 ){
                    if( empty($rated) ){
                        $btn_score      = '<a href="'.base_url('seleksiinkubasi/nilai/'.$row->step.'/'.$row->uniquecode).'"
                        class="btn_score btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Nilai"><i class="material-icons">done</i></a>';
                    }
                }

                $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'"
                class="btn_score btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Details"><i class="material-icons">zoom_in</i></a>';

                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $score          = $row->score;
                $average_score  = $row->average_score;
                if($average_score < KKM_STEP1){
                    $average_score   = '<strong style="color: red !important;">'.floor($average_score).'</strong>';
                }

                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $year           = $row->year;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));
                $name           = strtoupper( $row->name );
                if( $row->status == CONFIRMED ){
                    $year       = '<strong style="color: red !important;">'.$year.'</strong>';
                    $workunit   = '<strong style="color: red !important;">'.$workunit.'</strong>';
                    $event      = '<strong style="color: red !important;">'.$event.'</strong>';
                    $score      = '<strong style="color: red !important;">'.floor($score).'</strong>';
                    $datecreated= '<strong style="color: red !important;">'.$datecreated.'</strong>';
                    $name       = '<strong style="color: red !important;">'.$name.'</strong>';
                }

                if($rated){
                    $btn_ket    = '<i class="material-icons">assignment_turned_in</i>';
                }else{
                    $btn_ket    = '<strong style="color: red !important;"> - </strong>';
                    $score      = '<strong style="color: red !important;"> - </strong>';
                    $average_score  = '<strong style="color: red !important;"> - </strong>';
                }

                $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        smit_center( $score ),
                        smit_center( $average_score ),
                        smit_center( $datecreated ),
                        smit_center( $status ),
                        smit_center( $btn_ket ),
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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%status% ' . $sort; }

        $incubation_list    = $this->Model_Incubation->get_all_incubation($limit, $offset, $condition, $order_by);
        $lss                = smit_latest_incubation_setting();

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status_steptwo');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                $btn_score          = '';
                $btn_details        = '';

                // Check Jury Rated Selection
                $rated              = smit_check_juri_rated_incubation($current_user->id, $row->id, TWO, $lss->id);

                if( $row->statustwo == CONFIRMED ){
                    if( empty($rated) ){
                        $btn_score      = '<a href="'.base_url('seleksiinkubasi/nilai/'.$row->user_id.'/'.$row->uniquecode).'"
                        class="btn_score btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="2" title="Nilai"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/2/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                }elseif( $row->statustwo == RATED || $row->statustwo == ACCEPTED || $row->statustwo == REJECTED ){
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/2/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="2" title="Details"><i class="material-icons">zoom_in</i></a>';
                }

                if($row->statustwo == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }

                $score          = $row->scoretwo;
                $average_score  = $row->average_scoretwo;
                if($average_score < KKM_STEP2){
                    $average_score   = '<style="color: red !important;">'.$average_score.'</style>';
                }

                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $year           = $row->year;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));
                $name           = strtoupper( $row->name );
                if( $row->status == CONFIRMED ){
                    $year       = '<strong style="color: red !important;">'.$year.'</strong>';
                    $workunit   = '<strong style="color: red !important;">'.$workunit.'</strong>';
                    $event      = '<strong style="color: red !important;">'.$event.'</strong>';
                    $score      = '<strong style="color: red !important;">'.floor($score).'</strong>';
                    $datecreated= '<strong style="color: red !important;">'.$datecreated.'</strong>';
                    $name       = '<strong style="color: red !important;">'.$name.'</strong>';
                }

                if($rated){
                    $btn_ket    = '<i class="material-icons">assignment_turned_in</i>';
                }else{
                    $btn_ket    = '<strong style="color: red !important;"> - </strong>';
                    $score      = '<strong style="color: red !important;"> - </strong>';
                    $average_score  = '<strong style="color: red !important;"> - </strong>';
                }

                $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        smit_center( $score ),
                        smit_center( $average_score ),
                        smit_center( $datecreated ),
                        smit_center( $status ),
                        smit_center( $btn_ket ),
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
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            BE_PLUGIN_PATH . 'jquery-validation/additional-methods.js',
            // Range Slider Plugin
            BE_PLUGIN_PATH . 'ion-rangeslider/js/ion.rangeSlider.js',

            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/forms/form-validation.js',
            BE_JS_PATH . 'pages/index.js',
        ));

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'ScoreSetting.init();',
            'SliderIndikator.init();',
            'ScoreUserValidation.init();',
        ));
        $scripts_add            = '';
        $lss                    = '';

        // Get Pra-Incubation Selection Data
        $condition              = ' WHERE %uniquecode% = "'.$unique.'" AND %step% = 1 AND %status% <> 0';
        $data_selection         = $this->Model_Incubation->get_all_incubation(0, 0, $condition, '');
        if( !$data_selection || empty($data_selection) ){
            redirect( base_url('seleksiinkubasi/nilai') );
        }
        $data_selection         = $data_selection[0];

        // Check Jury Rated Selection
        if( !empty($lss) ){
            $lss                = smit_latest_incubation_setting();
            $rated              = smit_check_juri_rated_incubation($current_user->id, $data_selection->id, $step, $lss->id);
            if( !empty($rated) ){
                redirect( base_url('seleksiinkubasi/nilai') );
            }
        }

        $condition              = ' WHERE %selection_id% = "'.$data_selection->id.'"';
        $data_selection_files   = $this->Model_Incubation->get_all_incubation_files(0, 0, $condition, '');
        if( !$data_selection_files || empty($data_selection_files) ){
            redirect( base_url('seleksiinkubasi/nilai') );
        }

        $data['title']                  = TITLE . 'Penilaian Seleksi Inkubasi';
        $data['user']                   = $current_user;
        $data['is_admin']               = $is_admin;
        $data['is_jury']                = $is_jury;
        $data['is_pengusul']            = $is_pengusul;
        $data['is_pelaksana']           = $is_pelaksana;
        $data['data_selection']         = $data_selection;
        $data['data_selection_files']   = $data_selection_files;
        $data['lss']                    = $lss;
        $data['headstyles']             = $headstyles;
        $data['scripts']                = $loadscripts;
        $data['scripts_init']           = $scripts_init;
        $data['scripts_add']            = $scripts_add;

        if( $step == 1){
            $data['main_content']           = 'selectionincubation/scoreuser';
        }else{
            $data['main_content']           = 'selectionincubation/scoreuser2';
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

            // Check Incubation Selection Data
            $data_selection     = $this->Model_Incubation->get_incubation($selection_id);
            if( !$data_selection || empty($data_selection) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            // Check Incubation Selection User Data
            $data_selection_user = smit_get_userdata_by_id($data_selection->user_id);
            if( !$data_selection_user || empty($data_selection_user) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data user seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            // Check this Incubation Selection Rate Process
            if( !empty($is_jury) ){
                $rate_process       = $this->Model_Incubation->get_incubation_rate_step1_files($current_user->id, $data_selection->id);

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
                    'year'          => $data_selection->year,
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

                // Update Pra-Incubation Score
                $all_rate_total         = $this->Model_Incubation->get_incubation_rate_step1_total($selection_id);
                $all_rate_count         = $this->Model_Incubation->get_incubation_rate_step1_count($selection_id);
                //$average_score          = round( ( $all_rate_total + $rate_total ) /  ( $all_rate_count + 1 ) );
                $average_score          = round( $all_rate_total  /  $all_rate_count );

                $data_selection_update  = array(
                    'score'             => $all_rate_total,
                    'average_score'     => $average_score,
                );
                $this->Model_Incubation->update_data_incubation($data_selection->id, $data_selection_update);

                // Set Data Rate Step 1
                $lss                    = smit_latest_incubation_setting();
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
                        $this->smit_email->send_email_rated_confirmation($data_selection_user->email, $step);
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

            $this->form_validation->set_rules('nilai_selection_id','Nilai Seleksi ID','required');
            $this->form_validation->set_rules('klaster1_a_indikator','Deskripsi Kebutuhan Pengguna','required');
            $this->form_validation->set_rules('klaster1_b_indikator','Deskripsi Sasaran Pengguna    ','required');
            $this->form_validation->set_rules('klaster1_c_indikator','Besar Pasar','required');
            $this->form_validation->set_rules('klaster1_d_indikator','Rencana Pemasaran','required');
            $this->form_validation->set_rules('klaster1_e_indikator','Pertumbuhan Pasar','required');

            $this->form_validation->set_rules('klaster2_a_indikator','Deskripsi Kebutuhan Pengguna','required');
            $this->form_validation->set_rules('klaster2_b_indikator','Deskripsi Sasaran Pengguna    ','required');
            $this->form_validation->set_rules('klaster2_c_indikator','Besar Pasar','required');
            $this->form_validation->set_rules('klaster2_d_indikator','Rencana Pemasaran','required');
            $this->form_validation->set_rules('klaster2_e_indikator','Pertumbuhan Pasar','required');

            $this->form_validation->set_rules('klaster3_a_indikator','Deskripsi Kebutuhan Pengguna','required');
            $this->form_validation->set_rules('klaster3_b_indikator','Deskripsi Sasaran Pengguna    ','required');
            $this->form_validation->set_rules('klaster3_c_indikator','Besar Pasar','required');
            $this->form_validation->set_rules('klaster3_d_indikator','Rencana Pemasaran','required');
            $this->form_validation->set_rules('klaster3_e_indikator','Pertumbuhan Pasar','required');

            $this->form_validation->set_rules('klaster4_a_indikator','Deskripsi Kebutuhan Pengguna','required');
            $this->form_validation->set_rules('klaster4_b_indikator','Deskripsi Sasaran Pengguna    ','required');
            $this->form_validation->set_rules('klaster4_c_indikator','Besar Pasar','required');
            $this->form_validation->set_rules('klaster4_d_indikator','Rencana Pemasaran','required');
            $this->form_validation->set_rules('klaster4_e_indikator','Pertumbuhan Pasar','required');

            $this->form_validation->set_message('required', '%s harus di isi');
            $this->form_validation->set_error_delimiters('', '');

            /*
            if($this->form_validation->run() == FALSE){
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir pengaturan!'),
                );
                // JSON encode data
                die(json_encode($data));
            }else{

            }
            */

            // Check Incubation Selection Data
            $data_selection     = $this->Model_Incubation->get_incubation($selection_id);
            if( !$data_selection || empty($data_selection) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            // Check Incubation Selection User Data
            $data_selection_user = smit_get_userdata_by_id($data_selection->user_id);
            if( !$data_selection_user || empty($data_selection_user) ){
                // Set JSON data
                $data = array('message' => 'error','data' => 'Data user seleksi inkubasi tidak ditemukan atau belum terdaftar');
                // JSON encode data
                die(json_encode($data));
            }

            // Check this Incubation Selection Rate Process
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

            if( $irl1 == 'on')  { $value_irl1 = 1;  $irl_data[] = 1; }
            if( $irl2 == 'on')  { $value_irl2 = 2;  $irl_data[] = 2; }
            if( $irl3 == 'on')  { $value_irl3 = 3;  $irl_data[] = 3; }
            if( $irl4 == 'on')  { $value_irl4 = 4;  $irl_data[] = 4; }
            if( $irl5 == 'on')  { $value_irl5 = 5;  $irl_data[] = 5; }
            if( $irl6 == 'on')  { $value_irl6 = 6;  $irl_data[] = 6; }
            if( $irl7 == 'on')  { $value_irl7 = 7;  $irl_data[] = 7; }
            if( $irl8 == 'on')  { $value_irl8 = 8;  $irl_data[] = 8; }
            if( $irl9 == 'on')  { $value_irl9 = 9;  $irl_data[] = 9; }
            if( $irl10 == 'on') { $value_irl10 = 10; $irl_data[] = 10; }

            $total_irl  = $value_irl1 + $value_irl2 + $value_irl3 + $value_irl4 + $value_irl5 + $value_irl6 + $value_irl7 + $value_irl8 + $value_irl9 + $value_irl10;
            $irl_data   = implode(',',$irl_data);

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
                'irl'           => $irl_data,
                'irl_total'     => $total_irl,
                'comment'       => $rate_comment2,
                'datecreated'   => $curdate,
                'datemodified'  => $curdate
            );

            if( $this->Model_Incubation->save_data_incubation_selection_rate_step2($rate_data_step2) ){
                // History Step1
                $random_history     = smit_generate_rand_string(10,'low');
                $rate_history_step2 = array(
                    'uniquecode'    => $random_history,
                    'year'          => $data_selection->year,
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

                $history            = $this->Model_Incubation->save_data_incubation_history($rate_history_step2);

                // Update Pra-Incubation Score
                $all_rate_total         = $this->Model_Incubation->get_incubation_rate_step2_total($data_selection->id);
                $all_rate_count         = $this->Model_Incubation->get_incubation_rate_step2_count($data_selection->id);
                //$average_score          = round( ( $all_rate_total + $rate_total2 ) /  ( $all_rate_count + 1 ) );
                $average_score          = round( $all_rate_total  /  $all_rate_count );

                $data_selection_update  = array(
                    'scoretwo'          => $all_rate_total,
                    'average_scoretwo'  => $average_score,
                );
                $this->Model_Incubation->update_data_incubation($data_selection->id, $data_selection_update);

                // Set Data Rate Step 1
                $lss                    = smit_latest_incubation_setting();
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

                    if( $update_selection   = $this->Model_Incubation->update_data_incubation($data_selection->id, $status_step2) ){
                        $this->smit_email->send_email_rated_confirmation($data_selection_user->email, $step);
                    }

                    $incubationselection_data = array(
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $data_selection->year,
                        'setting_id'    => $data_selection->setting_id,
                        'selection_id'  => $selection_id,
                        'user_id'       => $data_selection->user_id,
                        'username'      => strtolower($data_selection->username),
                        'name'          => $data_selection->name,
                        'event_title'   => $data_selection->event_title,
                        'event_desc'    => $data_selection->event_desc,
                        'category'      => $data_selection->category,
                        'status'        => ACTIVE,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );

                    if($incubation_save_id      = $this->Model_Incubation->save_data_incubation($incubationselection_data)){
                        $update_data_files      = array(
                            'incubation_id'     => $incubation_save_id,
                        );

                        $this->Model_Incubation->update_data_incubation_files($data_selection->id, $update_data_files);
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

    /**
	 * Admin Dteail Score list Step 1 data function.
	 */
    function admindetailscorestep1( $id='' ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_jury            = as_juri($current_user);
        $condition          = ' WHERE A.selection_id = '. $id .' ';

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

        $incubation_list    = $this->Model_Incubation->get_all_incubation_scorestep1($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                $name               = $row->name;
                $nilai_dokumen      = $row->nilai_dokumen;
                $nilai_target       = $row->nilai_target;
                $nilai_perlindungan = $row->nilai_perlindungan;
                $nilai_penelitan    = $row->nilai_penelitian;
                $nilai_market       = $row->nilai_market;
                $rate_total         = $row->rate_total;
                if($row->jury_id == $current_user->id){
                    $name           = '<strong>'.$name.'</strong>';
                    $nilai_dokumen  = '<strong>'.$nilai_dokumen.'</strong>';
                    $nilai_target   = '<strong>'.$nilai_target.'</strong>';
                    $nilai_perlindungan = '<strong>'.$nilai_perlindungan.'</strong>';
                    $nilai_penelitan    = '<strong>'.$nilai_penelitan.'</strong>';
                    $nilai_market   = '<strong>'.$nilai_market.'</strong>';
                    $rate_total     = '<strong>'.$rate_total.'</strong>';
                }
                $btn_action = '<a class="incdetailcommentstep1 btn btn-xs btn-default waves-effect tooltips" data-placement="left" data-id="'.$row->id.'" data-uniquecode="'.$row->uniquecode.'" data-comment="'.$row->comment.'" title="Komentar"><i class="material-icons">comment</i></a>';

                if($is_admin || $is_jury){
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($row->name),
                        smit_center( $nilai_dokumen ),
                        smit_center( $nilai_target ),
                        smit_center( $nilai_perlindungan ),
                        smit_center( $nilai_penelitan ),
                        smit_center( $nilai_market ),
                        smit_center( $rate_total ),
                        smit_center( $btn_action ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper("juri ".$i),
                        smit_center( $nilai_dokumen ),
                        smit_center( $nilai_target ),
                        smit_center( $nilai_perlindungan ),
                        smit_center( $nilai_penelitan ),
                        smit_center( $nilai_market ),
                        smit_center( $rate_total ),
                        smit_center( $btn_action ),
                    );
                }
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
	 * Admin Dteail Score list Step 2 data function.
	 */
    function admindetailscorestep2( $id='' ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_jury            = as_juri($current_user);
        $condition          = ' WHERE A.selection_id = '. $id .' ';

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

        $incubation_list    = $this->Model_Incubation->get_all_incubation_scorestep2($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($incubation_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($incubation_list as $row){
                $sum_klaster1   = $row->klaster1_a + $row->klaster1_b + $row->klaster1_c + $row->klaster1_d + $row->klaster1_e;
                $sum_klaster2   = $row->klaster2_a + $row->klaster2_b + $row->klaster1_c + $row->klaster2_d + $row->klaster2_e;
                $sum_klaster3   = $row->klaster3_a + $row->klaster3_b + $row->klaster3_c + $row->klaster3_d + $row->klaster3_e;
                $sum_klaster4   = $row->klaster4_a + $row->klaster4_b + $row->klaster4_c + $row->klaster4_d + $row->klaster4_e;

                $total_klaster1 = floor(($sum_klaster1 * (25/100)/5));
                $total_klaster2 = floor(($sum_klaster2 * (40/100)/5));
                $total_klaster3 = floor(($sum_klaster3 * (15/100)/5));
                $total_klaster4 = floor(($sum_klaster4 * (10/100)/5));
                $total_sum      = $total_klaster1 + $total_klaster2 + $total_klaster3 + $total_klaster4;
                $avarage_sum    = floor(($sum_klaster1 + $sum_klaster2 + $sum_klaster3 + $sum_klaster4)/20);

                $btn_action = '<a class="incdetailcommentstep2 btn btn-xs btn-default waves-effect tooltips" data-placement="left" data-id="'.$row->id.'" data-uniquecode="'.$row->uniquecode.'" data-comment="'.$row->comment.'" title="Komentar"><i class="material-icons">comment</i></a>';
                if($is_admin || $is_jury){
                    $name       = $row->name;
                }else{
                    $name       = "juri_".$i;
                }
                $records["aaData"][] = array(
                        smit_center($i),
                        strtoupper($name),
                        smit_center( $row->klaster1_a ),
                        smit_center( $row->klaster1_b ),
                        smit_center( $row->klaster1_c ),
                        smit_center( $row->klaster1_d ),
                        smit_center( $row->klaster1_e ),
                        '<strong>' . smit_center( floor($sum_klaster1 ) ) .'</strong>',
                        smit_center( $row->klaster2_a ),
                        smit_center( $row->klaster2_b ),
                        smit_center( $row->klaster2_c ),
                        smit_center( $row->klaster2_d ),
                        smit_center( $row->klaster2_e ),
                        '<strong>' . smit_center( floor($sum_klaster2 ) ) .'</strong>',
                        smit_center( $row->klaster3_a ),
                        smit_center( $row->klaster3_b ),
                        smit_center( $row->klaster3_c ),
                        smit_center( $row->klaster3_d ),
                        smit_center( $row->klaster3_e ),
                        '<strong>' . smit_center( floor($sum_klaster3 ) ) .'</strong>',
                        smit_center( $row->klaster4_a ),
                        smit_center( $row->klaster4_b ),
                        smit_center( $row->klaster4_c ),
                        smit_center( $row->klaster4_d ),
                        smit_center( $row->klaster4_e ),
                        '<strong>' . smit_center( floor($sum_klaster4) ) .'</strong>',
                        '<strong>' . smit_center( floor($row->rate_total) ) .'</strong>',
                        '<strong>' . smit_center( floor($row->irl_total) ) .'</strong>',
                        smit_center( $btn_action ),
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

    // ---------------------------------------------------------------------------------------------
    /**
	 * History Incubation function.
	 */
	public function incubationhistory()
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
        $data['main_content']   = 'selectionincubation/history';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * History List data function.
	 */
    function historylistdata( $id='' ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $is_jury            = as_juri($current_user);
        $is_pengusul        = as_pengusul($current_user);
        $is_pelaksana       = as_pelaksana($current_user);
        $condition          = '';

        if( !empty($id) ){
            if(!empty($is_jury)){
                $condition          = ' WHERE jury_id = '. $current_user->id .' ';
            }else{
                $condition          = ' WHERE user_id = '. $current_user->id .' ';
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

        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_step             = $this->input->post('search_step');
        $s_step             = smit_isset($s_step, '');
        $s_score            = $this->input->post('search_score');
        $s_score            = smit_isset($s_score, '');
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }
        if( !empty($s_step) )           { $condition .= str_replace('%s%', $s_step, ' AND %step% = %s%'); }
        if( !empty($s_score) )          { $condition .= str_replace('%s%', $s_score, ' AND %score% = %s%'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %dateprocess% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %dateprocess% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
        elseif( $column == 1 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%step% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%score% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $history_list   = $this->Model_Incubation->get_all_incubation_history($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();

        if( !empty($history_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_status     = config_item('incsel_status');

            $i = $offset + 1;
            foreach($history_list as $row){
                $rate           = $row->rate_total;
                $year           = $row->year;
                $name_jury      = strtoupper($row->name_jury);
                $name           = strtoupper($row->name);
                $event          = $row->event_title;
                $step           = $row->step;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $step == 1 || $step == 2 ){
                    if($rate < KKM_STEP1 || $rate < KKM_STEP2){
                        $rate           = '<strong style="color: red !important;">'.$rate.'</strong>';
                        /*
                        $year           = '<strong style="color: red !important;">'.$year.'</strong>';
                        $name_jury      = '<strong style="color: red !important;">'.$name_jury.'</strong>';
                        $name           = '<strong style="color: red !important;">'.$name.'</strong>';
                        $event          = '<strong style="color: red !important;">'.$event.'</strong>';
                        $step           = '<strong style="color: red !important;">'.$step.'</strong>';
                        $datecreated    = '<strong style="color: red !important;">'.$datecreated.'</strong>';
                        */
                    }
                }

                if( !empty($is_admin)){
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->jury_id).'">' . $name_jury . '</a>',
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        $event,
                        smit_center( $step ),
                        smit_center( $rate ),
                        smit_center( $datecreated ),
                        '',
                    );
                }elseif( !empty($is_jury) ){
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year),
                        strtoupper( $name ),
                        $event,
                        smit_center( $step ),
                        smit_center( $rate ),
                        smit_center( $datecreated ),
                        '',
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        strtoupper( $name_jury ),
                        $event,
                        smit_center( $step ),
                        smit_center( $rate ),
                        smit_center( $datecreated ),
                        '',
                    );
                }

                $i++;
            }
        }

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
        	$data_list                      = $this->Model_Incubation->get_all_incubation_history(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportHistory( $data_list );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Riwayat Inkubasi untuk di export';
        	}
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
        	$data_list                      = $this->Model_Incubation->get_all_incubation_history(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportHistory( $data_list, true );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Riwayat Inkubasi untuk di export';
        	}
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Ranking function.
	 */
	public function ranking()
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
            // Range Slider Plugin
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

        $data['title']          = TITLE . 'Penilaian Peringkat';
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
        $data['main_content']   = 'selectionincubation/ranking';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    //----------------------------------------------------------------------------------------------
    // RANGKING
    /**
	 * Admin Ranking list data function.
	 */
    function rankinglistdatastep1( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE step = 1 AND A.status = 3';

        $curdate            = date('Y-m-d H:i:s');
        $curdate            = strtotime($curdate);

        $order_by           = 'A.average_score DESC';
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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year_setting% LIKE "%%s%%"'); }
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year_setting% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $incubation_list    = $this->Model_Incubation->get_all_ranking($limit, $offset, $condition, $order_by);

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
                    $lss                    = smit_latest_incubation_setting();
                    $selection_date_invitation_send   = strtotime($lss->selection_date_invitation_send);
                    $selection_date_interview_start   = strtotime($lss->selection_date_interview_start);
                    if( /* $curdate >= $selection_date_invitation_send && */ $curdate <= $selection_date_interview_start ){
                        $btn_score  = '<a href="'.base_url('seleksiinkubasi/konfirmasistep1/'.$row->uniquecode).'"
                        class="btn_scorestep1 btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }else{
                        $btn_score  = '<a class="btn btn-xs btn-grey waves-effect tooltips" disabled="disabled" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }elseif( $row->status == CONFIRMED || $row->status == REJECTED || $row->status == ACCEPTED ){
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->step.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }

                if($row->status == NOTCONFIRMED)    { $status = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == CONFIRMED)   { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; }
                elseif($row->status == ACCEPTED)    { $status = '<span class="label bg-primary">'.strtoupper($cfg_status[$row->status]).'</span>'; }

                $sum_score      = $row->score;
                $average_score  = $row->average_score;
                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $name           = strtoupper($row->name);
                $year           = $row->year_setting;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));


                if( $average_score < KKM_STEP1 ){
                    $average_score      = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                }

                if($current_user->id == $row->user_id){
                    if( $i == 1 ){
                        $workunit   = '<strong style="color : green !important; ">'.$workunit.'</strong>';
                        $name       = '<strong style="color : green !important; ">'.$name.'</strong>';
                        $year       = '<strong style="color : green !important; ">'.$year.'</strong>';
                        $event      = '<strong style="color : green !important; ">'.$event.'</strong>';
                        $datecreated= '<strong style="color : green !important; ">'.$datecreated.'</strong>';
                        $sum_score  = '<strong style="color : green !important; ">'.floor($sum_score).'</strong>';
                        $average_score  = '<strong style="color : green !important; ">'.floor($average_score).'</strong>';
                    }
                }

                $records["aaData"][] = array(
                        smit_center($i),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        $event,
                        smit_center( $sum_score ),
                        smit_center( $average_score ),
                        smit_center( $datecreated ),
                        //smit_center( $btn_score. ' ' .$btn_details),
                        '',
                    );
                $i++;
            }
        }

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
        	$data_list                      = $this->Model_Incubation->get_all_ranking(0, 0, $condition, $order_by);

        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportRankingStep1( $data_list );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Peringkat Inkubasi untuk di export';
        	}
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
        	$data_list                      = $this->Model_Incubation->get_all_ranking(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportRankingStep1( $data_list, true );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Peringkat Inkubasi untuk di export';
        	}
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Admin Ranking list data function.
	 */
    function rankinglistdatastep2( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $jury_id            = as_juri($current_user);
        $condition          = ' WHERE steptwo = 2 AND A.status = 3';

        $curdate            = date('Y-m-d H:i:s');
        $curdate            = strtotime($curdate);

        $order_by           = 'A.average_scoretwo DESC';
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
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year_setting% LIKE "%%s%%"'); }
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $column == 1 )      { $order_by .= '%year_setting% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $incubation_list    = $this->Model_Incubation->get_all_ranking($limit, $offset, $condition, $order_by);

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
                    $lss                                = smit_latest_incubation_setting();
                    $selection_date_result              = strtotime($lss->selection_date_result);
                    $selection_date_proposal_start      = strtotime($lss->selection_date_proposal_start);
                    if( $curdate >= $selection_date_result && $curdate <= $selection_date_proposal_start ){
                        $btn_score  = '<a href="'.base_url('seleksiinkubasi/konfirmasistep2/'.$row->uniquecode).'"
                        class="btn_scorestep2 btn btn-xs btn-success waves-effect tooltips" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }else{
                        $btn_score  = '<a class="btn btn-xs btn-grey waves-effect tooltips" disabled="disabled" data-placement="top" data-step="1" title="Konfirmasi"><i class="material-icons">done</i></a>';
                    }
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->steptwo.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }elseif( $row->statustwo == CONFIRMED || $row->statustwo == REJECTED || $row->statustwo == ACCEPTED ){
                    $btn_details    = '<a href="'.base_url('seleksiinkubasi/nilai/detail/'.$row->steptwo.'/'.$row->uniquecode).'"
                    class="btn_detail btn btn-xs btn-primary waves-effect tooltips" data-placement="top" data-step="1" title="Detail"><i class="material-icons">zoom_in</i></a>';
                }

                if($row->statustwo == CONFIRMED)       { $status = '<span class="label label-success">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == RATED)       { $status = '<span class="label bg-purple">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == REJECTED)    { $status = '<span class="label label-danger">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }
                elseif($row->statustwo == ACCEPTED)    { $status = '<span class="label label-primary">'.strtoupper($cfg_status[$row->statustwo]).'</span>'; }

                $sum_score      = $row->scoretwo;
                $average_score  = $row->average_scoretwo;
                //Workunit
                $workunit_type  = smit_workunit_type($row->workunit);
                $workunit       = $workunit_type->workunit_name;
                $name           = strtoupper($row->name);
                $year           = $row->year_setting;
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $average_score < KKM_STEP2 ){
                    $average_score      = '<strong style="color : red !important; ">'.floor($average_score).'</strong>';
                }

                if($current_user->id == $row->user_id){
                    if( $i == 1 ){
                        $workunit   = '<strong style="color : green !important; ">'.$workunit.'</strong>';
                        $name       = '<strong style="color : green !important; ">'.$name.'</strong>';
                        $year       = '<strong style="color : green !important; ">'.$year.'</strong>';
                        $event      = '<strong style="color : green !important; ">'.$event.'</strong>';
                        $datecreated= '<strong style="color : green !important; ">'.$datecreated.'</strong>';
                        $sum_score  = '<strong style="color : green !important; ">'.floor($sum_score).'</strong>';
                        $average_score  = '<strong style="color : green !important; ">'.floor($average_score).'</strong>';
                    }
                }

                $records["aaData"][] = array(
                        smit_center($i),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        $event,
                        smit_center( $sum_score ),
                        smit_center( $average_score ),
                        smit_center( $datecreated ),
                        //smit_center( $btn_score. ' ' .$btn_details),
                        '',
                    );
                $i++;
            }
        }

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        if(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_excel"){
        	$data_list                      = $this->Model_Incubation->get_all_ranking(0, 0, $condition, $order_by);

        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportRankingStep2( $data_list );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Peringkat Inkubasi untuk di export';
        	}
        }elseif(isset($_REQUEST["sAction"]) && $_REQUEST["sAction"] == "export_pdf"){
        	$data_list                      = $this->Model_Incubation->get_all_ranking(0, 0, $condition, $order_by);
        	if( !empty($data_list) ){
        		$export                     = $this->smit_excel->exportRankingStep2( $data_list, true );
        		$records["sStatus"]         = "EXPORTED";
        		$records["sMessage"]        = $export;
        	}else{
        		$records["sStatus"]         = "ERROR";
        		$records["sMessage"]        = 'Tidak ada data Peringkat Inkubasi untuk di export';
        	}
        }

        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;

        echo json_encode($records);
    }

    /**
	 * Incubation list data function.
	 */
    function incubationdata( ){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = '';
        if( !$is_admin ){
            $condition      = ' WHERE user_id = '.$current_user->id.'';
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
        $s_workunit         = $this->input->post('search_workunit');
        $s_workunit         = smit_isset($s_workunit, '');
        $s_title            = $this->input->post('search_title');
        $s_title            = smit_isset($s_title, '');
        $s_year             = $this->input->post('search_year');
        $s_year             = smit_isset($s_year, '');

        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');

        if( !empty($s_year) )           { $condition .= str_replace('%s%', $s_year, ' AND %year% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_workunit) )       { $condition .= str_replace('%s%', $s_workunit, ' AND %workunit% = "%s%"'); }
        if( !empty($s_title) )          { $condition .= str_replace('%s%', $s_title, ' AND %event_title% LIKE "%%s%%"'); }

        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }

        if( $is_admin ){
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }
        }else{
            if( $column == 1 )      { $order_by .= '%year% ' . $sort; }
            elseif( $column == 2 )  { $order_by .= '%workunit% ' . $sort; }
            elseif( $column == 3 )  { $order_by .= '%event_title% ' . $sort; }
            elseif( $column == 4 )  { $order_by .= '%datecreated% ' . $sort; }
        }

        $incubation_list    = $this->Model_Incubation->get_all_incubationdata($limit, $offset, $condition, $order_by);

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

                $workunit   = '<center> - </cemter>';
                if($row->workunit > 0){
                    $workunit_type  = smit_workunit_type($row->workunit);
                    $workunit       = $workunit_type->workunit_name;
                }
                $year           = $row->year;
                $name           = strtoupper($row->user_name);
                $event          = $row->event_title;
                $datecreated    = date('d F Y', strtotime($row->datecreated));

                if( $is_admin ){
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        '<a href="'.base_url('pengguna/profil/'.$row->user_id).'">' . $name . '</a>',
                        strtoupper( $workunit ),
                        strtoupper( $event ),
                        //smit_center( $datecreated ),
                        smit_center( $btn_action ),
                    );
                }else{
                    $records["aaData"][] = array(
                        smit_center( $i ),
                        smit_center( $year ),
                        strtoupper( $workunit ),
                        strtoupper( $event ),
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
	 * Incubation Detail list data function.
	 */
    public function incubationdatadetails($uniquecode)
	{
        auth_redirect();

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $is_pengusul            = as_pengusul($current_user);

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
        $incubation_list     = '';
        if(!empty($uniquecode)){
            $incubation_list        = $this->Model_Incubation->get_all_incubationdata('', '', ' WHERE A.uniquecode = "'.$uniquecode.'"', '');
            $incubation_list        = $incubation_list[0];
            $user_id                = $incubation_list->user_id;
            $incubation_files       = $this->Model_Incubation->get_all_incubation_files('', '', ' WHERE user_id = '.$user_id.'', '');
        }

        $data['title']          = TITLE . 'Detail Seleksi Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['is_pengusul']    = $is_pengusul;
        $data['incubation']     = $incubation_list;
        $data['incubation_files']    = $incubation_files;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation/listincubationdetails';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * List Incubation function.
	 */
	public function listincubation()
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

        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
            'PraIncubationList.init();',
            'UploadFiles.init();',
            'IncubationValidation.init();',
        ));

        $scripts_add            = '';

        $data['title']          = TITLE . 'Daftar Inkubasi';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'incubation/listincubation';

        $this->load->view(VIEW_BACK . 'template', $data);
	}

    /**
	 * Incubation Add Function
	 */
	public function incubationadd()
	{
        auth_redirect();
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);

        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        $upload_data            = array();

        $year                   = $this->input->post('reg_year');
        $year                   = trim( smit_isset($year, "") );
        $user_id                = $this->input->post('reg_user_id');
        $user_id                = trim( smit_isset($user_id, "") );
        $name                   = $this->input->post('reg_name');
        $name                   = trim( smit_isset($name, "") );
        $category               = $this->input->post('reg_category');
        $category               = trim( smit_isset($category, "") );
        $event_title            = $this->input->post('reg_title');
        $event_title            = trim( smit_isset($event_title, "") );
        $description            = $this->input->post('reg_desc');
        $description            = trim( smit_isset($description, "") );

        $userdata               = smit_get_userdata_by_id($user_id);

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('reg_year','Tahun Kegiatan','required');
        $this->form_validation->set_rules('reg_user_id','Nama Pengguna','required');
        $this->form_validation->set_rules('reg_name','Nama Peneliti Utama','required');
        $this->form_validation->set_rules('reg_category','Kategori Bidang','required');
        $this->form_validation->set_rules('reg_title','Judul Kegiatan','required');
        $this->form_validation->set_rules('reg_desc','Deskripsi Kegiatan','required');

        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran Kegiatan Inkubasi baru tidak berhasil. '.validation_errors().'');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Check File
        // -------------------------------------------------
        /*
        if( empty($_FILES['reg_selection_files']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas yang di unggah. Silahkan inputkan berkas kegiatan!');
            die(json_encode($data));
        }

        if( empty($_FILES['reg_selection_rab']['name']) ){
            // Set JSON data
            $data = array('message' => 'error','data' => 'Tidak ada berkas yang di unggah. Silahkan inputkan berkas kegiatan!');
            die(json_encode($data));
        }
        */

        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();

        if( !empty($category) ){
            $data_category      = $this->Model_Option->get_all_category(0, 0, ' WHERE %category_id% = '.$category.'');
            $data_category      = $data_category[0];
        }

        $incubationselection_data = array(
            'uniquecode'    => smit_generate_rand_string(10,'low'),
            'year'          => $year,
            'user_id'       => $userdata->id,
            'username'      => strtolower($userdata->username),
            'name'          => $name,
            'event_title'   => $event_title,
            'event_desc'    => $description,
            'category'      => strtolower($data_category->category_name),
            'status'        => ACTIVE,
            'datecreated'   => $curdate,
            'datemodified'  => $curdate,
        );

        // -------------------------------------------------
        // Save Incubation Selection
        // -------------------------------------------------
        $trans_save_incubation          = FALSE;
        if( $incubation_save_id         = $this->Model_Incubation->save_data_incubation($incubationselection_data) ){
            $trans_save_incubation      = TRUE;

            // Check if Upload Selection Files
            // -------------------------------
            if( !empty($_FILES['reg_selection_files']['name']) ){
                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationselection/' . $userdata->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types'     => "doc|docx|pdf|xls|xlsx",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );
                $this->load->library('MY_Upload', $config);

                if( ! $this->my_upload->do_upload('reg_selection_files') ){
                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }

                if( $upload_data = $this->my_upload->data() ){
                    // Set File Upload Save
                    $file = $upload_data;
                    $incubationselectionfiles_data = array(
                        'incubation_id' => $incubation_save_id,
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'user_id'       => $userdata->id,
                        'username'      => strtolower($userdata->username),
                        'name'          => $name,
                        'url'           => smit_isset($file['full_path'],''),
                        'extension'     => substr(smit_isset($file['file_ext'],''),1),
                        'filename'      => smit_isset($file['raw_name'],''),
                        'size'          => smit_isset($file['file_size'],0),
                        'status'        => ACTIVE,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    if( !$this->Model_Incubation->save_data_incubation_selection_files($incubationselectionfiles_data) ){
                        // Set JSON data
                        $data = array('message' => 'error','data' => 'Simpan file seleksi tidak berhasil. Terjadi kesalahan proses!');
                        die(json_encode($data));
                    }
                }else{
                    $incubationselectionfiles_data = array(
                        'incubation_id' => $incubation_save_id,
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'user_id'       => $userdata->id,
                        'username'      => strtolower($userdata->username),
                        'name'          => $name,
                        'status'        => ACTIVE,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    if( !$this->Model_Incubation->save_data_incubation_selection_files($incubationselectionfiles_data) ){
                        // Set JSON data
                        $data = array('message' => 'error','data' => 'Simpan file seleksi tidak berhasil. Terjadi kesalahan proses!');
                        die(json_encode($data));
                    }
                }
            }

            // Check if Upload RAB Files
            // -------------------------
            if( !empty($_FILES['reg_selection_rab']['name']) ){
                // Upload Files Process
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/upload/incubationselection/' . $userdata->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }

                $config = array(
                    'upload_path'       => $upload_path,
                    'allowed_types'     => "doc|docx|pdf|xls|xlsx",
                    'overwrite'         => FALSE,
                    'max_size'          => "2048000",
                );
                $this->load->library('MY_Upload', $config);


                if( ! $this->my_upload->do_upload('reg_selection_rab') ){
                    // Set JSON data
                    $data = array('message' => 'error','data' => $this->my_upload->display_errors());
                    die(json_encode($data));
                }

                if( $upload_data_rab = $this->my_upload->data() ){
                    // Set File Upload Save
                    $file_rab = $upload_data_rab;
                    $incubationselectionfilesrab_data = array(
                        'incubation_id' => $incubation_save_id,
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'user_id'       => $userdata->id,
                        'username'      => strtolower($userdata->username),
                        'name'          => $name,
                        'url'           => smit_isset($file_rab['full_path'],''),
                        'extension'     => substr(smit_isset($file_rab['file_ext'],''),1),
                        'filename'      => smit_isset($file_rab['raw_name'],''),
                        'size'          => smit_isset($file_rab['file_size'],0),
                        'status'        => ACTIVE,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    if( !$this->Model_Incubation->save_data_incubation_selection_files($incubationselectionfilesrab_data) ){
                        // Set JSON data
                        $data = array('message' => 'error','data' => 'Simpan file RAB tidak berhasil. Terjadi kesalahan proses!');
                        die(json_encode($data));
                    }
                }else{
                    $incubationselectionfilesrab_data = array(
                        'incubation_id' => $incubation_save_id,
                        'uniquecode'    => smit_generate_rand_string(10,'low'),
                        'year'          => $year,
                        'user_id'       => $userdata->id,
                        'username'      => strtolower($userdata->username),
                        'name'          => $name,
                        'status'        => ACTIVE,
                        'datecreated'   => $curdate,
                        'datemodified'  => $curdate,
                    );
                    if( !$this->Model_Incubation->save_data_incubation_selection_files($incubationselectionfilesrab_data) ){
                        // Set JSON data
                        $data = array('message' => 'error','data' => 'Simpan file RAB tidak berhasil. Terjadi kesalahan proses!');
                        die(json_encode($data));
                    }
                }
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran inkubasi tidak berhasil. Terjadi kesalahan data formulir anda');
            die(json_encode($data));
        }

        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_incubation ){
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
                $data       = array('message' => 'success', 'data' => 'Pendaftaran inkubasi tenant baru berhasil!');
                die(json_encode($data));
                // Set Log Data
                smit_log( 'INCUBATION_REG', 'SUCCESS', maybe_serialize(array('username'=>$userdata->username, 'upload_files'=> $upload_data)) );
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array('message' => 'error','data' => 'Pendaftaran tidak berhasil. Terjadi kesalahan data.');
            die(json_encode($data));
        }
	}

    // ---------------------------------------------------------------------------------------------


}

/* End of file Incubation.php */
/* Location: ./application/controllers/incubation.php */
