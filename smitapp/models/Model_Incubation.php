<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Incubation extends SMIT_Model{
    /**
     * Initialize table
     */
    var $user                           = "smit_user";
    var $incubation                     = "smit_incubation";
    var $incubation_selection           = "smit_incubation_selection";
    var $incubation_selection_set       = "smit_incubation_selection_setting";
    var $incubation_selection_rpt       = "smit_incubation_selection_report";
    var $incubation_selection_files     = "smit_incubation_selection_files";
    var $incubation_selection_his       = "smit_incubation_selection_history";
    var $incubation_selection_rate_s1   = "smit_incubation_selection_rate_step1";
    var $incubation_selection_rate_s2   = "smit_incubation_selection_rate_step2";
    var $incubation_payment             = "smit_incubation_payment";
    var $incubation_notes               = "smit_incubation_notes";
    var $incubation_tenant              = "smit_incubation_tenant";
    var $incubation_report              = "smit_incubation_report";

    /**
     * Initialize primary field
     */
    var $primary                    = "id";

    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------------------------------------------------------
    // CRUD (Manipulation) data incubation
    // ---------------------------------------------------------------------------------

    /**
     * Get Incubation
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Incubation
     * @return  Mixed   False on invalid date parameter, otherwise data of incubation(s).
     */
    function get_incubation($id=''){
        if ( !empty($id) ) {
            $id = absint($id);
            $this->db->where('id', $id);
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->incubation_selection);
        return ( !empty($id) ? $query->row() : $query->result() );
    }

    /**
     * Get Incubation Setting
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Incubation
     * @return  Mixed   False on invalid date parameter, otherwise data of incubation(s) setting.
     */
    function get_incubation_setting($id=''){
        if ( !empty($id) ) {
            $id = absint($id);
            $this->db->where($primary, $id);
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->incubation_selection_set);
        return ( !empty($id) ? $query->row() : $query->result() );
    }

    /**
     * Get Incubation Report
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Incubation Report
     * @return  Mixed   False on invalid date parameter, otherwise data of incubation(s) report.
     */
    function get_incubation_report($id=''){
        if ( !empty($id) ) {
            $id = absint($id);
            $this->db->where($primary, $id);
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->incubation_selection_rpt);
        return ( !empty($id) ? $query->row() : $query->result() );
    }

    /**
     * Get incubation data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of incubation
     */
    function get_incubation_by($field, $value='')
    {
        $id = '';

        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'userid':
                $value  = $value;
                $id     = '';
                $field  = 'user_id';
                break;
            case 'username':
                $value  = $value;
                $id     = '';
                $field  = 'username';
                break;
            default:
                return false;
        }

        if ( $id != '' && $id > 0 )
            return $this->get_incubation($id);

        if( empty($field) ) return false;

        $db     = $this->db;

        $db->where($field, $value);
        $query  = $db->get($this->incubation_selection);

        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $incubation = $row;
        }

        return $incubation;
    }

    /**
     * Get incubation data by uniquecode
     *
     * @author  Iqbal
     * @param   Int  $uniquecode  (Required)  Incubation Uniquecode
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of incubation
     */
    function get_incubation_by_uniquecode($uniquecode)
    {
        if( empty($uniquecode) || !$uniquecode ) return false;

        $sql = '
            SELECT A.*, B.name AS user_name, B.email, B.phone
            FROM '.$this->incubation_selection.' AS A
            INNER JOIN '.$this->user.' AS B
            ON B.id = A.user_id
            WHERE A.uniquecode = ?';
        $qry = $this->db->query($sql, array($uniquecode));

        if( !$qry || $qry->num_rows == 0 ) return false;
        return $qry->row();
    }

    /**
     * Get incubation setting data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of incubation setting
     */
    function get_incubation_setting_by($field, $value='')
    {
        $id = '';

        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'uniquecode':
                $value  = $value;
                $id     = '';
                $field  = 'uniquecode';
                break;
            default:
                return false;
        }

        if ( $id != '' && $id > 0 )
            return $this->get_incubation_setting($id);

        if( empty($field) ) return false;

        $db     = $this->db;

        $db->where($field, $value);
        $query  = $db->get($this->incubation_selection_set);

        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $incubationset = $row;
        }

        return $incubationset;
    }

    /**
     * Get incubation report data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of incubation report
     */
    function get_incubation_report_by($field, $value='')
    {
        $id = '';

        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'uniquecode':
                $value  = $value;
                $id     = '';
                $field  = 'uniquecode';
                break;
            case 'user_id':
                $value  = $value;
                $id     = '';
                $field  = 'user_id';
                break;
            case 'selection_id':
                $value  = $value;
                $id     = '';
                $field  = 'selection_id';
                break;
            default:
                return false;
        }

        if ( $id != '' && $id > 0 )
            return $this->get_incubation_report($id);

        if( empty($field) ) return false;

        $db     = $this->db;

        $db->where($field, $value);
        $query  = $db->get($this->incubation_selection_rpt);

        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $incubationrpt = $row;
        }

        return $incubationrpt;
    }

    /**
     * Get incubation report data by uniquecode
     *
     * @author  Iqbal
     * @param   Int  $uniquecode  (Required)  Incubation Report Uniquecode
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of incubation report
     */
    function get_incubation_report_by_uniquecode($uniquecode)
    {
        if( empty($uniquecode) || !$uniquecode ) return false;

        $sql = '
            SELECT A.*, B.name AS user_name, B.email, B.phone
            FROM '.$this->incubation_selection_rpt.' AS A
            INNER JOIN '.$this->user.' AS B
            ON B.id = A.user_id
            WHERE A.uniquecode = ?';
        $qry = $this->db->query($sql, array($uniquecode));

        if( !$qry || $qry->num_rows == 0 ) return false;
        return $qry->row();
    }

    /**
     * Count All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_score($id=0){
        if ( $id != 0 )   { $this->db->where('selection_id', $id); }

        $query = $this->db->get($this->incubation_selection_rate_s1);

        return $query->num_rows();
    }

    /**
     * Count All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_score2($id=0){
        if ( $id != 0 )   { $this->db->where('selection_id', $id); }

        $query = $this->db->get($this->incubation_selection_rate_s2);

        return $query->num_rows();
    }

    /**
     * Sum All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $id   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function sum_all_score($id){
        //if ( $id != 0 )   { $this->db->where('selection_id', $id); }
        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->incubation_selection_rate_s1.' WHERE selection_id = '.$id.' ';

        $query  = $this->db->query($sql);
        $row    = $query->row();

        if ( empty($row->total) ) return 0;

        return $row->total;
    }

    /**
     * Sum All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $id   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function sum_all_irl($id){
        //if ( $id != 0 )   { $this->db->where('selection_id', $id); }
        $sql    = 'SELECT SUM(irl_total) AS total FROM '.$this->incubation_selection_rate_s2.' WHERE selection_id = '.$id.' ';

        $query  = $this->db->query($sql);
        $row    = $query->row();

        if ( empty($row->total) ) return 0;

        return $row->total;
    }

    /**
     * Sum All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $id   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function sum_all_score2($id){
        //if ( $id != 0 )   { $this->db->where('selection_id', $id); }
        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->incubation_selection_rate_s2.' WHERE selection_id = '.$id.' ';

        $query  = $this->db->query($sql);
        $row    = $query->row();

        if ( empty($row->total) ) return 0;

        return $row->total;
    }

    /**
     * Get Pra Incubation Rate Step 2 Score
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 2 Score
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 2 score.
     */
    function get_incubation_rate_step2_total($id){
        if ( !$id ) return 0;

        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->incubation_selection_rate_s2.' WHERE selection_id='.$id.'';
        $qry    = $this->db->query($sql);

        if ( !$qry ) return 0;

        $row    = $qry->row();
        return $row->total;
    }

    /**
     * Get Pra Incubation Rate Step 2 Count
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 2 Count
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 2 count.
     */
    function get_incubation_rate_step2_count($id){
        if ( !$id ) return 0;

        $sql    = 'SELECT COUNT(id) AS total FROM '.$this->incubation_selection_rate_s2.' WHERE selection_id='.$id.'';
        $qry    = $this->db->query($sql);

        if ( !$qry ) return 0;

        $row    = $qry->row();
        return $row->total;
    }


    /**
     * Save data of incubation_selection
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_selection($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_selection, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Save data of praincubation_selection_files
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of pra incubation files
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_selection_files($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_selection_files, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Update data of incubation
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_incubation_files($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in('selection_id', $id);
		else $this->db->where('selection_id', $id);

        if( $this->db->update($this->incubation_selection_files, $data) )
            return true;

        return false;
    }

    /**
     * Save data of incubation_selection_setting
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_selection_setting($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_selection_set, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Save data of incubation_selection_report
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of incubation report
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_selection_report($data){
        if( empty($data) ) return false;

		// We have UNIQUE index on this table so we can't use Active Record to do insert
		$sql = 'INSERT IGNORE INTO '.$this->incubation_selection_rpt.'(`' . implode('`,`', array_keys($data)) . '`)
	            VALUES(' . rtrim(str_repeat('?,', count($data)), ',') . ')';

		$data_values 	= array_values($data);
        $this->db->query($sql, $data_values);

		if ($this->db->affected_rows()) {
			$id = $this->db->insert_id();
            return $id;
		}
        return false;
    }

    /**
     * Save data of incubation
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Retrieve all pra incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_incubation($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "A.year", $conditions);
            $conditions = str_replace("%workunit%",             "B.workunit", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "B.name", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%statustwo%",            "A.statustwo", $conditions);
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%step%",                 "A.step", $conditions);
            $conditions = str_replace("%steptwo%",              "A.steptwo",  $conditions);
            $conditions = str_replace("%view%",                 "A.view",  $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%year_setting%",         "D.selection_year_publication", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "A.year",  $order_by);
            $order_by   = str_replace("%workunit%",             "B.workunit",  $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "B.name",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%statustwo%",            "A.statustwo",  $order_by);
            $order_by   = str_replace("%url%",                  "B.url",  $order_by);
            $order_by   = str_replace("%extension%",            "B.extension",  $order_by);
            $order_by   = str_replace("%step%",                 "A.step",  $order_by);
            $order_by   = str_replace("%steptwo%",              "A.steptwo",  $order_by);
            $order_by   = str_replace("%view%",                 "A.view",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%year_setting%",         "D.selection_year_publication",  $order_by);
        }

        $sql = '
            SELECT A.*,B.workunit, B.name AS user_name, B.email, D.selection_year_publication AS year_setting
            FROM ' . $this->incubation_selection. ' AS A
            LEFT JOIN ' . $this->user . ' AS B
            ON B.id = A.user_id
            LEFT JOIN ' . $this->user . ' AS C
            ON C.id = A.companion_id
            LEFT JOIN ' . $this->incubation_selection_set . ' AS D
            ON D.id = A.setting_id ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_incubation_files($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%selection_id%",         "selection_id", $conditions);
            $conditions = str_replace("%username%",             "username", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%description%",          "description", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%url%",                  "url", $conditions);
            $conditions = str_replace("%extension%",            "extension", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%username%",             "username",  $order_by);
            $order_by   = str_replace("%selection_id%",         "selection_id",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%description%",          "description",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%url%",                  "url",  $order_by);
            $order_by   = str_replace("%extension%",            "extension",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->incubation_selection_files. ' ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all pra incubation setting data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incset             default 0
     * @param   Int     $offset             Offset ot incset            default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of pra incubation setting list
     */
    function get_all_incubation_setting($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",               "id", $conditions);
            $conditions = str_replace("%date_publication%", "selection_date_publication", $conditions);
            $conditions = str_replace("%date_reg_start%",   "selection_date_reg_start", $conditions);
            $conditions = str_replace("%date_reg_end%",     "selection_date_reg_end", $conditions);
            $conditions = str_replace("%impdate_start%",    "selection_imp_date_start", $conditions);
            $conditions = str_replace("%impdate_end%",      "selection_imp_date_end", $conditions);
            $conditions = str_replace("%files%",            "selection_files", $conditions);
            $conditions = str_replace("%juri_phase1%",      "selection_juri_phase1", $conditions);
            $conditions = str_replace("%juri_phase2%",      "selection_juri_phase2", $conditions);
            $conditions = str_replace("%status%",           "status", $conditions);
            $conditions = str_replace("%datecreated%",      "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by = str_replace("%id%",                 "id", $order_by);
            $order_by = str_replace("%date_publication%",   "selection_date_publication", $order_by);
            $order_by = str_replace("%date_reg_start%",     "selection_date_reg_start", $order_by);
            $order_by = str_replace("%date_reg_end%",       "selection_date_reg_end", $order_by);
            $order_by = str_replace("%impdate_start%",      "selection_imp_date_start", $order_by);
            $order_by = str_replace("%impdate_end%",        "selection_imp_date_end", $order_by);
            $order_by = str_replace("%files%",              "selection_files", $order_by);
            $order_by = str_replace("%juri_phase1%",        "selection_juri_phase1", $order_by);
            $order_by = str_replace("%juri_phase2%",        "selection_juri_phase2", $order_by);
            $order_by = str_replace("%status%",             "status", $order_by);
            $order_by = str_replace("%datecreated%",        "datecreated", $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->incubation_selection_set. '';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all incubation report data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incrpt             default 0
     * @param   Int     $offset             Offset ot incrpt            default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation report list
     */
    function get_all_incubation_report($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%confirmed%",            "A.confirmed", $conditions);
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%jury%",                 "A.jury_id", $conditions);
            $conditions = str_replace("%jury_username%",        "B.username",  $conditions);
            $conditions = str_replace("%jury_name%",            "B.name",  $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%confirmed%",            "A.confirmed",  $order_by);
            $order_by   = str_replace("%url%",                  "A.url",  $order_by);
            $order_by   = str_replace("%extension%",            "A.extension",  $order_by);
            $order_by   = str_replace("%jury%",                 "A.jury_id",  $order_by);
            $order_by   = str_replace("%jury_username%",        "B.username",  $order_by);
            $order_by   = str_replace("%jury_name%",            "B.name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }

        $sql = '
            SELECT
                A.*,
                B.username AS jury_username,
                B.name as jury_name
            FROM ' . $this->incubation_selection_rpt. ' AS A
            LEFT JOIN ' . $this->user . ' AS B
            ON B.id = A.jury_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Save data of incubation_selection_rate_step1
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of praincubation rate step 1
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_selection_rate_step1($data){
        if( empty($data) ) return false;

		// We have UNIQUE index on this table so we can't use Active Record to do insert
		$sql = 'INSERT IGNORE INTO '.$this->incubation_selection_rate_s1.'(`' . implode('`,`', array_keys($data)) . '`)
	            VALUES(' . rtrim(str_repeat('?,', count($data)), ',') . ')';

		$data_values 	= array_values($data);
        $this->db->query($sql, $data_values);

		if ($this->db->affected_rows()) {
			$id = $this->db->insert_id();
            return $id;
		}
        return false;
    }

    /**
     * Save data of praincubation_selection_rate_step2
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of praincubation rate step 1
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_selection_rate_step2($data){
        if( empty($data) ) return false;

		// We have UNIQUE index on this table so we can't use Active Record to do insert
		$sql = 'INSERT IGNORE INTO '.$this->incubation_selection_rate_s2.'(`' . implode('`,`', array_keys($data)) . '`)
	            VALUES(' . rtrim(str_repeat('?,', count($data)), ',') . ')';

		$data_values 	= array_values($data);
        $this->db->query($sql, $data_values);

		if ($this->db->affected_rows()) {
			$id = $this->db->insert_id();
            return $id;
		}
        return false;
    }

    /**
     * Save data of praincubation_selection
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_incubation_history($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_selection_his, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Update data of incubation
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_incubation($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);

        if( $this->db->update($this->incubation_selection, $data) )
            return true;

        return false;
    }

    /**
     * Update data of incubationdata
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_incubationdata($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);

        if( $this->db->update($this->incubation, $data) )
            return true;

        return false;
    }

    /**
     * Get Pra Incubation Rate Step 1 Score
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1 Score
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1 score.
     */
    function get_incubation_rate_step1_total($id){
        if ( !$id ) return 0;

        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->incubation_selection_rate_s1.' WHERE selection_id='.$id.'';
        $qry    = $this->db->query($sql);

        if ( !$qry ) return 0;

        $row    = $qry->row();
        return $row->total;
    }

    /**
     * Get Pra Incubation Rate Step 1 Count
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1 Count
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1 count.
     */
    function get_incubation_rate_step1_count($id){
        if ( !$id ) return 0;

        $sql    = 'SELECT COUNT(id) AS total FROM '.$this->incubation_selection_rate_s1.' WHERE selection_id='.$id.'';
        $qry    = $this->db->query($sql);

        if ( !$qry ) return 0;

        $row    = $qry->row();
        return $row->total;
    }

    /**
     * Get Pra Incubation Rate Step 1
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1.
     */
    function get_incubation_rate_step1_files($jury_id='', $selection_id=''){
        if ( !empty($jury_id) || !empty($selection_id) ) {
            $jury_id = absint($jury_id);
            $this->db->where('jury_id', $jury_id);

            $selection_id = absint($selection_id);
            $this->db->where('selection_id', $selection_id);
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->incubation_selection_rate_s1);
        return ( !empty($jury_id) ? $query->row() : $query->result() );
    }

    /**
     * Get Pra Incubation Rate Step 1
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1.
     */
    function get_incubation_rate_step2_files($jury_id='', $selection_id=''){
        if ( !empty($jury_id) || !empty($selection_id) ) {
            $jury_id = absint($jury_id);
            $this->db->where('jury_id', $jury_id);

            $selection_id = absint($selection_id);
            $this->db->where('selection_id', $selection_id);
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->incubation_selection_rate_s2);
        return ( !empty($id) ? $query->row() : $query->result() );
    }

    /**
     * Update data of incubation setting
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation Setting ID
     * @param   Array   $data   (Required)  Array data of incubation setting
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_incubation_setting($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);

        if( $this->db->update($this->incubation_selection_set, $data) )
            return true;

        return false;
    }

    /**
     * Update data of incubation report
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation Report ID
     * @param   Array   $data   (Required)  Array data of incubation report
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_incubation_report($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);

        if( $this->db->update($this->incubation_selection_rpt, $data) )
            return true;

        return false;
    }

    // ---------------------------------------------------------------------------------
    // COUNT SCORE
    /**
     * Count All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_scoreconfirm_step1($status = 0, $statustwo = 0){
        $this->db->where('status', $status);
        $this->db->where('view', 1);
        if ( $statustwo != 0 )  { $this->db->where('statustwo', $statustwo); }

        $query = $this->db->get($this->incubation_selection);

        return $query->num_rows();
    }

    /**
     * Count All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_scoreconfirm_step2($statustwo = 0){
        $this->db->where('view', 1);
        if ( $statustwo != 0 )  { $this->db->where('statustwo', $statustwo); }

        $query = $this->db->get($this->incubation_selection);

        return $query->num_rows();
    }

    /**
     * Count All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_list($status ){
        if ( $status == NOTCONFIRMED )  { $this->db->where('status', $status); }
        $query = $this->db->get($this->incubation_selection);

        return $query->num_rows();
    }
    
    /**
     * Count All Score Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_selection($setting_id = 0){
        if ( $setting_id != 0 )  { $this->db->where('setting_id', $setting_id); }

        $query = $this->db->get($this->incubation_selection);

        return $query->num_rows();
    }

    /**
     * Retrieve all pra incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_incubation_scorestep1($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%step%",                 "A.step", $conditions);
            $conditions = str_replace("%dateprocess%",          "B.datemodified", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%url%",                  "B.url",  $order_by);
            $order_by   = str_replace("%extension%",            "B.extension",  $order_by);
            $order_by   = str_replace("%step%",                 "A.step",  $order_by);
            $order_by   = str_replace("%dateprocess%",          "B.datemodified",  $order_by);
        }

        $sql = '
            SELECT A.*,B.name
            FROM ' . $this->incubation_selection_rate_s1. ' AS A
            LEFT JOIN ' . $this->user . ' AS B
            ON B.id = A.jury_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all pra incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_incubation_history($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "year", $conditions);
            $conditions = str_replace("%event_title%",          "event_title", $conditions);
            $conditions = str_replace("%username%",             "username", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%jury_id%",              "jury_id", $conditions);
            $conditions = str_replace("%user_id%",              "user_id", $conditions);
            $conditions = str_replace("%score%",                "score", $conditions);
            $conditions = str_replace("%step%",                 "step", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%year%",                 "year",  $order_by);
            $order_by   = str_replace("%event_title%",          "event_title",  $order_by);
            $order_by   = str_replace("%username%",             "username",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%jury_id%",              "jury_id",  $order_by);
            $order_by   = str_replace("%user_id%",              "user_id",  $order_by);
            $order_by   = str_replace("%score%",                "score",  $order_by);
            $order_by   = str_replace("%step%",                 "step",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = ' SELECT * FROM ' . $this->incubation_selection_his. ' ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all pra incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_incubation_scorestep2($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%step%",                 "A.step", $conditions);
            $conditions = str_replace("%dateprocess%",          "B.datemodified", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%url%",                  "B.url",  $order_by);
            $order_by   = str_replace("%extension%",            "B.extension",  $order_by);
            $order_by   = str_replace("%step%",                 "A.step",  $order_by);
            $order_by   = str_replace("%dateprocess%",          "B.datemodified",  $order_by);
        }

        $sql = '
            SELECT A.*,B.name
            FROM ' . $this->incubation_selection_rate_s2. ' AS A
            LEFT JOIN ' . $this->user . ' AS B
            ON B.id = A.jury_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all pra incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_ranking($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "A.year", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%companion_id%",         "A.companion_id", $conditions);
            $conditions = str_replace("%companion_name%",       "C.companion_name", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%statustwo%",            "A.statustwo", $conditions);
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%step%",                 "A.step", $conditions);
            $conditions = str_replace("%steptwo%",              "A.steptwo",  $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%year_setting%",         "C.selection_year_publication", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "A.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%companion_name%",       "C.companion_name",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%statustwo%",            "A.statustwo",  $order_by);
            $order_by   = str_replace("%url%",                  "B.url",  $order_by);
            $order_by   = str_replace("%extension%",            "B.extension",  $order_by);
            $order_by   = str_replace("%step%",                 "A.step",  $order_by);
            $order_by   = str_replace("%steptwo%",              "A.steptwo",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%year_setting%",         "C.selection_year_publication",  $order_by);
        }

        $sql = '
            SELECT A.*,B.workunit, B.name AS user_name, B.email, C.selection_year_publication AS year_setting
            FROM ' . $this->incubation_selection. ' AS A
            LEFT JOIN ' . $this->user . ' AS B
            ON B.id = A.user_id
            LEFT JOIN ' . $this->incubation_selection_set . ' AS C
            ON C.id = A.setting_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all incubation data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_incubationdata($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "A.year", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%tenant_id%",            "A.tenant_id", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "A.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%tenant_id%",            "A.tenant_id",  $order_by);
        }

        $sql = '
            SELECT A.*, B.workunit, B.name AS user_name, B.email
            FROM ' . $this->incubation. ' AS A
            LEFT JOIN ' . $this->user . ' AS B
            ON B.id = A.user_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }


    /**
     * Save data of payment incubation tenant
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of news
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_payment($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_payment, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Retrieve all payment data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_payment($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%invoice%",              "invoice", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%desc%",                 "desc", $conditions);
            $conditions = str_replace("%url%",                  "url", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%extension%",            "extension", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%invoice%",              "invoice",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%desc%",                 "desc",  $order_by);
            $order_by   = str_replace("%url%",                  "url",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%extension%",            "extension",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->incubation_payment. '';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }
    // ---------------------------------------------------------------------------------

    // ---------------------------------------------------------------------------------
    // SAVE ADD NOTES incubation
    /**
     * Save data of notes incubation
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of product incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_notes($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_notes, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Get Notes by Uniquecode
     *
     * @author  Iqbal
     * @param   Int     $uniquecode     (Required)  ID of slider
     * @return  Mixed   False on invalid date parameter, otherwise data of slider(s).
     */
    function get_notes_by_uniquecode($uniquecode=''){
        if ( !empty($uniquecode) ) {
            $this->db->where('uniquecode', $uniquecode);
        };

        $this->db->order_by("datecreated", "DESC");
        $query      = $this->db->get($this->incubation_notes);
        return ( !empty($uniquecode) ? $query->row() : $query->result() );
    }
    
    /**
     * Retrieve all notes data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_notes($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%title%",                "A.title", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%name_tenant%",          "B.name_tenant", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id",  $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%title%",                "A.title",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%name_tenant%",          "B.name_tenant",  $order_by);
        }

        $sql = '
            SELECT A.*,B.name_tenant, B.uniquecode AS uniquecode_incubation
            FROM ' . $this->incubation_notes . ' AS A
            LEFT JOIN ' . $this->incubation_tenant . ' AS B
            ON B.id = A.tenant_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }
    
    /**
     * Delete Notes by Uniquecode
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_notes($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->incubation_notes) )
            return true;

        return false;
    }
    
    function count_notes($status){
        $this->db->where('status', $status);
        $query = $this->db->get($this->incubation_notes);

        return $query->num_rows();
    }

    /**
     * Update Notes by Uniquecode
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of product
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_notes($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->incubation_notes, $data) )
            return true;

        return false;
    }
    
    /**
	 * Stats monthly
	 * @author Iqbal
	 * @param string $from Stats from
	 * @param string $to   Stats to
	 */
	function stats_monthly() {
		$sql = '
        SELECT
			DATE_FORMAT( datecreated, "%Y-%c") AS period,
			DATE_FORMAT( datecreated, "%b %Y") AS period_name,
            category,
			COUNT(id) AS total
		FROM '.$this->incubation_selection.'
		GROUP BY 1,3
		ORDER BY 3 DESC';

		$qry = $this->db->query( $sql );
		if ( ! $qry || ! $qry->num_rows() )
			return false;

		return $qry->result();
	}

	/**
	 * Stats yearly
	 * @author Iqbal
	 * @param string $from Stats from
	 * @param string $to   Stats to
	 */
	function stats_yearly() {
		$sql = '
        SELECT
			year AS period,
            category,
			COUNT(id) AS total
		FROM '.$this->incubation_selection.'
		GROUP BY 1,2
		ORDER BY 3 DESC';

		$qry = $this->db->query( $sql );

		if ( ! $qry || ! $qry->num_rows() )
			return false;

		return $qry->result();
	}
    // ---------------------------------------------------------------------------------
    
    /**
     * Delete Notes by Uniquecode
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_report($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->incubation_report) )
            return true;

        return false;
    }

    /**
     * Update Notes by Uniquecode
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of product
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_report($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->incubation_report, $data) )
            return true;

        return false;
    }

}
/* End of file Model_Incubation.php */
/* Location: ./application/models/Model_Iuide.php */
