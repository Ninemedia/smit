<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Tenant extends SMIT_Model{
	/**
	 * For SMIT_Model
	 */
    public $user          	= 'smit_user';
    public $tenant         	= 'smit_incubation_tenant';
    public $incubation      = 'smit_incubation';
    public $incubation_selection    = 'smit_incubation_selection';
    public $incubation_product      = 'smit_incubation_product';
    public $incubation_blog         = 'smit_incubation_blog';

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
        if( $this->db->insert($this->tenant, $data) ) {
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

        $query  = $db->get($this->tenant);

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

        $query = $this->db->get_where($this->tenant, array('user_id' => $user_id));
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
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%name_tenant%",          "A.name_tenant", $conditions);
            $conditions = str_replace("%status%",               "A.status", $conditions);
            $conditions = str_replace("%email%",                "A.email", $conditions);
            $conditions = str_replace("%phone%",                "A.phone", $conditions);
            $conditions = str_replace("%year%",                 "A.year", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%companion_id%",         "B.companion_id", $conditions);
            $conditions = str_replace("%product_id%",           "B.id", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%name_tenant%",          "A.name_tenant",  $order_by);
            $order_by   = str_replace("%status%",               "A.status",  $order_by);
            $order_by   = str_replace("%email%",                "A.email",  $order_by);
            $order_by   = str_replace("%phone%",                "A.phone",  $order_by);
            $order_by   = str_replace("%year%",                 "A.year",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%companion_id%",         "B.companion_id",  $order_by);
            $order_by   = str_replace("%product_id%",           "B.id",  $order_by);
        }

        $sql = '
            SELECT A.*, B.event_title, B.year, B.companion_id, B.name AS user_name, B.event_desc, B.category, B.id AS product_id
			FROM ' . $this->tenant. ' AS A
			LEFT JOIN ' . $this->incubation. ' AS B
			ON B.id = A.incubation_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

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
     * Save data of product praincubation
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of product pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_product($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_product, $data) ) {
            $id = $this->db->insert_id();
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

        if( $this->db->update($this->tenant, $data) )
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
        $sql    = 'SELECT * FROM '.$this->user.' WHERE status = 1 ORDER BY datecreated DESC LIMIT ' . $limit;
        $query  = $this->db->query($sql);

        if($limit==1){
            return $query->row();
        }else{
            return $query->result();
        }
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
    function get_all_tenantdata($limit=0, $offset=0, $conditions='', $order_by=''){
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
        }

        $sql = '
            SELECT A.*,B.workunit, B.*, C.name AS companion_name
            FROM ' . $this->tenant. ' AS A
            LEFT JOIN ' . $this->incubation_selection . ' AS B
            ON B.id = A.selection_id
            LEFT JOIN ' . $this->incubation . ' AS C
            ON C.id = A.selection_id ';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all product data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_product($limit=0, $offset=0, $conditions='', $order_by=''){
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
            $conditions = str_replace("%category_id%",          "A.category_id", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%companion_id%",         "B.companion_id", $conditions);
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
            $order_by   = str_replace("%category_id%",          "A.category_id",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%companion_id%",         "B.companion_id",  $order_by);
        }

        $sql = '
            SELECT A.*,B.event_title, B.companion_id
            FROM ' . $this->incubation_product. ' AS A
            LEFT JOIN ' . $this->incubation . ' AS B
            ON B.tenant_id = A.tenant_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
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

        $query = $this->db->get($this->tenant);

        return $query->num_rows();
    }

    /**
     * Count data of product tenant
     *
     * @author  Iqbal
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function count_data_product_tenant(){
        $sql = 'SELECT COUNT(id) AS total FROM ' . $this->incubation_product. '';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return 0;

        return $query->row()->total;
    }

    /**
     * Save data of blog tenant
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of product pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_blogtenant($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_blog, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Retrieve all blog tenant data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_blogtenant($limit=0, $offset=0, $conditions='', $order_by=''){
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
            $conditions = str_replace("%product_title%",        "B.title", $conditions);
            $conditions = str_replace("%category_id%",          "B.category_id", $conditions);
            $conditions = str_replace("%category_product%",     "B.category_product", $conditions);
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
            $order_by   = str_replace("%product_title%",        "B.title",  $order_by);
            $order_by   = str_replace("%category_id%",          "B.category_id",  $order_by);
            $order_by   = str_replace("%category_product%",     "B.category_product",  $order_by);
        }

        $sql = '
            SELECT A.*,B.title AS product_title, B.category_id, B.category_product
            FROM ' . $this->incubation_blog. ' AS A
            LEFT JOIN ' . $this->incubation_product . ' AS B
            ON B.id = A.product_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Count data of blog tenant
     *
     * @author  Iqbal
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function count_data_blog_tenant(){
        $sql = 'SELECT COUNT(id) AS total FROM ' . $this->incubation_blog. '';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return 0;

        return $query->row()->total;
    }

    // ---------------------------------------------------------------------------------
}
/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */
