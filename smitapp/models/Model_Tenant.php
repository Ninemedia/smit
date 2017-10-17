<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_Tenant extends SMIT_Model{
	/**
	 * For SMIT_Model
	 */
    public $user                    = 'smit_user';
    public $tenant         	        = 'smit_incubation_tenant';
    public $tenant_team         	= 'smit_incubation_tenant_team';
    public $incubation              = 'smit_incubation';
    public $incubation_selection    = 'smit_incubation_selection';
    public $incubation_product      = 'smit_incubation_product';
    public $incubation_blog         = 'smit_incubation_blog';
    public $incubation_report       = 'smit_incubation_report';
    public $incubation_actionplan   = 'smit_incubation_actionplan';
    public $incubation_payment      = 'smit_incubation_payment';

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
     * Save data of tenant team
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of tenant team
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_tenant_team($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->tenant_team, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }


    /**
     * Get tenant data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of tenant
     */
    function get_tenant_by($field, $value='')
    {
        $id = '';

        switch ($field) {
            case 'id':
                $id     = $value;
                break;
            case 'user':
                $value  = $value;
                $id     = '';
                $field  = 'user_id';
                break;
            case 'uniquecode':
                $value  = $value;
                $id     = '';
                $field  = 'uniquecode';
                break;
            case 'slug':
                $value  = $value;
                $id     = '';
                $field  = 'slug';
                break;
            default:
                return false;
        }

        if ( $id != '' && $id > 0 )
            return $this->get_tenantdata_by_id($id);

        if( empty($field) ) return false;

        $db     = $this->db;
        $db->where($field, $value);

        $query  = $db->get($this->tenant);

        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $tenantdata = $row;
        }

        return $tenantdata;
    }

    /**
     * Get tenant data by user ID
     *
     * @author  Iqbal
     * @param   Integer $user_id  (Required)  User ID
     * @return  Mixed   False on failed process, otherwise object of tenant.
     */
    function get_tenantdata($user_id){
        if ( !is_numeric($user_id) ) return false;

        $user_id = absint($user_id);
        if ( !$user_id ) return false;

        $query = $this->db->get_where($this->tenant, array('user_id' => $user_id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $tenantdata = $row;
        }

        return $tenantdata;
    }

    /**
     * Get tenant data by tenant ID
     *
     * @author  Iqbal
     * @param   Integer $user_id  (Required)  User ID
     * @return  Mixed   False on failed process, otherwise object of tenant.
     */
    function get_tenantdata_by_id($id){
        if ( !is_numeric($id) ) return false;

        $id = absint($id);
        if ( !$id ) return false;

        $query = $this->db->get_where($this->tenant, array('id' => $id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $tenantdata = $row;
        }

        return $tenantdata;
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
            $conditions = str_replace("%address%",              "A.address", $conditions);
            $conditions = str_replace("%position%",             "A.position", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%companion_id%",         "B.companion_id", $conditions);
            $conditions = str_replace("%companion_name%",       "C.name", $conditions);
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
            $order_by   = str_replace("%address%",              "A.address",  $order_by);
            $order_by   = str_replace("%position%",             "A.position",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%companion_id%",         "B.companion_id",  $order_by);
            $order_by   = str_replace("%companion_name%",       "C.name",  $order_by);
            $order_by   = str_replace("%product_id%",           "B.id",  $order_by);
        }

        $sql = '
        SELECT 
            A.*, A.year AS year_tenant,
            B.event_title, B.year, B.name AS user_name, B.event_desc, B.category, B.id AS product_id,
            C.name AS companion_name
		FROM ' . $this->tenant. ' AS A
		LEFT JOIN ' . $this->incubation. ' AS B ON B.id = A.incubation_id 
        LEFT JOIN ' . $this->user . ' AS C ON C.id = A.companion_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all tenant team data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of tenant         default 0
     * @param   Int     $offset             Offset ot tenant        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of tenant team list
     */
    function get_all_tenant_team($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%id_tenant%",            "A.id_tenant", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%position%",             "A.position", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by = str_replace("%id%",                     "A.id", $order_by);
            $order_by = str_replace("%id_tenant%",              "A.id_tenant", $order_by);
            $order_by = str_replace("%uniquecode%",             "A.uniquecode", $order_by);
            $order_by = str_replace("%name%",                   "A.name", $order_by);
            $order_by = str_replace("%position%",               "A.position", $order_by);
            $order_by = str_replace("%datecreated%",            "A.datecreated", $order_by);
        }

        $sql = '
        SELECT A.*, B.user_id FROM ' . $this->tenant_team . ' AS A
        LEFT JOIN ' . $this->tenant . ' AS B ON B.id = A.id_tenant ';

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
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in('id', $id);
		else $this->db->where('id', $id);

        if( $this->db->update($this->tenant, $data) )
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
     * Update data of tenant team
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Tenant Team ID
     * @param   Array   $data   (Required)  Array data of tenant team
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_data_tenant_team($id, $data){
        if( empty($id) || empty($data) ) return false;

        if ( is_array($id) ) $this->db->where_in('id', $id);
		else $this->db->where('id', $id);

        if( $this->db->update($this->tenant_team, $data) )
            return true;

        return false;
    }

    /**
     * Update Companion by Uniquecode
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  Incibation ID
     * @param   Array   $data   (Required)  Array data of praincubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_companion($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->incubation, $data) )
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
            SELECT A.*, B.*, C.name AS companion_name
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
     * Count data of tenant
     *
     * @author  Iqbal
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function count_data_tenant(){
        $sql = 'SELECT COUNT(id) AS total FROM ' . $this->tenant. '';
        $query = $this->db->query($sql);
        if(!$query || !$query->num_rows()) return 0;

        return $query->row()->total;
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
            $conditions = str_replace("%name_tenant%",          "C.name_tenant", $conditions);
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
            $order_by   = str_replace("%name_tenant%",          "C.name_tenant",  $order_by);
        }

        $sql = '
            SELECT A.*,B.title AS product_title, B.category_id, B.category_product, C.name_tenant
            FROM ' . $this->incubation_blog. ' AS A
            LEFT JOIN ' . $this->incubation_product . ' AS B ON B.id = A.product_id
            LEFT JOIN ' . $this->tenant . ' AS C ON C.id = B.tenant_id
            ';

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

    /**
     * Save data of report praincubation
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of product pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_report($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_report, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

    /**
     * Save data of report praincubation
     *
     * @author  Iqbal
     * @param   Array   $data   (Required)  Array data of product pra incubation
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function save_data_actionplan($data){
        if( empty($data) ) return false;
        if( $this->db->insert($this->incubation_actionplan, $data) ) {
            $id = $this->db->insert_id();
            return $id;
        };
        return false;
    }

	function update_actionplan($id, $data){
        if( empty($id) || empty($data) ) return false;
        $this->db->where('id', $id);

        if( $this->db->update($this->incubation_actionplan, $data) )
            return true;

        return false;
    }

    /**
     * Retrieve all incubation/tenant report data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_reporttenantadmin($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "B.year", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%workunit%",             "C.workunit", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "B.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%workunit%",             "C.workunit",  $order_by);
        }

        $sql = '
            SELECT A.*, B.event_title, B.event_desc, B.year, C.workunit, D.name_tenant
            FROM ' . $this->incubation_report. ' AS A
            LEFT JOIN ' . $this->incubation . ' AS B ON B.id = A.tenant_id
            LEFT JOIN ' . $this->user .' AS C ON C.id = A.user_id
            LEFT JOIN ' . $this->tenant . ' AS D ON D.id = A.tenant_id
            GROUP BY A.user_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Retrieve all incubation/tenant report data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_reportactionplanadmin($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "B.year", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%workunit%",             "C.workunit", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "B.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%workunit%",             "C.workunit",  $order_by);
        }

        $sql = '
            SELECT A.*, B.event_title, B.event_desc, B.year AS year_selection, C.workunit, D.name_tenant
            FROM ' . $this->incubation_actionplan. ' AS A
            LEFT JOIN ' . $this->incubation . ' AS B ON B.id = A.tenant_id
            LEFT JOIN ' . $this->user .' AS C ON C.id = A.user_id
            LEFT JOIN ' . $this->tenant . ' AS D ON D.id = A.tenant_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

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
    function count_all_reporttenant($user_id=0, $tenant_id=0){
        if ( $user_id != 0 )            { $this->db->where('user_id', $user_id); }
        if ( $tenant_id != 0 )          { $this->db->where('tenant_id', $tenant_id); }

        $query = $this->db->get($this->incubation_report);

        return $query->num_rows();
    }

	/**
     * Retrieve all incubation/tenant report data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_reporttenant($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "B.year", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%workunit%",             "D.workunit", $conditions);
            $conditions = str_replace("%month%",                "A.month", $conditions);
            $conditions = str_replace("%companion_id%",         "C.companion_id", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "B.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%workunit%",             "D.workunit",  $order_by);
            $order_by   = str_replace("%month%",                "A.month",  $order_by);
            $order_by   = str_replace("%companion_id%",         "C.companion_id",  $order_by);
        }

        $sql = '
            SELECT A.*, B.name_tenant, C.companion_id, C.event_title, C.event_desc, C.year, D.workunit
            FROM ' . $this->incubation_report. ' AS A
            LEFT JOIN ' . $this->tenant . ' AS B ON B.id = A.tenant_id
            LEFT JOIN ' . $this->incubation . ' AS C ON C.id = A.tenant_id
            LEFT JOIN ' . $this->user .' AS D ON D.id = A.user_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    /**
     * Delete Tenant List
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_payment($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->incubation_payment) )
            return true;

        return false;
    }

    /** Update data of payment List
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_payment($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->incubation_payment, $data) )
            return true;

        return false;
    }

    /**
     * Delete Product Tenant
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_product($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->incubation_product) )
            return true;

        return false;
    }

    /** Update data of product List
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_product($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->incubation_product, $data) )
            return true;

        return false;
    }

    /**
     * Delete Blog Tenant
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_blogtenant($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->incubation_blog) )
            return true;

        return false;
    }

    /** Update data of blog List
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_blogtenant($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->incubation_blog, $data) )
            return true;

        return false;
    }

    /**
     * Delete Tenant List
     *
     * @param   Int     $id     (Required)  PIN Posting ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_tenant($uniquecode){
        if( empty($uniquecode) )
            return false;

        $this->db->where('uniquecode', $uniquecode);
        if( $this->db->delete($this->tenant) )
            return true;

        return false;
    }

    /**
     * Delete Tenant Team List
     *
     * @param   Int     $id     (Required)  Tenant Team ID
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function delete_tenant_team($id){
        if( empty($id) )
            return false;

        $this->db->where('id', $id);
        if( $this->db->delete($this->tenant_team) )
            return true;

        return false;
    }

    /** Update data of tenant List
     *
     * @author  Iqbal
     * @param   Int     $id     (Required)  communication ID
     * @param   Array   $data   (Required)  Array data of slider
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    function update_tenant($uniquecode, $data){
        if( empty($uniquecode) || empty($data) ) return false;
        $this->db->where('uniquecode', $uniquecode);

        if( $this->db->update($this->tenant, $data) )
            return true;

        return false;
    }

    /**
     * Retrieve all pra incubation report data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_reportincubation($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "B.year", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%workunit%",             "C.workunit", $conditions);
            $conditions = str_replace("%month%",                "A.month", $conditions);
            $conditions = str_replace("%companion_id%",         "B.companion_id", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "B.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%workunit%",             "C.workunit",  $order_by);
            $order_by   = str_replace("%month%",                "A.month",  $order_by);
            $order_by   = str_replace("%companion_id%",         "B.companion_id",  $order_by);
        }

        $sql = '
            SELECT A.*, B.event_title, B.event_desc, B.year, C.workunit
            FROM ' . $this->incubation_report. ' AS A
            LEFT JOIN ' . $this->incubation . ' AS B ON B.id = A.tenant_id
            LEFT JOIN ' . $this->user .' AS C ON C.id = A.user_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }
    
    /**
     * Retrieve all pra incubation report data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of incubation         default 0
     * @param   Int     $offset             Offset ot incubation        default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of incubation list
     */
    function get_all_actionplantincubation($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "A.id", $conditions);
            $conditions = str_replace("%user_id%",              "A.user_id", $conditions);
            $conditions = str_replace("%uniquecode%",           "A.uniquecode", $conditions);
            $conditions = str_replace("%year%",                 "B.year", $conditions);
            $conditions = str_replace("%event_title%",          "B.event_title", $conditions);
            $conditions = str_replace("%username%",             "A.username", $conditions);
            $conditions = str_replace("%name%",                 "A.name", $conditions);
            $conditions = str_replace("%user_name%",            "B.user_name", $conditions);
            $conditions = str_replace("%datecreated%",          "A.datecreated", $conditions);
            $conditions = str_replace("%workunit%",             "C.workunit", $conditions);
            $conditions = str_replace("%month%",                "A.month", $conditions);
            $conditions = str_replace("%companion_id%",         "B.companion_id", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "A.id", $order_by);
            $order_by   = str_replace("%user_id%",              "A.user_id", $order_by);
            $order_by   = str_replace("%uniquecode%",           "A.uniquecode",  $order_by);
            $order_by   = str_replace("%year%",                 "B.year",  $order_by);
            $order_by   = str_replace("%event_title%",          "B.event_title",  $order_by);
            $order_by   = str_replace("%username%",             "A.username",  $order_by);
            $order_by   = str_replace("%name%",                 "A.name",  $order_by);
            $order_by   = str_replace("%user_name%",            "B.user_name",  $order_by);
            $order_by   = str_replace("%datecreated%",          "A.datecreated",  $order_by);
            $order_by   = str_replace("%workunit%",             "C.workunit",  $order_by);
            $order_by   = str_replace("%month%",                "A.month",  $order_by);
            $order_by   = str_replace("%companion_id%",         "B.companion_id",  $order_by);
        }

        $sql = '
            SELECT A.*, B.event_title, B.event_desc, B.year, C.workunit
            FROM ' . $this->incubation_actionplan. ' AS A
            LEFT JOIN ' . $this->incubation . ' AS B ON B.id = A.tenant_id
            LEFT JOIN ' . $this->user .' AS C ON C.id = A.user_id';

        if( !empty($conditions) ){ $sql .= $conditions; }
        $sql   .= ' ORDER BY '. ( !empty($order_by) ? $order_by : 'A.datecreated DESC');

        if( $limit ) $sql .= ' LIMIT ' . $offset . ', ' . $limit;

        $query = $this->db->query($sql);

        if(!$query || !$query->num_rows()) return false;

        return $query->result();
    }

    // ---------------------------------------------------------------------------------
}
/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */
