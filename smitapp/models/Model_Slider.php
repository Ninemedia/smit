<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Slider extends SMIT_Model{
    /**
     * Initialize table
     */
    var $slider         = "smit_slider";
    
    /**
     * Initialize primary field
     */
    var $primary        = "id";
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------------------------------------------------------
    // CRUD (Manipulation) data slider
    // ---------------------------------------------------------------------------------
    
    /**
     * Get slider
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of slider
     * @return  Mixed   False on invalid date parameter, otherwise data of slider(s).
     */
    function get_slider($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->slider);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get slider
     * 
     * @author  Iqbal
     * @param   Int     $uniquecode     (Required)  ID of slider
     * @return  Mixed   False on invalid date parameter, otherwise data of slider(s).
     */
    function get_slider_by_uniquecode($uniquecode=''){
        if ( !empty($uniquecode) ) { 
            $this->db->where('uniquecode', $uniquecode);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->slider);        
        return ( !empty($uniquecode) ? $query->row() : $query->result() );
    }
    
    /**
     * Save data of slider
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_slider($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->slider, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all slider data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_slider($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%description%",          "description", $conditions);
            $conditions = str_replace("%url%",                  "url", $conditions);
            $conditions = str_replace("%extension%",            "extension", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%description%",          "description",  $order_by);
            $order_by   = str_replace("%url%",                  "url",  $order_by);
            $order_by   = str_replace("%extension%",            "extension",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->slider. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Update data of slider
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_slider($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);
    
        if( $this->db->update($this->slider, $data) ) 
            return true;
            
        return false;
    }
    
    // ---------------------------------------------------------------------------------
}
/* End of file Model_Guide.php */
/* Location: ./application/models/Model_Guide.php */
