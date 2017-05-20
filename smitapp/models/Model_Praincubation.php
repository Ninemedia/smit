<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Praincubation extends SMIT_Model{
    /**
     * Initialize table
     */
    var $user                               = "smit_user";
    var $praincubation_selection            = "smit_praincubation_selection";
    var $praincubation_selection_files      = "smit_praincubation_selection_files";
    var $praincubation_selection_set        = "smit_praincubation_selection_setting";
    var $praincubation_selection_rpt        = "smit_praincubation_selection_report";
    var $praincubation_selection_his        = "smit_praincubation_selection_history";
    var $praincubation_selection_rate_s1    = "smit_praincubation_selection_rate_step1";
    var $praincubation_selection_rate_s2    = "smit_praincubation_selection_rate_step2";
    
    /**
     * Initialize primary field
     */
    var $primary = "id";
    
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
     * Get Praincubation
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Praincubation
     * @return  Mixed   False on invalid date parameter, otherwise data of praincubation(s).
     */
    function get_praincubation($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where('id', $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Pra Incubation Setting
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) setting.
     */
    function get_praincubation_setting($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection_set);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Pra Incubation Report
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Report
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) report.
     */
    function get_praincubation_report($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection_rpt);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Pra Incubation Rate Step 1
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1.
     */
    function get_praincubation_rate_step1($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection_rate_s1);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Pra Incubation Rate Step 1 Score
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1 Score
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1 score.
     */
    function get_praincubation_rate_step1_total($id){
        if ( !$id ) return 0;
        
        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->praincubation_selection_rate_s1.' WHERE selection_id='.$id.'';
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
    function get_praincubation_rate_step1_count($id){
        if ( !$id ) return 0;
        
        $sql    = 'SELECT COUNT(id) AS total FROM '.$this->praincubation_selection_rate_s1.' WHERE selection_id='.$id.'';
        $qry    = $this->db->query($sql);        
        
        if ( !$qry ) return 0;
        
        $row    = $qry->row();
        return $row->total;
    }
    
    /**
     * Get Pra Incubation Rate Step 2
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 2
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 2.
     */
    function get_praincubation_rate_step2($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection_rate_s2);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Pra Incubation Rate Step 2 Score
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 2 Score
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 2 score.
     */
    function get_praincubation_rate_step2_total($id){
        if ( !$id ) return 0;
        
        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->praincubation_selection_rate_s2.' WHERE selection_id='.$id.'';
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
    function get_praincubation_rate_step2_count($id){
        if ( !$id ) return 0;
        
        $sql    = 'SELECT COUNT(id) AS total FROM '.$this->praincubation_selection_rate_s2.' WHERE selection_id='.$id.'';
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
    function get_praincubation_rate_step1_files($jury_id='', $selection_id=''){
        if ( !empty($jury_id) || !empty($selection_id) ) { 
            $jury_id = absint($jury_id); 
            $this->db->where('jury_id', $jury_id);
            
            $selection_id = absint($selection_id); 
            $this->db->where('selection_id', $selection_id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection_rate_s1);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get Pra Incubation Rate Step 1
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of Pra Incubation Rate Step 1
     * @return  Mixed   False on invalid date parameter, otherwise data of pra incubation(s) rate step 1.
     */
    function get_praincubation_rate_step2_files($jury_id='', $selection_id=''){
        if ( !empty($jury_id) || !empty($selection_id) ) { 
            $jury_id = absint($jury_id); 
            $this->db->where('jury_id', $jury_id);
            
            $selection_id = absint($selection_id); 
            $this->db->where('selection_id', $selection_id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->praincubation_selection_rate_s2);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get pra incubation data by conditions
     * 
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of pra incubation
     */
    function get_praincubation_by($field, $value='')
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
            return $this->get_praincubation($id);
        
        if( empty($field) ) return false;
        
        $db     = $this->db;
        
        $db->where($field, $value);
        $query  = $db->get($this->praincubation_selection);
        
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $praincubation = $row;
        }

        return $praincubation;
    }
    
    /**
     * Get pra incubation data by uniquecode
     * 
     * @author  Iqbal
     * @param   Int  $uniquecode  (Required)  Pra Incubation Uniquecode
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of pra incubation
     */
    function get_praincubation_by_uniquecode($uniquecode)
    {
        if( empty($uniquecode) || !$uniquecode ) return false;
        
        $sql = '
            SELECT A.*, B.name AS user_name, B.email, B.phone
            FROM '.$this->praincubation_selection.' AS A
            LEFT JOIN '.$this->user.' AS B
            ON B.id = A.user_id 
            WHERE A.uniquecode = "'.$uniquecode.'"';
        $qry = $this->db->query($sql);
        if( $qry->num_rows == 0 ) return false;

        return $qry->row();
    }
    
    /**
     * Get pra incubation setting data by conditions
     * 
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of praincubation setting
     */
    function get_praincubation_setting_by($field, $value='')
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
            return $this->get_praincubation_setting($id);
        
        if( empty($field) ) return false;
        
        $db     = $this->db;
        
        $db->where($field, $value);
        $query  = $db->get($this->praincubation_selection_set);
        
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $praincubationset = $row;
        }

        return $praincubationset;
    }
    
    /**
     * Get pra incubation report data by conditions
     * 
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of pra incubation report
     */
    function get_praincubation_report_by($field, $value='')
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
            return $this->get_praincubation_report($id);
        
        if( empty($field) ) return false;
        
        $db     = $this->db;
        
        $db->where($field, $value);
        $query  = $db->get($this->praincubation_selection_rpt);
        
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $praincubationrpt = $row;
        }

        return $praincubationrpt;
    }
    
    /**
     * Get pra incubation report data by uniquecode
     * 
     * @author  Iqbal
     * @param   Int  $uniquecode  (Required)  Pra Incubation Report Uniquecode
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of pra incubation report
     */
    function get_praincubation_report_by_uniquecode($uniquecode)
    {
        if( empty($uniquecode) || !$uniquecode ) return false;
        
        $sql = '
            SELECT A.*, B.name AS user_name, B.email, B.phone
            FROM '.$this->praincubation_selection_rpt.' AS A
            INNER JOIN '.$this->user.' AS B
            ON B.id = A.user_id 
            WHERE A.uniquecode = ?';
        $qry = $this->db->query($sql, array($uniquecode));
        
        if( !$qry || $qry->num_rows == 0 ) return false;
        return $qry->row();
    }
    
    /**
     * Get pra incubation rate step1 data by conditions
     * 
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of pra incubation rate step1
     */
    function get_praincubation_rate_step1_by($field, $value='')
    {
        $id = '';
        
        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'jury_id':
                $value  = $value;
                $id     = '';
                $field  = 'jury_id';
                break;
            case 'selection_id':
                $value  = $value;
                $id     = '';
                $field  = 'selection_id';
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
            return $this->get_praincubation_rate_step1($id);
        
        if( empty($field) ) return false;
        
        $db     = $this->db;
        
        $db->where($field, $value);
        $query  = $db->get($this->praincubation_selection_rate_s1);
        
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $praincubation_rate_s1 = $row;
        }

        return $praincubation_rate_s1;
    }
    
    /**
     * Get pra incubation rate step2 data by conditions
     * 
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of pra incubation rate step2
     */
    function get_praincubation_rate_step2_by($field, $value='')
    {
        $id = '';
        
        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'jury_id':
                $value  = $value;
                $id     = '';
                $field  = 'jury_id';
                break;
            case 'selection_id':
                $value  = $value;
                $id     = '';
                $field  = 'selection_id';
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
            return $this->get_praincubation_rate_step2($id);
        
        if( empty($field) ) return false;
        
        $db     = $this->db;
        
        $db->where($field, $value);
        $query  = $db->get($this->praincubation_selection_rate_s2);
        
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $praincubation_rate_s2 = $row;
        }

        return $praincubation_rate_s2;
    }
    
    /**
     * Save data of praincubation_selection
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_praincubation_selection($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->praincubation_selection, $data) ) {
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
    function save_data_praincubation_selection_files($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->praincubation_selection_files, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Save data of praincubation_selection_setting
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of praincubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_praincubation_selection_setting($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->praincubation_selection_set, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Save data of praincubation_selection
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_praincubation_history($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->praincubation_selection_his, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Save data of praincubation_selection_report
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of praincubation report
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_praincubation_selection_report($data){
        if( empty($data) ) return false;
		
		// We have UNIQUE index on this table so we can't use Active Record to do insert
		$sql = 'INSERT IGNORE INTO '.$this->praincubation_selection_rpt.'(`' . implode('`,`', array_keys($data)) . '`)
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
     * Save data of praincubation_selection_rate_step1
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of praincubation rate step 1
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_praincubation_selection_rate_step1($data){
        if( empty($data) ) return false;
		
		// We have UNIQUE index on this table so we can't use Active Record to do insert
		$sql = 'INSERT IGNORE INTO '.$this->praincubation_selection_rate_s1.'(`' . implode('`,`', array_keys($data)) . '`)
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
    function save_data_praincubation_selection_rate_step2($data){
        if( empty($data) ) return false;
		
		// We have UNIQUE index on this table so we can't use Active Record to do insert
		$sql = 'INSERT IGNORE INTO '.$this->praincubation_selection_rate_s2.'(`' . implode('`,`', array_keys($data)) . '`)
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
     * Retrieve all pra incubation data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_praincubation($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%event_title%",          "A.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%description%",          "A.description", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%statustwo%",            "A.statustwo", $conditions);
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%step%",                 "A.step", $conditions);
            $conditions = str_replace("%steptwo%",              "A.steptwo",  $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%event_title%",          "A.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%description%",          "A.description",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%statustwo%",            "A.statustwo",  $order_by);
            $order_by   = str_replace("%url%",                  "B.url",  $order_by);
            $order_by   = str_replace("%extension%",            "B.extension",  $order_by);
            $order_by   = str_replace("%step%",                 "A.step",  $order_by);
            $order_by   = str_replace("%steptwo%",              "A.steptwo",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }
        
        $sql = '
            SELECT A.*,B.workunit, B.name AS user_name, B.email
            FROM ' . $this->praincubation_selection. ' AS A
            LEFT JOIN ' . $this->user . ' AS B ON B.id = A.user_id';
        
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
    function get_all_praincubation_step1($limit=0, $offset=0, $conditions='', $order_by=''){
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
            SELECT A.*,B.rate_total, B.datemodified as dateprocess
            FROM ' . $this->praincubation_selection. ' AS A
            LEFT JOIN ' . $this->praincubation_selection_rate_s1 . ' AS B
            ON B.selection_id = A.id';
        
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
    function get_all_praincubation_scorestep1($limit=0, $offset=0, $conditions='', $order_by=''){
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
            FROM ' . $this->praincubation_selection_rate_s1. ' AS A
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
    function get_all_praincubation_scorestep2($limit=0, $offset=0, $conditions='', $order_by=''){
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
            FROM ' . $this->praincubation_selection_rate_s2. ' AS A
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
     * Count All Score Rows
     * 
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_score($id=0){
        if ( $id != 0 )   { $this->db->where('selection_id', $id); }
        
        $query = $this->db->get($this->praincubation_selection_rate_s1);
        
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
        
        $query = $this->db->get($this->praincubation_selection_rate_s2);
        
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
        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->praincubation_selection_rate_s1.' WHERE selection_id = '.$id.' ';
        
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
        $sql    = 'SELECT SUM(rate_total) AS total FROM '.$this->praincubation_selection_rate_s2.' WHERE selection_id = '.$id.' ';
        
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
        $sql    = 'SELECT SUM(irl_total) AS total FROM '.$this->praincubation_selection_rate_s2.' WHERE selection_id = '.$id.' ';
        
        $query  = $this->db->query($sql);
        $row    = $query->row();
        
        if ( empty($row->total) ) return 0;
        
        return $row->total;
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
    function get_all_praincubation_files($limit=0, $offset=0, $conditions='', $order_by=''){
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
        
        $sql = 'SELECT * FROM ' . $this->praincubation_selection_files. ' ';
        
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
    function get_all_praincubation_setting($limit=0, $offset=0, $conditions='', $order_by=''){
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
        
        $sql = 'SELECT * FROM ' . $this->praincubation_selection_set. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Retrieve all praincubation report data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of incrpt             default 0
     * @param   Int     $offset             Offset ot incrpt            default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of praincubation report list
     */
    function get_all_praincubation_report($limit=0, $offset=0, $conditions='', $order_by=''){
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
            FROM ' . $this->praincubation_selection_rpt. ' AS A
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
    function get_all_praincubation_history($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
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
            $order_by   = str_replace("%event_title%",          "event_title",  $order_by);
            $order_by   = str_replace("%username%",             "username",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%jury_id%",              "jury_id",  $order_by);
            $order_by   = str_replace("%user_id%",              "user_id",  $order_by);
            $order_by   = str_replace("%score%",                "score",  $order_by);
            $order_by   = str_replace("%step%",                 "step",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }
        
        $sql = ' SELECT * FROM ' . $this->praincubation_selection_his. ' ';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Update data of praincubation
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of praincubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_praincubation($id, $data){
        if( empty($id) || empty($data) ) return false;
        
        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);
    
        if( $this->db->update($this->praincubation_selection, $data) ) 
            return true;
            
        return false;
    }
    
    /**
     * Update data of praincubation setting
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  Pra Incibation Setting ID
     * @param   Array   $data   (Required)  Array data of praincubation setting
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_praincubation_setting($id, $data){
        if( empty($id) || empty($data) ) return false;
        
        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);
    
        if( $this->db->update($this->praincubation_selection_set, $data) ) 
            return true;
            
        return false;
    }
    
    /**
     * Update data of praincubation report
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  Pra Incibation Report ID
     * @param   Array   $data   (Required)  Array data of praincubation report
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_praincubation_report($id, $data){
        if( empty($id) || empty($data) ) return false;
        
        if ( is_array($id) ) $this->db->where_in($this->primary, $id);
		else $this->db->where($this->primary, $id);
    
        if( $this->db->update($this->praincubation_selection_rpt, $data) ) 
            return true;
            
        return false;
    }
    
    // ---------------------------------------------------------------------------------
}
/* End of file Model_Praincubation.php */
/* Location: ./application/models/Model_Iuide.php */
