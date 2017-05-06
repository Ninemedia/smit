<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Controller.
 * 
 * @class     User
 * @author    Iqbal
 * @version   1.0.0
 * @copyright Copyright (c) 2017 SMIT (Sistem Manajemen Inkubasi Teknologi) (http://pusinov.lipi.go.id)
 */
class User extends SMIT_Controller {
    /**
	 * Constructor.
	 */
    function __construct()
    {       
        parent::__construct();
    }
    
    // ------------------------------------------------------------------------------------------------
    // Login Process
    // ------------------------------------------------------------------------------------------------
    
    /**
	 * Login function.
	 */
    public function login()
    {
        if( is_user_logged_in() ){
            redirect('beranda', 'location'); die();
        }

        if ( ! $login_failed = $this->session->userdata( 'log_failed' ) ) $login_failed = 0;
        
        if ( $forget = $this->input->get( 'forget' ) ) {
			if ( ! empty( $forget['notfound'] ) ) {
				$data['error_msg'] = 'Username belum terdaftar!';
			} elseif ( ! empty( $forget['wrongemail'] ) ) {
				$data['error_msg'] = 'Email belum terdaftar!';
			} elseif ( ! empty( $forget['fail'] ) ) {
				$data['error_msg'] = 'Reset password gagal! Silakan ulangi lagi.';
			} elseif ( ! empty( $forget['success'] ) ) {
				$data['msg'] = 'Reset password sudah dikirimkan ke email Anda';
			}
		}
        
        $headstyles             = '';
        $loadscripts            = '';
        $scripts_add            = '';
        $scripts_init           = '';
        
        $data['login_failed']	= ( $login_failed >= 5 ? 1 : 0 );
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['title']          = TITLE . 'User Login';
        
        $this->load->view(VIEW_BACK . 'login', $data);
        
    }
    
    /**
	 * Sign Up function.
	 */
    public function signup()
    {
        if ( ! $login_failed = $this->session->userdata( 'log_failed' ) ) $login_failed = 0;
        
        if ( $forget = $this->input->get( 'forget' ) ) {
			if ( ! empty( $forget['notfound'] ) ) {
				$data['error_msg'] = 'Username belum terdaftar!';
			} elseif ( ! empty( $forget['wrongemail'] ) ) {
				$data['error_msg'] = 'Email belum terdaftar!';
			} elseif ( ! empty( $forget['fail'] ) ) {
				$data['error_msg'] = 'Reset password gagal! Silakan ulangi lagi.';
			} elseif ( ! empty( $forget['success'] ) ) {
				$data['msg'] = 'Reset password sudah dikirimkan ke email Anda';
			}
		}
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'Login.init();',
            'SignUp.init();',
        ));
        
        $data['title']          = TITLE . 'User Login';
        $data['login_failed']	= ( $login_failed >= 5 ? 1 : 0 );
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        
        $this->load->view(VIEW_BACK . 'signup', $data);
        
    }
    
    /**
	 * Logout user function.
     * @return URL redirect page
	 */
    public function logout()
    {        
        smit_logout();
        redirect( base_url(), 'refresh' );
    }
    
    /**
	 * Validate Login user function.
     * @return AJAX String
	 */
    public function validate()
    {
    	// This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
		
        // Set credential variable param
        $post_username  = $this->input->post("username");
        $post_password  = $this->input->post("password");
        $post_remember  = $this->input->post("remember");
        
        $username   = smit_isset( $post_username, '' );
        $password   = smit_isset( $post_password, '' );
        $remember   = smit_isset( $post_remember, '' );

        // Set Credential for login
        $credentials['username']    = $username;
        $credentials['password']    = $password;
        $credentials['remember']    = $remember;

        $response   = array(
            'success'   => false,
            'msg'       => 'failed',
            'message'   => '<strong>Login gagal!</strong><br /> Silahkan cek username atau password Anda.'
		);
		
		// Record login failed attempt
    	if ( ! $login_failed = $this->session->userdata( 'log_failed' ) ) $login_failed = 0;
        
		if ( intval( $login_failed ) >= 5 ) {
			// Check captcha
			$verify = smit_validate_captcha();
			
			if ( empty( $verify->success ) ) {
				$response['verify'] = $verify;
				// Print response in JSON format
				die( json_encode( $response ) );
			}
		}
        
        // Sign On user
        $user = $this->Model_User->signon($credentials);

        // Response of signon user
        if ( $user == 'not_active' ){
            $response['error'] = true;
            $response['msg']        = 'error';
            $response['message']    = '<strong>Account belum aktif!</strong><br /> Silakan hubungi Administrator.';    
        } elseif ( $user == 'banned' ){
            $response['error'] = true;
            $response['msg']        = 'error';
            $response['message']    = '<strong>Account Anda telah di banned!</strong><br /> Info lebih lengkap, hubungi manajemen.'; 
        } elseif ( $user == 'deleted' ){
            $response['error'] = true;
            $response['msg']        = 'error';
            $response['message']    = '<strong>Account tidak ditemukan!</strong><br /> Silakan hubungi Administrator.'; 
        } elseif ( $user ) {
        	// remove login failed
        	$this->session->unset_userdata( 'log_failed' );
            
            $user           = $this->smit_user->user($user->id);
            $last_activity  = date('Y-m-d H:i:s', time() );

            $login_update   = array( 'last_login' => $last_activity );
            $this->Model_User->update_data($user->id, $login_update);

            // Set session data
            $session_data   = array(
                'id'            => $user->id,
                'username'      => $user->username,
                'name'          => $user->name,
                'email'         => $user->email,
                'last_login'    => $user->last_login
            );
            
            // Set session
            $this->session->set_userdata('user_logged_in', $session_data);
            
            // Set cookie domain
            $cookie_domain  = str_replace(array('http://', 'https://', 'www.'), '', base_url());
            $cookie_domain  = '.' . str_replace('/', '', $cookie_domain);
            $expire         = time() + 172800;
            // Set cookie data
            $cookie         = array(
                'name'      => 'logged_in_'.md5('nonssl'),
                'value'     => $user->id,
                'expire'    => $expire,
                'domain'    => $cookie_domain,
                'path'      => '/',
                'secure'    => false,
            );
            // set cookie
            setcookie($cookie['name'], $cookie['value'],$cookie['expire'],$cookie['path'],$cookie['domain'],$cookie['secure']);
			
			// log logged in user
			smit_log( 'LOGGED_IN', $username, maybe_serialize( array( 'creds' => $credentials, 'user' => $user, 'ip' => smit_get_current_ip(), 'cookie' => $_COOKIE ) ) );
            
            $response['success'] = true;
            $response['msg']     = base_url('beranda');
            $response['message'] = '<strong>Login Berhasil!</strong>';
        } else {
			$login_failed++;
			$this->session->set_userdata( 'log_failed', $login_failed );
        }
		
		// print response in JSON format
		die( json_encode( $response ) );
    }
    
    /**
	 * Forget Function
	 */
	function forget() {
		if ( is_user_logged_in() ){ redirect( 'beranda' ); }
		
		if ( ! $forget = $this->session->userdata( 'forget' ) )
			$forget = 0;
		
		if ( $forget > 3 ) die( 'Anda tidak bisa melakukan reset password. Silakan coba beberapa saat lagi.' );
		
		$email    = $this->input->post( 'email' );
		
		if ( ! $user = $this->Model_User->get_user_by('email', $email) )
			redirect( 'login?forget[notfound]=1' );
		
		if ( $user->email != $email )
			redirect( 'login?forget[wrongemail]=1' );
		
		$rand     = random_string( 'alnum', 8 );
		$curdate  = date( 'Y-m-d H:i:s' );
		// set temp password to the user
        $passdata           = array(
        	'password'		=> $rand,
            'datemodified'  => $curdate
        );
        
		// log reset
		smit_log( 'RESETTING_PASSWORD', $username, maybe_serialize( array( 'rand' => $rand, 'passdata' => $passdata, 'user' => $user ) ) );
        if ( $save_pass = $this->Model_User->update_data( $user->id, $passdata ) ){
			// log reset
			smit_log( 'RESETTING_SUCCESS', $username, maybe_serialize( array( 'rand' => $rand, 'passdata' => $passdata, 'user' => smit_get_userdata_by_id( $user->id ) ) ) );
        	$this->session->set_userdata( 'forget', ++$forget );
            // Send Email Confirmation
            $this->smit_email->send_email_reset_password( $user->id, $rand );
			// redirect success
			redirect( 'login?forget[success]=1' );
        }
		
		redirect( 'login?forget[fail]=1' );
	}
    
    // ------------------------------------------------------------------------------------------------
    
    // ------------------------------------------------------------------------------------------------
    // Registration Process
    // ------------------------------------------------------------------------------------------------
    
    /**
	 * Registration Function
	 */
	function registration() {
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $user_type              = $this->input->post('user_type');
        $user_type              = trim( smit_isset($user_type, 0) );
        $username               = $this->input->post('username');
        $username               = trim( smit_isset($username, "") );
        $email                  = $this->input->post('email');
        $email                  = trim( smit_isset($email, "") );
        $password               = $this->input->post('password');
        $password               = trim( smit_isset($password, "") );
        $password_confirm       = $this->input->post('password_confirm');
        $password_confirm       = trim( smit_isset($password_confirm, "") );
        $name                   = $this->input->post('name');
        $name                   = trim( smit_isset($name, "") );
        $phone                  = $this->input->post('phone');
        $phone                  = trim( smit_isset($phone, "") );
        $gender                 = $this->input->post('gender');
        $gender                 = trim( smit_isset($gender, "") );
        $workunit               = $this->input->post('workunit_type');
        $workunit               = trim( smit_isset($workunit, 0) );

        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        $this->form_validation->set_rules('user_type','Tipe Pengguna','required');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('password_confirm','Konfirmasi Password','required');
        $this->form_validation->set_rules('name','Nama','required');
        $this->form_validation->set_rules('phone','No.Telp/HP','required');
        $this->form_validation->set_rules('gender','Jenis Kelamin','required');
        $this->form_validation->set_rules('workunit_type','Satuan Kerja','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => array(
                    'field' => '',
                    'msg'   => 'Pendaftaran pengguna baru tidak berhasil. '.validation_errors().''
                )
            ); die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Password
        // -------------------------------------------------
		$verify = smit_validate_captcha();
		
		if ( empty( $verify->success ) ) {
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => array(
                    'field' => '',
                    'msg'   => 'Captcha tidak sesuai!'
                )
            ); die(json_encode($data));
		}
        
        // -------------------------------------------------
        // Check Password
        // -------------------------------------------------
        if( $password != $password_confirm ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => array(
                    'field' => '',
                    'msg'   => 'Konfirmasi password tidak sesuai dengan password yang dimasukkan!'
                )
            ); die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Check Username
        // -------------------------------------------------
        $check_username     = smit_check_username($username);
        if( $check_username == 'invalid' ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => array(
                    'field' => '',
                    'msg'   => 'Username tidak sesuai dengan kriteria.',
                )
            ); die(json_encode($data));
        }elseif( $check_username == 'notavailable' ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => array(
                    'field' => '',
                    'msg'   => 'Username ini sudah terdaftar. Silahkan masukkan username lain.',
                )
            ); die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Begin Transaction
        // -------------------------------------------------
        $this->db->trans_begin();
        
        // -------------------------------------------------
        // Build data user
        // -------------------------------------------------
        $datetime               = date( 'Y-m-d H:i:s' );
		$username				= strtolower( $username );
        $phone                  = str_replace(' ','',$phone);
        $data_user              = array(
            'username'          => $username,
            'password'          => $password,
            'name'              => strtoupper($name),
            'email'             => $email,
            'type'              => $user_type,
            'phone'             => $phone,
            'gender'            => $gender,
            'workunit'          => $workunit,
            'datecreated'       => $datetime,
            'datemodified'      => $datetime,
        );
        
        // -------------------------------------------------
        // Save User
        // -------------------------------------------------
        $trans_save_user        = FALSE;
        if( $user_save_id       = $this->Model_User->save_data($data_user) ){
            $trans_save_user  = TRUE;
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => array(
                    'field'     => '',
                    'msg'       => 'Pendaftaran tidak berhasil. Terjadi kesalahan data simpan data user',
                )
            ); die(json_encode($data));
        }
        
        // -------------------------------------------------
        // Commit or Rollback Transaction
        // -------------------------------------------------
        if( $trans_save_user ){
            if ($this->db->trans_status() === FALSE){
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => array(
                        'field'     => '',
                        'msg'       => 'Pendaftaran tidak berhasil. Terjadi kesalahan data transaksi database.'
                    )
                ); die(json_encode($data));
            }else{
                smit_log( 'USER_REG', 'SUCCESS', maybe_serialize(array('username'=>$username, 'password'=>$password)) );
                
                // Commit Transaction
                $this->db->trans_commit();
                // Complete Transaction
                $this->db->trans_complete();
                
                // Set JSON data
                $userinfo   = '
                    <strong>Username : </strong>' . $username . '<br />
                    <strong>Email : </strong>' . $email . '<br />
                    <strong>Nama : </strong>' . $name .'';
                $data       = array(
                    'message'   => 'success', 
                    'data'      => array(
                        'msg'           => 'success',
                        'msgsuccess'    => 'Pendaftaran pengguna baru berhasil!',
                        'userinfo'      => $userinfo
                    )
                ); die(json_encode($data));
            }
        }else{
            // Rollback Transaction
            $this->db->trans_rollback();
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => array(
                    'field'     => '',
                    'msg'       => 'Pendaftaran tidak berhasil. Terjadi kesalahan data.'
                )
            ); die(json_encode($data)); 
        }
	}
    
    // ------------------------------------------------------------------------------------------------
    
    // ------------------------------------------------------------------------------------------------
    // User List Functions
    // ------------------------------------------------------------------------------------------------
    
    /**
	 * User list function.
	 */
    function userlist(){
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'datatables/dataTables.bootstrap.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // DataTable Plugin
            BE_PLUGIN_PATH . 'jquery-datatable/jquery.dataTables.min.js',
            BE_PLUGIN_PATH . 'jquery-datatable/dataTables.bootstrap.js',
            BE_PLUGIN_PATH . 'jquery-datatable/datatable.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/table/table-ajax.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'TableAjax.init();',
        ));

        $data['title']          = TITLE . 'Daftar Pengguna';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'user/list';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * User list data function.
	 */
    function userlistdata(){
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        $condition          = ' WHERE %type% != '.ADMINISTRATOR.' ';
        
        $order_by           = '';
        $iTotalRecords      = 0;
        
        $iDisplayLength     = intval($_REQUEST['iDisplayLength']); 
        $iDisplayStart      = intval($_REQUEST['iDisplayStart']);
        
        $sAction            = smit_isset($_REQUEST['sAction'],'');
        $sEcho              = intval($_REQUEST['sEcho']);
        $sort               = $_REQUEST['sSortDir_0'];
        $column             = intval($_REQUEST['iSortCol_0']);
        
        $limit              = ( $iDisplayLength == '-1' ? 0 : $iDisplayLength );
        $offset             = $iDisplayStart;
        
        $s_username         = $this->input->post('search_username');
        $s_username         = smit_isset($s_username, '');
        $s_name             = $this->input->post('search_name');
        $s_name             = smit_isset($s_name, '');
        $s_type             = $this->input->post('search_type');
        $s_type             = smit_isset($s_type, '');
        $s_status           = $this->input->post('search_status');
        $s_status           = smit_isset($s_status, '');
        
        $s_date_min         = $this->input->post('search_datecreated_min');
        $s_date_min         = smit_isset($s_date_min, '');
        $s_date_max         = $this->input->post('search_datecreated_max');
        $s_date_max         = smit_isset($s_date_max, '');
        
        if( !empty($s_username) )       { $condition .= str_replace('%s%', $s_username, ' AND %username% LIKE "%%s%%"'); }
        if( !empty($s_name) )           { $condition .= str_replace('%s%', $s_name, ' AND %name% LIKE "%%s%%"'); }
        if( !empty($s_type) )           { $condition .= str_replace('%s%', $s_type, ' AND %type% = %s%'); }
        if( !empty($s_status) )         { $condition .= str_replace('%s%', $s_status, ' AND %status% = %s%'); }
        
        if ( !empty($s_date_min) )      { $condition .= ' AND %datecreated% >= '.strtotime($s_date_min).''; }
        if ( !empty($s_date_max) )      { $condition .= ' AND %datecreated% <= '.strtotime($s_date_max).''; }
        
        if( $column == 1 )      { $order_by .= '%username% ' . $sort; }
        elseif( $column == 2 )  { $order_by .= '%name% ' . $sort; }
        elseif( $column == 3 )  { $order_by .= '%type% ' . $sort; }
        elseif( $column == 4 )  { $order_by .= '%status% ' . $sort; }
        elseif( $column == 5 )  { $order_by .= '%datecreated% ' . $sort; }

        $user_list          = $this->Model_User->get_all_user($limit, $offset, $condition, $order_by);

        $records            = array();
        $records["aaData"]  = array();
        
        if( !empty($user_list) ){
            $iTotalRecords  = smit_get_last_found_rows();
            $cfg_type       = config_item('user_type');
            $cfg_status     = config_item('user_status');
            
            $i = $offset + 1;
            foreach($user_list as $row){
                if($row->status == NONACTIVE)   { 
                    $status         = '<span class="label label-default">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == ACTIVE)  { 
                    $status         = '<span class="label label-success">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '
                    <a href="'.($row->id>1 ? base_url('userconfirm/banned/'.$row->id) : 'javascript:;' ).'" class="userconfirm btn btn-xs btn-warning tooltips waves-effect" data-placement="left" title="Banned" '.($row->id==1 ? 'disabled="disabled"' : '').'><i class="material-icons">block</i></a> 
                    <a href="'.($row->id>1 ? base_url('userconfirm/delete/'.$row->id) : 'javascript:;' ).'" class="userconfirm btn btn-xs btn-danger tooltips waves-effect" data-placement="left" title="Deleted" '.($row->id==1 ? 'disabled="disabled"' : '').'><i class="material-icons">clear</i></a>';
                }
                elseif($row->status == BANNED)  { 
                    $status         = '<span class="label label-warning">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                elseif($row->status == DELETED) { 
                    $status         = '<span class="label label-danger">'.strtoupper($cfg_status[$row->status]).'</span>'; 
                    $btn_action     = '<a href="'.base_url('userconfirm/active/'.$row->id).'" class="userconfirm btn btn-xs btn-success tooltips waves-effect" data-placement="left" title="Aktif"><i class="material-icons">done</i></a>';
                }
                
                if($row->type == ADMINISTRATOR) { $type = '<span class="label label-info">'.strtoupper($cfg_type[$row->type]).'</span>'; }
                elseif($row->type == PENDAMPING){ $type = '<span class="label label-primary">'.strtoupper($cfg_type[$row->type]).'</span>'; }
                elseif($row->type == TENANT)    { $type = '<span class="label label-warning">'.strtoupper($cfg_type[$row->type]).'</span>'; }
                elseif($row->type == JURI)      { $type = '<span class="label label-danger">'.strtoupper($cfg_type[$row->type]).'</span>'; }
                elseif($row->type == PENGUSUL)  { $type = '<span class="label label-default">'.strtoupper($cfg_type[$row->type]).'</span>'; }
                elseif($row->type == PELAKSANA) { $type = '<span class="label label-success">'.strtoupper($cfg_type[$row->type]).'</span>'; }
                
                $records["aaData"][] = array(
                    smit_center($i),
                    $row->username,
                    '<a href="'.base_url('pengguna/profil/'.$row->id).'">' . $row->name . '</a>',
                    smit_center($type),
                    smit_center($status),
                    smit_center( date('Y-m-d', strtotime($row->datecreated)) ),
                    smit_center($btn_action),
                );
                $i++;
            }   
        }
        
        $end                = $iDisplayStart + $iDisplayLength;
        $end                = $end > $iTotalRecords ? $iTotalRecords : $end;
        
        $records["sEcho"]                   = $sEcho;
        $records["iTotalRecords"]           = $iTotalRecords;
        $records["iTotalDisplayRecords"]    = $iTotalRecords;
        
        echo json_encode($records);
    }

    // ------------------------------------------------------------------------------------------------
    
    // ------------------------------------------------------------------------------------------------
    // User Add Functions
    // ------------------------------------------------------------------------------------------------
    
    function useradd(){
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/user/sign-up.js',
        ),
        '<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>'
        );
        
        $scripts_add            = '
            <script type="text/javascript">
                function onloadCallback() {
        			SignUp.loadCaptchaAdmin();
        		}
            </script>
        ';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'SignUp.init();',
            'User.init()',
        ));

        $data['title']          = TITLE . 'Registrasi Pengguna';
        $data['user']           = $current_user;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        $data['main_content']   = 'user/add';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    // ------------------------------------------------------------------------------------------------
    // User Profile Functions
    // ------------------------------------------------------------------------------------------------
    
    function userprofile( $id=0 ){
        auth_redirect();
        
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        $user_data              = '';
        
        if ( $id > 0 && $is_admin ){
            $user_data          = smit_get_userdata_by_id($id);
        }
        
        $headstyles             = smit_headstyles(array(
            // Default CSS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.css',
            BE_PLUGIN_PATH . 'animate-css/animate.css',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/css/bootstrap-select.css',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/css/fileinput.css',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.css',
        ));
        
        $loadscripts            = smit_scripts(array(
            // Default JS Plugin
            BE_PLUGIN_PATH . 'node-waves/waves.js',
            BE_PLUGIN_PATH . 'jquery-slimscroll/jquery.slimscroll.js',
            // Jquery Validation Plugin
            BE_PLUGIN_PATH . 'jquery-validation/jquery.validate.js',
            // Bootstrap Select Plugin
            BE_PLUGIN_PATH . 'bootstrap-select/js/bootstrap-select.js',
            // Input Mask Plugin
            BE_PLUGIN_PATH . 'jquery-inputmask/jquery.inputmask.bundle.js',
            // Datetime Picker Plugin
            BE_PLUGIN_PATH . 'momentjs/moment.js',
            BE_PLUGIN_PATH . 'bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
            // Jquery Fileinput Plugin
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/plugins/sortable.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/js/fileinput.js',
            BE_PLUGIN_PATH . 'bootstrap-fileinput/themes/explorer/theme.js',
            // Bootbox Plugin
            BE_PLUGIN_PATH . 'bootbox/bootbox.min.js',
            
            // Always placed at bottom
            BE_JS_PATH . 'admin.js',
            // Put script based on current page
            BE_JS_PATH . 'pages/index.js',
            BE_JS_PATH . 'pages/user/sign-up.js',
            BE_JS_PATH . 'pages/forms/form-validation.js',
        ));
        
        $scripts_add            = '';
        $scripts_init           = smit_scripts_init(array(
            'App.init();',
            'SignUp.init();',
            'UploadFiles.init();',
            'ProfileValidation.init();',
        ));
        
        $uploaded       = $current_user->uploader;
        if($uploaded != 0){
            $file_name      = $current_user->filename . '.' . $current_user->extension;
            $file_url       = BE_AVA_PATH . $current_user->uploader . '/' . $file_name; 
            $avatar         = $file_url;
        }else{
            if($current_user->gender == GENDER_MALE){
                $avatar     = BE_IMG_PATH . 'avatar/avatar1.png';
            }else{
                $avatar     = BE_IMG_PATH . 'avatar/avatar3.png';
            }    
        }
        
        $data['title']          = TITLE . 'Profil Pengguna';
        $data['user_other']     = $user_data;
        $data['user']           = $current_user;
        $data['avatar']         = $avatar;
        $data['is_admin']       = $is_admin;
        $data['headstyles']     = $headstyles;
        $data['scripts']        = $loadscripts;
        $data['scripts_add']    = $scripts_add;
        $data['scripts_init']   = $scripts_init;
        
        $data['main_content']   = 'user/profile';
        
        $this->load->view(VIEW_BACK . 'template', $data);
    }
    
    /**
	 * Profile Personal Info Update function.
	 */
    function personalinfo()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $post_user_username     = $this->input->post('up_username');
        $post_user_name         = $this->input->post('up_name');
        $post_user_email        = $this->input->post('up_email');
        $post_user_phone        = $this->input->post('up_phone');
        $post_user_address      = $this->input->post('up_address');
        $post_user_province     = $this->input->post('up_province');
        $post_user_city         = $this->input->post('up_regional');
        $post_user_district     = $this->input->post('up_district');
        $post_user_gender       = $this->input->post('up_gender');
        $post_user_birthplace   = $this->input->post('up_birthplace');
        $post_user_birthdate    = $this->input->post('up_birthdate');
        $post_user_religion     = $this->input->post('up_religion');
        $post_user_marital_status  = $this->input->post('up_marital_status');
        
        $post_user_id           = $this->input->post('user_id');
        $id_user                = ( smit_isset($post_user_id, '') > 0 ? smit_isset($post_user_id, '') : $current_user->id );
        $username               = smit_isset($post_user_username, '');
        
        $this->form_validation->set_rules('up_name','Nama Anggota','required');
        $this->form_validation->set_rules('up_email','Email Anggota','required');
        $this->form_validation->set_rules('up_address','Alamat','required');
        $this->form_validation->set_rules('up_province','Propinsi','required');
        $this->form_validation->set_rules('up_regional','Kota/Kabupaten','required');
        $this->form_validation->set_rules('up_gender','Jenis Kelamin','required');
        $this->form_validation->set_rules('up_phone','Telp/HP','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            $curdate            = date("Y-m-d H:i:s");
            
            $userdata         = array(
                'name'          => strtoupper( trim(smit_isset($post_user_name, '')) ),
                'email'         => trim(smit_isset($post_user_email, '')),
                'address'       => strtoupper( trim(smit_isset($post_user_address, '')) ),
                'province'      => smit_isset($post_user_province, ''),
                'city'          => smit_isset($post_user_city, ''),
                'district'      => strtoupper( trim(smit_isset($post_user_district, '')) ),
                'gender'        => smit_isset($post_user_gender, ''),
                'phone'         => trim(smit_isset($post_user_phone, '')),
                'birthplace'    => trim(smit_isset($post_user_birthplace, '')),
                'birthdate'     => trim(smit_isset($post_user_birthdate, '')),
                'religion'      => smit_isset($post_user_religion, ''),
                'marital_status'=> smit_isset($post_user_marital_status, ''),
                'datemodified'  => $curdate,
            );

            if( $save_user    = $this->Model_User->update_data($id_user, $userdata) ){
                // Set Message
                $msg            = ( $id_user != $current_user->id ? 'Data profil <strong>'. $username .'</strong> sudah tersimpan.' : 'Data profil Anda sudah tersimpan.' );
                
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => smit_alert('Validasi formulir Anda berhasil! '.$msg.''),
                    'name'      => ( !empty($id_user) ? '' : smit_isset($post_user_name, '') ),
                );
            }else{
                // Set JSON data
                $data['success']    = false;
                $data['msg']        = 'error';
                $data['message']    = '<strong>Validasi formulir Anda tidak berhasil! Silahkan periksa kembali data formulir Anda!';  
            }
            
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    /**
	 * Account Setting Info Update function.
	 */
    function accountsetting()
    {
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        $post_user_username     = $this->input->post('username');
        $username               = smit_isset($post_user_username, '');
        
        $this->form_validation->set_rules('username','Username anda','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // -------------------------------------------------
            // Check File
            // -------------------------------------------------
            if( empty($_FILES['ava_selection_files']['name']) ){
                // Set JSON data
                $data = array(
                    'message'       => 'error',
                    'data'          => smit_alert('Tidak ada berkas avatar yang di unggah. Silahkan inputkan berkas avatar!'),
                );
                die(json_encode($data));
            }
            
            if( !empty( $_POST ) ){
                $upload_path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/smitassets/backend/images/user/' . $current_user->id;
                if( !file_exists($upload_path) ) { mkdir($upload_path, 0777, TRUE); }
                    
                $config = array(
                    'upload_path'   => $upload_path,
                    'allowed_types' => "jpg|jpeg|png",
                    'overwrite'     => FALSE,
                    'max_size'      => "1024000", 
                );
                $this->upload->initialize($config);
                
                // -------------------------------------------------
                // Begin Transaction
                // -------------------------------------------------
                $this->db->trans_begin();
                
                if( !empty($_FILES['ava_selection_files']['name']) ){
                    if( ! $this->upload->do_upload('ava_selection_files') ){
                        $message = $this->upload->display_errors();
                        // Set JSON data
                        $data = array('message' => 'error','data' => $this->upload->display_errors()); 
                        die(json_encode($data));
                    }
                    $upload_data    = $this->upload->data();
                    $upload_file    = $upload_data['raw_name'] . $upload_data['file_ext'];
                    $this->image_moo->load($upload_path . '/' .$upload_data['file_name'])->resize_crop(200,200)->save($upload_path. '/' .$upload_file, TRUE);
                    $this->image_moo->clear();
                    
                    $account_data  = array(
                        'url'           => smit_isset($upload_data['full_path'],''),
                        'extension'     => substr(smit_isset($upload_data['file_ext'],''),1),
                        'filename'      => smit_isset($upload_data['raw_name'],''),
                        'size'          => smit_isset($upload_data['file_size'],0),
                        'uploader'      => $current_user->id,
                        'datemodified'  => $curdate,
                    );     
                }
            }
            
            // -------------------------------------------------
            // Save Account 
            // -------------------------------------------------
            $trans_save_account         = FALSE;
            if( $save_user    = $this->Model_User->update_data($current_user->id, $account_data) ){
                $trans_save_account  = TRUE;
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Perbaharui profil avatar tidak berhasil. Terjadi kesalahan berkas anda'); 
                die(json_encode($data));
            }
            
            // -------------------------------------------------
            // Commit or Rollback Transaction
            // -------------------------------------------------
            if( $trans_save_account ){
                if ($this->db->trans_status() === FALSE){
                    // Rollback Transaction
                    $this->db->trans_rollback();
                    // Set JSON data
                    $data = array(
                        'message'       => 'error',
                        'data'          => 'Perbaharui akun tidak berhasil. Terjadi kesalahan data transaksi database.'
                    ); die(json_encode($data));
                }else{
                    // Commit Transaction
                    $this->db->trans_commit();
                    // Complete Transaction
                    $this->db->trans_complete();
                    
                    // Set JSON data
                    $data       = array('message' => 'success', 'data' => 'Perbaharui akun baru berhasil!'); 
                    die(json_encode($data));
                    // Set Log Data
                    smit_log( 'ACCOUNT_UPDATE', 'SUCCESS', maybe_serialize(array('username'=>$username, 'url'=> smit_isset($upload_data['full_path'],''))) );
                }
            }else{
                // Rollback Transaction
                $this->db->trans_rollback();
                // Set JSON data
                $data = array('message' => 'error','data' => 'Perbaharui akun tidak berhasil. Terjadi kesalahan data.'); 
                die(json_encode($data)); 
            } 
            
            /*
            if( $save_user    = $this->Model_User->update_data($id_user, $userdata) ){
                // Set Message
                $msg            = ( $id_user != $current_user->id ? 'Data profil <strong>'. $username .'</strong> sudah tersimpan.' : 'Data profil Anda sudah tersimpan.' );
                
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => smit_alert('Validasi formulir Anda berhasil! '.$msg.''),
                    'name'      => ( !empty($id_user) ? '' : smit_isset($post_user_name, '') ),
                );
            }else{
                // Set JSON data
                $data['success']    = false;
                $data['msg']        = 'error';
                $data['message']    = '<strong>Validasi formulir Anda tidak berhasil! Silahkan periksa kembali data formulir Anda!';  
            }
            */
            
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    /**
	 * Job Personal Info Update function.
	 */
    function jobinfo()
    { 
        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $post_user_username     = $this->input->post('up_username');
        $post_user_nip          = $this->input->post('up_nip');
        $post_user_position     = $this->input->post('up_position');
        $post_user_workunit     = $this->input->post('workunit_type');
        
        $post_user_id           = $this->input->post('user_id');
        $id_user                = ( smit_isset($post_user_id, '') > 0 ? smit_isset($post_user_id, '') : $current_user->id );
        $username               = smit_isset($post_user_username, '');
        
        $this->form_validation->set_rules('up_nip','Nomor Induk Pegawai','required');
        $this->form_validation->set_rules('up_position','Posisi Pegawai','required');
        $this->form_validation->set_rules('workunit_type','Satuan Kerja Pegawai','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');
        
        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            $curdate            = date("Y-m-d H:i:s");
            
            $userdata         = array(
                'nip'           => trim(smit_isset($post_user_nip, '')),
                'position'      => smit_isset($post_user_position, ''),
                'workunit'      => smit_isset($post_user_workunit, ''),
                'datemodified'  => $curdate,
            );

            if( $save_user    = $this->Model_User->update_data($id_user, $userdata) ){
                // Set Message
                $msg            = ( $id_user != $current_user->id ? 'Data profil <strong>'. $username .'</strong> sudah tersimpan.' : 'Data profil Anda sudah tersimpan.' );
                
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => smit_alert('Validasi formulir Anda berhasil! '.$msg.''),
                    'name'      => ( !empty($id_user) ? '' : smit_isset($post_user_name, '') ),
                );
            }else{
                // Set JSON data
                $data['success']    = true;
                $data['msg']        = 'success';
                $data['message']    = '<strong>Validasi formulir Anda tidak berhasil! Silahkan periksa kembali data formulir Anda!';  
            }
            
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    
    // ------------------------------------------------------------------------------------------------
    
    // ------------------------------------------------------------------------------------------------
    // Additional Functions
    // ------------------------------------------------------------------------------------------------
    
    /**
	 * User confirm function.
	 */
    function userconfirm($action, $id){
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        if ( !$action ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };
        
        if ( !$id ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'ID Pengguna harus dicantumkan');
            // JSON encode data
            die(json_encode($data));
        };
        
        $current_user       = smit_get_current_user();
        $is_admin           = as_administrator($current_user);
        if ( !$is_admin ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi Pengguna hanya bisa dilakukan oleh Administrator');
            // JSON encode data
            die(json_encode($data));
        };
        
        $userdata           = smit_get_userdata_by_id($id);
        if( !$userdata ){
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Data pengguna tidak ditemukan atau belum terdaftar');
            // JSON encode data
            die(json_encode($data));
        }
        
        $curdate = date('Y-m-d H:i:s');
        if( $action=='active' )     { $status = ACTIVE; }
        elseif( $action=='banned' ) { $status = BANNED; }
        elseif( $action=='delete' ) { $status = DELETED; }
        
        $data_update = array('status'=>$status,'datemodified'=>$curdate);
        if( $this->Model_User->update_data($id,$data_update) ){
            // Set JSON data
            $data = array('msg' => 'success','message' => 'Konfirmasi data pengguna berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array('msg' => 'error','message' => 'Konfirmasi data pengguna tidak berhasil dilakukan.');
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    /**
	 * Select Province function.
	 */
    function selectprovince(){
        $province           = $this->input->post('province');
        $province           = smit_isset($province, '');
        $data               = '<option value="">-- Pilih Kota/Kabupaten --</option>';

        if( empty($province) ){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => $data,
            );
            // JSON encode data
            die(json_encode($data));
        }
        
        $cities             = $this->Model_Address->get_cities_by_province($province);
        if( !empty($cities) ){
            foreach($cities as $city){
                $data      .= '<option value="'.$city->regional_id.'">'.$city->regional_name.'</option>';
            }
            // Set JSON data
            $data = array(
                'message'       => 'success',
                'data'          => $data,
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => $data,
            );
            // JSON encode data
            die(json_encode($data));
        }
    }
    
    
    /**
     * Search Username function.
     */
    function searchusername()
    {
        // This is for AJAX request
    	if ( ! $this->input->is_ajax_request() ) exit('No direct script access allowed');
        
        $username               = $this->input->post('username');
        $username               = smit_isset($username);
        $password               = $this->input->post('password');
        $password               = smit_isset($password);
        $selection              = $this->input->post('selection');
        $selection              = smit_isset($selection);
        $message                = '';
        $data                   = '';
        $info                   = smit_alert('Username dan Password tidak boleh kosong. Silahkan ketik Username dan Password anda!');
        
        if( !empty($username) ){
            $userdata           = $this->Model_User->get_user_by('login', strtolower($username));
            $this->Model_User->decode_password( $userdata );
        
            if( !$userdata ) {
                $message        = 'error';
                $info           = smit_alert('Username invalid atau belum terdaftar.');
            }else{
                if( empty($password) ){
                    $message    = 'error';
                    $info       = smit_alert('Silahkan masukkan password pengguna Anda');
                }elseif( md5( $password ) != md5( $userdata->password ) ){
                    $message    = 'error';
                    $info       = smit_alert('Password yang Anda masukkan salah');
                }else{
                    if($userdata->type == 1){
                        $message    = 'error';
                        $info       = smit_alert('Administrator tidak perlu melakukan pendaftaran Seleksi Inkubasi');
                    }else{
                        // Check if username has been registeren on incubation selection
                        if( $selection == 'praincubation' ){
                            $user_selection = $this->Model_Praincubation->get_praincubation_by('userid',$userdata->id);
                        }else{
                            $user_selection = $this->Model_Incubation->get_incubation_by('userid',$userdata->id);
                        }

                        if( $user_selection || !empty($user_selection) ){
                            $message    = 'error';
                            $info       = smit_alert('Username sudah terdaftar dalam seleksi inkubasi. Anda hanya bisa mendaftar seleksi 1 kali dalam 1 periode seleksi.');
                        }else{
                            $message    = 'success';
                            $info       = smit_alert('Data anda ditemukan, Anda dapat mengisi formulir pendaftaran kegiatan.');
                            $data      .= '
                            <input type="hidden" name="user_id" class="form-control" value="'.$userdata->id.'" />
                            <div class="form-group form-float">
                                <label class="form-label">Nama Pengguna </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">person</i></span>
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Pengguna" disabled="" value="'.strtoupper($userdata->name).'" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Email Pengguna </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">email</i></span>
                                    <div class="form-line">
                                        <input type="text" name="email" id="email"  class="form-control" placeholder="Email Pengguna" disabled="" value="'.$userdata->email.'" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label class="form-label">Telp Pengguna </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="material-icons">phone</i></span>
                                    <div class="form-line">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Telp Pengguna" disabled="" value="'.$userdata->phone.'" />
                                    </div>
                                </div>
                            </div>';
                        }   
                    }
                }
            }
        }

        // Set JSON data
        $data = array(
            'message'   => $message,
            'info'      => $info,
            'data'      => $data,
        );

        // JSON encode data
        die(json_encode($data));
    }
    
    /**
     * Change Password function.
     */
    function changepassword()
    {
        auth_redirect();
        /*
        if( smit_isset($this->input->post('id_user_other'), '') != '' ){
            $id_member          = smit_isset($this->input->post('id_member_other'), '');
            $username           = smit_isset($this->input->post('username_other'), '');
            $curdate            = date("Y-m-d H:i:s");

            $userdata           = smit_get_userdata_by_id($id_member);
            if( !$memberdata || empty($memberdata) ){
                // Set JSON data
                $data = array(
                    'message'   => 'error',
                    'data'      => '<button class="close" data-close="alert"></button>Data anggota <strong>'.$username.'</strong> tidak ditemukan!',
                );
            }

            $global_pass        = get_option('global_password');
            $passdata           = array(
                'password'      => md5($global_pass),
                'datemodified'  => $curdate
            );

            if( $save_pass      = $this->model_member->update_data($id_member, $passdata) ){
                // Send SMS Confirmation
                //$this->gmc_sms->sms_cpassword($memberdata->phone, $username, $global_pass);
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => '<button class="close" data-close="alert"></button>Reset/Atur ulang password anggota <strong>'.$username.'</strong> berhasil!',
                );
            }else{
                // Set JSON data
                $data = array(
                    'message'   => 'error',
                    'data'      => '<button class="close" data-close="alert"></button>Reset/Atur ulang password anggota <strong>'.$username.'</strong> tidak berhasil!',
                );
            }
            // JSON encode data
            die(json_encode($data));

        }
        */

        $current_user           = smit_get_current_user();
        $is_admin               = as_administrator($current_user);
        
        $message                = '';
        $post                   = '';
        $curdate                = date('Y-m-d H:i:s');
        
        // Set Variable
        $cur_pass               = $this->input->post('cur_pass');
        $cur_pass               = smit_isset($cur_pass, '');
        $new_pass               = $this->input->post('new_pass');
        $new_pass               = smit_isset($new_pass, '');
        $cnew_pass              = $this->input->post('cnew_pass');
        $cnew_pass              = smit_isset($cnew_pass, '');
        
        $this->form_validation->set_rules('cur_pass','Password Lama','required');
        $this->form_validation->set_rules('new_pass','Pasword Baru','required');
        $this->form_validation->set_rules('cnew_pass','Konfirmasi Password Baru','required');
        
        $this->form_validation->set_message('required', '%s harus di isi');
        $this->form_validation->set_error_delimiters('', '');

        if($this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'       => 'error',
                'data'          => smit_alert('Anda memiliki beberapa kesalahan ( '.validation_errors().'). Silakan cek di formulir bawah ini!'),
            );
            // JSON encode data
            die(json_encode($data));
        }else{
            // Check Member Password
            $check_pass     = $this->Model_User->authenticate($current_user->username, $cur_pass);

            if ( !$check_pass ){
                // Set JSON data
                $data = array(
                    'message'   => 'error',
                   'data'      => smit_alert('Konfirmasi password tidak sesuai dengan password baru!'),
                );
                // JSON encode data
                die(json_encode($data));
            }else{
                if( $new_pass != $cnew_pass ){
                    // Set JSON data
                    $data = array(
                        'message'   => 'error',
                        'data'      => '<button class="close" data-close="alert"></button>Konfirmasi password tidak sesuai dengan password baru!',
                    );
                    // JSON encode data
                    die(json_encode($data));
                }else{
                    $passdata           = array(
                        'password'      => $new_pass,
                        'datemodified'  => $curdate,
                    );

                    if( $save_pass      = $this->Model_User->update_data($current_user->id, $passdata) ){
                        // Set JSON data
                        $data = array(
                            'message'   => 'success',
                            'data'      => base_url('logout'),
                        );
                    }else{
                        // Set JSON data
                        $data = array(
                            'message'   => 'error',
                            'data'      => smit_alert('Validasi formulir Anda tidak berhasil! Silahkan periksa kembali data formulir Anda!'),
                        );
                    }
                    // JSON encode data
                    die(json_encode($data));
                }
            }
        }
    }
    
    // ------------------------------------------------------------------------------------------------
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */