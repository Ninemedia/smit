<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Tenant extends SMIT_Model{
	/**
	 * For SMIT_Model
	 */
    public $_table          = 'smit_user';
    public $_tenant         = 'smit_incubation_tenant';

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
    // CRUD (Manipulation) data tenant
    // ---------------------------------------------------------------------------------

    /**
     * Save data of tenant
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of tenant
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_tenant($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->_tenant, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }


    /**
     * Get user data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of user
     */
    function get_tenant_by($field, $value='')
    {
        $id = '';

        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'email':
                $value  = sanitize_email($value);
                $id     = '';
                $field  = 'email';
                break;
            case 'login':
                $value  = $value;
                $id     = '';
                $field  = 'login';
                break;
            default:
                return false;
        }

        if ( $id != '' && $id > 0 )
            return $this->get_userdata($id);

        if( empty($field) ) return false;

        $db     = $this->db;

        if( $field == 'login' ){
			$db->where('username', $value);
        }else{
            $db->where($field, $value);
        }

        $query  = $db->get($this->_tenant);

        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $user = $row;
        }

        return $user;
    }

    /**
     * Get user data by user ID
     *
     * @author  Iqbal
     * @param   Integer $user_id  (Required)  User ID
     * @return  Mixed   False on failed process, otherwise object of user.
     */
    function get_tenantdata($user_id){
        if ( !is_numeric($user_id) ) return false;

        $user_id = absint($user_id);
        if ( !$user_id ) return false;

        $query = $this->db->get_where($this->_tenant, array('user_id' => $user_id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $user = $row;
        }

        return $user;
    }

    /**
     * Retrieve all tenant data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of tenant         default 0
     * @param   Int     $offset             Offset ot tenant        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of tenant list
     */
    function get_all_tenant($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%uniquecode%",           "uniquecode", $conditions);
            $conditions = str_replace("%username%",             "username", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%name_tenant%",          "name_tenant", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%email%",                "email", $conditions);
            $conditions = str_replace("%phone%",                "phone", $conditions);
            $conditions = str_replace("%year%",                 "year", $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "uniquecode",  $order_by);
            $order_by   = str_replace("%username%",             "username",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%name_tenant%",          "name_tenant",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%email%",                "email",  $order_by);
            $order_by   = str_replace("%phone%",                "phone",  $order_by);
            $order_by   = str_replace("%year%",                 "year",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = '
            SELECT *
            FROM ' . $this->_tenant. '';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Save data of user
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of user
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data($data){
        if( empty($data) ) return false;

        $this->before_create    = array( 'encode_password(password)' );
        $this->before_create    = array( 'encode_password(password_pin)' );

        if( $id = $this->insert($data) ) {
            return $id;
        };
        return false;
    }

    /**
     * Update data of user
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  User ID
     * @param   Array   $data   (Required)  Array data of user
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data($id, $data){
        $this->load->library( 'encrypt' );
        if( empty($id) || empty($data) ) return false;

        if( isset($data['password']) ){
            $data['password']       = $this->encrypt->encode( $data['password'] );
        }

        if( isset($data['password_pin']) ){
            $data['password_pin']   = $this->encrypt->encode( $data['password_pin'] );
        }

        if( $this->update($id, $data) )
            return true;

        return false;
    }

    /**
     * Update data of tenant
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  tenant ID
     * @param   Array   $data   (Required)  Array data of incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_tenant($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in('user_id', $id);
		else $this->db->where('user_id', $id);

        if( $this->db->update($this->_tenant, $data) )
            return true;

        return false;
    }

    /**
     * Get user newest
     *
     * @param   Int     $limit  (Optional)  Limit of User
     * @return  stdClass of user newest.
     */
    function get_user_newest($limit=1){
        $sql    = 'SELECT * FROM '.$this->_user.' WHERE status = 1 ORDER BY datecreated DESC LIMIT ' . $limit;
        $query  = $this->db->query($sql);

        if($limit==1){
            return $query->row();
        }else{
            return $query->result();
        }
    }

    // ---------------------------------------------------------------------------------
    // General Function
    // ---------------------------------------------------------------------------------

    /**
     * Count All Rows
     *
     * @author  Iqbal
     * @param   String  $status (Optional) Status of user, default 'all'
     * @param   Int     $type   (Optional) Type of user, default 'all'
     * @return  Int of total rows user
     */
    function count_all($status='all', $type=0){
        if ( $status != 'all' ) { $this->db->where('status', $status); }
        if ( $type != 0 )   { $this->db->where('type', $type); }

        $query = $this->db->get($this->_tenant);

        return $query->num_rows();
    }

    // ---------------------------------------------------------------------------------
}
/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */
