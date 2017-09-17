<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// -------------------------------------------------------------------------
// Login functions helper
// -------------------------------------------------------------------------

if ( !function_exists('smit_set_current_user') ){
    /**
     * set the current user by ID.
     *
     * Some functionality is based on the current user and not based on
     * the signed in user. Therefore, it opens the ability to edit and perform
     * actions on users who aren't signed in.
     *
     * @param   int     $id     User ID
     * @return  smit_user Current user smit_user object
     */
    function smit_set_current_user($id)
    {
    	$CI =& get_instance();
    
    	$current_user = $CI->smit_user->user($id);
        unset($current_user->password);
    
    	return $current_user;
    }
}

if ( !function_exists('smit_get_current_user') ){
    /**
     * Retrieve the current user object.
     *
     * @return smit_user Current user smit_user object
     */
    function smit_get_current_user() 
    {
        $CI =& get_instance();
        if(!empty($CI->current_user)) return $CI->current_user;
        
    	$current_user = get_currentuserinfo();
       
    	if ( !$current_user ){
    		if ($id = smit_isset($_COOKIE['logged_in_'.md5('nonssl')], false, true)){
                $session_userdata = $CI->session->userdata('user_logged_in');
        		if (smit_isset($session_userdata) != "")
                    return smit_set_current_user($id);
        	}
    		return false;
    	}
    	return $current_user;
    }
}

if ( !function_exists('get_currentuserinfo') ){
    /**
     * Populate global variables with information about the currently logged in user.
     *
     * Will set the current user, if the current user is not set. The current user
     * will be set to the logged in person. If no user is logged in, then it will
     * set the current user to 0, which is invalid and won't have any permissions.
     *
     * @uses smit_validate_auth_cookie() Retrieves current logged in user.
     *
     */
    function get_currentuserinfo() 
    {
    	if ( !$id_user = smit_validate_auth_cookie() ) {
    		 if ( empty($_COOKIE[LOGGED_IN_COOKIE]) || !$id_user = smit_validate_auth_cookie($_COOKIE[LOGGED_IN_COOKIE], 'logged_in') ) {
    		 	smit_set_current_user(0);
    		 	return false;
    		 }
    	}
    	return smit_set_current_user($id_user);
    }
}

if ( !function_exists('smit_validate_auth_cookie') ){
    /**
     * Validates authentication cookie.
     *
     * The checks include making sure that the authentication cookie is set and
     * pulling in the contents (if $cookie is not used).
     *
     * Makes sure the cookie is not expired. Verifies the hash in cookie is what is
     * should be and compares the two.
     *
     * @param string $cookie Optional. If used, will validate contents instead of cookie's
     * @param string $scheme Optional. The cookie scheme to use: auth, secure_auth, or logged_in
     * @return bool|int False if invalid cookie, User ID if valid.
     */
    function smit_validate_auth_cookie( $cookie = '', $scheme = '', $get_staff = false )
    {
    	if ( !$cookie_elements = smit_parse_auth_cookie($cookie, $scheme) )
    		return false;
            
    	extract($cookie_elements, EXTR_OVERWRITE);
    
    	$expired = $expiration;
    
    	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
    		$expired += 3600;
    
    	if ( $expired < time() )
    		return false;
    
    	$CI =& get_instance();
    
    	$user = $CI->Model_User->get_user_by('login', $username);
        
    	if ( !$user || empty($user)) return false;
    
    	$pass_frag = substr($user->password, 8, 4);
    	$key       = smit_hash($username . $pass_frag . '|' . $expiration, $scheme);
    	$hash      = hash_hmac('md5', $username . '|' . $expiration, $key);
    	
    	if ( $hmac != $hash )
    		return false;
    
    	return $user->id;
    }
}

if ( !function_exists('smit_parse_auth_cookie') ){
    /**
     * Parse a cookie into its components
     *
     * @param string $cookie
     * @param string $scheme Optional. The cookie scheme to use: auth, secure_auth, or logged_in
     * @return array Authentication cookie components
     */
    function smit_parse_auth_cookie($cookie = '', $scheme = '')
    {
    	$CI =& get_instance();
    
    	if( empty($cookie) ) {
    		switch ($scheme) {
    			case 'auth':
                    $cookie_name        = AUTH_COOKIE;
    				break;
    			case 'secure_auth':
                    $cookie_name        = SECURE_AUTH_COOKIE;
                    break;
    			case 'logged_in':
                    $cookie_name        = LOGGED_IN_COOKIE;
    				break;
    			default:
    				if ( is_ssl() ) {
                        $cookie_name    = SECURE_AUTH_COOKIE;
                        $scheme         = 'secure_auth';
    				} else {
                        $cookie_name    = AUTH_COOKIE;
                        $scheme         = 'auth';
    				}
                    break;
    		}
    
    		if ( empty($_COOKIE[$cookie_name]) )
    			return false;
    		$cookie = $_COOKIE[$cookie_name];
    	}
        
    	$cookie_elements = explode('|', $cookie);
    	if ( count($cookie_elements) != 4 ) return false;
      	
		list($username, $expiration, $hmac, $id_user) = $cookie_elements;
		return compact('username', 'expiration', 'hmac', 'id_user', 'scheme');
    }
}

if ( !function_exists('smit_set_auth_cookie') ){
    /**
     * Sets the authentication cookies based User ID.
     *
     * The $remember parameter increases the time that the cookie will be kept. The
     * default the cookie is kept without remembering is two days. When $remember is
     * set, the cookies will be kept for 14 days or two weeks.
     *
     *
     * @param int $id_user User ID
     * @param bool $remember Whether to remember the user
     */
    
    function smit_set_auth_cookie( $id_user, $remember = false, $secure = '' )
    {    
        $CI =& get_instance();
        
    	if ( $remember ) {
            $expiration = $expire = 2147483647; // maximum expired value (PHP limitation)
    	} else {
    		$expiration = time() + 172800;
    		$expire = 0;
    	}
        
        if ( '' === $secure ) $secure = is_ssl();
    
    	if ( $secure ) {
            $auth_cookie_name   = SECURE_AUTH_COOKIE;
            $scheme             = 'secure_auth';
    	} else {
            $auth_cookie_name   = AUTH_COOKIE;
            $scheme             = 'auth';
    	}
        
        $auth_cookie            = smit_generate_auth_cookie($id_user, $expiration, $scheme);
        $logged_in_cookie       = smit_generate_auth_cookie($id_user, $expiration, 'logged_in');

    	if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', PURE_URL, $regs)){
            $cookie_domain      = '.' . $regs['domain'];
    	}else{
            $cookie_domain      = str_replace(array('http://', 'https://', 'www.'), '', PURE_URL);
            $cookie_domain      = '.' . str_replace('/', '', $cookie_domain);
    	}
        
    	$cookie = array(
    		'name'   => $auth_cookie_name,
    		'value'  => $auth_cookie,
    		'expire' => $expire,
    		'path'   => '/',
    		'domain' => $cookie_domain,
    		'secure' => false
    	);
        //setcookie($auth_cookie_name, $auth_cookie, $expire);
    	$CI->input->set_cookie($cookie);
     
    	unset($cookie);
    	
    	$cookie = array(
    		'name'   => LOGGED_IN_COOKIE,
    		'value'  => $logged_in_cookie,
    		'expire' => $expire,
    		'path'   => '/',
    		'domain' => $cookie_domain,
    		'secure' => false
    	);
        //setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $expire);
    	$CI->input->set_cookie($cookie);
    }
}

if ( !function_exists('smit_clear_auth_cookie') ){
    /**
     * Removes all of the cookies associated with authentication.
     *
     * @since 2.5
     */
    function smit_clear_auth_cookie()
    {
        $CI =& get_instance();
        $logged = false;
        
    	if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', PURE_URL, $regs))
            $cookie_domain  = '.'.$regs['domain'];
        else{
            $cookie_domain  = str_replace(array('http://', 'https://', 'www.'), '', PURE_URL);
            $cookie_domain  = '.'.str_replace('/', '', $cookie_domain);
        }

        $id_user = smit_get_current_user_id();

        if ( !$id_user ){
        	if ($id = smit_isset($_COOKIE['logged_in_'.md5('nonssl')], false, true)){
                $sess_user_login = $CI->session->userdata('user_logged_in');
                if (smit_isset($sess_user_login,'') != "") $logged = true;
        	}
        }else{
            $logged = true;
        }

    	if( $logged ) {
    	   
        	$CI =& get_instance();
            
            $user       = smit_get_current_user();
            $name       = 'last_login_'.strtolower(date('F'));
            $cookie     = array(
                'name'      => md5($name),
                'value'     => $id_user . '-'.time(),
                'expire'    => time()+60*60*24*30,
                'path'      => '/',
                'domain'    => $cookie_domain,
                'secure'    => false
        	);
        	$CI->input->set_cookie($cookie);
        }

    	setcookie(AUTH_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    	setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    	setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    
    	// Old cookies
    	setcookie(AUTH_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    	setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    
    	// Even older cookies
    	setcookie(USER_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    	setcookie(PASS_COOKIE, ' ', time() - 31536000, '/', $cookie_domain);
    	
    	// Logged in unsecure
    	setcookie('logged_in_'.md5('nonssl'), ' ', time() - 31536000, '/', $cookie_domain);
    }
}

if ( !function_exists('smit_generate_auth_cookie') ){
    /**
     * Generate authentication cookie contents.
     *
     * @param int       $id_user        (Required)      User ID
     * @param int       $expiration     (Required)      Cookie expiration in seconds
     * @param string    $scheme         (Optional}      The cookie scheme to use: auth, secure_auth, or logged_in
     * @return string Authentication cookie contents
     */
    function smit_generate_auth_cookie($id_user, $expiration, $scheme = 'auth') {
    	$CI =& get_instance();
    
    	$user      = $CI->Model_User->get_userdata($id_user);
    	$pass_frag = substr($user->password, 8, 4);
    
    	$key       = smit_hash($user->username . $pass_frag . '|' . $expiration, $scheme);
    	$hash      = hash_hmac('md5', $user->username . '|' . $expiration, $key);
    
    	$cookie    = $user->username . '|' . $expiration . '|' . $hash . '|' . $id_user;
    	return $cookie;
    }
}

if ( !function_exists('smit_hash') ){
    /**
     * Get hash of given string.
     *
     * @param   string $data Plain text to hash
     * @return  string Hash of $data
     */
    function smit_hash($data, $scheme = 'auth') {
    	$salt = smit_salt($scheme);
    
    	return hash_hmac('md5', $data, $salt);
    }
}

if ( !function_exists('smit_salt') ){
    /**
     * Get salt to add to hashes to help prevent attacks.
     *
     * @param   string $scheme Authentication scheme
     * @return  string Salt value
     */
    function smit_salt($scheme = 'auth') {
    
    	$CI =& get_instance();
    
    	$secret_key = $CI->config->item('encryption_key');
    
    	if ( 'auth' == $scheme ) {
    		if ( defined('AUTH_KEY') && ('' != AUTH_KEY) )
    			$secret_key = AUTH_KEY;
    
    		if ( defined('AUTH_SALT') && ('' != AUTH_SALT) ) {
    			$salt = AUTH_SALT;
    		}
    	} else if ( 'secure_auth' == $scheme ) {
    		if ( defined('SECURE_AUTH_KEY') && ('' != SECURE_AUTH_KEY) )
    			$secret_key = SECURE_AUTH_KEY;
    
    		if ( defined('SECURE_AUTH_SALT') && ('' != SECURE_AUTH_SALT) ) {
    			$salt = SECURE_AUTH_SALT;
    		}
    	} else if ( 'logged_in' == $scheme ) {
    		if ( defined('LOGGED_IN_KEY') && ('' != LOGGED_IN_KEY) )
    			$secret_key = LOGGED_IN_KEY;
    
    		if ( defined('LOGGED_IN_SALT') && ('' != LOGGED_IN_SALT) ) {
    			$salt = LOGGED_IN_SALT;
    		}
    	} else if ( 'nonce' == $scheme ) {
    		if ( defined('NONCE_KEY') && ('' != NONCE_KEY) )
    			$secret_key = NONCE_KEY;
    
    		if ( defined('NONCE_SALT') && ('' != NONCE_SALT) ) {
    			$salt = NONCE_SALT;
    		}
    	} else {
    		// ensure each auth scheme has its own unique salt
    		$salt = hash_hmac('md5', $scheme, $secret_key);
    	}
    
    	return $secret_key . $salt;
    }
}

if ( !function_exists('is_user_logged_in') ){
    /**
     * Checks if the current visitor is a logged in user.
     *
     * @return bool True if user is logged in, false if not logged in.
     */
    function is_user_logged_in()
    {		
        $CI =& get_instance();
        $id_user  = smit_get_current_user_id();

        if ( !$id_user ){
        	if ($id = smit_isset($_COOKIE['logged_in_'.md5('nonssl')], false, true)){
                $user       = $CI->Model_User->get_userdata($id);
                $id_user    = $user->id;
        	}
            return false;
        }
        
    	return true;
    }
}

if (!function_exists('smit_get_last_logged_in')){
    /**
     * Get last login user via cookies
     * @return user id
     */
    function smit_get_last_logged_in()
    {
    	$CI 	=& get_instance();
    	$name 	= 'last_login_'.strtolower(date('F'));
    	$cookie = $CI->input->cookie($name);
    	
    	if(!$cookie) return false;
    	
    	return $cookie;
    }
}

if (!function_exists('smit_get_current_user_id')){
    /**
     * 
     * Get current logged in user id
     * @param none
     * @return integer user id
     */
    function smit_get_current_user_id()
    {
    	$auth_cookie = smit_parse_auth_cookie( smit_isset( $_COOKIE[LOGGED_IN_COOKIE] ), 'logged_in');
    	if( !is_array($auth_cookie) ) return false;
    	
    	return $auth_cookie['id_user'];
    }
}

if (!function_exists('smit_get_userdata_by_id')){
    /**
     * Get user data by id
     *
     * @param integer $id User ID
     * @return (object) user data
     */
    function smit_get_userdata_by_id($id)
    {
    	$CI =& get_instance();
    	return $CI->Model_User->get_userdata($id);
    }
}

if (!function_exists('smit_get_workunitdata_by_id')){
    /**
     * Get workunit data by id
     *
     * @param integer $id User ID
     * @return (object) user data
     */
    function smit_get_workunitdata_by_id($id)
    {
    	$CI =& get_instance();
    	return $CI->Model_Option->get_workunitdata($id);
    }
}

// -------------------------------------------------------------------------
// General functions helper
// -------------------------------------------------------------------------

if (!function_exists('as_active_user')){
    /**
     * 
     * Is current user is active user
     * @param Object $user
     * @return bool
     */
    function as_active_user( $user )
    {	
        if( !empty($user) ){
            return ( $user->status == 1 );
        }
        return false;
    }
}

if (!function_exists('as_administrator')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_administrator( $user )
    {
    	if (!$user) return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 1) );	
    }
}

if ( !function_exists('smit_generate_password') )
{
    /**
     * Generate password for user
     * @author  Iqbal
     * @param   int     $length     Random String Length
     * @return  String
     */
    function smit_generate_password($length = 0, $cap=false) {
        $characters     = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        if( $cap ) {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        
        $randomString   = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

if ( !function_exists('smit_logout') ) {
    /**
     * Logout
     * @author	Iqbal
     */
	function smit_logout() 
    {
		$CI =& get_instance();
		
		if ( $CI->session->userdata( 'user_logged_in' ) ) {
            $CI->session->unset_userdata( 'user_logged_in' );
            $CI->session->sess_destroy();
        }
        
        smit_clear_auth_cookie();
	}
}

if ( !function_exists('smit_unset_current_user_human') ){
    /**
     * @since 1.0.0
     * @access public
     * @author Iqbal
     */
    function smit_unset_current_user_human() 
    {
    	$CI =& get_instance();
    	return $CI->session->unset_userdata('is_human');
    }
}

if (!function_exists('smit_check_username')){
    /**
     * 
     * Check username available
     * @param   String  $username   Username
     * @return Mixed, Boolean false if invalid username, otherwise response of username available
     */
    function smit_check_username($username){
        if ( !$username || empty($username) ) return false;
        
        $CI =& get_instance();
        
        $message            = '';
        $userdata           = $CI->Model_User->get_user_by('login', strtolower($username));
        
        if( $userdata ) { 
            $message        = 'notavailable'; 
        }else{
            if (preg_match('/^[a-z][a-z0-9_.-]{4,19}$/i', $username)){
                $message    = 'available';
            }else{
                $message    = 'invalid';
            }
        }
        
        return $message;
    }
}

if ( !function_exists('smit_count_user') )
{
    /**
     * Counts childs of user
     * @author  Iqbal
     * @param   Boolean $curdate    (Optional)  Total Current Date    
     * @return  Int of child number
     */
    function smit_count_user($curdate=FALSE) {
        $CI =& get_instance();
        return $CI->Model_User->count_user($curdate);
    }
}

if ( !function_exists('smit_is_username_blacklisted') )
{
    /**
     * Is username blacklisted
     * @param  string $username Username
     * @return boolean           blacklisted
     */
    function smit_is_username_blacklisted( $username ) {
        if ( ! $blacklist = get_option( 'blacklist' ) )
            return false;
    
        return in_array( $username, smit_isset( $blacklist['usernames'], array() ) );
    }
}

if ( !function_exists('smit_is_email_blacklisted') )
{
    /**
     * Is email blacklisted
     * @param  string $email Email
     * @return boolean        blacklisted
     */
    function smit_is_email_blacklisted( $email ) {
        if ( ! $blacklist = get_option( 'blacklist' ) )
            return false;
    
        return in_array( $email, smit_isset( $blacklist['emails'], array() ) );
    }
}

if ( !function_exists('smit_user_type') ) 
{
    /**
     * Get user type
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of User Type
     * @return  User Type Data
     */
	function smit_user_type($id='') {
		$type = config_item('user_type');
		if (!empty($id) && isset($type[$id])) return $type[$id];
		return $type;
	}
}

if ( !function_exists('smit_category') ) 
{
    /**
     * Get user type
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of User Type
     * @return  User Type Data
     */
	function smit_category($id='') {
	   $CI =& get_instance();
       
	   $condition      = '';
	   if( !empty($id) ){
	       $condition  .= ' AND %category_id% = '.$id.' ';
	   }
       $order_by    = ' %category_id% DESC ';
       
       $category    = $CI->Model_Option->get_all_category(0, 0, $condition, $order_by);
       if( !$category ) return false;
       
       return $category;
	}
}

if ( !function_exists('smit_user_status') ) 
{
    /**
     * Get user status
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of User Status
     * @return  User Status Data
     */
	function smit_user_status($id='') {
		$status = config_item('user_status');
		if (!empty($id) && isset($status[$id])) return $status[$id];
		return $status;
	}
}

if ( !function_exists('smit_workunit_status') ) 
{
    /**
     * Get user status
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of User Status
     * @return  User Status Data
     */
	function smit_workunit_status($id='') {
		$status = config_item('user_workunit_status');
		if (!empty($id) && isset($status[$id])) return $status[$id];
		return $status;
	}
}

if ( !function_exists('smit_user_status_message') ) 
{
    /**
     * Get user status
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of User Status
     * @return  User Status Data
     */
	function smit_user_status_message($id='') {
		$status = config_item('user_status_message');
		if (!empty($id) && isset($status[$id])) return $status[$id];
		return $status;
	}
}

if ( !function_exists('smit_incubation_selection_status') ) 
{
    /**
     * Get incubation selection status
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of Incubation Selection
     * @return  Incubation Selection Status Data
     */
	function smit_incubation_selection_status($id='') {
		$status = config_item('incsel_status');
		if (!empty($id) && isset($status[$id])) return $status[$id];
		return $status;
	}
}

if ( !function_exists('smit_incubation_selection_status_steptwo') ) 
{
    /**
     * Get incubation selection status
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of Incubation Selection
     * @return  Incubation Selection Status Data
     */
	function smit_incubation_selection_status_steptwo($id='') {
		$status = config_item('incsel_status_steptwo');
		if (!empty($id) && isset($status[$id])) return $status[$id];
		return $status;
	}
}

if ( !function_exists('smit_incubation_selection_report_status') ) 
{
    /**
     * Get incubation selection report status
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of Incubation Selection Report
     * @return  Incubation Selection Report Status Data
     */
	function smit_incubation_selection_report_status($id='') {
		$status = config_item('incsel_report_status');
		if (!empty($id) && isset($status[$id])) return $status[$id];
		return $status;
	}
}

if ( !function_exists('smit_religion') ) 
{
    /**
     * Get religion
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of Religion
     * @return  Religion Data
     */
	function smit_religion($id='') {
		$religion = config_item('religion');
		if (!empty($id) && isset($religion[$id])) return $religion[$id];
		return $religion;
	}
}


if (!function_exists('as_administrator')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_administrator( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 1) );	
    }
}

if (!function_exists('as_pendamping')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_pendamping( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 2) );	
    }
}

if (!function_exists('as_tenant')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_tenant( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 3) );	
    }
}

if (!function_exists('as_juri')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_juri( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 4) );	
    }
}

if (!function_exists('as_pengusul')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_pengusul( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 5) );	
    }
}

if (!function_exists('as_pelaksana')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_pelaksana( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 6) );	
    }
}

if (!function_exists('as_pelaksana_tenant')){
    /**
     * 
     * Is current user is administrator
     * @param Object $user
     * @return bool
     */
    function as_pelaksana_tenant( $user ){
    	if (!$user)
    		return false;
        
        $CI =& get_instance();
        $user = $CI->smit_user->user($user->id);
    		
    	return ( ($user->type == 7) );	
    }
}


if (!function_exists('smit_get_jury')){
    /**
     * 
     * Get jury for selection
     * @param array $jury (Required) Jury of Selection
     * @param Int $step (Required) Step of Selection
     * @param Int $last_jury (Optional) Last Jury of Selection
     * @return bool
     */
    function smit_get_jury( $jury, $step, $last_jury=0 ){
        if (!$jury) return false;
        if (!$step) return false;
        
        $CI =& get_instance();
        $jury_data  = array();
        $last_key   = count($jury) - 1;
        
        if( empty($last_jury) || $last_jury==0 ){
            $jury_data['jury']      = $jury[0];
            $jury_data['last_jury'] = $jury[0];
        }else{
            $key = array_search($last_jury, $jury);
            $key += 1;
            
            if( $key > $last_key ){
                $jury_data['jury']      = $jury[0];
                $jury_data['last_jury'] = $jury[0];
            }else{
                $jury_data['jury']      = $jury[$key];
                $jury_data['last_jury'] = $jury[$key];
            }
        }
        
        $jury_data = (object) $jury_data;
        return $jury_data;
    }
}

if ( !function_exists('smit_companion_list') ) 
{
    /**
     * Get companion list
     * @author  Iqbal
     * @param   Int         $id     (Optional)  ID of Companion
     * @return  Companion Data
     */
	function smit_companion_list($id=0) {
	   $CI =& get_instance();
       
	   $condition = ' WHERE %type% = '.PENDAMPING.' ';
	   if( !empty($id) ){
	       $condition  .= ' AND %id% = '.$id.' ';
	   }
       $order_by = ' %name% ASC ';
       
       $companion = $CI->Model_User->get_all_user(0,0,$condition,$order_by);
       if( !$companion ) return false;
       
       return $companion;
	}
}

/*
CHANGELOG
---------
Insert new changelog at the top of the list.
-----------------------------------------------
Version YYYY/MM/DD  Person Name     Description
-----------------------------------------------
1.0.0   2016/06/01  Iqbal           - Create this changelog.
*/