<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Service extends SMIT_Model{
    /**
     * Initialize table
     */
    var $contact_message    = "smit_contact";
    var $communication      = "smit_communication";
    var $communication_id   = "smit_communication_id";
    var $communication_user = "smit_communication_user";
    var $communication_data = "smit_communication_data";
    var $ikm_list           = "smit_ikm_list";
    var $ikm_data           = "smit_ikm_data";
    var $ikm                = "smit_ikm";

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

     /**
     * Update data of general message
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_message($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->contact_message, $data) )
            return true;

        return false;
    }

    /**
     * Delete Message
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_message($id){
        if( empty($id) )
            return false;

        $this->db->where('id', $id);
        if( $this->db->delete($this->contact_message) )
            return true;

        return false;
    }

    // ---------------------------------------------------------------------------------\
    /**
     * Save data of communication
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of communication
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_communication_id($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->communication_id, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Save data of communication
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of communication
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_communication_user($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->communication_user, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Save data of communication
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of communication
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_communication_data($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->communication_data, $data) ) {
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
    function get_all_communication_out($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%from_id%",              "A.from_id", $conditions);
            $conditions = str_replace("%to_id%",                "A.to_id", $conditions);
            $conditions = str_replace("%information%",          "A.information", $conditions);
            $conditions = str_replace("%title%",                "B.title", $conditions);
            $conditions = str_replace("%desc%",                 "C.desc", $conditions);
            $conditions = str_replace("%status%",               "C.status", $conditions);
            $conditions = str_replace("%id_userdata%",          "user_id", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%from_id%",              "A.from_id",  $order_by);
            $order_by   = str_replace("%to_id%",                "A.to_id",  $order_by);
            $order_by   = str_replace("%information%",          "A.information",  $order_by);
            $order_by   = str_replace("%title%",                "B.title",  $order_by);
            $order_by   = str_replace("%desc%",                 "C.desc",  $order_by);
            $order_by   = str_replace("%status%",               "C.status",  $order_by);
            $order_by   = str_replace("%id_userdata%",          "user_id",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }
        
        /*
        $sql = 'SELECT A.*, B.title, C.desc, C.status, C.uniquecode AS uniquecode_data, C.user_id AS id_userdata FROM ' . $this->communication_user. ' AS A
            LEFT JOIN '. $this->communication_id .' AS B ON B.id = A.communication_id
            LEFT JOIN '. $this->communication_data . ' AS C ON C.communication_id = A.communication_id
        ';
        */
        $sql = 'SELECT * FROM ' . $this->communication_data. '';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }
    
    function get_all_communication($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%communication_id%",     "A.communication_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%uniquecode_data%",      "c.uniquecode", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%from_id%",              "A.from_id", $conditions);
            $conditions = str_replace("%to_id%",                "A.to_id", $conditions);
            $conditions = str_replace("%information%",          "A.information", $conditions);
            $conditions = str_replace("%title%",                "B.title", $conditions);
            $conditions = str_replace("%desc%",                 "C.desc", $conditions);
            $conditions = str_replace("%status%",               "C.status", $conditions);
            $conditions = str_replace("%id_userdata%",          "C.user_id", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%communication_id%",     "A.communication_id",  $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%uniquecode_data%",      "C.uniquecode",  $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%from_id%",              "A.from_id",  $order_by);
            $order_by   = str_replace("%to_id%",                "A.to_id",  $order_by);
            $order_by   = str_replace("%information%",          "A.information",  $order_by);
            $order_by   = str_replace("%title%",                "B.title",  $order_by);
            $order_by   = str_replace("%desc%",                 "C.desc",  $order_by);
            $order_by   = str_replace("%status%",               "C.status",  $order_by);
            $order_by   = str_replace("%id_userdata%",          "C.user_id",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }

        $sql = 'SELECT A.*, B.title, C.desc, C.status, C.uniquecode AS uniquecode_data, C.user_id AS id_userdata FROM ' . $this->communication_user. ' AS A
            LEFT JOIN '. $this->communication_id .' AS B ON B.id = A.communication_id
            LEFT JOIN '. $this->communication_data . ' AS C ON C.communication_id = A.communication_id
        ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }
    
    function get_all_communication_in($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%from_id%",              "A.from_id", $conditions);
            $conditions = str_replace("%to_id%",                "A.to_id", $conditions);
            $conditions = str_replace("%information%",          "A.information", $conditions);
            $conditions = str_replace("%title%",                "B.title", $conditions);
            $conditions = str_replace("%desc%",                 "C.desc", $conditions);
            $conditions = str_replace("%status%",               "C.status", $conditions);
            $conditions = str_replace("%id_userdata%",          "C.user_id", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%from_id%",              "A.from_id",  $order_by);
            $order_by   = str_replace("%to_id%",                "A.to_id",  $order_by);
            $order_by   = str_replace("%information%",          "A.information",  $order_by);
            $order_by   = str_replace("%title%",                "B.title",  $order_by);
            $order_by   = str_replace("%desc%",                 "C.desc",  $order_by);
            $order_by   = str_replace("%status%",               "C.status",  $order_by);
            $order_by   = str_replace("%id_userdata%",          "C.user_id",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }

        $sql = 'SELECT A.*, B.title, C.desc, C.status, C.uniquecode AS uniquecode_data, C.user_id AS id_userdata FROM ' . $this->communication_user. ' AS A
            LEFT JOIN '. $this->communication_id .' AS B ON B.id = A.communication_id
            LEFT JOIN '. $this->communication_data . ' AS C ON C.communication_id = A.communication_id
        ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }
    
    function get_all_communication_inuser($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%uniquecode_data%",      "C.uniquecode", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%from_id%",              "A.from_id", $conditions);
            $conditions = str_replace("%to_id%",                "A.to_id", $conditions);
            $conditions = str_replace("%information%",          "A.information", $conditions);
            $conditions = str_replace("%title%",                "B.title", $conditions);
            $conditions = str_replace("%desc%",                 "C.desc", $conditions);
            $conditions = str_replace("%status%",               "C.status", $conditions);
            $conditions = str_replace("%id_userdata%",          "C.user_id", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%uniquecode_data%",      "C.uniquecode",  $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%from_id%",              "A.from_id",  $order_by);
            $order_by   = str_replace("%to_id%",                "A.to_id",  $order_by);
            $order_by   = str_replace("%information%",          "A.information",  $order_by);
            $order_by   = str_replace("%title%",                "B.title",  $order_by);
            $order_by   = str_replace("%desc%",                 "C.desc",  $order_by);
            $order_by   = str_replace("%status%",               "C.status",  $order_by);
            $order_by   = str_replace("%id_userdata%",          "C.user_id",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
        }

        $sql = 'SELECT A.*, C.user_id AS id_userdata, C.status, C.desc, C.uniquecode AS uniquecode_data FROM ' . $this->communication_user. ' AS A
                LEFT JOIN '.$this->communication_data.' AS C ON C.communication_id = A.communication_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
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
    function get_all_communication_data($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%user_id%",              "user_id", $conditions);
            $conditions = str_replace("%communication_id%",     "communication_id", $conditions);
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%desc%",                 "desc", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%user_id%",              "user_id",  $order_by);
            $order_by   = str_replace("%communication_id%",     "communication_id",  $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
            $order_by   = str_replace("%desc%",                 "desc",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->communication_data.'';

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
    function update_communication_data($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->communication_data, $data) )
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
     * Save data of ikm
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of ikm
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_ikm($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->ikm, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Save data of ikm
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of ikm
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_ikmdata($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->ikm_data, $data) ) {
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
            $conditions = str_replace("%title%",                "title", $conditions);
            $conditions = str_replace("%question%",             "question", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%title%",                "title",  $order_by);
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

    /**
     * Delete IKM List
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_ikmlist($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->ikm_list) )
            return true;

        return false;
    }

    /**
     * Delete IKM
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_ikm($action='', $id=0){
        if( $id == 0 || empty($action))
            return false;

        if($action = 'ikmdata'){
            $this->db->where('ikmdata_id', $id);
        }elseif($action == 'ikmlist'){
            $this->db->where('ikm_id', $id);
        }

        if( $this->db->delete($this->ikm) )
            return true;

        return false;
    }

    /** Update data of IKM List
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_ikmlist($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->ikm_list, $data) )
            return true;

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
    function get_all_ikmdata($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%email%",                "email", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%email%",                "email",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->ikm_data . '';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Delete IKM Data
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_ikmdata($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->ikm_data) )
            return true;

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
    function get_all_ikmscorelist($limit=0, $offset=0, $conditions='', $order_by=''){
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

        $sql = 'SELECT A.*, B.answer FROM ' . $this->ikm_list . ' AS A
        LEFT JOIN '. $this->ikm.' AS B
        ON B.ikm_id = A.id
        ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Count All Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_answer($ikm_id=0, $answer=0, $year=0){
        if ( $ikm_id != 0 )     { $this->db->where('ikm_id', $ikm_id); }
        if ( $answer != 0 )     { $this->db->where('answer', $answer); }
        if ( $year != 0 )       { $this->db->where('datecreated', $year); }

        $query = $this->db->get($this->ikm);

        return $query->num_rows();
    }

    /**
     * Count All IKM List Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all_ikmlist(){
        $query = $this->db->get($this->ikm_list);

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
    function sum_all_answer($id){
        //if ( $id != 0 )   { $this->db->where('selection_id', $id); }
        $sql    = 'SELECT SUM(nilai) AS nilai_data FROM '.$this->ikm.' WHERE ikm_id = '.$id.' ';

        $query  = $this->db->query($sql);
        $row    = $query->row();

        if ( empty($row->nilai_data) ) return 0;

        return $row->nilai_data;
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
			DATE_FORMAT( datecreated, "%Y") AS period,
            answer,
			COUNT(answer) AS total
		FROM '.$this->ikm.'
		GROUP BY 1,2
		ORDER BY 1 DESC';

		$qry = $this->db->query( $sql );

		if ( ! $qry || ! $qry->num_rows() )
			return false;

		return $qry->result();
	}

    /**
	 * Stats question
	 * @author Iqbal
	 * @param string $from Stats from
	 * @param string $to   Stats to
	 */
	function stats_question() {
		$sql = '
        SELECT
			DATE_FORMAT( A.datecreated, "%Y") AS period,
            A.ikm_id, B.title,
			COUNT(A.ikm_id) AS total
		FROM '.$this->ikm.' AS A
        LEFT JOIN '.$this->ikm_list.' AS B
        ON B.id = A.ikm_id
		GROUP BY 1,2
		ORDER BY 1 DESC';

		$qry            = $this->db->query( $sql );
        $data           = $qry->result();
        if ( ! $qry || ! $qry->num_rows() )
			return false;

        $dataset        = array();
        $total_ikmlist  = $this->Model_Service->count_all_ikmlist();
        $penimbang      = number_format(1/$total_ikmlist, 3);
        $total_ikm      = 0;
        foreach($data as $row){
            $nilai          = $this->Model_Service->sum_all_answer($row->ikm_id);
            $total_unsur    = $this->Model_Service->count_all_answer($row->ikm_id);
            $nilai_rata     = $nilai / $total_unsur;
            $rata_penimbang = $nilai_rata * $penimbang;
            $ikm            = $nilai_rata * $rata_penimbang;
            $ikm            = floor($ikm);
            //$total_ikm      += $ikm;

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


            $dataset[]      = array(
                'period'    => $row->period,
                'ikm_id'    => $row->ikm_id,
                'title'     => $row->title,
                'total'     => $row->total,
                'ikm'       => $ikm,
                'mutu'      => $mutu,
                'kinerja'   => $kinerja,
            );
        }

		return $dataset;
	}

    /**
     * Update IKM Data by Uniquecode
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of praincubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_ikmdata($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->ikm_list, $data) )
            return true;

        return false;
    }

    // ---------------------------------------------------------------------------------
}
/* End of file Model_Guide.php */
/* Location: ./application/models/Model_Guide.php */
