<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Announcement extends SMIT_Model{
    /**
     * Initialize table
     */
    var $announcement       = "smit_announcement";
    
    /**
     * Initialize primary field
     */
    var $primary            = "id";
    
    /**
	* Constructor - Sets up the object properties.
	*/
    public function __construct()
    {
        parent::__construct();
    }

    // ---------------------------------------------------------------------------------
    // CRUD (Manipulation) data announcement
    // ---------------------------------------------------------------------------------
    
    /**
     * Get announcement
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of announcement
     * @return  Mixed   False on invalid date parameter, otherwise data of announcement(s).
     */
    function get_announcement($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->announcement);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get announcement
     * 
     * @author  Iqbal
     * @param   Int     $uniquecode     (Required)  ID of announcement
     * @return  Mixed   False on invalid date parameter, otherwise data of announcement(s).
     */
    function get_announcement_by_uniquecode($uniquecode=''){
        if ( !empty($uniquecode) ) { 
            $this->db->where('uniquecode', $uniquecode);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->announcement);        
        return ( !empty($uniquecode) ? $query->row() : $query->result() );
    }
    
    /**
     * Save data of announcement
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of announcement
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_announcement($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->announcement, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all announcement data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_announcements($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%no_announcement%",      "no_announcement", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%description%",          "description", $conditions);
            $conditions = str_replace("%url%",                  "url", $conditions);
            $conditions = str_replace("%extension%",            "extension", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%no_announcement%",      "no_announcement",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%description%",          "description",  $order_by);
            $order_by   = str_replace("%url%",                  "url",  $order_by);
            $order_by   = str_replace("%extension%",            "extension",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->announcement. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    /**
     * Delete Announcement
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_announcement($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->announcement) )
            return true;

        return false;
    }
    
    // ---------------------------------------------------------------------------------
}
/* End of file Model_Guide.php */
/* Location: ./application/models/Model_Guide.php */
