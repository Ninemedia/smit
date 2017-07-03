<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Service extends SMIT_Model{
    /**
     * Initialize table
     */
    var $contact_message    = "smit_contact";
    var $communication      = "smit_communication";
    var $ikm_list           = "smit_ikm_list";
    
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
    // CRUD (Manipulation) data service
    // ---------------------------------------------------------------------------------
    
    /**
     * Get contact message
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  ID of contact message
     * @return  Mixed   False on invalid date parameter, otherwise data of contact message(s).
     */
    function get_contact_message($id=''){
        if ( !empty($id) ) { 
            $id = absint($id); 
            $this->db->where($primary, $id);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->contact_message);        
        return ( !empty($id) ? $query->row() : $query->result() );
    }
    
    /**
     * Get contact message
     * 
     * @author  Iqbal
     * @param   Int     $uniquecode     (Required)  ID of contact message
     * @return  Mixed   False on invalid date parameter, otherwise data of contact message(s).
     */
    function get_contact_message_by_uniquecode($uniquecode=''){
        if ( !empty($uniquecode) ) { 
            $this->db->where('uniquecode', $uniquecode);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->contact_message);        
        return ( !empty($uniquecode) ? $query->row() : $query->result() );
    }
    
    /**
     * Save data of contact message
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of contact message
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_contact_message($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->contact_message, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all contact message data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_contact_message($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%email%",                "email", $conditions);
            $conditions = str_replace("%description%",          "description", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%email%",                "email",  $order_by);
            $order_by   = str_replace("%description%",          "description",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->contact_message. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    function count_generalmessage($status){
        $this->db->where('status', $status);
        $query = $this->db->get($this->contact_message);
        
        return $query->num_rows();
    }
    
    // ---------------------------------------------------------------------------------
    /**
     * Save data of communication
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of communication
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_communication($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->communication, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all contact message data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_communication($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%desc%",                 "desc", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%desc%",                 "desc",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->communication. '';
        
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    function count_communicationin($status, $user_id=0){
        $this->db->where('status', $status);
        if( $user_id != 0 ){ $this->db->where('user_id', $user_id); }
        $query = $this->db->get($this->communication);
        
        return $query->num_rows();
    }
    
    /**
     * Get communication
     * 
     * @author  Iqbal
     * @param   Int     $uniquecode     (Required)  ID of communication
     * @return  Mixed   False on invalid date parameter, otherwise data of communication(s).
     */
    function get_communication_by_uniquecode($uniquecode=''){
        if ( !empty($uniquecode) ) { 
            $this->db->where('uniquecode', $uniquecode);
        };
        
        $this->db->order_by("datecreated", "DESC"); 
        $query      = $this->db->get($this->communication);        
        return ( !empty($uniquecode) ? $query->row() : $query->result() );
    }
    
    /**
     * Update data of communication
     * 
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_communication($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);
    
        if( $this->db->update($this->communication, $data) ) 
            return true;
            
        return false;
    }
    
    /**
     * Save data of ikm
     * 
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of ikm
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_ikm_list($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->ikm_list, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }
    
    /**
     * Retrieve all ikm data
     * 
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_ikmlist($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%question%",             "question", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }
        
        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%question%",             "question",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }
        
        $sql = 'SELECT * FROM ' . $this->ikm_list . '';
    
        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');
        
        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;
        
        return $query->result();
    }
    
    // ---------------------------------------------------------------------------------
}
/* End of file Model_Guide.php */
/* Location: ./application/models/Model_Guide.php */
