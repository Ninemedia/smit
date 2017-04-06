<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Praincubation extends SMIT_Model{
    /**
     * Initialize table
     */
    var $user                           = "smit_user";
    var $praincubation_selection        = "smit_praincubation_selection";
    var $praincubation_selection_files  = "smit_praincubation_selection_files";
    var $praincubation_selection_set    = "smit_praincubation_selection_setting";
    var $praincubation_selection_rpt    = "smit_praincubation_selection_report";
    
    /**
     * Initialize primary field
     */
    var $primary                        = "id";
    
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
            return $this->get_incubation($id);
        
        if( empty($field) ) return false;
        
        $db     = $this->db;
        
        $db->where($field, $value);
        $query  = $db->get($this->praincubation_selection);
        
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $incubation = $row;
        }

        return $incubation;
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
        //if( $qry->num_rows == 0 ) return false;
        
        print_r($qry);
        die();
        
        print_r($qry);
        die();
        
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
            $incubationset = $row;
        }

        return $incubationset;
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
            $incubationrpt = $row;
        }

        return $incubationrpt;
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
            $conditions = str_replace("%url%",                  "A.url", $conditions);
            $conditions = str_replace("%extension%",            "A.extension", $conditions);
            $conditions = str_replace("%step%",                 "A.step", $conditions);
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
            $order_by   = str_replace("%url%",                  "B.url",  $order_by);
            $order_by   = str_replace("%extension%",            "B.extension",  $order_by);
            $order_by   = str_replace("%step%",                 "A.step",  $order_by);
            $order_by   = str_replace("%jury%",                 "A.jury_id",  $order_by);
            $order_by   = str_replace("%jury_username%",        "B.username",  $order_by);
            $order_by   = str_replace("%jury_name%",            "B.name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }
        
        $sql = '
            SELECT 
                A.*,
                B.username AS jury_username,
                B.name as jury_name,
                B.workunit
            FROM ' . $this->praincubation_selection. ' AS A
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
    
        if( $this->db->update($this->incubation_selection_set, $data) ) 
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
